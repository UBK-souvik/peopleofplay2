<link rel="stylesheet" href="{{ asset('front/css/select2-bootstrap.css?'.time()) }}">
<link rel="stylesheet" href="{{ asset('front/cropperjs-main/croppie.min.css?'.time()) }}">
<link rel="stylesheet" href="{{ asset('front/new_css/feed_new.css?'.time()) }}">
<script src="{{asset('front/new/js/croppie.js?.time()') }}"></script>

{{--
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
  <link rel="stylesheet" href="{{ asset('front/new_css/feed_new.css?'.time()) }}">
  <script src="{{asset('front/new/js/croppie.js?.time()') }}"></script>   -->
--}}
<style type="text/css">
  .upload-btn-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
  }

  .cr-boundary {
    display: none;
  }
  .cr-slider{
    display: none;
  }
  .upload-result {
    display: none;
  }

  .image-preview {
    display: none;
  }

   .upload-result1 {
    display: none;
  }

  .image-preview1 {
    display: none;
  }

  .btn {
    border: 2px solid gray;
    color: gray;
    background-color: white;
    padding: 8px 20px;
    border-radius: 8px;
    font-size: 20px;
    font-weight: bold;
  }

  .upload-btn-wrapper input[type=file] {
    font-size: 100px;
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
  }

  .reset-crop {
    width: 100px;
    font-size: 12px;
    text-align: center;
  }
  .align-items-center {
    -ms-flex-align: center!important;
    align-items: center!important;
    display: flex;
    justify-content: center;
}
  .upload-result{
        width: 120px;
        font-size: 12px;
        background-color: #662e91;
        color: #fff;
  }
  input[type=file] {
    width: 100% !important;
  }
  button.close {
      outline: 0;
      box-shadow: none;
      border: 0;
  }
</style>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Submit Toy & Game News </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="popFeedImageForm">
            <form id="imagefeedForm"  onsubmit="submit_news_feeds(this); return false;" method="POST" class="popFeedImage" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <input id="Title" type="text" name="title" class="form-control" placeholder="Title" value="">
                    <span class="errText" style="display:none;"></span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea class="form-control" rows="3" id="Caption" placeholder="Caption" value="" name="caption"></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <input id="link" type="text" name="link" class="form-control" value="" placeholder="Link">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <input id="VideoUrl" type="text" name="video_url" class="form-control" placeholder="Video URL" onchange="getYoutubeThumbnailfeed(this);">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="popTag">
                      <select name="category" id="select2-multiple-input-sm" class="form-control input-sm select2-multiple category_Id" onchange="showSubcategory(this); return false;">
                        <option value="">--Select Category--</option>
                        @foreach ($feeds_categorys as $feeds_category)
                          <option value="{{$feeds_category->id}}">{{$feeds_category->name}}</option>
                        @endforeach
                      </select>
                      <span class="errText" style="display:none;"></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 rip_categorys" style="display:none;">
                  <div class="form-group">
                    <div class="popTag">
                      <select name="rip_category" class="form-control input-sm select2-multiple rip_category_Id">
                        <option value="">--Select RIP Decades--</option>
                        @foreach ($rip_categories as $rip_categorie)
                          <option @if($rip_categorie->id == @$news_Feeds->rip_category_id){{ 'selected' }}@endif value="{{$rip_categorie->id}}">{{ ucwords($rip_categorie->name) }}</option>
                        @endforeach
                      </select>
                      <span class="errText" style="display:none;"></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="popTag">
                      <select name="secondary_category" id="select2-multiple-input-sm" class="form-control input-sm select2-multiple sec_category_Id">
                        <option value="">--Select Secondary Category--</option>
                        @foreach ($feeds_categorys as $feeds_category)
                          <option value="{{$feeds_category->id}}">{{$feeds_category->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <img src="{{asset('front/new/images/Product/team_new.png')}}" class="imgHundred" alt="" id="blah">
                    <input type="file" name="featured_image" class="marginTopFive" onchange="readURL(this,'blah');">
                  </div>
                </div>
              </div>
              <div class="popPostBtn text-center mt-2 mb-2">
                <button type="submit" class="btn btn-style-post">POST <i class="fa fa-circle-o-notch fa-spin postLoading" style="display: none;"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<style>
  .popFeedsModal .modal-dialog{
    min-height: auto;
    max-width: 500px !important;
}
.popFeedsModal .modal-content {
    padding: 0 0px;
}
.popFeedsModal .modal-content{
  padding:0px;
}
</style>
  <script type="text/javascript">

    function getYoutubeThumbnailfeed(e) {
      var youtube_url = $(e).val();
      $.ajax({
        url: "{{route('front.user.gallery.get_youtube_thumbnail')}}",
        data: {'_token':'{{ csrf_token() }}','video_url':youtube_url},
        dataType: 'json',
        type: 'POST',
        success: function (data) {
            if(data.success == 1){
              $('#thumbNailPreview').attr('src',data.thumbnail);
              $('#thumbNailPreview').css({'display':'inline'});
              $('#videoPreviewIcon').hide();
            } else {
            $('#add-gallery-image-upload-preview-onevideo').attr('src','');
            $('#thumbNailPreview').css({'display':''});
            $('#videoPreviewIcon').show();
            toastr.error(data.msg);
          }
        }
      });
    }

    function submit_news_feeds(e){
      $('.postLoading').show();
      $('.btn-style-post').attr('disabled',true);
      var form_ser = $(e)[0];
      var formData = new FormData(form_ser);
      $.ajax({
         url:"{{ route('front.feeds_news.submit_news_feeds') }}",
         headers: {
            'X-CSRF-TOKEN': ajax_csrf_token_new
         },
         type:"POST",
         data: formData,
         processData: false,
         contentType: false,
         dataType:'json',
         success:function(data){
            if(data.status == 0){
                var err = JSON.parse(data.response);
                var er = '';
                $.each(err, function(k, v) { 
                    er += v+'<br>'; 
                    $("[name="+k+"]").parent().addClass('errCount');
                    $("[name="+k+"]").next().html(v);
                    $("[name="+k+"]").next().show();

                    if(k == 'product_id' || k == 'video_url'){
                      $('.error-demo').addClass('errCount');
                      $('.error-demo .errText').show();
                    }
                    // console.log('key - '+k+' - err - '+er);
                }); 
                
                // toastr.error(er,'Error');
                $('.postLoading').hide();
                $('.btn-style-post').attr('disabled',false);
            }
            if(data.status == 1){
              $('.postLoading').hide();
              toastr.success(data.message);
              $('#popMemberContinue').modal('hide'); 
            }
         }
      });
    }

    function readURL(input,id) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id)
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }

    function showSubcategory(e){
      var text = $(".category_Id option:selected").text();
      if(text.search("RIP") >= 0){
        $('.rip_categorys').show();
      }else{
        $('.rip_category_Id').val('');
        $('.rip_categorys').hide();
      }
      
      var value = $(".category_Id option:selected").val();
      $(".sec_category_Id option").each(function(){
        if($(this).val() == value){
          $(".sec_category_Id option").removeAttr('disabled');
          $(this).attr('disabled',true);
        }
      });
      
    }

  </script>
   