@extends('layouts.app')

@section('title', $blog->title . ' – BlogYaari')

@section('head')
<style>
    .blog-detail-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px 20px;
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 28px;
        align-items: start;
    }
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.82rem;
        color: var(--gray-500);
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .breadcrumb a { color: var(--saffron); text-decoration: none; }
    .breadcrumb a:hover { text-decoration: underline; }
    .blog-article {
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        overflow: hidden;
    }
    .blog-hero-img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        background: linear-gradient(135deg, var(--navy) 0%, #1a3a5c 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 5rem;
        color: rgba(255,255,255,0.15);
    }
    .blog-hero-img img { width: 100%; height: 100%; object-fit: cover; }
    .blog-article-body { padding: 30px; }
    .blog-category-badge {
        display: inline-block;
        background: var(--saffron);
        color: white;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 14px;
    }
    .blog-article-title {
        font-family: 'Baloo 2', cursive;
        font-size: clamp(1.4rem, 4vw, 2rem);
        font-weight: 800;
        color: var(--navy);
        line-height: 1.3;
        margin-bottom: 14px;
    }
    .blog-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 14px 0;
        border-top: 1px solid var(--gray-200);
        border-bottom: 1px solid var(--gray-200);
        margin-bottom: 24px;
    }
    .blog-meta span {
        font-size: 0.82rem;
        color: var(--gray-500);
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .blog-content {
        font-size: 1rem;
        line-height: 1.85;
        color: #333;
    }
    .blog-content h2, .blog-content h3, .blog-content h4 {
        font-family: 'Baloo 2', cursive;
        color: var(--navy);
        margin: 24px 0 12px;
    }
    .blog-content p { margin-bottom: 16px; }
    .blog-content ul, .blog-content ol { padding-left: 24px; margin-bottom: 16px; }
    .blog-content li { margin-bottom: 6px; }
    .blog-content strong { color: var(--navy); }
    .share-bar {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .share-bar span { font-size: 0.85rem; font-weight: 600; color: var(--gray-500); }
    .share-btn {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        border: none;
        color: white;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .share-btn.whatsapp { background: #25D366; }
    .share-btn.twitter { background: #1DA1F2; }
    .share-btn.copy { background: var(--navy); cursor: pointer; }
    /* Related posts */
    .related-section {
        margin-top: 30px;
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        overflow: hidden;
    }
    .section-header {
        background: var(--navy);
        padding: 14px 20px;
        font-family: 'Baloo 2', cursive;
        font-weight: 700;
        color: white;
        font-size: 0.95rem;
    }
    .related-list { padding: 0; }
    .related-item {
        display: flex;
        gap: 12px;
        padding: 14px 20px;
        border-bottom: 1px solid var(--gray-100);
        text-decoration: none;
        transition: background 0.2s;
    }
    .related-item:last-child { border-bottom: none; }
    .related-item:hover { background: var(--off-white); }
    .related-thumb {
        width: 60px; height: 60px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--navy), #1a3a5c);
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.3);
        font-size: 1.4rem;
        flex-shrink: 0;
        overflow: hidden;
    }
    .related-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .related-info .related-title {
        font-family: 'Baloo 2', cursive;
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .related-date { font-size: 0.75rem; color: var(--gray-500); margin-top: 4px; }
    @media (max-width: 900px) {
        .blog-detail-wrapper { grid-template-columns: 1fr; }
    }
    @media (max-width: 600px) {
        .blog-article-body { padding: 18px; }
        .blog-hero-img { height: 220px; }
    }
</style>
@endsection

@section('content')
<div style="background: var(--navy); padding: 16px 0; margin-bottom: 0;">
    <div style="max-width:1200px; margin:0 auto; padding: 0 20px;">
        <div class="breadcrumb" style="margin: 0; color: rgba(255,255,255,0.5);">
            <a href="{{ route('blog.index') }}" style="color: rgba(255,255,255,0.7);">Home</a>
            <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i>
            <span style="color: var(--saffron);">{{ $blog->category->name ?? 'Blog' }}</span>
            <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i>
            <span style="color: rgba(255,255,255,0.5); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 300px;">{{ Str::limit($blog->title, 50) }}</span>
        </div>
    </div>
</div>

<div class="blog-detail-wrapper">
    <div>
        <article class="blog-article">
            <div class="blog-hero-img">
                @if($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                @else
                    <i class="fas fa-newspaper"></i>
                @endif
            </div>
            <div class="blog-article-body">
                <span class="blog-category-badge">{{ $blog->category->name ?? 'General' }}</span>
                <h1 class="blog-article-title">{{ $blog->title }}</h1>
                <div class="blog-meta">
                    <span><i class="fas fa-calendar-alt"></i> {{ $blog->created_at->format('d F Y') }}</span>
                    <span><i class="fas fa-clock"></i> {{ $blog->created_at->diffForHumans() }}</span>
                    <span><i class="fas fa-tag"></i> {{ $blog->category->name ?? '—' }}</span>
                </div>
                <div class="blog-content">
                    {!! $blog->content !!}
                </div>
                <div class="share-bar">
                    <span><i class="fas fa-share-alt"></i> Share:</span>
                    <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->url()) }}" target="_blank" class="share-btn whatsapp">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(request()->url()) }}" target="_blank" class="share-btn twitter">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
                    <button class="share-btn copy" onclick="copyLink()">
                        <i class="fas fa-copy"></i> <span id="copy-text">Copy Link</span>
                    </button>
                </div>
            </div>
        </article>

        @if($related->count())
        <div class="related-section" style="margin-top: 24px;">
            <div class="section-header"><i class="fas fa-bookmark"></i> Related Posts</div>
            <div class="related-list">
                @foreach($related as $r)
                <a href="{{ route('blog.show', $r->slug) }}" class="related-item">
                    <div class="related-thumb">
                        @if($r->image)
                            <img src="{{ asset('storage/' . $r->image) }}" alt="{{ $r->title }}">
                        @else
                            <i class="fas fa-newspaper"></i>
                        @endif
                    </div>
                    <div class="related-info">
                        <div class="related-title">{{ $r->title }}</div>
                        <div class="related-date"><i class="fas fa-calendar-alt"></i> {{ $r->created_at->format('d M Y') }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-card">
            <div class="sidebar-card-header"><i class="fas fa-th-large"></i> Categories</div>
            <div class="sidebar-card-body">
                @foreach($categories as $cat)
                <a href="{{ route('blog.index') }}?category_id={{ $cat->id }}" style="text-decoration:none;">
                    <div class="cat-item">
                        <span class="cat-name">{{ $cat->name }}</span>
                        <span class="cat-count">{{ $cat->blogs_count }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </aside>
</div>
@endsection

@section('scripts')
<script>
function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        $('#copy-text').text('Copied!');
        setTimeout(() => $('#copy-text').text('Copy Link'), 2000);
    });
}
</script>
@endsection
