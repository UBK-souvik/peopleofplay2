@extends('admin.layouts.master')
@section('title') Home Page Whatever Day Create @endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
 <h1> Home Page Whatever Day Create</h1>
 <ol class="breadcrumb">
  <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
  <li><a href="{{ route('admin.cms.home-award.index') }}"> All Home Page Whatever Day List</a></li>
  <li class="active">Home Page Whatever Day Create</li>
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
      <input type="hidden" name="happy_whatever_day_id" value="{{@$home_page_award->id}}">
      {{-- 
        <div class="form-group">
         <label for="email" class="col-sm-2 control-label">Is Home Page Display</label>
         <div class="col-sm-6">
          <input id="is_home_page" type="checkbox" value="1" @if(!empty($product->is_home_page)){{'checked="checked"'}}@endif name="product[is_home_page]" placeholder="">
        </div>
      </div>
      --}}
      <div class="form-group">
       <label for="email" class="col-sm-2 control-label">Caption One</label>
       <div class="col-sm-6">
        <input id="home_caption_one" type="text" value="{{ @$home_page_award->home_caption_one }}" name="home_caption_one" class="form-control" placeholder="">
      </div>
    </div>
    <div class="form-group">
     <label for="email" class="col-sm-2 control-label">Caption Two</label>
     <div class="col-sm-6">
      <input id="home_caption_two" type="text" value="{{ @$home_page_award->home_caption_two }}" name="home_caption_two" class="form-control" placeholder="">
    </div>
  </div>

  <div class="form-group">
   <label for="email" class="col-sm-2 control-label">Caption One Link(URL)</label>
   <div class="col-sm-6">
    <input id="home_page_url_text" type="text" value="{{ @$home_page_award->homa_caption_url_one }}" name="homa_caption_url_one" class="form-control" placeholder="">
  </div>
</div>
<div class="form-group">
 <label for="email" class="col-sm-2 control-label">Caption Two Link(URL)</label>
 <div class="col-sm-6">
  <input id="home_page_url" type="text" value="{{ @$home_page_award->homa_caption_url_two }}" name="homa_caption_url_two" class="form-control" placeholder="">
</div>
</div>
<?php
  @$url_three = '';
  if(isset($home_page_award->url_caption_three) && !empty($home_page_award->url_caption_three))
 {
   @$url_three = json_decode($home_page_award->url_caption_three);
 }
 ?>
<div class="form-group">
       <label for="email" class="col-sm-2 control-label">Caption Three </label>
       <div class="col-sm-6">
        <input id="home_caption_one" type="text" value="{{ @$url_three->caption }}" name="home_caption_three" class="form-control" placeholder="">
      </div>
    </div>
     <div class="form-group">
   <label for="email" class="col-sm-2 control-label">Caption Three Link</label>
   <div class="col-sm-6">
    <input id="home_page_url_text" type="text" value="{{ @$url_three->url }}" name="homa_caption_url_three" class="form-control" placeholder="">
  </div>
</div>
<?php
  @$url_four = '';
  if(isset($home_page_award->url_caption_four) && !empty($home_page_award->url_caption_four))
 {
   @$url_four = json_decode($home_page_award->url_caption_four);
 }
 ?>
<div class="form-group">
       <label for="email" class="col-sm-2 control-label">Caption Four </label>
       <div class="col-sm-6">
        <input id="home_caption_one" type="text" value="{{ @$url_four->caption }}" name="home_caption_four" class="form-control" placeholder="">
      </div>
    </div>
     <div class="form-group">
   <label for="email" class="col-sm-2 control-label">Caption Four Link</label>
   <div class="col-sm-6">
    <input id="home_page_url_text" type="text" value="{{ @$url_four->url }}" name="homa_caption_url_four" class="form-control" placeholder="">
  </div>
</div>
<?php
  @$url_five = '';
  if(isset($home_page_award->url_caption_five) && !empty($home_page_award->url_caption_five))
 {
   @$url_five = json_decode($home_page_award->url_caption_five);
 }
 ?>
<div class="form-group">
       <label for="email" class="col-sm-2 control-label">Caption Five </label>
       <div class="col-sm-6">
        <input id="home_caption_one" type="text" value="{{ @$url_five->caption }}" name="home_caption_five" class="form-control" placeholder="">
      </div>
    </div>
     <div class="form-group">
   <label for="email" class="col-sm-2 control-label">Caption Five Link</label>
   <div class="col-sm-6">
    <input id="home_page_url_text" type="text" value="{{ @$url_five->url }}" name="homa_caption_url_five" class="form-control" placeholder="">
  </div>
</div>
<?php
  @$url_six = '';
  if(isset($home_page_award->url_caption_six) && !empty($home_page_award->url_caption_six))
 {
   @$url_six = json_decode($home_page_award->url_caption_six);
 }
 ?>
<div class="form-group">
       <label for="email" class="col-sm-2 control-label">Caption Six </label>
       <div class="col-sm-6">
        <input id="home_caption_one" type="text" value="{{ @$url_six->caption }}" name="home_caption_six" class="form-control" placeholder="">
      </div>
    </div>
     <div class="form-group">
   <label for="email" class="col-sm-2 control-label">Caption Six Link</label>
   <div class="col-sm-6">
    <input id="home_page_url_text" type="text" value="{{ @$url_six->url }}" name="homa_caption_url_six" class="form-control" placeholder="">
  </div>
</div>
<?php
  @$url_seven = '';
  if(isset($home_page_award->url_caption_seven) && !empty($home_page_award->url_caption_seven))
 {
   @$url_seven = json_decode($home_page_award->url_caption_seven);
 }
 ?>
<div class="form-group">
       <label for="email" class="col-sm-2 control-label">Caption Seven </label>
       <div class="col-sm-6">
        <input id="home_caption_one" type="text" value="{{ @$url_seven->caption }}" name="home_caption_seven" class="form-control" placeholder="">
      </div>
    </div>
     <div class="form-group">
   <label for="email" class="col-sm-2 control-label">Caption Seven Link</label>
   <div class="col-sm-6">
    <input id="home_page_url_text" type="text" value="{{ @$url_seven->url }}" name="homa_caption_url_seven" class="form-control" placeholder="">
  </div>
</div>
<div class="form-group">
 <label for="name" class="col-sm-2 control-label">Photo <i class="has-error">*</i></label>
 <div class="col-sm-6">
  <img id="profile-blah-image" src="{{@awardImageBasePath(@$home_page_award->featured_image)}}" alt="" class="imgHundred">
  <input type="file" name="featured_image" class="marginTopFive image" onchange="readURL(this);">
  <input type="hidden" name="image" id="check_image" value="<?php if(isset($home_page_award->featured_image) && !empty($home_page_award->featured_image)) { echo 1; } ?> ">
</div>
</div>

<div class="form-group">
 <label for="status" class="col-sm-2 control-label">Award Type <i class="has-error">*</i></label>
 <div class="col-sm-6">
  <select class="form-control" name="type">
    <option value="">Select Type</option>
    @foreach(@$get_award_type_list as $key => $typeRow)
    <option value="{{ $typeRow->id }}" {{isset($home_page_award) && $home_page_award->type == $typeRow->id ? 'selected' : ''}}>{{ $typeRow->title }}</option>
    @endforeach
  </select>
</div>
</div>

<div class="form-group">
 <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>
 <div class="col-sm-6">
  <select class="form-control" name="status">

    @foreach(config('cms.action_status') as $key => $status)
    <option value="{{ $key }}" {{isset($home_page_award) && $home_page_award->status == $key ? 'selected' : ''}}>{{ $status }}</option>
    @endforeach
  </select>
</div>
</div>
@csrf
<div class="form-group">
 <div class="col-sm-offset-2 col-sm-6">
  <button type="button" class="btn btn-success" id="createBtn">Submit</button>
</div>
</div>
</form>
</div>
</div>
</div>
@include('admin.includes.cropper_model')
</div>
</section>
@endsection
@section('scripts')
<script>


 function readURL(input) {
  $('.custom-file__label .imageLoading').show();
  if (input.files && input.files[0]) {
   var reader = new FileReader();
   reader.onload = function(event) {
    $("#profile-blah-image").attr('src', event.target.result);
    $('#check_image').val(1);
  }
  reader.readAsDataURL(input.files[0]);
}
}

</script>
<script type="text/javascript">
 jQuery(function($) {
   $(document).on('click','#createBtn',function(e){
     e.preventDefault();

     var fd = new FormData($('#create-form')[0]);  

     $.ajax({
       processData: false,
       contentType: false,
       data: fd,
       dataType: 'json',
       url: '{{route("admin.cms.home-award.update")}}',
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

       if(jqXHR.responseText.indexOf('Whatever day already exists')>0)
       {
         var err = eval("(" + jqXHR.responseText + ")");
         var msg = err.msg;
       }
       else
       {
         var msg = formatErrorMessage(jqXHR, exception);  
       }

       $('.message_box').html(msg).removeClass('hide');
     },
     success: function (data)
     {
       $('#createBtn').attr('disabled',false);
       if(data.status == 1)
       {
         $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
         window.location.replace('{{ route("admin.cms.home-award.index")}}');

       } else {
         var message = formatErrorMessageFromJSON(data.errors);
         $('.message_box').html(message).removeClass('hide');
       }

     }
   });
   });
 });
</script>
@endsection