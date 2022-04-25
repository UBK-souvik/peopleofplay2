
<?php $__env->startSection('content'); ?>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="left-column border_right PopBlog">
      <div class="First-column bg-white p-3">
         <h3 class="Tile-style social mb-3 pt-0">My Blog Posts</h3>
         <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  <button type="button"
                     onclick="return location = '<?php echo e(route('front.user.blog.create')); ?>'"
                     class="btn edit-btn-style">
                  Add New +
                  </button>
               </div>
            </div>
            <div class="col-md-8">
               <div class="form-group" style="display: none;">
                  <input id="Searchbar" type="search" name="Searchbar" class="form-control searchaward"
                     placeholder="Search Blog">
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="table-responsive">
                  <!--Table-->
                  <table class="table kproductTbl">
                     <thead class="titlestyle table-dark">
                        <tr>
                           <th>Featured Image</th>
                           <th>Title</th>
                           <th>Category</th>
                           <!-- <th>Description</th> -->
                           <!-- <th>Tag</th> -->
                           <th>Created At</th>
                           <th>Status</th>
                           <th>View</th>
                           <th>Edit</th>
                           <th>Delete</th>
                        </tr>
                     </thead>
                     <tbody class="tbody_productlist">
                        <?php if(count($blogs) > 0): ?>
                        <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><img width="50" src="<?php echo e(@newsBlogImageBasePath(@$blog->featured_image)); ?>" class="imgfifty" > </td>
                           <td class="verticalalign blogTitle tablePara"><p><?php echo e($blog->title); ?></p></td>
                           <td class="verticalalign">
                              <?php echo e(@$blog->category->name); ?>

                           </td>
                           <!-- <td class="verticalalign"><?php echo $blog->description; ?></td> -->
                           <!-- <td class="verticalalign"><?php echo e($blog->tag); ?></td> -->
                           <td class="verticalalign"><?php echo e($blog->created_at); ?></td>
                           <?php if($blog->status == 1): ?>
                              <td class="verticalalign">
                                 <?php echo e(@config('cms.blog_status')[$blog->status]); ?>

                              </td>
                           <?php else: ?>
                              <td class="verticalalign">
                                 <?php echo e(@config('cms.blog_status')[$blog->status]); ?>

                              </td>
                           <?php endif; ?>   

                           <td class="verticalalign">
                              <span class="table-edit">
                              <?php if($blog->status == 1): ?>
                                 <a href="<?php echo e(route('front.pages.blog.detail',$blog->slug ?? '')); ?>" class="span-style1 my-0 text-primary" target="_blank">View</a>
                              <?php else: ?>
                                 <!-- <a href="javascript:void(0)" onclick="blog_preview(this,`<?php echo e($blog->id); ?>`); return false;" class="span-style1 my-0 text-primary">Preview</a> -->
                                 <a href="<?php echo e(url('user/blog/preview_detail/'.$blog->slug)); ?>" class="span-style1 my-0 text-primary" target="_blank">Preview</a>
                                 <?php endif; ?>
                              </span>
                           </td>
                           <td class="verticalalign">
                              <span class="table-edit">
                              <a href="<?php echo e(route('front.user.blog.update',$blog->slug ?? '')); ?>" 
                                 class="span-style1 my-0">Edit</a>
                              </span>
                           </td>
                           <td class="verticalalign">
                              <span class="table-delete">
                              <a href="<?php echo e(route('front.user.blog.delete',$blog->slug ?? '')); ?>"
                                 onclick="return confirm('Are you sure?');"
                                 class="span-style1 my-0 text-danger">Delete</a>
                              </span>
                           </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                           <td colspan="7">
                              <p>The Blog list is empty - Please click Add new to add New Blogs.</p>
                           </td>
                        </tr>
                        <?php endif; ?>
                     </tbody>
                     <!--Table body-->
                  </table>
                  <div class="div">
                     <?php echo e($blogs->render()); ?>

                  </div>
                  <!--Table-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   var blog_data_saved_flag = '<?php echo e(Session::has("blog_data_saved_flag")); ?>';
   
   var blog_data_deleted_flag = '<?php echo e(Session::has("blog_data_deleted_flag")); ?>';
   
   function blogSaveMessage(){
        
        if(blog_data_saved_flag!="")
        {
          //toastr.success("Blog Saved Successfully.");
        }
     
     if(blog_data_deleted_flag!="")
        {
          toastr.success("Blog Deleted Successfully.");
        }
        
      }
      window.onload = blogSaveMessage;

      function publish_blog(e,type,id){

         if(confirm('Are you sure you want to publish your blog?')){
            $.ajax({
               url: "<?php echo e(route('front.user.blog.publish_blog')); ?>",
               headers: {
                  'X-CSRF-TOKEN': ajax_csrf_token_new
               },
                     data: {id:id,type:type},
                     dataType: 'json',
                     type: 'POST',
                     beforeSend: function () {
                        $('.postLoading').show();
                        $('button').attr('disabled', true);

                  },
                  error: function (jqXHR, exception) {
                     var msg = formatErrorMessage(jqXHR, exception);
                     toastr.error(msg)
                     console.log(msg);
                     $('.postLoading').hide();
               },
               success: function (data) {
                  toastr.success('Blog publish successfully','Success');
                  location.reload();
               }
            });
         }

      }      

      function blog_preview(e,id){
         $.ajax({
            url: "",
            headers: {
               'X-CSRF-TOKEN': ajax_csrf_token_new
            },
               data: {id:id,type:'after_save_preview_list'},
               dataType: 'json',
               type: 'POST',
               beforeSend: function () {
                  $('.postLoading').show();
                  $('button').attr('disabled', true);

               },
               error: function (jqXHR, exception) {
               $('button').attr('disabled', false);
               var msg = formatErrorMessage(jqXHR, exception);
               toastr.error(msg)
               console.log(msg);
               $('.postLoading').hide();
            },
            success: function (data) {
               $('button').attr('disabled', false);
               $('#DefaultModal .modal-content').html(data.view);
               $('#DefaultModal').modal('show');
            }
         });
         }

</script>   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>