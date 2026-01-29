<!-- Right Sidebar (Latest Articles & Links) -->
<div class="col-lg-3 order-lg-3  sidebar">

    <!-- for advertising  -->
    <div class="advertising">
        <h5 class="  mb-1">For Ads</h5>
        <a href="https://inoodex.com" target="_blank">
            Contact with Inoodex
        </a>

    </div>

    <hr class="my-2">

    <h5 class="sidebar-title mb-3">Latest Articles</h5>
    @foreach ($sidebar_blogs as $blog)
        <div class="latest-item">
            <div>{{ $blog->title }}</div>
            <small>{{ $blog->subtitle }}</small>
        </div>
    @endforeach

    <hr class="my-2">

    <h5 class="sidebar-title mb-3">Latest Links</h5>
    @foreach ($sidebar_links as $link)
        <div class="latest-item">
            <div>{{ $link->title }}</div>
            <small>{{ $link->url }}</small>
        </div>
    @endforeach
</div>