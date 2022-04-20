

<?php $__env->startSection('title'); ?> 
<?php if(empty($chk_is_default)): ?>  <?php if(!empty($advertisement->id)): ?><?php echo e(adminTransLang('edit_advertisement')); ?> <?php else: ?> <?php echo e(adminTransLang('add_advertisement')); ?> <?php endif; ?> <?php endif; ?> 
<?php if(!empty($chk_is_default)): ?>  <?php if(!empty($advertisement->id)): ?><?php echo e(adminTransLang('edit_default_advertisement')); ?> <?php else: ?> <?php echo e(adminTransLang('add_default_advertisement')); ?> <?php endif; ?> <?php endif; ?> 
<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('content'); ?>

<style>

</style>
    <section class="content-header">
        <h1> <?php if(empty($chk_is_default)): ?>  <?php if(!empty($advertisement->id)): ?><?php echo e(adminTransLang('edit_advertisement')); ?> <?php else: ?> <?php echo e(adminTransLang('add_advertisement')); ?> <?php endif; ?> <?php endif; ?> 
<?php if(!empty($chk_is_default)): ?>  <?php if(!empty($advertisement->id)): ?><?php echo e(adminTransLang('edit_default_advertisement')); ?> <?php else: ?> <?php echo e(adminTransLang('add_default_advertisement')); ?> <?php endif; ?> <?php endif; ?>  </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.advertisements.index')); ?>/<?php echo e($chk_is_default); ?>/0">
<?php if(empty($chk_is_default)): ?>
 <?php echo e(adminTransLang('all_advertisements')); ?> 
<?php else: ?>
 <?php echo e(adminTransLang('all_default_advertisements')); ?> 	
<?php endif; ?></a></li>
            <li class="active"><?php if(empty($chk_is_default)): ?>  <?php if(!empty($advertisement->id)): ?><?php echo e(adminTransLang('edit_advertisement')); ?> <?php else: ?> <?php echo e(adminTransLang('add_advertisement')); ?> <?php endif; ?> <?php endif; ?> 
<?php if(!empty($chk_is_default)): ?>  <?php if(!empty($advertisement->id)): ?><?php echo e(adminTransLang('edit_default_advertisement')); ?> <?php else: ?> <?php echo e(adminTransLang('add_default_advertisement')); ?> <?php endif; ?> <?php endif; ?> </li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="box">
                     <div class="box-body" id="add-edit-advertisement-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="add-edit-advertisement-main-box-body-form">
						<?php echo e(csrf_field()); ?>


         <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Type <i class="has-error">*</i></label>
          <div class="col-sm-6">
      		  <select required name="type" class="form-control select2 py-3">
                    <option value="1" <?php echo e((!empty($advertisement->type) && $advertisement->type == 1)? 'selected' : ''); ?>>Image</option>
						
      		  </select>		  		  
          </div>
       </div>
	   
		 <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Title <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input id="title" 
	   value="<?php if(!empty($advertisement->title)): ?><?php echo e($advertisement->title); ?><?php endif; ?>" type="text" class="form-control" 
placeholder="Title" name="title">
          </div>
       </div>
	   
	   <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Home Page Custom Text 1 </label>
          <div class="col-sm-6">
             <input id="home_caption_one" 
	   value="<?php if(!empty($advertisement->home_caption_one)): ?><?php echo e($advertisement->home_caption_one); ?><?php endif; ?>" type="text" class="form-control" 
placeholder="Title" name="home_caption_one">
          </div>
       </div>
	   
	   <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Home Page Custom Text 2 </label>
          <div class="col-sm-6">
             <input id="home_caption_two" 
	   value="<?php if(!empty($advertisement->home_caption_two)): ?><?php echo e($advertisement->home_caption_two); ?><?php endif; ?>" type="text" class="form-control" 
placeholder="Title" name="home_caption_two">
          </div>
       </div>

	     <div class="form-group">
          <label for="position" class="col-sm-2 control-label">Position <i class="has-error">*</i></label>
          <div class="col-sm-6">
      		  <select required  <?php if(!empty($advertisement->advertisement_position) && $advertisement->advertisement_position ==4 ): ?><?php echo e('readonly'); ?><?php endif; ?> name="advertisement_position" class="form-control">
                    <option value=""> Select Position</option>
                    <?php $__currentLoopData = $advertisement_position; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advertisement_position_id => $advertisement_position_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($advertisement_position_id); ?>" <?php echo e((!empty($advertisement->advertisement_position) && $advertisement_position_id == $advertisement->advertisement_position)? 'selected' : ''); ?>><?php echo e($advertisement_position_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      		  </select>		  		  
          </div>
       </div>
	   
	   <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Page <i class="has-error">*</i></label>
          <div class="col-sm-6">
      		  <select required id="advertisement_category" name="advertisement_category" class="form-control select2 py-3">
                    <option value=""> Select Page</option>
                    <?php $__currentLoopData = $advertisement_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advertisement_category_id => $advertisement_category_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($advertisement_category_id); ?>" <?php echo e((!empty($advertisement->advertisement_category) && $advertisement_category_id == $advertisement->advertisement_category)? 'selected' : ''); ?>><?php echo e($advertisement_category_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      		  </select>		  		  
          </div>
       </div>
	   
	   <?php if(empty($chk_is_default) || $chk_is_default<=0): ?>
			<div class="form-group">
			  <label for="name" class="col-sm-2 control-label">From date <i class="has-error">*</i></label>
			  <div class="col-sm-6">
				 <input id="add_edit_advertisement_from" 
		   value="<?php if(!empty($advertisement->from_date)): ?><?php echo e($advertisement->from_date); ?><?php endif; ?>" type="date" class="form-control" 
	placeholder="Date From" name="from_date">
			  </div>
		   </div>
		   <div class="form-group">
			  <label for="name" class="col-sm-2 control-label">To date <i class="has-error">*</i></label>
			  <div class="col-sm-6">
				 <input id="add_edit_advertisement_from" 
		   value="<?php if(!empty($advertisement->to_date)): ?><?php echo e($advertisement->to_date); ?><?php endif; ?>" type="date" class="form-control" 
	placeholder="Date From" name="to_date">
			  </div>
		   </div>
	   <?php endif; ?>
	   
	   <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Destination Link <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input type="text" class="form-control" name="destination_link" placeholder="Destination Link"  value="<?php if(!empty($advertisement->destination_link)): ?><?php echo e($advertisement->destination_link); ?><?php endif; ?>">
          </div>
       </div>
       
       <div class="form-group">
          <label for="advertisement_image" class="col-sm-2 control-label">Image <i class="has-error">*</i></label>
          <div class="col-sm-6">
             
			 
            <img <?php if(!empty($advertisement->advertisement_image)): ?><?php echo e('style=display:block;'); ?> <?php else: ?> <?php echo e('style=display:none;'); ?> <?php endif; ?> id="advertisement-blah-image" <?php if(!empty($advertisement->advertisement_image)): ?> 
				src="<?php echo e(imageBasePath($advertisement->advertisement_image)); ?>" <?php endif; ?> alt=""
                class="imgHundred" >

                <input id="file-uploadten" onchange="readBannerURL(this);" type="file" name="advertisement_image" class="marginTopFive">
            
          </div>
       </div>
	   
	   
         <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Sponsor Name <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input type="text" class="form-control" name="sponsor_name" placeholder="Sponsor Name"  value="<?php if(!empty($advertisement->sponsor_name)): ?><?php echo e($advertisement->sponsor_name); ?><?php endif; ?>">
          </div>
       </div>	   
	   
                           
                    <div class="col-sm-6" style="margin-top: 8px;">
                        <div class="row">
						    <input type="hidden" id="is_default" name="is_default" value="<?php echo e($chk_is_default); ?>">
			                <input type="hidden" name="banner_width_hidden" id="banner_width_hidden">
                            <input type="hidden" name="banner_height_hidden" id="banner_height_hidden">							
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
	
            $('body').on('click','#add-edit-advertisement-main-box-body-div  #createBtn',function(e){
                e.preventDefault();
				 
                var fd = new FormData($('#add-edit-advertisement-main-box-body-div  form')[0]);
                //fd.append('dial_code', phone.dialCode);

                $.ajax({
				    url: "<?php echo e(route('admin.advertisements.save-add-edit')); ?>" + "/" + <?php echo e($advertisement_id); ?> + "/" + <?php echo e($chk_is_default); ?>,  
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#add-edit-advertisement-main-box-body-div  #createBtn').attr('disabled',true);
                        $('#add-edit-advertisement-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#add-edit-advertisement-main-box-body-div  #createBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
						var res = '';
						if(msg.indexOf("essages.")>0)
						{
						   res = msg.split("essages.");	
						   msg = res[1];
						}
						
                        $('#add-edit-advertisement-main-box-body-div  .message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#add-edit-advertisement-main-box-body-div  #createBtn').attr('disabled',false);                        
                        var int_advertisement_category = $('#add-edit-advertisement-main-box-body-div  #advertisement_category').val();
						window.location.replace('<?php echo e(route("admin.advertisements.index")); ?>'+ "/" + <?php echo e($chk_is_default); ?> + "/" + 0 );
                        
                    }
                });
				
				
				
            });
        });	
		
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>