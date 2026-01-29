@extends('layouts.master')

@section('title', 'Submit New Link')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Links</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('links.index') }}">My Submissions</a></div>
                <div class="breadcrumb-item">Submit</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Submit New Website</h4>
                            <div class="card-header-action">
                                <a href="{{ route('links.index') }}" class="btn btn-primary">
                                    My Links
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('links.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Website Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title') }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>URL <span class="text-danger">*</span></label>
                                        <input type="url" name="url"
                                            class="form-control @error('url') is-invalid @enderror"
                                            value="{{ old('url') }}" required>
                                        @error('url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Category <span class="text-danger">*</span></label>
                                        <select name="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror" required>
                                            <option value="">-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Description (Optional)</label>
                                        <textarea name="description" class="summernote @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Submit for Review
                                    </button>
                                    <a href="{{ route('links.index') }}" class="btn btn-secondary btn-lg ml-2">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
