@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Submit New Link</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('links.store') }}" method="POST">
                @csrf
                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="form-group col-md-12">
                    <label>URL</label>
                    <input type="url" name="url" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label>Description (Optional)</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit for Review</button>
            </form>
        </div>
    </div>
@endsection
