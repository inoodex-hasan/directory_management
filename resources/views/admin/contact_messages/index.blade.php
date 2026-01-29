@extends('layouts.master')

@section('title', 'Contact Messages')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Contact Messages</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Inbox</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>From</th>
                                    <th>Contact Info</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($messages as $msg)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $msg->name }}</strong><br>
                                            <small>{{ $msg->web_url }}</small>
                                        </td>
                                        <td>
                                            <i class="fas fa-envelope"></i> {{ $msg->email }}<br>
                                            <!-- <i class="fas fa-phone"></i> {{ $msg->phone ?? 'N/A' }} -->
                                        </td>
                                        <td>{{ Str::limit($msg->subject, 30) }}</td>
                                        <td>{{ $msg->created_at->format('d M, Y') }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#msgModal{{ $msg->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <form action="{{ route('admin.contact-messages.destroy', $msg->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete message?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No messages yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach($messages as $msg)
        <div class="modal fade" id="msgModal{{ $msg->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $msg->subject }}</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>From:</strong> {{ $msg->name }} ({{ $msg->email }})
                        </p>
                        <!-- <p><strong>Subject:</strong> {{ $msg->subject }}</p> -->
                        <hr>
                        <p>{{ $msg->message }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection