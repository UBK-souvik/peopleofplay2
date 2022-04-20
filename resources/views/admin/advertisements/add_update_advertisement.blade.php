@extends('admin.layouts.master')

@section('title') 
@if(empty($chk_is_default))  @if(!empty($advertisement->id)){{ adminTransLang('edit_advertisement') }} @else {{ adminTransLang('add_advertisement') }} @endif @endif 
@if(!empty($chk_is_default))  @if(!empty($advertisement->id)){{ adminTransLang('edit_default_advertisement') }} @else {{ adminTransLang('add_default_advertisement') }} @endif @endif 
@endsection
 
@section('content')

<style>

</style>
    <section class="content-header">
        <h1> @if(empty($chk_is_default))  @if(!empty($advertisement->id)){{ adminTransLang('edit_advertisement') }} @else {{ adminTransLang('add_advertisement') }} @endif @endif 
@if(!empty($chk_is_default))  @if(!empty($advertisement->id)){{ adminTransLang('edit_default_advertisement') }} @else {{ adminTransLang('add_default_advertisement') }} @endif @endif  </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.advertisements.index') }}/{{$chk_is_default}}/0">
@if(empty($chk_is_default))
 {{ adminTransLang('all_advertisements') }} 
@else
 {{ adminTransLang('all_default_advertisements') }} 	
@endif</a></li>
            <li class="active">@if(empty($chk_is_default))  @if(!empty($advertisement->id)){{ adminTransLang('edit_advertisement') }} @else {{ adminTransLang('add_advertisement') }} @endif @endif 
@if(!empty($chk_is_default))  @if(!empty($advertisement->id)){{ adminTransLang('edit_default_advertisement') }} @else {{ adminTransLang('add_default_advertisement') }} @endif @endif </li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="box">
                     <div class="box-body" id="add-edit-advertisement-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="add-edit-advertisement-main-box-body-form">
						{{ csrf_field() }}

         <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Type <i class="has-error">*</i></label>
          <div class="col-sm-6">
      		  <select required name="type" class="form-control select2 py-3">
                    <option value="1" {{(!empty($advertisement->type) && $advertisement->type == 1)? 'selected' : ''}}>Image</option>
						{{-- <option value="2" {{(!empty($advertisement->type) && $advertisement->type == 2)? 'selected' : ''}}>Video</option>--}}
      		  </select>		  		  
          </div>
       </div>
	   
		 <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Title <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input id="title" 
	   value="@if(!empty($advertisement->title)){{$advertisement->title}}@endif" type="text" class="form-control" 
placeholder="Title" name="title">
          </div>
       </div>
	   
	   <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Home Page Custom Text 1 </label>
          <div class="col-sm-6">
             <input id="home_caption_one" 
	   value="@if(!empty($advertisement->home_caption_one)){{$advertisement->home_caption_one}}@endif" type="text" class="form-control" 
placeholder="Title" name="home_caption_one">
          </div>
       </div>
	   
	   <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Home Page Custom Text 2 </label>
          <div class="col-sm-6">
             <input id="home_caption_two" 
	   value="@if(!empty($advertisement->home_caption_two)){{$advertisement->home_caption_two}}@endif" type="text" class="form-control" 
placeholder="Title" name="home_caption_two">
          </div>
       </div>

	     <div class="form-group">
          <label for="position" class="col-sm-2 control-label">Position <i class="has-error">*</i></label>
          <div class="col-sm-6">
      		  <select required  @if(!empty($advertisement->advertisement_position) && $advertisement->advertisement_position ==4 ){{'readonly'}}@endif name="advertisement_position" class="form-control">
                    <option value=""> Select Position</option>
                    @foreach($advertisement_position as $advertisement_position_id => $advertisement_position_name)
                    <option value="{{$advertisement_position_id}}" {{(!empty($advertisement->advertisement_position) && $advertisement_position_id == $advertisement->advertisement_position)? 'selected' : ''}}>{{$advertisement_position_name}}</option>
                    @endforeach
      		  </select>		  		  
          </div>
       </div>
	   
	   <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Page <i class="has-error">*</i></label>
          <div class="col-sm-6">
      		  <select required id="advertisement_category" name="advertisement_category" class="form-control select2 py-3">
                    <option value=""> Select Page</option>
                    @foreach($advertisement_category as $advertisement_category_id => $advertisement_category_name)
                    <option value="{{$advertisement_category_id}}" {{(!empty($advertisement->advertisement_category) && $advertisement_category_id == $advertisement->advertisement_category)? 'selected' : ''}}>{{$advertisement_category_name}}</option>
                    @endforeach
      		  </select>		  		  
          </div>
       </div>
	   
	   @if(empty($chk_is_default) || $chk_is_default<=0)
			<div class="form-group">
			  <label for="name" class="col-sm-2 control-label">From date <i class="has-error">*</i></label>
			  <div class="col-sm-6">
				 <input id="add_edit_advertisement_from" 
		   value="@if(!empty($advertisement->from_date)){{$advertisement->from_date}}@endif" type="date" class="form-control" 
	placeholder="Date From" name="from_date">
			  </div>
		   </div>
		   <div class="form-group">
			  <label for="name" class="col-sm-2 control-label">To date <i class="has-error">*</i></label>
			  <div class="col-sm-6">
				 <input id="add_edit_advertisement_from" 
		   value="@if(!empty($advertisement->to_date)){{$advertisement->to_date}}@endif" type="date" class="form-control" 
	placeholder="Date From" name="to_date">
			  </div>
		   </div>
	   @endif
	   
	   <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Destination Link <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input type="text" class="form-control" name="destination_link" placeholder="Destination Link"  value="@if(!empty($advertisement->destination_link)){{$advertisement->destination_link}}@endif">
          </div>
       </div>
       
       <div class="form-group">
          <label for="advertisement_image" class="col-sm-2 control-label">Image <i class="has-error">*</i></label>
          <div class="col-sm-6">
             
			 
            <img @if(!empty($advertisement->advertisement_image)){{'style=display:block;'}} @else {{'style=display:none;'}} @endif id="advertisement-blah-image" @if(!empty($advertisement->advertisement_image)) 
				src="{{imageBasePath($advertisement->advertisement_image)}}" @endif alt=""
                class="imgHundred" >

                <input id="file-uploadten" onchange="readBannerURL(this);" type="file" name="advertisement_image" class="marginTopFive">
            
          </div>
       </div>
	   
	   {{-- @if(empty($chk_is_default)) --}}
         <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Sponsor Name <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input type="text" class="form-control" name="sponsor_name" placeholder="Sponsor Name"  value="@if(!empty($advertisement->sponsor_name)){{$advertisement->sponsor_name}}@endif">
          </div>
       </div>	   
	  {{-- @endif --}} 
                           
                    <div class="col-sm-6" style="margin-top: 8px;">
                        <div class="row">
						    <input type="hidden" id="is_default" name="is_default" value="{{$chk_is_default}}">
			                <input type="hidden" name="banner_width_hidden" id="banner_width_hidden">
                            <input type="hidden" name="banner_height_hidden" id="banner_height_hidden">							
                            <button type="button" class="btn btn-success" id="createBtn">Save</button>
                        </div>
                    </div>

                        </form>
                     </div>

                     <div class="box-footer">
                        
                     </div>
                  </div>
               </div>
            </div>
         </section>
@endsection


@section('scripts')

<script>
$(document).ready(function(){
	
            $('body').on('click','#add-edit-advertisement-main-box-body-div  #createBtn',function(e){
                e.preventDefault();
				 
                var fd = new FormData($('#add-edit-advertisement-main-box-body-div  form')[0]);
                //fd.append('dial_code', phone.dialCode);

                $.ajax({
				    url: "{{ route('admin.advertisements.save-add-edit')}}" + "/" + {{$advertisement_id}} + "/" + {{$chk_is_default}},  
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#add-edit-advertisement-main-box-body-div  #createBtn').attr('disabled',true);
                        $('#add-edit-advertisement-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#add-edit-advertisement-main-box-body-div  #createBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
						var res = '';
						if(msg.indexOf("essages.")>0)
						{
						   res = msg.split("essages.");	
						   msg = res[1];
						}
						
                        $('#add-edit-advertisement-main-box-body-div  .message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#add-edit-advertisement-main-box-body-div  #createBtn').attr('disabled',false);                        
                        var int_advertisement_category = $('#add-edit-advertisement-main-box-body-div  #advertisement_category').val();
						window.location.replace('{{ route("admin.advertisements.index")}}'+ "/" + {{$chk_is_default}} + "/" + 0 );
                        
                    }
                });
				
				
				
            });
        });	
		
</script>
@endsection