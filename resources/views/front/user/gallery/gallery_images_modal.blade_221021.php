<div class="modal-header">
   <h5 class="modal-title" id="defaultModalLabel">{{ $galleryTitle }}</h5>
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
   <div id="carouselExampleIndicators" class="carousel slide GalleryModelSm" data-ride="carousel">
      <div class="carousel-inner">
         @foreach ($gallay_images as $key =>$row)
         <div class="carousel-item <?php if($row->id == $id) { echo "active"; } ?>">
            @if($type == 2) 
            <?php  echo preg_replace(
               "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
               "<iframe src=\"//www.youtube.com/embed/$2\" allowfullscreen class='IframeData'></iframe>",
               $row->media
               ); ?>
            @else 
            <img class="d-block galleryModalImg"  src="{{ asset('uploads/images/gallery/photos/'.$row->media) }}" alt="Gallery">

            @endif
            <div class="row mt-2">
               <div class="col-md-12">
                  <div class="GalleryCaption">

                     @if(isset($row->title) && !empty($row->title)) <label><b>Title :</b></label> <span> {{ $row->title }}</span> <br> @endif
                     @if(isset($row->caption) && !empty($row->caption))  <label><b>Caption :</b></label> <span> {{ $row->caption }}</span> @endif
                     <br>
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
                     <b> Peoples :- </b>
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
                          $products .= '<a href="'.url('people/'.$value3['slug']).'">'. $value3['name']."</a>,";
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
                        @if($show_btn ==1 )
                     @if(isset(Auth::guard('users')->user()->id) && !empty(Auth::guard('users')->user()->id) )
                     @if($row->user_id == Auth::guard('users')->user()->id)
                     <div class="GalleryModelButton">
                        <a href="javascript:void(0);" onclick="return openEditGalleryModal('{{ $row->id }}');" class="btn btn-primary btn-sm" > Edit </a>
                        <a href="javascript:void(0);" onclick="deleteGallery('{{ $row->id }}');" class="btn btn-danger btn-sm" > Delete </a>
                     </div>
                     @endif
                     @endif
                     @endif
                  </div>
               </div>
            </div>
         </div>
         @endforeach
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