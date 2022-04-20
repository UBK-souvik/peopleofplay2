

<?php $__env->startSection('title'); ?> 
<?php echo e('Import CSV'); ?>

<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('content'); ?>

<style>

</style>
    <section class="content-header">
        <h1> <?php echo e('Import CSV'); ?>  </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.users.company.show.import.csv')); ?>">
<?php echo e('Import CSV'); ?></a></li>
            <li class="active"> <?php echo e('Import CSV'); ?></li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="box">
                     <div class="box-body" id="import-csv-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="import-csv-main-box-body-form" method="post" enctype="multipart/form-data" action ="<?php echo e(route('admin.users.company.save-import-users-data.csv')); ?>">
						<?php echo e(csrf_field()); ?>


       
       <div class="form-group">
          <label for="advertisement_image" class="col-sm-2 control-label">CSV File <i class="has-error">*</i></label>
          <div class="col-sm-6">
           
                <input id="file-uploadten-csv"  accept=".csv" type="file" name="import_csv_file" class="marginTopFive">
            
          </div>
       </div>
	   
                           
                    <div class="col-sm-6" style="margin-top: 8px;">
                        <div class="row">
                            <button type="submit" class="btn btn-success" id="createBtn">Save</button>
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
	
           $('body').on('click','#import-csv-main-box-body-div  #createBtn',function(e){
                e.preventDefault();
				
				
				var fileType = ".csv";
				var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
				if (!regex.test($("#file-uploadten-csv").val().toLowerCase())) {
					$('#import-csv-main-box-body-div  .message_box').html("Invalid File. Upload : <b>" + fileType + "</b> Files.").removeClass('hide');	
					//return false;
				}
				
				 
                var fd = new FormData($('#import-csv-main-box-body-div  form')[0]);
                //fd.append('dial_code', phone.dialCode);

                $.ajax({
				    url: "<?php echo e(route('admin.subscripitions.save-import-invoice-data.csv')); ?>",  
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#import-csv-main-box-body-div  #createBtn').attr('disabled',true);
                        $('#import-csv-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#import-csv-main-box-body-div  #createBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
						var res = '';
						if(msg.indexOf("essages.")>0)
						{
						   res = msg.split("essages.");	
						   msg = res[1];
						}
						
                        $('#import-csv-main-box-body-div  .message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#import-csv-main-box-body-div  #createBtn').attr('disabled',false);                        
                        
                    }
                });
				
				
				
            });
        });	
		
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>