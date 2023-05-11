@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Post</h1>
  </div> 
<div class="col-lg-8">
 
    <form method="post" action="/dashboard/posts" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="image" class="form-label">Profil Picture</label>
          <img class="img-preview img-fluid mb-3 col-sm-5">
          <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" 
          name="image" onchange="previewImage()">
          @error('image') 
          <div class="alert alert-danger"> {{ $message }}</div>
          @enderror
        </div>
      <div class="mb-3">
        <label for="title" class="form-label">Academic</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
        @error('title') 
        <div class="alert alert-danger"> {{ $message }}</div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="category" class="form-label">Discipline</label>
        <select class="form-select @error('category') is-invalid @enderror" name="category_id">
            @foreach ($categories as $category)
            @if (old('category_id') == $category->id)
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>    
            @else
            <option value="{{ $category->id }}">{{ $category->name }}</option>    
            @endif
            @endforeach
          </select>
      </div>

      <div class="mb-3">
        <label for="slug" class="form-label">Location</label>
        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
        @error('slug') 
        <div class="alert alert-danger"> {{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" value="{{ old('body') }}">
        @error('body') 
        <div class="alert alert-danger"> {{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
        fetch('/dashboard/posts/checkSlug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    function previewImage() {
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);

      oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
      }
    }
</script>
@endsection