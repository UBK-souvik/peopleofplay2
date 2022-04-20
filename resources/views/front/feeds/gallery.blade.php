<?php $gallery_type = 1;  ?>
<form id="feedForm" method="POST" class="kform_control">
                     <div class="wrapalldiv">
                        <div class="row">
                           <div class="col-12">
                           @if($gallery_type == 1)
                              <div class="form-group">
                                 <!-- <label for="product-tag-id">Destination</label><span class="text-danger">*</span> -->
                               
                                    <select onchange="return showProdEventDropDownByDest('{{ $str_modal_form_div_id }}', this.value);"  name="gallery_meta[destination_id]" class="form-control" data-placeholder="Select">
                                       <span class="text-danger">*</span>
                                       <option value="">Type of Post</option>
                                     </select>
                                 </div>
                              
                              @endif
                              </div>
                            
                       

                             <div class="col-md-6">
                              @if($gallery_type == 1)
                              <div class="form-group text-center">
                                 <div id="file-upload-formsecond" class="uploadersecond">
                                    <div for="file-uploadsecond" id="file-dragsecond" class="galleryperview">
                                       <div id="div-image-gallery-preview-id">                
                                          <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-one" src="{{@galleryImageBasePath(@$str_media_data)}}"  alt="">
                                       </div>
                                    </div>
                                 </div>
                                 <!-- <div class="text-left mt-1">
                                       <small class="text-danger ">Note: Please upload image up to {{App\Helpers\UtilitiesTwo::get_max_upload_image_size()}} only</small>
                                 </div> -->
                                 @if($gallery_type == 1)
                                 <div class="form-group">
                                    <div class="div-image-upload-gallery-class">
                                       <!-- <input type="file" id="file-gallery-uploadsecond-new" name="photo" onchange="return getImagePreview('{{ $str_modal_form_div_id }}', this);" class="custom-file-input1"  accept="image/*" /> -->
                                       <div class="custom-file">
                                          <input type="file" class="custom-file__input" id="file-gallery-uploadsecond-new" name="photo" onchange="return getImagePreview('{{ $str_modal_form_div_id }}', this);" accept="image/*" >
                                          <label class="custom-file__label" for="file-gallery-uploadsecond-new">Upload Image</label>
                                       </div>
                                       <!-- <div class="custom-file">
                                          <input type="file" class="custom-file__input" id="field-upload" name="upload">
                                          <label class="custom-file__label" for="field-upload">Upload Image</label>
                                       </div> -->
                                    </div>
                                    
                                 </div>
                                 @endif
                              </div>
                              @endif
                           </div>
                           <div class="col-md-6">
                           @if($gallery_type == 1)
                              <div class="form-group">
                                 <input id="Title" type="text" name="gallery_meta[title]" class="form-control" placeholder="Title" value="@if(!empty($str_title)) {{ $str_title }} @endif">
                              </div>
                              <div class="form-group">
                                 <!-- <input type="text" class="form-control" id="Caption" placeholder="Caption" value="@if(!empty($str_caption)){{$str_caption}}@endif" name="gallery_meta[caption]"> -->
                                 <textarea class="form-control" rows="10" id="Caption" placeholder="Caption" value="@if(!empty($str_caption)){{$str_caption}}@endif" name="gallery_meta[caption]"></textarea>
                                 <!-- <textarea class="form-control" rows="10" id="comment" placeholder="Caption"></textarea> -->
                              </div>
                              @endif
                             
                              
                              <!--  @if($gallery_type == 1)
                                 <div class="form-group">
                                   <div class="div-image-upload-gallery-class">
                                     <input type="file" id="file-gallery-uploadsecond-new" name="photo" onchange="return getImagePreview('{{ $str_modal_form_div_id }}', this);" class="custom-file-input1"  accept="image/*" />
                                    
                                 </div>
                                 <small class="text-danger ">Note: Please upload image up to {{App\Helpers\UtilitiesTwo::get_max_upload_image_size()}} only</small>
                                 </div>
                                    @endif -->
                           </div>
                        </div>
                        @if($gallery_type == 2)
                        <div class="row">
                           <div class="col-12">
                           <div class="form-group">
                                 <label for="product-tag-id">Destination</label> <span class="text-danger">*</span>
                                 <div>
                                    <select onchange="return showProdEventDropDownByDest('{{ $str_modal_form_div_id }}', this.value);"  name="gallery_meta[destination_id]" class="form-control" data-placeholder="Select">
                                       <option value="">Select Destination</option>
                                       @foreach ($arr_destinations_list as $arr_destinations_list_key => $arr_destinations_list_val)
                                       <option @if (!empty($int_destination_id) && ($int_destination_id == $arr_destinations_list_key)){{ 'selected' }}  @endif  value="{{$arr_destinations_list_key}}">
                                       {{ $arr_destinations_list_val }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                           <div id="file-upload-formsecond" class="uploadersecond">
                                    <div for="file-uploadsecond" id="file-dragsecond" class="galleryperview">
                                       <div id="div-image-gallery-preview-id">                
                                          <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-one" src="{{@galleryImageBasePath(@$str_media_data)}}"  alt="">
                                       </div>
                                    </div>
                                 </div>
                              <div class="form-group">
                                 <input id="VideoUrl" type="text" name="gallery_meta[video_url]" class="form-control" value="@if(!empty($str_media_data)) {{ $str_media_data }} @endif" placeholder="Video URL">
                              </div>
                           </div>
                           <div class="col-md-6">
                           <div class="form-group">
                        <input id="Title" type="text" name="gallery_meta[title]" class="form-control" placeholder="Title" value="@if(!empty($str_title)) {{ $str_title }} @endif">
                     </div>
                           <div class="form-group">
                                 <!-- <input type="text" class="form-control" id="Caption" placeholder="Caption" value="@if(!empty($str_caption)){{$str_caption}}@endif" name="gallery_meta[caption]"> -->
                                 <textarea class="form-control" rows="9" id="Caption" placeholder="Caption" value="@if(!empty($str_caption)){{$str_caption}}@endif" name="gallery_meta[caption]"></textarea>
                                 <!-- <textarea class="form-control" rows="10" id="comment" placeholder="Caption"></textarea> -->
                              </div>
                           </div>
                        </div>
                        @endif
                        <div class="row">
                           <div class="col-md-6 assign-prod-event-drop-down-class" @if(!empty($int_assign_product_id)) {{ "style=display:block;" }} @else {{ "style=display:none;" }} @endif id="assign-gallery-event-product-div{{ $arr_destinations_list_keys[1] }}">
                           <div class="form-group">
                              <label for="product-tag-id">Assign to Product</label> <span class="text-danger">*</span>
                              <select name="gallery_meta[assign_product_id]" class="form-control" data-placeholder="Select">
                                 <option value="">Select Product</option>
                                 @foreach ($user_product_data as $user_product_row)
                                 <option @if (!empty($int_assign_product_id) && ($int_assign_product_id == $user_product_row->id)){{ 'selected' }}  @endif  value="{{$user_product_row->id}}">
                                 {{ $user_product_row->name }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6 assign-prod-event-drop-down-class" @if(!empty($int_assign_brand_id)) {{ "style=display:block;" }} @else {{ "style=display:none;" }} @endif id="assign-gallery-event-product-div{{ $arr_destinations_list_keys[3] }}">
                        <div class="form-group">
                           <label for="brand-tag-id">Assign to Brand</label> <span class="text-danger">*</span>
                           <select name="gallery_meta[assign_brand_id]" class="form-control" data-placeholder="Select">
                              <option value="">Select Brand</option>
                              @foreach ($user_brand_data as $user_brand_row)
                              <option @if (!empty($int_assign_brand_id) && ($int_assign_brand_id == $user_brand_row->id)){{ 'selected' }}  @endif  value="{{$user_brand_row->id}}">
                              {{ $user_brand_row->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6 assign-prod-event-drop-down-class" @if(!empty($int_assign_event_id)) {{ "style=display:block;" }} @else {{ "style=display:none;" }} @endif  id="assign-gallery-event-product-div{{ $arr_destinations_list_keys[2] }}">
                     <div class="form-group">
                        <label for="product-tag-id">Assign to Event</label>
                        <select name="gallery_meta[assign_event_id]" class="form-control" data-placeholder="Select">
                           <option value="">Select Event</option>
                           @foreach ($user_event_data as $user_event_row)
                           <option @if (!empty($int_assign_event_id) && ($int_assign_event_id == $user_event_row->id)){{ 'selected' }}  @endif  value="{{$user_event_row->id}}">
                           {{ $user_event_row->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               <!-- @if($gallery_type == 2)
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="VideoUrl">Video Url</label>
                            <input id="VideoUrl" type="text" name="gallery_meta[video_url]" class="form-control" value="@if(!empty($str_media_data)) {{ $str_media_data }} @endif" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                  
                    </div>
                  </div>
                  
                  @endif -->
               <!-- <label for="Category" class="bg-default text-uppercase">
               About This  
               @if($gallery_type == 1)
               {{ 'Image' }}
               @elseif($gallery_type == 2)
               {{ 'Video' }}
               @else
               {{ 'Image' }}  
               @endif
               </label>
               <hr> -->
               <div class="mt-2">
               <div class="row">
                  <div class="col-md-6">
                     <!-- <div class="form-group">
                        <label for="Title">Title</label> <span class="text-danger">*</span>
                        <input id="Title" type="text" name="gallery_meta[title]" class="form-control" placeholder="" value="@if(!empty($str_title)) {{ $str_title }} @endif">
                        </div> -->
                        <div class="form-group">
                        <div>
                           <select name="companies[]" class="custom-select select2" multiple data-placeholder="Tag">
                              {{-- 
                              <option value="">Select</option>
                              --}}
                              @foreach ($company_list as $company_index => $company_value)
                              <option @if(!empty($arr_companies[$int_gallery_id]) && in_array($company_index, $arr_companies[$int_gallery_id])){{ 'selected' }}  @endif value="{{$company_index}}">
                              {{$company_value}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     
                     <div class="form-group">
                        <div>
                           <select name="products[]" class="custom-select select2" multiple data-placeholder="Tag Products">
                              {{-- 
                              <option value="">Select</option>
                              --}}
                              @foreach ($product_list as $product_index => $product_value)
                              <option @if (!empty($arr_products[$int_gallery_id]) && in_array($product_index, $arr_products[$int_gallery_id])){{ 'selected' }}  @endif  value="{{$product_index}}">
                              {{$product_value}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <!-- <div class="form-group">
                        <label for="Other Tag">Other Tag</label> 
                        <div>
                           <input type="text" class="form-control other-tag-input-class" value="@if(!empty($str_others)) {{  $str_others }} @endif" data-role="tagsinput" name="others[]"/>
                        </div>
                     </div> -->

                     <!-- <div class="form-group">
                        <input type="checkbox" id="gallery_meta[featured_image]" name="gallery_meta[featured_image]" {{(@$str_featured_image == 1) ? 'checked' : ''}} value="1">
                        <label for="Url">Featured 
                        @if(($gallery_link_type ==1) && ($gallery_type == 1))
                        {{ 'Image' }}
                        @elseif(($gallery_link_type ==2) && ($gallery_type == 2))
                        {{ 'Video' }}
                        @elseif(($gallery_link_type ==3) && ($gallery_type == 1))
                        {{ 'Known For' }}
                        @else
                        {{ 'Image' }}             
                        @endif 
                        </label>
                     </div> -->
                     
                  </div>
                  <div class="col-md-6">
            
                     <div class="form-group">
                        <div>
                           <select name="peoples[]" class="custom-select select2" multiple data-placeholder="Tag People">
                              {{-- 
                              <option value="">Select</option>
                              --}}
                              @foreach ($people_list as $people_index => $people_value)
                              <option @if(!empty($arr_peoples[$int_gallery_id]) && in_array($people_index, $arr_peoples[$int_gallery_id])){{ 'selected' }}  @endif value="{{$people_index}}">
                              {{$people_value}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <div>
                           <select name="companies[]" class="custom-select select2" multiple data-placeholder="Tag Companies">
                              {{-- 
                              <option value="">Select</option>
                              --}}
                              @foreach ($company_list as $company_index => $company_value)
                              <option @if(!empty($arr_companies[$int_gallery_id]) && in_array($company_index, $arr_companies[$int_gallery_id])){{ 'selected' }}  @endif value="{{$company_index}}">
                              {{$company_value}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <!-- <div class="form-group">
                        <label for="award-tag-id">Tag Awards</label>
                        <div>
                           <select name="awards[]" class="custom-select select2" multiple data-placeholder="Select">
                              {{-- 
                              <option value="">Select</option>
                              --}}
                              @foreach ($award_list as $award_index => $award_value)
                              <option @if (!empty($arr_awards[$int_gallery_id]) && in_array($award_index, $arr_awards[$int_gallery_id])){{ 'selected' }}  @endif  value="{{$award_index}}">
                              {{$award_value}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div> -->
                     @if($gallery_type == 1)
                     <!-- <div class="form-group">
                        <label for="Url">Url</label>
                        <input id="Url" type="text" name="gallery_meta[url]" class="form-control" value="@if(!empty($str_url)) {{  $str_url }} @endif" placeholder="">
                     </div> -->
                     @endif
                     <!-- <div class="form-group">
                        <label for="company-tag-id">Tag People</label> 
                        <div>
                           <select name="peoples[]" class="custom-select select2" multiple data-placeholder="Select">
                              {{-- 
                              <option value="">Select</option>
                              --}}
                              @foreach ($people_list as $people_index => $people_value)
                              <option @if(!empty($arr_peoples[$int_gallery_id]) && in_array($people_index, $arr_peoples[$int_gallery_id])){{ 'selected' }}  @endif value="{{$people_index}}">
                              {{$people_value}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div> -->
                     <!-- <div class="form-group">
                        <input type="checkbox" id="gallery_meta[featured_image]" name="gallery_meta[featured_image]" {{(@$str_featured_image == 1) ? 'checked' : ''}} value="1">
                        <label for="Url">Featured 
                        @if(($gallery_link_type ==1) && ($gallery_type == 1))
                        {{ 'Image' }}
                        @elseif(($gallery_link_type ==2) && ($gallery_type == 2))
                        {{ 'Video' }}
                        @elseif(($gallery_link_type ==3) && ($gallery_type == 1))
                        {{ 'Known For' }}
                        @else
                        {{ 'Image' }}             
                        @endif 
                        </label>
                     </div> -->
                  </div>
               </div>
               </div>
               <!-- <div class="row">
                  <div class="col-md-6">
                      
                  </div>
                  <div class="col-md-6">
                     @if($gallery_type == 1)
                      <div class="form-group">
                        <label for="Url">Url</label> <span class="text-danger">*</span>
                        <input id="Url" type="text" name="gallery_meta[url]" class="form-control" value="@if(!empty($str_url)) {{  $str_url }} @endif" placeholder="">
                      </div>
                    @endif
                  </div>
                  </div>   -->
               <!-- <div class="row">
                  <div class="col-md-6">
                    
                  </div>
                  <div class="col-md-6">
                   
                  </div>
                  </div>   -->
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-right">
               <input type="hidden" name="gallery_meta[gallery_id]" value="@if(!empty($int_gallery_id)){{ $int_gallery_id }} @endif">
               @csrf            
               <input id="gallery_link_type" type="hidden" name="gallery_meta[gallery_link_type]" value="@if(!empty($gallery_link_type)){{ $gallery_link_type }} @endif">
               <input id="gallery_type" type="hidden" name="gallery_meta[gallery_type]" value="@if(!empty($gallery_type)){{ $gallery_type }} @endif">
               <input id="is_known_for" type="hidden" name="gallery_meta[is_known_for]" value="@if(!empty($is_known_for)){{ $is_known_for }} @endif">
               <button type="submit" class="btn edit-btn-style" id="btnfeed">Post</button>
            </div>
      
</form>