@extends('layouts.admin')
@section('title', 'Add Blog')
@section('page-title', '✏️ Add New Blog')

@section('content')
<div style="max-width: 860px;">
    <div class="form-card">
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label">Title <span>*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter blog title..." required>
                @error('title')<div class="error-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Category <span>*</span></label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select category...</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Blog Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*" id="imageInput">
                    <img id="img-preview" class="img-preview" alt="Preview">
                    <div class="form-hint">JPEG, PNG, WebP – Max 2MB</div>
                    @error('image')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Short Description <span>*</span></label>
                <textarea name="short_description" class="form-control" rows="3" placeholder="Brief summary shown on blog listing page..." required>{{ old('short_description') }}</textarea>
                @error('short_description')<div class="error-msg">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Full Content <span>*</span></label>
                <textarea name="content" id="content-editor" class="form-control" rows="12" placeholder="Write your full blog content here... (HTML supported)" required>{{ old('content') }}</textarea>
                <div class="form-hint">You can use basic HTML tags like &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;strong&gt;, &lt;a&gt;</div>
                @error('content')<div class="error-msg">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', '1') ? 'checked' : '' }}>
                    <label for="is_published" style="font-weight:600; font-size:0.9rem;">Publish immediately</label>
                </div>
                <div class="form-hint">Uncheck to save as draft</div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Publish Blog</button>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline">Cancel</a>
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
