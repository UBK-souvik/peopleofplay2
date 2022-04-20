<div class="modal-header">
   <h5 class="modal-title" id="defaultModalLabel"><?php echo e($galleryTitle); ?></h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<style type="text/css">
   .IframeData {
   max-width: 100%;
   width: 100%;
   height: 300px;
   }
</style>

<div class="modal-body">
   <div id="carouselExampleIndicators" class="<?php if($type ==2 ){  echo 'OwlCarouselIndicatorsVideo '; } else { echo 'OwlCarouselIndicatorsImage'; } ?> carousel slide GalleryModelSm" data-ride="carousel">
      <div class="carousel-inner">
         <?php $__currentLoopData = $gallay_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="carousel-item  <?php if($row->id == $id) { echo "active"; } ?>">
            <?php if($type == 2): ?> 
            <?php  echo preg_replace(
               "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
               "<iframe src=\"//www.youtube.com/embed/$2\" allowfullscreen class='IframeData'></iframe>",
               $row->media
               ); ?>
            <?php else: ?> 
            <img class="d-block galleryModalImg"  src="<?php echo e(asset('uploads/images/gallery/photos/'.$row->media)); ?>" alt="Gallery">

            <?php endif; ?>
            <div class="row mt-2">
               <div class="col-md-12">
                  <div class="GalleryCaption">
                     <div class="text-center">
                     <?php if(isset($row->caption) && !empty($row->caption)): ?> <span> <?php echo e($row->caption); ?></span><br> <?php endif; ?>
                  </div>
                    
                     
                     <?php if(count($row->gallery_company_tags)>0){ ?>
                     <b>Companies :- </b>
                     <?php
                        $companies='';

                        foreach ($row->gallery_company_tags as $key => $value) {
                         $companies .= '<a href="'.url('company/'.$value['slug']).'">'. $value['first_name']." ". $value['last_name']."</a>,";
                        } 
                        echo rtrim($companies,',')."<br>";
                        }
                        ?>
                        
                     <?php if(count($row->gallery_people_tags)>0){ ?>
                     <b> People :- </b>
                     <?php
                        $peoples = '';
                        foreach ($row->gallery_people_tags as $key => $value1) {
                          $peoples .= '<a href="'.url('people/'.$value1['slug']).'">'. $value1['first_name']." ". $value1['last_name']."</a>,";
                        } 
                        echo rtrim($peoples,',')."<br>";
                        }
                        ?>
                     <?php if(count($row->gallery_product_tags)>0){ ?>
                     <b> Products :- </b>
                     <?php
                        $products = '';
                        foreach ($row->gallery_product_tags as $key => $value3) {
                          $products .= '<a href="'.url('product/'.$value3['slug']).'">'. $value3['name']."</a>,";
                        } 
                        echo rtrim($products,',')."<br>";
                        }
                        ?>
                     <?php if(count($row->gallery_person_tags)>0){ ?>
                     <b> Person :- </b>
                     <?php
                        foreach ($row->gallery_person_tags as $key => $value4) {
                          echo $value4['first_name']." ". $value4['last_name'].",";
                        } 
                        echo "<br>";
                        }
                        ?>
                        <?php if($show_btn ==1 ): ?>
                     <?php if(isset(Auth::guard('users')->user()->id) && !empty(Auth::guard('users')->user()->id) ): ?>
                     <?php if($row->user_id == Auth::guard('users')->user()->id): ?>
                     <div class="GalleryModelButton">
                        <a href="javascript:void(0);" onclick="return openEditGalleryModal('<?php echo e($row->id); ?>');" class="btn btn-primary btn-sm" > Edit <i class="fa fa-spinner fa-spin st_gallery_loading" style="display: none;"></i></a>
                        <a href="javascript:void(0);" onclick="deleteGallery('<?php echo e($row->id); ?>');" class="btn btn-danger btn-sm" > Delete </a>
                     </div>
                     <?php endif; ?>
                     <?php endif; ?>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
      </a>
   </div>
</div>