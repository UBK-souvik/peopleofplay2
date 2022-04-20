@extends('front.layouts.pages')
@section('content')
@php
@$int_chk_is_my_blog_news = App\Helpers\UtilitiesTwo::chkIsMyBlogNews();
@endphp
<style type="text/css">
   .pagination{
   padding: 10px !important;
   margin: auto !important;
   width: 35% !important;
   }
  @media (max-width: 767px) {
     select#blogCategory {
       width: 100%;
       float: unset;
  }
  }
   @media (max-width: 560px) {
   /*ul.pagination li:not(.show-mobile) {
   display: none;
   }*/
   .pagination {
   margin: 0 !important;
   }
   }
</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="containerWidth">
      <div class="left-column colheightleft border_right BlogListPage">
         <div class="First-column bg-white">
            <div class="col-md-12">
               <div class="row sectionBox" style="border-top: 1px solid transparent;">
                  <div class="col-md-9 px-0 order-1 order-md-1">
                     <h1 class="Tile-style w-100 mb-0">
                     @if(Request::segment(1) == 'wiki')
                     @php
                      $str_read = 'Wiki';
                      echo $str_read1 = 'Wiki - '. $category->name;
                      $str_cate_url = 'wiki';
                     @endphp
                     @elseif(Request::segment(1) == 'entertainment')
                      @php
                       @$str_read = 'Entertainment';
                      echo $str_read1 = 'Entertainment - '. $category->name;
                      $str_cate_url = 'entertainment';
                       @endphp
                        @elseif(Request::segment(1) == 'popcast')
                      @php
                       @$str_read = 'POPcast';
                      echo $str_read1 = 'POPcast - '. $category->name;
                      $str_cate_url = 'popcast';
                       @endphp
                     @else
                     @php
                      $str_read = 'Rest In Play';
                      echo $str_read = 'Rest In Play - '. $category->name;
                      $str_cate_url = 'rest-in-play';
                     @endphp
                     @endif
                     </h1>
                  </div>
                  <div class="col-md-3 px-0 order-2 order-md-2">
                        <div class="w-100 blog_Selectcategories text-md-right text-md-center">
                        <div class="BlogCategories mb-4 mb-md-0">
                          @if(isset($categories) && !empty($categories))
                           <select class="form-control " id="blogCategory" onchange="categoryFilter(this);">
                              <option value=""> -- Select Category -- </option>
                              @foreach ($categories as $cate_row)
                              <option <?php if(@$cate_row->slug == Request::segment(2)) { echo 'selected'; } ?> value="{{ @$cate_row->slug }}"> {{  @$cate_row->name }}</option>
                              @endforeach
                           </select>
                           @endif
                        </div>
                     </div>
                     <!--  -->
                  </div>
               </div>
            </div>
            @if(!empty($data) && count($data)>0)
            @foreach ($data as $row)
            @php
              @$str_user_name = App\Helpers\Utilities::getUserName($row->user);
             @$str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $row->user);
            @endphp
            <div class="col-md-12">
               <div class="row sectionBox">
                  <div class="col-sm-4 col-md-5 col-lg-3 pl-0">
                     <div class="image-width justifly-content-center">
                        <a href="{{ url($row->url) }}" class="sec_head_text">
                        <img src="{{@imageBasePath($row->featured_image)}}" class="img-fluid imgOneSixtyFive">
                        </a>
                     </div>
                  </div>
                  <div class="col-sm-8 col-md-7 col-lg-9 pl-0">
                     <div class="blogparagraph">
                        <a href="{{ url($row->url) }}" class="blogNewsTitle text-dark">
                           <h2 class="text-left blogNewsTitle mb-0">{{@$row->title}}</h2>
                        </a>
                        <span class="span-text-grey"><a href="javascript:void(0);">
                          @if(@$row->authore_no_profile !='')
                          <a href="javascript:void(0);">
                          {{ @$row->authore_no_profile  }} {{ ' | ' }}
                        </a>
                          @else
                          <a target="_blank" href="@if(!empty($str_user_url_new)){{$str_user_url_new}}@else{{'#'}}@endif">
                          {{ (!empty(@$str_user_name) ? @$str_user_name.' | ' : '' ) }}
                        </a>
                          @endif
                            {{@$row->created_at }} </a></span>
                     </div>
                     <div class="mt-2">
                        <p class="blogPara mt-0 mb-2">{!!@App\Helpers\Utilities::getFilterDescriptionHome($row->description, 3)!!} </p>
                        <div>
                           <a href="{{ url($row->url) }}" class="blogReadMore"> Read Full {{ $str_read }}</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
            <div class="col-md-12">
               {{ $data->links('pagination') }}
            </div>
            @else
               <div class="col-md-12 text-center pb-3 font-weight-bold">
                <hr>
                No record found in this category.
                </div>
                @endif
         </div>
         @include('front.includes.join_mailing')
      </div>
   </div>
</div>
<div class="col-md-3 RightColumnSection">
<!--- ****************** || Category of POP Wiki || **************** --->

@if(!empty($categories) && count($categories)>0)
<div class="popRecentBlog">
   <div class="RecentBlogHead mb-3">
    @php
      if(Request::segment(1)=='wiki') {
        @$category_type = 'Category of POP Wiki';
      } else if(Request::segment(1)=='rest-in-play') {
         @$category_type = 'Decades';
      } else if(Request::segment(1)=='entertainment') {
         @$category_type = 'Category of POP Entertainment';
      } else if(Request::segment(1)=='popcast') {
         @$category_type = 'Category of POP Cast';
      }
    @endphp
      <h4 class="mb-0">{{ @$category_type}} </h4>
   </div>
   <div class="PopCategoryList">
      <ul class="nav flex-column">
        @foreach($categories as $row)
         <li class="nav-item">
            <a class="nav-link" href="{{ url(Request::segment(1).'/'.$row->slug)}}"> {{ $row->name }}</a>
         </li>
         @endforeach
      </ul>
   </div>
</div>
@endif
<!--- ****************** || Category of POP Wiki || **************** --->
</div>
@endsection
@section('scripts')
<script type="text/javascript">
   function categoryFilter(e) {
     var id = $(e).val();
     window.location.href = "{{ url($str_cate_url) }}/"+id;
   }
</script>
@endsection
