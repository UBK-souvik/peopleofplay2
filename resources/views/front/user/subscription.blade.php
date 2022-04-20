@extends('front.layouts.pages')

@section('content')

<style>

	.MailingList {

	     border-top: 1px solid #fff; 

	}

</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
<div class="left-column border_right">

    <div class="First-column bg-white p-3">

        <h3 class="Tile-style social mb-3 pt-0">Manage Your Subscriptions</h3>

        @if(Auth::guard('users')->check() && empty(Auth::guard('users')->user()->newsletter) && Auth::guard('users')->user()->newsletter == 0)

	        <div class="row">

			    <div class="container text-white text-center">

			      <div class="MailingList">

			        <div class="row">

			          <div class="offset-md-2 col-md-8 offset-md-2">

			            <h1>JOIN OUR MAILING LIST</h1>

			            <h2>AND NEVER MISS AN UPDATE</h2>

			            <div class="form-group">

			              <!-- <input id="MailEmailID" type="email" name="MailEmailID" class="form-control subscribefield" placeholder="Email Address"> -->

			              

			             <a href="{{route('front.user.newsletter-subscribe',1)}}" class="btn btn-subscribe btn-lg btn-block rounded-0 text-center">SUBSCRIBE NOW</a>

			            </div>

			          </div>

			        </div>

			      </div>

			    </div>

			</div>

		@else

			<div class="row">

			    <div class="container text-white text-center">

	            	<a href="{{route('front.user.newsletter-subscribe',0)}}" class="btn btn-subscribe btn-lg btn-block rounded-0 text-center">UNSUBSCRIBE NOW</a>

		      	</div>

		    </div>

		@endif

    </div>

</div>
</div>

@endsection







<script>



var newsletter_flag = '{{ Session::has("newsletter_flag") }}';



function eventSaveMessage(){

     

	if(newsletter_flag =="1" || newsletter_flag ==1)

	{

		toastr.success("Newsletter Subscriptions updated successfully.");

	}

   

}

   window.onload = eventSaveMessage;

</script>