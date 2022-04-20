    <div class="accordion__header is-active">
        <h2>Basic Details</h2>
        <span class="accordion__toggle"></span>
    </div>
    <div class="accordion__body is-active">

	{{-- <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Type <i class="has-error">*</i></label>
          <div class="col-sm-6">
            <select required name="role" class="form-control select2 py-3">
                    <!-- <option value="">Type</option> -->
                    @foreach($arr_roles_list as $id => $name)
                       @if($id == 1 || $id == 3)@continue; @endif
                            <option selected="" value="{{$id}}">{{$name}}</option>
                    @endforeach
            </select>           
          </div>
	</div> --}}
	   
	                @foreach($arr_roles_list as $id => $name)
                       @if($id == 1 || $id == 3)@continue; @endif
                            <input type="hidden" name="role" value="{{$id}}">
                    @endforeach
					
	   
	   

       <div class="form-group">
          <label for="email" class="col-sm-2 control-label">In Gold List </label>
          <div class="col-sm-6">
              <input type="radio" id="yes" name="gold" value="1" @if(!empty(@$user->gold)){{ 'checked' }} @endif>
              <label for="yes">Yes</label><br>
              <input type="radio" id="no" name="gold" value="0" @if(empty(@$user->gold)){{ 'checked' }} @endif>
              <label for="no">No</label><br>
          </div>
       </div>	   	  
        <div class="form-group">          <label for="email" class="col-sm-2 control-label">Profile Caption </label>          <div class="col-sm-6">              
	   <input type="text" id="home_page_slide_show_caption" class="form-control" name="home_page_slide_show_caption" value="@if(!empty(@$user->home_page_slide_show_caption)){{ $user->home_page_slide_show_caption }} @endif">          </div>       
        </div>

         <div class="form-group">          
            <label for="email" class="col-sm-2 control-label">Caption Url</label>          
            <div class="col-sm-6">              
             <input type="text" id="caption_url" class="form-control" name="caption_url" value="@if(!empty(@$user->caption_url)){{ $caption_url }} @endif">          
            </div>       
         </div>
        
		    <div class="form-group">
          <label for="name" class="col-sm-2 control-label">First Name <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input required type="text" class="form-control" name="first_name" placeholder="First Name" value="@if(!empty($user->first_name)){{$user->first_name}}@endif">
          </div>
       </div>
       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Last Name <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input required type="text" class="form-control" name="last_name" placeholder="Last Name" value="@if(!empty($user->last_name)){{$user->last_name}}@endif">
          </div>
       </div>
       @if(empty($user->id))
	     <div class="form-group">
          <label for="password" class="col-sm-2 control-label">Password <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input type="password" required class="form-control" name="password" placeholder="Password">
          </div>
       </div>
       @endif
	   <!--   <div class="form-group">
          <label for="mobile" class="col-sm-2 control-label">Mobile <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input type="text" required class="form-control" name="mobile" value="@if(!empty($user->mobile)){{$user->mobile}}@endif">
          </div>
       </div> -->
       <!-- <div class="form-group">
          <label for="gender" class="col-sm-2 control-label">Gender <i class="has-error"></i></label>
          <div class="col-sm-6">
              <select name="gender" class="form-control">
                    @foreach(@config('cms.gender') as $gender)
                    <option value="{{$gender}}" {{!empty($user->gender) && ($gender === $user->gender) ? 'selected' : ''}}>{{$gender}}</option>
                    @endforeach
                </select>
          </div>
       </div> -->
       <div class="form-group">
          <label for="gender" class="col-sm-2 control-label">Pronoun <i class="has-error"></i></label>
          <div class="col-sm-6">
              <select name="pronoun" class="form-control">
                  <option value="">Choose</option>
                  <option value="He/Him/His" {{'He/Him/His'===@$user->pronoun ? 'selected' : ''}}>He/Him/His</option>
                  <option value="She/Her/Hers" {{'She/Her/Hers'===@$user->pronoun ? 'selected' : ''}}>She/Her/Hers</option>
                  <option value="They/Them/Theirs" {{'They/Them/Theirs'===@$user->pronoun ? 'selected' : ''}}>They/Them/Theirs</option>
                  <option value="not-specify" {{'not-specify'===@$user->pronoun ? 'selected' : ''}}>Prefer not to specify</option>
              </select>
          </div>
       </div>
       <div class="form-group">
          <label for="profile_image" class="col-sm-2 control-label">Profile Image <i class="has-error"></i></label>
          <div class="col-sm-6">
              <img id="profile-blah-image" src="{{@imageBasePath(@$user->profile_image)}}" alt="" class="twoFiftySeven">
			      @if(!empty($user->profile_image))
            @else
              <!-- <img id="profile-blah-image" src="{{url('front/new/images/10.png')}}" alt="" class="twoFiftySeven"> -->
            @endif
            <input id="file-uploadten" accept="image/*" onchange="readProfileURL(this);" type="file" name="profile_image" class="marginTopFive">
            <h4 class="text-danger ">Note: Please upload image up to {{App\Helpers\UtilitiesTwo::get_max_upload_image_size()}} only</h4>
          </div>
       </div>
       <!-- <div class="form-group">
          <label for="name" class="col-sm-2 control-label">User Name <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input type="text" class="form-control" name="username" placeholder="User Name" value="@if(!empty($user->username)){{$user->username}}@endif">
          </div>
       </div>
       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">User Role <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input type="text" class="form-control" name="role" value="@if(!empty($user->role)){{ @config('cms.role')[$user->role]}}@endif" placeholder="User Role">
          </div>
       </div>-->
       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Innovator Description <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <textarea class="form-control" required rows="9" name="description" id="Userdescription" placeholder="">@if(!empty($user->description)){{$user->description}}@endif</textarea>
          </div>
       </div>
       <div class="form-group">
          <label for="fun_fact1" class="col-sm-2 control-label">Fun Fact 1</label>
          <div class="col-sm-6">
             <input required type="text" class="form-control" name="fun_fact1" placeholder="Fun Fact 1" value="@if(!empty(@$user->fun_fact1)){{@$user->fun_fact1}}@endif">
          </div>
       </div>
       <div class="form-group">
          <label for="fun_fact2" class="col-sm-2 control-label">Fun Fact 2</label>
          <div class="col-sm-6">
             <input required type="text" class="form-control" name="fun_fact2" placeholder="Fun Fact 2" value="@if(!empty(@$user->fun_fact2)){{@$user->fun_fact2}}@endif">
          </div>
       </div>
       <div class="form-group">
          <label for="fun_fact3" class="col-sm-2 control-label">Fun Fact 3</label>
          <div class="col-sm-6">
             <input required type="text" class="form-control" name="fun_fact3" placeholder="Fun Fact 3" value="@if(!empty(@$user->fun_fact3)){{@$user->fun_fact3}}@endif">
          </div>
       </div>
	    @include('admin.users.admin_user_badge')	   
    </div>