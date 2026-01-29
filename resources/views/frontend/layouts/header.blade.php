<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Site Promotion Directory – Art History</title>



    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/main.css') }}">

    @stack('styles')

</head>

<body>

    <!-- Header + Navigation -->
    <header class="site-header sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light container-xl">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <i class="fas fa-palette me-2"></i>Site Promotion Directory
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('frontend.submit_link') }}">Submit
                                Link</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('frontend.login') }}">Login </a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('frontend.register') }}">Register</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('frontend.contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
