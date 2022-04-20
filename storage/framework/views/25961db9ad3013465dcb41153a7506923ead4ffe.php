

<?php $__env->startSection('title'); ?>  <?php if(!empty($article_category_data->id)): ?><?php echo e(adminTransLang('edit_article_category')); ?> <?php else: ?> <?php echo e(adminTransLang('add_article_category')); ?> <?php endif; ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>

</style>
    <section class="content-header">
        <h1> <?php if(!empty($article_category_data->id)): ?><?php echo e(adminTransLang('edit_article_category')); ?> <?php else: ?> <?php echo e(adminTransLang('add_article_category')); ?> <?php endif; ?> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.knowledge-base-article-categories.index')); ?>"><?php echo e(adminTransLang('all_article_categories')); ?></a></li>
            <li class="active"><?php if(!empty($article_category_data->id)): ?><?php echo e(adminTransLang('edit_article_category')); ?> <?php else: ?> <?php echo e(adminTransLang('add_article_category')); ?> <?php endif; ?></li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="box">
                     <div class="box-body" id="add-edit-article-category-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="add-edit-article-category-main-box-body-form">
						<?php echo e(csrf_field()); ?>

	   
		 <div class="form-group">
          <label for="category" class="col-sm-2 control-label"><?php echo e(adminTransLang('article_category')); ?> <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input id="category" 
	   value="<?php if(!empty($article_category_data->category)): ?><?php echo e($article_category_data->category); ?><?php endif; ?>" type="text" class="form-control" 
placeholder="Category" name="category">
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
	
            $('body').on('click','#add-edit-article-category-main-box-body-div  #createBtn',function(e){
                e.preventDefault();
				 
                var fd = new FormData($('#add-edit-article-category-main-box-body-div  form')[0]);
                //fd.append('dial_code', phone.dialCode);

                $.ajax({
				    url: "<?php echo e(route('admin.knowledge-base-article-categories.save-add-edit')); ?>" + "/" + <?php echo e($article_category_id); ?>,  
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#add-edit-article-category-main-box-body-div  #createBtn').attr('disabled',true);
                        $('#add-edit-article-category-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#add-edit-article-category-main-box-body-div  #createBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
						var res = '';
						if(msg.indexOf("essages.")>0)
						{
						   res = msg.split("essages.");	
						   msg = res[1];
						}
						
                        $('#add-edit-article-category-main-box-body-div  .message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#add-edit-article-category-main-box-body-div  #createBtn').attr('disabled',false);                        
                        window.location.replace('<?php echo e(route("admin.knowledge-base-article-categories.index")); ?>');
                        
                    }
                });
				
				
				
            });
        });	
		
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>