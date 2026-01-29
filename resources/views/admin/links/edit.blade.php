@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Review Submission</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.links.update', $link->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Website Title</label>
                                <input type="text" class="form-control" value="{{ $link->title }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Submitted URL</label>
                                <input type="text" class="form-control" value="{{ $link->url }}" readonly>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" readonly>{{ $link->description }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category</label>
                                <input type="text" class="form-control" value="{{ $link->category->title }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Submitted By</label>
                                <input type="text" class="form-control" value="{{ $link->user->name }}" readonly>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group w-50">
                        <label class="font-weight-bold">Change Decision / Status</label>
                        <select name="status" class="form-control selectric">
                            <option value="pending" {{ $link->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $link->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $link->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update Status</button>
                        <a href="{{ route('admin.links.processed') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
