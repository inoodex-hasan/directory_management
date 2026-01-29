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

                <h4 class="mb-4 text-center" style="color: var(--primary);">Submit Your Website</h4>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="form-section">

                    <form action="{{ route('frontend.submit_link.submit') }}" method="POST">

                        @csrf

                        <div class="mb-4">
                            <h5 class="mb-3" style="color: var(--primary);">Pricing Options</h5>
                            <div class="d-flex flex-column gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pricing" id="featured"
                                        value="featured">
                                    <label class="form-check-label" for="featured">
                                        Featured links (Guaranteed Approval in 1-2 days) — $19.99 / Year
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pricing" id="regular" value="regular"
                                        checked>
                                    <label class="form-check-label" for="regular">
                                        Standard links (Reviewed in about 7 days) — $1.99 / Month
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pricing" id="reciprocal"
                                        value="reciprocal">
                                    <label class="form-check-label" for="reciprocal">
                                        Regular links (Reviewed in 2 Weeks ) — <strong>free</strong>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row g-3">

                            <div class="col-md-12">
                                <label for="title" class="form-label">
                                    Title <span class="required-star">*</span>
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                    name="title" required value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="url" class="form-label">
                                    URL <span class="required-star">*</span>
                                </label>
                                <input type="url" class="form-control @error('url') is-invalid @enderror" id="url"
                                    name="url" required value="{{ old('url') }}">
                                @error('url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                    name="description" rows="4" maxlength="1000">{{ old('description') }}</textarea>
                                <div class="form-text text-muted text-end">Limit: 1000 characters</div>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="col-md-12">
                                <label for="keywords" class="form-label">Keywords <small>(Separate keywords by
                                        comma)</small></label>
                                <textarea class="form-control" id="keywords" name="keywords" rows="2"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="meta-description" class="form-label">META Description</label>
                                <textarea class="form-control" id="meta-description" name="meta-description" rows="3"
                                    maxlength="250"></textarea>
                                <div class="form-text text-muted text-end">Limit: 250 characters</div>
                            </div> --}}

                            <div class="col-md-6">
                                <label for="name" class="form-label">
                                    Your Name <span class="required-star">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" required value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    Your Email <span class="required-star">*</span>
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" required value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="category" class="form-label">
                                    Category <span class="required-star">*</span>
                                </label>
                                <select class="form-select @error('category') is-invalid @enderror" id="category"
                                    name="category" required>
                                    <option value="" selected disabled>Select category...</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <hr class="my-4">

                        {{-- <h5 class="mb-3" style="color: var(--primary);">Reciprocal Link</h5>
                        <p class="text-muted small">
                            To validate the reciprocal link please include the following HTML code on your website's
                            Home Page or Index Page:
                        </p>
                        <div class="bg-light p-3 rounded mb-3 font-monospace small">
                            &lt;a href="https://www.ewebdiscussion.com/forums/web-hosting-offers.67/"&gt;Web
                            Hosting&lt;/a&gt;
                        </div>

                        <div class="mb-3">
                            <label for="reciprocal-url" class="form-label">
                                Reciprocal Link URL <span class="required-star">*</span>
                            </label>
                            <input type="url" class="form-control" id="reciprocal-url" name="reciprocal-url"
                                placeholder="https://your-site.com" required>
                        </div> --}}

                        <div class="mb-4">
                            <label class="form-label">
                                Enter the code shown <span class="required-star">*</span>
                            </label>
                            <div class="captcha-box mb-2">
                                <span class="captcha" id="captcha-display"></span>
                                <button type="button" class="btn btn-sm btn-secondary reload-captcha" title="Reload Captcha"
                                    id="reload-captcha">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control @error('captcha') is-invalid @enderror" name="captcha"
                                required placeholder="Enter the code above">
                            @error('captcha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted mt-1">
                                This helps prevent automated registrations.
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="agreement" name="agreement" required>
                            <label class="form-check-label" for="agreement">
                                I AGREE with the Web Hosting directory submission rules
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg" style="background: var(--primary); color: white;">
                                Continue
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
            document.addEventListener('DOMContentLoaded', function () {
                const captchaDisplay = document.getElementById('captcha-display');
                const reloadButton = document.getElementById('reload-captcha');

                // Function to load captcha
                function loadCaptcha() {
                    fetch('{{ route('frontend.submit_link.captcha') }}')
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
                reloadButton.addEventListener('click', function () {
                    loadCaptcha();
                });
            });
        </script>
    @endpush
@endsection