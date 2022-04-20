
<?php $__env->startSection('content'); ?>
<style>
    /*.k_table thead th {
        text-align: center;
        font-size: 15px!important;
    }*/
</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
<div class="left-column border_right PopMedia">
    <div class="First-column bg-white p-3">
        <h3 class="Tile-style social mb-3 pt-0">My Media List</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <button type="button"
                        onclick="return location = '<?php echo e(route('front.user.media.create')); ?>'"
                        class="btn edit-btn-style">
                        Add New +
                    </button>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group" style="display: none;">
                    <input id="Searchbar" type="search" name="Searchbar" class="form-control searchaward"
                        placeholder="Search Media">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive text-nowrap">
                    <!--Table-->
                    <table class="table kproductTbl">
                        <thead class="titlestyle table-dark">
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Created At</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                        </thead>
                        <tbody class="tbody_productlist">
                            <?php if(count($media_list) > 0): ?>
                                <?php $__currentLoopData = $media_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media_list_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><img width="50" src="<?php echo e(@mediaImageBasePath(@$media_list_row->featured_image)); ?>" class="imgfifty" > </td>
                                        <td class="verticalalign"><?php echo e($media_list_row->title); ?></td>
                                        <td class="verticalalign"><?php echo e($media_list_row->created_at); ?></td>
    									<td class="verticalalign">
                                            <span class="table-edit">
                                                <a href="<?php echo e(route('front.user.media.update',$media_list_row->id ?? '')); ?>" 
                                                    class="span-style1 my-0">Edit</a>
                                            </span>
                                        </td>
                                        <td class="verticalalign">
                                            <span class="table-delete">
                                                <a href="<?php echo e(route('front.user.media.delete',$media_list_row->id ?? '')); ?>"
                                                    onclick="return confirm('Are you sure?');"
    												class="span-style1 my-0 text-danger">Delete</a>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr class="text-center">
                                    <td colspan="7"><p>The Media list is empty - Please click Add new to add New Media.</p></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <!--Table body-->

                    </table>
                    
                    <!--Table-->
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<script>

var media_data_saved_flag = '<?php echo e(Session::has("media_data_saved_flag")); ?>';

var media_data_deleted_flag = '<?php echo e(Session::has("media_data_deleted_flag")); ?>';

function mediaSaveMessage(){
     
     if(media_data_saved_flag!="")
     {
       //toastr.success("Media Saved Successfully.");
     }
	 
	 if(media_data_deleted_flag!="")
     {
       toastr.success("Media Deleted Successfully.");
     }
     
   }
   window.onload = mediaSaveMessage;
</script>   

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>