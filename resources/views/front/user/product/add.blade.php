@extends('front.layouts.pages')
@section('content')
<link rel="stylesheet" href="{{ asset('front/css/select2-bootstrap.css?'.time()) }}">
<link rel="stylesheet" href="{{ asset('front/new_css/feed_new.css?'.time()) }}">
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
         <input type="hidden" name="product_id" value="{{@$product->id}}">
         @csrf
         <div class="First-column">
            <div class="col-md-12">
               <div id="FirstRow_Product" class="row sectionTop">
                  <div class="col-md-4 imgProfilePadding marginBottomTwenty lessMargin">
                     <?php //if(@$product->main_image)
                        //{
                          ?>
                     <img id="blah" src="{{@prodEventImageBasePath(@$product->main_image)}}" class="kfile_imageten img-fluid imgtwoeighty">
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
                                 readonly name="product[product_id_number]" value="{{$product->product_id_number ?? generateRandomString()}}"
                                 placeholder="">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="ProductName">Product Name</label><span class="text-danger">*</span>
                              <input id="ProductName" type="text" value="{{ @$product->name }}" name="product[name]" class="form-control"
                                 placeholder="">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="group_id">Group Name</label><span class="text-danger">*</span>
                              <select required="" class="form-control" name="product[group_id]" id="group_id">
                                 <option value="">Select Group</option>
                                 @foreach(config('cms.group') as $key => $value)
                                 <option value="{{$key}}" @if(!empty($product->group_id) && $product->group_id == $key ) selected @endif>{{$value}}</option>
                                 @endforeach
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
                                 @foreach (category() as $index => $value)
                                 <option value="{{$index}}" {{ $index == @$category1 ? 'selected' :''}}
                                 >{{$value}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="Category">Primary Sub Category</label>
                              <select name="sub_category1" id="sub_category1" class="custom-select sub_category_1 form-control" data-placeholder="Select">
                                 <option value="">Primary Sub Category</option>
                                 @foreach (sub_categoryByCategoryID($category1) as $index => $value)
                                 <option value="{{$index}}" {{$index == $sub_category1 ? 'selected' :''}}
                                 >{{$value}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <!-- end category 1 -->
                     @if(empty($category2) || empty($category3))
                     <button type="button" class="btn btnAll mt-1" id="open_cat">Add more Categories</button>
                     @endif
                     <!-- start category 2 -->
                     <div id="open_category2"  class="{{ (!empty($category2) ) ? 'open' : 'hide' }}">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="Category">Second Category</label>
                                 <select name="category2" id="category2" data-no="2" class="custom-select get_sc form-control" data-placeholder="Select">
                                    <option value="">Second Category</option>
                                    @foreach (category() as $index => $value)
                                    <option value="{{$index}}" {{ $index == @$category2 ? 'selected' :''}}
                                    >{{$value}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="Category">Second Sub Category</label>
                                 <select name="sub_category2" id="sub_category2" class="custom-select sub_category_2 form-control" data-placeholder="Select">
                                    <option value="">Second Sub Category</option>
                                    @foreach (sub_categoryByCategoryID($category2) as $index => $value)
                                    <option value="{{$index}}" {{$index == $sub_category2 ? 'selected' :''}}
                                    >{{$value}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end category 2 -->
                    
                     <div id="open_category3" class="{{ (!empty($category3) ) ? 'open' : 'hide' }}">
                        <div class="row ">
                        <!-- <div class="col-md-6 pl-0 inputPaddingLeft"> -->
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="Category">Third Category</label>
                              <select name="category3" id="category3" data-no="3" class="custom-select get_sc form-control" data-placeholder="Select">
                                 <option value="">Third Category</option>
                                 @foreach (category() as $index => $value)
                                 <option value="{{$index}}" {{ $index == @$category3 ? 'selected' :''}}
                                 >{{$value}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="Category">Third Sub Category</label>
                              <select name="sub_category3" id="sub_category3" class="custom-select sub_category_3 form-control" data-placeholder="Select">
                                 <option value="">Third Sub Category</option>
                                 @foreach (sub_categoryByCategoryID($category3) as $index => $value)
                                 <option value="{{$index}}" {{$index == $sub_category3 ? 'selected' :''}}
                                 >{{$value}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     </div>
                  </div>
                  
                     <div class="col-md-12 pl-0 mt-4 inputPaddingLeft">
                        <div class="form-group mb-0">
                           <label for="Productdescription">Product description</label><span class="text-danger">*</span>
                           <textarea class="form-control" name="product[description]" rows="7" placeholder="">{{ strip_tags(@$product->description) }}</textarea>
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
                                 {{-- <input id="Brand" type="text" name="product[brand]" value="{{@$product->brand}}" class="form-control" placeholder=""> --}}

                                 {{--
                                    
                                    <!-- // shubham comment this code -->
                                    <!-- <input id="Brand" name="product[brand]" class="form-control" value="@if(!empty($product->brand_list->name)){{@$product->brand_list->name}}@else{{@$product->brand}}@endif">

                                    <input type="hidden"  id="product_brand_hidden_id" name="product[brand_hidden_id]" value="@if(!empty($product->brand_list->id)){{@$product->brand_list->id}}@endif"> -->
                                 --}}

                                 <select name="product[brand]" id="Brand" class="form-control input-sm select2-multiple-brand" multiple>
                                 @foreach($brand_list as $brand_lists)
                                 <option value="{{@$brand_lists->id}}" @if(@$product->brand == $brand_lists->id){{ 'selected' }}@endif>{{@$brand_lists->text}}</option>
                                 @endforeach
                                 </select>

                                 <?php /*<select class="form-control select-ajax py-3 w-100" data-select2-tags="true" name="product[brand]" id="product_brand_list_id">  
                                    @if(!empty($product->brand_list->name))
                                        @php
                                              $str_brandlist_value = @$product->brand_list->id;  
                                              $str_brandlist_text = @$product->brand_list->name;  
                                        @endphp
                                        @if(!empty($str_brandlist_value) && !empty($str_brandlist_text)) 
                                    <option value="{{$str_brandlist_value}}" selected>{{$str_brandlist_text}}</option>
                                    @endif
                                    @endif
                                    </select> */?>
                                 <!-- <input id="CompanyName" type="text" name="contact_info[company_name]"
                                    required="required" value="{{ @$user->inventorContactInfo->company_name }}"
                                    class="form-control" placeholder="">  --><!-- name="name"
                                    <div>
                                      <a href="javascript:void(0);" class="textBlack pl-0 fontTwelve" id="bt_product_brand_list_id">Remove Brand</a>
                                    </div> -->
                              </div>
                           </div>
                           <!--<div class="col-md-4">
                              <div class="form-group mb-0">
                              <label for="Company">Manufacturer</label><span class="text-danger"></span>
                              <input id="Company" type="text" name="product[company]" value="{{@$product->company}}" class="form-control" placeholder="">
                              </div>
                              </div> -->
                           <div class="col-md-4 pl-0 inputPaddingLeft">
                              <div class="form-group">
                                 <label for="CompanyName" class="w-100">Manufacturer</label></span>
                                 @php
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
                                 @endphp
                                 {{--
                                    <!-- // shubham comment this code -->
                                    <!-- <input id="Company" name="product[company]" class="form-control" value="{{@$str_company_user_name_new}}">
                                    
                                    <input type="hidden"  id="product_company_hidden_id" name="product[company_hidden_id]" value="{{@$int_company_user_id_new}}"> -->
                                    --}}

                                 <select name="product[company_hidden_id]" id="Company" class="form-control input-sm select2-multiple" multiple>
                                    @foreach($manufacture_list as $manufacture)
                                    <option value="{{@$manufacture->id}}" @if(@$int_company_user_id_new == $manufacture->id){{ 'selected' }}@endif>{{@$manufacture->text}}</option>
                                    @endforeach
                                 </select>
                                 
                                 <?php /*<select class="form-control select-ajax-company py-3" data-select2-tags="true" name="product[company]" id="Company">  
                                    @if(!empty($product->company))
                                        @php
                                          $value  = $product->company;  
                                          $text   = $product->company;  
                                          if($abc = \App\Models\User::find($product->company)){
                                              $value = $abc->id;  
                                              $text = $abc->first_name." ".$abc->last_name;  
                                          }
                                        @endphp
                                        @if(!empty($value) && !empty($text) && $value!='null' && $text!='null') 
                                    <option value="{{$value}}" selected>{{$text}}</option>
                                    @endif
                                    @endif
                                    </select> */?>
                                 <!-- <input id="CompanyName" type="text" name="contact_info[company_name]"
                                    required="required" value="{{ @$user->inventorContactInfo->company_name }}"
                                    class="form-control" placeholder="">  --><!-- name="name" -->
                                 <!-- <div>
                                    <a href="javascript:void(0);" class="textBlack pl-0 fontTwelve" id="bt_company_list_id">Remove Manufacturer</a>
                                    </div> -->
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group mb-0">
                                 <label for="Company">Launched Date</label><span class="text-danger"></span>
                                 <input id="launched_date" value="{{@$product->launched_date}}" type="date" class="form-control"  placeholder="Launched" name="product[launched_date]">
                              </div>
                              
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @php
            $str_chk_page_type_fun_fact_new = 'product'; 
            @endphp
            @include("front.user.include_add_fun_fact")
            <div class="col-md-12">
               <div class="row sectionBox">
                  <h3 class="sec_head_text w-100">Buy a copy</h3>
                  <div class="col-md-4 pl-0 inputPaddingLeft">
                     <div class="form-group">
                        <label for="email">Add Label 1</label>
                        <input type="text" name="buy_from[0][amazon_caption]" value="{{@$product->buyFrom->amazon_caption ? $product->buyFrom->amazon_caption : null}}" placeholder="Enter Label" class="form-control" >
                        <input  type="hidden" name="buy_from[0][type]" value="1" > 
                        <label class="mt-2">Add Website 1</label>
                        <input id="Amazoncom" type="url" name="buy_from[0][amazon]" value="{{@$product->buyFrom->amazon ? $product->buyFrom->amazon : null}}" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Add Label 2</label>
                        <input type="text" name="buy_from[0][ebay_caption]" value="{{@$product->buyFrom->ebay_caption ? $product->buyFrom->ebay_caption : null}}" placeholder="Enter Label" class="form-control">
                        <input  type="hidden" name="buy_from[0][type]" value="1">
                        <label class="mt-2">Add Website 2</label>
                        <input id="Amazoncom" type="url" name="buy_from[0][ebay]" value="{{@$product->buyFrom->ebay ? $product->buyFrom->ebay : null}}" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group mb-0">
                        <label>Add Label 3</label>
                        <input type="text" name="buy_from[0][pop_caption]" value="{{@$product->buyFrom->pop_caption ? $product->buyFrom->pop_caption : null}}" placeholder="Enter Label" class="form-control">
                        <input  type="hidden" name="buy_from[0][type]" value="1"> 
                        <label class="mt-2">Add Website 3</label>
                        <input id="Amazoncom" type="url" name="buy_from[0][pop]" value="{{@$product->buyFrom->pop ? $product->buyFrom->pop : null}}" class="form-control" placeholder="">
                     </div>
                  </div>
               </div>
            </div>
            @include("front.user.product.view_collaborator_list")
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
                  {{-- @foreach($product->officialLinks ?? [] as $link) --}}
                  <!-- <div  class="row add-row"> -->
                    
                  <div class="col-md-6 pl-0 inputPaddingLeft">
                     <div class="form-group">
                        <label for="Propose Offical Link">Link 1</label><span class="text-danger"></span>
                        <input type="url" id="ProposeOfficalLink" value="{{@$product->officialLinks[0]->value}}" name="official_links[]" placeholder="Link 1 here"
                           class="form-control">
                     </div>
                  </div>
                   <div class="col-md-6 pl-0 inputPaddingLeft">
                     <div class="form-group mb-0">
                        <label for="Propose Offical Link">Link 2</label><span class="text-danger"></span>
                        <input type="url" id="ProposeOfficalLink" value="{{@$product->officialLinks[1]->value}}" name="official_links[]" placeholder="Link 2 here"
                           class="form-control">
                     </div>
                  </div>
              
                  <!--<div class="col-md-2" >
                     <label for="Propose Offical Link" style="visibility:hidden;">Add more</label> 
                     <button type="button" class="btn btnAll remove-link" style="margin-top: 18px;">- Remove</button>
                     </div>-->
                  <!-- </div> -->
                  {{-- @endforeach --}}
                  <!-- </span> -->
               </div>
            </div>
            <div class="col-md-12">
               <div id="Five_Product" class="row sectionBox">
                  <h3 class="sec_head_text w-100">Social Media</h3>
            @foreach(config('cms.social_media') as $index => $social)
            @if (in_array($social, config('cms.social_media_now'))) 
                @if($loop->index > 8)
                     <div class="col-md-3 Login-Style rounded w-12 pl-0 inputPaddingLeft">
                         <div class="form-group formMarginBotZero">
                             <label for="{{ $social }}">{{ $social }}</label>
                             <input type="url" id="{{ $social }}" name="socials[{{$index}}]"
                              value="{{isset($product) && count($product->socialMedia) > 0 ? @$product->socialMedia->pluck('value','type')->toArray()[$index] : ''}}"
                                class="form-control social">
                         </div>
                     </div>
                     @elseif($loop->index > 8 && $loop->index < 16) 
                     <div class="col-md-3 Login-Style rounded w-12 pl-0 inputPaddingLeft">
                         <div class="form-group formMarginBotZero">
                             <label for="{{ $social }}">{{ $social }}</label>
                             <input type="url" id="{{ $social }}" name="socials[{{$index}}]"
                                 value="{{isset($product) && count($product->socialMedia) > 0 ?  @$product->socialMedia->pluck('value','type')->toArray()[$index] : ''}}"
                                class="form-control social">
                         </div>
                     </div>
                     @else
                     <div class="col-md-3 Login-Style rounded w-12 pl-0 inputPaddingLeft">
                         <div class="form-group formMarginBotZero">
                             <label for="{{ $social }}">{{ $social }}</label>
                             <input type="url" id="{{ $social }}" name="socials[{{$index}}]"
                                 value="{{isset($product) && count($product->socialMedia) > 0 ?   @$product->socialMedia->pluck('value','type')->toArray()[$index] : ''}}"
                                class="form-control social">
                         </div>
                     </div>
               @endif
            @endif
         @endforeach
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
                     <textarea class="form-control" rows="5" name="other[in_depth_review]" id="Review" placeholder="">{{@$product->other->in_depth_review}}</textarea>
                   </div>
                 </div>
               </div> -->
            {{-- 
            <h3 class="Tile-style social my-0">Related Product</h3>
            <div id="Eight_Product" class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="Product Images">Product Images</label>
                     <input type="file" class="Product Images" multiple="" />
                     <!--<button class="fileuploadervedio-btn">Select a Video File</button>-->
                     <br>
                  </div>
               </div>
            </div>
            --}}
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
            {{--  
            <div class="col-md-12">
               <div id="Thirteen_Product" class="row sectionBox">
                  <h3 class="sec_head_text w-100">Collection Stats</h3>
                  <div class="col-md-4 Login-Style rounded pl-0 inputPaddingLeft">
                     <div class="form-group">
                        <label for="Own">Own</label>
                        <input id="Own" type="text" name="stats[own]" value="{{@$product->statics->own}}" class="form-control" placeholder="">
                     </div>
                     <div class="form-group">
                        <label for="Previously Owned">Previously Owned</label>
                        <input id="PreviouslyOwned" type="text" name="stats[previously_owned]" value="{{@$product->statics->previously_owned}}"
                           class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-md-4 Login-Style rounded">
                     <div class="form-group">
                        <label for="For Trade">For Trade</label>
                        <input id="ForTrade" type="text" name="stats[for_trade]" value="{{@$product->statics->for_trade}}" class="form-control"
                           placeholder="">
                     </div>
                     <div class="form-group">
                        <label for="Want In Trade">Want In Trade</label>
                        <input id="Want In Trade" type="text" name="stats[want_it_trade]" value="{{@$product->statics->want_it_trade}}" class="form-control"
                           placeholder="">
                     </div>
                  </div>
                  <div class="col-md-4 Login-Style rounded">
                     <div class="form-group mb-0">
                        <label for="Wishlist">Wishlist</label>
                        <input id="Wishlist" type="text" name="stats[wishlist]" value="{{@$product->statics->wishlist}}" class="form-control"
                           placeholder="">
                     </div>
                  </div>
               </div>
            </div>
            --}}
            <div class="col-md-12">
               <div class="row sectionBox">
                  <button type="button" class="btn btnAll productSubmitButton">Submit <i class="fa fa-spinner fa-spin str_laoder" style="display: none;"></i></button>
                  <span class="ml-3 mt-3"><input type="checkbox" name="feed_check" value="on"> &nbsp;Share to feed. </span>
               </div>
            </div>
         </div>
      </form>
      @include("front.user.product.add_edit_collaborator_popup")
   </div>
</div>
</div>

<div class="modal" id="productEditModalModal">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
      </div>
   </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
   
   jQuery(document).on("change", ".get_sc" , function() {
     var id = $(this).val();
     var no = $(this).data('no');
     $.ajax({
        type:'GET',
        url:"{{ url('/user/product/get_sub_category') }}",
        data:{
             "_token": "{{ csrf_token() }}",
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
        url:"{{ url('/user/product/get_category_BYGroup') }}",
        data:{
             "_token": "{{ csrf_token() }}",
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
         url:"{{ url('/user/product/collaborator/edit_modal/') }}/"+collaborator_id,
         data:{
              "_token": "{{ csrf_token() }}",
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
          url:"{{ url('/user/product/collaborator/delete/') }}/"+collaborator_id,
          data:{
               "_token": "{{ csrf_token() }}",
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
   //         url: "{{ route('front.user.product.collaborator.AddEdit') }}",
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
   //             // if ('{{@$slug}}' != '' ) 
   //             // {
   //             //     window.location.replace("{{route('front.user.product.update',@$slug ?? null)}}");
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
         url: "{{ route('front.user.product.collaborator.AddEdit') }}",
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
               url: "{{ route('front.user.product.create') }}",
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
                   window.location.replace('{{ route("front.user.product.index")}}');
   
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
                     url: '{{route("front.user.getBrandList")}}',
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
                     url: '{{route("front.user.getAgent")}}',
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
 @include("front.profile.edit_profile_dob_js") 
@endsection