@extends('admin.layouts.master')

@section('title') Create Profile @endsection

@section('content')
<style>
    .social_media .form-group {
         margin-right: 0px;
         margin-left: 0px;
    }
</style>
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create Section three Profile</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.sectionprofile.index') }}">Section three Profile </a></li>
            <li class="active">Create Section three Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body" id="add-edit-user-main-box-body-div">
                            <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                            <form class="form-horizontal" id="create-form" enctype="multipart/form-data">
                                <input type="hidden" name="profile_id" value="{{@$section_profile->id}}">
                                @csrf
                                <div class="accordion">
                                    <div class="accordion__header is-active">
                                        <h2>Basic Details</h2>
                                        <span class="accordion__toggle"></span>
                                    </div>
                                    <div class="accordion__body is-active">
                                        {{-- <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Profile Header <i class="has-error">*</i></label>
                                            <div class="col-sm-6">
                                            <input type="text" class="form-control" name="profileHeader" placeholder="" value="{{@$section_profile->profileHeader}}">
                                            </div>
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Name <i class="has-error">*</i></label>
                                            <div class="col-sm-6">
                                            <input type="text" class="form-control" name="profileName" placeholder="Enter Name" value="{{@$section_profile->profileName}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Url <i class="has-error">*</i></label>
                                            <div class="col-sm-6">
                                            <input type="text" class="form-control" name="profileUrl" placeholder="Enter Url"
                                             value="{{@$section_profile->profileUrl}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="fun_fact1" class="col-sm-2 control-label">Subtitle</label>
                                            <div class="col-sm-6">
                                               <input required type="text" class="form-control" name="profileSubtitle" placeholder="Enter Subtitle" value="{{@$section_profile->profileSubtitle}}">
                                            </div>
                                         </div>
                                        <div class="form-group">
                                            <label for="main_image" class="col-sm-2 control-label">Main Image <i class="has-error">*</i></label>
                                            <div class="col-sm-6">
                                                <input type="file" name="main_image">
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
                    </div>
                </div>
            </div>
    </section>
@endsection


@section('scripts')

<script type="text/javascript">
    // admin_show_standard_ckeditor_new('description');

    jQuery(function($) {
      $(document).on('click','#createBtn',function(e){

        // alert("ok");
            e.preventDefault();

            var fd = new FormData($('form')[0]);
            // var ckeditor_description_new = admin_get_ckeditor_description_new('description');
            // fd.append('description', ckeditor_description_new);

            // var error = '';
            // $( ".social" ).each(function( index ) {
            //     var str = $( this ).val();
            //     var name = $(this).attr('id');
            //     if(str != ''){
            //         console.log(name + validURL(str))
            //         if(validURL(str) == false){
            //             $('.message_box').html(name + ' URL is Invalid').removeClass('alert-success hide').addClass('alert-danger');
            //             error = 'yes';
            //             return false;
            //         }
            //     }
            // });
            // if(error != '' && error == 'yes'){
            //     return false;
            // }
            $.ajax({
                processData: false,
                contentType: false,
                url: "{{ route('admin.sectionprofile.create') }}",
                data: fd,
                dataType: 'json',
                type: 'POST',
                beforeSend: function()
                {
                    $('#createBtn').attr('disabled',true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function(jqXHR, exception){
                    $('#createBtn').attr('disabled',false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data)
                {
                    $('#createBtn').attr('disabled',false);
                    if(data.status == 1)
                    {
                        $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        // alert(data.msg);
                        window.location.replace('{{ route("admin.sectionprofile.index")}}');

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
