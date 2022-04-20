<div class="accordion__header">
        <h2><!-- Innovator Metadata-->Skills & Expertise</h2>
        <span class="accordion__toggle"></span>
    </div>
    <div class="accordion__body active"> 
        @if(!empty($user->status))
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Status<i class="has-error">*</i></label>
            <div class="col-sm-6">
               <input id="status" type="text" name="status" readonly="" value="@if(!empty($user->status)){{@config('cms.user_status')[$user->status]}}@endif" class="form-control" placeholder="">
            </div>
         </div>
        @endif
        @if(!empty($user->created_at))
         <div class="form-group">
            <label for="resgister_on" class="col-sm-2 control-label">Registered on<i class="has-error">*</i></label>
            <div class="col-sm-6">
               <input id="resgister_on" type="text" name="resgister_on" readonly="" value="@if(!empty($user->created_at)){{date('Y-m-d H:i A',strtotime($user->created_at)) }}@endif" class="form-control" placeholder="">
            </div>
         </div>
        @endif
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Skills<i class="has-error">*</i></label>
          <div class="col-sm-6">
             <!-- <input id="Skills" type="text" required name="skills"  value="@if(!empty($user->skills)){{@$user->skills}}@endif" class="form-control skill_get" placeholder=""> -->
             @include('admin.users.admin_user_skills_drop_down')
          </div>
       </div>
       {{-- <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Gender<i class="has-error"></i></label>
          <div class="col-sm-6">
             <select name="gender" class="form-control">
                    <option value="">Choose</option>
                    @foreach(@config('cms.gender') as $gender)
                    <option value="{{$gender}}" {{(!empty($user->gender) && $gender === $user->gender) ? 'selected' : ''}}>{{$gender}}</option>
                    @endforeach
                </select>
          </div>
       </div> --}}
       
	   
       <!-- <div class="form-group">
          <label for="status" class="col-sm-2 control-label">Status <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <select class="form-control" name="status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
                <option value="2">Block</option>
             </select>
          </div>
       </div> -->
    </div>

    <style type="text/css">
      .dmy {height: 34px;padding: 6px 12px;}
    </style>