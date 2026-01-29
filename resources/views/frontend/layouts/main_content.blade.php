<main class="col-lg-6 order-lg-2 main-content">

    <div class="link-item">
        @foreach ($links as $link)
            <h5 class="link-title">{{  $link->title }}</h5>
            <p class="link-desc">{{  $link->description }}<br>
                <small><a href="{{  $link->url }}" class="">{{  $link->url }}</a> – <a
                        href="{{  route('frontend.link-details', $link) }}">Read
                        more</a></small>
            </p>
        @endforeach
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            {{ $links->links() }}
        </ul>
    </nav>

</main>