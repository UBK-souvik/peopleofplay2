@extends('front.layouts.pages')
@section('content')
<div class="left-column border_right">
    <div class="First-column bg-white p-3">
        <h3 class="Tile-style social mb-3 pt-0">All Did You Know</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <button type="button"
                        onclick="return location = '{{ route('front.user.news.create') }}'"
                        class="btn edit-btn-style">
                        Add New +
                    </button>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group" style="display: none;">
                    <input id="Searchbar" type="search" name="Searchbar" class="form-control searchaward"
                        placeholder="Search News">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive text-nowrap">
                    <!--Table-->
                    <table class="table table-striped kproductTbl">
                        <thead class="titlestyle table-dark">
                            <tr>
                                <th>Featured Image</th>
                                <th>Title</th>
                                {{-- <th>Category</th> --}}
                                <!-- <th>Description</th> -->
                                <!-- <th>Tag</th> -->
                                <th>Created At</th>
                                <!-- <th>Status</th> -->
                                <th>View</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                        </thead>
                        <tbody class="tbody_productlist">
                            @if(count($news) > 0)
                                @foreach($news as $new)
                                    <tr>
                                        <td><img width="50" src="{{@newsBlogImageBasePath(@$new->featured_image)}}" class="imgfifty"> </td>
                                        <td class="verticalalign">{{ $new->title }}</td>
                                        
                                        {{-- <td class="verticalalign">
                                           {{@}}
                                        </td> --}}
                                        <!-- <td class="verticalalign">{!! \Illuminate\Support\Str::words($new->description, 10,'....') !!}</td> -->
                                        <!-- <td class="verticalalign">{{ $new->tag }}</td> -->
                                        <td class="verticalalign">{{ $new->created_at }}</td>
    								{{-- <td class="verticalalign">{{ @config('cms.blog_status')[$new->status] }}</td> --}}
                                        <td class="verticalalign">
                                            <span class="table-edit">
                                                <a href="{{route('front.pages.did-you-know.detail',$new->slug ?? '')}}"
                                                    class="span-style1 my-0 text-primary">View</a>
                                            </span>
                                        </td>
                                        <td class="verticalalign">
                                            <span class="table-edit">
                                                <a href="{{route('front.user.news.update',$new->slug ?? '')}}"
                                                    class="span-style1 my-0">Edit</a>
                                            </span>
                                        </td>
                                        <td class="verticalalign">
                                            <span class="table-delete">
                                                <a href="{{route('front.user.news.delete',$new->slug ?? '')}}"
                                                onclick="return confirm('Are you sure?');"
                                                    class="span-style1 my-0 text-danger">Delete</a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else 
                                <tr>
                                    <td colspan="6"><p>The Did You Know list is empty - Please click Add new to add New Did You Know.</p></td>
                                </tr>
                            @endif
                        </tbody>
                        <!--Table body-->

                    </table>
                    <div class="div">
                        {{$news->render()}}

                    </div>
                    <!--Table-->
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var news_data_saved_flag = '{{ Session::has("news_data_saved_flag") }}';

    var news_data_deleted_flag = '{{ Session::has("news_data_deleted_flag") }}';

    function newsSaveMessage(){
         
         if(news_data_saved_flag!="")
         {
         //toastr.success("News Saved Successfully.");
         }
    	 
    	 if(news_data_deleted_flag!="")
         {
           toastr.success("News Deleted Successfully.");
         }
    	 
    }

   window.onload = newsSaveMessage;
</script>

@endsection
