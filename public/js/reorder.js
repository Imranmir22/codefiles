jQuery.noConflict();

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