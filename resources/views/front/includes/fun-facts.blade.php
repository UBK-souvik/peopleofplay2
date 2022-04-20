<style>
   .FunFactCard  .fun_fact_2_btn_more,.FunFactCard  .fun_fact_2_btn_less,.FunFactCard  .fun_fact_1_btn_more,.FunFactCard  .fun_fact_1_btn_less,.FunFactCard .fun_fact_3_btn_more{
      border: 1px solid #28a745 !important;
      color: #28a745 !important;
      font-size: 11px;
    border-radius: 6px;
    background: transparent;
    padding: 1px 12px;
   }
</style>
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
         <div class="card FunFactCard bg-white text-dark mr-md-0 col-md-4" style="border: 1px solid #28a745!important;">
         <div class="bg-white pt-2">
               @if(!empty(@$fun_fact1) && strlen(@$fun_fact1) >40)
               <div class="ff1_read_less"><?php if(@$fun_fact1) { echo @App\Helpers\UtilitiesTwo::get_fun_fact_data(@$fun_fact1, 150); } ?>
                  <br>
                  <div class="text-center py-3">
                  <a href="javascript:void(0);" class="btn d-inline-block fun_fact_1_btn_more"  onclick="fun_fact1_readmore();" >More</a>
                  </div>
               </div>
               @else 
               <div class="ff1_read_less"><?php if(@$fun_fact1) { echo  @$fun_fact1; } ?></div>
                  @endif
               <div class="ff1_read_more" style="display: none;"><?php if(@$fun_fact1) { echo   @$fun_fact1; } ?>
                  <br>
                  <div class="text-center py-3">
                  <button class="readMore fun_fact_1_btn_less ProfileReadMore" style="display: none;" onclick="fun_fact1_readless();">Less</button>
                  </div>
               </div>
            </div>
         </div>
           @endif
            @if(!empty(@$fun_fact2))
         <div class="card FunFactCard bg-white text-dark mr-md-0 col-md-4" style="border: 1px solid #28a745!important;">
            <div class="bg-white pt-2">
               @if(!empty(@$fun_fact2) && strlen(@$fun_fact2) >40)
               <div class="ff2_read_less"><?php if(@$fun_fact2) { echo @App\Helpers\UtilitiesTwo::get_fun_fact_data(@$fun_fact2, 150); } ?>
                  <br>
                  <div class="text-center py-3">
                  <a href="javascript:void(0);" class="btn d-inline-block fun_fact_2_btn_more"  onclick="fun_fact2_readmore();" >More</a>
               </div>
               </div>
               @else 
               <div class="ff2_read_less"><?php if(@$fun_fact2) { echo  @$fun_fact2; } ?></div>
                  @endif
               <div class="ff2_read_more" style="display: none;"><?php if(@$fun_fact2) { echo   @$fun_fact2; } ?>
                  <br>
                  <div class="text-center py-3">
                  <button class="readMore fun_fact_2_btn_less ProfileReadMore" style="display: none;" onclick="fun_fact2_readless();">Less</button>
                  </div>
               </div>
            </div>
         </div>
          @endif
           @if(!empty(@$fun_fact3))
         <div class="card FunFactCard text-dark bg-white col-md-4" style="border: 1px solid #28a745!important;">
         <div class="bg-white pt-2">
                  @if(!empty(@$fun_fact3) && strlen(@$fun_fact3) >40)
                  <div class="ff3_read_less"><?php if(@$fun_fact3) { echo @App\Helpers\UtilitiesTwo::get_fun_fact_data(@$fun_fact3, 150); } ?>
                     <br>
                     <div class="text-center py-3">
                     <a href="javascript:void(0);" class="btn d-inline-block fun_fact_3_btn_more"  onclick="fun_fact3_readmore();" >More</a>
                     </div>
                  </div>
                  @else 
                  <div class="ff3_read_less"><?php if(@$fun_fact3) { echo  @$fun_fact3; } ?></div>
                     @endif
                  <div class="ff3_read_more" style="display: none;"><?php if(@$fun_fact3) { echo   @$fun_fact3; } ?>
                     <br>
                     <div class="text-center py-3">
                     <button class="readMore fun_fact_3_btn_less ProfileReadMore" style="display: none;" onclick="fun_fact3_readless();" >Less</button>
                     </div>
                  </div>
            </div>
         </div>
          @endif
      </div>
   </div>
</div>
 @endif