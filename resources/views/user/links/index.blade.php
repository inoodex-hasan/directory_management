@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>My Submissions</h1>

        </div>

        <div class="card">
            <div class="section-header-button d-flex justify-content-end p-2">
                <a href="{{ route('links.create') }}" class="btn btn-primary justify-content-end">Add New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Website</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Submitted On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($links as $link)
                                <tr>
                                    <td>
                                        <strong>{{ $link->title }}</strong><br>
                                        <small><a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a></small>
                                    </td>
                                    <td>{{ $link->category->title }}</td>
                                    <td>
                                        @if ($link->status == 'pending')
                                            <span class="badge badge-warning">Pending Review</span>
                                        @elseif($link->status == 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>{{ $link->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <p>You haven't submitted any links yet.</p>
                                    </td>
                                </tr>
                            @endforelse
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
