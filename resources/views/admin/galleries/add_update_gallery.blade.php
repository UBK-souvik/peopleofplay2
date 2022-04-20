@extends('admin.layouts.master')

@section('title') 

@php
$str_add_edit_gallery_text_new ='';
if($gallery_type == 1)
{
  if(!empty($gallery_data->id))
   { 
     $str_add_edit_gallery_text_new = adminTransLang('edit_image_gallery'); 
   } 
   else
   {	   
     $str_add_edit_gallery_text_new = adminTransLang('add_image_gallery');
   } 
}

if($gallery_type == 2)
{
  if(!empty($gallery_data->id))
  { 
    $str_add_edit_gallery_text_new = adminTransLang('edit_video_gallery'); 
  }
   else 
   {
	 $str_add_edit_gallery_text_new =  adminTransLang('add_video_gallery'); 
   } 
}

if($gallery_type == 3)
{
  $str_add_edit_gallery_text_new =  'Add Known For Gallery';	   
}

if(!empty($gallery_data->is_known_for))
  { 
    $str_add_edit_gallery_text_new = 'Edit Known For Gallery'; 
  }
 
@endphp


@endsection
 
@section('content')

<style>

</style>
    <section class="content-header">
        <h1> {{$str_add_edit_gallery_text_new}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.galleries.index') }}/0/0"> All Galleries </a></li>
            <li class="active">{{$str_add_edit_gallery_text_new}}</li>
        </ol>
    </section>
	
    <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="box">
                     <div class="box-body" id="add-edit-gallery-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="add-edit-gallery-main-box-body-form">
						{{ csrf_field() }}
     
	 
	  <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Select User<i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                   <select @if(!empty($gallery_id)){{'disabled'}}@endif class="form-control select2" name="select_gallery_user_id" id="select_gallery_user_id" onchange="return set_change_user_data(this.value);">
                                     <option value="">Select User</option>
                                     @if(count($users_list) > 0)
                                        @foreach($users_list as $users_list_row)
                                          <option value="{{$users_list_row->id}}" {{ (@$gallery_data->user_id  == $users_list_row->id ) ? 'selected' :''}}> {{$users_list_row->text}}</option>
                                        @endforeach
                                     @endif
                                   </select>
                                </div>
                              </div>
		
       @if($gallery_type == 1 || $gallery_type == 3)		
							  <div class="form-group">
          <label for="advertisement_image" class="col-sm-2 control-label">Photo <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input id="file-uploadten" onchange="readGalleryURL(this);" type="file" name="gallery_image">
			 
            <img @if(!empty($gallery_data->media)){{'style=display:block;'}} @else {{'style=display:none;'}} @endif id="gallery-blah-image" @if(!empty($gallery_data->media)) 
				src="{{ url('/') }}{{ $folder_path }}{{ $str_media_data }}" @endif alt=""
                class="img-fluid z-depth-1-half avatar-pic advertisement_width_height_class" style="width: 200px;min-height: 200px;object-fit: cover;">
            
          </div>
       </div>
	 @endif	 
	   
	   <div class="form-group">
          <label for="name" class="col-sm-2 control-label"> Destination<i class="has-error">*</i></label>
          <div class="col-sm-6">
             <select onchange="return showProdEventDropDownByDest(this.value);"  name="gallery_meta[destination_id]" class="form-control" data-placeholder="Select"> <span class="text-danger">*</span>
                          <option value="">Select Destination</option>
                          @foreach ($arr_destinations_list as $arr_destinations_list_key => $arr_destinations_list_val)
                          @if($arr_destinations_list_key == 4)
						   @continue; 
					      @endif	  
						  <option @if (!empty($int_destination_id) && ($int_destination_id == $arr_destinations_list_key)){{ 'selected' }}  @endif  value="{{$arr_destinations_list_key}}">
                           {{ $arr_destinations_list_val }}</option>
                          @endforeach
                          </select>
          </div>
       </div>
	   
	   <div class="form-group assign-prod-event-drop-down-class"  @if(!empty($int_assign_product_id)) {{ "style=display:block;" }} @else {{ "style=display:none;" }} @endif id="assign-gallery-event-product-div{{ $arr_destinations_list_keys[1] }}">
          <label for="name" class="col-sm-2 control-label" > Product<i class="has-error">*</i></label>
          <div class="col-sm-6"  id="select_div_assign_event_product_id{{ $arr_destinations_list_keys[1] }}">
             
          </div>
       </div>
	   
	   <div class="form-group  assign-prod-event-drop-down-class"  @if(!empty($int_assign_event_id)) {{ "style=display:block;" }} @else {{ "style=display:none;" }} @endif id="assign-gallery-event-product-div{{ $arr_destinations_list_keys[2] }}">
          <label for="name" class="col-sm-2 control-label"> Event<i class="has-error">*</i></label>
          <div class="col-sm-6" id="select_div_assign_event_product_id{{ $arr_destinations_list_keys[2] }}">
             
          </div>
       </div>
	   

	     <div class="form-group">
          <label for="position" class="col-sm-2 control-label">Title</label>
          <div class="col-sm-6">
      		    <input id="Title" type="text" name="gallery_meta[title]" class="form-control" placeholder="" value="@if(!empty($str_title)) {{ $str_title }} @endif">		  		  
          </div>
       </div>
	   	   
	   @if($gallery_type == 2)
					
	   <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Video <i class="has-error">*</i></label>
          <div class="col-sm-6">
      		  <input id="VideoUrl" type="text" name="gallery_meta[video_url]" class="form-control" value="@if(!empty($str_media_data)) {{ $str_media_data }} @endif" placeholder="">		  		  
          </div>
       </div>
	   @endif
	   
	   <div class="form-group">
          <label for="people-tag-id" class="col-sm-2 control-label">People Tag </label>
          <div class="col-sm-6">
      		   <select name="peoples[]" class="custom-select select2" multiple data-placeholder="Select">
                                      {{-- 
                                      <option value="">Select</option>
                                      --}}
                                      @foreach ($people_list as $people_index => $people_value)
                                      <option @if(!empty($arr_peoples[$gallery_id]) && in_array($people_index, $arr_peoples[$gallery_id])){{ 'selected' }}  @endif value="{{$people_index}}">
                                      {{$people_value}}</option>
                                      @endforeach
                                   </select>
						
          </div>
       </div>
	   
	   <div class="form-group">
          <label for="company-tag-id" class="col-sm-2 control-label">Company Tag </label>
          <div class="col-sm-6">
      		  <select name="companies[]" class="custom-select select2" multiple data-placeholder="Select">
                        {{-- <option value="">Select</option> --}}
                        @foreach ($company_list as $company_index => $company_value)
                          <option @if(!empty($arr_companies[$gallery_id]) && in_array($company_index, $arr_companies[$gallery_id])){{ 'selected' }}  @endif value="{{$company_index}}">
                          {{$company_value}}</option>
                        @endforeach
                        </select>	  		  
          </div>
       </div>
	   
	   	<div class="form-group">
			  <label for="product-tag-id" class="col-sm-2 control-label">Product Tag </label>
			  <div class="col-sm-6">
				 <select name="products[]" class="custom-select select2" multiple data-placeholder="Select">
                      {{-- <option value="">Select</option> --}}
                      @foreach ($product_list as $product_index => $product_value)
                        <option @if (!empty($arr_products[$gallery_id]) && in_array($product_index, $arr_products[$gallery_id])){{ 'selected' }}  @endif  value="{{$product_index}}">
                        {{$product_value}}</option>
                      @endforeach
                      </select>
			  </div>
		   </div>
		   <div class="form-group">
			  <label for="Other Tag" class="col-sm-2 control-label">Other Tag</label>
			  <div class="col-sm-6">
				 <input type="text" class="form-control other-tag-input-class" value="@if(!empty($str_others)) {{  $str_others }} @endif" data-role="tagsinput" name="others[]"/>
			     {!!App\Helpers\UtilitiesTwo::getTagText()!!}
			  </div>
		   </div>
	   
	   <div class="form-group">
          <label for="caption" class="col-sm-2 control-label">Caption </label>
          <div class="col-sm-6">
             <input type="" class="form-control" id="Caption" value="@if(!empty($str_caption)) {{ $str_caption }} @endif" name="gallery_meta[caption]">
          </div>
       </div>
       
	   <?php /*
       <div class="form-group">
          <label for="award-tag-id" class="col-sm-2 control-label">Award Tag </label>
          <div class="col-sm-6">
             <select style="width:100px;" name="awards[]" class="custom-select select2" multiple data-placeholder="Select">
                      {{-- <option value="">Select</option> --}}
                      @foreach ($award_list as $award_index => $award_value)
                        <option @if (!empty($arr_awards[$gallery_id]) && in_array($award_index, $arr_awards[$gallery_id])){{ 'selected' }}  @endif  value="{{$award_index}}">
                       {{$award_value}}</option>
                      @endforeach
                      </select>
            
          </div>
       </div>
	   */?>
	   
	   @if($gallery_type == 1)
         <div class="form-group">
          <label for="Url" class="col-sm-2 control-label">Url </label>
          <div class="col-sm-6">
             <input id="Url" type="text" name="gallery_meta[url]" class="form-control" value="@if(!empty($str_url)) {{  $str_url }} @endif" placeholder="">
          </div>
       </div>	   
	  @endif 
                           
                    <div class="col-sm-6" style="margin-top: 8px;">
                        <div class="row">
						
						    <input type="hidden" id="hidden_gallery_user_id" name="hidden_gallery_user_id" value="{{$gallery_user_id}}">
						    <input type="hidden" id="gallery_type" name="gallery_type" value="{{$gallery_type}}">
			                <input id="is_known_for" type="hidden" name="gallery_meta[is_known_for]" value="@if(!empty($is_known_for)){{ $is_known_for }} @endif">
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

function readGalleryURL(input) {
			
			$('#gallery-blah-image').show();
			
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#gallery-blah-image')
                        .attr('src', e.target.result);	

                     var image = new Image();
					image.src = e.target.result;

					image.onload = function() {
						// access image size here 
				
					};
						
                };

                reader.readAsDataURL(input.files[0]);
												
            }
        }

function showProdEventDropDownByDest(dest_id)
{
		
	if(dest_id>0)
	{
	  $( ' .assign-prod-event-drop-down-class').hide(); 	
	  $( '#assign-gallery-event-product-div'+dest_id).show();	
	}

     load_user_event_product_data(dest_id);	
}

$(document).ready(function(){
	
	         showProdEventDropDownByDest({{@$int_destination_id}});
	
            $('body').on('click','#add-edit-gallery-main-box-body-div  #createBtn',function(e){
                e.preventDefault();
				
				var int_select_gallery_user_id = $('#add-edit-gallery-main-box-body-div  #select_gallery_user_id').val();
				 
                var fd = new FormData($('#add-edit-gallery-main-box-body-div  form')[0]);
                //fd.append('dial_code', phone.dialCode);

                $.ajax({
				    url: "{{ route('admin.galleries.save-add-edit')}}" + "/" + {{$gallery_id}} + "/" + {{$gallery_type}},  
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#add-edit-gallery-main-box-body-div  #createBtn').attr('disabled',true);
                        $('#add-edit-gallery-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#add-edit-gallery-main-box-body-div  #createBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
						var res = '';
						if(msg.indexOf("essages.")>0)
						{
						   res = msg.split("essages.");	
						   msg = res[1];
						}
						
                        $('#add-edit-gallery-main-box-body-div  .message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#add-edit-gallery-main-box-body-div  #createBtn').attr('disabled',false);                        
                        var int_advertisement_category = $('#add-edit-gallery-main-box-body-div  #advertisement_category').val();
						window.location.replace('{{ route("admin.galleries.index")}}'+ "/" + int_select_gallery_user_id );
                        
                    }
                });
				
				
				
            });
        });	
		
function set_change_user_data(hidden_gallery_user_id)
{
	$('#hidden_gallery_user_id').val(hidden_gallery_user_id);	
}	
		
function load_user_event_product_data(data_type)
{
	var hidden_gallery_user_id = $('#hidden_gallery_user_id').val();
	var  postData;
     postData = {
            "hidden_gallery_user_id": hidden_gallery_user_id,
			"data_type": data_type,
			"int_assign_product_id": {{@$int_assign_product_id}},
			"int_assign_event_id": {{@$int_assign_event_id}},
			_token: ajax_csrf_token_new,
        };

          $.ajax({
                url: baseUrl + '/admin/galleries/get-user-product-event',
				data: postData,
				type: 'POST',
                beforeSend: function () {
                    //$('#addRoleModalDiv .addUpdateRoleBtn').attr('disabled', true);
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    $('#select_div_assign_event_product_id'+data_type).html('Loading. Please Wait...');
				},
                error: function (jqXHR, exception) {
                    //$('#addRoleModalDiv .addUpdateRoleBtn').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    $('#select_div_assign_event_product_id'+data_type).html('');
					//toastr.error(msg)
                    //console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
					   $('#select_div_assign_event_product_id'+data_type).html(data);	
					
                }
            });	
}
		
</script>
@endsection