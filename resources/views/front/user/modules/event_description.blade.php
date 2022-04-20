<hr>
<p class="p-text">
    {!! @App\Helpers\UtilitiesTwo::limit_words($event->description, 0, $int_description_words_length) !!}
  	@if( $int_event_word_length > $int_description_words_length)
		  <span id="d_dots"></span><span id="d_more">{!! @App\Helpers\UtilitiesTwo::limit_words($event->description, $int_description_words_length, $int_event_word_length) !!}</span>
		  <a href="#" data-toggle="modal" class="readMore" onclick="d_myFunction()" id="d_myBtn">Read More...</a>
	@endif
</p>							
<hr>	