@extends('layouts.master')

@section('title', 'Edit Post')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Post</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', $blog->title) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Subtitle</label>
                            <input type="text" name="subtitle" class="form-control"
                                value="{{ old('subtitle', $blog->subtitle) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select name="is_published" class="form-control">
                                <option value="1"
                                    {{ old('is_published', $blog->is_published) == 1 ? 'selected' : '' }}>
                                    Published
                                </option>
                                <option value="0"
                                    {{ old('is_published', $blog->is_published) == 0 ? 'selected' : '' }}>
                                    Draft
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Current Image</label>
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $blog->image) }}" width="150" class="img-thumbnail">
                            </div>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Short Description</label>
                            <textarea name="description" class="form-control">{{ old('description', $blog->description) }}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Content</label>
                            <textarea name="content" class="summernote">{{ old('content', $blog->content) }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Post</button>
                </form>
            </div>
        </div>
    </section>
@endsection
