

<?php $__env->startSection('title'); ?> 

  <?php if(!empty($notes_data->id)): ?><?php echo e(adminTransLang('edit_notes')); ?> <?php else: ?> <?php echo e(adminTransLang('add_notes')); ?> <?php endif; ?> 

<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php if(!empty($notes_data->id)): ?><?php echo e(adminTransLang('edit_notes')); ?> <?php else: ?> <?php echo e(adminTransLang('add_notes')); ?> <?php endif; ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.notes.index')); ?>"> <?php echo e(adminTransLang('all_notes')); ?> </a></li>
            <li class="active"><?php if(!empty($notes_data->id)): ?><?php echo e(adminTransLang('edit_notes')); ?> <?php else: ?> <?php echo e(adminTransLang('add_notes')); ?> <?php endif; ?></li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="box">
                     <div class="box-body" id="add-edit-notes-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="add-edit-notes-main-box-body-form">
						<?php echo e(csrf_field()); ?>

     
	 
		
       
	   <div class="form-group">
          <label for="name" class="col-sm-2 control-label"> Destination<i class="has-error">*</i></label>
          <div class="col-sm-6">
             <select onchange="return showProdEventDropDownByDestNew(this.value, 'notes');"  name="notes_meta[destination_id]" class="form-control" data-placeholder="Select"> <span class="text-danger">*</span>
                          <option value="">Select Destination</option>
                          <?php $__currentLoopData = $arr_destinations_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr_destinations_list_key => $arr_destinations_list_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($arr_destinations_list_key>2): ?>
						   <?php continue; ?> 
					      <?php endif; ?>
						  <option <?php if(!empty($int_destination_id) && ($int_destination_id == $arr_destinations_list_key)): ?><?php echo e('selected'); ?>  <?php endif; ?>  value="<?php echo e($arr_destinations_list_key); ?>">
                           <?php echo e($arr_destinations_list_val); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
          </div>
       </div>
	   
	   <div class="form-group assign-prod-event-drop-down-class"  <?php if(!empty($int_assign_user_id)): ?> <?php echo e("style=display:block;"); ?> <?php else: ?> <?php echo e("style=display:none;"); ?> <?php endif; ?> id="assign-notes-event-product-div<?php echo e($arr_destinations_list_keys[0]); ?>">
          <label for="name" class="col-sm-2 control-label" > User<i class="has-error">*</i></label>
          <div class="col-sm-6"  id="select_div_assign_event_product_id<?php echo e($arr_destinations_list_keys[0]); ?>">
          </div>
       </div>
	   
	   <div class="form-group assign-prod-event-drop-down-class"  <?php if(!empty($int_assign_product_id)): ?> <?php echo e("style=display:block;"); ?> <?php else: ?> <?php echo e("style=display:none;"); ?> <?php endif; ?> id="assign-notes-event-product-div<?php echo e($arr_destinations_list_keys[1]); ?>">
          <label for="name" class="col-sm-2 control-label" > Product<i class="has-error">*</i></label>
          <div class="col-sm-6"  id="select_div_assign_event_product_id<?php echo e($arr_destinations_list_keys[1]); ?>">
          </div>
       </div>
	   
	     <div class="form-group">
          <label for="position" class="col-sm-2 control-label">Note 1<i class="has-error">*</i></label>
          <div class="col-sm-6">
      		    <textarea id="notes_1" type="text" name="notes_meta[notes_1]" class="form-control" placeholder="" value=""><?php if(!empty($notes_data->notes_1)): ?> <?php echo e($notes_data->notes_1); ?> <?php endif; ?></textarea>		  		  
          </div>
       </div>
	   
	   <div class="form-group">
          <label for="position" class="col-sm-2 control-label">Note 2<i class="has-error">*</i></label>
          <div class="col-sm-6">
      		    <textarea id="notes_2" type="text" name="notes_meta[notes_2]" class="form-control" placeholder="" value=""><?php if(!empty($notes_data->notes_2)): ?> <?php echo e($notes_data->notes_2); ?> <?php endif; ?></textarea>		  		  
          </div>
       </div>
	   
	   <div class="form-group">
          <label for="position" class="col-sm-2 control-label">Note 3<i class="has-error">*</i></label>
          <div class="col-sm-6">
      		    <textarea id="notes_3" type="text" name="notes_meta[notes_3]" class="form-control" placeholder="" value=""><?php if(!empty($notes_data->notes_3)): ?> <?php echo e($notes_data->notes_3); ?> <?php endif; ?></textarea>		  		  
          </div>
       </div>
	   	   
		<div class="form-group">
                        <label for="status" class="col-sm-2 control-label"><?php echo e(adminTransLang('status')); ?> <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              <?php $__currentLoopData = config('cms.action_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								  <option value="<?php echo e($key); ?>" <?php echo e(!empty($notes_data) && $notes_data->status == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
							  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
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
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<script>


$(document).ready(function(){
	
	$('.select2').select2();
	
	       <?php if(!empty($notes_data->id)): ?>
            showProdEventDropDownByDestNew(<?php echo e(@$int_destination_id); ?>, 'notes', <?php echo e(@$int_assign_profile_id); ?>, <?php echo e(@$int_assign_product_id); ?>);
	       <?php endif; ?>
		   
	
            $('body').on('click','#add-edit-notes-main-box-body-div  #createBtn',function(e){
                e.preventDefault();
				 
                var fd = new FormData($('#add-edit-notes-main-box-body-div  form')[0]);
                //fd.append('dial_code', phone.dialCode);

                $.ajax({
				    url: baseUrl + '/admin/notes/save-add-edit/<?php echo e($notes_id); ?>',
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#add-edit-notes-main-box-body-div  #createBtn').attr('disabled',true);
                        $('#add-edit-notes-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#add-edit-notes-main-box-body-div  #createBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
						var res = '';
						if(msg.indexOf("essages.")>0)
						{
						   res = msg.split("essages.");	
						   msg = res[1];
						}
						
                        $('#add-edit-notes-main-box-body-div  .message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#add-edit-notes-main-box-body-div  #createBtn').attr('disabled',false);                        
                        window.location.replace('<?php echo e(route("admin.notes.index")); ?>' );
                        
                    }
                });
				
				
				
            });
        });	
	
				
</script>

<?php echo $__env->make('includes.include_tags_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>