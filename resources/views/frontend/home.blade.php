@extends('frontend.layouts.master')

@section('content')
    <!-- Main Container -->
    <div class="container-xl my-4">
        <div class="row g-4">

            @include('frontend.layouts.left_sidebar')

            @include('frontend.layouts.main_content')

            @include('frontend.layouts.right_sidebar')

        </div>
    </div>
@endsection