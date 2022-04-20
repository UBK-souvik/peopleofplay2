 <style type="text/css">
    .showNavPreference {
      display: none;
   }

   .active_role {
      background-color: pink;
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
      <div class="WelComeOne WelcomeSetFeed mb-4">
         <h5>I am a:</h5>
         <ul class="nav">
            @foreach($roles as $key => $role)
            @if($key <8)
               <li class="nav-item <?php if(in_array($role->id , $user_role)){ echo 'active_role'; } ?>" >
                  <a class="nav-link" href="javascript:void(0);"> {{ @$role->role_name }} {{ @$role->id }} </a>
               </li>
            @else 
               <li class="nav-item moreRoleNav showNavPreference  <?php if(in_array($role->id , $user_role)){ echo 'active_role'; } ?>">
                  <a class="nav-link" href="javascript:void(0);"> {{ @$role->role_name }} </a>
               </li>
            @endif
            @endforeach
         </ul>
         <a href="javascript:void(0);" onclick="moreRoleNav(this);">Expand >></a>
      </div>
      <div class="WelComeTwo WelcomeSetFeed mb-4">
         <h5>I love:</h5>
         <ul class="nav">
           @foreach($categories as $key1 => $category)
           @if($key1 <8)
              <li class="nav-item <?php if(in_array($category->id , $user_product_categories)){ echo 'active_role'; } ?>">
               <a class="nav-link" href="javascript:void(0);">{{ @$category->category_name }}</a>
              </li>
         @else
             <li class="nav-item moreCategoryNav showNavPreference <?php if(in_array($category->id , $user_product_categories)){ echo 'active_role'; } ?>">
               <a class="nav-link" href="javascript:void(0);">{{ @$category->category_name }}</a>
             </li>
         @endif
         @endforeach
      </ul>
      <a href="javascript:void(0);" onclick="moreCategoryNav(this);">Expand >></a>
   </div>
 
   <div class="WelComeThree WelcomeSetFeed mb-4">
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