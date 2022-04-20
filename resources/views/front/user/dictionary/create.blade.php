@extends('front.layouts.pages')
@section('content')

@php
$int_description_words_length = @App\Helpers\UtilitiesTwo::word_description_words_length();
@endphp

<div class="col-md-6 col-lg-7 MiddleColumnSection"> 
<div class="left-column" id="add-edit-dictionary-div-id">
    <form id="dictionary-form" enctype="multipart/form-data">
        <input type="hidden" name="dictionary_id" value="{{@$dictionary->id}}">
        @csrf
        <div class="First-column bg-white">
            <h3 class="sec_head_text mb-0" style="padding: 20px;">
			@if(!empty($dictionary->id))
			  {{'Edit'}}
			@else
			  {{'Add'}}	
			@endif
			
			Dictionary Post</h3>
            <div class="col-md-12">
                <div class="row sectionBox pb-0">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 pl-0">
                                <div class="form-group">
                                    <label for="Add New Post">Word</label><span class="text-danger">*</span>
                                    <input id="AddNewPost" type="text" name="title" value="{{@$dictionary->title}}" class="form-control" placeholder="">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                <!-- </div> -->
                    <div class="col-md-12 pl-0  paddingBottomTwenty">
                            <div class="form-group m-0">
                                <label for="Comments">Description</label><span class="text-danger">*</span>
                                <textarea maxlength="{{$int_description_words_length}}" id="Comments" name="description"  row="10" class="form-control">{{@$dictionary->description}}</textarea>
                            </div>
                    </div>
                    
                </div>
                </div>
            
            <div class="col-md-12">
              <div class="row sectionBox">
                <button type="button" id="dictionarySubmit" class="btn btnAll az">Save</button>
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
     $(document).on('click', '#dictionarySubmit', function (e) {
            e.preventDefault();
			
			var fd = new FormData($('#dictionary-form')[0]);  
			
            $.ajax({
                url: "{{ route('front.user.dictionary.create') }}",
				headers: {
                 'X-CSRF-TOKEN': ajax_csrf_token_new
                },
                data: fd,
                processData: false,
                contentType: false,
				dataType: 'json',
                type: 'POST',
                beforeSend: function () {
                    $('#dictionarySubmit').attr('disabled', true);
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    $('#dictionarySubmit').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg)
                    console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    $('#dictionarySubmit').attr('disabled', false);
					toastr.success("Dictionary Saved Successfully.");
                    //$('#dictionary-form').trigger('reset')
                    // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    //toastr.success(data.message)
                    window.location.replace('{{ route("front.user.dictionary.index")}}');

                }
            });
        });

</script>
@endsection
