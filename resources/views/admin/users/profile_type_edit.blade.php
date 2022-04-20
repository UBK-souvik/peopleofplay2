@extends('admin.layouts.master')

@section('title') {{ adminTransLang('all_users') }} @endsection

@section('content')

<link href="{{asset('backend/plugins/tags.css')}}" rel="stylesheet">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
 
<style>
.intl-tel-input.allow-dropdown {width: 100%; }
</style>
    <section class="content-header">
        <h1> @if(!empty($user->id)){{ adminTransLang('edit_user_new') }} @else {{ adminTransLang('create_user') }} @endif </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.users.index') }}">{{ adminTransLang('all_users') }}</a></li>
            <li class="active">@if(!empty($user->id)){{ adminTransLang('edit_user_new') }} @else {{ adminTransLang('create_user') }} @endif</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
           <div class="col-md-12">
              <div class="box">
                 <div class="box-body" id="add-edit-user-main-box-body-div">
                    <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                    <form class="form-horizontal" id="add-edit-user-main-box-body-form">
    					{{ csrf_field() }}

                        <div class="accordion">
                    	    <div class="accordion__header is-active">
                                <h2>Basic Details</h2>
                                <span class="accordion__toggle"></span>
                            </div>
                            <div class="accordion__body is-active">
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 control-label">Profile Type <i class="has-error">*</i></label>
                                  <div class="col-sm-6">
                                      <select required name="user_type" class="form-control py-3">
                                            <!-- <option value="">Type</option> -->
                                            <option {{($user_type == 4) ? 'selected' : ''}} value="4">POP Company</option>
                                            <option {{($user_type == 2) ? 'selected' : ''}} value="2">POP Pro</option>
                                            <option {{($user_type == 3) ? 'selected' : ''}} value="3">POP Basic</option>
                                      </select>               
                                  </div>
                                </div>
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
        $('body').on('click','#add-edit-user-main-box-body-div  #createBtn',function(e){
            e.preventDefault();
            var fd = new FormData($('#add-edit-user-main-box-body-div  form')[0]);

            $.ajax({
			    url: "{{ route('admin.profile_type.edit', @$user_id) }}",
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function()
                {
                    $('#add-edit-user-main-box-body-div  #createBtn').attr('disabled',true);
                    $('#add-edit-user-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function(jqXHR, exception){
                    $('#add-edit-user-main-box-body-div  #createBtn').attr('disabled',false);
                    
                    var msg = formatErrorMessage(jqXHR, exception);
					var res = msg.replace(/The/g, "");
					
                    $('#add-edit-user-main-box-body-div  .message_box').html(res).removeClass('hide');
                },
                success: function (data)
                {
                    $('#add-edit-user-main-box-body-div  #createBtn').attr('disabled',false);                        
                    window.location.replace('{{ route("admin.profile_type.index")}}');
                    
                }
            });
        });
    });	
</script>	
		

@endsection