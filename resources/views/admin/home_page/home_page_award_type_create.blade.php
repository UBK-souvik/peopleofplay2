@extends('admin.layouts.master')
@section('title') Home Page Whatever Day Create @endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
 <h1> Home Page Award Type Create</h1>
 <ol class="breadcrumb">
  <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
  <li><a href="{{ route('admin.cms.home-award_type.index') }}"> All Home Page Award Type List</a></li>
  <li class="active">Home Page Award Typ3 Create</li>
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
      <input type="hidden" name="happy_whatever_day_id" value="{{@$home_page_award_type->id}}">
      <div class="form-group">
       <label for="email" class="col-sm-2 control-label">Title</label>
       <div class="col-sm-6">
        <input id="home_caption_one" type="text" value="{{ @$home_page_award_type->title }}" name="title" class="form-control" placeholder="">
      </div>
    </div>
    <div class="form-group">
     <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>
     <div class="col-sm-6">
      <select class="form-control" name="status">

        @foreach(config('cms.action_status') as $key => $status)
        <option value="{{ $key }}" {{isset($home_page_award_type) && $home_page_award_type->status == $key ? 'selected' : ''}}>{{ $status }}</option>
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
       url: '{{route("admin.cms.home-award_type.update")}}',
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
         window.location.replace('{{ route("admin.cms.home-award_type.index")}}');

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