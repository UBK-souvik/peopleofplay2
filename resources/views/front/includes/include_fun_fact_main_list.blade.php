@php
$int_fun_fact_word_size_new  = @App\Helpers\UtilitiesTwo::get_fun_fact_word_size_new();
@endphp

<script>
	var int_fun_fact_word_length_js_1 = 0;
	var int_fun_fact_word_length_js_2 = 0;
	var int_fun_fact_word_length_js_3 = 0;
	
	var int_fun_fact_no_of_word_size_js_1 = 0;
	var int_fun_fact_no_of_word_size_js_2 = 0;
	var int_fun_fact_no_of_word_size_js_3 = 0;
	
	var int_fun_fact_word_size_new_js = {{$int_fun_fact_word_size_new}};
	
</script>
						
              @if(!empty(@$obj_data_new->fun_fact1) || !empty(@$obj_data_new->fun_fact2) || !empty(@$obj_data_new->fun_fact2) )
                
			  		
                  <div class="row mx-0">
                  	<div class="col-md-12 pl-0">
                  		<h2 class="sec_head_text text-left w-100">Fun Facts:</h2>
                  	</div>
                  	
                    @if(!empty(@$obj_data_new->fun_fact1) )
						@php	
						 $str_fun_fact_content = @$obj_data_new->fun_fact1;
						 $str_fun_fact_content = @App\Helpers\UtilitiesTwo::get_limit_words_data($str_fun_fact_content);
						 $str_fun_fact_div = 'fun_fact_1';
						 $int_fun_fact_word_length = @App\Helpers\UtilitiesTwo::no_of_chars_length($str_fun_fact_content);
                         $int_fun_fact_words_size = @App\Helpers\UtilitiesTwo::no_of_words_size($str_fun_fact_content);						 
						 $str_fun_fact_background_color = '#FF7EB9FF';
						@endphp					
						<script>
						  var int_fun_fact_word_length_js_1 = {{$int_fun_fact_word_length}};
						  var int_fun_fact_no_of_word_size_js_1 = {{$int_fun_fact_words_size}};
						</script>
						@include("front.includes.include_fun_fact_box")					
					@endif
                    @if(!empty(@$obj_data_new->fun_fact2) )
						@php	
						 $str_fun_fact_content = @$obj_data_new->fun_fact2;
						 $str_fun_fact_content = @App\Helpers\UtilitiesTwo::get_limit_words_data($str_fun_fact_content);
						 $str_fun_fact_div = 'fun_fact_2';
						 $int_fun_fact_word_length = @App\Helpers\UtilitiesTwo::no_of_chars_length($str_fun_fact_content);
                         $int_fun_fact_words_size = @App\Helpers\UtilitiesTwo::no_of_words_size($str_fun_fact_content);						 
						 $str_fun_fact_background_color = '#F3E779FF';
						@endphp					
						<script>
						  var int_fun_fact_word_length_js_2 = {{$int_fun_fact_word_length}};
						  var int_fun_fact_no_of_word_size_js_2 = {{$int_fun_fact_words_size}};
						</script>
						@include("front.includes.include_fun_fact_box")					
					@endif
					@if(!empty(@$obj_data_new->fun_fact3) )
						@php	
						 $str_fun_fact_content = @$obj_data_new->fun_fact3;
						 $str_fun_fact_content = @App\Helpers\UtilitiesTwo::get_limit_words_data($str_fun_fact_content);
						 $str_fun_fact_div = 'fun_fact_3';
						 $int_fun_fact_word_length = @App\Helpers\UtilitiesTwo::no_of_chars_length($str_fun_fact_content);
                         $int_fun_fact_words_size = @App\Helpers\UtilitiesTwo::no_of_words_size($str_fun_fact_content); 						 
						 $str_fun_fact_background_color = '#7AFCFFFF';
						@endphp					
						<script>
						  var int_fun_fact_word_length_js_3 = {{$int_fun_fact_word_length}};
						  var int_fun_fact_no_of_word_size_js_3 = {{$int_fun_fact_words_size}};
						</script>
						@include("front.includes.include_fun_fact_box")					
					@endif
                 </div>
        
              @endif