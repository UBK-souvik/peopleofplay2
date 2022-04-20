<?php //echo "<pre>"; print_r($gallery_data); die; ?>
			   @php
				 $str_award_tag = '';
                 $str_product_tag = '';
				 $str_media_data = '';
				 $str_bottom_content = '';
				 $str_edit_delete = '';
				 $str_known_for_class = '';
				 $islogin = '';
				 $str_site_base_url_new = url('/');
				 
				 if(!empty($is_ajax_call) && ($gallery_link_type == 3))
				 {
					$str_known_for_class =  'knownImg';
				 }
				 
				 $str_caption_name_snippet = '';
			   @endphp
			  
			@foreach($gallery_data as $gallery_data_row)
                <?php //echo "<pre>"; print_r($gallery_data_row); die; ?>
                @php  			     
 			      $int_gallery_id = $gallery_data_row->id;
 			      $str_caption_one = $gallery_data_row->home_caption_one;
				  $is_known_for = $gallery_data_row->is_known_for;				 
				  $str_media_data = trim($gallery_data_row->featured_image);
				  //$str_award_tag = $gallery_data_row->award_name;
				  $str_award_tag = '';
				  //$str_product_tag = $gallery_data_row->product_name;
				  $str_title = $gallery_data_row->title;
				  $str_featured_image = $gallery_data_row->featured_image;
				  $str_caption = $gallery_data_row->caption;
				  $str_url = $gallery_data_row->url;
				  $int_destination_id = $gallery_data_row->destination_id;
				  $int_assign_product_id = $gallery_data_row->assign_product_id;
				  $int_assign_brand_id = $gallery_data_row->assign_brand_id;
				  $int_assign_event_id = $gallery_data_row->assign_event_id;
				  $int_gallery_user_id = $gallery_data_row->user_id;
				  $str_modal_form_div_id =  "ModalGalleryVideoForm".$int_gallery_id;
				  $str_product_tag = '';
				  $str_person_tag = '';
				  $str_company_tag = '';				  
				  $str_people_tag = '';
				  $str_others = '';
				 
				  
				   if(is_object($gallery_data_row->gallery_products))
				   {
					   $gallery_data_row->gallery_products->user_id;
				   }	   
				   
				   if(is_object($gallery_data_row->gallery_product_tags))
				   {
					   
					   foreach($gallery_data_row->gallery_product_tags as $gallery_data_product_tag_row)
					   {
						   
						 if(!empty($gallery_data_product_tag_row->productdata->id))
						 {
						   $arr_products[$int_gallery_id][] = $gallery_data_product_tag_row->productdata->id;
					       $product_url = url('/') . '/product/' . $gallery_data_product_tag_row->productdata->name;
					       $arr_products_urls[$int_gallery_id][] = "<a target='_blank' href='$product_url'>".$gallery_data_product_tag_row->productdata->name."</a>";				 
					       $str_product_tag = implode(",", $arr_products_urls[$int_gallery_id]);
				   
						 }			   
					   }					   
				   }
				 
				   
				   if(is_object($gallery_data_row->gallery_person_tags))
				   {
					   
					   foreach($gallery_data_row->gallery_person_tags as $gallery_data_person_tag_row)
					   {
						   
						 if(!empty($gallery_data_person_tag_row->persondata->id))
						 {
							 $arr_persons[$int_gallery_id][] = $gallery_data_person_tag_row->persondata->id;
					         $person_url = "#";
							 $str_person_name_new = App\Helpers\Utilities::getUserName($gallery_data_person_tag_row->persondata);
					         $arr_persons_urls[$int_gallery_id][] = "<a target='_blank'  href='$person_url'>".$str_person_name_new."</a>";				 
					         $str_person_tag = implode(",", $arr_persons_urls[$int_gallery_id]); 
						 }
						 	  
					   }					   
				   }
				   				   
				   if(is_object($gallery_data_row->gallery_company_tags))
				   {
					   foreach($gallery_data_row->gallery_company_tags as $gallery_data_company_tag_row)
					   {
						   
					     if(!empty($gallery_data_company_tag_row->companydata->id))
						 {
					       $arr_companies[$int_gallery_id][] = $gallery_data_company_tag_row->companydata->id;
					       $company_url = "#";
						   
						   if(!empty($gallery_data_company_tag_row->companydata->id))
						   {
						     $company_url = App\Helpers\Utilities::get_user_url($str_site_base_url_new, $gallery_data_company_tag_row->companydata);
						   }
						   
						   $str_company_name_new = App\Helpers\Utilities::getUserName($gallery_data_company_tag_row->companydata);
					       $arr_companies_urls[$int_gallery_id][] = "<a target='_blank'  href='$company_url'>".$str_company_name_new."</a>";
					       $str_company_tag = implode(",", $arr_companies_urls[$int_gallery_id]);
				           
						 }			   
					   }					   
				   }				   				   				   
				   
				   $int_is_object_gallery_people_tag =  @is_object(@$gallery_data_row->gallery_people_tags);				  
				   $int_is_object_gallery_people_tag = intval($int_is_object_gallery_people_tag);
				   
				   if(!empty($int_is_object_gallery_people_tag)){					   
				   foreach($gallery_data_row->gallery_people_tags as $gallery_data_people_tag_row)					   
				   {						  					     
				    if(!empty($gallery_data_people_tag_row->peopledata->id))
				    {							 					       
			          $arr_peoples[$int_gallery_id][] = $gallery_data_people_tag_row->peopledata->id;
					  $people_url = "#";

                      if(!empty($gallery_data_people_tag_row->peopledata->id))
					   {
						 $people_url = App\Helpers\Utilities::get_user_url($str_site_base_url_new, $gallery_data_people_tag_row->peopledata);
					   }					  
					   
					  $str_people_name_new = App\Helpers\Utilities::getUserName($gallery_data_people_tag_row->peopledata);
					  $arr_peoples_urls[$int_gallery_id][] = "<a target='_blank'  href='$people_url'>".$str_people_name_new."</a>";					       
					  $str_people_tag = implode(",", $arr_peoples_urls[$int_gallery_id]);						 
					}			   					   
				   }				   
				   }				   				   
					 // for people tags				   
					 if($int_is_object_gallery_people_tag == 1)// || !empty($int_is_object_gallery_people_tag)
					 {				
				     }
				   
				   
				   if(is_object($gallery_data_row->gallery_other_tags))
				   {
					   foreach($gallery_data_row->gallery_other_tags as $gallery_data_other_tag_row)
					   {
						  if(!empty($gallery_data_other_tag_row->tag))
						 {
						   $arr_others[$int_gallery_id][] = $gallery_data_other_tag_row->tag;
					       $str_others = implode(",", $arr_others[$int_gallery_id]);
					       
						 } 
					   }
				   }	   
			  
				 	 $base_url = url('/report/'.$gallery_link_type.'/'.@$str_media_data.'/'.@$int_gallery_user_id);
					 $str_bottom_content =  "<div class='d-flex justify-content-between text-white preview_wrap bottom-content-image-div-new'>";
					 $str_bottom_content = $str_bottom_content . "<div class='text-left'>";


				 	if(!empty($str_title)){
			 			$str_bottom_content = $str_bottom_content . "<p class='text-white'><strong>Title: </strong>".$str_title."</p>";
					}
						 				 
					 if(!empty($str_caption_one))
					 {
	 			       $str_bottom_content = $str_bottom_content . "<p class='text-white'><strong>Caption: </strong>".$str_caption_one."</p>";
					 }
					 
					 if(!empty($str_award_tag))
					 {  
				       $str_bottom_content = $str_bottom_content . "<p class='text-white'><strong>Award: </strong>".$str_award_tag."</p>";
					 }
					 
					 if(!empty($str_url))
					 {
					   $str_bottom_content = $str_bottom_content . "<p class='text-white'><strong>Url: </strong><a class='text-white' target='_blank'  href='$str_url'>".$str_url."</a></p>";
					 }
					 
					 $str_bottom_content = $str_bottom_content . "</div>";
					 $str_bottom_content = $str_bottom_content . "<div class='text-left'>";
					 
					 if(!empty($str_caption_one))
					 {  
				       $str_bottom_content = $str_bottom_content . "<p class='text-white'><strong>Product: </strong>".$str_caption_one."</p>";
					 }
					 
					 if(!empty($str_company_tag))
					 {  
				       $str_bottom_content = $str_bottom_content . "<p class='text-white'><strong>Company: </strong>".$str_company_tag."</p>";
					 }					 					 if(!empty($str_people_tag))					 {  				       $str_bottom_content = $str_bottom_content . "<p class='text-white'><strong>People: </strong>".$str_people_tag."</p>";					 }					 
					 
					 if(!empty($str_person_tag))
					 {
	 			       //$str_bottom_content = $str_bottom_content . "<p class='text-white'><strong>Person: </strong>".$str_person_tag."</p>";
					 }
					 
					 $str_bottom_content = $str_bottom_content . "</div>";
		             
					
					 
					 $str_bottom_content = $str_bottom_content . "<div class='d-flex'>";
						 if(empty($is_ajax_call) && ($user_id == $int_gallery_user_id))
						 {
						 	$islogin = 1;
							$str_bottom_content = $str_bottom_content . "<p><a onclick='return openEditGalleryModal($int_gallery_id);'  href='#' class='text-white px-3 py-2 mr-2 preview_btn'>Edit</a></p>"; 
						 }
		                 
						 if(empty($is_ajax_call) && ($user_id == $int_gallery_user_id))
						 {
						 	$islogin = 1;
						    $str_bottom_content = $str_bottom_content . "<p><a onclick='return deleteGalleryModal($int_gallery_id, $gallery_link_type);'  href='#' class='text-white px-3 py-2 preview_btn'>Delete</a></p>";
						 }
				 	
					 
					 $str_bottom_content = $str_bottom_content . "</div>";
					 
					  if($gallery_type != 2){ 
					 $str_bottom_content = $str_bottom_content."
					 <!-- <a onclick='return confirm_click();'  href='".$base_url."' class='report' type='".@$gallery_link_type."' url='".@$str_media_data."'>Report</a> -->
					 <div class='d-flex dropdown mt-2'>
                        <a class='dropdown-toggle reportToggle' data-toggle='dropdown'>
                          <i class='fa fa-ellipsis-v photo_icon reportIcon text-white'></i>
                        </a>
                        <div class='dropdown-menu reportMenuGellery'>
                          <a onclick='return confirm_click();'  href='".$base_url."' class='dropdown-item reportItem report' type='".@$gallery_link_type."' url='".@$str_media_data."'>Report</a>
                        </div>
                      </div>";
					}
					 
					 $str_bottom_content = $str_bottom_content . "</div>";

					if(empty($str_title) && empty($str_caption)  && empty($str_award_tag) && empty($str_url) && empty($str_product_tag) && empty($str_company_tag) && empty($str_person_tag) && empty($islogin)){
					 	$str_bottom_content = "";
					}



					
					$GetAPI = @GetYoutubeAPI($str_media_data);
                    $thumbnail = @$GetAPI['thumbnail']['thumb'];
					$thumbnail_title = @$GetAPI['title'];
					
					$str_caption_name_snippet = App\Helpers\UtilitiesTwo::get_video_title_data($str_caption);
					
			    @endphp
			   		<div class="item draggable-element pr-1 pb-0" data-responsive="" 
					data-src="{{@awardImageBasePath(@$str_media_data)}}" 
					data-sub-html="{{ $str_bottom_content }}">
						<a href="#">
						   <img class="img-responsive img-div-class-new kimg_div_class_new {{$str_known_for_class}} img-fluid" 
						   src="{{@awardImageBasePath(@$str_media_data)}}">
						</a>
						<div class="userPoductTitle withoutOverlay pt-1 mb-3"><small>@if(!empty($str_caption_name_snippet)){{$str_caption_name_snippet}}@endif</small></div>
				  </div>
				
				

			   	

			  <!-- <li class="col-xs-6 col-sm-4 col-md-3" >
                    <a href='#' data-toggle='modal' 		 
				  data-target='#ModalGalleryVideoForm'>Edit</a>
				</li> -->
			  {{-- @if(empty($is_ajax_call) && ($user_id == $int_gallery_user_id))					
			       @include("front.user.gallery.add_image_gallery")
			   @endif		 --}}
			   
			@endforeach
				
                <!-- <div class="p-1">
                  <button type="button" class="btn edit-btn-style" data-toggle="modal" data-target="#ModalGalleryVideoForm">Add Image </button>
                </div> -->
			