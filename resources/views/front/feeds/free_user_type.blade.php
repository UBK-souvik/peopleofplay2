<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content text-center">
    <!-- Modal Close area -->
    <div class="modalClose">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <!-- Modal Close Area -->
    <!-- Modal Body Content Area -->
    <div class="modal-body">
    <div class="modalBodyArea">
      <div class="YTtopContant">
        <img src="{{ asset('front/images/mainLogo.png')}}" alt="WelcomeToPOPWeekHeader">
      </div>
      <div class="popModalContentOne">
        <p><i>It’s time for an upgrade!</i></p>
        <p>This feature requires a different membership level.</p>
        <p class="toContinue">TO CONTINUE</p>
        <div class="d-flex btnFlex">
          <a href="{{route('front.plans', $role)}}" class="modalBtn btn">Upgrade Membership</a>
        </div>
      </div>
    </div>
    <!-- Modal Body Content Area -->				 
    </div>
  </div>
</div>