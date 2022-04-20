<div class="col-md-4 col-12 pl-0 mt-2">
   <div class="py-3 px-3 mb-3 funFactBox" id="fun_fact_main_div_{{$str_fun_fact_div}}" style="background-color: {{$str_fun_fact_background_color}};">
      <p class="p-text">
      <div id="div_limit_{{$str_fun_fact_div}}">
         <p>{!! @App\Helpers\UtilitiesTwo::get_fun_fact_data(@$str_fun_fact_content, $int_fun_fact_description_words_length) !!}
         </p>
      </div>
	  <!-- if the no of characters are more than the limit -->
      @if($int_fun_fact_word_length > $int_fun_fact_description_words_length)
      <div id="d_dots_{{$str_fun_fact_div}}"></div>
      <div id="d_more_{{$str_fun_fact_div}}" style="display:none;">
         <p>{!! @App\Helpers\UtilitiesTwo::get_fun_fact_data(@$str_fun_fact_content, $int_fun_fact_word_length)!!} </p>
      </div>
      <a data-toggle="modal" class="funFactReadMore text-dark" onclick="d_myFunction('{{$str_fun_fact_div}}')" id="d_myBtn_{{$str_fun_fact_div}}">Read More...</a>
      @endif
      </p>
   </div>
</div>
