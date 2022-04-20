@if((!empty($social_media_array_type) && count($social_media_array_type) > 0) && (!empty($social_media_array_value) && count($social_media_array_value)>0))
  <div class="col-md-12">
      <div class="row sectionBox socialmediaicon">
          <h2 class="sec_head_text text-left w-100">Social Media 
            @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id)
            <a href="{{ $str_profile_user_edit }}" class="move_edit_page" title="Edit Social Media"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            @endif
          </h2>
          <div class="w-100 SocialMedia">
              {!!App\Helpers\TemplateFunctions::getSocialMediaIcons($social_media_array_value, $social_media_array_type, 0, count($social_media_array_value))!!}
          </div>
      </div>
  </div>
@endif
@if((!empty($social_media_array_value) && count($social_media_array_value) > 5))
<div class="col-md-12">
  <div class="row sectionBox py-0 socialmedia" style="border: none;">
        <div id="demo" class="collapse w-100">
          {!!App\Helpers\TemplateFunctions::getSocialMediaIcons($social_media_array_value, $social_media_array_type, 5, 30)!!}
        </div>
    <!--  <div style="padding-bottom: 20px;">
       <a id="btn-expand-collapse-social-media-icons" onclick="return getExpandCollapseClass();" class="span-style1" data-toggle="collapse" data-target="#demo">Expand</a>
     </div>  -->
    
  </div>
</div>
<!-- </div> -->
  
@endif

    