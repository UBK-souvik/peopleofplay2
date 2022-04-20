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
          <img src="<?php echo e(asset('front/images/mainLogo.png')); ?>" alt="WelcomeToPOPWeekHeader">
        </div>
        <div class="popModalContentOne">
          <p><i>Oh you’ve hit the good stuff!</i></p>
          <p>This feature is for POP members.</p>
          <p class="toContinue">TO CONTINUE</p>
          <div class="d-flex btnFlex">
            <a href="<?php echo e(route('front.login')); ?>" class="modalBtn btn">Sign In</a>
            <a href="<?php echo e(route('front.sign-up')); ?>" class="modalBtn btn">Join POP!</a>
          </div>
        </div>
        <div class="popModalContentTwo">
          <p>People of Play is the industry’s most comprehensive community hub.</p>
          <p>Build valuable relationships, attend events, and unlock exclusive features and content.</p>
          <p>We have several levels of membership, so all can join!</p>
        </div>
      </div>    
    <!-- Modal Body Content Area -->				 
    </div>
  </div>
</div>