
<?php $__env->startSection('content'); ?>
<style>
    /*.k_table thead th {
        text-align: center;
        font-size: 15px!important;
    }*/
</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
<div class="left-column border_right">
    <div class="First-column bg-white p-3">
        <h3 class="Tile-style social mb-3 pt-0">My Dictionary List</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <button type="button"
                        onclick="return location = '<?php echo e(route('front.user.dictionary.create')); ?>'"
                        class="btn edit-btn-style">
                        Add New +
                    </button>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive text-nowrap">
                    <!--Table-->
                    <table class="table table-striped kproductTbl">
                        <thead class="titlestyle table-dark">
                            <tr>
                                <th>Word</th>
                                <th>Created At</th>
                                <th>View</th>
								<th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                        </thead>
                        <tbody class="tbody_productlist">
                            <?php if(count($dictionaries) > 0): ?>
                                <?php $__currentLoopData = $dictionaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dictionary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="verticalalign"><?php echo e($dictionary->title); ?></td>
                                        <td class="verticalalign"><?php echo e($dictionary->created_at); ?></td>
    									
										<td class="verticalalign">
                                            <span class="table-edit">
											
											    <?php if($dictionary->status == 1): ?>
                                                <a href="<?php echo e(route('front.pages.word.detail',$dictionary->slug ?? '')); ?>" 
                                                    class="span-style1 my-0 text-primary">View</a>
												<?php endif; ?>	
                                            </span>
                                        </td>
                                       
                              <td class="verticalalign">
                                            <span class="table-edit">
											<?php echo e(config('cms.dictionary_status')[$dictionary->status]); ?> 
                                            </span>
                                        </td>									   
										
										<td class="verticalalign">
                                            <span class="table-edit">
                                                <a href="<?php echo e(route('front.user.dictionary.update',$dictionary->slug ?? '')); ?>" 
                                                    class="span-style1 my-0">Edit</a>
                                            </span>
                                        </td>
                                        <td class="verticalalign">
                                            <span class="table-delete">
                                                <a href="<?php echo e(route('front.user.dictionary.delete',$dictionary->slug ?? '')); ?>"
                                                    onclick="return confirm('Are you sure?');"
    												class="span-style1 my-0 text-danger">Delete</a>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7"><p>The Dictionary list is empty - Please click Add new to add New Dictionary.</p></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <!--Table body-->

                    </table>
                    <div class="div">
                        <?php echo e($dictionaries->render()); ?>


                    </div>
                    <!--Table-->
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<script>

var dictionary_data_saved_flag = '<?php echo e(Session::has("dictionary_data_saved_flag")); ?>';

var dictionary_data_deleted_flag = '<?php echo e(Session::has("dictionary_data_deleted_flag")); ?>';

function dictionarySaveMessage(){
     
     if(dictionary_data_saved_flag!="")
     {
       //toastr.success("Dictionary Saved Successfully.");
     }
	 
	 if(dictionary_data_deleted_flag!="")
     {
       toastr.success("Dictionary Deleted Successfully.");
     }
     
   }
   window.onload = dictionarySaveMessage;
</script>   

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>