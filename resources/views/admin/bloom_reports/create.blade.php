@extends('admin.layouts.master')

@section('title') Bloom Reports @endsection

@section('content')

  <!-- Content Header (Page header) -->
    <style>
      #exTab2 li.active {
        color : white;
        background-color: #367fa9;
        padding : 5px 4px 1px 5px;
      }
    </style>

    <section class="content-header">
        <h1> Bloom Reports</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="#"> All Bloom Reports </a></li>
            <li class="active">Bloom Reports</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <div class="col-md-12">
            <div class="box">              
                <div id="exTab2" class="container">	
                  <ul class="nav nav-tabs">
                    <li class=" @if(@$request_type == 'welcome'){{ 'active' }} @endif"><a href="#welcome_id" data-toggle="tab">Welcome Section</a></li>
                    <li class=" @if(@$request_type == 'person'){{ 'active' }} @endif"><a href="#person_id" data-toggle="tab">Person Section</a></li>
                    <li class=" @if(@$request_type == 'weekly_stories'){{ 'active' }} @endif"><a href="#weekly_stories_id" data-toggle="tab">Weekly Stories</a></li>
                    <li class=" @if(@$request_type == 'video_week'){{ 'active' }} @endif"><a href="#video_week_id" data-toggle="tab">Video of the Week</a></li>
                    <li class=" @if(@$request_type == 'advt_image'){{ 'active' }} @endif"><a href="#advt_id" data-toggle="tab">Advt.</a></li>
                    <li class=" @if(@$request_type == 'news'){{ 'active' }} @endif"><a href="#news_id" data-toggle="tab">News Section</a></li>
                  </ul>
        
                  <div class="tab-content ">
                    <h3>{{$upcoming_weeks[0]['week_range']}}</h3>
                    <div class="form-group">
                      <label for="status" class="col-sm-2 control-label">Weekly Range </label>
                      <div class="col-sm-6">
                        <select class="form-control" id="week_Range_Slug" name="week_range_slug">
                          @foreach($upcoming_weeks as $upcoming_week)
                            <option @if(@$week_range != @$upcoming_week['week_range']){{ 'disabled' }}@endif value="{{@$upcoming_week['week_range_slug']}}">{{@$upcoming_week['week_range']}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!-- Welcome Section Start -->
                    <div class="tab-pane @if(@$request_type == 'welcome'){{ 'active' }} @endif" id="welcome_id">
                      <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <h3>Welcome Section</h3>
                        <form class="form-horizontal" onsubmit="submit_bloom_reports(this); return false;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{@$bloomReport->id}}">
                            <input type="hidden" name="section_type" value="welcome">

                            <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Heading <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="heading" placeholder="Heading" value="{{@$bloomReport->title}}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Sub-Heading </label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="sub_heading" placeholder="Sub-Heading" value="{{@$bloomReport->sub_heading}}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <textarea class="form-control textBlog" name="description" placeholder="Description">{{@$bloomReport->caption}}</textarea>
                            </div>
                          </div>    

                          <div class="form-group">
                            <label for="check_image" class="col-sm-2 control-label">Date <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="datepicker form-control" name="date" placeholder="yyyy-mm-dd" value="{{@$bloomReport->date}}" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">Featured Block </label>
                            <div class="col-sm-6">
                              <select class="form-control featured_block" name="featured_block">
                                <option @if(@$bloomReport->is_featured == 0){{ 'selected' }} @endif value="0">No</option>
                                <option @if(@$bloomReport->is_featured == 1){{ 'selected' }} @endif value="1">Yes</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Image </label>
                            <div class="col-sm-6">
                            @if(@$bloomReport->image)
                              <img src="{{asset('uploads/images/bloom_reports/'.@$bloomReport->image)}}" class="imgHundred" alt="" id="blah">
                              <input type="hidden" name="is_image" value="{{@$bloomReport->image}}">
                            @else
                              <img src="{{asset('front/new/images/Product/team_new.png')}}" class="imgHundred" alt="" id="blah">
                            @endif
                            <input type="file" name="featured_image" class="" onchange="readURL(this,'blah');">
                            </div>
                          </div>  
              
                          @csrf

                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- Welcome Section End -->

                    <!-- Person Section Start -->
                    <div class="tab-pane @if(@$request_type == 'person'){{ 'active' }} @endif" id="person_id">
                      <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <h3>Person Section</h3>
                        <form class="form-horizontal" onsubmit="submit_bloom_reports(this); return false;" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{@$bloomReport->id}}">
                            <input type="hidden" name="section_type" value="person">

                            <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Heading <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="heading" placeholder="Heading" value="{{@$bloomReport->title}}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Sub-Heading </label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="sub_heading" placeholder="Sub-Heading" value="{{@$bloomReport->sub_heading}}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <textarea class="form-control textBlog" name="description" placeholder="Description">{{@$bloomReport->caption}}</textarea>
                            </div>
                          </div>    

                          <div class="form-group">
                            <label for="check_image" class="col-sm-2 control-label">Date <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="datepicker form-control" name="date" placeholder="yyyy-mm-dd" value="{{@$bloomReport->date}}" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">Featured Block </label>
                            <div class="col-sm-6">
                              <select class="form-control featured_block" name="featured_block">
                                <option @if(@$bloomReport->is_featured == 0){{ 'selected' }} @endif value="0">No</option>
                                <option @if(@$bloomReport->is_featured == 1){{ 'selected' }} @endif value="1">Yes</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Image </label>
                            <div class="col-sm-6">
                            @if(@$bloomReport->image)
                              <img src="{{asset('uploads/images/bloom_reports/'.@$bloomReport->image)}}" class="imgHundred" alt="" id="blah2">
                              <input type="hidden" name="is_image" value="{{@$bloomReport->image}}">
                            @else
                              <img src="{{asset('front/new/images/Product/team_new.png')}}" class="imgHundred" alt="" id="blah2">
                            @endif
                            <input type="file" name="featured_image" class="marginTopFive" onchange="readURL(this,'blah2');">
                            </div>
                          </div>  
              
                          @csrf
              
                          @csrf

                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- Person Section End -->

                    <!-- Weekly Stories Start -->
                    <div class="tab-pane @if(@$request_type == 'weekly_stories'){{ 'active' }} @endif" id="weekly_stories_id">
                      <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <h3>Weekly Stories</h3>
                        <form class="form-horizontal" onsubmit="submit_bloom_reports(this); return false;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{@$bloomReport->id}}">
                            <input type="hidden" name="section_type" value="weekly_stories">

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Description </label>
                            <div class="col-sm-6">
                              <textarea class="form-control textBlog" name="description" placeholder="Description">{{@$bloomReport->caption}}</textarea>
                            </div>
                          </div>
              
                          @csrf

                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                              <button type="submit" class="btn btn-success" id="createBtn">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- Weekly Stories End -->

                    <!-- Video Of the week Start -->
                    <div class="tab-pane @if(@$request_type == 'video_week'){{ 'active' }} @endif" id="video_week_id">
                      <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <h3>Video of the week</h3>
                        <form class="form-horizontal" onsubmit="submit_bloom_reports(this); return false;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{@$bloomReport->id}}">
                            <input type="hidden" name="section_type" value="video_week">

                          
                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Video URL </label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control video_url" name="video_url" placeholder="Video URL" value="{{@$bloomReport->video_url}}" oninput="getYoutubeThumbnailfeed('video_url','video_image','');">
                            </div>
                            <div class="col-sm-1">
                              <img src="{{asset('front/new/images/Product/team_new.png')}}" class="imgHundred" alt="" id="video_Image" style="display:none; width:40px !important; height:40px !important; ">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                              <img src="{{asset('front/new/images/Product/team_new.png')}}" class="imgHundred video_image" alt="">
                            </div>
                          </div>
              
                          @csrf

                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                              <button type="submit" class="btn btn-success" id="createBtn">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- Video Of the week End -->

                    <!-- Advertisment Start -->
                    <div class="tab-pane @if(@$request_type == 'advt_image'){{ 'active' }} @endif" id="advt_id">
                      <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <h3>Advertisment</h3>
                        <form class="form-horizontal" onsubmit="submit_bloom_reports(this); return false;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{@$bloomAdsImages->id}}">
                            <input type="hidden" name="section_type" value="advt_image">
                          
                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-6">
                            @if(@$bloomAdsImages->image)
                              <img src="{{asset('uploads/images/bloom_reports/'.@$bloomAdsImages->image)}}" class="imgHundred" alt="" id="blah3">
                              <input type="hidden" name="is_image" value="{{@$bloomAdsImages->image}}">
                            @else
                              <img src="{{asset('front/new/images/Product/team_new.png')}}" class="imgHundred" alt="" id="blah3">
                            @endif
                            <input type="file" name="featured_image" class="marginTopFive" onchange="readURL(this,'blah3');">
                            </div>
                          </div>

                          
                          <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">Category <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <select class="form-control category_id" name="category">
                              <option value="">--Select Category after which seeing this ad--</option>
                                @foreach($categorys as $key => $category)
                                  <option @if(@$bloomAdsImages->category_id == $category->id){{ 'selected' }}@endif value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
              
                          @csrf

                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                              <button type="submit" class="btn btn-success" id="createBtn">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- Advertisment End -->

                    <!-- News Section Start -->
                    <div class="tab-pane @if(@$request_type == 'news'){{ 'active' }} @endif" id="news_id">
                      <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <h3>News Section</h3>
                        <form class="form-horizontal" onsubmit="submit_bloom_reports(this); return false;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{@$news_section->id}}">
                            <input type="hidden" name="section_type" value="news">

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Title <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="title" placeholder="Title" value="{{@$news_section->title}}">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">URL <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control url" name="url" placeholder="URL" value="{{@$news_section->url}}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">Category <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <select class="form-control category_id" name="category">
                              <option value="">--Select Category--</option>
                                @foreach($categorys as $key => $category)
                                  <option @if(@$news_section->category_id == $category->id){{ 'selected' }}@endif value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Caption </label>
                            <div class="col-sm-6">
                              <textarea class="form-control textBlog" name="caption" placeholder="Caption">{{@$news_section->caption}}</textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="check_image" class="col-sm-2 control-label">Date <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="datepicker form-control" name="date" placeholder="yyyy-mm-dd" value="{{@$news_section->date}}" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Submitted By <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="submitted_by" placeholder="Submitted By" value="{{@$news_section->submitted_by}}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Video URL </label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control video_url_2" name="video_url" placeholder="Video URL" value="{{@$news_section->video_url}}" oninput="getYoutubeThumbnailfeed('video_url_2','news_image','marginTopFive');">
                            </div>
                            <div class="col-sm-1">
                              <img src="{{asset('front/new/images/Product/team_new.png')}}" class="imgHundred" alt="" id="video_Image_2" style="display:none; width:40px !important; height:40px !important; ">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-6">
                            @if(@$news_section->image)
                              <img src="{{asset('uploads/images/bloom_reports/'.@$news_section->image)}}" class="imgHundred news_image" alt="" id="blah4">
                              <input type="hidden" name="is_image" value="{{@$news_section->image}}">
                            @else
                              <img src="{{asset('front/new/images/Product/team_new.png')}}" class="imgHundred news_image" alt="" id="blah4">
                            @endif
                            <input type="file" name="featured_image" class="marginTopFive" onchange="readURL(this,'blah4');">
                            </div>
                          </div>
              
                          @csrf

                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                              <button type="submit" class="btn btn-success" id="createBtn">Post to news feeds</button>
                              <span class="ml-3 mt-3"><input type="checkbox" name="add_to_feeds" value="on"> &nbsp;Add to home feeds.</span>
                              <span class="ml-3 mt-3"><input type="checkbox" name="add_to_news_feeds" value="on"> &nbsp;Add to news feeds.</span>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- News Section End -->
                  </div>
                </div>
                <!-- /.box-header -->
                
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')

<script type="text/javascript">


  var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
  tinymce.init({
    selector: 'textarea.textBlog',
    media_dimensions: false,
    media_alt_source: false,
    media_poster: false,
    paste_block_drop: false, 
    plugins: 'contextmenu print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',

    imagetools_cors_hosts: ['picsum.photos'],
    menubar: '',
    toolbar: 'undo redo | bold italic underline strikethrough cut copy paste',
    toolbar_sticky: false,
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    height: 400,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic underline strikethrough | cut copy paste | quicklink blockquote quickimage quicktable',
    noneditable_noneditable_class: 'mceNonEditable',
    toolbar_mode: 'wrap',
    contextmenu: 'cut copy paste | bold italic underline strikethrough | link image imagetools table',
    skin: useDarkMode ? 'oxide-dark' : 'oxide',
    content_css: useDarkMode ? 'dark' : 'default',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
    image_title: true,
    automatic_uploads: true,
    images_upload_url: '{{url("/tinyimage/upload")}}',
    images_upload_credentials: true,
    relative_urls: false,
    remove_script_host: false,
    file_picker_types: 'image',
    setup: function (editor) {
      editor.on('ExecCommand', (event) => {
        const command = event.command;
        if (command === 'mceMedia') {
          const tabElems = document.querySelectorAll('div[role="tablist"] .tox-tab');
          tabElems.forEach(tabElem => {
            if (tabElem.innerText === 'Embed') {
                tabElem.style.display = 'none';
            }
          });
        }
      });
    },
  });

    

    $(document).ready(function(){
      getYoutubeThumbnailfeed('video_url','video_image','');
      setTimeout(function(){
        getYoutubeThumbnailfeed('video_url_2','news_image','marginTopFive');
      },500);
    });

    jQuery(function($) {

      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd', 
        todayHighlight: true,
        autoclose: true,
        endDate: 'now',
        showButtonPanel: true,
      });

      setTimeout(function(){      
        var text_2 = $(".category_id option:selected").text();
        if(text_2.search("RIP") >= 0){
          $('.rip_categorys').show();
        }
      },300);

    });

    function submit_bloom_reports(e){
      tinyMCE.triggerSave();
      var fd = new FormData($(e)[0]);
      var week_Range_Slug = $('#week_Range_Slug').val();
      fd.append('week_range_slug',week_Range_Slug); 			
      $.ajax({
          processData: false,
          contentType: false,
          data: fd,
          dataType: 'json',
          url: '{{route("admin.bloom_reports.submit")}}',
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
                  window.location.replace(data.url);

              } else {
                  var message = formatErrorMessageFromJSON(data.errors);
                  $('.message_box').html(message).removeClass('hide');
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

    function getYoutubeThumbnailfeed(cls,img_id,img_id_2) {
      var youtube_url = $('.'+cls).val();
      if(youtube_url != ''){
        $.ajax({
          url: "{{route('admin.news_feeds.get_youtube_thumbnail')}}",
          data: {'_token':'{{ csrf_token() }}','video_url':youtube_url},
          dataType: 'json',
          type: 'POST',
          success: function (data) {
            if(data.success == 1){
              $('.'+img_id).attr('src',data.thumbnail);
              $('.'+img_id_2).hide();
              // $('.imgHundred').hide();
              // $('#video_Image').show();
            } else {
              $('#add-gallery-image-upload-preview-onevideo').attr('src','');
              $('.'+img_id_2).show();
              // $('.imgHundred').show();
              // $('#video_Image').hide();
              $('.'+img_id).attr('src',"{{asset('front/new/images/Product/team_new.png')}}");
              toastr.error(data.msg);
            }
          }
        });
      }
    }

</script>

@endsection
