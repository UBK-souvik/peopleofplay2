
<?php $__env->startSection('content'); ?>
<div class="left-column border_right">
    <div class="First-column bg-white sectionBoxPadding">
        <h3 class="Tile-style social mb-3 pt-0">All Events</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <button type="button"
                        onclick="return location = '<?php echo e(route('front.user.event.create')); ?>'"
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
                                <th></th>
                                <th>Name</th>
                                <th>Website</th>
                                
                                <th>Awards</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody class="tbody_productlist">
                            <?php if(count($events) > 0): ?>
                                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><img src="<?php echo e(@prodEventImageBasePath(@$event->main_image)); ?>" class="imgfifty"> </td>
                                        <td class="verticalalign text-center"><a class="span-style1" href="<?php echo e(route('front.pages.event.detail',$event->slug)); ?>"><?php echo e($event->name); ?></a></td>
    									<td class="verticalalign">
                                           <a target="_blank" class="span-style1" href="<?php echo e(@$event->website); ?>"><?php echo e(@$event->website); ?></a>
                                        </td>
                                        <td class="verticalalign">
                                            <a href="<?php echo e(route('front.user.event.award.index',$event->id)); ?>">Add Awards</a>
                                        </td>
                                        <td class="verticalalign">
                                            <span class="table-edit">
                                                <a href="<?php echo e(route('front.user.event.update',$event->slug ?? null)); ?>"
                                                    class="span-style1 my-0">Edit</a>
                                            </span>
                                        </td>
                                        <td class="verticalalign">
                                            <span class="table-delete">
                                                <a href="<?php echo e(route('front.user.event.delete',$event->slug ?? null)); ?>"  onclick="return confirm('Are you sure?');"
                                                    class="span-style1 my-0 text-danger">Delete</a>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5"><p>The Event list is empty - Please click Add new to add New Events.</p></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <!--Table body-->

                    </table>
                    <div class="div">
                        <?php echo e($events->render()); ?>


                    </div>
                    <!--Table-->
                </div>
            </div>
        </div>

    </div>
</div>

<script>

var event_data_deleted_flag = '<?php echo e(Session::has("event_data_deleted_flag")); ?>';

function eventSaveMessage(){
     
     if(event_data_deleted_flag =="1" || event_data_deleted_flag ==1)
     {
       toastr.success("Event Deleted Successfully.");
     }
	 
   }
   window.onload = eventSaveMessage;
</script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>