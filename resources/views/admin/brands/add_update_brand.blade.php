@extends('admin.layouts.master')

@section('title')  @if(!empty($brand_data->id)){{ adminTransLang('edit_brand') }} @else {{ adminTransLang('add_brand') }} @endif @endsection

@section('content')

<style>

</style>
    <section class="content-header">
        <h1> @if(!empty($brand_data->id)){{ adminTransLang('edit_brand') }} @else {{ adminTransLang('add_brand') }} @endif </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.brands.index') }}">{{ adminTransLang('all_brands') }}</a></li>
            <li class="active">@if(!empty($brand_data->id)){{ adminTransLang('edit_brand') }} @else {{ adminTransLang('add_brand') }} @endif</li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="box">
                     <div class="box-body" id="add-edit-brand-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="add-edit-brand-main-box-body-form">
						{{ csrf_field() }}
	   
		 <div class="form-group">
          <label for="name" class="col-sm-2 control-label">{{ adminTransLang('brand_caption') }} <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input id="name" 
	   value="@if(!empty($brand_data->name)){{$brand_data->name}}@endif" type="text" class="form-control" 
placeholder="Name" name="name">
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
	
            $('body').on('click','#add-edit-brand-main-box-body-div  #createBtn',function(e){
                e.preventDefault();
				 
                var fd = new FormData($('#add-edit-brand-main-box-body-div  form')[0]);
                //fd.append('dial_code', phone.dialCode);

                $.ajax({
				    url: "{{ route('admin.brands.save-add-edit')}}" + "/" + {{$brand_id}},  
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#add-edit-brand-main-box-body-div  #createBtn').attr('disabled',true);
                        $('#add-edit-brand-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#add-edit-brand-main-box-body-div  #createBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
						var res = '';
						if(msg.indexOf("essages.")>0)
						{
						   res = msg.split("essages.");	
						   msg = res[1];
						}
						
                        $('#add-edit-brand-main-box-body-div  .message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#add-edit-brand-main-box-body-div  #createBtn').attr('disabled',false);                        
                        window.location.replace('{{ route("admin.brands.index")}}');
                        
                    }
                });				
				
				
            });
        });	
		
</script>
@endsection