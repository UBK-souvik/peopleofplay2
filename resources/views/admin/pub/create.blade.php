      @extends('admin.layouts.master')

@section('title') Edit Pub @endsection

@section('content')
<style>
    .social_media .form-group {
         margin-right: 0px; 
         margin-left: 0px; 
    }
</style>
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Edit Pub</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.pub.index') }}"> Pub </a></li>
            <li class="active">Edit Pub</li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body" id="add-edit-user-main-box-body-div">
                            <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                            <form class="form-horizontal" id="create-form" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="{{@$event->id}}">
                                @csrf
                                <div class="accordion">
                                    <div class="accordion__header is-active">
                                        <h2>Basic Details</h2>
                                        <span class="accordion__toggle"></span>
                                    </div>
                                    <div class="accordion__body is-active">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Header <i class="has-error">*</i></label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" id="header" name="header" rows="4">{{@$event->header}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="main_image" class="col-sm-2 control-label">Main Image </label>
                                            <div class="col-sm-6">
                                               <img id="blah" width="100" height="70" src="{{imageBasePath($event->main_image)}}" class="imgHundred">
                                                <input type="file" name="main_image">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="zoom_text_1" class="col-sm-2 control-label">Zoom Text 1</label>
                                          <div class="col-sm-6">
                                             <input required type="text" class="form-control" name="zoom_text_1" placeholder="Fun Fact 1" value="@if(!empty(@$event->zoom_text_1)){{@$event->zoom_text_1}}@endif">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="fun_fact1" class="col-sm-2 control-label">Zoom Image 1</label>
                                          <div class="col-sm-6">
                                            <img id="blah" width="100" height="70" src="{{imageBasePath($event->zoom_image_1)}}" class="imgHundred">
                                             <input type="file" name="zoom_image_1">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="zoom_text_2" class="col-sm-2 control-label">Zoom Text 2</label>
                                          <div class="col-sm-6">
                                             <input required type="text" class="form-control" name="zoom_text_2" placeholder="Fun Fact 2" value="@if(!empty(@$event->zoom_text_2)){{@$event->zoom_text_2}}@endif">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="fun_fact1" class="col-sm-2 control-label">Zoom Image 2</label>
                                          <div class="col-sm-6">
                                            <img id="blah" width="100" height="70" src="{{imageBasePath($event->zoom_image_2)}}" class="imgHundred">
                                             <input type="file" name="zoom_image_2">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="zoom_text_3" class="col-sm-2 control-label">Zoom Text 3</label>
                                          <div class="col-sm-6">
                                             <input required type="text" class="form-control" name="zoom_text_3" placeholder="Fun Fact 3" value="@if(!empty(@$event->zoom_text_3)){{@$event->zoom_text_3}}@endif">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="fun_fact1" class="col-sm-2 control-label">Zoom Image 3</label>
                                          <div class="col-sm-6">
                                            <img id="blah" width="100" height="70" src="{{imageBasePath($event->zoom_image_3)}}" class="imgHundred">
                                             <input type="file" name="zoom_image_3">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="zoom_text_4" class="col-sm-2 control-label">Zoom Text 4</label>
                                          <div class="col-sm-6">
                                             <input required type="text" class="form-control" name="zoom_text_4" placeholder="Fun Fact 3" value="@if(!empty(@$event->zoom_text_4)){{@$event->zoom_text_4}}@endif">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="fun_fact1" class="col-sm-2 control-label">Zoom Image 4</label>
                                          <div class="col-sm-6">
                                            <img id="blah" width="100" height="70" src="{{imageBasePath($event->zoom_image_4)}}" class="imgHundred">
                                             <input type="file" name="zoom_image_4">
                                          </div>
                                       </div>
                                       @for ($i=1; $i<=10; $i++)
                                         <div class="form-group">
                                            <label for="fun_fact1" class="col-sm-2 control-label">News {{$i}}</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control replace_ckeditor" id="news_{{$i}}" name="news_{{$i}}" rows="4">
                                                  @switch($i)
                                                      @case(1)
                                                          {{@$event->news_1}}
                                                          @break
                                                      @case(2)
                                                          {{@$event->news_2}}
                                                          @break
                                                      @case(3)
                                                          {{@$event->news_3}}
                                                          @break
                                                      @case(4)
                                                          {{@$event->news_4}}
                                                          @break
                                                      @case(5)
                                                          {{@$event->news_5}}
                                                          @break
                                                      @case(6)
                                                          {{@$event->news_6}}
                                                          @break
                                                      @case(7)
                                                          {{@$event->news_7}}
                                                          @break
                                                      @case(8)
                                                          {{@$event->news_8}}
                                                          @break
                                                      @case(9)
                                                          {{@$event->news_9}}
                                                          @break
                                                      @case(10)
                                                          {{@$event->news_10}}
                                                          @break
                                                      @default
                                                          {{@$event->news_1}}
                                                  @endswitch
                                                </textarea>
                                            </div>
                                         </div>
                                       @endfor
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
    admin_show_standard_ckeditor_new('header');

    jQuery(function($) {
      $(document).on('click','#createBtn',function(e){
            e.preventDefault();

            var fd = new FormData($('form')[0]);  
            var header = admin_get_ckeditor_description_new('header');
            var news_1 = admin_get_ckeditor_description_new('news_1');
            var news_2 = admin_get_ckeditor_description_new('news_2');
            var news_3 = admin_get_ckeditor_description_new('news_3');
            var news_4 = admin_get_ckeditor_description_new('news_4');
            var news_5 = admin_get_ckeditor_description_new('news_5');
            var news_6 = admin_get_ckeditor_description_new('news_6');
            var news_7 = admin_get_ckeditor_description_new('news_7');
            var news_8 = admin_get_ckeditor_description_new('news_8');
            var news_9 = admin_get_ckeditor_description_new('news_9');
            var news_10 = admin_get_ckeditor_description_new('news_10');

            fd.append('header', header);
            fd.append('news_1', news_1);
            fd.append('news_2', news_2);
            fd.append('news_3', news_3);
            fd.append('news_4', news_4);
            fd.append('news_5', news_5);
            fd.append('news_6', news_6);
            fd.append('news_7', news_7);
            fd.append('news_8', news_8);
            fd.append('news_9', news_9);
            fd.append('news_10', news_10);

            $.ajax({
                processData: false,
                contentType: false,
                url: "{{ route('admin.pub.create') }}",
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
                        window.location.replace('{{ route("admin.pub.index")}}');

                    } else {
                        var message = formatErrorMessageFromJSON(data.errors);
                        $('.message_box').html(message).removeClass('hide');
                    }

                }
            });
        });
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
      var add_row = Number("<?=$k=0?>");
      $('#add_news').click(function(){
            var html = "";
            html +=      '<div class="form-group">';
            html +=         '<label for="name" class="col-sm-2 control-label">News <i class="has-error">*</i></label>';
            html +=         '<div class="col-sm-6">';
            html +=             '<textarea class="form-control editor" id="news_'+add_row+'" name="news_'+add_row+'" rows="4"></textarea>';
            html +=         '</div>';
            html +=     '</div>';

            add_row++;
            $("#news_div").append(html);
            admin_show_standard_ckeditor_new('news_'+add_row);
      });
  })
  $('.replace_ckeditor').each(function (index) {
      var id      = $( this ).attr('id');
      admin_show_standard_ckeditor_new(id);
  });

</script>

@endsection
