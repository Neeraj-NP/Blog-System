@extends('layouts.admin')
@section('title', 'Edit Blog')
@section('page-title', '✏️ Edit Blog')

@section('content')
<div style="max-width: 860px;">
    <div class="form-card">
        <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="form-group">
                <label class="form-label">Title <span>*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
                @error('title')<div class="error-msg">{{ $message }}</div>@enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Category <span>*</span></label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select category...</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $blog->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Blog Image</label>
                    @if($blog->image)
                        <div style="margin-bottom:8px;">
                            <img src="{{ asset('storage/' . $blog->image) }}" style="max-width:120px; border-radius:8px;">
                            <div class="form-hint">Current image</div>
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*" id="imageInput">
                    <img id="img-preview" class="img-preview" alt="Preview">
                    <div class="form-hint">Leave empty to keep current image</div>
                    @error('image')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Short Description <span>*</span></label>
                <textarea name="short_description" class="form-control" rows="3" required>{{ old('short_description', $blog->short_description) }}</textarea>
                @error('short_description')<div class="error-msg">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Full Content <span>*</span></label>
                <textarea name="content" class="form-control" rows="12" required>{{ old('content', $blog->content) }}</textarea>
                @error('content')<div class="error-msg">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                    <label for="is_published" style="font-weight:600; font-size:0.9rem;">Published</label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Blog</button>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline">Cancel</a>
                <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-outline" style="margin-left:auto;">
                    <i class="fas fa-eye"></i> View Live
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('imageInput').addEventListener('change', function() {
    const preview = document.getElementById('img-preview');
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(this.files[0]);
    }
});
</script>
@endsection
