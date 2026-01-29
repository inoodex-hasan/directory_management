@extends('layouts.master')

@section('title', 'Blog Management')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Blog Posts</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Blog Posts</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.blogs.create') }}" class="btn btn-icon icon-left btn-primary">
                                    <i class="fas fa-plus"></i> Add New Post
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            {{-- @if (session('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">×</button>
                                        {{ session('success') }}
                                    </div>
                                </div>
                            @endif --}}

                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Image</th>
                                            <th>Title & Subtitle</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($blogs as $index => $post)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $post->image) }}" alt="blog image"
                                                        class="img-thumbnail"
                                                        style="width: 80px; height: 80px; object-fit: cover; object-position: center;">
                                                </td>
                                                <td>
                                                    <strong>{{ $post->title }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $post->subtitle }}</small>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-info">{{ $post->category->title ?? 'Uncategorized' }}</span>
                                                </td>
                                                <td>
                                                    @if ($post->is_published == 1)
                                                        <span class="badge badge-success">Published</span>
                                                    @else
                                                        <span class="badge badge-warning">Draft</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.blogs.show', $post) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i> Show
                                                    </a>
                                                    <a href="{{ route('admin.blogs.edit', $post) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>

                                                    <form action="{{ route('admin.blogs.destroy', $post) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Are you sure want to delete this slider?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    No blog posts found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
