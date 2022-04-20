  @if(@$fun_fact1 !='' || @$fun_fact2 !='' || @$fun_fact3 !='')
<div class="col-12  pb-3">
   <div class="popFunFact">
      <h3 class="sec_head_text w-100">Fun Facts 
          @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id)
            @if(@$editFunfacts == 1 )
            <a href="{{ $str_profile_user_edit }}" class="move_edit_page" title="Edit Social Media"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            @endif
            @endif
      </h3>
      <div class="card-deck">
          @if(!empty(@$fun_fact1))
         <div class="card text-white mr-md-0 col-md-4" style="background-color: #652b91!important;">
            <div class="card-body text-center">
               @if(!empty(@$fun_fact1) && strlen(@$fun_fact1) >40)
               <div class="ff1_read_less"><?php if(@$fun_fact1) { echo @App\Helpers\UtilitiesTwo::get_fun_fact_data(@$fun_fact1, 40); } ?>
                  <br>
                  <a href="javascript:void(0);" class="btn d-inline-block fun_fact_1_btn_more"  onclick="fun_fact1_readmore();" >More</a>
               </div>
               @else 
               <div class="ff1_read_less"><?php if(@$fun_fact1) { echo  @$fun_fact1; } ?></div>
                  @endif
               <div class="ff1_read_more" style="display: none;"><?php if(@$fun_fact1) { echo   @$fun_fact1; } ?>
                  <br>
                  <button class="readMore fun_fact_1_btn_less ProfileReadMore" style="display: none;" onclick="fun_fact1_readless();">Less</button>
               </div>
            </div>
         </div>
           @endif
            @if(!empty(@$fun_fact2))
         <div class="card bg-warning text-white mr-md-0 col-md-4">
            <div class="card-body text-center">
               <div class="card-body text-center">
                  @if(!empty(@$fun_fact2) && strlen(@$fun_fact2) >40)
                  <div class="ff2_read_less"><?php if(@$fun_fact2) { echo @App\Helpers\UtilitiesTwo::get_fun_fact_data(@$fun_fact2, 40); } ?>
                     <br>
                     <a href="javascript:void(0);" class="btn d-inline-block fun_fact_2_btn_more"  onclick="fun_fact2_readmore();" >More</a>
                  </div>
                  @else 
                  <div class="ff2_read_less"><?php if(@$fun_fact2) { echo  @$fun_fact2; } ?></div>
                     @endif
                  <div class="ff2_read_more" style="display: none;"><?php if(@$fun_fact2) { echo   @$fun_fact2; } ?>
                     <br>
                     <button class="readMore fun_fact_2_btn_less ProfileReadMore" style="display: none;" onclick="fun_fact2_readless();">Less</button>
                  </div>
               </div>
            </div>
         </div>
          @endif
           @if(!empty(@$fun_fact3))
         <div class="card text-white bg-success col-md-4">
            <div class="card-body text-center">
               <div class="card-body text-center">
                  @if(!empty(@$fun_fact3) && strlen(@$fun_fact3) >40)
                  <div class="ff3_read_less"><?php if(@$fun_fact3) { echo @App\Helpers\UtilitiesTwo::get_fun_fact_data(@$fun_fact3, 40); } ?>
                     <br>
                     <a href="javascript:void(0);" class="btn d-inline-block fun_fact_3_btn_more"  onclick="fun_fact3_readmore();" >More</a>
                  </div>
                  @else 
                  <div class="ff3_read_less"><?php if(@$fun_fact3) { echo  @$fun_fact3; } ?></div>
                     @endif
                  <div class="ff3_read_more" style="display: none;"><?php if(@$fun_fact3) { echo   @$fun_fact3; } ?>
                     <br>
                     <button class="readMore fun_fact_3_btn_less ProfileReadMore" style="display: none;" onclick="fun_fact3_readless();">Less</button>
                  </div>
               </div>
            </div>
         </div>
          @endif
      </div>
   </div>
</div>
 @endif