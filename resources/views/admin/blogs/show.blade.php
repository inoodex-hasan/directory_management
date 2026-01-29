@extends('layouts.master')

@section('title', 'View Post: ' . $blog->title)

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Preview Blog: {{ $blog->title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></div>
                <div class="breadcrumb-item">View</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="p-3">
                            <img src="{{ asset('storage/' . $blog->image) }}" class="img-fluid rounded shadow-sm"
                                style="width: 100%; max-height: 300px; object-fit: cover;">
                        </div>

                        <div class="card-body">
                            <div class="mb-3">
                                <span class="badge badge-primary">{{ $blog->category->title ?? 'Uncategorized' }}</span>
                                <span class="badge badge-{{ $blog->is_published ? 'success' : 'warning' }}">
                                    {{ $blog->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </div>

                            <h2 class="section-title" style="margin-top: 0;">{{ $blog->title }}</h2>
                            <p class="section-lead text-muted">{{ $blog->subtitle }}</p>

                            <hr>

                            <div class="alert alert-light border">
                                <h6>Short Description:</h6>
                                <p class="mb-0">{{ $blog->description }}</p>
                            </div>

                            <div class="mt-4 content-preview">
                                {!! $blog->content !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Post Details</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Created At:</strong>
                                    <span>{{ $blog->created_at->format('M d, Y') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Last Updated:</strong>
                                    <span>{{ $blog->updated_at->diffForHumans() }}</span>
                                </li>
                            </ul>
                            <div class="mt-4">
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-warning btn-block">Edit
                                    Post</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .content-preview img {
            max-width: 100%;
            /* Prevents large images from breaking the layout */
            height: auto;
        }
    </style>
@endsection
