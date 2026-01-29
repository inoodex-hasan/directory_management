@extends('layouts.master')

@section('title', 'Manage Links')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Link Submissions</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Links</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>All Submitted Links</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Check if there are any links --}}
                                @forelse($links as $link)
                                    <tr>
                                        <td>{{ $link->id }}</td>
                                        <td>
                                            <strong>{{ $link->title }}</strong><br>
                                            <small><a href="{{ $link->url }}" target="_blank"
                                                    class="text-muted">{{ $link->url }}</a></small>
                                        </td>
                                        <td><span class="badge badge-info">{{ $link->category->title }}</span></td>
                                        <td>{{ $link->user->name }}</td>
                                        <td>
                                            @if ($link->status == 'pending')
                                                <div class="badge badge-warning">Pending</div>
                                            @elseif($link->status == 'approved')
                                                <div class="badge badge-success">Approved</div>
                                            @else
                                                <div class="badge badge-danger">Rejected</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <form action="{{ route('admin.links.status', $link->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button class="btn btn-success btn-sm mr-1"><i class="fas fa-check"></i>
                                                        Approve</button>
                                                </form>

                                                <form action="{{ route('admin.links.status', $link->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i>
                                                        Reject</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty

                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-link fa-3x mb-3 text-muted"></i>
                                                <h5 class="text-muted">No links available</h5>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination Links --}}
                    <div class="mt-4">
                        {{ $links->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
