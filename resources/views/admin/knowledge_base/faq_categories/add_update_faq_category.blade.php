@extends('admin.layouts.master')

@section('title')  @if(!empty($faq_category_data->id)){{ adminTransLang('edit_faq_category') }} @else {{ adminTransLang('add_faq_category') }} @endif @endsection

@section('content')

<style>

</style>
    <section class="content-header">
        <h1> @if(!empty($faq_category_data->id)){{ adminTransLang('edit_faq_category') }} @else {{ adminTransLang('add_faq_category') }} @endif </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.knowledge-base-faq-categories.index') }}">{{ adminTransLang('all_faq_categories') }}</a></li>
            <li class="active">@if(!empty($faq_category_data->id)){{ adminTransLang('edit_faq_category') }} @else {{ adminTransLang('add_faq_category') }} @endif</li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="box">
                     <div class="box-body" id="add-edit-faq-category-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="add-edit-faq-category-main-box-body-form">
						{{ csrf_field() }}
	   
		 <div class="form-group">
          <label for="category" class="col-sm-2 control-label">{{ adminTransLang('faq_question_category') }} <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input id="category" 
	   value="@if(!empty($faq_category_data->category)){{$faq_category_data->category}}@endif" type="text" class="form-control" 
placeholder="Category" name="category">
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
	
            $('body').on('click','#add-edit-faq-category-main-box-body-div  #createBtn',function(e){
                e.preventDefault();
				 
                var fd = new FormData($('#add-edit-faq-category-main-box-body-div  form')[0]);
                //fd.append('dial_code', phone.dialCode);

                $.ajax({
				    url: "{{ route('admin.knowledge-base-faq-categories.save-add-edit')}}" + "/" + {{$faq_category_id}},  
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#add-edit-faq-category-main-box-body-div  #createBtn').attr('disabled',true);
                        $('#add-edit-faq-category-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#add-edit-faq-category-main-box-body-div  #createBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
						var res = '';
						if(msg.indexOf("essages.")>0)
						{
						   res = msg.split("essages.");	
						   msg = res[1];
						}
						
                        $('#add-edit-faq-category-main-box-body-div  .message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#add-edit-faq-category-main-box-body-div  #createBtn').attr('disabled',false);                        
                        window.location.replace('{{ route("admin.knowledge-base-faq-categories.index")}}');
                        
                    }
                });
				
				
				
            });
        });	
		
</script>
@endsection