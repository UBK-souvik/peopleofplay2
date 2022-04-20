
<?php $__env->startSection('content'); ?>

<?php
$str_dial_code = @$user->dial_code;
$str_mobile_no = @$user->mobile;

$str_mobile_no_new = App\Helpers\UtilitiesTwo::get_mobile_no_data(@$str_dial_code, @$str_mobile_no);

?>

<style type="text/css">
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
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
  <div class="left-column border_right ProfileEdit">
    <div class="First-column" >

      <form id="profileForm" class="kform_control">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="type" value="people">
        <div class="col-md-12 px-0 px-md-2">
          <div id="FirstRow_Product" class="row sectionTop">
            <div class="col-lg-5 px-0 px-md-2 imgProfilePadding marginBottomTwenty lessMargin">
              <div class="imgtwoeighty">
                <img id="blah" src="<?php echo e(@imageBasePath(@$user->profile_image)); ?>" alt=""
                class="img-fluid z-depth-1-half avatar-pic imgtwoeighty">
              </div>               
              <div class="form-group mt-4 ProfileUploadBtn mb-0">
                <input id="file-uploadten" onchange="readURL(this);" class="custom-file-input1 image" type="file" name="profile_image" accept="image/*" />
              </div>
              <input type="hidden" name="crop_img" id="crop_img" value="">
              <div class="ProfileUploadBtn text-left mt-2" style="line-height: 1;">
                <small class="text-danger" >Note: Please upload image up to <?php echo e(App\Helpers\UtilitiesTwo::get_max_upload_image_size()); ?> only</small>
              </div>
              </div>
            <div class="col-lg-7 px-0 px-md-2 colmargin">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="UserName">First Name</label><span class="text-danger">*</span>
                    <input id="first_name" type="text" name="first_name" value="<?php echo e($user->first_name); ?>" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="UserRoles">Last Name</label><span class="text-danger">*</span>
                    <input id="last_name" type="text" name="last_name" class="form-control" value="<?php echo e($user->last_name); ?>" placeholder="">
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="UserRoles">Profile Caption</label><span class="text-danger">*</span>
                    <input type="text" class="form-control" id="home_page_slide_show_caption" name="home_page_slide_show_caption" value="<?php if(!empty(@$user->home_page_slide_show_caption)): ?><?php echo e($user->home_page_slide_show_caption); ?> <?php endif; ?>">
                  </div>
                </div>
              </div>
              
              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Bio</label><span class="text-danger">*</span>
                    <textarea class="form-control textBoi" rows="7" name="description" placeholder=""><?php echo e($user->description); ?></textarea>
                   
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <?php
        $str_chk_page_type_fun_fact_new = 'user'; 
        ?>

        <?php echo $__env->make("front.user.include_add_fun_fact", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="col-md-12 px-0 px-md-2">
          <div class="row sectionBox">
            <h3 class="sec_head_text w-100">Contact Info</h3>
            
          <div class="col-md-4 px-0 px-md-2">
            <div class="form-group">
              <label for="CompanyName">Company Name</label></span>
              <select class="form-control select-ajax py-3" data-select2-tags="true" name="contact_info[company_name]" id="company_list_id">  
                <?php if(!empty($user->inventorContactInfo->company_name)): ?>
                <?php
                $value  = $user->inventorContactInfo->company_name;  
                $text   = $user->inventorContactInfo->company_name;  
                if($abc = \App\Models\User::find($user->inventorContactInfo->company_name)){
                $value = $abc->id;  
                $text = $abc->first_name." ".$abc->last_name;  
              }
              ?>
              <?php if(!empty($value) && !empty($text) && $value!='null' && $text!='null'): ?> 
              <option value="<?php echo e($value); ?>" selected><?php echo e($text); ?></option>
              <?php endif; ?>
              <?php endif; ?>
            </select>
            
            <div class="">
             <a href="javascript:void(0);" class="textBlack1 pl-0 fontTwelve text-danger" id="bt_company_list_id">Remove Company</a>
           </div>
         </div>
       </div>
       <div class="col-md-4 px-0 px-md-2">
        <div class="form-group mb-0">
          <label for="CompanyEmailID">Company Email</label></span>
          <input id="CompanyEmailID" type="email"  class="form-control" value="<?php echo e(@$user->inventorContactInfo->company_email_id); ?>" name="contact_info[company_email_id]" required="required" placeholder=""> <!-- name="EmailID" -->
        </div>
      </div>
      <div class="col-md-4 px-0 px-md-2">
        <div class="form-group mb-0">
          <label for="CompanyEmailID">Company Phone</label></span>
          <input id="CompanyEmailID" type="number"  class="form-control" value="<?php echo e(@$user->inventorContactInfo->company_phone); ?>"
          name="contact_info[company_phone]" required="required" placeholder=""> <!-- name="EmailID" -->
        </div>
      </div>

      <div class="col-md-4 px-0 px-md-2">
        <div class="form-group mb-0">
          <label for="VirtualShowRoom">Virtual Show Room</label></span>
          <input id="VirtualShowRoom" type="text"  class="form-control" value="<?php echo e(@$user->virtual_show_room); ?>"
          name="virtual_show_room" placeholder=""> <!-- name="EmailID" -->
        </div>
      </div>
    </div>
  </div>

  <!-- <hr> -->

  <div class="col-md-12 px-0 px-md-2">
    <div class="row sectionBox">
      <h3 class="sec_head_text w-100">Contact Information</h3>
      <div class="col-lg-3 px-0 px-md-2">
        <div class="form-group">
          <label for="Email" class="d-flex">Primary Email<span class="text-danger">*</span> &nbsp<span class="fontTwelve text-danger" style="margin-top: 2px;"> Hide? </span> <input id="hide_email" type="checkbox" name="hide_email" value="1" style="width: 15px;"  <?php if(!empty($user->hide_email)): ?><?php echo e('checked'); ?> <?php endif; ?> class="form-control mt-1"></label>
          <?php if($user->type_of_user == 1): ?>
          <input id="Email" type="Email" readonly="" name="Email" value="<?php echo e($user->email); ?>"class="form-control" placeholder="">
          <?php else: ?> 
          <input id="Email" type="Email" name="Email" value="<?php echo e($user->email); ?>"class="form-control" placeholder="">
          <?php endif; ?>
        <!-- <span>
        Visible Email
          <input id="hide_email" type="checkbox" name="hide_email" value="1"  <?php if(!empty($user->hide_email)): ?><?php echo e('checked'); ?> <?php endif; ?> class="form-control" placeholder="">
        </span> -->
      </div>
    </div>
    <!-- <div class="col-lg-3 px-0 px-md-2">
      <div class="form-group">
        <label for="Phone">Primary Phone</label>
        <input id="Phone" type="number" disabled="" name="phone_number" value="<?php echo e($user->phone_number); ?>" class="form-control" placeholder="">
      </div>
    </div> -->
    <div class="col-lg-3 px-0 px-md-2">
      <div class="form-group">
        <label for="Mobile">Telephone &nbsp<span class="fontTwelve text-danger" style="margin-top: 2px;"> Hide? </span> <input id="hide_telephone" type="checkbox" class="mt-1" name="hide_telephone" value="1" style="width: 15px;"  <?php if(!empty($user->hide_telephone)): ?><?php echo e('checked'); ?> <?php endif; ?>></label> 
        <input id="Mobile" type="text" name="mobile" value="<?php echo e(@$str_mobile_no_new); ?>" class="form-control" placeholder="">
      </div>
    </div>
    <div class="col-lg-3 px-0 px-md-2">
      <div class="form-group">
        <label for="Email">Secondary Email &nbsp<span class="fontTwelve text-danger" style="margin-top: 2px;"> Hide? </span> <input id="hide_secondary_email" type="checkbox" class="mt-1" name="hide_secondary_email" value="1" style="width: 15px;"  <?php if(!empty($user->hide_secondary_email)): ?><?php echo e('checked'); ?> <?php endif; ?>></label> 
        <input id="secondary_email" type="Email" name="secondary_email" value="<?php echo e($user->secondary_email); ?>"class="form-control" placeholder="">
      </div>
    </div>
    <!-- </div> -->
    <!-- <div class="row"> -->
      <div class="col-lg-3 px-0 px-md-2">
        <div class="form-group ">
          <label for="Phone">Secondary Phone</label>
          <input id="secondary_phone" type="number" name="secondary_phone_number" value="<?php echo e($user->secondary_phone_number); ?>" class="form-control" placeholder="">
        </div>
      </div>
      <div class="col-lg-3 px-0 px-md-2">
        <div class="form-group">
          <label for="Mobile">Secondary Mobile</label>
          <input id="secondary_mobile" type="number" name="secondary_mobile" value="<?php echo e($user->secondary_mobile); ?>" class="form-control" placeholder="">
        </div>
      </div>
      <div class="col-lg-3 px-0 px-md-2">
        <div class="form-group">
          <label for="PostalAddress">Postal Address</label>
          <textarea class="form-control" rows="1" id="PostalAddress" name="postal_address"  placeholder=""><?php echo e($user->postal_address); ?></textarea>
        </div>
      </div>
      <div class="col-lg-3 px-0 px-md-2">
        <div class="form-group">
          <label for="State">State</label>
          <input id="State" type="text" name="state" value="<?php echo e($user->state); ?>" class="form-control" placeholder="">
        </div>
      </div>
      <div class="col-lg-3 px-0 px-md-2">
        <div class="form-group">
          <label for="City">City</label>
          <input id="City" type="text" name="city" value="<?php echo e($user->city); ?>" class="form-control" placeholder="">
        </div>
      </div>
      <!-- </div> -->
      <!-- <div class="row"> -->
        <div class="col-lg-3 px-0 px-md-2">
          <div class="form-group">
            <label for="Postcode/Zipcode">Postcode/Zipcode</label>
            <input id="PostcodeZipcode" type="text" name="zip_code" value="<?php echo e($user->zip_code); ?>" class="form-control"
            placeholder="">
          </div>
        </div>
        <div class="col-lg-3 px-0 px-md-2">
          <div class="form-group">
            <label for="Country">Country</label><span class="text-danger">*</span>
            <select name="country_id" class="form-control select2">
              <option value="">Choose</option>
              <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($id); ?>" <?php echo e($id == @$user->country_id ? 'selected' : ''); ?>><?php echo e($name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        </div>
        <div class="col-lg-3 px-0 px-md-2">
          <div class="form-group">
            <label for="business_address">Business Address</label>
            <textarea class="form-control" rows="1" name="business_address" id="business_address" placeholder=""><?php echo e($user->business_address); ?></textarea>
          </div>
        </div>
        <div class="col-lg-3 px-0 px-md-2">
          <div class="form-group">
            <label for="city_business">Business Address City</label>
            <input id="city_business" type="text" name="city_business" value="<?php echo e($user->city_business); ?>" class="form-control"
            placeholder="">
          </div>
        </div>
        <div class="col-lg-3 px-0 px-md-2">
          <div class="form-group">
            <label for="state_business">Business Address State</label>
            <input id="state_business" type="text" name="state_business" value="<?php echo e($user->state_business); ?>" class="form-control"
            placeholder="">
          </div>
        </div>
        <div class="col-md-6 px-0 px-md-2">
          <div class="form-group">
            <label for="zip_code_business">Business Address Postcode/Zipcode</label>
            <input id="zip_code_business" type="text" name="zip_code_business" value="<?php echo e($user->zip_code_business); ?>" class="form-control"
            placeholder="">
          </div>
        </div>
        <div class="col-md-6 px-0 px-md-2">
          <div class="form-group">
            <label for="country_id_business">Business Address Country</label>
            <select name="country_id_business" class="form-control select2 country_id">
              <option value="">Choose</option>
              
                <?php if(!empty($user->country_id) ): ?>
                <?php @$country_id = @$user->country_id; ?>
                <?php endif; ?>
                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>" <?php echo e(($id == @$country_id) ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
          </div>
          <div class="col-lg-3 px-0 px-md-2">
            <div class="form-group mb-0">
              <label for="Website">Website</label><!-- <span class="text-danger">*</span>-->
              <input id="Website" type="text" name="website" value="<?php echo e($user->website); ?>" class="form-control" placeholder="">
            </div>
          </div>
          <div class="col-lg-3 px-0 px-md-2">
            <div class="form-group mb-0">
              <label for="Website">Pronouns</label><span class="text-danger">*</span>
              <select name="pronoun" class="form-control">
                <option value="">Choose</option>
                <option value="He/Him/His" <?php echo e('He/Him/His'===@$user->pronoun ? 'selected' : ''); ?>>He/Him/His</option>
                <option value="She/Her/Hers" <?php echo e('She/Her/Hers'===@$user->pronoun ? 'selected' : ''); ?>>She/Her/Hers</option>
                <option value="They/Them/Theirs" <?php echo e('They/Them/Theirs'===@$user->pronoun ? 'selected' : ''); ?>>They/Them/Theirs</option>
                <option value="not-specify" <?php echo e('not-specify'===@$user->pronoun ? 'selected' : ''); ?>>Prefer not to specify</option>
              </select>
            </div>
          </div>

        </div>
      </div>

      
      <div class="col-md-12 px-0 px-md-2">
        <div class="row sectionBox">
          <h3 class="sec_head_text w-100 bg-white">Social Media</h3>
          <div class="no-all-socail-icon row sectionBox">
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
      </div>
      <div class="col-md-12">
        <div class="row sectionBox">
          <h3 class="sec_head_text w-100">What Skills & Expertise do you provide?</h3>
          <div class="col-md-12">
            <div class="form-group mb-0">
              <label for="Skills">Skills</label><span class="text-danger">*</span>
              <div class="tags-input" id="myTags">                  
               <?php echo $__env->make("front.profile.user_skills_dropdown", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    
             </div>
           </div>
         </div>

         <div class="col-md-6">
          <label for="dateofbirth">Date of birth </label><span class="text-danger"></span>

          <!-- <select class="col-sm-4 dmy year" name="dobyear" id="dobyear"></select> -->
          <div class="row">
            <div class="col-3">
              <div class="form-group MonthGroup mb-0">
                <label for="dobmonth">Month</label><br>
                <select class="dmy month" name="dobmonth" id="dobmonth"></select>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group DayGroup mb-0">
                <label for="dobday">Day</label><br>
                <select class="dmy day" name="dobday" id="dobday"></select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <?php echo $__env->make("front.profile.list_innovator_role", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <div class="col-md-12">
      <div class="row sectionBox">
        <button type="button" class="btn btnAll profileEdit">Update Profile <i class="fa fa-spinner fa-spin postLoading" style="display: none;"></i> </button>
      </div>
    </div>

  </form>





</div>
</div>
</div>
<div class="div">
  <?php echo $__env->make("front.profile.add_role_popup", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div>
<?php echo $__env->make("front.includes.cropper_model", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- // preview images by kundan -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
<script src="<?php echo e(asset('backend/plugins/tags.js')); ?>"></script>
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
      height: 600,
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
</script>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script>

 var profile_data_saved_flag = '<?php echo e(Session::has("profile_data_saved_flag")); ?>';

 $(function ($) {

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
  

  $(document).on('click', '.profileEdit', function (e) {
    e.preventDefault();
    $('.postLoading').show();
    $('.profileEdit').attr('disabled', true);      
    if($.trim($('#profileForm  [name="mobile"]').val()) != '' && $('#profileForm  [name="mobile"]').intlTelInput("isValidNumber") == false) {
      toastr.error('<?php echo e(adminTransLang("invalid_mobile_no")); ?>');
      return false;
    }
    
    var fd = new FormData($('#profileForm')[0]);
  // var ckeditor_description_new = document.getElementsByClassName('textBoi');
   // fd.append('description', ckeditor_description_new);
    var phone = $('#profileForm  [name="mobile"]').intlTelInput("getSelectedCountryData");
    $('#profileForm  [name="mobile"]').val(($('#profileForm  [name="mobile"]').val()).replace(/ /g, ''));
    fd.append('dial_code', phone.dialCode);
    var str_company_name = $('#profileForm  [name="contact_info[company_name]"]').val(); 
    
    if(str_company_name == null || str_company_name ==undefined || str_company_name =='' || str_company_name =='undefined')
    {
     str_company_name = ''; 
   }

   fd.append('company_name_new', str_company_name);
   
   $.ajax({
    url: "<?php echo e(route('front.user.profile.edit')); ?>",
    data: fd,
    processData: false,
    contentType: false,
    dataType: 'json',
    type: 'POST',
    success:function(res){  
      if(res.success == 0){
        var err = JSON.parse(res.response);
        var er = '';
        $.each(err, function(k, v) { 
          er += v+'<br>'; 
        }); 
        toastr.error(er,'Error');
        $('.profileEdit').attr('disabled', false);
        $('.postLoading').hide();
      }else if(res.success == 1){
        $('.profileEdit').attr('disabled', false);
        $('.postLoading').hide();
        toastr.success('Profile Updated successfully','Success');
        window.location.replace('<?php echo e(route("front.user.profile.edit")); ?>');
      }
    }
  });
 });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){


    $('#bt_company_list_id').click(function () {
      $('#company_list_id').val('').trigger("change");
    });
    
    
    ajaxSelect2();
    function ajaxSelect2() {
            // Select2 Ajax
            $(document).find(".select-ajax").select2({
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
          }
        })

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