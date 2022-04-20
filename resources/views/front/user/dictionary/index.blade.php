@extends('front.layouts.pages')
@section('content')
<style>
    /*.k_table thead th {
        text-align: center;
        font-size: 15px!important;
    }*/
</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
<div class="left-column border_right">
    <div class="First-column bg-white p-3">
        <h3 class="Tile-style social mb-3 pt-0">My Dictionary List</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <button type="button"
                        onclick="return location = '{{ route('front.user.dictionary.create') }}'"
                        class="btn edit-btn-style">
                        Add New +
                    </button>
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
                                <th>Word</th>
                                <th>Created At</th>
                                <th>View</th>
								<th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                        </thead>
                        <tbody class="tbody_productlist">
                            @if(count($dictionaries) > 0)
                                @foreach($dictionaries as $dictionary)
                                    <tr>
                                        <td class="verticalalign">{{ $dictionary->title }}</td>
                                        <td class="verticalalign">{{ $dictionary->created_at }}</td>
    									
										<td class="verticalalign">
                                            <span class="table-edit">
											
											    @if($dictionary->status == 1)
                                                <a href="{{route('front.pages.word.detail',$dictionary->slug ?? '')}}" 
                                                    class="span-style1 my-0 text-primary">View</a>
												@endif	
                                            </span>
                                        </td>
                                       
                              <td class="verticalalign">
                                            <span class="table-edit">
											{{config('cms.dictionary_status')[$dictionary->status]}} 
                                            </span>
                                        </td>									   
										
										<td class="verticalalign">
                                            <span class="table-edit">
                                                <a href="{{route('front.user.dictionary.update',$dictionary->slug ?? '')}}" 
                                                    class="span-style1 my-0">Edit</a>
                                            </span>
                                        </td>
                                        <td class="verticalalign">
                                            <span class="table-delete">
                                                <a href="{{route('front.user.dictionary.delete',$dictionary->slug ?? '')}}"
                                                    onclick="return confirm('Are you sure?');"
    												class="span-style1 my-0 text-danger">Delete</a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7"><p>The Dictionary list is empty - Please click Add new to add New Dictionary.</p></td>
                                </tr>
                            @endif
                        </tbody>
                        <!--Table body-->

                    </table>
                    <div class="div">
                        {{$dictionaries->render()}}

                    </div>
                    <!--Table-->
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<script>

var dictionary_data_saved_flag = '{{ Session::has("dictionary_data_saved_flag") }}';

var dictionary_data_deleted_flag = '{{ Session::has("dictionary_data_deleted_flag") }}';

function dictionarySaveMessage(){
     
     if(dictionary_data_saved_flag!="")
     {
       //toastr.success("Dictionary Saved Successfully.");
     }
	 
	 if(dictionary_data_deleted_flag!="")
     {
       toastr.success("Dictionary Deleted Successfully.");
     }
     
   }
   window.onload = dictionarySaveMessage;
</script>   

@endsection