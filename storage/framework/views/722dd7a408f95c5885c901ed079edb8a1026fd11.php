
<?php $__env->startSection('content'); ?>
<?php
$str_dial_code = @$user->dial_code;
$str_mobile_no = @$user->mobile;
$str_mobile_no_new = App\Helpers\UtilitiesTwo::get_mobile_no_data(@$str_dial_code, @$str_mobile_no);
?>
<style>
   .kform_control .select2-container--default .select2-selection--single {
   min-height: 36px;
   width: 500px;
   }
   .select2-dropdown{
   width: 500px!important;
   }
   @media  only screen and (max-width: 600px) {
   .kform_control .select2-container--default .select2-selection--single {
   min-height: 36px;
   width: 287px;
   }
   .select2-dropdown{
   width: 287px!important;
   }
   }
   .text {
   color: #000;
   font-size: 12px;
   position: inherit;
   }
   .table-striped tbody tr:last-child {
   border-bottom: 1px solid #fff;
   }
   .select2.select2-container.select2-container--default{
   width: 100%!important;
   }

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
<link href="<?php echo e(asset('backend/plugins/tags.css')); ?>" rel="stylesheet">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<div class="col-md-9 col-lg-10 MiddleColumnSection">
   <div class="left-column border_right CompanyProfileEdit">
      <div class="First-column kform_control pb-4">
         <form id="profileForm">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="type" value="company">
            <div class="col-md-12">
               <div id="FirstRow_Product" class="row sectionTop">
                  <div class="col-md-4 imgProfilePadding marginBottomTwenty">
                     <img id="blah" src="<?php echo e(@imageBasePath(@$user->profile_image)); ?>" alt=""
                        class="img-fluid z-depth-1-half avatar-pic imgtwoeighty" >
                     <br>
                     <div class="form-group mt-4 ProfileUploadBtn mb-0">
                        <input id="file-uploadten" onchange="readURL(this);" type="file" class="custom-file-input1 image" name="profile_image" accept="image/*" />
                        <input type="hidden" name="crop_img" id="crop_img" value="">
                     </div>
                     <small class="text-danger ">Note: Please upload image up to <?php echo e(App\Helpers\UtilitiesTwo::get_max_upload_image_size()); ?> only.</small>
                     <!-- <small class="text-danger ">Note: Upload a picture in Square.</small> -->
                     <!-- <div class="form-group">
                        <label for="CompanyID">User ID</label>
                        <input id="CompanyID" type="number" name="user_id_number" readonly value="<?php echo e($user->user_id_number); ?>" class="form-control" placeholder="">
                        </div> -->
                  </div>
                  <div class="col-md-8 colmargin">
                     
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label >Company Category</label><br>
                              <select name="company_category_id" class="form-control">
                                 <!-- select2 -->
                                 <?php $__currentLoopData = $company_categories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($id); ?>" <?php echo e($id == $user->company_category_id ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="UserName">Name</label>
                              <input id="first_name" type="text" name="first_name" value="<?php echo e($user->first_name); ?>" class="form-control" placeholder="">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="UserRoles">Acronym</label>
                              <input id="acronym" type="text" name="acronym" class="form-control" value="<?php echo e(@$user->acronym); ?>" placeholder="">
                           </div>
                        </div>
                        <!-- <div class="col-md-6">
                           <div class="form-group">
                             <label for="UserRoles">Last Name</label>
                             <input id="last_name" type="text" name="last_name" class="form-control" value="<?php echo e($user->last_name); ?>" placeholder="">
                           </div>
                           </div> -->
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="UserRoles">User Role</label>
                              <input id="UserRoles" type="text" name="role" readonly class="form-control" value="<?php echo e(@$arr_roles_list[$user->role]); ?>" placeholder="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="Userdescription">User description</label>
                              <textarea class="form-control textBoi" rows="7"  name="description" placeholder=""><?php echo e($user->description); ?></textarea>
                             
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="VirtualShowRoom">Virtual Show Room</label>
                              <input id="VirtualShowRoom" type="text"  class="form-control" value="<?php echo e(@$user->virtual_show_room); ?>"
                                 name="virtual_show_room" placeholder=""> <!-- name="EmailID" -->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- <hr> -->
            <div class="col-md-12">
               <div class="row sectionBox">
                  <h3 class="sec_head_text w-100">Contact Information</h3>
                  <div class="col-md-3 pl-0">
                     <div class="form-group ">
                        <label for="Email" class="d-flex">Primary Email &nbsp ( Hide <input id="hide_email" type="checkbox" name="hide_email" value="1" style="width: 22px;" <?php if(!empty($user->hide_email)): ?><?php echo e('checked'); ?> <?php endif; ?> class="form-control mt-1" placeholder="">)</label>
                        <input id="Email" type="Email" name="Email" value="<?php echo e($user->email); ?>"class="form-control" placeholder="">
                        <span>
                        </span>
                     </div>
                  </div>
                  
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="Mobile">Telephone</label>
                        <input id="Mobile" type="text" name="mobile" value="<?php echo e(@$str_mobile_no_new); ?>" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="Website">Website</label>
                        <input id="Website" type="text" name="website" value="<?php echo e($user->website); ?>" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="Email">Secondary Email &nbsp<span class="fontTwelve text-danger" style="margin-top: 2px;"> Hide? </span> <input id="hide_secondary_email" type="checkbox" class="mt-1" name="hide_secondary_email" value="1" style="width: 15px;"  <?php if(!empty($user->hide_secondary_email)): ?><?php echo e('checked'); ?> <?php endif; ?>></label> 
                        <input id="secondary_email" type="Email" name="secondary_email" value="<?php echo e($user->secondary_email); ?>"class="form-control" placeholder="">
                     </div>
                  </div>
                  <?php if($user->role == 2): ?>
                  <div class="col-md-4 pl-0">
                     <div class="form-group">
                        <label>No of Employees</label>
                        <input type="text" name="no_of_employees" value="<?php echo e($user->no_of_employees); ?>" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Company Category</label>
                        <select name="company_category_id" class="form-control select2">
                        <?php $__currentLoopData = $company_categories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e($id == $user->company_category ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
            <div class="row">
               
            </div>
            <div class="row">
               
               
               
               <!-- <div class="form-group">
                  <label for="Website">Website</label>
                  <input id="Website" type="text" name="website" value="<?php echo e($user->website); ?>" class="form-control" placeholder="">
                  </div> -->
               <?php if($user->role == 2): ?>
               <!-- <div class="col-md-3">
                  <div class="form-group">
                      <label>No of Employees</label>
                      <input type="text" name="no_of_employees" value="<?php echo e($user->no_of_employees); ?>" class="form-control" placeholder="">
                  </div>
                  </div>
                  <div class="col-md-3">
                  <div class="form-group">
                      <label>Company Category</label>
                      <select name="company_category_id" class="form-control select2">
                          <?php $__currentLoopData = $company_categories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($id); ?>" <?php echo e($id == $user->company_category ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </div>
                  </div> -->
               <?php endif; ?>
               <!-- <div class="form-group">
                  <label for="City">City</label>
                  <input id="City" type="text" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                  <label for="State">State</label>
                  <input id="State" type="text"  class="form-control" placeholder="">
                  </div> -->
            </div>
            <div class="col-md-3">
               
               <!-- <div class="form-group">
                  <label for="Country">Country</label>
                  <input id="Country" type="text" name="Country" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                  <label for="Website">Website</label>
                  <input id="Website" type="text" name="Website" class="form-control" placeholder="">
                  </div> -->
            </div>
     
      <?php
      $str_chk_page_type_fun_fact_new = 'user'; 
      ?>
      <?php echo $__env->make("front.user.include_add_fun_fact", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="col-md-12 px-0 px-md-2">
        <div class="row sectionBox">
          <h3 class="sec_head_text w-100 bg-white">Social Media</h3>
            <?php $__currentLoopData = config('cms.social_media'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(in_array($social, config('cms.social_media_now'))): ?> 
             <?php if($loop->index > 8): ?>
                  <div class="col-lg-3 px-0 px-md-2 Login-Style rounded w-12">
                    <div class="form-group">
                      <label for="<?php echo e($social); ?>"><?php echo e($social); ?></label>
                      <input type="url" id="<?php echo e($social); ?>" name="socials_new[<?php echo e($index); ?>]"
                      value="<?php echo e(@$user->socialMedia->pluck('value','type')->toArray()[$index]); ?>"
                      class="form-control social">
                    </div>
                  </div>
                  <?php elseif($loop->index > 8 && $loop->index < 16): ?> 
                  <div class="col-lg-3 px-0 px-md-2 Login-Style rounded w-12">
                    <div class="form-group">
                      <label for="<?php echo e($social); ?>"><?php echo e($social); ?></label>
                      <input type="url" id="<?php echo e($social); ?>" name="socials_new[<?php echo e($index); ?>]"
                      value="<?php echo e(@$user->socialMedia->pluck('value','type')->toArray()[$index]); ?>"
                      class="form-control social">
                    </div>
                  </div>
                  <?php else: ?>
                  <div class="col-lg-3 px-0 px-md-2 Login-Style rounded w-12">
                    <div class="form-group">
                      <label for="<?php echo e($social); ?>"><?php echo e($social); ?></label>
                      <input type="url" id="<?php echo e($social); ?>" name="socials_new[<?php echo e($index); ?>]"
                      value="<?php echo e(@$user->socialMedia->pluck('value','type')->toArray()[$index]); ?>"
                      class="form-control social">
                    </div>
                  </div>
      <?php endif; ?>
      <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        </div>
      <div class="col-md-12">
      <div class="row sectionBox">
      <h3 class="sec_head_text w-100">Services & Expertise</h3>
      <div class="col-md-12 pl-0 inputPaddingLeft">
      <div class="form-group mb-0">
      <label for="Skills">Services</label><span class="text-danger">*</span>
      <div class="tags-input" id="myTags">
      <?php echo $__env->make("front.profile.user_skills_dropdown", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
      </div>
      </div>
      <!-- </div>
         <div class="row"> -->
      <!-- <div class="col-md-6 pl-0 inputPaddingLeft">
         <div class="form-group">
           <label for="Gender">Gender</label><span class="text-danger">*</span>
             <select name="gender" class="form-control">
                 <option value="">Choose</option>
                 <?php $__currentLoopData = @config('cms.gender'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <option value="<?php echo e($gender); ?>" <?php echo e($gender === $user->gender ? 'selected' : ''); ?>><?php echo e($gender); ?></option>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </select>
         </div>
         </div> -->
      <!-- <div class="col-md-3">
         <div class="form-group">
           <label for="UserAge">User Age</label>
           <input id="UserAge" type="text" name="age" readonly value="<?php echo e(@Carbon\Carbon::parse($user->dob)->age); ?>" class="form-control" placeholder="">
         </div>
         </div> -->
      </div>
      </div>
      <?php echo $__env->make("front.profile.list_innovator_role", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <div class="col-md-12">
      <div class="row sectionBox bg-white">
      <button type="button" class="btn btnAll profileEdit">Update <i class="fa fa-spinner fa-spin postLoading" style="display: none;"></i></button>
      </div>
      </div>
      
   </div>
   </form>
</div>

</div>
<div class="div">
   <?php echo $__env->make("front.profile.add_role_popup", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php echo $__env->make("front.includes.cropper_model", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
<script src="<?php echo e(asset('backend/plugins/tags.js')); ?>"></script>
<!-- // preview images by kundan -->
<script>
    var bs_modal = $('#modal');
  var image = document.getElementById('blah');
  var cropper,reader,file;

  function readURL(e) {

   var bs_modal = $('#modal');
   var image = document.getElementById('image');
   var cropper,reader,file;
   

   $("body").on("change", ".image", function(e) {
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
            // viewMode: 3,
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
      width: 1013,
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
          url: "<?php echo e(route('front.user.free.edit.profile.uploads')); ?>",
          data: {image: base64data},
          success: function(data) {
             $('.crop_laoder').hide();
            bs_modal.modal('hide');
            $('#blah').attr('src',base64data);
            $('#crop_img').val(data.crop_img);
                        // html = '<img src="' + img + '" />';
                        //    $("#preview-crop-image").html(html);
                        // alert("success upload image");
                      }
                 });
      };
    });
  });
}

   //frontend_show_standard_ckeditor_new('Userdescription');
      // function readURL(input) {
      //      if (input.files && input.files[0]) {
      //          var reader = new FileReader();
   
      //          reader.onload = function (e) {
      //              $('#blah')
      //                  .attr('src', e.target.result);
      //          };
   
      //          reader.readAsDataURL(input.files[0]);
      //      }
      //  }
   
   
   /*function populate_edit_role_data()
   {
   var str_role_name = $(this).data("role-name");
   
   alert(str_role_name);
   
   $('#add_edit_profile_role_name').val(str_role_name);
   }*/
</script>
<script>
   var profile_data_saved_flag = '<?php echo e(Session::has("profile_data_saved_flag")); ?>';
   
   $(function ($) {
   
   var test = $("#profileForm  [name='mobile']").intlTelInput({
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js",
            initialCountry: 'auto',
            geoIpLookup: function(callback) {
              callback('us');
            }
          });
          var mob = "<?php echo e(!empty(@$str_mobile_no_new) ? '+'.@$user->dial_code.@$str_mobile_no_new : '0'); ?>";
          if(mob != 0){
              $("#profileForm  [name='mobile']").intlTelInput("setNumber", mob);
          }
   
   
   if(profile_data_saved_flag!="")
   {
   //toastr.success("Profile Saved Successfully.");
   }
   
      $(document).on('click','.add-link',function() {
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
   
      $(document).on('click', '.profileEdit', function (e) {
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
   
   if($.trim($('#profileForm  [name="mobile"]').val()) != '' && $('#profileForm  [name="mobile"]').intlTelInput("isValidNumber") == false) {
   
                toastr.error('<?php echo e(adminTransLang("invalid_mobile_no")); ?>');
                  return false;
   
              }
   
          var fd = new FormData($('#profileForm')[0]);
   
        //  var ckeditor_description_new = frontend_get_ckeditor_description_new('Userdescription');
          //fd.append('description', ckeditor_description_new);
   
   var phone = $('#profileForm  [name="mobile"]').intlTelInput("getSelectedCountryData");
              
   $('#profileForm  [name="mobile"]').val(($('#profileForm  [name="mobile"]').val()).replace(/ /g, ''));
              fd.append('dial_code', phone.dialCode);
   
   /*var skills = [];
              $( "span.tag" ).each(function( index ) {
                // console.log( index + ": " + $( this ).find('.text').text() );
                skills.push($( this ).find('.text').text());
              });
          fd.append('skills', skills);*/
   
          $.ajax({
              url: "<?php echo e(route('front.user.profile.edit')); ?>",
              data: fd,
              processData: false,
              contentType: false,
              dataType: 'json',
              type: 'POST',
              beforeSend: function () {
                  $('.profileEdit').attr('disabled', true);
                    $('.postLoading').show();
                  // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
              },
              error: function (jqXHR, exception) {
                  $('.profileEdit').attr('disabled', false);
   
                  var msg = formatErrorMessage(jqXHR, exception);
                  toastr.error(msg)
                   $('.postLoading').hide();
                  console.log(msg);
                  // $('.message_box').html(msg).removeClass('hide');
              },
              success: function (data) {
                 if(data.success == 0){
                     var err = JSON.parse(data.response);
                     var er = '';
                     $.each(err, function(k, v) { 
                        er += v+'<br>'; 
                        // console.log('key - '+k+' - err - '+er);
                     }); 
                     
                     toastr.error(er,'Error');
                     $('.profileEdit').attr('disabled', false);
                     $('.postLoading').hide();
                 }else if(data.success == 1){
                     $('.profileEdit').attr('disabled', false);
                     $('.postLoading').hide();
                     toastr.success("Profile Saved Successfully.");
                     // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                     //toastr.success(data.message)
                     // window.location.replace('<?php echo e(route("admin.users.index")); ?>');
                     // window.location.replace('<?php echo e(route("front.login")); ?>');
                     window.location.replace('<?php echo e(route("front.user.company.edit.profile")); ?>');
                 }   
              }
          });
      });
   });

  function showAllsocailMedia(e,type) {
    if(type==1) {
     $('.no-all-socail-icon').hide();
     $('.all-socail-icon').show();
    } else {
     $('.all-socail-icon').hide();
     $('.no-all-socail-icon').show();
  
   }
  }
   
</script>
<?php echo $__env->make("front.profile.edit_profile_dob_js", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>