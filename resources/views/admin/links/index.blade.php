@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Processed Links</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Website</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($links as $link)
                                <tr>
                                    <td>
                                        <strong>{{ $link->title }}</strong><br>
                                        <small><a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a></small>
                                    </td>
                                    <td>{{ $link->category->title }}</td>
                                    <td>
                                        @if ($link->status === 'approved')
                                            <div class="badge badge-success">Approved</div>
                                        @else
                                            <div class="badge badge-danger">Rejected</div>
                                        @endif
                                    </td>
                                    <td>{{ $link->user->name }}</td>
                                    <td>
                                        {{-- Link to edit or change status back to pending if needed --}}
                                        <a href="{{ route('admin.links.edit', $link->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="float-right">
                    {{ $links->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
