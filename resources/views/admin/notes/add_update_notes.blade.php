@extends('admin.layouts.master')

@section('title') 

  @if(!empty($notes_data->id)){{ adminTransLang('edit_notes') }} @else {{ adminTransLang('add_notes') }} @endif 

@endsection
 
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> @if(!empty($notes_data->id)){{ adminTransLang('edit_notes') }} @else {{ adminTransLang('add_notes') }} @endif</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.notes.index') }}"> {{ adminTransLang('all_notes') }} </a></li>
            <li class="active">@if(!empty($notes_data->id)){{ adminTransLang('edit_notes') }} @else {{ adminTransLang('add_notes') }} @endif</li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="box">
                     <div class="box-body" id="add-edit-notes-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="add-edit-notes-main-box-body-form">
						{{ csrf_field() }}
     
	 
		
       
	   <div class="form-group">
          <label for="name" class="col-sm-2 control-label"> Destination<i class="has-error">*</i></label>
          <div class="col-sm-6">
             <select onchange="return showProdEventDropDownByDestNew(this.value, 'notes');"  name="notes_meta[destination_id]" class="form-control" data-placeholder="Select"> <span class="text-danger">*</span>
                          <option value="">Select Destination</option>
                          @foreach ($arr_destinations_list as $arr_destinations_list_key => $arr_destinations_list_val)
                          @if($arr_destinations_list_key>2)
						   @continue 
					      @endif
						  <option @if (!empty($int_destination_id) && ($int_destination_id == $arr_destinations_list_key)){{ 'selected' }}  @endif  value="{{$arr_destinations_list_key}}">
                           {{ $arr_destinations_list_val }}</option>
                          @endforeach
                          </select>
          </div>
       </div>
	   
	   <div class="form-group assign-prod-event-drop-down-class"  @if(!empty($int_assign_user_id)) {{ "style=display:block;" }} @else {{ "style=display:none;" }} @endif id="assign-notes-event-product-div{{ $arr_destinations_list_keys[0] }}">
          <label for="name" class="col-sm-2 control-label" > User<i class="has-error">*</i></label>
          <div class="col-sm-6"  id="select_div_assign_event_product_id{{ $arr_destinations_list_keys[0] }}">
          </div>
       </div>
	   
	   <div class="form-group assign-prod-event-drop-down-class"  @if(!empty($int_assign_product_id)) {{ "style=display:block;" }} @else {{ "style=display:none;" }} @endif id="assign-notes-event-product-div{{ $arr_destinations_list_keys[1] }}">
          <label for="name" class="col-sm-2 control-label" > Product<i class="has-error">*</i></label>
          <div class="col-sm-6"  id="select_div_assign_event_product_id{{ $arr_destinations_list_keys[1] }}">
          </div>
       </div>
	   
	     <div class="form-group">
          <label for="position" class="col-sm-2 control-label">Note 1<i class="has-error">*</i></label>
          <div class="col-sm-6">
      		    <textarea id="notes_1" type="text" name="notes_meta[notes_1]" class="form-control" placeholder="" value="">@if(!empty($notes_data->notes_1)) {{ $notes_data->notes_1 }} @endif</textarea>		  		  
          </div>
       </div>
	   
	   <div class="form-group">
          <label for="position" class="col-sm-2 control-label">Note 2<i class="has-error">*</i></label>
          <div class="col-sm-6">
      		    <textarea id="notes_2" type="text" name="notes_meta[notes_2]" class="form-control" placeholder="" value="">@if(!empty($notes_data->notes_2)) {{ $notes_data->notes_2 }} @endif</textarea>		  		  
          </div>
       </div>
	   
	   <div class="form-group">
          <label for="position" class="col-sm-2 control-label">Note 3<i class="has-error">*</i></label>
          <div class="col-sm-6">
      		    <textarea id="notes_3" type="text" name="notes_meta[notes_3]" class="form-control" placeholder="" value="">@if(!empty($notes_data->notes_3)) {{ $notes_data->notes_3 }} @endif</textarea>		  		  
          </div>
       </div>
	   	   
		<div class="form-group">
                        <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              @foreach(config('cms.action_status') as $key => $status)
								  <option value="{{ $key }}" {{!empty($notes_data) && $notes_data->status == $key ? 'selected' : ''}}>{{ $status }}</option>
							  @endforeach
                            </select>
                        </div>
                      </div>   
	   
		   
                           
                    <div class="col-sm-6" style="margin-top: 8px;">
                        <div class="row">
						
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
	
	$('.select2').select2();
	
	       @if(!empty($notes_data->id))
            showProdEventDropDownByDestNew({{@$int_destination_id}}, 'notes', {{@$int_assign_profile_id}}, {{@$int_assign_product_id}});
	       @endif
		   
	
            $('body').on('click','#add-edit-notes-main-box-body-div  #createBtn',function(e){
                e.preventDefault();
				 
                var fd = new FormData($('#add-edit-notes-main-box-body-div  form')[0]);
                //fd.append('dial_code', phone.dialCode);

                $.ajax({
				    url: baseUrl + '/admin/notes/save-add-edit/{{$notes_id}}',
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#add-edit-notes-main-box-body-div  #createBtn').attr('disabled',true);
                        $('#add-edit-notes-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#add-edit-notes-main-box-body-div  #createBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
						var res = '';
						if(msg.indexOf("essages.")>0)
						{
						   res = msg.split("essages.");	
						   msg = res[1];
						}
						
                        $('#add-edit-notes-main-box-body-div  .message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#add-edit-notes-main-box-body-div  #createBtn').attr('disabled',false);                        
                        window.location.replace('{{ route("admin.notes.index")}}' );
                        
                    }
                });
				
				
				
            });
        });	
	
				
</script>

@include('includes.include_tags_js')
@endsection