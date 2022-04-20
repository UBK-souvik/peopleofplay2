@extends('admin.layouts.master')

@section('title') {{$page_type}} News Submission Feed @endsection

@section('content')

@php 
$arr_categories_pivot_id = array();
  if(!empty($news_categories_pivot))
  {
	 foreach($news_categories_pivot as $news_categories_pivot_val)					
	  {	
		$arr_categories_pivot_id[] = $news_categories_pivot_val['news_category_id'];								  
	  }  
  }								  							   
@endphp

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{$page_type}} News Submission Feed</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.news.index') }}"> All News </a></li>
            <li class="active">{{$page_type}} News Submission Feed</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                    <form class="form-horizontal" id="create-form" enctype="multipart/form-data">
                        <input type="hidden" name="news_feeds_id" value="{{@$newsFeeds->id}}">
                        <input type="hidden" name="news_feeds_user_id" value="{{@$newsFeeds->user_id}}">

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Heading <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="title" placeholder="Heading" value="{{@$newsFeeds->title}}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Caption <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <textarea class="form-control" name="caption" placeholder="Caption">{{@$newsFeeds->caption}}</textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">Primary Category <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control category_id" name="category" onchange="showSubcategory(this); return false;">
                          <option value="">--Select Category--</option>
                            @foreach($categorys as $key => $category)
                              <option @if(@$newsFeeds->category_id == $category->id){{ 'selected' }}@endif value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group rip_categorys" style="display:none;">
                        <label for="status" class="col-sm-2 control-label">RIP Category <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select name="rip_category" class="form-control input-sm select2-multiple rip_category_Id">
                            <option value="">--Select RIP Decades--</option>
                            @foreach ($rip_categories as $rip_categorie)
                              <option @if($rip_categorie->id == @$newsFeeds->rip_category_id){{ 'selected' }}@endif value="{{$rip_categorie->id}}">{{ ucwords($rip_categorie->name) }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">Secondary Category <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select name="secondary_category" class="form-control input-sm select2-multiple sec_category_Id">
                            <option value="">--Select Secondary Category--</option>
                            @foreach($categorys as $key => $category)
                              <option @if(@$newsFeeds->secondary_category_id == $category->id){{ 'selected' }}@endif value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">URL </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control url" name="url" placeholder="URL" value="{{@$newsFeeds->url}}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Video URL </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control video_url" name="video_url" placeholder="Video URL" value="{{@$newsFeeds->video_url}}" oninput="getYoutubeThumbnailfeed(this);">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Featured Image <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                        @if(@$newsFeeds->image)
                          <img src="{{asset('uploads/images/feed/'.@$newsFeeds->image)}}" class="imgHundred" alt="" id="blah">
                          <input type="hidden" name="is_image" value="{{@$newsFeeds->image}}">
                        @else
                          <img src="{{asset('front/new/images/Product/team_new.png')}}" class="imgHundred" alt="" id="blah">
                        @endif
                        <input type="file" name="featured_image" class="marginTopFive" onchange="readURL(this,'blah');" required>
                        </div>
                      </div>
					 
                      @csrf

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                          <button type="button" class="btn btn-success" id="createBtn">Post to news feeds</button>
                          <span class="ml-3 mt-3"><input type="checkbox" name="add_to_feeds" value="on"> &nbsp;Add to home feeds.</span>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')

<script type="text/javascript">

    jQuery(function($) {

    $('.select2').select2()

    setTimeout(function(){      
      var text_2 = $(".category_id option:selected").text();
      if(text_2.search("RIP") >= 0){
        $('.rip_categorys').show();
      }
    },300);

      $(document).on('click','#createBtn',function(e){
            e.preventDefault();
			
			      var fd = new FormData($('#create-form')[0]);  
			
            $.ajax({
                processData: false,
                contentType: false,
                data: fd,
                dataType: 'json',
                url: '{{route("admin.news_feeds.create")}}',
                headers: {
                        'X-CSRF-TOKEN': ajax_csrf_token_new
                        },
                type: 'POST',
                beforeSend: function()
                {
                    $('#createBtn').attr('disabled',true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function(jqXHR, exception){
                    $('#createBtn').attr('disabled',false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data)
                {
                    $('#createBtn').attr('disabled',false);
                    if(data.status == 1)
                    {
                        $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        window.location.replace("{{route('admin.news_feeds.index')}}");

                    } else {
                        var message = formatErrorMessageFromJSON(data.errors);
                        $('.message_box').html(message).removeClass('hide');
                    }

                }
            });
        });
    });

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

    function getYoutubeThumbnailfeed(e) {
      var youtube_url = $(e).val();
      $.ajax({
        url: "{{route('admin.news_feeds.get_youtube_thumbnail')}}",
        data: {'_token':'{{ csrf_token() }}','video_url':youtube_url},
        dataType: 'json',
        type: 'POST',
        success: function (data) {
          if(data.success == 1){
            $('#blah').attr('src',data.thumbnail);
            $('#blah').css({'display':'inline'});
            $('.marginTopFive').hide();
            $('.url').attr('disabled',true);
          } else {
            $('#add-gallery-image-upload-preview-onevideo').attr('src','');
            $('#blah').css({'display':''});
            $('.marginTopFive').show();
            $('.url').removeAttr('disabled');
            toastr.error(data.msg);
          }
        }
      });
    }

    function showSubcategory(e){
      var text = $(".category_id option:selected").text();
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

@endsection
