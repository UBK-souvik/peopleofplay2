<!-- <link rel="stylesheet" href="{{asset('front/new/css/bootstrap.min.css') }}"> -->
<link rel="stylesheet" href="{{ asset('front/css/select2-bootstrap.css?'.time()) }}">
<link rel="stylesheet" href="{{ asset('front/cropperjs-main/croppie.min.css?'.time()) }}">
<link rel="stylesheet" href="{{ asset('front/new_css/feed_new.css?'.time()) }}">
<script src="{{asset('front/new/js/croppie.js?.time()') }}"></script>
 {{--
<!--  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
  <link rel="stylesheet" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">
 <link rel="stylesheet" href="{{ asset('front/new_css/feed_new.css?'.time()) }}">
 <script src="{{asset('front/new/js/croppie.js?.time()') }}"></script> 
-->
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
    /* width: 100px; */
    font-size: 10px;
    text-align: center;
    font-size: 10px;
    padding: 2px 3px;
  }
  .edit_image_preview{
    display: none;
  }
  .editImagePreview{
    display: block !important;
    object-fit: contain !important;
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
  
</style>
  <div class="PreLoader">
    <div class="d-table h-100 w-100">
        <div class="d-table-cell align-middle">
          <i class="fa fa-spin st_loader st_page_loading"></i>
        </div>
    </div>
  </div>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      @if($type_of_user == 1 && $role == 1)
        <div class="modal-header bg-warning">
          <h5 class="modal-title">Warning!!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-danger text-center mt-2">
            Yor are a free user, so you are not able to upload any post on feeds. If you want to upload post please upgrade your profile. <b><a href="{{route('front.plans', $role)}}">Change Plan</a></b>
          </div>
        </div>
      @else
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Post {{ @$title_type}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="feedIconsLists newsIconList">
            <ul class="nav IconsLists" style="justify-content: space-around;">
              <li class="nav-item">
                <a href="javascript:void(0);" class="nav-link clrYellow viewYellow newsViewYellow" onclick="feedTypeChange(this,4);">
                    <img src="{{ asset('front/images/pop_icons/3.png') }}" class="img-fluid">
                    <p>Media</p>
                </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link clrRed viewRed newsViewRed" href="javascript:void(0);" onclick="feedTypeChange(this,1)" >
                          <img src="{{ asset('front/images/pop_icons/1.png') }}" class="img-fluid">
                    <p class="mb-0">Photo</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link clrOrange viewOrange newsViewOrange" href="javascript:void(0);" onclick="feedTypeChange(this,2)">
                          <img src="{{ asset('front/images/pop_icons/2.png') }}" class="img-fluid">
                    <p class="mb-0">Video</p>
                  </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="container">
          <div class="popFeedImageForm">
              <form id="imagefeedForm"  onsubmit="newsFeedFormSubmit(this); return false;" method="POST" class="popFeedImage" enctype="multipart/form-data">
                  <input type="hidden" id="feedType" name="type" value="1">
                  <input type="hidden" id="page_type" name="page_type" value="{{$page_type}}">
                  @if(!empty($news_Feeds->id))
                    <input type="hidden" id="request_type" name="request_type_id" value="{{@$news_Feeds->id}}">
                  @else
                    <input type="hidden" id="request_type" name="request_type_id" value="0">
                  @endif
                  <div class="feedInputsInside">
                    <div class="feedViewData"></div>
                    <div class="row">
                      @if($page_type == 'news_feeds')
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="popTag">
                              <select name="category" id="select2-multiple-input-sm" class="form-control input-sm select2-multiple category_Id" onchange="showSubcategory(this); return false;">
                                <option value="">--Select Primary Category--</option>
                                @foreach ($feeds_categorys as $feeds_category)
                                  <option @if($feeds_category->id == @$news_Feeds->category_id){{ 'selected' }}@endif value="{{$feeds_category->id}}">{{$feeds_category->name}}</option>
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
                                  <option @if($feeds_category->id == @$news_Feeds->secondary_category_id){{ 'selected' }}@endif value="{{$feeds_category->id}}">{{$feeds_category->name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      @endif
                    </div>
                  @if(@$uinfo->is_news_feeds == 1 || $page_type != 'news_feeds')
                    <div class="row">
                        <div class="col-md-6 ">
                          <div class="form-group ">
                            <div class="popTag ">
                              <input type="text" id="Tag" name="tags" class="form-control" value="{{@$news_Feeds->tag}}" placeholder="Tags">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="popPeopleTag">
                            <div class="form-group">
                              <select name="peoples[]" id="select2-multiple-input-sm" class="form-control input-sm select2-multiple" multiple>
                              <?php 
                                $arr_peoples = explode(',',@$news_Feeds->tag_peoples);
                              ?>
                              @foreach ($people_list as $people_index => $people_value)
                              <option @if (!empty($arr_peoples) && in_array($people_value->id, $arr_peoples)){{ 'selected' }}  @endif value="{{$people_value->id}}">{{ucwords($people_value->first_name.' '.$people_value->last_name)}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="popProductsTag">
                          <div class="form-group">
                            <select name="products[]" id="select2-multiple-input-sm" class="form-control input-sm select2-multiple" multiple>
                              <?php 
                                $arr_products = explode(',',@$news_Feeds->tag_products);
                              ?>
                              @foreach ($product_list as $product_index => $product_value)
                              <option @if (!empty($arr_products) && in_array($product_index, $arr_products)){{ 'selected' }}  @endif value="{{$product_index}}">{{$product_value}}</option>
                              @endforeach

                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="popCompaniesTag">
                          <div class="form-group">
                            <select  name="companies[]" id="select2-multiple-input-sm" class="form-control input-sm select2-multiple" multiple>
                              <?php 
                                $arr_companys = explode(',',@$news_Feeds->tag_companies);
                              ?> 
                              @foreach ($company_list as $company_index => $company_value)
                              <option @if (!empty($arr_companys) && in_array($company_index, $arr_companys)){{ 'selected' }}  @endif value="{{$company_index}}">{{$company_value}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
            </div>
            <div class="popPostBtn text-center mt-2 mb-2">
              <span class="text-left"><input type="checkbox" name="add_to_feeds"> Add to home feed</span>
              <input type="hidden" name="news_feed_id" value="{{@$news_Feeds->id}}">
              <button type="submit" class="btn btn-style-post">POST <i class="fa fa-circle-o-notch fa-spin postLoading" style="display: none;"></i></button>
            </div>
          </form>
          </div>
        </div>
      @endif
    </div>
  </div>

  <script type="text/javascript">

                          
    $('.PreLoader').addClass('pre_loader_show');
    setTimeout(function(){
      
      // var text = $(".category_Id option:selected").text();
      // if(text.search("RIP") >= 0){
      //   $('.rip_categorys').show();
      // }
      showSubcategory('');

      var view_type = '{{$view_type}}';
      // alert(view_type);
      if(view_type != 0){
        feedTypeChange(this,view_type)  
      }else{
        feedTypeChange(this,1)  
      }
      $('.bootstrap-tagsinput input').attr('placeholder','Tags');
    },300);

    $(document).ready(function () {
      
      $("#imagefeedForm").bind("keypress", function (e) { 
        if(!$("#imagefeedForm").hasClass('enter_not_send')){
          if (e.keyCode == 13) {  
            return false;  
          }  
        } 
      }); 
      $("#productfeedForm").bind("keypress", function (e) { 
        if (e.keyCode == 13) {  
          return false;  
        }  
      });
      $("#mediafeedForm").bind("keypress", function (e) { 
        if (e.keyCode == 13) {  
          return false;  
        }  
      });
      $("#videofeedForm").bind("keypress", function (e) { 
        if (e.keyCode == 13) {  
          return false;  
        }  
      }); 

    });

  $(".popCategoryTag .select2-multiple ").select2({
    theme: "bootstrap ",
    placeholder: "Select Category ",
    containerCssClass: 'feedSelectInput',
    maximumSelectionLength: 2,
  });
  $(".popPeopleTag .select2-multiple ").select2({
    theme: "bootstrap ",
    placeholder: "Tag People ",
    containerCssClass: 'feedSelectInput'
  });
  $(".popProductsTag .select2-multiple ").select2({
    theme: "bootstrap ",
    placeholder: "Tag Product ",
    containerCssClass: 'feedSelectInput'
  });
  $(".popCompaniesTag .select2-multiple ").select2({
    theme: "bootstrap ",
    placeholder: "Tag Companies ",
    containerCssClass: 'feedSelectInput'
  });
    $(document).ready(function() {
  $('input[name="tags"]').tagsinput({
    trimValue: true,
    confirmKeys: [13, 44, 32],
    focusClass: 'my-focus-class'
  });

  $('.bootstrap-tagsinput input').on('focus', function() {
    $(this).closest('.bootstrap-tagsinput').addClass('has-focus');
  }).on('blur', function() {
    $(this).closest('.bootstrap-tagsinput').removeClass('has-focus');
  });
});

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

 

 

      function feedTypeChange(e,type) {
        $('.PreLoader').addClass('pre_loader_show');
        var request_type = $('#request_type').val();
         $.ajax({
          url: "{{ route('front.feeds_news.new_post_type') }}",
          type: 'post',
          dataType: 'json',
          data: {"_token": "{{ csrf_token() }}",'type':type,request_type_id:request_type},
          success: function(data) {
            $('li').removeClass('list_active');
            if($('#request_type').val() != 0){
              $('.newsIconList li').addClass('list_disabled');
            }
            if(type == 1){
              $('.viewRed').parent().addClass('list_active');
              $('.newsViewRed').parent().removeClass('list_disabled');
            }else if(type == 2){
              $('.viewOrange').parent().addClass('list_active');
              $('.newsViewOrange').parent().removeClass('list_disabled');
            }else if(type == 4){
              $('.viewYellow').parent().addClass('list_active');
              $('.newsViewYellow').parent().removeClass('list_disabled');
            }
            
            $('.feedViewData').html(data.view);
            $('#feedType').val(data.type);
            $('#exampleModalLabel').text('Post '+ data.title_type);
            
            $('.category_Id').parent().removeClass('errCount');
            $('.category_Id').next().html('');
            $('.PreLoader').hide();
            $('.PreLoader').removeClass('pre_loader_show');
          }
        });
      }

      function showSubcategory(e){

        // $(e).find('option:selected').each(function(){
        //   var text = $(this).text();
        //   if(text.search("RIP") >= 0){
        //     $('.rip_categorys').show();
        //   }else{
        //     $('.rip_category_Id').val('');
        //     $('.rip_categorys').hide();
        //   }
        // });
        // return false;

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
   