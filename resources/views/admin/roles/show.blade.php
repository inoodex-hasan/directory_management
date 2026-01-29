@extends('layouts.master')

@section('title', 'Manage Role Users')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Role: {{ $role->name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.roles.index') }}">Roles</a></div>
                <div class="breadcrumb-item">{{ $role->name }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <!-- Users with this role -->
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Users with this Role ({{ $role->users->count() }})</h4>
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

                            @if ($role->users->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($role->users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        <form action="{{ route('admin.roles.remove-user', [$role, $user]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you want to remove this user from the role?')">
                                                                <i class="fas fa-times"></i> Remove
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted text-center py-4">No users assigned to this role.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Add users to role -->
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Users to Role</h4>
                        </div>
                        <div class="card-body">
                            @if ($allUsers->count() > 0)
                                <form action="{{ route('admin.roles.add-users', $role) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Select Users</label>
                                        <select name="users[]" class="form-control select2" multiple required>
                                            @foreach ($allUsers as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Users
                                    </button>
                                </form>
                            @else
                                <p class="text-muted text-center py-4">All users already have this role assigned.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Roles
                    </a>
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
            $('.select2').select2();
        });
    </script>
@endpush
