@php
$base_url = url('/');
$int_count_related_blog_flag = 0;
$str_current_url =  url()->current();

$str_blog_description = '';

if(!empty($blog['description']))
{
 $str_blog_description = $blog['description'];
}

if(!empty($str_blog_description))
{ 
  $find_text = ['contenteditable="true"', 'type="text"'];
  $replace_text   = ['', ''];
  $str_blog_description = str_replace($find_text, $replace_text, $str_blog_description);
}


while( strpos($str_blog_description, '<p><br></p><p><br></p>') !== FALSE ) {
$str_blog_description = str_replace('<p><br></p><p><br></p>', '<p><br></p>', $str_blog_description);
}

while( strpos($str_blog_description, '<p class="ql-align-center"><br></p><p class="ql-align-center"><br></p>') !== FALSE ) {
$str_blog_description = str_replace('<p class="ql-align-center"><br></p><p class="ql-align-center"><br></p>', '<p class="ql-align-center"><br></p>', $str_blog_description);
}

//$str_blog_description = preg_replace("/+/", "", $str_blog_description);

@endphp
<style type="text/css">

  .ql-editor {
    white-space: normal!important;
  }

  .ql-align-right
  {
    text-align:right;
  }
  
  .ql-align-left
  {
    text-align:left;  
  }
  
  .ql-align-center
  {
    text-align:center;  
  }
    </style>
<div class="modal-header">
  <h3>Blog Preview</h3>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <div class="col-md-12 col-lg-12 MiddleColumnFullWidth">
      <div class="container-width">
       <div class="left-column colheightleft">
        <div class="First-column bg-white blogparagraph border_right">
         <div class="col-md-12 " >
           <div class="row sectionTop">
            <div class="col-sm-10 px-0">
              <h2 class="text-left blogDetHead">
                {{$blog['title']}}
                @php
                @$str_user_name = $blog['user'];
                $str_user_url_new = '';
                @endphp  
                <!-- <span class="span-text-grey">By: {{(!empty(@$str_user_name) ? @$str_user_name : 'People Of Play' )}} </span> -->
              </h2>
              <div class="mb-0">
                <p class="mb-0 span-text-grey" ><span class="span-text-grey">by <a class="span-text-grey" target="_blank" href="@if(!empty($str_user_url_new)){{$str_user_url_new}}@else{{'#'}} @endif">{{(!empty(@$str_user_name) ? @$str_user_name : 'People Of Play' )}} </a></span> <small class="span-text-grey ml-0 blogDate"> | {{@App\Helpers\Utilities::getDateFormat($blog['created_at'])}}</small> 
                </p>
                <p class="mb-0 span-text-grey" ><small class="span-text-grey ml-0 blogDate">@if(!empty($blog['blog_category_name'])){{@$blog['blog_category_name']}}@endif</small> 
                </p>
              </div>
            </div>

             <?php /*<div class="blogDetHeadImg mt-4" style="background-image: url('{{@newsBlogImageBasePath($blog['featured_image'])}}');">
             </div> */?>             
             <div class="mt-2 w-100">
              <img src="{{ @$blog['featured_image'] }}" class="imgDetailBlog">
            </div>          

          </div>
        </div>
        <div class="col-md-12">
         <div class="blogDetHeadRow blogDetailDes sectionTop" >
          <!-- p-text blogDetHeadDesc -->
          <p class="text-justify p-text">{!!$str_blog_description!!}</p>
        </div>
      </div>
      <div class="col-md-12 mb-5">
       <div class="blogDetHeadRow sectionTop">
        <div class="tags">
          <!-- <strong>Tag: </strong> -->
          @php $tags = array(); @endphp
          @if(!empty($blog['tag']))
            @php $tags = explode(',',$blog['tag']); @endphp
          @endif

          @foreach($tags as $k => $tag)
          <span class="tag_class"> {!!$tag!!}</span>
          @endforeach
        </div>
      </div>
    </div>                
  </div>
</div>
</div>
</div>
</div>
<input type="hidden" name="hid_current_url" id="hid_current_url" value="{{$str_current_url}}">   

@section('scripts')
<script>
  $(document).ready(function(){
    $('.ql-clipboard').css('display', 'none');
    $('.ql-tooltip').css('display', 'none');
  });
</script>
@endsection