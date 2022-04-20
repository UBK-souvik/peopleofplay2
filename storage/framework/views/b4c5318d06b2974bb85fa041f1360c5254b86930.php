

<?php $__env->startSection('title'); ?> 

<?php if(!empty($product->id)): ?>
 <?php echo e('Update'); ?>

<?php else: ?>
 <?php echo e('Create'); ?>

<?php endif; ?>	
Product 

<?php $__env->stopSection(); ?>
  <link rel="stylesheet" href="<?php echo e(url('front/new/css/style_two.css')); ?>">
<style>
      img#blah { width: 100px;    height: 100px; }
      .accordion__header {
        padding: 1em;
        background-color: #ccc;
        margin-top: 2px;
        display: -webkit-box;
        display: flex;
        -webkit-box-pack: justify;
                justify-content: space-between;
        -webkit-box-align: center;
                align-items: center;
        cursor: pointer;
      }

      .accordion__header > * {
        margin-top: 0;
        margin-bottom: 0;
        font-size: 16px;
        font-weight: 500;
        /*color: #000;*/
      }

      .accordion__header.is-active {
        background-color: #000;
        color: #fff!important;
      }

      .accordion__toggle {
        margin-left: 10px;
        height: 3px;
        background-color: #222;
        width: 13px;
        display: block;
        position: relative;
        flex-shrink: 1;
        border-radius: 2px;
      }

      .accordion__toggle::before {
        content: "";
        width: 3px;
        height: 13px;
        display: block;
        background-color: #222;
        position: absolute;
        top: -5px;
        left: 5px;
        border-radius: 2px;
      }

      .is-active .accordion__toggle {
        background-color: #fff;
      }

      .is-active .accordion__toggle::before {
        display: none;
      }

      .accordion__body {
        display: none;
        padding: 1em;
        border: 1px solid #ccc;
        border-top: 0;
      }

      .accordion__body.is-active {
        display: block;
      }
      .adduserbutton{
          margin-top: 8px;
      }
      .inner_heading{
        font-size: 20px;
      }
</style>
<style>
    .social_media .form-group {
         margin-right: 0px; 
         margin-left: 0px; 
    }
    .hide { display: none; }
    .open { display: block; }
</style>
<?php $__env->startSection('content'); ?>

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

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> 
<?php if(!empty($product->id)): ?>
 <?php echo e('Update'); ?>

<?php else: ?>
 <?php echo e('Create'); ?>

<?php endif; ?> 
Product</h1>
        <ol class="breadcrumb">
           <li><a href="<?php echo e(url('admin/dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
           <li><a href="<?php echo e(url('admin/products')); ?>">All Products</a></li>
           <li class="active">
<?php if(!empty($product->id)): ?>
 <?php echo e('Update'); ?>

<?php else: ?>
 <?php echo e('Create'); ?>

<?php endif; ?> 
Product</li>
        </ol>
    </section>
    <section class="content">
        <div class="row"  id="divProductMainDivIdAdminNew">
           <div class="col-md-12">
              <div class="box">
                  <div class="box-body">
                    <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                    <form class="form-horizontal">
                      <input type="hidden" name="product_id" value="<?php echo e(@$product->id); ?>">
                      <?php echo csrf_field(); ?>
                      <div class="accordion">
                          <div class="accordion__header is-active">
                              <h2>Basic Details</h2>
                              <span class="accordion__toggle"></span>
                          </div>
                          <div class="accordion__body is-active">
                              <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Main Image <i class="has-error"></i></label>
                                <div class="col-sm-6">
                                  <?php if(@$product->main_image): ?>
                                      <img id="blah" src="<?php echo e(imageBasePath($product->main_image)); ?>" class="twoFiftySeven">
                                  <?php else: ?>
                                      <img id="blah" src="<?php echo e(url('front/new/images/10.png')); ?>" alt="Preview" class="twoFiftySeven">
                                  <?php endif; ?>
                                 <input id="file-uploadten1" type="file" onchange="readURL(this);" class="custom-file-input1 marginTopFive" name="main_image" accept="image/*" />
                                 <h4 class="text-danger ">Note: Please upload image up to 2MB only</h4>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Product by<i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                   <select class="form-control select2" name="product[user_id]" id="user_id">
                                     <option value="">Select One</option>
                                     <?php if(count($users) > 0): ?>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($user->id); ?>" <?php echo e((@$product->user_id  == $user->id ) ? 'selected' :''); ?>> <?php echo e($user->text); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php endif; ?>
                                   </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Product ID <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                   <input id="ProductID" type="text" class="form-control" readonly name="product[product_id_number]" value="<?php echo e($product->product_id_number ?? generateRandomString()); ?>"placeholder="">
                                </div>
                              </div>
                             <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Product Name <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <input id="ProductName" type="text" value="<?php echo e(@$product->name); ?>" name="product[name]" class="form-control" placeholder="">
                                </div>
                             </div>
                             							    							 

                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Group Name<i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                  <select required="" class="form-control" name="product[group_id]" id="group_id">
                                      <option value="">Select Group</option>
                                      <?php $__currentLoopData = config('cms.group'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>" <?php if(!empty($product->group_id) && $product->group_id == $key ): ?> selected <?php endif; ?>><?php echo e($value); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                                </div>
                             </div>

                             <!-- start category 1 -->
                             <div class="form-group">
                                <label for="category" class="col-sm-2 control-label">Primary Category<i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                   <select name="category1" id="category1" data-no="1" class="custom-select get_sc form-control" data-placeholder="Select">
                                      <option value="">Primary Category </option>
                                      <?php $__currentLoopData = category(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($index); ?>" <?php echo e($index == @$category1 ? 'selected' :''); ?>

                                       ><?php echo e($value); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                  </select>
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="category" class="col-sm-2 control-label">Primary Sub Category<i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                  <select name="sub_category1" id="sub_category1" class="custom-select sub_category_1 form-control" data-placeholder="Select">
                                      <option value="">Primary Sub Category</option>
                                      <?php $__currentLoopData = sub_categoryByCategoryID($category1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($index); ?>" <?php echo e($index == $sub_category1 ? 'selected' :''); ?>

                                           ><?php echo e($value); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                                </div>
                             </div>
                             <!-- end category 1 -->
                             <!-- start category 2 -->
                             <div id="open_category2"  class="<?php echo e((!empty($category2) ) ? 'open' : 'hide'); ?>">
                               <div class="form-group">
                                  <label for="category" class="col-sm-2 control-label">Second Category<i class="has-error"></i></label>
                                  <div class="col-sm-6">
                                     <select name="category2" id="category2" data-no="2" class="custom-select get_sc form-control" data-placeholder="Select">
                                        <option value="">Second Category</option>
                                        <?php $__currentLoopData = category(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($index); ?>" <?php echo e($index == @$category2 ? 'selected' :''); ?>

                                         ><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                  </div>
                               </div>
                               <div class="form-group">
                                  <label for="category" class="col-sm-2 control-label">Second Sub Category<i class="has-error"></i></label>
                                  <div class="col-sm-6">
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
                             <!-- end category 2 -->
                             <!-- start category 3 -->
                             <div id="open_category3" class="<?php echo e((!empty($category3) ) ? 'open' : 'hide'); ?>">
                               <div class="form-group">
                                  <label for="category" class="col-sm-2 control-label">Third Category<i class="has-error"></i></label>
                                  <div class="col-sm-6">
                                     <select name="category3" id="category3" data-no="3" class="custom-select get_sc form-control" data-placeholder="Select">
                                        <option value="">Third Category</option>
                                        <?php $__currentLoopData = category(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($index); ?>" <?php echo e($index == @$category3 ? 'selected' :''); ?>

                                         ><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                  </div>
                               </div>
                               <div class="form-group">
                                  <label for="category" class="col-sm-2 control-label">Third Sub Category<i class="has-error"></i></label>
                                  <div class="col-sm-6">
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
                              <?php if(empty($category2) || empty($category3)): ?>
                                <button type="button" class="btn btn-success" id="open_cat">Add more Categories</button>
                              <?php endif; ?>
                             <!-- end category 3 -->
                             <div class="form-group">
                                <label for="mobile" class="col-sm-2 control-label">Product Description <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                 <textarea class="form-control" name="product[description]" rows="9" id="Productdescription" placeholder=""><?php echo e(@$product->description); ?></textarea>
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="fun_fact1" class="col-sm-2 control-label">Fun Fact 1</label>
                                <div class="col-sm-6">
                                   <input required type="text" class="form-control" name="product[fun_fact1]" placeholder="Fun Fact 1" value="<?php if(!empty(@$product->fun_fact1)): ?><?php echo e(@$product->fun_fact1); ?><?php endif; ?>">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="fun_fact2" class="col-sm-2 control-label">Fun Fact 2</label>
                                <div class="col-sm-6">
                                   <input required type="text" class="form-control" name="product[fun_fact2]" placeholder="Fun Fact 2" value="<?php if(!empty(@$product->fun_fact2)): ?><?php echo e(@$product->fun_fact2); ?><?php endif; ?>">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="fun_fact3" class="col-sm-2 control-label">Fun Fact 3</label>
                                <div class="col-sm-6">
                                   <input required type="text" class="form-control" name="product[fun_fact3]" placeholder="Fun Fact 3" value="<?php if(!empty(@$product->fun_fact3)): ?><?php echo e(@$product->fun_fact3); ?><?php endif; ?>">
                                </div>
                             </div>
							 <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Brand <!-- <i class="has-error">*</i> --> </label>
                                <div class="col-sm-6">
                                   <input id="Brand" type="text" name="product[brand]" value="<?php if(!empty($product->brand_list->name)): ?><?php echo e(@$product->brand_list->name); ?><?php else: ?><?php echo e(@$product->brand); ?><?php endif; ?>" class="form-control" placeholder="">
                                   <input type="hidden"  id="product_brand_hidden_id" name="product[brand_hidden_id]" value="<?php if(!empty($product->brand_list->id)): ?><?php echo e(@$product->brand_list->id); ?><?php endif; ?>">
								</div>
                              </div>
                              <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Manufacturer <!-- <i class="has-error">*</i> --> </label>
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
								
								<div class="col-sm-6">
                                   <input id="Company" type="text" name="product[company]" value="<?php echo e(@$str_company_user_name_new); ?>" class="form-control" placeholder="">
                                   <input type="hidden"  id="product_company_hidden_id" name="product[company_hidden_id]" value="<?php echo e(@$int_company_user_id_new); ?>">
								</div>
                              </div>
							   <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Launched Date <!-- <i class="has-error">*</i> --> </label>
                                <div class="col-sm-6">
                                   <input id="launched_date" type="date" name="product[launched_date]" value="<?php echo e(@$product->launched_date); ?>" class="form-control" placeholder="">
                                </div>
                              </div>
                          </div>
                          <div class="accordion__header">
                              <h2>Buy a copy</h2>
                              <span class="accordion__toggle"></span>
                          </div>
                          <div class="accordion__body">
                              <!-- <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Product Price <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                   <input id="ProductPrice" type="number" name="product[price]" value="<?php echo e(@$product->price); ?>" class="form-control" placeholder="">
                                </div>
                             </div> -->
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Site label 1<i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input type="text" name="buy_from[0][amazon_caption]" value="<?php echo e(@$product->buyFrom->amazon_caption ? $product->buyFrom->amazon_caption : null); ?>" placeholder="Enter Label" class="form-control">
								                    <input  type="hidden" name="buy_from[0][type]" value="1"> 
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Site URL 1<i class="has-error"></i></label>
                                <div class="col-sm-6">
                                    <input  type="hidden" name="buy_from[0][type]" value="1"> 
                                    <!-- $product->buyFrom->first()->amazon -->
                                    <input id="Amazoncom" type="url" name="buy_from[0][amazon]" value="<?php echo e(@$product->buyFrom->amazon ? $product->buyFrom->amazon : null); ?>" class="form-control" placeholder="Enter Url">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Site label 2 <i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input type="text" name="buy_from[0][ebay_caption]" value="<?php echo e(@$product->buyFrom->ebay_caption ? $product->buyFrom->ebay_caption : null); ?>" placeholder="Enter Label" class="form-control">
								                  <input  type="hidden" name="buy_from[0][type]" value="1"> 
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Site URL 2 <i class="has-error"></i></label>
                                <div class="col-sm-6">
                                    <input  type="hidden" name="buy_from[0][type]" value="1"> 
                                    <input id="ebay" type="url" name="buy_from[0][ebay]" value="<?php echo e(@$product->buyFrom->ebay ? $product->buyFrom->ebay : null); ?>" class="form-control" placeholder="Enter Url">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Site label 3 <i class="has-error"></i></label>
                                <div class="col-sm-6">
								                    <input type="text"  name="buy_from[0][pop_caption]" value="<?php echo e(@$product->buyFrom->pop_caption ? $product->buyFrom->pop_caption : null); ?>" placeholder="Enter Label" class="form-control">
                                   <input  type="hidden" name="buy_from[0][type]" value="1"> 
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Site label 3 <i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input  type="hidden" name="buy_from[0][type]" value="1"> 
                                    <input id="pop" type="url" name="buy_from[0][pop]" value="<?php echo e(@$product->buyFrom->pop ? $product->buyFrom->pop : null); ?>" class="form-control" placeholder="Enter Url">
                                </div>
                             </div>
                          </div>
                          <div class="accordion__header">
                              <h2>Collaborators</h2>
                              <span class="accordion__toggle"></span>
                          </div>
                          <div class="accordion__body">
                              <?php echo $__env->make("admin.product.view_collaborator_list", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                          </div>

                        <?php /*
                          <div class="accordion__header">
                              <h2>Classification</h2>
                              <span class="accordion__toggle"></span>
                          </div>
                          <div class="accordion__body">
                              <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Delivery Mechanism</label>
                                <div class="col-sm-6">
                                   <select name="classification[delivery_mechanism]" class="custom-select form-control">
                                        <option >Select</option>
                                        @foreach (config('cms.delivery_mechanism') as $index => $value)
                                        <option value="{{$index}}" {{@$product->classification->delivery_mechanism == $index ? 'selected' : ''}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                              </div>

                             
							 {{--  <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Product Price </label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" name="name" placeholder="Product Price">
                                </div>
                             </div> --}}
							 
							 
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Toy Type </label>
                                <div class="col-sm-6">
                                   <select name="classification[toy_type]" class="custom-select form-control">
                                      <option >Select</option>
                                      @foreach (config('cms.toy_type') as $index => $value)
                                      <option value="{{$index}}" {{@$product->classification->toy_type == $index ? 'selected' : ''}}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Launched </label>
                                <div class="col-sm-6">
                                   <input id="Launched" type="number" name="classification[launched]" value="{{@$product->classification->launched }}" class="form-control" placeholder="">
                                </div>
                             </div>
                             
							 {{-- <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Inventor <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                   <input id="Inventor" type="text" name="classification[inventor]" value="{{@$product->classification->inventor }}" class="form-control" placeholder="">
                                </div>
                             </div> --}}
							 
							 
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Team <i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input id="Team" type="text" name="classification[team]" value="{{@$product->classification->team }}" class="form-control" placeholder="">
                                </div>
                             </div>
                          </div>  */ ?>
						  
						  

                          <div class="accordion__header">
                              <h2>Offical Links</h2>
                              <span class="accordion__toggle"></span>
                          </div>
                          <div class="accordion__body">
                              <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">URL</label>
                                <div class="col-sm-6">
                                   <input type="url" id="ProposeOfficalLink1" name="official_links[1]" placeholder="URL here"class="form-control" value="<?php echo e(@$product->officialLinks[0]->value); ?>">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">URL</label>
                                <div class="col-sm-6">
                                   <input type="url" id="ProposeOfficalLink2" name="official_links[2]" placeholder="URL here"class="form-control" value="<?php echo e(@$product->officialLinks[1]->value); ?>">
                                </div>
                             </div>
                          </div>

                          <div class="accordion__header">
                              <h2>Social Media</h2>
                              <span class="accordion__toggle"></span>
                          </div>
                          <div class="accordion__body">
                              <div class="row social_media">
                                  <?php $__currentLoopData = config('cms.social_media'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php
                                        $str_social_val = '';
                                        if(!empty(@$product->socialMedia))
                                        {   
                                          $str_social_val = @$product->socialMedia->pluck('value','type')->toArray()[$index];
                                        }
                                      ?> 
                                          <div class="col-md-3" >
                                              <div class="form-group" style="margin-left: 0px !important;margin-right: 0px !important;">
                                                  <label for="<?php echo e($social); ?>"><?php echo e($social); ?></label>
                                                  <input type="url" id="<?php echo e($social); ?>" name="socials[<?php echo e($index); ?>]"
                                                   value="<?php echo e($str_social_val); ?>" class="social form-control">
                                              </div>
                                          </div>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </div>
                          </div>
						  
						  
<?php /*
                          <div class="accordion__header">
                              <h2>Statistics</h2>
                              <span class="accordion__toggle"></span>
                          </div>
                          <div class="accordion__body">
                            <h2 class="inner_heading">Play Stats</h2>
                              <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Average Rating<i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input id="AverageRating" type="number" class="form-control" name="stats[rating]" value="{{@$product->statics->rating}}">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Number of Ratings <i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input id="NumberofRatings" type="number" name="stats[number_of_ratings]" value="{{@$product->statics->number_of_ratings}}" class="form-control" placeholder="">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Standard Deviation<i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input id="StandardDeviation" type="text" name="stats[standard_deviation]" value="{{@$product->statics->standard_deviation}}" class="form-control" placeholder="">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Comments <i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <textarea class="form-control" rows="1" id="Comments" name="stats[comments]" >{{@$product->statics->comments}}</textarea>
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Fans <i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input id="Fans" type="text" name="stats[fans]" value="{{@$product->statics->fans}}" class="form-control" placeholder="">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Page Views <i class="has-error"></i></label>
                                <div class="col-sm-6">
                                    <input id="PageViews" type="text" name="stats[page_views]" value="{{@$product->statics->page_views}}" class="form-control" placeholder="">
                                </div>
                             </div>


                             <h2 class="inner_heading">Play Ranks</h2>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Overall Rank <i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input id="OverallRank" type="number" name="stats[overall_rank]" value="{{@$product->statics->overall_rank}}" class="form-control" placeholder="">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Party Rank <i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input id="PartyRank" type="number" name="stats[party_rank]" value="{{@$product->statics->party_rank}}" class="form-control" placeholder="">
                                </div>
                             </div>

                             <h2 class="inner_heading">Play Stats</h2>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">All Time Plays<i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input id="AllTimePlays" type="number" name="stats[all_time_plays]" value="{{@$product->statics->all_time_plays}}" class="form-control" placeholder="">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">This month<i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input id="Thismonth" type="number" name="stats[this_month]" value="{{@$product->statics->this_month}}" class="form-control" placeholder="">
                                </div>
                             </div>


                             <h2 class="inner_heading">Parts Exchange</h2>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Has Parts<i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <select name="stats[has_part]" class="custom-select form-control">
                                      <option >Select</option>
                                      @foreach(config('cms.other_action') as $key => $value)
                                      <option value="{{$value}}" {{@$product->statics->has_part == $value ? 'selected' : ''}}>{{$value}}</option>
                                      @endforeach
                                  </select>
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Wants Parts<i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <select name="stats[wants_part]"  class="custom-select form-control">
                                      <option >Select</option>
                                      @foreach(config('cms.other_action') as $key => $value)
                                      <option value="{{$value}}" {{@$product->statics->wants_part == $value ? 'selected' : ''}}>{{$value}}</option>
                                      @endforeach
                                  </select>
                                </div>
                             </div>
                          </div>
						  
						  


                          <div class="accordion__header">
                              <h2>Collection Stats</h2>
                              <span class="accordion__toggle"></span>
                          </div>
                          <div class="accordion__body">
                              <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Own<i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input id="Own" type="text" name="stats[own]" value="{{@$product->statics->own}}" class="form-control" placeholder="">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Previously Owned<i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input id="PreviouslyOwned" type="text" name="stats[previously_owned]" value="{{@$product->statics->previously_owned}}" class="form-control" placeholder="">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">For Trade<i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input id="ForTrade" type="text" name="stats[for_trade]" value="{{@$product->statics->for_trade}}" class="form-control" placeholder="">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Want In Trade<i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input id="Want In Trade" type="text" name="stats[want_it_trade]" value="{{@$product->statics->want_it_trade}}" class="form-control" placeholder="">
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Wishlist<i class="has-error"></i></label>
                                <div class="col-sm-6">
                                   <input id="Wishlist" type="text" name="stats[wishlist]" value="{{@$product->statics->wishlist}}" class="form-control" placeholder="">
                                </div>
                             </div>
                          </div>
						  */?> 
						  
                          
						  
						  
                      </div>
                    </form>
                  </div>
				 
                  <div class="col-sm-6" style="margin-top: 8px;">
                      <div class="row">
                          <button type="button" class="btn btn-success productSubmitButton" id="createBtn">Save</button>
                      </div>
                  </div>
              </div>
           </div>
        </div>
    </section>

    <?php echo $__env->make("admin.product.add_edit_collaborator_popup", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">
  jQuery(document).on("change", ".get_sc" , function() {
    var id = $(this).val();
    var no = $(this).data('no');
    $.ajax({
       type:'GET',
       url:"<?php echo e(url('/admin/product/get_sub_category')); ?>",
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
       url:"<?php echo e(url('/admin/product/get_category_BYGroup')); ?>",
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
  admin_show_standard_ckeditor_new('Productdescription');
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

  function deleteCollaboratorModal(collaborator_id){
    if (confirm('Are you sure?')) {
      $.ajax({
         type:'GET',
         url:"<?php echo e(url('/admin/product/collaborator/delete/')); ?>/"+collaborator_id,
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

  $(document).on('click', '.AddEditCollabModalSave', function (e) {
      e.preventDefault();
      var fd = new FormData($('#AddEditCollabModalForm')[0]);
      var product_id = "<?php echo e(@$product->id); ?>";
      var collaboration_id = $("#collaboration_id").val();
      console.log(fd);
      $.ajax({
          url: "<?php echo e(route('admin.product.collaborator.AddEdit')); ?>",
          data: fd,
          processData: false,
          contentType: false,
          dataType: 'json',
          type: 'POST',
          beforeSend: function () {
              $('.AddEditCollabModalSave').attr('disabled', true);
          },
          error: function (jqXHR, exception) {
              $('.AddEditCollabModalSave').attr('disabled', false);

              var msg = formatErrorMessage(jqXHR, exception);
              toastr.error(msg)
          },
          success: function (data) {
              console.log(data.html);
              $('.AddEditCollabModalSave').attr('disabled', false);
              $("#AddEditCollabModalForm").trigger("reset");
              $("#blah2").attr("src",'');
              $('#myModal').modal('hide');
              // if ('<?php echo e(@$product->id); ?>' != '' ) 
              // {
              //     window.location.replace("<?php echo e(route('admin.product.update',@$product->id ?? null)); ?>");
              // }
              if(collaboration_id !=''){
                  $('#row_'+collaboration_id+'').html(data.html);
              }
              else{
                  $("#table_append").append(data.html);
              }

          }
      });
  });

</script>
<script>
  $('.accordion__header').click(function(e) {
      e.preventDefault();
      var currentIsActive = $(this).hasClass('is-active');
      $(this).parent('.accordion').find('> *').removeClass('is-active');
      if(currentIsActive != 1) {
        $(this).addClass('is-active');
        $(this).next('.accordion__body').addClass('is-active');
      }
    });
</script>

<script type="text/javascript">
    jQuery(function($) {
       $('.select2').select2()
       
      $(document).on('click','#createBtn',function(e){
            e.preventDefault();
            var fd = new FormData($('form')[0]);  
            var ckeditor_description_new = admin_get_ckeditor_description_new('Productdescription');
            fd.append('product[description]', ckeditor_description_new);
                // var error = '';
                // $( ".social" ).each(function( index ) {
                //     var str = $( this ).val();
                //     var name = $(this).attr('id');
                //     if(str != ''){
                //         console.log(name + validURL(str))
                //         if(validURL(str) == false){
                //             $('.message_box').html(name + ' URL is Invalid').removeClass('alert-success hide').addClass('alert-danger');
                //             error = 'yes';
                //             return false;
                //         }
                //     }
                // });
                // if(error != '' && error == 'yes'){
                //     return false;
                // }
            $.ajax({
                url: "<?php echo e(route('admin.products.create')); ?>",
                processData: false,
                contentType: false,
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function()
                {
                    $('#createBtn').attr('disabled',true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function(jqXHR, exception){
                    $('#createBtn').attr('disabled',false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data)
                {
                    $('#createBtn').attr('disabled',false);
                    if(data.status == 1)
                    {
                        $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        window.location.replace('<?php echo e(route("admin.products.index")); ?>');

                    } else {
                        var message = formatErrorMessageFromJSON(data.errors);
                        $('.message_box').html(message).removeClass('hide');
                    }

                }
            });
        });
    });
</script>

<script type="text/javascript">
  
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
</script>

<?php echo $__env->make('admin.users.admin_edit_profile_dob_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>