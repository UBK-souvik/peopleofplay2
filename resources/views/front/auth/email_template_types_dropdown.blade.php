@extends('front.layouts.auth')
@section('content')

<section id="login">
    <div class="container k_black1">
        <div class="row paddingzero">
            <div class="col-md-6 offset-md-3 my-5 klogin_Style p-5 rounded w-12">
                <div class="login_logo">
                    <a href="#" class="d-block px-3 bg-white py-2 text-uppercase text-center text-bold textPurple Logostyle">Email Templates List</a>
              </div>
			        <div>
					@if(!empty($type_id))
					{{'Mail Sent Successfully'}}
				    @endif
					</div>
                    <div class="form-group">
                       <select onchange="return goto_email_template(this.value);">
					   <option value="">Select a Template</option>
					   <option @if(!empty($type_id) && $type_id ==1) {{'selected="selected"'}} @endif value="1">Forgot Password</option>
					   <option @if(!empty($type_id) && $type_id ==2) {{'selected="selected"'}} @endif value="2">Contact Us</option>
					   </select>
                    </div>
                    
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>

function goto_email_template(type_id)
{
   window.location.href =	base_url_new + "/email_template_dropdown/" + type_id;
}
   
</script>
@endsection
