@extends('front.layouts.pages')
@section('content')
<div class="col-md-6 col-lg-7 MiddleColumnSection">
<div class="left-column">
    <form id="award-form" enctype="multipart/form-data">
        <input type="hidden" name="media_id" value="{{@$media->id}}">
        @csrf
        <div class="First-column bg-white">
            <h3 class="sec_head_text mb-0" style="padding: 20px;">
			@if(!empty($media->id))
			  {{'Edit'}}
			@else
			  {{'Add'}}	
			@endif
			
			Awards</h3>
            <div class="col-md-12">
                <div class="row sectionBox pb-0">
                    @php
					  $str_featured_image_type_new = 'award';
					@endphp
					@include('front.user.include_featured_image')
					
                    <div class="col-md-8">
						<div class="form-group">
							<label for="Add New Post">Title</label><span class="text-danger">*</span>
							<input id="AddNewPost" type="text" name="title" value="{{@$media->title}}" class="form-control" placeholder="">
						</div>
						<div class="form-group">
							<label for="Add New Post">Url</label><span class="text-danger">*</span>
							<input id="AddNewUrl" type="text" name="url_data" value="{{@$media->url_data}}" class="form-control" placeholder="">
						</div>  
                    </div>
					
					<!-- <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 pl-0">
                                <div class="form-group">
                                    <label for="Add New Post">Url</label><span class="text-danger">*</span>
                                    <input id="AddNewUrl" type="text" name="url_data" value="{{@$media->url_data}}" class="form-control" placeholder="">
                                </div>
                            </div>
                            
                        </div>
                    </div> -->
                <!-- </div> -->
                    
                </div>
                </div>
            
            <div class="col-md-12">
              <div class="row sectionBox">
			   <div class="col-md-12">
					<button type="button" id="awardSubmit" class="btn btnAll az">Publish <i class="fa fa-spinner fa-spin str_loader" style="display: none;"></i></button>                
					@include('includes.include_add_update_loading_btn')	
				</div>			
			  </div>
            </div>
            </div>
    </form>
</div>
</div>
@endsection

@section('scripts')
<script>

     // Event Form
     $(document).on('click', '#awardSubmit', function (e) {
            e.preventDefault();
			
			var chk_is_valid_file = FileValidation('featured_image');
			
			if(chk_is_valid_file)
			{
				var fd = new FormData($('#award-form')[0]);  
				
				$.ajax({
					url: "{{ route('front.user.award.create') }}",
					headers: {
					 'X-CSRF-TOKEN': ajax_csrf_token_new
					},
					data: fd,
					processData: false,
					contentType: false,
					dataType: 'json',
					type: 'POST',
					beforeSend: function () {
						$('#awardSubmit').attr('disabled',true);
						$('.str_loader').show();
					},
					error: function (jqXHR, exception) {
						var msg = formatErrorMessage(jqXHR, exception);
						toastr.error(msg)
						$('.str_loader').hide();
						$('#awardSubmit').attr('disabled',false);
					},
					success: function (data) {
					   toastr.success("Award Saved Successfully.");
					   window.location.replace('{{ route("front.user.award.index")}}');
					   $('.str_loader').hide();
					   $('#awardSubmit').attr('disabled',false);

					}
				});
			}	
			
        });

</script>
@endsection
