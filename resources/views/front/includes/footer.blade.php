@php

$user_current_info = get_current_user_info();
$base_url = url('/');
$role_type_id = 0;
$int_type_of_user = 0;
$str_modal_role_type = '';
$arr_roles_list = App\Helpers\Utilities::get_roles_list();

$arr_menu_list = App\Helpers\UtilitiesTwo::getMenuLinks($base_url, $user_current_info);
$str_link_pop_play_shop = $arr_menu_list['str_link_pop_play_shop'];
$str_link_pop_contact_us = $arr_menu_list['str_link_pop_contact_us'];
$str_link_knowledge_base_faqs = $arr_menu_list['str_link_knowledge_base_faqs'];
   
$str_user_url = App\Helpers\Utilities::get_user_url($base_url, $user_current_info);
   
if(!empty($user_current_info->role))
{
   $role_type_id = $user_current_info->role;	
}

if(!empty($user_current_info->type_of_user))
{
	$int_type_of_user = $user_current_info->type_of_user; 
}

if(!empty($user_current_info->id))
{
   $str_modal_role_type = $arr_menu_list['profile_change_plan'];
}

@endphp

@include("front.includes.view_role_type_popup")

<style type="text/css">
 #a_more, #award_mobile_more, #d_more {display: none;}
</style>
<script>
   // $(document).ready(function(){
  // $(window).scroll(function () {
  //     if ($(this).scrollTop() > 50) {
  //        $('.Mobheader').addClass("fixed");
  //        $('#DesktopFirstHomePage').addClass("fixed");
  //     } else {
  //       $('.Mobheader').removeClass("fixed");
  //       $('#DesktopFirstHomePage').removeClass("fixed");
  //     }
  //   });
  // });
   $(document).ready(function(){
  $(window).scroll(function () {
      if ($(this).scrollTop() > 50) {
         $('.left-colom-sidebar').addClass("top");
      } else {
        $('.left-colom-sidebar').removeClass("top");
      }
    });
  });

   $(document).ready(function(){
  $(window).scroll(function () {
      if ($(this).scrollTop() > 50) {
         $('.RightColumnSection').addClass("topMargin");
      } else {
        $('.RightColumnSection').removeClass("topMargin");
      }
    });
  });

function open_more_pop_pro_modal()
{
	   var modal_more_at_form = '#modal-more-at-poppro-popup';
	   $(modal_more_at_form).hide();
	   $(modal_more_at_form).css('display', 'none');
	   $(modal_more_at_form).modal({ show: false });
	   
       open_select_role_modal();
}

function open_select_role_modal()
{
	   var modal_role_form = '#modal-user-role-type-popup-new';
	   $(modal_role_form).show();
	   $(modal_role_form).css('display', 'block');
	   $(modal_role_form).modal({ show: true });
}
	 
function chk_role_type_selected()		
{
	var role_msg =  "Please Select a Role";
	var str_role_id_sel = document.getElementById('role_id_sel').value;
	
	if(str_role_id_sel == "")
	{
	   toastr.error(role_msg);
       return false;	   
	}	
	window.location.href = "{{$base_url.'/plans'}}" + "/" + str_role_id_sel;
	
}		
</script>

<div class="modal fade" id="modal-more-at-poppro-popup" style="z-index: 1050;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header kbg_black" >
        <div class="row pl-3">
          <h4 class="text-white">Become an POP Pro Member Today</h4>
          <p class="text-white mt-2">Get access to the essential resource for the toy, game and play industry</p>
        </div>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4 text-center">
            <i class="fa fa-users" aria-hidden="true"></i>
            <h2 class="my-2">Find Contacts & Representation</h2>
            <p>Use our Advanced Search functionalities in the industry's largest database.</p>
          </div>
          <div class="col-md-4 text-center">
            <i class="fa fa-bullhorn" aria-hidden="true"></i>
            <h2 class="my-2">Showcase Yourself & Find Jobs</h2>
            <p>Manage your profile, message people to partner with, and find jobs.</p>
          </div>
          <div class="col-md-4 text-center">
            <i class="fa fa-line-chart" aria-hidden="true"></i>
            <h2 class="my-2 mb-4">Stay In the Loop</h2>
            <p class="mt-2">Follow the most comprehensive industry calendar, participate in exclusive networking sessions in the POP Pub, and more!</p>
          </div>
        </div>
        <div class="text-center mt-4">
 
          <a type="button" class="btn RedButton popupSignUpWidth" href="{{route('front.sign-up')}}" >SIGN UP</a>
          <p class="mt-1 p-text">* Already a Member? <a class="span-style1" href="{{route('front.login')}}">Log In</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="footer-background page-footer font-small mdb-color text-white px-0">

    <!-- Footer Links -->
    <div class="text-center text-md-left container">

      <!-- Footer links -->
      <div class="row text-center text-md-left px-3 pt-3">


        <!-- Grid column -->
        <div class="col-md-12 col-lg-4 mx-auto mt-3 imagecenter text-md-center text-lg-left">
          <h6 class="text-uppercase mb-4">People Of Play App</h6>
          <p class="paragraphdesign">Read the latest updates, track your  Watchlist, rate your favorite toys, games, and innovators, and more all on your phone or tablet!
          </p>

          <p class="mb-1 text-white">Coming soon to...</p>
          <ul class="d-flex footerimg">
          <li class="border mr-1"><img src="{{asset('front/new/images/footergoogle.png')}}"></li>
            <li class="border"><img src="{{asset('front/new/images/footerapp.png')}}"></li>
          </ul>
        </div>
        <!-- Grid column -->

        <hr class="w-100 clearfix d-sm-none">
        <div class="col-sm-6 col-md-3 col-lg-2 mt-3 h4footer">
          <h4>Contact us</h4>
          <hr class="bg-white">
          <ul>
          
			<li><a href="{{route('front.contact-us')}}" target="_blank">Contact us</a></li>
            <li><a href = "mailto:info@chitag.com">info@chitag.com</a></li>
            <li><a href="#!">+1-847-677-8277</a></li>
          </ul>

        </div>
        <hr class="w-100 clearfix d-sm-none">
        <div class="col-sm-6 col-md-3 col-lg-2 mt-3 h4footer">
          <h4>About us</h4>
          <hr class="bg-white">
          <ul>
            <li><a href="https://www.chitag.com/about-chitag" target="_blank">About CHITAG Group</a></li>
        
            <li><a href="https://www.chitag.com/charities-we-support" target="_blank">Charities we support</a></li>
            <li><a href="{{route('front.pop_blogs')}}" target="_blank">POP Interviews</a></li>
            <li><a href="{{$str_link_pop_play_shop}}" class="li-color">Shop</a></li>
            <li><a href="{{$str_link_pop_contact_us}}">Contact Us</a></li>
            <li><a href="{{$str_link_knowledge_base_faqs}}">FAQs</a></li>
            <li><a href="{{route('front.TermsAndConditions')}}"> Terms & Conditions</a></li>
          </ul>
        </div>
        <hr class="w-100 clearfix d-sm-none">
        <div class="col-sm-6 col-md-3 col-lg-2 mt-3 h4footer">
          <h4>Newsletters</h4>
          <hr class="bg-white">
          <ul>
          
            <li><a href="https://www.chitag.com/get-the-newsletter" target="_blank" >The Bloom Report</a></li>
            <li><a href="https://www.chitag.com/get-the-newsletter" target="_blank" >People of Play</a></li>
            <li><a href="https://www.chitag.com/importance-of-play" target="_blank" >Importance of Play</a></li>
            <li><a href="https://www.chitag.com/get-the-newsletter" target="_blank" >Play in Education</a></li>
            <li><a href="https://www.chitag.com/get-the-newsletter" target="_blank" >Social Media at Play</a></li>
            <li><a href="https://www.chitag.com/get-the-newsletter" target="_blank" >iDEA</a></li>
          </ul>

        </div>
        <hr class="w-100 clearfix d-sm-none">
        <div class="col-sm-6 col-md-3 col-lg-2 mt-3 h4footer">
          <h4>Play with us</h4>
          <hr class="bg-white">
          <ul>
            <li><a href="https://www.chitag.com/advertise" target="_blank">Advertise</a></li>
            <li><a href="https://www.chitag.com/exhibit-at-the-fair" target="_blank">Exhibit at the Fair</a></li>
            <li><a href="https://www.chitag.com/yic" target="_blank">Join the YIC</a></li>
            <li><a href="https://www.chitag.com/sponsor-an-event" target="_blank">Sponsor</a></li>
            <li><a href="https://www.chitag.com/internship" target="_blank">Internship</a></li>
            <li><a href="https://www.chitag.com/volunteer" target="_blank">Volunteers</a></li>
            <li><a href="https://www.chitag.com/new-job-board" target="_blank">Jobs</a></li>
          </ul>
        </div>
      </div>
      <hr class="bg-white">
      <div class="col-md-12">
        <div class="row d-flex align-items-center">


          <!-- Grid column -->
          <div class="col-md-9 col-lg-9">
            <p class="copyRight">Copyright © 2022, Chicago Toy &amp; Game Group, Inc. dba People of Play ®
            </p>

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-3 ml-lg-0">

            <!-- Social buttons -->
            <div class="text-center text-md-right d-flex justyfy-content-center twentyThreeMargin">
              <ul class="list-unstyled list-inline d-flex justyfy-content-around footerSocialIcon">

                <li class="">
                  <a class="" href="https://www.youtube.com/user/ChicagoToyAndGame/featured" class="btn-floating btn-sm rgba-white-slight mx-1 px-2" target="_blank">
                    <i class="fa fa-youtube-play photo_icon" aria-hidden="true"></i>
                  </a>
                </li>
                <li class="">
                  <a class="" href="https://twitter.com/peopleofplay" class="btn-floating btn-sm rgba-white-slight mx-1 px-2" target="_blank">
                    <i class="fa fa-twitter photo_icon" aria-hidden="true"></i>
                  </a>
                </li>
                <li class="">
                  <a class="" href="https://www.pinterest.com/chitagweek" class="btn-floating btn-sm rgba-white-slight mx-1 px-2" target="_blank">
                    <i class="fa fa-pinterest-p photo_icon" aria-hidden="true"></i>
                  </a>
                </li>
                <li class="">
                  <a class="" href="https://www.linkedin.com/groups/8205166/" class="btn-floating btn-sm rgba-white-slight mx-1 px-2" target="_blank">
                    <i class="fa fa-linkedin photo_icon" aria-hidden="true"></i>
                  </a>
                </li>
                <li class="">
                  <a class="" href="https://www.instagram.com/peopleofplay/" class=" btn-floating btn-sm rgba-white-slight mx-1 px-2" target="_blank">
                    <i class="fa fa-instagram photo_icon" aria-hidden="true"></i>
                  </a>
                </li>

                <li class="">
                  <a class="" href="https://www.facebook.com/ChicagoToyAndGameWeek/" class=" btn-floating btn-sm rgba-white-slight mx-1 px-2" target="_blank">
                    <i class="fa fa-facebook photo_icon" aria-hidden="true"></i>
                  </a>
                </li>

              </ul>
            </div>

          </div>

          <!-- Grid column -->
        </div>
      </div>

<div class="container">
  <div class="modal" id="one_time_popup">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-heade pt-3 px-3 pb-0 border-none">
         
          <button type="button" class="close close_one_time_popup" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-center pt-0">
         <h1 class="mt-0" style="color: #662D92;font-weight: 900;font-size: 30px;">Welcome!</h1>
         <p style="font-size: 17px;">Welcome Betatesters to POP! This is your exclusive first look at our work-in-progress, the beginning of what will be where people can discover the stories behind the toys and games you love. We share with you the largest treasure trove of people, companies and products in the toy, game and play industry as well as premium content and networking to be successful in the toy and game industry!</p>
    
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form method="POST" action="">
          @csrf
          <div class="modal-header kbg_black">
            <div class="textContent">
               <h4 class="modal-title text-white">Delete Account</h4>
            </div>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
   
          </div>
          <div class="modal-body py-4">
            <p class="mb-2">Please enter password to delete account.</p>
            <input type="password" class="form-control" id="password" name="password" placeholder="********">
          </div>
          <div class="modal-footer">
            <button type="submit" class="delete_account_button btn btnAll">Submit</button>
      
          </div>
        </form>
      </div>
      
    </div>
  </div>
      <!-- Grid row -->
<input type="hidden" name="int_search_dd_val_hidden_new" id="int_search_dd_val_hidden_new" value="@if(!empty($int_search_dd_val_desk_new)){{$int_search_dd_val_desk_new}}@endif">
  </footer>

<style>
.phpdebugbar{
    display: none;
}

</style>
<script src="{{asset('front/new/js/jquery-3.5.0.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/ywqmxeye1bqw640inrzx59t5k336ioq2oad0rc5d4cydjlnt/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


@include('front.includes.include_footer_js_script')