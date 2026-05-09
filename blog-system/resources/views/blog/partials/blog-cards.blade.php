@forelse($blogs as $blog)
<div class="blog-card" style="animation-delay: {{ $loop->index * 0.05 }}s">
    <div class="blog-card-img">
        @if($blog->image)
            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" loading="lazy">
        @else
            <i class="fas fa-newspaper placeholder-icon"></i>
        @endif
        <span class="blog-card-category">{{ $blog->category->name ?? 'General' }}</span>
    </div>
    <div class="blog-card-body">
        <div class="blog-card-meta">
            <span><i class="fas fa-calendar-alt"></i> {{ $blog->created_at->format('d M Y') }}</span>
        </div>
        <div class="blog-card-title">{{ $blog->title }}</div>
        <div class="blog-card-desc">{{ $blog->short_description }}</div>
        <a href="{{ route('blog.show', $blog->slug) }}" class="blog-card-link">
            Read More <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</div>
@empty
<div class="empty-state">
    <i class="fas fa-search"></i>
    <h3>No blogs found</h3>
    <p>Try different search terms or filters.</p>
</div>
@endforelse
