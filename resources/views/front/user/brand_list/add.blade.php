@extends('front.layouts.pages')
@section('content')
<?php
   if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('category_id')[0]) ){
       $category1 = $brand_list->categories->pluck('category_id')[0];
   } else {
       $category1 = 0;
   }
   
   if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('category_id')[1]) ){
       $category2 = $brand_list->categories->pluck('category_id')[1];
   } else {
       $category2 = 0;
   }
   
   if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('category_id')[2]) ){
       $category3 = $brand_list->categories->pluck('category_id')[2];
   } else {
       $category3 = 0;
   }
   
   if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('sub_category_id')[0]) ){
       $sub_category1 = $brand_list->categories->pluck('sub_category_id')[0];
   } else {
       $sub_category1 = 0;
   }
   
   if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('sub_category_id')[1]) ){
       $sub_category2 = $brand_list->categories->pluck('sub_category_id')[1];
   } else {
       $sub_category2 = 0;
   }
   
   if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('sub_category_id')[2]) ){
       $sub_category3 = $brand_list->categories->pluck('sub_category_id')[2];
   } else {
       $sub_category3 = 0;
   }
   ?>
<style type="text/css">
   .hide { display: none; }
   .open { display: block; }

    .cropper-crop-box, .cropper-view-box {
    border-radius: 50%;
  }

  .cropper-view-box {
    box-shadow: 0 0 0 1px #39f;
    outline: 0;
  }

  .cropper-container.cropper-bg {
    width: 100% !important;
  }
</style>
<!-- borderlineadd -->
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
   <div class="left-column border_right">
      <form id="brandForm" class="kpro_form kform_control">
         <input type="hidden" name="brand_list_id" value="{{@$brand_list->id}}">
         @csrf
         <div class="First-column">
            <div class="col-md-12">
               <div id="FirstRow_Product" class="row sectionTop">
                  <div class="col-md-4 imgProfilePadding marginBottomTwenty lessMargin">
                     <?php //if(@$brand_list->main_image)
                        //{
                          ?>
                     <img id="blah" src="{{@imageBasePath(@$brand_list->main_image)}}" class="kfile_imageten img-fluid imgtwoeighty">
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
                        <input id="file-uploadten1" type="file" onchange="readBrandURL(this);" class="custom-file-input1 imageBrand" name="main_image" accept="image/*" />
                        <input type="hidden" name="crop_img" id="crop_img" value="">
                     </div>
                     <div class="ProfileUploadBtn  text-left">
                        <small class="text-danger ">Note: Please upload image up to 2MB only</small>
                     </div>
                  </div>
                  <div class="col-md-8 colmargin">
                     <div class="row">
                        <div class="col-md-6" style="display: none;">
                           <div class="form-group">
                              <label for="BrandID">Brand ID</label><span class="text-danger">*</span>
                              <input id="BrandID" type="text" class="form-control"
                                 readonly name="brand_list[brand_list_id_number]" value="{{$brand_list->brand_list_id_number ?? generateRandomString()}}"
                                 placeholder="">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="BrandName">Brand Name</label><span class="text-danger">*</span>
                              <input id="BrandName" type="text" value="{{ @$brand_list->name }}" name="brand_list[name]" class="form-control"
                                 placeholder="">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="group_id">Group Name</label><span class="text-danger">*</span>
                              <select required="" class="form-control" name="brand_list[group_id]" id="group_id">
                                 <option value="">Select Group</option>
                                 @foreach(config('cms.group') as $key => $value)
                                 <option value="{{$key}}" @if(!empty($brand_list->group_id) && $brand_list->group_id == $key ) selected @endif>{{$value}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <!-- start category 1 -->
                     <div class="row">
                        <div class="col-md-12">
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
                     </div>
                     <!-- end category 1 -->
                     @if(empty($category2) || empty($category3))
                     <button type="button" class="btn btnAll mt-1" id="open_cat">Add more Categories</button>
                     @endif
                     <!-- start category 2 -->
                     <div id="open_category2"  class="{{ (!empty($category2) ) ? 'open' : 'hide' }}">
                        <div class="row">
                           <div class="col-md-12">
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
                        </div>
                     </div>
                     <!-- end category 2 -->
                     <div id="open_category3" class="{{ (!empty($category3) ) ? 'open' : 'hide' }}">
                      <div class="row">
                        <div class="col-md-12">
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
                      </div>
                     </div>
                  </div>
                  
                     <div class="col-md-12 mt-4 pl-0 inputPaddingLeft">
                        <div class="form-group mb-0">
                           <label for="">Brand description</label><span class="text-danger">*</span>
                           <textarea class="form-control textBoi" name="brand_list[description]" rows="7"  placeholder="">{{@$brand_list->description}}</textarea>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="row sectionBox1">
                           <h3 class="sec_head_text w-100">
                              <!-- Product Metadata--> 
                           </h3>
                           <div class="col-md-4">
                              <div class="form-group mb-0">
                                 <label for="Company">Manufacturer</label><span class="text-danger"></span>
                                 <input id="Company" type="text" name="brand_list[company]" value="{{@$brand_list->company}}" class="form-control" placeholder="">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group mb-0">
                                 <label for="Company">Launched Date</label><span class="text-danger"></span>
                                 <input id="launched_date" value="{{@$brand_list->launched_date}}" type="date" class="form-control" placeholder="Launched" name="brand_list[launched_date]">
                              </div>
                           </div>
                        </div>
                     </div>
                  
               </div>
            </div>
            <div class="col-md-12">
               <div class="row sectionBox">
                  <h3 class="sec_head_text w-100">Fun Facts</h3>
                  <div class="col-md-4 pl-0 inputPaddingLeft">
                     <div class="form-group">
                        <label for="fun_fact1">Fun Fact 1</label></span>
                        <input id="fun_fact1" type="text" name="brand_list[fun_fact1]" value="{{ @$brand_list->fun_fact1 }}"
                           class="form-control">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="fun_fact2">Fun Fact 2 </label></span>
                        <input id="fun_fact2" type="text" value="{{ @$brand_list->fun_fact2 }}"
                           name="brand_list[fun_fact2]" required="required" class="form-control" placeholder=""> <!-- name="EmailID" -->
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="fun_fact3">Fun Fact 3</label></span>
                        <input id="fun_fact3" type="text"  class="form-control" value="{{ @$brand_list->fun_fact3 }}" name="brand_list[fun_fact3]" required="required" placeholder=""> <!-- name="EmailID" -->
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12">
               <div class="row sectionBox">
                  <h3 class="sec_head_text w-100">Buy a copy</h3>
                  <div class="col-md-4 pl-0 inputPaddingLeft">
                     <div class="form-group">
                        <label for="email">Add Label 1</label>
                        <input type="text" name="buy_from[0][amazon_caption]" value="{{@$brand_list->buyFrom->amazon_caption ? $brand_list->buyFrom->amazon_caption : null}}" placeholder="Enter Label" class="form-control" >
                        <input  type="hidden" name="buy_from[0][type]" value="1" > 
                        <label class="mt-2">Add Website 1</label>
                        <input id="Amazoncom" type="url" name="buy_from[0][amazon]" value="{{@$brand_list->buyFrom->amazon ? $brand_list->buyFrom->amazon : null}}" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Add Label 2</label>
                        <input type="text" name="buy_from[0][ebay_caption]" value="{{@$brand_list->buyFrom->ebay_caption ? $brand_list->buyFrom->ebay_caption : null}}" placeholder="Enter Label" class="form-control">
                        <input  type="hidden" name="buy_from[0][type]" value="1">
                        <label class="mt-2">Add Website 2</label>
                        <input id="Amazoncom" type="url" name="buy_from[0][ebay]" value="{{@$brand_list->buyFrom->ebay ? $brand_list->buyFrom->ebay : null}}" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group mb-0">
                        <label>Add Label 3</label>
                        <input type="text" name="buy_from[0][pop_caption]" value="{{@$brand_list->buyFrom->pop_caption ? $brand_list->buyFrom->pop_caption : null}}" placeholder="Enter Label" class="form-control">
                        <input  type="hidden" name="buy_from[0][type]" value="1"> 
                        <label class="mt-2">Add Website 3</label>
                        <input id="Amazoncom" type="url" name="buy_from[0][pop]" value="{{@$brand_list->buyFrom->pop ? $brand_list->buyFrom->pop : null}}" class="form-control" placeholder="">
                     </div>
                  </div>
               </div>
            </div>
            <?php /*
               @include("front.user.brand_list.view_collaborator_list")
               
               <div class="col-md-12">
               <div id="Five_Product" class="row sectionBox">
                 <h3 class="sec_head_text w-100">Classification</h3>
                 <div class="col-md-4 pl-0 inputPaddingLeft">
                   <div class="form-group">
                     <label for="Delivery Mechanism">Delivery Mechanism</label>
                     <select name="classification[delivery_mechanism]" class="custom-select">
                       <option >Select</option>
                       @foreach (config('cms.delivery_mechanism') as $index => $value)
                       <option value="{{$index}}" {{@$brand_list->classification->delivery_mechanism == $index ? 'selected' : ''}}>{{$value}}</option>
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
                       <option value="{{$index}}" {{@$brand_list->classification->toy_type == $index ? 'selected' : ''}}>{{$value}}</option>
                       @endforeach
                     </select>
                   </div>
                 </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="Launched">Launched</label>
                       <input id="Launched" type="number" name="classification[launched]"
                       value="{{@$brand_list->classification->launched }}"
                       class="form-control" placeholder="">
                     </div>
                   </div>
                 <!-- </div>
                 <div class="row"> -->
                   
                   {{-- <div class="col-md-4 pl-0 inputPaddingLeft">
                     <div class="form-group">
                     <label for="Inventor">Inventor</label><span class="text-danger">*</span>
                     <input id="Inventor" type="text" name="classification[inventor]"
                     value="{{@$brand_list->classification->inventor }}"
                      class="form-control" placeholder="">
                     </div>
                   </div> --}}
               
                   <div class="col-md-4 pl-0 inputPaddingLeft">
                     <div class="form-group mb-0">
                       <label for="Team">Team</label><span class="text-danger"></span>
                       <input id="Team" type="text" name="classification[team]" value="{{@$brand_list->classification->team }}" class="form-control" placeholder="">
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
                  {{-- @foreach($brand_list->officialLinks ?? [] as $link) --}}
                  <!-- <div  class="row add-row"> -->
                  <div class="col-md-6 pl-0 inputPaddingLeft">
                     <div class="form-group">
                        <label for="Propose Offical Link">Link 1</label><span class="text-danger"></span>
                        <input type="url" id="ProposeOfficalLink" value="{{@$brand_list->officialLinks[0]->value}}" name="official_links[]" placeholder="Link 1 here"
                           class="form-control">
                     </div>
                    
                  </div>
                  <div class="col-md-6 pl-0 inputPaddingLeft">
                     <div class="form-group mb-0">
                        <label for="Propose Offical Link">Link 2</label><span class="text-danger"></span>
                        <input type="url" id="ProposeOfficalLink" value="{{@$brand_list->officialLinks[1]->value}}" name="official_links[]" placeholder="Link 2 here"
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
                           value="{{isset($brand_list) && count($brand_list->socialMedia) > 0 ? @$brand_list->socialMedia->pluck('value','type')->toArray()[$index] : ''}}"
                             class="form-control social">
                      </div>
                  </div>
                  @elseif($loop->index > 8 && $loop->index < 16) 
                  <div class="col-md-3 Login-Style rounded w-12 pl-0 inputPaddingLeft">
                      <div class="form-group formMarginBotZero">
                          <label for="{{ $social }}">{{ $social }}</label>
                          <input type="url" id="{{ $social }}" name="socials[{{$index}}]"
                              value="{{isset($brand_list) && count($brand_list->socialMedia) > 0 ?  @$brand_list->socialMedia->pluck('value','type')->toArray()[$index] : ''}}"
                             class="form-control social">
                      </div>
                  </div>
                  @else
                  <div class="col-md-3 Login-Style rounded w-12 pl-0 inputPaddingLeft">
                      <div class="form-group formMarginBotZero">
                          <label for="{{ $social }}">{{ $social }}</label>
                          <input type="url" id="{{ $social }}" name="socials[{{$index}}]"
                              value="{{isset($brand_list) && count($brand_list->socialMedia) > 0 ?   @$brand_list->socialMedia->pluck('value','type')->toArray()[$index] : ''}}"
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
                     <textarea class="form-control" rows="5" name="other[in_depth_review]" id="Review" placeholder="">{{@$brand_list->other->in_depth_review}}</textarea>
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
                                   class="form-control" name="stats[rating]" value="{{@$brand_list->statics->rating}}">
                           </div>
                           <div class="form-group">
                               <label for="Number of Ratings">Number of Ratings</label>
                               <input id="NumberofRatings" type="number" name="stats[number_of_ratings]" value="{{@$brand_list->statics->number_of_ratings}}"
                                   class="form-control" placeholder="">
                           </div>
                       </div>
                       <div class="col-md-4 Login-Style rounded">
                           <div class="form-group">
                               <label for="Standard Deviation">Standard Deviation</label>
                               <input id="StandardDeviation" type="text" name="stats[standard_deviation]" value="{{@$brand_list->statics->standard_deviation}}"
                                   class="form-control" placeholder="">
                           </div>
                           <div class="form-group">
                               <label for="Comments">Comments</label>
                               <textarea class="form-control" rows="1" id="Comments" name="stats[comments]" >{{@$brand_list->statics->comments}}</textarea>
                           </div>
                       </div>
                       <div class="col-md-4 Login-Style rounded">
                           <div class="form-group">
                               <label for="Fans">Fans</label>
                               <input id="Fans" type="text" name="stats[fans]" value="{{@$brand_list->statics->fans}}" class="form-control" placeholder="">
                           </div>
                           <div class="form-group">
                               <label for="Page Views">Page Views</label>
                               <input id="PageViews" type="text" name="stats[page_views]" value="{{@$brand_list->statics->page_views}}" class="form-control"
                                   placeholder="">
                           </div>
                       </div>
                   <!-- </div>
                   <div id="Twelve_Product" class="row"> -->
                       <div class="col-md-4 Login-Style rounded pl-0 inputPaddingLeft">
                           <h3 class="sec_head_Innertext w-100">Play Ranks</h3>
                           <div class="form-group">
                               <label for="Overall Rank">Overall Rank</label>
                               <input id="OverallRank" type="number" name="stats[overall_rank]" value="{{@$brand_list->statics->overall_rank}}" class="form-control"
                                   placeholder="">
                           </div>
                           <div class="form-group">
                               <label for="Party Rank">Party Rank</label>
                               <input id="PartyRank" type="number" name="stats[party_rank]" value="{{@$brand_list->statics->party_rank}}" class="form-control"
                                   placeholder="">
                           </div>
                       </div>
                       <div class="col-md-4 Login-Style rounded pl-0 inputPaddingLeft">
                           <h3 class="sec_head_Innertext w-100">Play Stats</h3>
                           <div class="form-group">
                               <label for="All Time Plays">All Time Plays</label>
                               <input id="AllTimePlays" type="number" name="stats[all_time_plays]" value="{{@$brand_list->statics->all_time_plays}}"
                                   class="form-control" placeholder="">
                           </div>
                           <div class="form-group">
                               <label for="This month">This month</label>
                               <input id="Thismonth" type="number" name="stats[this_month]" value="{{@$brand_list->statics->this_month}}" class="form-control"
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
                                   <option value="{{$value}}" {{@$brand_list->statics->has_part == $value ? 'selected' : ''}}>{{$value}}</option>
                                   @endforeach
                               </select>
                           </div>
                           <div class="form-group mb-0">
                               <label for="Wants Parts">Wants Parts</label>
                               <select name="stats[wants_part]"  class="custom-select">
                                   <option >Select</option>
                                   @foreach(config('cms.other_action') as $key => $value)
                                   <option value="{{$value}}" {{@$brand_list->statics->wants_part == $value ? 'selected' : ''}}>{{$value}}</option>
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
                        <input id="Own" type="text" name="stats[own]" value="{{@$brand_list->statics->own}}" class="form-control" placeholder="">
                     </div>
                     <div class="form-group">
                        <label for="Previously Owned">Previously Owned</label>
                        <input id="PreviouslyOwned" type="text" name="stats[previously_owned]" value="{{@$brand_list->statics->previously_owned}}"
                           class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-md-4 Login-Style rounded">
                     <div class="form-group">
                        <label for="For Trade">For Trade</label>
                        <input id="ForTrade" type="text" name="stats[for_trade]" value="{{@$brand_list->statics->for_trade}}" class="form-control"
                           placeholder="">
                     </div>
                     <div class="form-group">
                        <label for="Want In Trade">Want In Trade</label>
                        <input id="Want In Trade" type="text" name="stats[want_it_trade]" value="{{@$brand_list->statics->want_it_trade}}" class="form-control"
                           placeholder="">
                     </div>
                  </div>
                  <div class="col-md-4 Login-Style rounded">
                     <div class="form-group mb-0">
                        <label for="Wishlist">Wishlist</label>
                        <input id="Wishlist" type="text" name="stats[wishlist]" value="{{@$brand_list->statics->wishlist}}" class="form-control"
                           placeholder="">
                     </div>
                  </div>
               </div>
            </div>
            --}}
            <div class="col-md-12">
               <div class="row sectionBox">
                  <button type="button" class="btn btnAll brandSubmitButton">Submit <i class="fa fa-spinner fa-spin str_laoder" style="display: none;"></i></button>
               </div>
            </div>
         </div>
      </form>
      @include("front.user.brand_list.add_edit_collaborator_popup")
   </div>
   @include("front.includes.cropper_model")
</div>
@endsection
@section('scripts')


<script>
   var bs_modal = $('#modal');
   var image = document.getElementById('blah');
   var cropper,reader,file;
   
   function readBrandURL(e) {
   
     var bs_modal = $('#modal');
     var image = document.getElementById('image');
     var cropper,reader,file;
     
     $("body").on("change", ".imageBrand", function(e) {
      var files = e.target.files;
    var done = function(url) {
      image.src = url;
      bs_modal.modal('show');
    };


    if (files && files.length > 0) {
      file = files[0];

      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function(e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
  });
   
    bs_modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
      aspectRatio: 1,
            //viewMode: 3,
            crop(event) {
              console.log(event.detail.x);
              console.log(event.detail.y);
              console.log(event.detail.width);
              console.log(event.detail.height);
              console.log(event.detail.rotate);
              console.log(event.detail.scaleX);
              console.log(event.detail.scaleY);
            },
            preview: '.preview'
          });
  }).on('hidden.bs.modal', function() {
    cropper.destroy();
    cropper = null;
  });
   
     $("#crop").click(function() {
      $('.crop_laoder').show();
       canvas = cropper.getCroppedCanvas({
         width: 800,
         height: 300,
       });
   
       canvas.toBlob(function(blob) {
         url = URL.createObjectURL(blob);
         var reader = new FileReader();
         reader.readAsDataURL(blob);
         reader.onloadend = function() {
           var base64data = reader.result;
   
           $.ajax({
             type: "POST",
             dataType: "json",
             url: "{{ route('front.user.brand.upload') }}",
             data: {'_token':'{{ csrf_token() }}', 'image': base64data},
             success: function(data) {
                $('.crop_laoder').hide();
               bs_modal.modal('hide');
               $('#blah').attr('src',base64data);
               $('#crop_img').val(data.crop_img);
             }
           });
         };
       });
     });
   }
</script>

<script type="text/javascript">
   frontend_show_standard_ckeditor_new('Branddescription');
   
   
</script>
<script type="text/javascript">
   jQuery(document).on("change", "#group_id" , function() {
     var id = $(this).val();
     var no = $(this).data('no');
     $.ajax({
        type:'GET',
        url:"{{ url('/user/brand/get_category_BYGroup') }}",
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
          url:"{{ url('/user/brand/collaborator/delete/') }}/"+collaborator_id,
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
   $(document).on('click', '.AddEditCollabModalSave', function (e) {
       e.preventDefault();
       var fd = new FormData($('#AddEditCollabModalForm')[0]);
       var collaboration_id = $("#collaboration_id").val();
       console.log(collaboration_id);
       console.log(fd);
       $.ajax({
           url: "{{ route('front.user.brand.collaborator.AddEdit') }}",
           data: fd,
           processData: false,
           contentType: false,
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
               $('.AddEditCollabModalSave').attr('disabled', false);
               $("#AddEditCollabModalForm").trigger("reset");
               $("#blah2").attr("src",'');
               $('#myModal').modal('hide');
               // if ('{{@$slug}}' != '' ) 
               // {
               //     window.location.replace("{{route('front.user.product.update',@$slug ?? null)}}");
               // }
               if(collaboration_id !=''){
                   console.log(data.html);
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
   
       $(document).on('click', '.brandSubmitButton', function (e) {

           e.preventDefault();
           var fd = new FormData($('#brandForm')[0]);
          // var ckeditor_description_new = frontend_get_ckeditor_description_new('Branddescription');
           //fd.append('brand_list[description]', ckeditor_description_new);
           $.ajax({
               url: "{{ route('front.user.brand.create') }}",
               data: fd,
               processData: false,
               contentType: false,
               dataType: 'json',
               type: 'POST',
               beforeSend: function () {
                   $('.brandSubmitButton').attr('disabled', true);
                    $('.str_laoder').show();
                   // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
               },
               error: function (jqXHR, exception) {
                   $('.brandSubmitButton').attr('disabled', false);
                     $('.str_laoder').hide();
                   var msg = formatErrorMessage(jqXHR, exception);
                   toastr.error(msg)
                   // console.log(msg);
                   // $('.message_box').html(msg).removeClass('hide');
               },
               success: function (data) {
                   $('.brandSubmitButton').attr('disabled', false);
                   // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                   $('.str_laoder').hide();
                   toastr.success(data.message)
                   $('#brandForm').trigger('reset')
                   window.location.replace('{{ route("front.user.brand.index")}}');
   
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
   
  </script>
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
</script>
@endsection