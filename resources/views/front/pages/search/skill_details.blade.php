@extends('front.layouts.pages')
@section('content')

@php
	$base_url = url('/'); 
	$def_user_image_path = App\Helpers\Utilities::get_default_image();
	
@endphp
<style>
	.select2.select2-container{
		min-width: 240px!important;
	}
	.select2.select2-container.select2-container--default{
		min-width: 240px!important;
	}
</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="left-column paddingTwenty border_right AdvceSearch">
      <div class="First-column bg-white p-3">
<div class="wrap-text text-white pb-3 pt-0">
    	<p class="m-0 font-weight-normal" style="font-size: 22px;">Results for <b class="font-weight-normal">"{{ @$slug}}"</b></p>
</div>

  <?php if(isset($result_data['inventor_users']) && count($result_data['inventor_users'])>0){ ?>
 <h4 class="font-weight-normal">People</h4>
 <?php  foreach ($result_data['inventor_users'] as $ckey => $row_people) { ?>
 	<div class="col-12 mb-2">
	<a href="{{ url('people/'.$row_people->slug) }}"><img src="{{ @imageBasePath($row_people->image) }}" class="rounded-circle" width="60" height="60"> </a>
	<a href="{{ url('people/'.$row_people->slug) }}" class="ml-3"><span>{{ $row_people->name }}</span></a> 
  </div>
<?php } ?>

<?php } ?>
  <?php if(isset($result_data['company_users']) && count($result_data['company_users'])>0){ ?>
 <h4 class="font-weight-normal">Company</h4>
<?php  foreach ($result_data['company_users'] as $ckey => $row_company) { ?>
	<div class="col-12 mb-2">
	<a href="{{ url('company/'.$row_company->slug) }}"><img src="{{ @imageBasePath($row_company->image) }}" class="rounded-circle" width="60" height="60"> </a>
	<a href="{{ url('company/'.$row_company->slug) }}" class="ml-3"><span>{{ $row_company->name }}</span></a>
	 </div>
<?php } ?>
<?php } ?>


  <?php if(isset($result_data['products']) && count($result_data['products'])>0){ ?>
 <h4 class="font-weight-normal">Product</h4>
<?php  foreach ($result_data['products'] as $pkey => $row_product) { ?>
	<div class="col-12 mb-2">
	<a href="{{ url('product/'.$row_product->slug) }}"><img src="{{ @imageBasePath($row_product->image) }}" class="rounded-circle" width="60" height="60"> </a>
	<a href="{{ url('product/'.$row_product->slug) }}" class="ml-3"><span>{{ $row_product->name }}</span></a>
	 </div>
<?php } ?>
<?php } ?>
</div>
</div>
</div>
@endsection
