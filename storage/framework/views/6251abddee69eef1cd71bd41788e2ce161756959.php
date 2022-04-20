 <?php 
 $str_page_name = Request::segment(1);   
 $advertisement_category_data = \App\Models\AdvertisementCategory::where('status', 1) 
 ->where('page_name', $str_page_name)
 ->first();
 $advertisement_category_id = 6;
 if(!empty($advertisement_category_data->id))
 {
    $advertisement_category_id = $advertisement_category_data->id;   
 }
 $advertisement = \App\Models\Advertisement::where(['advertisement_category' => $advertisement_category_id, 'advertisement_position' => 5])
 // ->whereRaw('? between from_date and to_date', [date('Y-m-d')])
 ->orderBy('id','desc')
 ->first();
 ?>
 <?php if(!empty($advertisement) && isset($advertisement->destination_link)): ?>
  <div class="col-md-2 AdvertisementColumn">
    <div class="AdsImage">
      <a href="<?php echo e(@$advertisement->destination_link); ?>" class="span-style1" target="_blank">
        <img src="<?php echo e(@imageBasePath(@$advertisement->advertisement_image)); ?>" class="img-fluid mb-2">
        <h3 class="imgHead text-center"> <?php echo e(@$advertisement->sponsor_name); ?></h3>
      </a>
    </div>
  </div>
 <?php endif; ?>
