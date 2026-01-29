@extends('frontend.layouts.master')

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="form-card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4 text-black">Reset Password</h3>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label text-black">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" placeholder="Enter your email" value="{{ old('email') }}" required
                                    autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Send Password Reset Link</button>
                        </form>
                        <div class="mt-3 text-center">
                            <a href="{{ route('frontend.login') }}" class="text-decoration-none">Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection