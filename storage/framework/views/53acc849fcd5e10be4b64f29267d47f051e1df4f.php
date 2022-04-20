<?php if(!empty(@$dictionary_detail[0]->title)): ?>		 
<div class="w-100 TruthsLieMini">
   <div class="cardBox greenBg">
      <div class="row">
         <div class="col-md-8 col-8">
            <h3 class="mb-0">Word of the Day</h3>
         </div>
         <div class="col-md-4 col-4">
            <div class="pull-right">
               <div class="dropdown socialDropdown">
                  <span class="fontWeightSix myDropdownBtn" data-toggle="dropdown"> <a href="#" class="photo_icon fa fa-ellipsis-h"></a></span>
                  <div class="dropdown-content1 socialDropdownContent dictionaryShare dropdown-menu">
                     <ul class="dropSocialShare">
                        <li><a href="javascript:void(0);" onclick="return copyToClipboard('#hid_current_url');"><i class="fa photo_icon fa-clone"></i></a></li>
                        <li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo e(@$arr_dictionary_data[4]); ?>"><i class="fa photo_icon fa-facebook"></i></a></li>
                        <li><a target="_blank" href="http://twitter.com/share?url=<?php echo e(@$arr_dictionary_data[4]); ?>"><i class="fa photo_icon fa-twitter"></i></a></li>
                        <li><a target="_blank" href="https://www.instagram.com/?url=<?php echo e(@$arr_dictionary_data[4]); ?>"><i class="fa photo_icon fa-instagram"></i></a></li>
                        <li><a target="_blank" href="https://wa.me/?text=<?php echo e(@$arr_dictionary_data[4]); ?>"><i class="fa photo_icon fa-whatsapp"></i></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>   
      </div>
      <hr>
      <div class="row">
         <div class="col-md-12">
            <span style="font-size: 17px;  font-weight: 500;"><?php echo e(@$dictionary_detail[0]->title); ?></span>
         </div>
      </div>
      <input type="hidden" name="hid_current_url" id="hid_current_url" value="<?php echo e(@$arr_dictionary_data[4]); ?>">
                     
      <div class="mt-2">
         <p style="font-size: 14px;"><?php echo e(@$dictionary_detail[0]->description); ?> </p>
         <p class="bottomText">Submitted by <a href="<?php echo e(@$arr_dictionary_data[0]); ?>"><?php echo e(@$arr_dictionary_data[1]); ?></a> <!-- on <span><?php echo e(@App\Helpers\UtilitiesTwo::get_date_from_date_time_data(@$dictionary_detail[0]->date_to_be_published)); ?></span> --></p>
      </div>
   </div>
</div>
<?php endif; ?>