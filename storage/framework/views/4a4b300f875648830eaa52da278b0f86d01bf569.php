
<?php $__env->startSection('content'); ?>
<?php
$str_current_url =  url()->current();
$base_url = url('/');
$user_current_info = get_current_user_info();
$arr_menu_list = App\Helpers\UtilitiesTwo::getMenuLinks($base_url, $user_current_info);
$str_link_drop_menu_dictionary_random = $arr_menu_list['str_link_drop_menu_dictionary_random'];

$str_current_date_new = date('Y-m-d');

$int_recent_words_count_flag = 1;
?>
<style>

.searchFormHead {
    margin-left: 0 !important;
}

</style>

<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
<section class="dictionarySection">
   <div class="container mx-auto dictionaryContainer">
      <div class="col-md-12">
         <div class="dictionaryHeadBanner text-center">
            <img src="<?php echo e(asset('front/images/pop-dic-banner.png')); ?>" alt="profileimage" class="img-fluid">
         </div>
      </div>
      <div class="col-md-12">
        <div class="row">
           <div class="col-md-12">
              <h3 class="headTextDictonary">Find a term...</h3>
           </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row searchDictionary">
           <div class="col-lg-4 col-sm-12">
              <form class="form-inline mt-2 my-lg-0 searchFormHead" action="#">
                 <?php echo csrf_field(); ?>
                 <div class="w-100 d-flex">
                    <div class="w-100">
                       <div class="form-group has-search mb-0" id="home-site-search-dictionary-input-div-main">
                          <span class="fa fa-search form-control-feedback"></span>
                          <input id="home-site-search-dictionary-input" name="home-site-search-dictionary-text-name" class="form-control top-search-bar-class-new" type="text" placeholder="Search POP" aria-label="Search"  style="padding-left: 22px;"  placeholder="Search POP Dictionary">
                       </div>
                    </div>
                 </div>
              </form>
           </div>
           <div class="col-lg-4 col-sm-6 randomword">
            <div class="clickRandomInner">
            <p class="text-white text-center mb-2 mb-lg-0">
              <a href="<?php echo e($str_link_drop_menu_dictionary_random); ?>" class="btn">Show me a Random Word!</a>
            </p>
         </div>
           </div>
           <div class="col-lg-4 col-sm-6 clickSubmit">
               <div class="clickSubmitInner">
                  <p class="text-white text-center mb-2 mb-lg-0"><a class="text-white btn" href="<?php echo e(route('front.user.dictionary.create')); ?>">Click Here to Submit a Term!</a></p>
               </div>
            </div>
        </div>
      </div>
      <div class="dictionaryContainer2">
      
	  
      <div class="col-md-12 mt-4">
         <h3 class="headTextDictonary">
            <?php if($str_current_date_new == @$arr_dictionary_data[5]): ?>         
            <?php echo e('Word of the day'); ?>

            <?php else: ?>
            <?php echo e('Random Word'); ?>

            <?php endif; ?>          
         </h3>
         <div class="row">
         <div class="col-xl-6 col-md-6">
            <?php echo $__env->make("front.includes.include_word_of_day", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>			
</div>
           <!--  <div class="col-xl-4 col-md-6 clickSubmit">
               <div class="clickSubmitInner">
                  <p class="text-white text-center mb-0"><a class="text-white" href="<?php echo e(route('front.user.dictionary.create')); ?>">Click Here to Submit a Term!</a></p>
               </div>
            </div> -->
            <div class="col-xl-6 col-md-6 offerImgDictonary">
              <div class="mx-auto starBackground" style="background-image: url('<?php echo e(asset('front/images/offerImage.png')); ?>');">
                <h2 class="textOverBackground" >Word games coming soon</h2>
              </div>
            </div>
         </div>
      </div>
	  
	  <?php if(!empty($dictionary_list) && count($dictionary_list)>0): ?>
	  
      <div class="col-xl-6 col-md-6">
        <div class="row recentHead">
           <div class="col-md-12">
              <h3 class="headTextDictonary">Recent Words of the Day</h3>
           </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
		
		 <?php $__currentLoopData = $dictionary_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dictionary_list_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
			 <?php
			 
			 
				 if($int_recent_words_count_flag == 1)
				 {
				   $str_dictionary_background_color = '#D9D2E9';	 
				 }
				 else if($int_recent_words_count_flag == 2)
				 {
				   $str_dictionary_background_color = '#D9EAD3';	 
				 }
				 else
				 {
				   $str_dictionary_background_color = '#FFF2CC';	 
				 }
			 
				 $str_dictionary_url = '';
				 $base_url = url('/');
				 $user_current_info_new = @$dictionary_list_row->user;
				 $str_user_name = '';
				 
				 if(@$user_current_info_new->role == 2 || @$user_current_info_new->role == 3)
				 {
				   $str_user_url_new = @App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);  
				   $str_user_name = @App\Helpers\Utilities::getUserName($user_current_info_new);
				 }
				 else
				 {
				   $str_user_url_new = "#";
				   $str_user_name = Config::get('commonconfig.web_site_name_new');                
				 }
				 
				 $str_dictionary_slug = @$dictionary_list_row->slug;
				 $str_dictionary_url = @App\Helpers\UtilitiesFour::getDictionaryUrl($base_url, $str_dictionary_slug);
				 $int_recent_words_count_flag++;
			 ?>
         <div class="col-xl-6 col-md-6">
            <div class="cardBox mb-4" style="background-color: <?php echo e($str_dictionary_background_color); ?>;">
              <div class="row">
                <div class="col-md-8 col-8">
                  <h3><?php echo e(@$dictionary_list_row->title); ?></h3>
                </div>
                <div class="col-md-4 col-4">
                  <div class="pull-right">
                      <div class="dropdown socialDropdown">
                         <span class="fontWeightSix myDropdownBtn dropdown-toggle" data-toggle="dropdown"> <a href="#" class="photo_icon fa fa-ellipsis-h"></a></span>
                         <div class="dropdown-content1 socialDropdownContent dictionaryShare dropdown-menu">
                            <ul class="dropSocialShare">
                               <li><a href="javascript:void(0);" onclick="return copyToClipboard('#hid_dictionary_url_<?php echo e($int_recent_words_count_flag); ?>');"><i class="fa photo_icon fa-clone"></i></a></li>
                               <li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo e($str_dictionary_url); ?>"><i class="fa photo_icon fa-facebook"></i></a></li>
                               <li><a target="_blank" href="http://twitter.com/share?url=<?php echo e($str_dictionary_url); ?>"><i class="fa photo_icon fa-twitter"></i></a></li>
                               <li><a target="_blank" href="https://www.instagram.com/?url=<?php echo e($str_dictionary_url); ?>"><i class="fa photo_icon fa-instagram"></i></a></li>
                               <li><a target="_blank" href="https://wa.me/?text=<?php echo e($str_dictionary_url); ?>"><i class="fa photo_icon fa-whatsapp"></i></a></li>
                               <input type="hidden" name="hid_dictionary_url_<?php echo e($int_recent_words_count_flag); ?>" id="hid_dictionary_url_<?php echo e($int_recent_words_count_flag); ?>" value="<?php echo e($str_dictionary_url); ?>"> 
							</ul>
                         </div>
                      </div>
                  </div>
                </div>
              </div>
               <div class="mt-3">
                  <p><?php echo e(@$dictionary_list_row->description); ?> </p>
                  <p class="bottomText">Submitted by <a href="<?php echo e($str_user_url_new); ?>"><?php echo e(@$str_user_name); ?></a> on <span><?php echo e(@App\Helpers\UtilitiesTwo::get_date_from_date_time_data(@$dictionary_list_row->date_to_be_published)); ?></span></p>
               </div>
            </div>
         </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         
      </div>
      </div>
	  
	  <?php endif; ?>
	  
      
   </div>
   </div>
</section>
            </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>      
      
   $(document).ready(function(){
   
    get_autocomplete_dictionary_search_data_new("home-site-search-dictionary-input");
   
   });
   
   
   function get_autocomplete_dictionary_search_data_new(input_text_id)  
   
   {   
   
      $("#"+input_text_id).autocomplete({
   
           source: function( request, response ) {
   
         // Fetch data
   
         $.ajax({
   
        url: base_url_new + '/home/get-ajax-site-dictionary-data',
   
        type: 'post',
   
        dataType: "json",
   
        data: {
   
         search: request.term,
   
         token: ajax_csrf_token_new,
   
        },
   
        headers: {
   
         'X-CSRF-TOKEN': ajax_csrf_token_new
   
        },
   
        success: function( data ) {
   
         response( data );
   
        }
   
         });
   
        },
   
      minLength: 1
   
       }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
   
      
      var item_image = '';
      var item_type = 0;
   
      item_type = item.type;
   
      var full_image_upload_path_new = '';
      var item_link_slug_prefix = '';
      var str_slug_prefix_new = '';
      
        str_slug_prefix_new =  '/pop-dictionary';   
   
        var inner_html = '<a href="' + base_url_new + str_slug_prefix_new + '/' + item.slug + '"><div class="list_item_container"><div class="image"><span class="label">' + item.title + '</span></div></div></a>';
   
           return $( "<li></li>" )
   
               .data( "item.ui-autocomplete", item )
               .append(inner_html)
               .appendTo( ul );
   
       }
   
    
    }
      
</script>   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>