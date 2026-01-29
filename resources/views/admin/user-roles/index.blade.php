@extends('layouts.master')

@section('title', 'User Role Management')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>User Role Management</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">User Roles</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>All Users</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-primary">
                            <i class="fas fa-shield-alt"></i> Manage User
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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Current Roles</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td><strong>{{ $user->name }}</strong></td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->roles->count() > 0)
                                                @foreach ($user->roles as $role)
                                                    <span class="badge badge-info mr-1">{{ $role->name }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge badge-secondary">No roles</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#editRolesModal{{ $user->id }}">
                                                <i class="fas fa-edit"></i> Edit Roles
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Roles Modal -->
                                    <div class="modal fade" id="editRolesModal{{ $user->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editRolesModalLabel{{ $user->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editRolesModalLabel{{ $user->id }}">
                                                        Edit Roles for {{ $user->name }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('admin.user-roles.update', $user) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Select Roles</label>
                                                            <select name="roles[]" class="form-control select2" multiple>
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role->id }}"
                                                                        {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                                                                        {{ $role->name }} ({{ $role->slug }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <small class="form-text text-muted">You can select multiple
                                                                roles</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Update Roles</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-users fa-3x mb-3 text-muted"></i>
                                                <h5 class="text-muted">No users available</h5>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                dropdownParent: $('.modal')
            });
        });
    </script>
@endpush
