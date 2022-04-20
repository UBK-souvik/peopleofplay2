
<style type="text/css">
   #image-list li {
   list-style-type: none;
   display: inline-block;
   }
   #image-list li img {
   margin:5px;
   }
   #image-list li span {
   text-align: center;
   display: inline-block;
   }
   #sequanceUpdateBtn {
   font-size: 15px !important;
   font-weight: 400 !important;
   box-shadow: 2px 3px 6px #808080 !important;
   width: auto !important;
   }

   #exampleModalLabel span {
    font-size: 11px !important;
    font-weight: 400 !important;
   }
   
  .modal-title {
     line-height: 1rem !important;
  }
</style>
<div class="modal-header ">
   <h5 class="modal-title" id="exampleModalLabel">
    @if(@$type == 2) Video @else Photo @endif  Gallery 
    <br>
    <span>Please drag to change the image position.</span>
  </h5>
   
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body ">
   <div id="txtresponse" ></div>
   <ul id="image-list">
      @foreach ($gallay_images as $image)
      @if($type == 2) 
      <?php   $GetAPI = @GetYoutubeAPI(@$image['media']);
         $thumbnail = @$GetAPI['thumbnail']['thumb'];
         $thumbnail_title = @$GetAPI['title']; ?>
      <li id="image_{{ @$image['id'] }}" > 
         <img width="100px" src="{{ @$thumbnail }}" alt="{{ @$image['title'] }}" class="img-fluid">
      </li>
      @else 
      <li id="image_{{ @$image['id'] }}" > 
         <img width="100px" src="{{ @galleryImageBasePath(@$image['media']) }}" alt="{{ @$image['title'] }}" class="img-fluid">
      </li>
      @endif
      @endforeach
   </ul>
</div>
<div class="modal-footer">
   <button type="button" class="btn btn-primary" id="sequanceUpdateBtn"> Update <i class="fa fa-spinner fa-spin st_loading" style="display: none;"></i></button>
</div>

<script type="text/javascript" src="{{ asset('front/js/touch-dnd.js') }}"></script>
<script type="text/javascript">
$(function() {
   var dropIndex;
   $("#image-list").sortable({
       connectWith: '.droppable',
        update: function(event, ui) { 
           dropIndex = ui.item.index();
       }
   })
   .on('sortable:receive', function(e, ui) {
      ui.item.removeClass('draggable')
    })

   $('.draggable').draggable({ connectWith: '#image-list' })
    $('.droppable').droppable({ activeClass: 'active', hoverClass: 'drop-here' })
   


   $('#sequanceUpdateBtn').click(function (e) {
   	$('.st_loading').show();
       var imageIdsArray = [];
       $('#image-list  li').each(function (index) {
           //if(index <= dropIndex) {
               var id = $(this).attr('id');
               var split_id = id.split("_");
               imageIdsArray.push(split_id[1]);
          // }
       });
   
       $.ajax({
            url: "{{route('front.user.gallery.update_sequance_image_data')}}",
           type: 'post',
           data: {'imageIds': imageIdsArray ,'_token':'{{ csrf_token() }}'},
           success: function (response) {
              $("#txtresponse").css('display', 'inline-block'); 
              $("#txtresponse").text(response);
              $('#imageProfileSQModal').modal('hide');
              $('#imageProfileSQModal .content-images').html();
              location.reload();
              $('.st_loading').hide();
           }
       });
       e.preventDefault();
       	// $('.st_loading').hide();
   });
      });
</script>