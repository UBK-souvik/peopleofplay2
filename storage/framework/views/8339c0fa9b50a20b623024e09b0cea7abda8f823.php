<?php $__env->startSection('title'); ?> View Event <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<style>
    .social_media .form-group {
         margin-right: 0px;
         margin-left: 0px;
    }
</style>

    <section class="content-header">
        <h1> View Event</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.event.index')); ?>"> All Events </a></li>
            <li class="active">View Event</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body" id="add-edit-user-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                            <div class="accordion">
                                <div class="accordion__header is-active">
                                    <h2>Basic Details</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body is-active">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th>Main Image</th>
                                                <td>
                                                    <?php if(@$event->main_image): ?>
                                                        <img id="blah" width="100" height="70" src="<?php echo e(imageBasePath($event->main_image)); ?>" class="imgHundred">
                                                    <?php else: ?>
                                                        <img id="blah" src="#" alt="Preview" class="imgHundred">
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>User</th>
                                                <td>
                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(isset($event) && $event->user_id == $id): ?>
                                                            <?php echo e(@$text->text); ?>

                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Event ID</th>
                                                <td><?php echo e(@$event->event_id_number ?? generateRandomString()); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Name</th>
                                                <td><?php echo e(@$event->name); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Website</th>
                                                <td><a target="_blank" href="<?php echo e(@$event->website); ?>"><?php echo e(@$event->website); ?></a></td>
                                            </tr>
                                            <tr>
                                                <th>URL</th>
                                                <td><a target="_blank" href="<?php echo e(url('event/'.$event->slug)); ?>"><?php echo e($event->slug); ?></a></td>
                                            </tr>
                                            <tr>
                                                <th>Description</th>
                                                <td><?php echo @$event->description; ?></td>
                                            </tr>
                                            <?php if(!empty($event->fun_fact1) ): ?>
                                                <tr>
                                                    <th>Fun Fact</th>
                                                    <td><?php echo e($event->fun_fact1); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if(!empty($event->fun_fact2) ): ?>
                                                <tr>
                                                    <th>Fun Fact</th>
                                                    <td><?php echo e($event->fun_fact2); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if(!empty($event->fun_fact3) ): ?>
                                                <tr>
                                                    <th>Fun Fact</th>
                                                    <td><?php echo e($event->fun_fact3); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="accordion__header">
                                    <h2>Social Media</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body">
                                    <div class="row social_media">
                                        <?php $__currentLoopData = config('cms.social_media'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $str_social_val = '';
                                                if(!empty(@$event->socialMedia))
                                                {
                                                    $str_social_val = @$event->socialMedia->pluck('value','type')->toArray()[$index];
                                                }
                                            ?>
                                                <div class="col-md-3" >
                                                    <div class="form-group">
                                                        <label for="<?php echo e($social); ?>"><?php echo e($social); ?></label>
                                                        <input type="url" id="<?php echo e($social); ?>" name="socials[<?php echo e($index); ?>]" readonly="" value="<?php echo e($str_social_val); ?>" class="form-control">
                                                    </div>
                                                </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php /*    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <table class="table table-striped table-bordered no-margin">
                            <tbody>
                                <tr>
                                    <th>Main Image</th>
                                    <td>
                                        @if(@$event->main_image)
                                            <img id="blah" width="100" height="70" src="{{imageBasePath($event->main_image)}}" class="imgHundred">
                                        @else
                                            <img id="blah" src="#" alt="Preview" class="imgHundred">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>User</th>
                                    <td>
                                        @foreach ($users as $id => $name)
                                            @if(isset($event) && $event->user_id == $id)
                                                {{$name}}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>Event ID</th>
                                    <td>{{@$event->event_id_number ?? generateRandomString()}}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{@$event->name}}</td>
                                </tr>
                                <tr>
                                    <th>Website</th>
                                    <td><a target="_blank" href="{{@$event->website}}">{{@$event->website}}</a></td>
                                </tr>
                                <tr>
                                    <th>URL</th>
                                    <td><a target="_blank" href="{{url('event/'.$event->slug)}}">{{$event->slug}}</a></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{@$event->description}}</td>
                                </tr>
                                @if(!empty($event->fun_fact1) )
                                    <tr>
                                        <th>Fun Fact</th>
                                        <td>{{ $event->fun_fact1 }}</td>
                                    </tr>
                                @endif
                                @if(!empty($event->fun_fact2) )
                                    <tr>
                                        <th>Fun Fact</th>
                                        <td>{{ $event->fun_fact2 }}</td>
                                    </tr>
                                @endif
                                @if(!empty($event->fun_fact3) )
                                    <tr>
                                        <th>Fun Fact</th>
                                        <td>{{ $event->fun_fact3 }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered no-margin">
                            <tbody>
                                <tr><th></th></tr>
                                <tr>
                                    <th colspan="3" style="text-align: center;">Social Media</th>
                                </tr>
                            </tbody>
                        </table>

                        <div class="accordion__body">
                                <div class="row social_media">
                                    @foreach(config('cms.social_media') as $index => $social)
                                        <?php
                                          $str_social_val = '';
                                          if(!empty($event->socialMedia))
                                          {
                                            $str_social_val = @$event->socialMedia->pluck('value','type')->toArray()[$index];
                                          }
                                        ?>
                                            <div class="col-md-3" >
                                                <div class="form-group" style="margin-left: 0px !important;margin-right: 0px !important;">
                                                    <label for="{{ $social }}">{{ $social }}</label>
                                                    <input type="url" readonly="" id="{{ $social }}" name="socials[{{$index}}]"
                                                     value="{{$str_social_val}}"
                                                         class="form-control">
                                                </div>
                                            </div>
                                    @endforeach
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section> */?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">
    jQuery(function($) {
    $('.select2').select2()
      $(document).on('click','#createBtn',function(e){
            e.preventDefault();
            $.ajax({
                processData: false,
                contentType: false,
                url: "<?php echo e(route('admin.event.create')); ?>",
                data: new FormData($('form')[0]),
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
                        window.location.replace('<?php echo e(route("admin.event.index")); ?>');

                    } else {
                        var message = formatErrorMessageFromJSON(data.errors);
                        $('.message_box').html(message).removeClass('hide');
                    }

                }
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>