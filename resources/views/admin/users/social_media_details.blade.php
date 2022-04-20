<style>
    .social_media .form-group {
         margin-right: 0px; 
         margin-left: 0px; 
    }
</style>
<div class="accordion__header">
    <h2>Social Media</h2>
    <span class="accordion__toggle"></span>
</div>
<div class="accordion__body">
    <div class="row social_media">
        @foreach(config('cms.social_media') as $index => $social)
			@php
                $str_social_val = '';
                if(!empty($user->socialMedia))
                {	  
                    $str_social_val = @$user->socialMedia->pluck('value','type')->toArray()[$index];
                }
			@endphp 
            <div class="col-md-3" >
                <div class="form-group" style="margin-bottom:22px;">
                    <label for="{{ $social }}">{{ $social }}</label>
                    <input type="url" id="{{ $social }}" name="socials[{{$index}}]" value="{{$str_social_val}}" class="social form-control">
                    <span class="error" id="error_{{$social}}"></span>
                </div>
            </div>
        @endforeach
    </div>
</div>