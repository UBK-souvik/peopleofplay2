	<div class="col-md-3">
		<div class="right-column RightSideColumn">

			<?php
			$showRightSidebar = 1;
			if(Request::segment(1) == 'people')
			{
				$showRightSidebar = 0;
			}

			if(Request::segment(1) == 'sign-up')
			{
				$showRightSidebar = 0;
			}
			if(Request::segment(1) == 'blog')
			{
				$showRightSidebar = 0;
			}

           if(Request::segment(1) == '3-truths-and-a-lie')
			{
				$showRightSidebar = 0;
			}

			if(Request::segment(1) == 'user' && Request::segment(2) == 'classified' &&   Request::segment(3) == 'update' )
			{
				$showRightSidebar = 0;
			}
			if(Request::segment(1) == 'user' && Request::segment(2) == 'blog' && Request::segment(3) == 'update' ) {
               $showRightSidebar = 0;
            }
            if(Request::segment(1) == 'user' && Request::segment(2) == 'profile') {
               $showRightSidebar = 0;
            }
			?>
			@if ($showRightSidebar == 1)
			@include('front.includes.home-sidebar')
			@endif
		</div>
	</div>
