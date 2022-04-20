<?php $__env->startSection('title'); ?>  <?php if(!empty($brand_data->id)): ?><?php echo e(adminTransLang('edit_brand')); ?> <?php else: ?> <?php echo e(adminTransLang('add_brand')); ?> <?php endif; ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>

</style>
    <section class="content-header">
        <h1> <?php if(!empty($brand_data->id)): ?><?php echo e(adminTransLang('edit_brand')); ?> <?php else: ?> <?php echo e(adminTransLang('add_brand')); ?> <?php endif; ?> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.brands.index')); ?>"><?php echo e(adminTransLang('all_brands')); ?></a></li>
            <li class="active"><?php if(!empty($brand_data->id)): ?><?php echo e(adminTransLang('edit_brand')); ?> <?php else: ?> <?php echo e(adminTransLang('add_brand')); ?> <?php endif; ?></li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="box">
                     <div class="box-body" id="add-edit-brand-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="add-edit-brand-main-box-body-form">
						<?php echo e(csrf_field()); ?>

	   
		 <div class="form-group">
          <label for="name" class="col-sm-2 control-label"><?php echo e(adminTransLang('brand_caption')); ?> <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input id="name" 
	   value="<?php if(!empty($brand_data->name)): ?><?php echo e($brand_data->name); ?><?php endif; ?>" type="text" class="form-control" 
placeholder="Name" name="name">
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
	
            $('body').on('click','#add-edit-brand-main-box-body-div  #createBtn',function(e){
                e.preventDefault();
				 
                var fd = new FormData($('#add-edit-brand-main-box-body-div  form')[0]);
                //fd.append('dial_code', phone.dialCode);

                $.ajax({
				    url: "<?php echo e(route('admin.brands.save-add-edit')); ?>" + "/" + <?php echo e($brand_id); ?>,  
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#add-edit-brand-main-box-body-div  #createBtn').attr('disabled',true);
                        $('#add-edit-brand-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#add-edit-brand-main-box-body-div  #createBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
						var res = '';
						if(msg.indexOf("essages.")>0)
						{
						   res = msg.split("essages.");	
						   msg = res[1];
						}
						
                        $('#add-edit-brand-main-box-body-div  .message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#add-edit-brand-main-box-body-div  #createBtn').attr('disabled',false);                        
                        window.location.replace('<?php echo e(route("admin.brands.index")); ?>');
                        
                    }
                });				
				
				
            });
        });	
		
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>