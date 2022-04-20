@extends('front.layouts.pages')
@section('content')


<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="left-column paddingTwenty border_right AdvceSearch">
      <div class="First-column bg-white p-3">
<!-- Keywords Design-->
<div class="col-md-12">
<div class="SearchKeywords ab_links">
   <div class="InterestingKeywords mb-3">
 <h3 class="font-weight-normal"> Browse Interesting Keywords</h3>
</div>
<div class="widget_content no_inline_blurb pl-2">
   <div class="widget_nested d-flex">
       @php 
         @$totalSkill = count($skill_list);
         @$halfSkill = @$totalSkill/2;
         @$halfSkill =   round(@$halfSkill);
         @endphp

 @foreach($skill_list as $skey => $srow)
 @if(@$halfSkill >$skey)
  @if($skey==0)
      <div class="w-50 skillListColOne">
   @endif
           <span class="nav-item font-weight-normal">
             <a class="nav-link p-0 pb-1 font-weight-normal" href="{{ url('skill/'.$srow->name)}}">{{ $srow->name}}
               <small class="totalCountRole"> @php 
                echo  '('.App\Helpers\UtilitiesTwo::skillsListCountUser($srow->name).')'; 
              @endphp
              </small>
             </a>
           </span>
   @if($skey == @$halfSkill-1)
      </div>
   @endif
@else
 @if($skey == @$halfSkill)
      <div class="w-50 skillListColTwo">
         @endif
           <span class="nav-item">
             <a class="nav-link p-0 pb-1" href="{{ url('skill/'.$srow->name)}}">{{ $srow->name}}
               <small class="totalCountRole"> @php 
                echo  '('.App\Helpers\UtilitiesTwo::skillsListCountUser($srow->name).')'; 
              @endphp
              </small>
             </a>
           </span>
           @if($skey == @$totalSkill-1)
      </div>
    @endif
    @endif
@endforeach
   </div>
</div>
</div>
</div>


<!-- Keywords Design-->
      </div>
   </div>
</div>
@endsection
