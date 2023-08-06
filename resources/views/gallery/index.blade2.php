@extends('layouts.app')
@section('content')


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

    <h1 class="text-center" id="fff">Gallery</h1>
    <div id="sortable-list1 ui-widget-content">

        @foreach($galleryImages->chunk(4) as $chunk)
        <div class="row mt-4 " id="sortable-list"> 
        @foreach ($chunk as $image)
            <div class="sortable-item col-md-2 mb-3" id="draggable{{ $image->id }}"  onload="dragimage($image->id)"  data-id="{{ $image->id }}">
                <img src="{{ asset($image->file_path) }}" class="card-img-top rounded-circle w-50 h-55" alt="Image 2">
            </div>
        @endforeach
        
        <!-- Repeat the above card structure for each uploaded image -->
        </div>
        @endforeach
    </div>
  </div>

@push('js')
<script type="text/javascript">
jQuery.noConflict();
(function($){ 
dragimage()
function dragimage(id)
{
    let drag = $( '.sortable-item').draggable({
     revert: "valid",
     drag: function (event, ui) {   
        var item_id = $(ui.draggable).attr('id');
         console.log('dddddd',item_id)
     }
});
}
   



})(jQuery);

</script>
@endsection
