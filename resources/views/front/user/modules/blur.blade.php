<div  class="col-md-12 mb-4 mt-2">
	<a href="@if(!empty(Auth::guard('users')->user()->type_of_user) && Auth::guard('users')->user()->type_of_user == 1){{url('/change-plan/1')}}@else{{url('/login')}}@endif">
	   <div class="bg-image" style='background-image: url("{{url('/')}}/uploads/images/advertisements/20200831075726hmWjHM92wg_advertisements_.png");'></div>
	      <div class="bg-text w-100">
	        <h1>@if(!empty(Auth::guard('users')->user()->type_of_user) && Auth::guard('users')->user()->type_of_user == 1){{'Please Upgrade your Plan'}}@else{{'Log In to See'}}@endif</h1>
	        <p class="text-white"></p>
	      </div>
	</a>
</div>