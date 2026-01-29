@extends('layouts.master')

@section('title', 'Role Management')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Roles</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Roles</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.roles.create') }}" class="btn btn-icon icon-left btn-primary">
                                    <i class="fas fa-plus"></i> Add New Role
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">×</button>
                                        {{ session('success') }}
                                    </div>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Users Count</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($roles as $index => $role)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <strong>{{ $role->name }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info">{{ $role->slug }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-primary">{{ $role->users_count }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.roles.show', $role) }}"
                                                        class="btn btn-sm btn-info" title="Manage Users">
                                                        <i class="fas fa-users"></i> Users
                                                    </a>
                                                    <a href="{{ route('admin.roles.edit', $role) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>

                                                    <a href="{{ route('admin.roles.destroy', $role) }}"
                                                        class="btn btn-sm btn-danger delete-item" title="Delete">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4">
                                                    No roles found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{ $roles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
