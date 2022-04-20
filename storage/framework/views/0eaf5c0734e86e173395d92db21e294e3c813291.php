<?php $__env->startSection('title'); ?> Edit Menu Page <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <section class="content-header">
        <h1> Edit Menu Page</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?> </a></li>
            <li><a href="<?php echo e(url('admin/cms/main-list-page')); ?>"> Menu Page </a></li>
            <li class="active">Edit Menu Page</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Display Order</label>
                                <div class="col-sm-6">
                                    <?php if($main_list_page->display_order == 3 || $main_list_page->display_order == 11 || $main_list_page->display_order == 12 || $main_list_page->display_order == 13 || $main_list_page->display_order == 14 || $main_list_page->display_order == 15 || $main_list_page->display_order == 16): ?>
                                        <input type="text" readonly="" name="display_order" class="form-control" value="<?php echo e($main_list_page->display_order); ?>">
                                    <?php else: ?> 
                                        <select name="display_order" readonly class="form-control">
                                            <?php $__currentLoopData = config('cms.drop_down_type'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($key == 3) { continue; } ?> 
                                                <option value="<?php echo e($key); ?>" 
                                                    <?php echo e($main_list_page->display_order == $key ? 'selected' : ''); ?>><?php echo e($key); ?> 
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-6">
                                <input type="text" name="title" class="form-control" value="<?php echo e($main_list_page->title); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-6">
                                    <input type="hidden" name="type" class="form-control" value="<?php echo e(@$main_list_page->type); ?>">
                                    <input type="text" readonly="" name="type_for_show" class="form-control" value="<?php echo e(ucfirst(config('cms.drop_down_type')[@$main_list_page->type])); ?>" >

                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status"  class="form-control">
                                    <?php $__currentLoopData = config('cms.action_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e($main_list_page->status == $key ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-6">
                                    <select required name="category_id" id="category_id" <?php if(!empty($int_category_id)): ?><?php echo e('disabled'); ?><?php endif; ?>  class="form-control" onchange="return get_category_items(this.value);">
                                      <option value="0">Select</option>
									  <?php $__currentLoopData = $arr_mainlist_destination_types_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr_mainlist_destination_type_key => $arr_mainlist_destination_type_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									   <?php if(empty($int_video_category_id) && $arr_mainlist_destination_type_key!=8): ?>
									    <option <?php if(!empty($int_category_id) && ($int_category_id == $arr_mainlist_destination_type_key)): ?><?php echo e('selected'); ?>  <?php endif; ?>  value="<?php echo e($arr_mainlist_destination_type_key); ?>"><?php echo e($arr_mainlist_destination_type_val); ?></option>
									   <?php endif; ?>
									  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>						  
                                    </select>
									
									<input type="hidden" name="hidden_category_id" id="hidden_category_id" value="<?php if(!empty($int_category_id)): ?><?php echo e(@$int_category_id); ?><?php endif; ?>">
                                </div>
                            </div>

                            <hr>
                            <hr>
                            <?php if($int_video_category_id == 8): ?>
                                <div id="video_section" >
                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Title 1</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="video_title[]" class="form-control" 
                                            value="<?php echo e((isset($main_list_page->videos[0]->video_title) ) ? $main_list_page->videos[0]->video_title : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Link 1</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="Link[]" class="form-control" 
                                            value="<?php echo e((isset($main_list_page->videos[0]->video_link) ) ? $main_list_page->videos[0]->video_link : ''); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Title 2</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="video_title[]" class="form-control" 
                                            value="<?php echo e((isset($main_list_page->videos[1]->video_title) ) ? $main_list_page->videos[1]->video_title : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Link 2</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="Link[]" class="form-control" 
                                            value="<?php echo e((isset($main_list_page->videos[1]->video_link)) ? $main_list_page->videos[1]->video_link : ''); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Title 3</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="video_title[]" class="form-control" 
                                            value="<?php echo e((isset($main_list_page->videos[2]->video_title) ) ? $main_list_page->videos[2]->video_title : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Link 3</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="Link[]" class="form-control" 
                                            value="<?php echo e((isset($main_list_page->videos[2]->video_link)) ? $main_list_page->videos[2]->video_link : ''); ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Title 4</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="video_title[]" class="form-control" 
                                            value="<?php echo e((isset($main_list_page->videos[3]->video_title) ) ? $main_list_page->videos[3]->video_title : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Link 4</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="Link[]" class="form-control" 
                                            value="<?php echo e((isset($main_list_page->videos[3]->video_link)) ? $main_list_page->videos[3]->video_link : ''); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Title 5</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="video_title[]" class="form-control" 
                                            value="<?php echo e((isset($main_list_page->videos[4]->video_title) ) ? $main_list_page->videos[4]->video_title : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Link 5</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="Link[]" class="form-control" value="<?php echo e((isset($main_list_page->videos[4]->video_link)) ? $main_list_page->videos[4]->video_link : ''); ?>">
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Title 6</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="video_title[]" class="form-control" 
                                            value="<?php echo e((isset($main_list_page->videos[5]->video_title) ) ? $main_list_page->videos[5]->video_title : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Link 6</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="Link[]" class="form-control" value="<?php echo e((isset($main_list_page->videos[5]->video_link)) ? $main_list_page->videos[5]->video_link : ''); ?>">
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Title 7</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="video_title[]" class="form-control" 
                                            value="<?php echo e((isset($main_list_page->videos[6]->video_title) ) ? $main_list_page->videos[6]->video_title : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Link 7</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="Link[]" class="form-control" value="<?php echo e((isset($main_list_page->videos[6]->video_link)) ? $main_list_page->videos[6]->video_link : ''); ?>">
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Title 8</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="video_title[]" class="form-control" 
                                            value="<?php echo e((isset($main_list_page->videos[7]->video_title) ) ? $main_list_page->videos[7]->video_title : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Link 8</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="Link[]" class="form-control" value="<?php echo e((isset($main_list_page->videos[7]->video_link)) ? $main_list_page->videos[7]->video_link : ''); ?>">
                                        </div>
                                    </div>
									
                                </div>
                            <?php else: ?>
                                <span id="isExpandable" >
                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                        <div class="col-sm-6" id="div-main-list-category">
                                            
                                        </div>
                                    </div>
                                </span>
                            <?php endif; ?>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="button" class="btn btn-success" id="updateBtn"><?php echo e(adminTransLang('update')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">

function load_select_ajax_list()
{
	
	var int_category_id = $('#category_id').val();
	
// Select2 Ajax
        $("#select-ajax").select2({
            minimumInputLength: 2,
            ajax: {
                url: '<?php echo e(route("admin.cms.main_list_page.search")); ?>',
                // dataType: 'json',
                placeholder: "Search Item",
                allowClear: true,
                type: "GET",
                quietMillis: 100,
                delay: 250,
                data: function (term) {
                    return {
                        query: term,
                        //type: $('[name="type"]').val()
						type: int_category_id
                    };
                },
                processResults: function (data,params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                        pagination: {
                            more: (params.page * 50) < data.total
                        },
                        cache:true
                    }
                }
            }
        });

}

function get_category_items(category_id)
{
		
	$('#hidden_category_id').val(category_id);
	
$.ajax({

			url: '<?php echo e(route("admin.mainlist.get-category-items")); ?>',

			type: 'post',

			data: {

			 category_id: category_id,
			 main_list_page_id:<?php echo e(@$main_list_page_id); ?>,
			 token: ajax_csrf_token_new,

			},

			headers: {

			 'X-CSRF-TOKEN': ajax_csrf_token_new

			},
			
			beforeSend: function () {
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                  $('#div-main-list-category').html('Loading...Please Wait.');
				},
                error: function (jqXHR, exception) {
                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg)
                    //console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },

			success: function( data ) {
				$('#div-main-list-category').html(data);
                load_select_ajax_list();				
			}

		   });
}

    jQuery(function ($) {

        // Change Type Event
        function onChangeOfType() {
            // var isExpandable = $('#isExpandable');
            // var video_section = $('#video_section');
            // var type = $('[name="type"]');
            // isExpandable.hide();
            // video_section.hide();
            // if($.inArray(parseInt(type.val()),[1,2,4,6]) !== -1) {
            //     isExpandable.show();
            // }
            // else if($.inArray(parseInt(type.val()),[3]) !== -1) {
            //     video_section.show();
            // }

        }

        onChangeOfType();
        $(document).on('change','[name="type"]',function() {
            // $('#select-ajax').val('');
            // // onChangeOfType()
        });
        // End Change Type Event

	    get_category_items(<?php echo e(@$int_category_id); ?>)
        // End Select1 Ajax


        // On Form Submit
        $(document).on('click', '#updateBtn', function (e) {
            e.preventDefault();

            $.ajax({
                url: "<?php echo e(route('admin.cms.main_list_page.update', ['id' => $main_list_page->id])); ?>",
                data: $('form').serialize(),
                dataType: 'json',
                type: 'POST',
                beforeSend: function () {
                    $('#updateBtn').attr('disabled', true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    $('#updateBtn').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    $('#updateBtn').attr('disabled', false);
                    $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    // window.location.replace('<?php echo e(route("admin.cms.main_list_page.index")); ?>');
                    window.location.replace("<?php echo e(URL('admin/cms/main-list-page')); ?>?type="+data.type);
                }
            });
        });
        // End On Form Submit
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>