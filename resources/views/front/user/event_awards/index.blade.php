@extends('front.layouts.pages')
@section('content')
<div class="col-md-6 col-lg-7 MiddleColumnSection">
<div class="left-column border_right">
    <div class="First-column bg-white p-3">
        <h3 class="Tile-style social mb-3 pt-0">All Awards ({{$event->name}})</h3>  
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <button type="button"
                        onclick="return location = '{{ route('front.user.event.award.create',$event_id) }}'"
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
                                <th>Award Name</th>
                                <th>Type</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody class="tbody_productlist">
                            @foreach($event_awards as $event_award)
                                <tr>
                                    <td class="verticalalign text-left">{{ $event_award->name }}</td>
									<td class="verticalalign text-left">
                                       {{@config('cms.award_type')[$event_award->type]}}
                                    </td>
                                    <td class="verticalalign text-left">
                                        <span class="table-edit">
                                            <a href="{{route('front.user.event.award.update',$event_award->id ?? null)}}" 
                                                class="span-style1 my-0">Edit</a>
                                        </span>
                                    </td>
                                    <td class="verticalalign text-left">
                                        <span class="table-delete">
                                            <a href="{{route('front.user.event.award.delete',$event_award->id ?? null)}}" onclick="return confirm('Are you sure?');"
                                                class="span-style1 my-0 text-danger">Delete</a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!--Table body-->

                    </table>
                    <div class="div">
                        {{$event_awards->render()}}

                    </div>
                    <!--Table-->
                </div>
            </div>
        </div>

    </div>
</div>
</div>

@endsection


