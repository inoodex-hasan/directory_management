@extends('frontend.layouts.master')

@section('content')

  <div class="container-xl my-4">
    <div class="row g-4">

      @include('frontend.layouts.left_sidebar')

      <main class="col-lg-6 order-lg-2 main-content">

        <div class="content">
          @foreach ($links as $link)
            <div class="link-detail-block mb-4 border-bottom pb-3">
              <div class="detail-row">
                <div class="label">Site Hosting ID:</div>
                <div class="value">{{ $link->id }}</div>
              </div>

              <div class="detail-row">
                <div class="label">Web Host Title:</div>
                <div class="value">
                  {{ $link->title }} <br> <a href="{{ $link->url }}">{{ $link->url }}</a>
                </div>
              </div>

              <div class="detail-row">
                <div class="label">Description:</div>
                <div class="value">
                  {{ Str::limit($link->description, 50, '...') }}
                </div>
              </div>

              <div class="detail-row">
                <div class="label">Category:</div>
                <div class="value">{{ $link->category->title }}</div>
              </div>

              <div class="detail-row">
                <div class="label">URL by:</div>
                <div class="value">{{ $link->user->name }}</div>
              </div>

              <div class="detail-row">
                <div class="label">Date Added:</div>
                <div class="value">{{ $link->created_at->format('F j, Y') }}</div>
              </div>

              <div class="detail-row">
                <div class="label">Number Hits:</div>
                <div class="value">
                  <span class="highlight">{{ $link->hits }}</span>
                  <span class="hits">Hits</span>
                </div>
              </div>
            </div>
          @endforeach

          <!-- Pagination -->
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              @if(method_exists($links, 'links'))
                {{ $links->links() }}
              @endif
            </ul>
          </nav>
        </div>
      </main>

      @include('frontend.layouts.right_sidebar')

    </div>
  </div>

@endsection