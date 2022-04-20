@extends('admin.layouts.master')

@section('title') Home Page Whatever Day Create @endsection

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Home Page Whatever Day Create</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.cms.happy_whatever_day.index') }}"> All Home Page Whatever Day List</a></li>
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
                        <input type="hidden" name="happy_whatever_day_id" value="{{@$happy_whatever_day->id}}">
    
							{{-- <div class="form-group">
									<label for="email" class="col-sm-2 control-label">Is Home Page Display</label>
									<div class="col-sm-6">
										<input id="is_home_page" type="checkbox" value="1" @if(!empty($product->is_home_page)){{'checked="checked"'}}@endif name="product[is_home_page]" placeholder="">
									</div>
							</div> --}}
							
							 <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Custom Text 1 <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <input id="home_caption_one" type="text" value="{{ @$happy_whatever_day->home_caption_one }}" name="home_caption_one" class="form-control" placeholder="">
                                </div>
                             </div>

                             <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Custom Text 2 <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <input id="home_caption_two" type="text" value="{{ @$happy_whatever_day->home_caption_two }}" name="home_caption_two" class="form-control" placeholder="">
                                </div>
                             </div>
							 
							 {{-- <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Url Text</label>
                                <div class="col-sm-6">
                                    <input id="home_page_url_text" type="text" value="{{ @$happy_whatever_day->home_page_url_text }}" name="home_page_url_text" class="form-control" placeholder="">
                                </div>
                             </div> 
							 
							 <div class="form-group">
								<label for="name" class="col-sm-2 control-label">Photo <i class="has-error">*</i></label>
								<div class="col-sm-6">
								<img id="profile-blah-image" src="{{@collectionImageBasePath(@$happy_whatever_day->featured_image)}}" alt="" class="imgHundred">
								<input type="file" name="featured_image" class="marginTopFive">
								</div>
							  </div>
							 
							 <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Link</label>
                                <div class="col-sm-6">
                                    <input id="home_page_url" type="text" value="{{ @$happy_whatever_day->home_page_url }}" name="home_page_url" class="form-control" placeholder="">
                                </div>
                             </div> --}}
							 
							 <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Product <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control select2" name="product_id">
                            <option value="">Select</option>
                            @foreach($get_product_list_dropdown as $arr_get_product_list_dropdown_row)
					           @php
							   //$arr_get_product_list_dropdown_row =  json_decode(@$get_product_list_dropdown_row);
							   $key = @$arr_get_product_list_dropdown_row->id;
							   $status = @$arr_get_product_list_dropdown_row->text;
                               @endphp							   
							  <option value="{{ $key }}" {{isset($happy_whatever_day->product_id) && $happy_whatever_day->product_id == $key ? 'selected' : ''}}>{{ $status }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
					  
					  <div class="form-group">
			  <label for="name" class="col-sm-2 control-label">Date of Publish</label>
			  <div class="col-sm-6">
				 <input  min="<?php echo date("Y-m-d"); ?>" id="date_to_be_published" 
		   value="@if(!empty($happy_whatever_day->date_to_be_published)){{$happy_whatever_day->date_to_be_published}}@endif" type="date" class="form-control" 
	placeholder="Publish Date" name="date_to_be_published">
			  </div>
		   </div>
							 
							 
					                        <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              @foreach(config('cms.action_status') as $key => $status)
								  <option value="{{ $key }}" {{isset($happy_whatever_day) && $happy_whatever_day->status == $key ? 'selected' : ''}}>{{ $status }}</option>
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
        </div>
    </section>
@endsection


@section('scripts')
<script type="text/javascript">


    jQuery(function($) {
        $('.select2').select2()

        $(document).on('click','#createBtn',function(e){
            e.preventDefault();
      			
      			var fd = new FormData($('#create-form')[0]);  
  		
            $.ajax({
                processData: false,
                contentType: false,
                data: fd,
                dataType: 'json',
                url: '{{route("admin.cms.happy_whatever_day.update")}}',
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
                        window.location.replace('{{ route("admin.cms.happy_whatever_day.index")}}');

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
