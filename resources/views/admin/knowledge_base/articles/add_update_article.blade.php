@extends('admin.layouts.master')

@section('title')  @if(!empty($article_data->id)){{ adminTransLang('edit_article') }} @else {{ adminTransLang('add_article') }} @endif @endsection

@section('content')

<style>

</style>
    <section class="content-header">
        <h1> @if(!empty($article_data->id)){{ adminTransLang('edit_article') }} @else {{ adminTransLang('add_article') }} @endif </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.knowledge-base-articles.index') }}">{{ adminTransLang('all_articles') }}</a></li>
            <li class="active">@if(!empty($article_data->id)){{ adminTransLang('edit_article') }} @else {{ adminTransLang('add_article') }} @endif</li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="box">
                     <div class="box-body" id="add-edit-article-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="add-edit-article-main-box-body-form">
						{{ csrf_field() }}

	   <div class="form-group">
          <label for="category_id" class="col-sm-2 control-label">{{ adminTransLang('article_category') }} <i class="has-error">*</i></label>
          <div class="col-sm-6">
      		  <select required name="category_id" class="form-control select2 py-3">
                    <option value=""> Select Category</option>
                    @foreach($article_categories as $article_categories_id => $article_categories_name)
                    <option value="{{$article_categories_id}}" {{(!empty($article_data->category_id) && $article_categories_id == $article_data->category_id)? 'selected' : ''}}>{{$article_categories_name}}</option>
                    @endforeach
      		  </select>		  		  
          </div>
       </div>
	   
		 <div class="form-group">
          <label for="title" class="col-sm-2 control-label">{{ adminTransLang('article_caption') }} <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input id="title" 
	   value="@if(!empty($article_data->title)){{$article_data->title}}@endif" type="text" class="form-control" 
placeholder="Title" name="title">
          </div>
       </div>


<div class="form-group">
          <label for="description" class="col-sm-2 control-label">{{ adminTransLang('article_description') }} <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <textarea class="form-control" id="description" name="description" placeholder="Description">@if(!empty($article_data->description)){{$article_data->description}}@endif
                          </textarea>
          </div>
       </div>

<div class="form-group">
          <label for="description" class="col-sm-2 control-label">Tag <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input id="tag" type="text" data-role="tagsinput" name="tag[]" class="form-control other-tag-input-class" value="@if(!empty($article_data->tag)){{$article_data->tag}}@endif" placeholder="Tag">
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

admin_show_standard_ckeditor_new('description');

$(document).ready(function(){
	
            $('body').on('click','#add-edit-article-main-box-body-div  #createBtn',function(e){
                e.preventDefault();
				
				var ckeditor_description_new = admin_get_ckeditor_description_new('description');
			
				var form= $('#add-edit-article-main-box-body-form');			
				var someData = form.serializeArray();			
				someData.push({ name: 'description', value: ckeditor_description_new });
				 
                //var fd = new FormData($('#add-edit-article-main-box-body-div  form')[0]);
                //fd.append('dial_code', phone.dialCode);

                $.ajax({
				    url: "{{ route('admin.knowledge-base-articles.save-add-edit')}}" + "/" + {{$article_id}},  
					headers: {
                      'X-CSRF-TOKEN': ajax_csrf_token_new
                    },
                    data: someData,
                    //processData: false,
                    //contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#add-edit-article-main-box-body-div  #createBtn').attr('disabled',true);
                        $('#add-edit-article-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#add-edit-article-main-box-body-div  #createBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
						var res = '';
						if(msg.indexOf("essages.")>0)
						{
						   res = msg.split("essages.");	
						   msg = res[1];
						}
						
                        $('#add-edit-article-main-box-body-div  .message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#add-edit-article-main-box-body-div  #createBtn').attr('disabled',false);                        
                        window.location.replace('{{ route("admin.knowledge-base-articles.index")}}');
                        
                    }
                });
				
				
				
            });
        });	
		
</script>
@endsection