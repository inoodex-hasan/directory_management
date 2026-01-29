<!-- Left Sidebar (Categories + Stats) -->
<div class="col-lg-3 order-lg-1 sidebar">

    <div class="sidebar-section">
        <h5 class="sidebar-title">Top Categories</h5>
        <div class="category-list">
            @foreach ($categories as $category)
                {{-- <div class="category-item d-flex justify-content-between align-items-center mb-2"> --}}
                <a href="{{ route('category.posts', $category->slug) }}">{{ $category->title }}</a>
                <span class="badge bg-primary rounded-pill">{{ $category->posts_count }}</span>
                {{-- </div> --}}
            @endforeach
        </div>
    </div>

    <div class="sidebar-section stats-box">
        <h5 class="sidebar-title">Statistics</h5>
        <div class="mb-2"><strong>Active Links:</strong> 73,737</div>
        <div class="mb-2"><strong>Pending Links:</strong> 371</div>
        <div><strong>Active Articles:</strong> 45,562</div>
    </div>

</div>
