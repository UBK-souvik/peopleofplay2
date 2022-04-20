@extends('admin.layouts.master')

@section('title') {{ adminTransLang('detail') }} @endsection

  <link rel="stylesheet" href="{{url('front/new/css/style_two.css')}}">
<style>
    .table-striped tbody tr {
        text-align: inherit;
    }
      img#blah { width: 100px;    height: 100px; }
      .accordion__header {
        padding: 1em;
        background-color: #ccc;
        margin-top: 2px;
        display: -webkit-box;
        display: flex;
        -webkit-box-pack: justify;
                justify-content: space-between;
        -webkit-box-align: center;
                align-items: center;
        cursor: pointer;
      }

      .accordion__header > * {
        margin-top: 0;
        margin-bottom: 0;
        font-size: 16px;
        font-weight: 500;
        /*color: #000;*/
      }

      .accordion__header.is-active {
        background-color: #000;
        color: #fff!important;
      }

      .accordion__toggle {
        margin-left: 10px;
        height: 3px;
        background-color: #222;
        width: 13px;
        display: block;
        position: relative;
        flex-shrink: 1;
        border-radius: 2px;
      }

      .accordion__toggle::before {
        content: "";
        width: 3px;
        height: 13px;
        display: block;
        background-color: #222;
        position: absolute;
        top: -5px;
        left: 5px;
        border-radius: 2px;
      }

      .is-active .accordion__toggle {
        background-color: #fff;
      }

      .is-active .accordion__toggle::before {
        display: none;
      }

      .accordion__body {
        display: none;
        padding: 1em;
        border: 1px solid #ccc;
        border-top: 0;
      }

      .accordion__body.is-active {
        display: block;
      }
      .adduserbutton{
          margin-top: 8px;
      }
      .inner_heading{
        font-size: 20px;
      }
</style>
@section('content')

<?php
  if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('category_id')[0]) ){
      $category1 = $brand_list->categories->pluck('category_id')[0];
  } else {
      $category1 = 0;
  }

  if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('category_id')[1]) ){
      $category2 = $brand_list->categories->pluck('category_id')[1];
  } else {
      $category2 = 0;
  }

  if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('category_id')[2]) ){
      $category3 = $brand_list->categories->pluck('category_id')[2];
  } else {
      $category3 = 0;
  }

  if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('sub_category_id')[0]) ){
      $sub_category1 = $brand_list->categories->pluck('sub_category_id')[0];
  } else {
      $sub_category1 = 0;
  }

  if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('sub_category_id')[1]) ){
      $sub_category2 = $brand_list->categories->pluck('sub_category_id')[1];
  } else {
      $sub_category2 = 0;
  }

  if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('sub_category_id')[2]) ){
      $sub_category3 = $brand_list->categories->pluck('sub_category_id')[2];
  } else {
      $sub_category3 = 0;
  }
?>
    <section class="content-header">
        <h1> {{ adminTransLang('detail') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.brand_lists.index') }}">All Brands</a></li>
            <li class="active">{{ adminTransLang('detail') }}</li>
        </ol>
    </section>

    <section class="content">
        <p>
            <a class="btn btn-success btn-floating" href="{{ route('admin.brand_list.update', ['?id' => $brand_list->id]) }}">{{ adminTransLang('update') }}</a>
        </p>
        <div class="row">
           <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal">
                            <div class="accordion">
                              <div class="accordion__header is-active">
                                  <h2>Basic Details</h2>
                                  <span class="accordion__toggle"></span>
                              </div>
                              <div class="accordion__body is-active">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th>Main Image</th>
                                                <td>
                                                    @if(@$brand_list->main_image)
                                                        <img id="blah" width="100" height="70" src="{{imageBasePath($brand_list->main_image)}}" class="imgHundred">
                                                    @else
                                                        <img id="blah" src="#" alt="Preview" class="img-fluid imgHundred">
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Brand by</th>
                                                <td>
                                                    @if(count($users) > 0)
                                                        @foreach($users as $key => $user)
                                                            @if($brand_list->user_id  == $user->id )
                                                                {{$user->text}}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                    <th>Brand ID</th>
                                                    <td>{{ @$brand_list->brand_list_id_number }}</td>
                                            </tr>
                                            <tr>
                                                <th>Brand Name</th>
                                                <td>{{ @$brand_list->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Group Name</th>
                                                <td>
                                                    @foreach(config('cms.group') as $key => $value)
                                                        @if(!empty($brand_list->group_id) && $brand_list->group_id == $key ) 
                                                            {{$value}} 
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Category 1</th>
                                                <td>
                                                    @foreach (category() as $index => $value)
                                                        @if($index == @$category1) 
                                                            {{$value}}
                                                        @endif
                                                    @endforeach 
                                                </td>
                                            </tr>
                                            @if(!empty($category2) && !empty($sub_category2))
                                                <tr>
                                                    <th>Category 2</th>
                                                    <td>
                                                        @foreach (category() as $index => $value)
                                                            @if($index == @$category2) 
                                                                {{$value}}
                                                            @endif
                                                        @endforeach 
                                                    </td>
                                                </tr>
                                            @endif
                                            @if(!empty($category3) && !empty($sub_category3))
                                                <tr>
                                                    <th>Category 3</th>
                                                    <td>
                                                        @foreach (category() as $index => $value)
                                                            @if($index == @$category3) 
                                                                {{$value}}
                                                            @endif
                                                        @endforeach 
                                                    </td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <th>Brand Description</th>
                                                <td>{!! $brand_list->description !!}</td>
                                            </tr>
											
                                                <tr>
                                                    <th>Manufacturer</th>
                                                    <td>{{ @$brand_list->company }}</td>
                                                </tr>

                                            <tr>
                                                <th>Brand URL</th>
                                                <td><a target="_blank" href="{{url('brand/'.$brand_list->slug)}}">{{$brand_list->slug}}</a></td>
                                            </tr>
                                                <tr>
                                                    <th>Fun Fact 1</th>
                                                    <td>{{ @$brand_list->fun_fact1 }}</td>
                                                </tr>
                                            {{--    
                                            @if(!empty($brand_list->fun_fact1) )
                                            @endif
                                            @if(!empty($brand_list->fun_fact2) )
                                            @endif
                                            @if(!empty($brand_list->fun_fact3) )
                                            @endif --}}
                                                <tr>
                                                    <th>Fun Fact 2</th>
                                                    <td>{{ @$brand_list->fun_fact2 }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Fun Fact 3</th>
                                                    <td>{{ @$brand_list->fun_fact3 }}</td>
                                                </tr>
                                        </tbody>
                                    </table>
                              </div>
                              <div class="accordion__header">
                                  <h2>Buy a copy</h2>
                                  <span class="accordion__toggle"></span>
                              </div>
                              <div class="accordion__body">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th>{{ $brand_list->buyFrom->amazon_caption }}</th>
                                                <td>{{ $brand_list->buyFrom->amazon }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ $brand_list->buyFrom->ebay_caption }}</th>
                                                <td>{{ $brand_list->buyFrom->ebay }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ $brand_list->buyFrom->pop_caption }}</th>
                                                <td>{{ $brand_list->buyFrom->pop }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                              </div>
                              

                              <div class="accordion__header">
                                  <h2>Offical Links</h2>
                                  <span class="accordion__toggle"></span>
                              </div>
                              <div class="accordion__body">
                                  <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th>URL </th>
                                                <td>{{ substr(@$brand_list->officialLinks[0]->value,0,50) }}...</td>
                                            </tr>
                                            <tr>
                                                <th>URL </th>
                                                <td>{{ substr(@$brand_list->officialLinks[1]->value,0,50) }}...</td>
                                            </tr>
                                        </tbody>
                                  </table>
                              </div>

                                <div class="accordion__header">
                                    <h2>Social Media</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body">
                                    <div class="row social_media">
                                        @foreach(config('cms.social_media') as $index => $social)
                                            @php
                                              $str_social_val = '';
                                              if(!empty($brand_list->socialMedia))
                                              {   
                                                $str_social_val = @$brand_list->socialMedia->pluck('value','type')->toArray()[$index];
                                              }
                                            @endphp 
                                                <div class="col-md-3" >
                                                    <div class="form-group" style="margin-left: 0px !important;margin-right: 0px !important;">
                                                        <label for="{{ $social }}">{{ $social }}</label>
                                                        <input type="url" readonly="" id="{{ $social }}" name="socials[{{$index}}]"
                                                         value="{{$str_social_val}}"
                                                             class="form-control">
                                                    </div>
                                                </div>
                                        @endforeach
                                    </div>
                                </div>

							  
							  {{-- 
                              <div class="accordion__header">
                                  <h2>BrandList Metadata</h2>
                                  <span class="accordion__toggle"></span>
                              </div>
                              <div class="accordion__body">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                                <tr>
                                                    <th>Brand</th>
                                                    <td>{{ @$brand_list->brand }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Company</th>
                                                    <td>{{ @$brand_list->company }}</td>
                                                </tr>
                                        </tbody>
                                    </table>
                              </div> --}}
							  
							  
                            </div>
                        </form>
                    </div>
                </div>
           </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#basic-info-tab">{{ adminTransLang('basic_info') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="basic-info-tab">
                            <table class="table table-striped table-bordered no-margin">
                                <tbody>
                                    <tr>
                                        <th>Main Image</th>
                                        <td>
                                            @if(@$brand_list->main_image)
                                                <img id="blah" width="100" height="70" src="{{imageBasePath($brand_list->main_image)}}" class="imgHundred">
                                            @else
                                                <img id="blah" src="#" alt="Preview" class="img-fluid imgHundred">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>BrandList by</th>
                                        <td>
                                            @if(count($users) > 0)
                                                @foreach($users as $key => $user)
                                                    @if($brand_list->user_id  == $user->id )
                                                        {{$user->text}}
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                            <th>BrandList ID</th>
                                            <td>{{ @$brand_list->brand_list_id_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>BrandList Name</th>
                                        <td>{{ @$brand_list->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Category 1</th>
                                        <td>
                                            @foreach (category() as $index => $value)
                                                @if($index == @$category1) 
                                                    {{$value}}
                                                @endif
                                            @endforeach 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Sub Category 1</th>
                                        <td>
                                            @foreach (sub_categoryByCategoryID($category1) as $index => $value)
                                                @if($index == $sub_category1) 
                                                    {{$value}}
                                                @endif
                                            @endforeach 
                                        </td>
                                    </tr>
                                    @if(!empty($category2) && !empty($sub_category2))
                                        <tr>
                                            <th>Category 2</th>
                                            <td>
                                                @foreach (category() as $index => $value)
                                                    @if($index == @$category2) 
                                                        {{$value}}
                                                    @endif
                                                @endforeach 
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Sub Category 2</th>
                                            <td>
                                                @foreach (sub_categoryByCategoryID($category2) as $index => $value)
                                                    @if($index == $sub_category2) 
                                                        {{$value}}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                    @if(!empty($category3) && !empty($sub_category3))
                                        <tr>
                                            <th>Category 3</th>
                                            <td>
                                                @foreach (category() as $index => $value)
                                                    @if($index == @$category3) 
                                                        {{$value}}
                                                    @endif
                                                @endforeach 
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Sub Category 3</th>
                                            <td>
                                                @foreach (sub_categoryByCategoryID($category3) as $index => $value)
                                                    @if($index == $sub_category3) 
                                                        {{$value}}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th>BrandList Description</th>
                                        <td>{{ $brand_list->description }}</td>
                                    </tr>

                                    <tr>
                                        <th>URL</th>
                                        <td><a target="_blank" href="{{url('brand_list/'.$brand_list->slug)}}">{{$brand_list->slug}}</a></td>
                                    </tr>
                                    @if(!empty($brand_list->fun_fact1) )
                                        <tr>
                                            <th>Fun Fact 1</th>
                                            <td>{{ $brand_list->fun_fact1 }}</td>
                                        </tr>
                                    @endif
                                    @if(!empty($brand_list->fun_fact2) )
                                        <tr>
                                            <th>Fun Fact 2</th>
                                            <td>{{ $brand_list->fun_fact2 }}</td>
                                        </tr>
                                    @endif
                                    @if(!empty($brand_list->fun_fact3) )
                                        <tr>
                                            <th>Fun Fact 3</th>
                                            <td>{{ $brand_list->fun_fact3 }}</td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th>Amazon</th>
                                        <td>{{ $brand_list->buyFrom->amazon }}</td>
                                    </tr>
                                    <tr>
                                        <th>eBay</th>
                                        <td>{{ $brand_list->buyFrom->ebay }}</td>
                                    </tr>
                                    <tr>
                                        <th>PoP</th>
                                        <td>{{ $brand_list->buyFrom->pop }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="text-align: center;">Collaborators</th>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-striped edit_profileTbl">
                                <thead class="titlestyle table-dark">
                                    <tr>
                                        <th class="text-left">User Image</th>
                                        <th class="text-left">User Name</th>
                                        <th class="text-left">User Roles</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody_brand_listlist" id='table_append'>
                                  @foreach(@$brand_list->collaborators ?? [] as $collab)
                                    @php
                                     $collaborator_img_data = $collab->image;
                                    @endphp
                                      <tr class="" id="row_{{@$collab->id}}">
                                          <td class="verticalalign text-left pl-0">
                                            <img src="{{ url('/') }}{{ $collaborator_photos_folder }}{{ $collaborator_img_data }}" alt="" width="50px" height="50px" class="rounded-circle">
                                          </td>
                                          <td class="verticalalign text-left pl-0">{{$collab->name}}</td>
                                          <td class="verticalalign text-left pl-0">
                                            @foreach(users_user_roles() as $key => $value)
                                              @if(@$collab->role == $key)
                                                {{$value}}
                                              @endif
                                            @endforeach
                                          </td>
                                      </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="3" style="text-align: center;">Social Media</th>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="accordion__body">
                                <div class="row social_media">
                                    @foreach(config('cms.social_media') as $index => $social)
                                        @php
                                          $str_social_val = '';
                                          if(!empty($brand_list->socialMedia))
                                          {   
                                            $str_social_val = @$brand_list->socialMedia->pluck('value','type')->toArray()[$index];
                                          }
                                        @endphp 
                                            <div class="col-md-3" >
                                                <div class="form-group" style="margin-left: 0px !important;margin-right: 0px !important;">
                                                    <label for="{{ $social }}">{{ $social }}</label>
                                                    <input type="url" readonly="" id="{{ $social }}" name="socials[{{$index}}]"
                                                     value="{{$str_social_val}}"
                                                         class="form-control">
                                                </div>
                                            </div>
                                    @endforeach
                                </div>
                            </div>


                            <table class="table table-striped table-bordered no-margin">
                                <tbody>
                                    <tr>
                                        <th>Delivery Mechanism</th>
                                        <td>
                                            @foreach (config('cms.delivery_mechanism') as $index => $value)
                                                @if($brand_list->classification->delivery_mechanism == $index)
                                                    {{$value}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Toy Type</th>
                                        <td>
                                            @foreach (config('cms.toy_type') as $index => $value)
                                                @if(@$brand_list->classification->toy_type == $index) 
                                                    {{$value}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Launched </th>
                                        <td>{{ @$brand_list->classification->launched }}</td>
                                    </tr>
                                    <tr>
                                        <th>Inventor </th>
                                        <td>{{ @$brand_list->classification->inventor }}</td>
                                    </tr>
                                    <tr>
                                        <th>Team </th>
                                        <td>{{ @$brand_list->classification->team }}</td>
                                    </tr>
                                    <tr>
                                        <th>Url 1 </th>
                                        <td>{{ @$brand_list->classification->team }}</td>
                                    </tr>
                                    <tr>
                                        <th>Url 2 </th>
                                        <td>{{ @$brand_list->classification->team }}</td>
                                    </tr>

                                    <tr>
                                        <th>Average Rating</th>
                                        <td>{{ @$brand_list->statics->rating }}</td>
                                    </tr>

                                    <tr>
                                        <th>Number of Ratings</th>
                                        <td>{{ @$brand_list->statics->number_of_ratings }}</td>
                                    </tr>

                                    <tr>
                                        <th>Standard Deviation</th>
                                        <td>{{ @$brand_list->statics->standard_deviation }}</td>
                                    </tr>
                                    <tr>
                                        <th>Comments</th>
                                        <td>{{ @$brand_list->statics->comments }}</td>
                                    </tr>
                                    <tr>
                                        <th>Page Views</th>
                                        <td>{{ @$brand_list->statics->page_views }}</td>
                                    </tr>
                                    <tr>
                                        <th>Overall Rank</th>
                                        <td>{{ @$brand_list->statics->overall_rank }}</td>
                                    </tr>
                                    <tr>
                                        <th>Party Rank</th>
                                        <td>{{ @$brand_list->statics->party_rank }}</td>
                                    </tr>
                                    <tr>
                                        <th>All Time Plays</th>
                                        <td>{{ @$brand_list->statics->all_time_plays }}</td>
                                    </tr>
                                    <tr>
                                        <th>This month</th>
                                        <td>{{ @$brand_list->statics->this_month }}</td>
                                    </tr>
                                    <tr>
                                        <th>Parts Exchange</th>
                                        <td>{{ @$brand_list->statics->has_part }}</td>
                                    </tr> 
                                    <tr>
                                        <th>Wants Parts</th>
                                        <td>{{ @$brand_list->statics->wants_part }}</td>
                                    </tr>

                                    <tr>
                                        <th>Own</th>
                                        <td>{{ @$brand_list->statics->own }}</td>
                                    </tr>
                                     <tr>
                                        <th>Previously Owned</th>
                                        <td>{{ @$brand_list->statics->previously_owned }}</td>
                                    </tr>
                                     <tr>
                                        <th>For Trade</th>
                                        <td>{{ @$brand_list->statics->for_trade }}</td>
                                    </tr>
                                     <tr>
                                        <th>Want In Trade</th>
                                        <td>{{ @$brand_list->statics->want_it_trade }}</td>
                                    </tr>
                                     <tr>
                                        <th>Wishlist</th>
                                        <td>{{ @$brand_list->statics->wishlist }}</td>
                                    </tr>
                                     <tr>
                                        <th>Brand</th>
                                        <td>{{ @$brand_list->brand }}</td>
                                    </tr>
                                    <tr>
                                        <th>Company</th>
                                        <td>{{ @$brand_list->company }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </section>
@endsection


@section('scripts')
<script>
  $('.accordion__header').click(function(e) {
      e.preventDefault();
      var currentIsActive = $(this).hasClass('is-active');
      $(this).parent('.accordion').find('> *').removeClass('is-active');
      if(currentIsActive != 1) {
        $(this).addClass('is-active');
        $(this).next('.accordion__body').addClass('is-active');
      }
    });
</script>
@endsection