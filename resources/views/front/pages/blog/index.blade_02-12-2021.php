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
   @media (max-width: 560px) {
   /*ul.pagination li:not(.show-mobile) {
   display: none;
   }*/
   .pagination {
   margin: 0 !important;
   }
   }
</style>
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
   <div class="containerWidth">
      <div class="left-column colheightleft border_right BlogListPage">
         <div class="First-column bg-white">
            <div class="col-md-12">
               <div class="row sectionBox" style="border-top: 1px solid transparent;">
                  <div class="col-md-5 col-sm-5 col-5 px-0">
                     <h1 class="Tile-style w-100 mb-0">
                        @if($type_post=='blog' || $type_post=='blog_pedia')
                        {{'Blogs'}}
                        @elseif($type_post=='AdminBlog')
                        {{'Featured Artical'}}
                        @else
                        {{'News'}}
                        @endif
                        @if(!empty($int_chk_is_my_blog_news))<span class="authername">({{ $str_user_name .' '}})</span>@endif
                     </h1>
                  </div>
                  <div class="col-md-7 col-sm-7 col-7 px-0">
                     <?php //echo "<pre>"; print_r($blog_categories); ?>
                     <div class="w-100 blog_Selectcategories text-right">
                        <div class="BlogCategories">
                           @if(isset($blog_categories) && !empty($blog_categories))
                           <select class="form-control " id="blogCategory" onchange="categoryFilter(this);">
                              <option value=""> -- Select Category -- </option>
                              @foreach ($blog_categories as $blog_cate)
                              <option <?php if(@$blog_cate->id == @$category_id) { echo 'selected'; } ?> value="{{ @$blog_cate->id }}"> {{  @$blog_cate->name }}</option>
                              @endforeach
                           </select>
                           @endif
                        </div>
                     </div>
                     <!--  -->
                  </div>
               </div>
            </div>
            @if(!empty($blogs) && count($blogs)>0) 
            @foreach ($blogs as $blog)
            @php
            if(!empty($blog->blog_data->user))          
            {
            @$str_user_name = App\Helpers\Utilities::getUserName($blog->blog_data->user);
            @$str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $blog->blog_data->user);
            }
            else
            {
            @$str_user_name = App\Helpers\Utilities::getUserName($blog->user);
            @$str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $blog->user);             
            }
            @$str_created_at = App\Helpers\Utilities::getDateFormat($blog->created_at);
            if($type_post == 'blog'  || $type_post =='blog_pedia')
            {
            $str_blog_detail = 'front.pages.blog.detail';
            }
            elseif($type_post == 'AdminBlog')
            {
            $str_blog_detail = 'front.pop_blogs.slug';
            }
            elseif($type_post == 'did-you-know')
            {
            $str_blog_detail = 'front.pages.did-you-know.detail';
            }
            else
            {
            $str_blog_detail = 'front.pages.news.detail'; 
            }
            @endphp
            <div class="col-md-12">
               <div class="row sectionBox">
                  <div class="col-sm-2 pl-0">
                     <div class="image-width justifly-content-center">
                        <a href="{{route($str_blog_detail, $blog->slug)}}" class="sec_head_text">
                        <img src="{{@newsBlogImageBasePath($blog->featured_image)}}" class="img-fluid imgOneSixtyFive">
                        </a>
                     </div>
                  </div>
                  <div class="col-sm-10 pl-0">
                     <div class="blogparagraph">
                        <a href="{{route($str_blog_detail, $blog->slug)}}" class="blogNewsTitle text-dark">
                           <h2 class="text-left blogNewsTitle mb-0">{{@$blog->title}}</h2>
                        </a>
                        <span class="span-text-grey">by: <a target="_blank" href="@if(!empty($str_user_url_new)){{$str_user_url_new}}@else{{'#'}}@endif">{{(!empty(@$str_user_name) ? @$str_user_name : 'People Of Play' )}} | {{@$str_created_at}} </a></span>
                     </div>
                     <div class="mt-2">
                        <p class="blogPara mt-0 mb-2">{!!@App\Helpers\Utilities::getFilterDescriptionHome($blog->description, 3)!!} </p>
                        <div>
                           <a href="{{route($str_blog_detail, $blog->slug)}}" class="blogReadMore"> Read Full Blog</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
            <div class="col-md-12">
               {{ $blogs->links('pagination') }}
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
<?php 
if(Request::segment(1) == 'blog_pedia'){
   $searchUrl = Request::segment(1);
} else {
   $searchUrl = Request::segment(1)."/search";
}
?>
@endsection
@section('scripts')
<script type="text/javascript">
   function categoryFilter(e) {
     var id = $(e).val();
     window.location.href = "{{ url($searchUrl) }}/"+id;
   }
</script>
@endsection