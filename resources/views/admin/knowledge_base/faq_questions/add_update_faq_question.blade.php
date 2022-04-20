@extends('admin.layouts.master')

@section('title')  @if(!empty($faq_question_data->id)){{ adminTransLang('edit_faq_question') }} @else {{ adminTransLang('add_faq_question') }} @endif @endsection

@section('content')

<style>

</style>
    <section class="content-header">
        <h1> @if(!empty($faq_question_data->id)){{ adminTransLang('edit_faq_question') }} @else {{ adminTransLang('add_faq_question') }} @endif </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.knowledge-base-faq-questions.index') }}">{{ adminTransLang('all_faq_questions') }}</a></li>
            <li class="active">@if(!empty($faq_question_data->id)){{ adminTransLang('edit_faq_question') }} @else {{ adminTransLang('add_faq_question') }} @endif</li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="box">
                     <div class="box-body" id="add-edit-faq-question-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="add-edit-faq-question-main-box-body-form">
						{{ csrf_field() }}

	   <div class="form-group">
          <label for="category_id" class="col-sm-2 control-label">{{ adminTransLang('faq_question_category') }} <i class="has-error">*</i></label>
          <div class="col-sm-6">
      		  <select required name="category_id" class="form-control select2 py-3">
                    <option value=""> Select Category</option>
                    @foreach($faq_question_categories as $faq_question_categories_id => $faq_question_categories_name)
                    <option value="{{$faq_question_categories_id}}" {{(!empty($faq_question_data->category_id) && $faq_question_categories_id == $faq_question_data->category_id)? 'selected' : ''}}>{{$faq_question_categories_name}}</option>
                    @endforeach
      		  </select>		  		  
          </div>
       </div>
	   
		 <div class="form-group">
          <label for="question" class="col-sm-2 control-label">{{ adminTransLang('faq_question_caption') }} <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input id="question" 
	   value="@if(!empty($faq_question_data->question)){{$faq_question_data->question}}@endif" type="text" class="form-control" 
placeholder="Question" name="question">
          </div>
       </div>


<div class="form-group">
          <label for="answer" class="col-sm-2 control-label">{{ adminTransLang('faq_question_answer') }} <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <textarea class="form-control" id="answer" name="answer" placeholder="Answer">@if(!empty($faq_question_data->answer)){{$faq_question_data->answer}}@endif
                          </textarea>
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

admin_show_standard_ckeditor_new('answer');

$(document).ready(function(){
	
            $('body').on('click','#add-edit-faq-question-main-box-body-div  #createBtn',function(e){
                e.preventDefault();
				
				var ckeditor_description_new = admin_get_ckeditor_description_new('answer');
			
				var form= $('#add-edit-faq-question-main-box-body-form');			
				var someData = form.serializeArray();			
				someData.push({ name: 'answer', value: ckeditor_description_new });
				 
                //var fd = new FormData($('#add-edit-faq-question-main-box-body-div  form')[0]);
                //fd.append('dial_code', phone.dialCode);

                $.ajax({
				    url: "{{ route('admin.knowledge-base-faq-questions.save-add-edit')}}" + "/" + {{$faq_question_id}},  
                    //data: fd,
                    //processData: false,
                    //contentType: false,
					headers: {
                      'X-CSRF-TOKEN': ajax_csrf_token_new
                    },
					data: someData,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#add-edit-faq-question-main-box-body-div  #createBtn').attr('disabled',true);
                        $('#add-edit-faq-question-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#add-edit-faq-question-main-box-body-div  #createBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
						var res = '';
						if(msg.indexOf("essages.")>0)
						{
						   res = msg.split("essages.");	
						   msg = res[1];
						}
						
                        $('#add-edit-faq-question-main-box-body-div  .message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#add-edit-faq-question-main-box-body-div  #createBtn').attr('disabled',false);                        
                        window.location.replace('{{ route("admin.knowledge-base-faq-questions.index")}}');
                        
                    }
                });
				
				
				
            });
        });	
		
</script>
@endsection