@extends('front.layouts.pages')
@section('content')


<div class="container-width knowledge-base-faq-div-class">
    <div class="left-column colheightleft border_right">
      <div class="First-column bg-white">
        @foreach($categories as $category)
        <div class="col-md-12">
          <div class="row sectionBox">
            <h1 class="Tile-style w-100 mb-0 text-capitalize">{{ $category->category }} <span class="cat-count">({{ $category->articles_count }})</span></h1>
          </div>
        </div>
        
        <div class="col-md-12">
            <div class="row sectionBox">		    
		
		<!-- <div class="fb-heading">
            <i class="fa fa-folder"></i> {{ $category->category }}
            <span class="cat-count">({{ $category->articles_count }})</span>
        </div> -->
        <hr class="style-three">
        @foreach($category->articles as $article)
        <div class="col-md-12 px-0">
			<div class="panel panel-default" >
                <div class="article-heading-abb-two">
                    <a class="span-style1" href="{{ route('front.pages.knowledge.base.article.by.id', [$article->id]) }}">
                        <i class="fa fa-pencil-square-o"></i> {{ $article->title }} </a>
                </div>
                <div class="article-info">
                    <div class="art-date">
                        <i class="fa fa-calendar-o"></i> {{ $article->created_at }}
                    </div>
                    <div class="art-category">
                        <a href="{{ route('front.pages.knowledge.base.article.by.category', [$category->id]) }}">
                        </a>
                    </div>
                </div>
                <div class="article-content">
                    <p class="block-with-text">
                        {!!@App\Helpers\Utilities::getFilterDescriptionHome($article->description, 3)!!}
                    </p>
                </div>
                <div class="article-read-more">
                    <a href="{{ route('front.pages.knowledge.base.article.by.id', [$article->id]) }}" class="btn kbtn-default btn-wide">Read more...</a>
                </div>
            </div>
		  </div>	
        @endforeach
		
		@endforeach
		
    </div>
</div>     
        
          </div>

          </div>
		  @if(Auth::guard('users')->check())
			   @include('front.includes.profile-sidebar')	  
		   @else
			   @include('front.includes.pages-sidebar')
		   @endif
          
    </div>
@endsection