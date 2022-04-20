
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('front/css/select2-bootstrap.css?'.time())); ?>">
<link rel="stylesheet" href="<?php echo e(asset('front/new_css/feed_new.css?'.time())); ?>">
<?php
   if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('category_id')[0]) ){
       $category1 = $product->categories->pluck('category_id')[0];
   } else {
       $category1 = 0;
   }
   
   if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('category_id')[1]) ){
       $category2 = $product->categories->pluck('category_id')[1];
   } else {
       $category2 = 0;
   }
   
   if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('category_id')[2]) ){
       $category3 = $product->categories->pluck('category_id')[2];
   } else {
       $category3 = 0;
   }
   
   if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('sub_category_id')[0]) ){
       $sub_category1 = $product->categories->pluck('sub_category_id')[0];
   } else {
       $sub_category1 = 0;
   }
   
   if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('sub_category_id')[1]) ){
       $sub_category2 = $product->categories->pluck('sub_category_id')[1];
   } else {
       $sub_category2 = 0;
   }
   
   if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('sub_category_id')[2]) ){
       $sub_category3 = $product->categories->pluck('sub_category_id')[2];
   } else {
       $sub_category3 = 0;
   }
   ?>
<style type="text/css">
   .hide { display: none; }
   .open { display: block; }
</style>
<!-- borderlineadd -->
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
   <div class="left-column border_right" id="divProductMainDivIdNew">
      <form id="productForm" class="kpro_form kform_control">
         <input type="hidden" name="product_id" value="<?php echo e(@$product->id); ?>">
         <?php echo csrf_field(); ?>
         <div class="First-column">
            <div class="col-md-12">
               <div id="FirstRow_Product" class="row sectionTop">
                  <div class="col-md-4 imgProfilePadding marginBottomTwenty lessMargin">
                     <?php //if(@$product->main_image)
                        //{
                          ?>
                     <img id="blah" src="<?php echo e(@prodEventImageBasePath(@$product->main_image)); ?>" class="kfile_imageten img-fluid imgtwoeighty">
                     <?php
                        //}
                        //else
                        //{
                          ?>
                     <!-- <img id="blah" src="#" alt="Preview" class="hidden img-fluid imgtwoeighty"> -->
                     <?php
                        //}
                        ?>
                     <div class="form-group mt-2 ProfileUploadBtn mb-0">
                        <input id="file-uploadten1" type="file" onchange="readURL(this);" class="custom-file-input1 " name="main_image" accept="image/*" />
                     </div>
                     <div class="ProfileUploadBtn  text-left">
                        <small class="text-danger ">Note: Please upload image up to 2MB only</small>
                     </div>
                  </div>
                  <div class="col-md-8 colmargin">
                     <div class="row">
                        <div class="col-md-6 d-none">
                           <div class="form-group ">
                              <label for="ProductID">Product ID</label><span class="text-danger">*</span>
                              <input id="ProductID" type="text" class="form-control"
                                 readonly name="product[product_id_number]" value="<?php echo e($product->product_id_number ?? generateRandomString()); ?>"
                                 placeholder="">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="ProductName">Product Name</label><span class="text-danger">*</span>
                              <input id="ProductName" type="text" value="<?php echo e(@$product->name); ?>" name="product[name]" class="form-control"
                                 placeholder="">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="group_id">Group Name</label><span class="text-danger">*</span>
                              <select required="" class="form-control" name="product[group_id]" id="group_id">
                                 <option value="">Select Group</option>
                                 <?php $__currentLoopData = config('cms.group'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($key); ?>" <?php if(!empty($product->group_id) && $product->group_id == $key ): ?> selected <?php endif; ?>><?php echo e($value); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <!-- start category 1 -->
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="Category">Primary Category</label><span class="text-danger">*</span>
                              <select name="category1" id="category1" data-no="1" class="custom-select get_sc form-control" data-placeholder="Select">
                                 <option value="">Primary Category </option>
                                 <?php $__currentLoopData = category(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($index); ?>" <?php echo e($index == @$category1 ? 'selected' :''); ?>

                                 ><?php echo e($value); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                        </div>
                     
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="Category">Primary Sub Category</label>
                              <select name="sub_category1" id="sub_category1" class="custom-select sub_category_1 form-control" data-placeholder="Select">
                                 <option value="">Primary Sub Category</option>
                                 <?php $__currentLoopData = sub_categoryByCategoryID($category1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($index); ?>" <?php echo e($index == $sub_category1 ? 'selected' :''); ?>

                                 ><?php echo e($value); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <!-- end category 1 -->
                     <?php if(empty($category2) || empty($category3)): ?>
                     <button type="button" class="btn btnAll mt-1" id="open_cat">Add more Categories</button>
                     <?php endif; ?>
                     <!-- start category 2 -->
                     <div id="open_category2"  class="<?php echo e((!empty($category2) ) ? 'open' : 'hide'); ?>">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="Category">Second Category</label>
                                 <select name="category2" id="category2" data-no="2" class="custom-select get_sc form-control" data-placeholder="Select">
                                    <option value="">Second Category</option>
                                    <?php $__currentLoopData = category(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($index); ?>" <?php echo e($index == @$category2 ? 'selected' :''); ?>

                                    ><?php echo e($value); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="Category">Second Sub Category</label>
                                 <select name="sub_category2" id="sub_category2" class="custom-select sub_category_2 form-control" data-placeholder="Select">
                                    <option value="">Second Sub Category</option>
                                    <?php $__currentLoopData = sub_categoryByCategoryID($category2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($index); ?>" <?php echo e($index == $sub_category2 ? 'selected' :''); ?>

                                    ><?php echo e($value); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end category 2 -->
                    
                     <div id="open_category3" class="<?php echo e((!empty($category3) ) ? 'open' : 'hide'); ?>">
                        <div class="row ">
                        <!-- <div class="col-md-6 pl-0 inputPaddingLeft"> -->
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="Category">Third Category</label>
                              <select name="category3" id="category3" data-no="3" class="custom-select get_sc form-control" data-placeholder="Select">
                                 <option value="">Third Category</option>
                                 <?php $__currentLoopData = category(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($index); ?>" <?php echo e($index == @$category3 ? 'selected' :''); ?>

                                 ><?php echo e($value); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="Category">Third Sub Category</label>
                              <select name="sub_category3" id="sub_category3" class="custom-select sub_category_3 form-control" data-placeholder="Select">
                                 <option value="">Third Sub Category</option>
                                 <?php $__currentLoopData = sub_categoryByCategoryID($category3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($index); ?>" <?php echo e($index == $sub_category3 ? 'selected' :''); ?>

                                 ><?php echo e($value); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     </div>
                  </div>
                  
                     <div class="col-md-12 pl-0 mt-4 inputPaddingLeft">
                        <div class="form-group mb-0">
                           <label for="Productdescription">Product description</label><span class="text-danger">*</span>
                           <textarea class="form-control" name="product[description]" rows="7" placeholder=""><?php echo e(strip_tags(@$product->description)); ?></textarea>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="row sectionBox1">
                           <h3 class="sec_head_text w-100">
                              <!-- Product Metadata--> 
                           </h3>
                           <div class="col-md-4 pl-0 inputPaddingLeft">
                              <div class="form-group">
                                 <label for="Brand" class="w-100">Brand</label><span class="text-danger"></span>
                                 

                                 

                                 <select name="product[brand]" id="Brand" class="form-control input-sm select2-multiple-brand" multiple>
                                 <?php $__currentLoopData = $brand_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand_lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e(@$brand_lists->id); ?>" <?php if(@$product->brand == $brand_lists->id): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e(@$brand_lists->text); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>

                                 <?php /*<select class="form-control select-ajax py-3 w-100" data-select2-tags="true" name="product[brand]" id="product_brand_list_id">  
                                    @if(!empty($product->brand_list->name))
                                        <?php
                                              $str_brandlist_value = @$product->brand_list->id;  
                                              $str_brandlist_text = @$product->brand_list->name;  
                                        ?>
                                        @if(!empty($str_brandlist_value) && !empty($str_brandlist_text)) 
                                    <option value="{{$str_brandlist_value}}" selected>{{$str_brandlist_text}}</option>
                                    @endif
                                    @endif
                                    </select> */?>
                                 <!-- <input id="CompanyName" type="text" name="contact_info[company_name]"
                                    required="required" value="<?php echo e(@$user->inventorContactInfo->company_name); ?>"
                                    class="form-control" placeholder="">  --><!-- name="name"
                                    <div>
                                      <a href="javascript:void(0);" class="textBlack pl-0 fontTwelve" id="bt_product_brand_list_id">Remove Brand</a>
                                    </div> -->
                              </div>
                           </div>
                           <!--<div class="col-md-4">
                              <div class="form-group mb-0">
                              <label for="Company">Manufacturer</label><span class="text-danger"></span>
                              <input id="Company" type="text" name="product[company]" value="<?php echo e(@$product->company); ?>" class="form-control" placeholder="">
                              </div>
                              </div> -->
                           <div class="col-md-4 pl-0 inputPaddingLeft">
                              <div class="form-group">
                                 <label for="CompanyName" class="w-100">Manufacturer</label></span>
                                 <?php
                                 if(!empty($product->companydata->id))
                                 {     
                                 $str_company_user_name_new = App\Helpers\Utilities::getUserName(@$product->companydata);
                                 $int_company_user_id_new = @$product->companydata->id;
                                 }
                                 else
                                 {
                                 $str_company_user_name_new = @$product->company;
                                 $int_company_user_id_new = 0;
                                 }
                                 ?>
                                 

                                 <select name="product[company_hidden_id]" id="Company" class="form-control input-sm select2-multiple" multiple>
                                    <?php $__currentLoopData = $manufacture_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manufacture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(@$manufacture->id); ?>" <?php if(@$int_company_user_id_new == $manufacture->id): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e(@$manufacture->text); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>
                                 
                                 <?php /*<select class="form-control select-ajax-company py-3" data-select2-tags="true" name="product[company]" id="Company">  
                                    @if(!empty($product->company))
                                        <?php
                                          $value  = $product->company;  
                                          $text   = $product->company;  
                                          if($abc = \App\Models\User::find($product->company)){
                                              $value = $abc->id;  
                                              $text = $abc->first_name." ".$abc->last_name;  
                                          }
                                        ?>
                                        @if(!empty($value) && !empty($text) && $value!='null' && $text!='null') 
                                    <option value="{{$value}}" selected>{{$text}}</option>
                                    @endif
                                    @endif
                                    </select> */?>
                                 <!-- <input id="CompanyName" type="text" name="contact_info[company_name]"
                                    required="required" value="<?php echo e(@$user->inventorContactInfo->company_name); ?>"
                                    class="form-control" placeholder="">  --><!-- name="name" -->
                                 <!-- <div>
                                    <a href="javascript:void(0);" class="textBlack pl-0 fontTwelve" id="bt_company_list_id">Remove Manufacturer</a>
                                    </div> -->
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group mb-0">
                                 <label for="Company">Launched Date</label><span class="text-danger"></span>
                                 <input id="launched_date" value="<?php echo e(@$product->launched_date); ?>" type="date" class="form-control"  placeholder="Launched" name="product[launched_date]">
                              </div>
                              
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php
            $str_chk_page_type_fun_fact_new = 'product'; 
            ?>
            <?php echo $__env->make("front.user.include_add_fun_fact", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="col-md-12">
               <div class="row sectionBox">
                  <h3 class="sec_head_text w-100">Buy a copy</h3>
                  <div class="col-md-4 pl-0 inputPaddingLeft">
                     <div class="form-group">
                        <label for="email">Add Label 1</label>
                        <input type="text" name="buy_from[0][amazon_caption]" value="<?php echo e(@$product->buyFrom->amazon_caption ? $product->buyFrom->amazon_caption : null); ?>" placeholder="Enter Label" class="form-control" >
                        <input  type="hidden" name="buy_from[0][type]" value="1" > 
                        <label class="mt-2">Add Website 1</label>
                        <input id="Amazoncom" type="url" name="buy_from[0][amazon]" value="<?php echo e(@$product->buyFrom->amazon ? $product->buyFrom->amazon : null); ?>" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Add Label 2</label>
                        <input type="text" name="buy_from[0][ebay_caption]" value="<?php echo e(@$product->buyFrom->ebay_caption ? $product->buyFrom->ebay_caption : null); ?>" placeholder="Enter Label" class="form-control">
                        <input  type="hidden" name="buy_from[0][type]" value="1">
                        <label class="mt-2">Add Website 2</label>
                        <input id="Amazoncom" type="url" name="buy_from[0][ebay]" value="<?php echo e(@$product->buyFrom->ebay ? $product->buyFrom->ebay : null); ?>" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group mb-0">
                        <label>Add Label 3</label>
                        <input type="text" name="buy_from[0][pop_caption]" value="<?php echo e(@$product->buyFrom->pop_caption ? $product->buyFrom->pop_caption : null); ?>" placeholder="Enter Label" class="form-control">
                        <input  type="hidden" name="buy_from[0][type]" value="1"> 
                        <label class="mt-2">Add Website 3</label>
                        <input id="Amazoncom" type="url" name="buy_from[0][pop]" value="<?php echo e(@$product->buyFrom->pop ? $product->buyFrom->pop : null); ?>" class="form-control" placeholder="">
                     </div>
                  </div>
               </div>
            </div>
            <?php echo $__env->make("front.user.product.view_collaborator_list", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php /*
               <div class="col-md-12">
                 <div id="Five_Product" class="row sectionBox">
                   <h3 class="sec_head_text w-100">Classification</h3>
                   <div class="col-md-4 pl-0 inputPaddingLeft">
                     <div class="form-group">
                       <label for="Delivery Mechanism">Delivery Mechanism</label>
                       <select name="classification[delivery_mechanism]" class="custom-select">
                         <option >Select</option>
                         @foreach (config('cms.delivery_mechanism') as $index => $value)
                         <option value="{{$index}}" {{@$product->classification->delivery_mechanism == $index ? 'selected' : ''}}>{{$value}}</option>
                         @endforeach
                     </select>
                     </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="Toy Type">Toy Type</label>
                       <select name="classification[toy_type]" class="custom-select">
                         <option >Select</option>
                         @foreach (config('cms.toy_type') as $index => $value)
                         <option value="{{$index}}" {{@$product->classification->toy_type == $index ? 'selected' : ''}}>{{$value}}</option>
                         @endforeach
                       </select>
                     </div>
                   </div>
                     <div class="col-md-4">
                       <div class="form-group">
                         <label for="Launched">Launched</label>
                         <input id="Launched" type="number" name="classification[launched]"
                         value="{{@$product->classification->launched }}"
                         class="form-control" placeholder="">
                       </div>
                     </div>
                   <!-- </div>
                   <div class="row"> -->
                     
                     {{-- <div class="col-md-4 pl-0 inputPaddingLeft">
                       <div class="form-group">
                       <label for="Inventor">Inventor</label><span class="text-danger">*</span>
                       <input id="Inventor" type="text" name="classification[inventor]"
                       value="{{@$product->classification->inventor }}"
                        class="form-control" placeholder="">
                       </div>
                     </div> --}}
               
                     <div class="col-md-4 pl-0 inputPaddingLeft">
                       <div class="form-group mb-0">
                         <label for="Team">Team</label><span class="text-danger"></span>
                         <input id="Team" type="text" name="classification[team]" value="{{@$product->classification->team }}" class="form-control" placeholder="">
                       </div>
                     </div>
                 </div>
               </div>  */ ?>
            <div class="col-md-12">
               <div class="row sectionBox">
                  <h3 class="sec_head_text w-100">Official Link</h3>
                  <!-- <span class="parent-row"> -->
                  <!-- <div  class="row add-row"> -->
                  <!-- <div class="col-md-6 pl-0 inputPaddingLeft">
                     <div class="form-group mb-0">
                       <label for="Propose Offical Link">Url Link</label>
                       <input type="url" id="ProposeOfficalLink" name="official_links[]" placeholder="URL here"
                         class="form-control">
                     </div>
                     
                     </div>
                     <div class="col-md-2" >
                     <label for="Propose Offical Link" style="visibility:hidden;">Add more</label> 
                     <button type="button" class="btn btnAll add-link" style="margin-top: 18px;">+ Add</button> 
                     </div> -->
                  <!-- </div> -->
                  
                  <!-- <div  class="row add-row"> -->
                    
                  <div class="col-md-6 pl-0 inputPaddingLeft">
                     <div class="form-group">
                        <label for="Propose Offical Link">Link 1</label><span class="text-danger"></span>
                        <input type="url" id="ProposeOfficalLink" value="<?php echo e(@$product->officialLinks[0]->value); ?>" name="official_links[]" placeholder="Link 1 here"
                           class="form-control">
                     </div>
                  </div>
                   <div class="col-md-6 pl-0 inputPaddingLeft">
                     <div class="form-group mb-0">
                        <label for="Propose Offical Link">Link 2</label><span class="text-danger"></span>
                        <input type="url" id="ProposeOfficalLink" value="<?php echo e(@$product->officialLinks[1]->value); ?>" name="official_links[]" placeholder="Link 2 here"
                           class="form-control">
                     </div>
                  </div>
              
                  <!--<div class="col-md-2" >
                     <label for="Propose Offical Link" style="visibility:hidden;">Add more</label> 
                     <button type="button" class="btn btnAll remove-link" style="margin-top: 18px;">- Remove</button>
                     </div>-->
                  <!-- </div> -->
                  
                  <!-- </span> -->
               </div>
            </div>
            <div class="col-md-12">
               <div id="Five_Product" class="row sectionBox">
                  <h3 class="sec_head_text w-100">Social Media</h3>
            <?php $__currentLoopData = config('cms.social_media'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(in_array($social, config('cms.social_media_now'))): ?> 
                <?php if($loop->index > 8): ?>
                     <div class="col-md-3 Login-Style rounded w-12 pl-0 inputPaddingLeft">
                         <div class="form-group formMarginBotZero">
                             <label for="<?php echo e($social); ?>"><?php echo e($social); ?></label>
                             <input type="url" id="<?php echo e($social); ?>" name="socials[<?php echo e($index); ?>]"
                              value="<?php echo e(isset($product) && count($product->socialMedia) > 0 ? @$product->socialMedia->pluck('value','type')->toArray()[$index] : ''); ?>"
                                class="form-control social">
                         </div>
                     </div>
                     <?php elseif($loop->index > 8 && $loop->index < 16): ?> 
                     <div class="col-md-3 Login-Style rounded w-12 pl-0 inputPaddingLeft">
                         <div class="form-group formMarginBotZero">
                             <label for="<?php echo e($social); ?>"><?php echo e($social); ?></label>
                             <input type="url" id="<?php echo e($social); ?>" name="socials[<?php echo e($index); ?>]"
                                 value="<?php echo e(isset($product) && count($product->socialMedia) > 0 ?  @$product->socialMedia->pluck('value','type')->toArray()[$index] : ''); ?>"
                                class="form-control social">
                         </div>
                     </div>
                     <?php else: ?>
                     <div class="col-md-3 Login-Style rounded w-12 pl-0 inputPaddingLeft">
                         <div class="form-group formMarginBotZero">
                             <label for="<?php echo e($social); ?>"><?php echo e($social); ?></label>
                             <input type="url" id="<?php echo e($social); ?>" name="socials[<?php echo e($index); ?>]"
                                 value="<?php echo e(isset($product) && count($product->socialMedia) > 0 ?   @$product->socialMedia->pluck('value','type')->toArray()[$index] : ''); ?>"
                                class="form-control social">
                         </div>
                     </div>
               <?php endif; ?>
            <?php endif; ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </div>
            </div>
            <!-- <h3 class="Tile-style social my-0">Video</h3>
               <span class="parent-row">
                   <div  class="row add-row">
                       <div class="col-md-3">
                         <div class="form-group">
                           <label for="Propose Offical Link">Video Link</label>
                           <input type="url" name="videos[]" placeholder="Video Link here"
                             class="form-control">
                         </div>
               
                       </div>
                       <div class="col-md-2" >
                         <label for="Propose Offical Link" style="visibility:hidden;">Add more</label>
                         <button type="button" class="btn btn-success add-link">+ Add</button>
                       </div>
                   </div>
               </span> -->
            <!-- <h3 class="Tile-style social my-0">In Depth Reviews</h3>
               <div id="Eight_Product" class="row">
                 <div class="col-md-12">
                   <div class="form-group">
                     <label for="Review">Review</label>
                     <textarea class="form-control" rows="5" name="other[in_depth_review]" id="Review" placeholder=""><?php echo e(@$product->other->in_depth_review); ?></textarea>
                   </div>
                 </div>
               </div> -->
            
            <?php /*
               <h2 class="Tile-style social my-0">Statistics</h2>
               
               <div class="col-md-12">
                   <div id="Eleven_Product" class="row sectionBox">
                     <h3 class="sec_head_Innertext w-100 " >Play Stats</h3>
                       <div class="col-md-4 Login-Style rounded pl-0 inputPaddingLeft">
                           <div class="form-group ">
                               <label for="Average Rating">Average Rating</label>
                               <input id="AverageRating" type="number"
                                   class="form-control" name="stats[rating]" value="{{@$product->statics->rating}}">
                           </div>
                           <div class="form-group">
                               <label for="Number of Ratings">Number of Ratings</label>
                               <input id="NumberofRatings" type="number" name="stats[number_of_ratings]" value="{{@$product->statics->number_of_ratings}}"
                                   class="form-control" placeholder="">
                           </div>
                       </div>
                       <div class="col-md-4 Login-Style rounded">
                           <div class="form-group">
                               <label for="Standard Deviation">Standard Deviation</label>
                               <input id="StandardDeviation" type="text" name="stats[standard_deviation]" value="{{@$product->statics->standard_deviation}}"
                                   class="form-control" placeholder="">
                           </div>
                           <div class="form-group">
                               <label for="Comments">Comments</label>
                               <textarea class="form-control" rows="1" id="Comments" name="stats[comments]" >{{@$product->statics->comments}}</textarea>
                           </div>
                       </div>
                       <div class="col-md-4 Login-Style rounded">
                           <div class="form-group">
                               <label for="Fans">Fans</label>
                               <input id="Fans" type="text" name="stats[fans]" value="{{@$product->statics->fans}}" class="form-control" placeholder="">
                           </div>
                           <div class="form-group">
                               <label for="Page Views">Page Views</label>
                               <input id="PageViews" type="text" name="stats[page_views]" value="{{@$product->statics->page_views}}" class="form-control"
                                   placeholder="">
                           </div>
                       </div>
                   <!-- </div>
                   <div id="Twelve_Product" class="row"> -->
                       <div class="col-md-4 Login-Style rounded pl-0 inputPaddingLeft">
                           <h3 class="sec_head_Innertext w-100">Play Ranks</h3>
                           <div class="form-group">
                               <label for="Overall Rank">Overall Rank</label>
                               <input id="OverallRank" type="number" name="stats[overall_rank]" value="{{@$product->statics->overall_rank}}" class="form-control"
                                   placeholder="">
                           </div>
                           <div class="form-group">
                               <label for="Party Rank">Party Rank</label>
                               <input id="PartyRank" type="number" name="stats[party_rank]" value="{{@$product->statics->party_rank}}" class="form-control"
                                   placeholder="">
                           </div>
                       </div>
                       <div class="col-md-4 Login-Style rounded pl-0 inputPaddingLeft">
                           <h3 class="sec_head_Innertext w-100">Play Stats</h3>
                           <div class="form-group">
                               <label for="All Time Plays">All Time Plays</label>
                               <input id="AllTimePlays" type="number" name="stats[all_time_plays]" value="{{@$product->statics->all_time_plays}}"
                                   class="form-control" placeholder="">
                           </div>
                           <div class="form-group">
                               <label for="This month">This month</label>
                               <input id="Thismonth" type="number" name="stats[this_month]" value="{{@$product->statics->this_month}}" class="form-control"
                                   placeholder="">
                           </div>
                       </div>
                       <div class="col-md-4 Login-Style rounded pl-0 inputPaddingLeft">
                           <h3 class="sec_head_Innertext w-100">Parts Exchange</h3>
                           <div class="form-group">
                               <label for="Has Parts">Has Parts</label>
                               <select name="stats[has_part]" class="custom-select">
                                   <option >Select</option>
                                   @foreach(config('cms.other_action') as $key => $value)
                                   <option value="{{$value}}" {{@$product->statics->has_part == $value ? 'selected' : ''}}>{{$value}}</option>
                                   @endforeach
                               </select>
                           </div>
                           <div class="form-group mb-0">
                               <label for="Wants Parts">Wants Parts</label>
                               <select name="stats[wants_part]"  class="custom-select">
                                   <option >Select</option>
                                   @foreach(config('cms.other_action') as $key => $value)
                                   <option value="{{$value}}" {{@$product->statics->wants_part == $value ? 'selected' : ''}}>{{$value}}</option>
                                   @endforeach
                               </select>
                           </div>
               
                       </div>
                   </div>
                 </div> */?>
            
            <div class="col-md-12">
               <div class="row sectionBox">
                  <button type="button" class="btn btnAll productSubmitButton">Submit <i class="fa fa-spinner fa-spin str_laoder" style="display: none;"></i></button>
                  <span class="ml-3 mt-3"><input type="checkbox" name="feed_check" value="on"> &nbsp;Share to feed. </span>
               </div>
            </div>
         </div>
      </form>
      <?php echo $__env->make("front.user.product.add_edit_collaborator_popup", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   </div>
</div>
</div>

<div class="modal" id="productEditModalModal">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
      </div>
   </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
   
   jQuery(document).on("change", ".get_sc" , function() {
     var id = $(this).val();
     var no = $(this).data('no');
     $.ajax({
        type:'GET',
        url:"<?php echo e(url('/user/product/get_sub_category')); ?>",
        data:{
             "_token": "<?php echo e(csrf_token()); ?>",
             "id": id,
         },
        success:function(data){
             console.log(data);    
             $('.sub_category_'+no+'').html(data);
        }
     });
   });
</script>
<script type="text/javascript">
   jQuery(document).on("change", "#group_id" , function() {
     var id = $(this).val();
     var no = $(this).data('no');
     $.ajax({
        type:'GET',
        url:"<?php echo e(url('/user/product/get_category_BYGroup')); ?>",
        data:{
             "_token": "<?php echo e(csrf_token()); ?>",
             "id": id,
         },
        success:function(data){
             console.log(data);    
             $('#category1').html(data);
             $('#category2').html(data);
             $('#category3').html(data);
        }
     });
   });
</script>
<script type="text/javascript">
   // jQuery('.edit-role-popup-class').click(function(){
   jQuery(document).on("click", ".edit-role-popup-class" , function() {
     
    
     var collaboration_id      = $(this).data('collaboration_id');
     var user_name  = jQuery(this).data('user_name');
   var people_id  = jQuery(this).data('people_id');
   var str_people_name  = jQuery(this).data('people_name');
   
     var user_role  = jQuery(this).data('user_role');
     var user_image  = jQuery(this).data('user_image');
     var hidden_user_image  = jQuery(this).data('hidden_user_image');
     // alert(user_role+'=='+collaboration_id+'----'+user_image);
   
     $('#myModal').modal('show');
     $("#myModal #collaboration_id").val( collaboration_id );
   
   console.log(str_people_name);
     if(str_people_name!="")
   {
    $("#myModal #collab_user_name").val( str_people_name ); 
   }
   else
   {
   $("#myModal #collab_user_name").val( user_name );
   }
     
   $("#myModal #collab_user_role").val( user_role );
     $("#myModal #blah2").attr('src',user_image );
     $("#myModal #collab_hidden_user_image").val(hidden_user_image );
   $("#myModal #collab_user_id_hidden").val(people_id );
   
   
   });

   function editCollaboratorModal(collaborator_id){
      $.ajax({
         type:'GET',
         url:"<?php echo e(url('/user/product/collaborator/edit_modal/')); ?>/"+collaborator_id,
         data:{
              "_token": "<?php echo e(csrf_token()); ?>",
          },
         dataType:'json',
         success:function(data){
            if(data.status == 1){
               $('#productEditModalModal .modal-content').html(data.view);
               $('#productEditModalModal').modal('show');
            }
              console.log(data);    
              
         }
      });
   }
   
   function deleteCollaboratorModal(collaborator_id){
     if (confirm('Are you sure?')) {
       var url = $(this).attr('href');
       $('#content').load(url);
     }
   }
   
   function deleteCollaboratorModal(collaborator_id){
     if (confirm('Are you sure?')) {
       $.ajax({
          type:'GET',
          url:"<?php echo e(url('/user/product/collaborator/delete/')); ?>/"+collaborator_id,
          data:{
               "_token": "<?php echo e(csrf_token()); ?>",
           },
          success:function(data){
               console.log(data);    
               $('#row_'+collaborator_id+'').remove();
          }
       });
     }
   }
   
   // $(document).on('click', '.AddEditCollabModalSave', function (e) {
   // $(document).on('click', '.AddEditCollabModalSave', function (e) {
   //     e.preventDefault();
   //     var fd = new FormData($('#AddEditCollabModalForm')[0]);
   //     var collaboration_id = $("#collaboration_id").val();
   //     console.log(collaboration_id);
   //     console.log(fd);
   //     $.ajax({
   //         url: "<?php echo e(route('front.user.product.collaborator.AddEdit')); ?>",
   //         data: fd,
   //         processData: false,
   //         contentType: false,
   //         dataType: 'json',
   //         type: 'POST',
   //         beforeSend: function () {
   //             $('.AddEditCollabModalSave').attr('disabled', true);
   //             // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
   //         },
   //         error: function (jqXHR, exception) {
   //             $('.AddEditCollabModalSave').attr('disabled', false);
   
   //             var msg = formatErrorMessage(jqXHR, exception);
   //             toastr.error(msg)
   //             console.log(msg);
   //             // $('.message_box').html(msg).removeClass('hide');
   //         },
   //         success: function (data) {
   //             $('.AddEditCollabModalSave').attr('disabled', false);
   //             $("#AddEditCollabModalForm").trigger("reset");
   //             $("#blah2").attr("src",'');
   //             $('#myModal, #productEditModalModal').modal('hide');
   //             // if ('<?php echo e(@$slug); ?>' != '' ) 
   //             // {
   //             //     window.location.replace("<?php echo e(route('front.user.product.update',@$slug ?? null)); ?>");
   //             // }
   //             if(collaboration_id !=''){
   //                 console.log(data.html);
   //                 $('#row_'+collaboration_id+'').html(data.html);
   //             }
   //             else{
   //                 $("#table_append").append(data.html);
   //             }
   //         }
   //     });
   // });

   
  function submitEditCollabModalForm(e,id){
      // alert('here123');
      var collaboration_id = $("#"+id).val();
      console.log(collaboration_id);
      // return false;
      $.ajax({
         url: "<?php echo e(route('front.user.product.collaborator.AddEdit')); ?>",
         data: $(e).serialize(),
         dataType: 'json',
         type: 'POST',
         beforeSend: function () {
            $('.AddEditCollabModalSave').attr('disabled', true);
            // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
         },
         error: function (jqXHR, exception) {
            $('.AddEditCollabModalSave').attr('disabled', false);

            var msg = formatErrorMessage(jqXHR, exception);
            toastr.error(msg)
            console.log(msg);
            // $('.message_box').html(msg).removeClass('hide');
         },
         success: function (data) {
         if(collaboration_id !=''){
               console.log(data.html);
               $('#row_'+collaboration_id+'').html(data.html);
         }
         else{
               $("#table_append").append(data.html);
         }
         $('.AddEditCollabModalSave').attr('disabled', false);
         $('#myModal, #productEditModalModal').modal('hide');
         }
      });
   }
   
</script>
<script>
   $(function ($) {
       $(document).on('click','.add-link',function(e) {
           e.preventDefault();
           var rowSample = $(this)
               .closest('.add-row')
               .clone()
               .appendTo($(this).closest('.parent-row'))
               .find('.add-link')
               .removeClass('add-link btn-success')
               .addClass('remove-link btn-danger')
               .html('- Remove')
       })
   
       $(document).on('click','.remove-link',function(e) {
           e.preventDefault();
           var rowSample = $(this)
               .closest('.add-row')
               .remove()
       })
   
       $(document).on('click', '.productSubmitButton', function (e) {
           e.preventDefault();
           // var error = '';
           // $( ".social" ).each(function( index ) {
           //     var str = $( this ).val();
           //     var name = $(this).attr('id');
           //     if(str != ''){
           //         console.log(name + validURL(str))
           //         if(validURL(str) == false){
           //             toastr.error(name + ' URL is Invalid');
           //             error = 'yes';
           //             return false;
           //         }
           //     }
           // });
           // if(error != '' && error == 'yes'){
           //     return false;
           // }
           var fd = new FormData($('#productForm')[0]);
           //var ckeditor_description_new = frontend_get_ckeditor_description_new('Productdescription');
           //fd.append('product[description]', ckeditor_description_new);
           $.ajax({
               url: "<?php echo e(route('front.user.product.create')); ?>",
               data: fd,
               processData: false,
               contentType: false,
               dataType: 'json',
               type: 'POST',
               beforeSend: function () {
                   $('.productSubmitButton').attr('disabled', true);
                    $('.str_laoder').show();
                   // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
               },
               error: function (jqXHR, exception) {
                   $('.productSubmitButton').attr('disabled', false);
   
                   var msg = formatErrorMessage(jqXHR, exception);
                    $('.str_laoder').hide();
                   toastr.error(msg)
                   // console.log(msg);
                   // $('.message_box').html(msg).removeClass('hide');
               },
               success: function (data) {
                   $('.productSubmitButton').attr('disabled', false);
                   // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                   toastr.success(data.message);
                    $('.str_laoder').hide();
                   $('#productForm').trigger('reset')
                   window.location.replace('<?php echo e(route("front.user.product.index")); ?>');
   
               }
           });
       });
   
   
   });
</script>
<!-- chandan code start-->
<script>
   // preview images by kundan
    function readURL(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();
   
             reader.onload = function (e) {
                 $('#blah')
                     .attr('src', e.target.result);
             };
   
             reader.readAsDataURL(input.files[0]);
         }
     }

function showAllsocailMedia(e,type) {
    if(type==1) {
     $('.no-all-socail-icon').hide();
     $('.all-socail-icon').show();
    } else {
     $('.all-socail-icon').hide();
     $('.no-all-socail-icon').show();
  
   }
  }
   
   
     // preview images by kundan
    function readURL2(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();
   
             reader.onload = function (e) {
                 $('#blah2')
                     .attr('src', e.target.result);
             };
   
             reader.readAsDataURL(input.files[0]);
         }
     }
   
   // File Upload
   //
   /*function ekUploadten(){
   function Init() {
   
   console.log("Upload Initialised");
   
   var fileSelect    = document.getElementById('file-uploadten'),
     fileDrag      = document.getElementById('file-dragten');
   
   fileSelect.addEventListener('change', fileSelectHandler, false);
   
   // Is XHR2 available?
   var xhr = new XMLHttpRequest();
   if (xhr.upload) {
   // File Drop
   fileDrag.addEventListener('dragover', fileDragHover, false);
   fileDrag.addEventListener('dragleave', fileDragHover, false);
   fileDrag.addEventListener('drop', fileSelectHandler, false);
   }
   }
   
   function fileDragHover(e) {
   var fileDrag = document.getElementById('file-dragten');
   
   e.stopPropagation();
   e.preventDefault();
   
   fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
   }
   
   function fileSelectHandler(e) {
   // Fetch FileList object
   var files = e.target.files || e.dataTransfer.files;
   
   // Cancel event and hover styling
   fileDragHover(e);
   
   // Process all File objects
   for (var i = 0, f; f = files[i]; i++) {
   parseFile(f);
   uploadFile(f);
   }
   }
   
   // Output
   function output(msg) {
   // Response
   var m = document.getElementById('messagesten');
   m.innerHTML = msg;
   }
   
   function parseFile(file) {
   
   console.log(file.name);
   output(
   '<strong>123' + encodeURI(file.name) + '</strong>'
   );
   
   // var fileType = file.type;
   // console.log(fileType);
   var imageName = file.name;
   
   var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
   if (isGood) {
   //  alert("good");
   // Thumbnail Preview
   document.getElementById('file-imageten').classList.remove("hidden");
   document.getElementById('file-imageten').src = URL.createObjectURL(file);
   }
   else {
   document.getElementById('file-imageten').classList.add("hidden");
   document.getElementById('notimageten').classList.remove("hidden");
   document.getElementById('startten').classList.remove("hidden");
   document.getElementById('responseten').classList.add("hidden");
   document.getElementById("file-upload-formten").reset();
   }
   }
   
   function setProgressMaxValue(e) {
   var pBar = document.getElementById('file-progressten');
   
   if (e.lengthComputable) {
   pBar.max = e.total;
   }
   }
   
   function updateFileProgress(e) {
   var pBar = document.getElementById('file-progressten');
   
   if (e.lengthComputable) {
   pBar.value = e.loaded;
   }
   }
   
   function uploadFile(file) {
   
   var xhr = new XMLHttpRequest(),
   fileInput = document.getElementById('class-roster-fileten'),
   pBar = document.getElementById('file-progressten'),
   fileSizeLimit = 400; // In MB
   if (xhr.upload) {
   // Check if file is less than x MB
   if (file.size <= fileSizeLimit * 400 * 400) {
     // Progress bar
     pBar.style.display = 'inline';
     xhr.upload.addEventListener('loadstartten', setProgressMaxValue, false);
     xhr.upload.addEventListener('progressten', updateFileProgress, false);
   
     // File received / failed
     xhr.onreadystatechange = function(e) {
       if (xhr.readyState == 4) {
         // Everything is good!
   
         // progress.className = (xhr.status == 200 ? "success" : "failure");
         // document.location.reload(true);
       }
     };
   
     // Start upload
     xhr.open('POST', document.getElementById('file-upload-formten').action, true);
     xhr.setRequestHeader('X-File-Name', file.name);
     xhr.setRequestHeader('X-File-Size', file.size);
     xhr.setRequestHeader('Content-Type', 'multipart/form-data');
     xhr.send(file);
   } else {
     output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
   }
   }
   }
   
   // Check for the various File API support.
   if (window.File && window.FileList && window.FileReader) {
   Init();
   } else {
   document.getElementById('file-dragten').style.display = 'none';
   }
   }*/
   
</script>
<script>
   // File Upload
   //
   /* function ekUploadsecond(){
     function Init() {
   
       console.log("Upload Initialised");
   
       var fileSelect    = document.getElementById('file-uploadsecond'),
           fileDrag      = document.getElementById('file-dragsecond'),
           submitButton  = document.getElementById('submit-buttonsecond');
   
       fileSelect.addEventListener('change', fileSelectHandler, false);
   
       // Is XHR2 available?
       var xhr = new XMLHttpRequest();
       if (xhr.upload) {
         // File Drop
         fileDrag.addEventListener('dragover', fileDragHover, false);
         fileDrag.addEventListener('dragleave', fileDragHover, false);
         fileDrag.addEventListener('drop', fileSelectHandler, false);
       }
     }
   
     function fileDragHover(e) {
       var fileDrag = document.getElementById('file-dragsecond');
   
       e.stopPropagation();
       e.preventDefault();
   
       fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
     }
   
     function fileSelectHandler(e) {
       // Fetch FileList object
       var files = e.target.files || e.dataTransfer.files;
   
       // Cancel event and hover styling
       fileDragHover(e);
   
       // Process all File objects
       for (var i = 0, f; f = files[i]; i++) {
         parseFile(f);
         uploadFile(f);
       }
     }
   
     // Output
     function output(msg) {
       // Response
       var m = document.getElementById('messagessecond');
       m.innerHTML = msg;
     }
   
     function parseFile(file) {
   
       console.log(file.name);
       output(
         '<strong>' + encodeURI(file.name) + '</strong>'
       );
   
       // var fileType = file.type;
       // console.log(fileType);
       var imageName = file.name;
   
       var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
       if (isGood) {
         document.getElementById('startsecond').classList.add("hidden");
         document.getElementById('responsesecond').classList.remove("hidden");
         document.getElementById('notimagesecond').classList.add("hidden");
         // Thumbnail Preview
         document.getElementById('file-imagesecond').classList.remove("hidden");
         document.getElementById('file-imagesecond').src = URL.createObjectURL(file);
       }
       else {
         document.getElementById('file-imagesecond').classList.add("hidden");
         document.getElementById('notimagesecond').classList.remove("hidden");
         document.getElementById('startsecond').classList.remove("hidden");
         document.getElementById('responsesecond').classList.add("hidden");
         document.getElementById("file-upload-formsecond").reset();
       }
     }
   
     function setProgressMaxValue(e) {
       var pBar = document.getElementById('file-progresssecond');
   
       if (e.lengthComputable) {
         pBar.max = e.total;
       }
     }
   
     function updateFileProgress(e) {
       var pBar = document.getElementById('file-progresssecond');
   
       if (e.lengthComputable) {
         pBar.value = e.loaded;
       }
     }
   
     function uploadFile(file) {
   
       var xhr = new XMLHttpRequest(),
         fileInput = document.getElementById('class-roster-filesecond'),
         pBar = document.getElementById('file-progresssecond'),
         fileSizeLimit = 400; // In MB
       if (xhr.upload) {
         // Check if file is less than x MB
         if (file.size <= fileSizeLimit * 400 * 400) {
           // Progress bar
           pBar.style.display = 'inline';
           xhr.upload.addEventListener('loadstartsecond', setProgressMaxValue, false);
           xhr.upload.addEventListener('progresssecond', updateFileProgress, false);
   
           // File received / failed
           xhr.onreadystatechange = function(e) {
             if (xhr.readyState == 4) {
               // Everything is good!
   
               // progress.className = (xhr.status == 200 ? "success" : "failure");
               // document.location.reload(true);
             }
           };
   
           // Start upload
           xhr.open('POST', document.getElementById('file-upload-formsecond').action, true);
           xhr.setRequestHeader('X-File-Name', file.name);
           xhr.setRequestHeader('X-File-Size', file.size);
           xhr.setRequestHeader('Content-Type', 'multipart/form-data');
           xhr.send(file);
         } else {
           output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
         }
       }
     }
   
     // Check for the various File API support.
     if (window.File && window.FileList && window.FileReader) {
       Init();
     } else {
       document.getElementById('file-dragsecond').style.display = 'none';
     }
   } */
   
</script>
<!-- chandan code end -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script>
   $(function () {
        $('input[type="file"]').change(function () {
             if ($(this).val() != "") {
                    $(this).css('color', '#333');
             }else{
                    $(this).css('color', 'transparent');
             }
        });
   })
</script>
<script type="text/javascript">
   var btn = '2';
   $('#open_cat').click(function(){
       if(btn == 2){
         $('#open_category'+btn).removeClass('hide');
         $('#open_category'+btn).addClass('open');
         btn++;
       } else if(btn == '3'){
         $('#open_category'+btn).removeClass('hide');
         $('#open_category'+btn).addClass('open');
       }    
   });
   
   
   
   $(document).ready(function(){
      
      $(".select2-multiple").select2({
         theme: "bootstrap ",
         placeholder: "Manufacture",
         containerCssClass: 'feedSelectInput',
         maximumSelectionLength: 1,
      });

      $(".select2-multiple-brand").select2({
         theme: "bootstrap ",
         placeholder: "Brand",
         containerCssClass: 'feedSelectInput',
         maximumSelectionLength: 1,
      });

      $(".select2-multiple-collab").select2({
         theme: "bootstrap ",
         placeholder: "Collabrator",
         containerCssClass: 'feedSelectInput',
         maximumSelectionLength: 1,
      });
   
   /*$('#bt_product_brand_list_id').click(function () {
             $('#product_brand_list_id').val('').trigger("change");
         });
   
   $('#bt_company_list_id').click(function () {
             $('#company_list_id').val('').trigger("change");
         });
   
   
         ajaxSelect2();
         function ajaxSelect2() {
             // Select2 Ajax
             $(document).find(".select-ajax").select2({
                 minimumInputLength: 2,
                 ajax: {
                     url: '<?php echo e(route("front.user.getBrandList")); ?>',
                     dataType: 'json',
                     tags: true,
                     placeholder: "Search Item",
                     allowClear: true,
                     type: "GET",
                     quietMillis: 100,
                     delay: 250,
                     data: function (term) {
                         return {
                             query: term,
                         };
                     },
                     processResults: function (data, params) {
                         params.page = params.page || 1;
                         return {
                             results: data.data,
                             pagination: {
                                 more: (params.page * 50) < data.total
                             },
                             cache: true
                         }
                     }
                 }
             })
             .on('select2:select',function() {
                 var val = $(this).val();
                 console.log(val)
                 if($.isNumeric(val)){
                     $(this).closest('.form-group').find('input[type="hidden"]').val(1)
                 }
             });
             // End Select2 Ajax
         }
   
   
   ajaxSelect2_company();
         function ajaxSelect2_company() {
             // Select2 Ajax
             $(document).find(".select-ajax-company").select2({
                 minimumInputLength: 2,
                 ajax: {
                     url: '<?php echo e(route("front.user.getAgent")); ?>',
                     dataType: 'json',
                     tags: true,
                     placeholder: "Search Item",
                     allowClear: true,
                     type: "GET",
                     quietMillis: 100,
                     delay: 250,
                     data: function (term) {
                         return {
                             query: term,
                         };
                     },
                     processResults: function (data, params) {
                         params.page = params.page || 1;
                         return {
                             results: data.data,
                             pagination: {
                                 more: (params.page * 50) < data.total
                             },
                             cache: true
                         }
                     }
                 }
             })
             .on('select2:select',function() {
                 var val = $(this).val();
                 console.log(val)
                 if($.isNumeric(val)){
                     $(this).closest('.form-group').find('input[type="hidden"]').val(1)
                 }
             });
             // End Select2 Ajax
         }*/
    
   
   
     })
</script>
 <?php echo $__env->make("front.profile.edit_profile_dob_js", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>