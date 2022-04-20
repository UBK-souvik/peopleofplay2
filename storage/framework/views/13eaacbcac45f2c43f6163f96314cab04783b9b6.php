
<?php $__env->startSection('content'); ?>
<style>
   tr.tableRowSelected{
   background-color: #f2f2f2;
   border-top: 1px solid #000;
   width: 200px;
   }
   @media  only screen and (max-width: 600px) {
   .mobAlign{
   display: flex;
   }
   .mobAlign .iconImg{
   width: 20px;
   height: 25px;
   margin-top: 12px;
   }
   }
</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="left-column border_right">
      <div class="First-column bg-white p-3" >
         <h3 class="Tile-style social pt-0">All Brands</h3>
         <div class="row">
            <?php  
            $int_type_of_user = 0;
            $current_user = get_current_user_info();
            if(!empty($current_user->type_of_user))
            {
            $int_type_of_user = $current_user->type_of_user; 
            }
            ?>
            <?php if($int_type_of_user == 3 ): ?>
            <div class="col-md-3">
               <div class="form-group">
                  <?php if(count($brands_list) < 1): ?>
                  <button type="button"
                     onclick="return location = '<?php echo e(route('front.user.brand.create')); ?>'"
                     class="btn edit-btn-style">
                  Add New + 
                  </button>
                  <?php else: ?> 
                  <button type="button" class="btn edit-btn-style" data-toggle="modal" data-target="#update_user_type">
                  Add New + 
                  </button>
                  <?php endif; ?>
               </div>
            </div>
            <div class="col-md-7">
               <p>Your account is limited to only 1 brand. Become a Pro user to add more brands to your profile.<a href=""></a></p>
            </div>
            <?php else: ?> 
            <div class="col-md-4">
               <div class="form-group">
                  <button type="button"
                     onclick="return location = '<?php echo e(route('front.user.brand.create')); ?>'"
                     class="btn edit-btn-style"> 
                  Add New +
                  </button>
               </div>
            </div>
            <?php endif; ?>
            <div class="col-md-8">
               <div class="form-group" style="display: none;">
                  <input id="Searchbar" type="search" name="Searchbar" class="form-control searchaward"
                     placeholder="Search Product">
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="table-responsive text-nowrap">
                  <!--Table-->
                  <table class="table table-striped kproductTbl tblBrand" id="tblLocations">
                     <thead class="titlestyle table-dark">
                        <tr>
                           <th style="display: none;">Sr. No</th>
                           <th>Image</th>
                           <th>Brand Name</th>
                           <th>Category</th>
                           <th>Edit</th>
                           <th>Delete</th>
                        </tr>
                     </thead>
                     <tbody class="tbody_productlist">
                        <tr>
                           <td style="display: none;" id="0">0</td>
                        </tr>
                        <?php if(count($brands_list) > 0): ?>
                        <?php $__currentLoopData = $brands_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brands_list_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td style="display: none;" id="<?php echo e($brands_list_row->id); ?>"><?php echo e(@$brands_list_row->sr_no); ?></td>
                           <td class="text-center mobAlign">
                              <!--<img src="<?php echo e(imageBasePath($brands_list_row->main_image)); ?>" class="img-fluid" style="width: 50px;height: 50px;object-fit: cover;">--> 
                              <!-- <i class="fa fa-braille photo_icon" style="font-size: 19px;color: #dbd9d9"></i> -->
                              <img class="iconImg" src="<?php echo e(@prodEventImageBasePath('drag.png')); ?>" style="width: 20px;">
                              <img src="<?php echo e(@imageBasePath(@$brands_list_row->main_image)); ?>" class="imgfifty">
                           </td>
                           <td class="verticalalign text-center"><a href="<?php echo e(route('front.pages.brand.detail',$brands_list_row->slug)); ?>" class="span-style1"><?php echo e($brands_list_row->name); ?></a></td>
                           <!-- <td class="verticalalign text-center"><?php echo e($brands_list_row->price); ?></td> -->
                           <td class="verticalalign text-center">
                              <?php $__currentLoopData = $brands_list_row->categories->nth(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php echo e($category->category->category_name ?? null); ?>

                              <?php if($loop->index > $loop->count): ?>
                              |
                              <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </td>
                           <td class="verticalalign text-center">
                              <span class="table-edit">
                              <a href="<?php echo e(route('front.user.brand.update',$brands_list_row->slug ?? null)); ?>"
                                 class="span-style1 my-0">Edit</a>
                              </span>
                           </td>
                           <td class="verticalalign text-center">
                              <span class="table-delete">
                              <a href="<?php echo e(route('front.user.brand.delete',$brands_list_row->slug ?? null)); ?>" onclick="return confirm('Are you sure?');"
                                 class="text-danger my-0">Delete</a>
                              </span>
                           </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                           <td colspan="5" >
                              <p class="mb-0">The Brands list is empty - Please click Add new to add New Brands.</p>
                           </td>
                        </tr>
                        <?php endif; ?>
                     </tbody>
                     <!--Table body-->
                  </table>
                  <div class="div">
                     <?php echo e($brands_list->render()); ?>

                  </div>
                  <!--Table-->
               </div>
            </div>
         </div>
         <div class="row mt-3">
            <div class="col-md-4">
               <div class="form-group">
                  <button type="button" class="btn edit-btn-style" id="change_sequence">
                  Update Sequence 
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="update_user_type" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header kbg_black">
            <div class="row p-2">
               <h4 class="text-white">Account Limitation</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <p >Your account is limited to only 1 brand. Become a Pro user to add more brands to your profile.</p>
            <!-- <div>
               <button type="button" data-dismiss="modal" class="btn btnAll">Close</button>
               </div> -->
         </div>
         <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
      </div>
   </div>
</div>
<script>
   var brand_data_deleted_flag = '<?php echo e(Session::has("brand_data_deleted_flag")); ?>';
   
   function brandSaveMessage(){
        
        if(brand_data_deleted_flag =="1" || brand_data_deleted_flag ==1)
        {
          toastr.success("Brand Deleted Successfully.");
        }
     
      }
      window.onload = brandSaveMessage;
</script>
<?php $__env->stopSection(); ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>
<script type="text/javascript">
   $(function () {
       $("#tblLocations").sortable({
           items: 'tr:not(tr:first-child)',
           cursor: 'pointer',
           axis: 'y',
           dropOnEmpty: false,
           start: function (e, ui) {
               ui.item.addClass("tableRowSelected");
           },
           stop: function (e, ui) {
               ui.item.removeClass("tableRowSelected");
               $(this).find("tr").each(function (index) {
                   if (index >= 0) {
                       $(this).find("td").eq(0).html(index);
                   }
               });
           }
       });
   });
</script>
<script type="text/javascript">
   $(document).ready(function(){
       $('#change_sequence').click(function(){
           var brand_id  = [];
           var sr_no = [];
           $("#tblLocations").find("tr").each(function (index) {
               if (index > 0) {
                   brand_id.push($(this).find("td").eq(0).attr('id'));
                   sr_no.push(index);
                   // $(this).find("td").eq(0).attr('id');
                   // $(this).find("td").eq(0).html(index);
               }
           });
   
           $.ajax({
               type:'GET',
               url:"<?php echo e(url('/user/brand/update_sequence')); ?>",
               data:{
                   "_token": "<?php echo e(csrf_token()); ?>",
                   "brand_id": brand_id,
                   "sr_no": sr_no,
               },
               success:function(data){
                   console.log(data);    
                   toastr.success('Sequence chaged Successfully');
                   window.location.reload();
               }
           });
       })
   })
</script>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>