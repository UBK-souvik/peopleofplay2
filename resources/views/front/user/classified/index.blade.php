@extends('front.layouts.pages')
@section('content')
<style>
    /*.k_table thead th {
        text-align: center;
        font-size: 15px!important;
    }*/
</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection"> 
<div class="left-column border_right ProfileClassified">
    <div class="First-column bg-white p-3">
        <h3 class="Tile-style social mb-3 pt-0">My Classified Posts</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <button type="button"
                        onclick="return location = '{{ route('front.user.classified.create') }}'"
                        class="btn edit-btn-style">
                        Add New +
                    </button>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group" style="display: none;">
                    <input id="Searchbar" type="search" name="Searchbar" class="form-control searchaward"
                        placeholder="Search Classified">
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
                                <th>Title</th>
                                <th>Category</th>
                                <!-- <th>Description</th> -->
                                <!-- <th>Tag</th> -->
                                <th>Created At</th>
                                <!-- <th>Status</th> -->
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                        </thead>
                        <tbody class="tbody_productlist">
                            @if(count($classifieds) > 0)
                                @foreach($classifieds as $classified)
                                    <tr>
                                        <td class="verticalalign">{{ $classified->title }}</td>
                                        <td class="verticalalign">
                                           {{@$classified->category->name}}
                                        </td>
                                        <!-- <td class="verticalalign">{!! $classified->description !!}</td> -->
                                        <!-- <td class="verticalalign">{{ $classified->tag }}</td> -->
                                        <td class="verticalalign">{{ $classified->created_at }}</td>
                                        <td class="verticalalign">
                                            <span class="table-edit">
                                                <a href="{{route('front.user.classified.update',$classified->slug ?? '')}}" 
                                                    class="span-style1 my-0">Edit</a>
                                            </span>
                                        </td>
                                        <td class="verticalalign">
                                            <span class="table-delete">
                                                <a href="{{route('front.user.classified.delete',$classified->slug ?? '')}}"
                                                    onclick="return confirm('Are you sure?');"
    												class="span-style1 my-0 text-danger">Delete</a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7"><p>The Classified list is empty - Please click Add new to add New Classifieds.</p></td>
                                </tr>
                            @endif
                        </tbody>
                        <!--Table body-->

                    </table>
                    <div class="div">
                        {{$classifieds->render()}}

                    </div>
                    <!--Table-->
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<script>

var classified_data_saved_flag = '{{ Session::has("classified_data_saved_flag") }}';

var classified_data_deleted_flag = '{{ Session::has("classified_data_deleted_flag") }}';

function classifiedSaveMessage(){
     
     if(classified_data_saved_flag!="")
     {
       //toastr.success("Classified Saved Successfully.");
     }
	 
	 if(classified_data_deleted_flag!="")
     {
       toastr.success("Classified Deleted Successfully.");
     }
     
   }
   window.onload = classifiedSaveMessage;
</script>   

@endsection
