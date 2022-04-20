

<?php $__env->startSection('title'); ?> 

<?php
$str_add_edit_gallery_text_new ='';
if($gallery_type == 1)
{
  if(!empty($gallery_data->id))
   { 
     $str_add_edit_gallery_text_new = adminTransLang('edit_image_gallery'); 
   } 
   else
   {	   
     $str_add_edit_gallery_text_new = adminTransLang('add_image_gallery');
   } 
}

if($gallery_type == 2)
{
  if(!empty($gallery_data->id))
  { 
    $str_add_edit_gallery_text_new = adminTransLang('edit_video_gallery'); 
  }
   else 
   {
	 $str_add_edit_gallery_text_new =  adminTransLang('add_video_gallery'); 
   } 
}

if($gallery_type == 3)
{
  $str_add_edit_gallery_text_new =  'Add Known For Gallery';	   
}

if(!empty($gallery_data->is_known_for))
  { 
    $str_add_edit_gallery_text_new = 'Edit Known For Gallery'; 
  }
 
?>


<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('content'); ?>

<style>

</style>
    <section class="content-header">
        <h1> <?php echo e($str_add_edit_gallery_text_new); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.galleries.index')); ?>/0/0"> All Galleries </a></li>
            <li class="active"><?php echo e($str_add_edit_gallery_text_new); ?></li>
        </ol>
    </section>
	
    <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="box">
                     <div class="box-body" id="add-edit-gallery-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="add-edit-gallery-main-box-body-form">
						<?php echo e(csrf_field()); ?>

     
	 
	  <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Select User<i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                   <select <?php if(!empty($gallery_id)): ?><?php echo e('disabled'); ?><?php endif; ?> class="form-control select2" name="select_gallery_user_id" id="select_gallery_user_id" onchange="return set_change_user_data(this.value);">
                                     <option value="">Select User</option>
                                     <?php if(count($users_list) > 0): ?>
                                        <?php $__currentLoopData = $users_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users_list_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($users_list_row->id); ?>" <?php echo e((@$gallery_data->user_id  == $users_list_row->id ) ? 'selected' :''); ?>> <?php echo e($users_list_row->text); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php endif; ?>
                                   </select>
                                </div>
                              </div>
		
       <?php if($gallery_type == 1 || $gallery_type == 3): ?>		
							  <div class="form-group">
          <label for="advertisement_image" class="col-sm-2 control-label">Photo <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input id="file-uploadten" onchange="readGalleryURL(this);" type="file" name="gallery_image">
			 
            <img <?php if(!empty($gallery_data->media)): ?><?php echo e('style=display:block;'); ?> <?php else: ?> <?php echo e('style=display:none;'); ?> <?php endif; ?> id="gallery-blah-image" <?php if(!empty($gallery_data->media)): ?> 
				src="<?php echo e(url('/')); ?><?php echo e($folder_path); ?><?php echo e($str_media_data); ?>" <?php endif; ?> alt=""
                class="img-fluid z-depth-1-half avatar-pic advertisement_width_height_class" style="width: 200px;min-height: 200px;object-fit: cover;">
            
          </div>
       </div>
	 <?php endif; ?>	 
	   
	   <div class="form-group">
          <label for="name" class="col-sm-2 control-label"> Destination<i class="has-error">*</i></label>
          <div class="col-sm-6">
             <select onchange="return showProdEventDropDownByDest(this.value);"  name="gallery_meta[destination_id]" class="form-control" data-placeholder="Select"> <span class="text-danger">*</span>
                          <option value="">Select Destination</option>
                          <?php $__currentLoopData = $arr_destinations_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr_destinations_list_key => $arr_destinations_list_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($arr_destinations_list_key == 4): ?>
						   <?php continue; ?>; 
					      <?php endif; ?>	  
						  <option <?php if(!empty($int_destination_id) && ($int_destination_id == $arr_destinations_list_key)): ?><?php echo e('selected'); ?>  <?php endif; ?>  value="<?php echo e($arr_destinations_list_key); ?>">
                           <?php echo e($arr_destinations_list_val); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
          </div>
       </div>
	   
	   <div class="form-group assign-prod-event-drop-down-class"  <?php if(!empty($int_assign_product_id)): ?> <?php echo e("style=display:block;"); ?> <?php else: ?> <?php echo e("style=display:none;"); ?> <?php endif; ?> id="assign-gallery-event-product-div<?php echo e($arr_destinations_list_keys[1]); ?>">
          <label for="name" class="col-sm-2 control-label" > Product<i class="has-error">*</i></label>
          <div class="col-sm-6"  id="select_div_assign_event_product_id<?php echo e($arr_destinations_list_keys[1]); ?>">
             
          </div>
       </div>
	   
	   <div class="form-group  assign-prod-event-drop-down-class"  <?php if(!empty($int_assign_event_id)): ?> <?php echo e("style=display:block;"); ?> <?php else: ?> <?php echo e("style=display:none;"); ?> <?php endif; ?> id="assign-gallery-event-product-div<?php echo e($arr_destinations_list_keys[2]); ?>">
          <label for="name" class="col-sm-2 control-label"> Event<i class="has-error">*</i></label>
          <div class="col-sm-6" id="select_div_assign_event_product_id<?php echo e($arr_destinations_list_keys[2]); ?>">
             
          </div>
       </div>
	   

	     <div class="form-group">
          <label for="position" class="col-sm-2 control-label">Title</label>
          <div class="col-sm-6">
      		    <input id="Title" type="text" name="gallery_meta[title]" class="form-control" placeholder="" value="<?php if(!empty($str_title)): ?> <?php echo e($str_title); ?> <?php endif; ?>">		  		  
          </div>
       </div>
	   	   
	   <?php if($gallery_type == 2): ?>
					
	   <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Video <i class="has-error">*</i></label>
          <div class="col-sm-6">
      		  <input id="VideoUrl" type="text" name="gallery_meta[video_url]" class="form-control" value="<?php if(!empty($str_media_data)): ?> <?php echo e($str_media_data); ?> <?php endif; ?>" placeholder="">		  		  
          </div>
       </div>
	   <?php endif; ?>
	   
	   <div class="form-group">
          <label for="people-tag-id" class="col-sm-2 control-label">People Tag </label>
          <div class="col-sm-6">
      		   <select name="peoples[]" class="custom-select select2" multiple data-placeholder="Select">
                                      
                                      <?php $__currentLoopData = $people_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $people_index => $people_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option <?php if(!empty($arr_peoples[$gallery_id]) && in_array($people_index, $arr_peoples[$gallery_id])): ?><?php echo e('selected'); ?>  <?php endif; ?> value="<?php echo e($people_index); ?>">
                                      <?php echo e($people_value); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
						
          </div>
       </div>
	   
	   <div class="form-group">
          <label for="company-tag-id" class="col-sm-2 control-label">Company Tag </label>
          <div class="col-sm-6">
      		  <select name="companies[]" class="custom-select select2" multiple data-placeholder="Select">
                        
                        <?php $__currentLoopData = $company_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company_index => $company_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option <?php if(!empty($arr_companies[$gallery_id]) && in_array($company_index, $arr_companies[$gallery_id])): ?><?php echo e('selected'); ?>  <?php endif; ?> value="<?php echo e($company_index); ?>">
                          <?php echo e($company_value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>	  		  
          </div>
       </div>
	   
	   	<div class="form-group">
			  <label for="product-tag-id" class="col-sm-2 control-label">Product Tag </label>
			  <div class="col-sm-6">
				 <select name="products[]" class="custom-select select2" multiple data-placeholder="Select">
                      
                      <?php $__currentLoopData = $product_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_index => $product_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if(!empty($arr_products[$gallery_id]) && in_array($product_index, $arr_products[$gallery_id])): ?><?php echo e('selected'); ?>  <?php endif; ?>  value="<?php echo e($product_index); ?>">
                        <?php echo e($product_value); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
			  </div>
		   </div>
		   <div class="form-group">
			  <label for="Other Tag" class="col-sm-2 control-label">Other Tag</label>
			  <div class="col-sm-6">
				 <input type="text" class="form-control other-tag-input-class" value="<?php if(!empty($str_others)): ?> <?php echo e($str_others); ?> <?php endif; ?>" data-role="tagsinput" name="others[]"/>
			     <?php echo App\Helpers\UtilitiesTwo::getTagText(); ?>

			  </div>
		   </div>
	   
	   <div class="form-group">
          <label for="caption" class="col-sm-2 control-label">Caption </label>
          <div class="col-sm-6">
             <input type="" class="form-control" id="Caption" value="<?php if(!empty($str_caption)): ?> <?php echo e($str_caption); ?> <?php endif; ?>" name="gallery_meta[caption]">
          </div>
       </div>
       
	   <?php /*
       <div class="form-group">
          <label for="award-tag-id" class="col-sm-2 control-label">Award Tag </label>
          <div class="col-sm-6">
             <select style="width:100px;" name="awards[]" class="custom-select select2" multiple data-placeholder="Select">
                      {{-- <option value="">Select</option> --}}
                      @foreach ($award_list as $award_index => $award_value)
                        <option @if (!empty($arr_awards[$gallery_id]) && in_array($award_index, $arr_awards[$gallery_id])){{ 'selected' }}  @endif  value="{{$award_index}}">
                       {{$award_value}}</option>
                      @endforeach
                      </select>
            
          </div>
       </div>
	   */?>
	   
	   <?php if($gallery_type == 1): ?>
         <div class="form-group">
          <label for="Url" class="col-sm-2 control-label">Url </label>
          <div class="col-sm-6">
             <input id="Url" type="text" name="gallery_meta[url]" class="form-control" value="<?php if(!empty($str_url)): ?> <?php echo e($str_url); ?> <?php endif; ?>" placeholder="">
          </div>
       </div>	   
	  <?php endif; ?> 
                           
                    <div class="col-sm-6" style="margin-top: 8px;">
                        <div class="row">
						
						    <input type="hidden" id="hidden_gallery_user_id" name="hidden_gallery_user_id" value="<?php echo e($gallery_user_id); ?>">
						    <input type="hidden" id="gallery_type" name="gallery_type" value="<?php echo e($gallery_type); ?>">
			                <input id="is_known_for" type="hidden" name="gallery_meta[is_known_for]" value="<?php if(!empty($is_known_for)): ?><?php echo e($is_known_for); ?> <?php endif; ?>">
							<button type="button" class="btn btn-success" id="createBtn">Save</button>
                        </div>
                    </div>

                        </form>
                     </div>

                     <div class="box-footer">
                        
                     </div>
                  </div>
               </div>
            </div>
         </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<script>

function readGalleryURL(input) {
			
			$('#gallery-blah-image').show();
			
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#gallery-blah-image')
                        .attr('src', e.target.result);	

                     var image = new Image();
					image.src = e.target.result;

					image.onload = function() {
						// access image size here 
				
					};
						
                };

                reader.readAsDataURL(input.files[0]);
												
            }
        }

function showProdEventDropDownByDest(dest_id)
{
		
	if(dest_id>0)
	{
	  $( ' .assign-prod-event-drop-down-class').hide(); 	
	  $( '#assign-gallery-event-product-div'+dest_id).show();	
	}

     load_user_event_product_data(dest_id);	
}

$(document).ready(function(){
	
	         showProdEventDropDownByDest(<?php echo e(@$int_destination_id); ?>);
	
            $('body').on('click','#add-edit-gallery-main-box-body-div  #createBtn',function(e){
                e.preventDefault();
				
				var int_select_gallery_user_id = $('#add-edit-gallery-main-box-body-div  #select_gallery_user_id').val();
				 
                var fd = new FormData($('#add-edit-gallery-main-box-body-div  form')[0]);
                //fd.append('dial_code', phone.dialCode);

                $.ajax({
				    url: "<?php echo e(route('admin.galleries.save-add-edit')); ?>" + "/" + <?php echo e($gallery_id); ?> + "/" + <?php echo e($gallery_type); ?>,  
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#add-edit-gallery-main-box-body-div  #createBtn').attr('disabled',true);
                        $('#add-edit-gallery-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#add-edit-gallery-main-box-body-div  #createBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
						var res = '';
						if(msg.indexOf("essages.")>0)
						{
						   res = msg.split("essages.");	
						   msg = res[1];
						}
						
                        $('#add-edit-gallery-main-box-body-div  .message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#add-edit-gallery-main-box-body-div  #createBtn').attr('disabled',false);                        
                        var int_advertisement_category = $('#add-edit-gallery-main-box-body-div  #advertisement_category').val();
						window.location.replace('<?php echo e(route("admin.galleries.index")); ?>'+ "/" + int_select_gallery_user_id );
                        
                    }
                });
				
				
				
            });
        });	
		
function set_change_user_data(hidden_gallery_user_id)
{
	$('#hidden_gallery_user_id').val(hidden_gallery_user_id);	
}	
		
function load_user_event_product_data(data_type)
{
	var hidden_gallery_user_id = $('#hidden_gallery_user_id').val();
	var  postData;
     postData = {
            "hidden_gallery_user_id": hidden_gallery_user_id,
			"data_type": data_type,
			"int_assign_product_id": <?php echo e(@$int_assign_product_id); ?>,
			"int_assign_event_id": <?php echo e(@$int_assign_event_id); ?>,
			_token: ajax_csrf_token_new,
        };

          $.ajax({
                url: baseUrl + '/admin/galleries/get-user-product-event',
				data: postData,
				type: 'POST',
                beforeSend: function () {
                    //$('#addRoleModalDiv .addUpdateRoleBtn').attr('disabled', true);
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    $('#select_div_assign_event_product_id'+data_type).html('Loading. Please Wait...');
				},
                error: function (jqXHR, exception) {
                    //$('#addRoleModalDiv .addUpdateRoleBtn').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    $('#select_div_assign_event_product_id'+data_type).html('');
					//toastr.error(msg)
                    //console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
					   $('#select_div_assign_event_product_id'+data_type).html(data);	
					
                }
            });	
}
		
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>