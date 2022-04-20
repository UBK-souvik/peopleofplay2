@extends('front.layouts.pages')
@section('content')
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
<div class="container-width knowledge-base-faq-div-class">
    <div class="left-column colheightleft border_right">
      <div class="First-column bg-white">
        <div class="col-md-12 p-3 pb-0" >
          <div class="faqTopBg"><!-- sectionTop -->
            <h1 class="Tile-style w-100 mb-0 text-center text-white"> Frequently Asked Questions</h1>
        </div>
    </div>
    <!-- <hr class="mt-0 mb-3"> -->
    <div class="pb-3" style="">
        <div class="col-md-12">
         <div class="panel-group" id="accordionCategories" role="tablist" aria-multiselectable="true">
            @foreach($categories as $category)
            <div class="panel panel-default">
                <div class="panel-heading panelPadding" role="tab" id="headingCategory{{ $category->id }}">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordionCategories" href="#collapseCategory{{ $category->id }}" aria-expanded="true" aria-controls="collapseCategory{{$category->id}}">
                            {{ $category->category }}
                        </a>
                        <a role="button" class="DownArrow pull-right" data-toggle="collapse" data-parent="#accordionCategories" href="#collapseCategory{{ $category->id }}" aria-expanded="true" aria-controls="collapseCategory{{$category->id}}">
                            <i class="fa fa-angle-down photo_icon" aria-hidden="true"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseCategory{{ $category->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingCategory{{ $category->id }}">
                    <div class="panel-body">
                        <div class="panel-group" id="accordionQuestions{{ $category->id }}" role="tablist" aria-multiselectable="true">
                            @foreach($category->faqQuestions as $question)
                            <div class="panel panel-default ">
                                <div class="panel-heading panelPadding" role="tab" id="headingQuestion{{ $question->id }}">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordionQuestions{{ $category->id }}" href="#collapseQuestion{{ $question->id }}" aria-expanded="true" aria-controls="collapseQuestion{{$question->id}}">
                                            {{ $question->question }}

                                        </a>
                                        <a role="button" class="DownArrow pull-right" data-toggle="collapse" data-parent="#accordionQuestions{{ $category->id }}" href="#collapseQuestion{{ $question->id }}" aria-expanded="true" aria-controls="collapseQuestion{{$question->id}}">
                                            <i class="fa fa-angle-down photo_icon" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseQuestion{{ $question->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingQuestion{{ $question->id }}">
                                    <div class="panel-body">
                                        {!! $question->answer !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

@endsection