	<div class="col-md-3">
		<div class="right-column RightSideColumn">

			<?php
			$showRightSidebar = 1;
			if(Request::segment(1) == 'people')
			{
				$showRightSidebar = 0;	
			}
			 if(Request::segment(1) == 'home' && Request::segment(2) == 'get-site-search-data') {
               $showRightSidebar = 0;
            } 
            if(Request::segment(1) == 'user' && Request::segment(2) == 'brand' &&  Request::segment(3) == 'create') {
               $showRightSidebar = 0;
            }
            if(Request::segment(1) == 'user' && Request::segment(2) == 'brand' &&  Request::segment(3) == 'update') {
               $showRightSidebar = 0;
            }
             if(Request::segment(1) == 'user' && Request::segment(2) == 'event' &&  (Request::segment(3) == 'create' || Request::segment(3) == 'update' )) {
               $showRightSidebar = 0;
            }
			if(Request::segment(1) == 'company')
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

			if(Request::segment(1) == 'quiz')
			{
				$showRightSidebar = 0;	
			}
			
			if(Request::segment(1) == 'user' && Request::segment(2) == 'classified' &&   Request::segment(3) == 'update' )
			{
				$showRightSidebar = 0;	
			}
			if(Request::segment(1) == 'user' && Request::segment(2) == 'blog' && (Request::segment(3) == 'update' || Request::segment(3) == 'preview_detail' || Request::segment(3) == 'pre_view_detail')) {
               $showRightSidebar = 0;
            }
			if(Request::segment(1) == 'feeds' || Request::segment(1) == 'feed' || Request::segment(1) == 'news-feeds' || Request::segment(1) == 'news_feed')
			{
			  $showRightSidebarToggle = 0;
			}
            if(Request::segment(1) == 'user' && Request::segment(2) == 'product' && Request::segment(3) == 'update' ) {
               $showRightSidebar = 0;
            }
            if(Request::segment(1) == 'user' && Request::segment(2) == 'profile') {
               $showRightSidebar = 0;
            }
            if(Request::segment(1) == 'wiki' || Request::segment(1) == 'rest-in-play' || Request::segment(1) == 'popcast' || Request::segment(1) == 'entertainment' || Request::segment(1) == 'featured-article' || Request::segment(1) == 'feeds' || Request::segment(1) == 'feed' || Request::segment(1) == 'news-feeds' || Request::segment(1) == 'news_feed') {
               $showRightSidebar = 0;
            }
          
			?>
			@if ($showRightSidebar == 1)
			@include('front.includes.home-sidebar')
			@endif
		</div>
	</div>
