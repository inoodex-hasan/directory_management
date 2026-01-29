@extends('frontend.layouts.master')

@push('styles')
    <style>
        .captcha-box {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .captcha {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-family: 'Courier New', monospace;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 3px;
            border-radius: 5px;
            user-select: none;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            min-width: 150px;
            text-align: center;
        }

        .reload-captcha {
            padding: 8px 12px;
            transition: all 0.3s ease;
        }

        .reload-captcha:hover {
            transform: rotate(180deg);
        }

        .required-star {
            color: #dc3545;
        }
    </style>
@endpush

@section('content')
    <div class="container-xl my-4">
        <div class="row g-4">
            @include('frontend.layouts.left_sidebar')

            <main class="col-lg-6 order-lg-2 main-content">

                <h4 class="mb-4 text-center" style="color: var(--primary);">Contact With Us</h4>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="form-section">

                    <form action="{{ route('frontend.contact.submit') }}" method="POST">

                        @csrf

                        <div class="row g-3">

                            <div class="col-md-12">
                                <label for="name" class="form-label">
                                    Name <span class="required-star">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" required placeholder="Your name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="email" class="form-label">
                                    Your Email <span class="required-star">*</span>
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" required placeholder="your.email@example.com"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="subject" class="form-label">
                                    Subject <span class="required-star">*</span>
                                </label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                    id="subject" name="subject" required placeholder="Brief topic of your message"
                                    value="{{ old('subject') }}">
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="message" class="form-label">
                                    Message <span class="required-star">*</span>
                                </label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="6"
                                    required placeholder="Please describe your inquiry, issue or feedback...">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">
                                    Enter the code shown <span class="required-star">*</span>
                                </label>
                                <div class="captcha-box mb-2">
                                    <span class="captcha" id="captcha-display"></span>
                                    <button type="button" class="btn btn-sm btn-secondary reload-captcha"
                                        title="Reload Captcha" id="reload-captcha">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control @error('captcha') is-invalid @enderror"
                                    name="captcha" required placeholder="Enter the code above">
                                @error('captcha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted mt-1">
                                    This helps prevent automated registrations.
                                </div>
                            </div>

                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-lg"
                                style="background-color: var(--primary); color: white; border: none;">
                                Submit
                            </button>
                        </div>

                    </form>

                </div>

            </main>

            @include('frontend.layouts.right_sidebar')
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const captchaDisplay = document.getElementById('captcha-display');
                const reloadButton = document.getElementById('reload-captcha');

                // Function to load captcha
                function loadCaptcha() {
                    fetch('{{ route('frontend.contact.captcha') }}')
                        .then(response => response.json())
                        .then(data => {
                            captchaDisplay.textContent = data.captcha;
                        })
                        .catch(error => {
                            console.error('Error loading captcha:', error);
                        });
                }

                // Load captcha on page load
                loadCaptcha();

                // Reload captcha on button click
                reloadButton.addEventListener('click', function() {
                    loadCaptcha();
                });
            });
        </script>
    @endpush
@endsection
