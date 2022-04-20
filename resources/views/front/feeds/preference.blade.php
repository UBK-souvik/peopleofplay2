 <style type="text/css">
  .showNavPreference {
    display: none;
  }

  .active_role {
    background-color: pink;
  } 


  .ButtonGroup .button-group-pills .btn {
    border-radius: 20px;
    line-height: 1.2;
    margin-bottom: 15px;
    margin-left: 10px;
    border-color: #bbbbbb;
    background-color: #fff;
    color: #000;
  }
  .ButtonGroup .button-group-pills .btn.active {
    border-color: #14a4be;
    background-color: #14a4be;
    color: #fff;
    box-shadow: none;
  }
  .ButtonGroup .button-group-pills .btn:hover {
    border-color: #158b9f;
    background-color: #158b9f;
    color: #fff;
  }
  .ButtonGroup .button-group-pills input[type="checkbox"] {
    display: none;
  }
</style>

<div class="modal-body">
 <!--Welcome to your very own POP Feed!-->
 <button type="button" class="close" data-dismiss="modal">&times;</button>
 <div class="WelcomePopFeed">
  <div class="WelcomeHead mb-4">
   <h1>Welcome to your very own POP Feed!</h1>
   <h4>So we can provide you with the best content, please select all that apply:</h4>
 </div>
<form method="POST" id="feedPrefenceForm" onsubmit="prefereceForm(this);return false;">
  @csrf
  <div class="WelComeOne WelcomeSetFeed mb-4 d-none">
   <h5>I am a:</h5>
   <div class="ButtonGroup">
    <div class="button-group-pills text-center" data-toggle="buttons">
      @foreach($roles as $key => $role)
      @if($key <8)
      <label class="btn btn-default <?php if(in_array($role->id , $user_role)){ echo 'active'; } ?>" for="checkbox-role-id-{{ $key }}">
       <input type="checkbox" <?php if(in_array($role->id , $user_role)){ echo 'checked'; } ?> id="checkbox-role-id-{{ $key }}" name="roles[]" value="{{ $role->id }}">
       <div> {{ @$role->role_name }}</div>
     </label>
     @else 
     <label class="btn btn-default moreRoleNav showNavPreference <?php if(in_array($role->id , $user_role)){ echo 'active'; } ?>">
       <input type="checkbox" <?php if(in_array($role->id , $user_role)){ echo 'checked'; } ?> name="roles[]" value="{{ $role->id }}">
       <div> {{ @$role->role_name }}</div>
     </label>
     @endif
     @endforeach
     <div class="SetFeedsExpand">
     <a href="javascript:void(0);" onclick="moreRoleNav(this);">Expand >></a>
   </div>
   </div>
 </div>
</div>
<div class="WelComeTwo WelcomeSetFeed mb-4">
 <h5>I love:</h5>
 <div class="ButtonGroup">
  <div class="button-group-pills text-center" data-toggle="buttons">
   @foreach($categories as $key1 => $category)
   @if($key1 <8)
   <label class="btn btn-default <?php if(in_array($category->id , $user_product_categories)){ echo 'active'; } ?>" for="checkbox-role-id-{{ $key }}">
    <input type="checkbox" name="category[]" <?php if(in_array($category->id , $user_product_categories)){ echo 'checked'; } ?> value="{{ $category->id }}" >
    <div> {{ @$category->category_name }} </div>
  </label>
  @else
  <label class="btn btn-default moreCategoryNav showNavPreference <?php if(in_array($category->id , $user_product_categories)){ echo 'active'; } ?>" for="checkbox-role-id-{{ $key }}">
    <input type="checkbox" name="category[]" <?php if(in_array($category->id , $user_product_categories)){ echo 'checked'; } ?> value="{{ $category->id }}" >
    <div> {{ @$category->category_name }} </div>
  </label>
  @endif
  @endforeach
   <div class="SetFeedsExpand">
  <a href="javascript:void(0);" onclick="moreCategoryNav(this);">Expand >></a>
</div>
</div>
</div>
</div>

<div class="WelComeThree WelcomeSetFeed mb-4 d-none">
  <h5>I am interested in:</h5>
  <ul class="nav">
   <li class="nav-item">
    <a class="nav-link" href="javascript:void(0);">Business of Play</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="javascript:void(0);">Learning through Play</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="javascript:void(0);">Young Inventors</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="javascript:void(0);">Events</a>
  </li>
</ul>
</div>
<div class="SetFeedBtnPrimary">
  <button type="submit" class="btn btn-primary">Continue to my POP Feed</button>
</div>
</form>
</div>
<!--Welcome to your very own POP Feed!-->
</div>