@extends('layouts.app')

@section('title', 'BlogYaari – Latest Sarkari Updates')

@section('content')

<div class="hero">
    <h1>Latest <span>Sarkari</span> Updates</h1>
    <p>Admit Cards, Results, Notifications, Syllabus – सब कुछ एक जगह</p>
</div>

<div class="filter-section">
    <div class="filter-inner">
        <span class="filter-label"><i class="fas fa-filter"></i> Filter</span>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="search-input" placeholder="Search blogs...">
        </div>
        <select class="filter-select" id="category-filter">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
        <input type="date" class="filter-date" id="date-filter">
        <button class="btn-reset" id="reset-filters"><i class="fas fa-times"></i> Reset</button>
    </div>
    <div class="category-pills">
        <span class="pill active" data-id="">All</span>
        @foreach($categories as $cat)
            <span class="pill" data-id="{{ $cat->id }}">{{ $cat->name }}</span>
        @endforeach
    </div>
</div>

<div class="main-container">
    <div class="content-grid">
        <!-- Blog Listing -->
        <div>
            <div class="blogs-header">
                <h2>📰 Latest Posts</h2>
                <span class="result-count" id="result-count">{{ $blogs->total() }} posts found</span>
            </div>
            <div class="blogs-wrapper">
                <div class="loading-overlay" id="loading">
                    <div class="spinner"></div>
                </div>
                <div id="blogs-container">
                    @include('blog.partials.blog-cards', ['blogs' => $blogs])
                </div>
            </div>
            <!-- Pagination (hidden during AJAX) -->
            <div class="pagination-wrapper" id="pagination-wrapper">
                {{ $blogs->links('blog.partials.pagination') }}
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-card">
                <div class="sidebar-card-header"><i class="fas fa-th-large"></i> Categories</div>
                <div class="sidebar-card-body">
                    @foreach($categories as $cat)
                    <div class="cat-item" onclick="filterByCategory('{{ $cat->id }}', '{{ $cat->name }}')">
                        <span class="cat-name">{{ $cat->name }}</span>
                        <span class="cat-count">{{ $cat->blogs_count }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="sidebar-card">
                <div class="sidebar-card-header"><i class="fas fa-info-circle"></i> About</div>
                <div class="sidebar-card-body">
                    <p style="font-size:0.87rem; color: var(--gray-700); line-height:1.7;">
                        <strong>BlogYaari</strong> brings you the latest updates on Sarkari Jobs, Results, Admit Cards, and more. Stay updated!
                    </p>
                </div>
            </div>
        </aside>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const AJAX_URL = '{{ route("blog.index") }}';
    let filterTimer;

    function showLoading() { $('#loading').css('display','flex'); }
    function hideLoading() { $('#loading').hide(); }

    function doFilter() {
        const search   = $('#search-input').val().trim();
        const catId    = $('#category-filter').val();
        const date     = $('#date-filter').val();

        showLoading();
        $.ajax({
            url: AJAX_URL,
            type: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            data: { search, category_id: catId, date },
            success(res) {
                $('#blogs-container').html(res.html);
                $('#result-count').text(res.count + ' posts found');
                // Hide pagination during filter
                if (search || catId || date) {
                    $('#pagination-wrapper').hide();
                } else {
                    $('#pagination-wrapper').show();
                }
            },
            error() {
                $('#blogs-container').html('<div class="empty-state"><i class="fas fa-exclamation-circle"></i><h3>Something went wrong</h3><p>Please try again.</p></div>');
            },
            complete() { hideLoading(); }
        });
    }

    // Debounced search
    $('#search-input').on('input', function() {
        clearTimeout(filterTimer);
        filterTimer = setTimeout(doFilter, 350);
    });

    // Instant filter on select/date change
    $('#category-filter, #date-filter').on('change', function() {
        // Sync pills with select
        const val = $('#category-filter').val();
        $('.pill').removeClass('active');
        $(`.pill[data-id="${val}"]`).addClass('active');
        doFilter();
    });

    // Category pills
    $('.pill').on('click', function() {
        const id = $(this).data('id');
        $('.pill').removeClass('active');
        $(this).addClass('active');
        $('#category-filter').val(id);
        doFilter();
    });

    // Reset
    $('#reset-filters').on('click', function() {
        $('#search-input').val('');
        $('#category-filter').val('');
        $('#date-filter').val('');
        $('.pill').removeClass('active');
        $('.pill[data-id=""]').addClass('active');
        doFilter();
    });

    // Sidebar category click
    function filterByCategory(id, name) {
        $('#category-filter').val(id);
        $('.pill').removeClass('active');
        $(`.pill[data-id="${id}"]`).addClass('active');
        window.scrollTo({ top: 0, behavior: 'smooth' });
        doFilter();
    }
</script>
@endsection
