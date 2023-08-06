@extends('layouts.app')
@section('content')

<style>
    body {
      font-family: Arial, sans-serif;
    }
    .gallery {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      padding: 20px;
    }
    .image-box {
      width: 110px;
      height: 147px;
      border: 2px dashed #ccc;
      cursor: grab;
    }
    img {
      max-width: 100%;
      max-height: 100%;
      display: block;
    }
  </style>


<div class="container mt-5">

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
   Upload Images
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Upload Images</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <input type="file" name="images[]" multiple>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <div class="gallery" id="gallery">
    @foreach($galleryImages  as $key=>$chunk)
    <div class="image-box"  data-id="{{ $chunk->id }}">
      <img src="{{ $chunk->file_path }}" id="{{ $chunk->id }}"  alt="Image 1">
    </div>
    @endforeach
   
  </div>
</div>
<script src="{{ asset('js/reorder.js') }}"></script>
@endsection