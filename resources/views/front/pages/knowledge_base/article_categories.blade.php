@extends('front.layouts.pages')
@section('content')

<div class="container-width knowledge-base-faq-div-class">
    <div class="left-column colheightleft border_right">
      <div class="First-column bg-white">
        <div class="col-md-12">
          <div class="row sectionBox">
            <h1 class="Tile-style w-100 mb-0"> Article Categories</h1>
          </div>
        </div>
        
			<div class="col-md-12 ">
				<div class="row sectionBox padding-20">
				@foreach($categories as $category)
                    <div class="col-md-6 margin-bottom-20 pl-0 inputPaddingLeft">
                        <div class="fat-heading-abb">
                            <a href="{{ route('front.pages.knowledge.base.article.by.category', [$category->id]) }}">
                                <!-- fa fa-folder -->
                                <i class="fa fa-folder photo_icon"></i> {{ $category->category }}
                                <span class="cat-count">({{ $category->articles_count }})</span>
                            </a>
                        </div>
                        <div class="fat-content-small padding-left-30">
                            <ul>
                                @foreach($category->articles as $article)
                                    @if($loop->index >= 5)
                                        @break
                                    @endif
                                    <li>  <!-- fa fa-file-text-o --> 
                                        <a href="{{ route('front.pages.knowledge.base.article.by.id', [$article->id]) }}">
                                            <i class="fa fa-file-text-o photo_icon"></i> {{ $article->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
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