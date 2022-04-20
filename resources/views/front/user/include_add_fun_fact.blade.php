@php
     $str_txt_fun_fact_1_new = "";
	 $str_txt_fun_fact_2_new = "";
	 $str_txt_fun_fact_3_new = "";
	 $str_get_fun_fact_1_new = "";
	 $str_get_fun_fact_2_new = "";
	 $str_get_fun_fact_3_new = "";

 if(!empty($str_chk_page_type_fun_fact_new) && $str_chk_page_type_fun_fact_new =='product')
 {
	 $str_txt_fun_fact_1_new = "product[fun_fact1]";
	 $str_txt_fun_fact_2_new = "product[fun_fact2]";
	 $str_txt_fun_fact_3_new = "product[fun_fact3]";
	 
	 if(!empty($product->fun_fact1))
	 {
	   $str_get_fun_fact_1_new = @$product->fun_fact1;
	 }
	 
	 if(!empty($product->fun_fact2))
	 {
	   $str_get_fun_fact_2_new = @$product->fun_fact2;
	 }
	 
	 if(!empty($product->fun_fact3))
	 {
	   $str_get_fun_fact_3_new = @$product->fun_fact3;
	 }	 
 }
 else
 {
	 $str_txt_fun_fact_1_new = "fun_fact1";
	 $str_txt_fun_fact_2_new = "fun_fact2";
	 $str_txt_fun_fact_3_new = "fun_fact3";
	 
	 if(!empty($user->fun_fact1))
	 {
	   $str_get_fun_fact_1_new = @$user->fun_fact1;
	 }
	 
	 if(!empty($user->fun_fact2))
	 {
	   $str_get_fun_fact_2_new = @$user->fun_fact2;
	 }
	 
	 if(!empty($user->fun_fact3))
	 {
	   $str_get_fun_fact_3_new = @$user->fun_fact3;
	 }
 }	 
 
 
@endphp

<div class="col-md-12 px-0 px-md-2">
      <div class="row sectionBox">
        <h3 class="sec_head_text w-100">Fun Facts</h3>
        <div class="col-md-4 px-0 px-md-2">
          <div class="form-group">
              <label for="fun_fact1">Fun Fact 1</label></span>
              <input id="fun_fact1" type="text" name="{{$str_txt_fun_fact_1_new}}" value="{{@$str_get_fun_fact_1_new}}"
              class="form-control">
          </div>
        </div>
        <div class="col-md-4 px-0 px-md-2">
          <div class="form-group">
              <label for="fun_fact2">Fun Fact 2 </label></span>
              <input id="fun_fact2" type="text" value="{{@$str_get_fun_fact_2_new}}"
              name="{{$str_txt_fun_fact_2_new}}" required="required" class="form-control" placeholder=""> <!-- name="EmailID" -->
          </div> 
        </div>
        <div class="col-md-4 px-0 px-md-2">
          <div class="form-group">
              <label for="fun_fact3">Fun Fact 3</label></span>
              <input id="fun_fact3" type="text"  class="form-control" value="{{@$str_get_fun_fact_3_new}}" 
			  name="{{$str_txt_fun_fact_3_new}}" required="required" placeholder=""> <!-- name="EmailID" -->
          </div>
        </div>
      </div>
    </div>