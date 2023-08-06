<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Draggable Image Gallery</title>
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
</head>
<body>
  <div class="gallery" id="gallery">
    @foreach($galleryImages  as $key=>$chunk)
    <div class="image-box"  data-id="{{ $chunk->id }}">
      <img src="{{ $chunk->file_path }}" id="{{ $chunk->id }}"  alt="Image 1">
    </div>
    @endforeach
   
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      let draggedImage = null;

      $('.image-box').on('dragstart', function(event) {
        const targetImagenext = $(this);
        draggedImage = $(this);
      });

      $('.image-box').on('dragover', function(event) {
        event.preventDefault();
      });

      $('.image-box').on('drop', function(event) {
        event.preventDefault();
        
        if (draggedImage) {
          const targetImage = $(this);
          const temp = $('<div>').insertBefore(targetImage);
          draggedImage.insertAfter(targetImage);
          temp.replaceWith(targetImage);
          draggedImage = null;
        }

        var newOrder = [];
        $('.image-box').each(function(index) {
            var itemId = $(this).data("id");
            // var id = $(this).attr("id");
            newOrder.push(itemId);
        });
        $.ajax({
            url: "/reorder",
            method: "GET",
            data: { order: newOrder },
            success: function(response) {
                console.log(response.message);
            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
        
        console.log('neworder',newOrder)
    });
    });
  </script>
</body>
</html>
