@extends('front.layouts.pages')
@section('content')
<div class="col-md-6 col-lg-7 MiddleColumnSection">
<div class="left-column border_right PopEvent">
    <div class="First-column bg-white sectionBoxPadding p-3">
        <h3 class="Tile-style social mb-3 pt-0">All Events</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <button type="button"
                        onclick="return location = '{{ route('front.user.event.create') }}'"
                        class="btn edit-btn-style">
                        Add New +
                    </button>
                </div>
            </div>
            {{-- <div class="col-md-8">
                <div class="form-group">
                    <input id="Searchbar" type="search" name="Searchbar" class="form-control searchaward"
                        placeholder="Search Event">
                </div>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive text-nowrap">
                    <!--Table-->
                    <table class="table table-striped kproductTbl">
                        <thead class="titlestyle table-dark">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Website</th>
                                {{-- <th>Year</th> --}}
                                <th>Awards</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody class="tbody_productlist">
                            @if(count($events) > 0)
                                @foreach($events as $event)
                                    <tr>
                                        <td><img src="{{@prodEventImageBasePath(@$event->main_image)}}" class="imgfifty"> </td>
                                        <td class="verticalalign text-center"><a class="span-style1" href="{{route('front.pages.event.detail',$event->slug)}}">{{ $event->name }}</a></td>
    									<td class="verticalalign">
                                           <a target="_blank" class="span-style1" href="{{@$event->website}}">{{@$event->website}}</a>
                                        </td>
                                        <td class="verticalalign">
                                            <a href="{{route('front.user.event.award.index',$event->id)}}">Add Awards</a>
                                        </td>
                                        <td class="verticalalign">
                                            <span class="table-edit">
                                                <a href="{{route('front.user.event.update',$event->slug ?? null)}}"
                                                    class="span-style1 my-0">Edit</a>
                                            </span>
                                        </td>
                                        <td class="verticalalign">
                                            <span class="table-delete">
                                                <a href="{{route('front.user.event.delete',$event->slug ?? null)}}"  onclick="return confirm('Are you sure?');"
                                                    class="span-style1 my-0 text-danger">Delete</a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5"><p>The Event list is empty - Please click Add new to add New Events.</p></td>
                                </tr>
                            @endif
                        </tbody>
                        <!--Table body-->

                    </table>
                    <div class="div">
                        {{$events->render()}}

                    </div>
                    <!--Table-->
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<script>

var event_data_deleted_flag = '{{ Session::has("event_data_deleted_flag") }}';

function eventSaveMessage(){
     
     if(event_data_deleted_flag =="1" || event_data_deleted_flag ==1)
     {
       toastr.success("Event Deleted Successfully.");
     }
	 
   }
   window.onload = eventSaveMessage;
</script>

@endsection


