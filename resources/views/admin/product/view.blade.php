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
  if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('category_id')[0]) ){
      $category1 = $product->categories->pluck('category_id')[0];
  } else {
      $category1 = 0;
  }

  if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('category_id')[1]) ){
      $category2 = $product->categories->pluck('category_id')[1];
  } else {
      $category2 = 0;
  }

  if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('category_id')[2]) ){
      $category3 = $product->categories->pluck('category_id')[2];
  } else {
      $category3 = 0;
  }

  if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('sub_category_id')[0]) ){
      $sub_category1 = $product->categories->pluck('sub_category_id')[0];
  } else {
      $sub_category1 = 0;
  }

  if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('sub_category_id')[1]) ){
      $sub_category2 = $product->categories->pluck('sub_category_id')[1];
  } else {
      $sub_category2 = 0;
  }

  if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('sub_category_id')[2]) ){
      $sub_category3 = $product->categories->pluck('sub_category_id')[2];
  } else {
      $sub_category3 = 0;
  }
?>
    <section class="content-header">
        <h1> {{ adminTransLang('detail') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.products.index') }}">All Products</a></li>
            <li class="active">{{ adminTransLang('detail') }}</li>
        </ol>
    </section>

    <section class="content">
        <p>
            <a class="btn btn-success btn-floating" href="{{ route('admin.product.update', ['?id' => $product->id]) }}">{{ adminTransLang('update') }}</a>
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
                                                    @if(@$product->main_image)
                                                        <img id="blah" width="100" height="70" src="{{imageBasePath($product->main_image)}}" class="imgHundred">
                                                    @else
                                                        <img id="blah" src="#" alt="Preview" class="img-fluid imgHundred">
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Product by</th>
                                                <td>
                                                    @if(count($users) > 0)
                                                        @foreach($users as $key => $user)
                                                            @if($product->user_id  == $user->id )
                                                                {{$user->text}}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                    <th>Product ID</th>
                                                    <td>{{ @$product->product_id_number }}</td>
                                            </tr>
                                            <tr>
                                                <th>Product Name</th>
                                                <td>{{ @$product->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Group Name</th>
                                                <td>
                                                    @foreach(config('cms.group') as $key => $value)
                                                        @if(!empty($product->group_id) && $product->group_id == $key ) 
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
                                                <th>Product Description</th>
                                                <td>{!! $product->description !!}</td>
                                            </tr>
											
											<tr>
                                                    <th>Brand</th>
                                                    <td>{{ @$product->brand }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Manufacturer</th>
                                                    <td>{{ @$product->company }}</td>
                                                </tr>

                                            <tr>
                                                <th>Product URL</th>
                                                <td><a target="_blank" href="{{url('product/'.$product->slug)}}">{{$product->slug}}</a></td>
                                            </tr>
                                                <tr>
                                                    <th>Fun Fact 1</th>
                                                    <td>{{ @$product->fun_fact1 }}</td>
                                                </tr>
                                            {{--    
                                            @if(!empty($product->fun_fact1) )
                                            @endif
                                            @if(!empty($product->fun_fact2) )
                                            @endif
                                            @if(!empty($product->fun_fact3) )
                                            @endif --}}
                                                <tr>
                                                    <th>Fun Fact 2</th>
                                                    <td>{{ @$product->fun_fact2 }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Fun Fact 3</th>
                                                    <td>{{ @$product->fun_fact3 }}</td>
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
                                                <th>{{ $product->buyFrom->amazon_caption }}</th>
                                                <td>{{ $product->buyFrom->amazon }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ $product->buyFrom->ebay_caption }}</th>
                                                <td>{{ $product->buyFrom->ebay }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ $product->buyFrom->pop_caption }}</th>
                                                <td>{{ $product->buyFrom->pop }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                              </div>
                              <div class="accordion__header">
                                  <h2>Collaborators</h2>
                                  <span class="accordion__toggle"></span>
                              </div>
                              <div class="accordion__body">
                                    <table class="table table-striped edit_profileTbl">
                                        <thead class="titlestyle table-dark">
                                            <tr>
                                                <!-- <th class="text-left">User Image</th> -->
                                                <th class="text-left">User Name</th>
                                                <th class="text-left">User Roles</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbody_productlist" id='table_append'>
                                          @foreach(@$product->collaborators ?? [] as $collab)
                                            @php
                                               $collaborator_img_data = $collab->image;
											 
											   $str_user_name = @App\Helpers\Utilities::getUserName(@$collab->collaboratorData);
											   $collaborator_img_data = @imageBasePath(@$collab->collaboratorData->profile_image);
											   
												if(!empty($str_user_name))
												{
													
												}	  
												else
												{
													$str_user_name =  @$collab->name;
												}
											 
                                            @endphp
                                              <tr class="" id="row_{{@$collab->id}}">
                                                  
												  {{-- <td class="verticalalign text-left pl-0">
                                                    <img src="{{ url('/') }}{{ $collaborator_photos_folder }}{{ $collaborator_img_data }}" alt="" width="50px" height="50px" class="rounded-circle">
                                                  </td> --}}
												  
                                                  <td class="verticalalign text-left pl-0">{{$str_user_name}}</td>
                                                  <td class="verticalalign text-left pl-0">
                                                    @foreach(users_user_roles() as $key => $value)
                                                      @if(@$collab->role == $key)
                                                        {{$value}}
                                                      @endif
                                                    @endforeach
                                                  </td>
                                              </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                              </div>

                              <div class="accordion__header">
                                  <h2>Classification</h2>
                                  <span class="accordion__toggle"></span>
                              </div>
                              <div class="accordion__body">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th>Delivery Mechanism</th>
                                                <td>
                                                    @foreach (config('cms.delivery_mechanism') as $index => $value)
                                                        @if($product->classification->delivery_mechanism == $index)
                                                            {{$value}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Toy Type</th>
                                                <td>
                                                    @foreach (config('cms.toy_type') as $index => $value)
                                                        @if(@$product->classification->toy_type == $index) 
                                                            {{$value}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Launched </th>
                                                <td>{{ @$product->classification->launched }}</td>
                                            </tr>
											
                                            {{--<tr>
                                                <th>Inventor </th>
                                                <td>{{ @$product->classification->inventor }}</td>
                                            </tr> --}}
											
                                            <tr>
                                                <th>Team </th>
                                                <td>{{ @$product->classification->team }}</td>
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
                                                <td>{{ substr(@$product->officialLinks[0]->value,0,50) }}...</td>
                                            </tr>
                                            <tr>
                                                <th>URL </th>
                                                <td>{{ substr(@$product->officialLinks[1]->value,0,50) }}...</td>
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
                                              if(!empty($product->socialMedia))
                                              {   
                                                $str_social_val = @$product->socialMedia->pluck('value','type')->toArray()[$index];
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

                              <div class="accordion__header">
                                  <h2>Statistics</h2>
                                  <span class="accordion__toggle"></span>
                              </div>
                              <div class="accordion__body">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th>Average Rating</th>
                                                <td>{{ @$product->statics->rating }}</td>
                                            </tr>

                                            <tr>
                                                <th>Number of Ratings</th>
                                                <td>{{ @$product->statics->number_of_ratings }}</td>
                                            </tr>

                                            <tr>
                                                <th>Standard Deviation</th>
                                                <td>{{ @$product->statics->standard_deviation }}</td>
                                            </tr>
                                            <tr>
                                                <th>Comments</th>
                                                <td>{{ @$product->statics->comments }}</td>
                                            </tr>
                                            <tr>
                                                <th>Page Views</th>
                                                <td>{{ @$product->statics->page_views }}</td>
                                            </tr>
                                            <tr>
                                                <th>Overall Rank</th>
                                                <td>{{ @$product->statics->overall_rank }}</td>
                                            </tr>
                                            <tr>
                                                <th>Party Rank</th>
                                                <td>{{ @$product->statics->party_rank }}</td>
                                            </tr>
                                            <tr>
                                                <th>All Time Plays</th>
                                                <td>{{ @$product->statics->all_time_plays }}</td>
                                            </tr>
                                            <tr>
                                                <th>This month</th>
                                                <td>{{ @$product->statics->this_month }}</td>
                                            </tr>
                                            <tr>
                                                <th>Parts Exchange</th>
                                                <td>{{ @$product->statics->has_part }}</td>
                                            </tr> 
                                            <tr>
                                                <th>Wants Parts</th>
                                                <td>{{ @$product->statics->wants_part }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                              </div>

                              <div class="accordion__header">
                                  <h2>Collection Stats</h2>
                                  <span class="accordion__toggle"></span>
                              </div>
                              <div class="accordion__body">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                                <tr>
                                                    <th>Own</th>
                                                    <td>{{ @$product->statics->own }}</td>
                                                </tr>
                                                 <tr>
                                                    <th>Previously Owned</th>
                                                    <td>{{ @$product->statics->previously_owned }}</td>
                                                </tr>
                                                 <tr>
                                                    <th>For Trade</th>
                                                    <td>{{ @$product->statics->for_trade }}</td>
                                                </tr>
                                                 <tr>
                                                    <th>Want In Trade</th>
                                                    <td>{{ @$product->statics->want_it_trade }}</td>
                                                </tr>
                                                 <tr>
                                                    <th>Wishlist</th>
                                                    <td>{{ @$product->statics->wishlist }}</td>
                                                </tr>
                                        </tbody>
                                    </table>
                              </div>
							  
							  {{-- 
                              <div class="accordion__header">
                                  <h2>Product Metadata</h2>
                                  <span class="accordion__toggle"></span>
                              </div>
                              <div class="accordion__body">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                                <tr>
                                                    <th>Brand</th>
                                                    <td>{{ @$product->brand }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Company</th>
                                                    <td>{{ @$product->company }}</td>
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
                                            @if(@$product->main_image)
                                                <img id="blah" width="100" height="70" src="{{imageBasePath($product->main_image)}}" class="imgHundred">
                                            @else
                                                <img id="blah" src="#" alt="Preview" class="img-fluid imgHundred">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Product by</th>
                                        <td>
                                            @if(count($users) > 0)
                                                @foreach($users as $key => $user)
                                                    @if($product->user_id  == $user->id )
                                                        {{$user->text}}
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                            <th>Product ID</th>
                                            <td>{{ @$product->product_id_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Name</th>
                                        <td>{{ @$product->name }}</td>
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
                                        <th>Product Description</th>
                                        <td>{{ $product->description }}</td>
                                    </tr>

                                    <tr>
                                        <th>URL</th>
                                        <td><a target="_blank" href="{{url('product/'.$product->slug)}}">{{$product->slug}}</a></td>
                                    </tr>
                                    @if(!empty($product->fun_fact1) )
                                        <tr>
                                            <th>Fun Fact 1</th>
                                            <td>{{ $product->fun_fact1 }}</td>
                                        </tr>
                                    @endif
                                    @if(!empty($product->fun_fact2) )
                                        <tr>
                                            <th>Fun Fact 2</th>
                                            <td>{{ $product->fun_fact2 }}</td>
                                        </tr>
                                    @endif
                                    @if(!empty($product->fun_fact3) )
                                        <tr>
                                            <th>Fun Fact 3</th>
                                            <td>{{ $product->fun_fact3 }}</td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th>Amazon</th>
                                        <td>{{ $product->buyFrom->amazon }}</td>
                                    </tr>
                                    <tr>
                                        <th>eBay</th>
                                        <td>{{ $product->buyFrom->ebay }}</td>
                                    </tr>
                                    <tr>
                                        <th>PoP</th>
                                        <td>{{ $product->buyFrom->pop }}</td>
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
                                <tbody class="tbody_productlist" id='table_append'>
                                  @foreach(@$product->collaborators ?? [] as $collab)
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
                                          if(!empty($product->socialMedia))
                                          {   
                                            $str_social_val = @$product->socialMedia->pluck('value','type')->toArray()[$index];
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
                                                @if($product->classification->delivery_mechanism == $index)
                                                    {{$value}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Toy Type</th>
                                        <td>
                                            @foreach (config('cms.toy_type') as $index => $value)
                                                @if(@$product->classification->toy_type == $index) 
                                                    {{$value}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Launched </th>
                                        <td>{{ @$product->classification->launched }}</td>
                                    </tr>
                                    <tr>
                                        <th>Inventor </th>
                                        <td>{{ @$product->classification->inventor }}</td>
                                    </tr>
                                    <tr>
                                        <th>Team </th>
                                        <td>{{ @$product->classification->team }}</td>
                                    </tr>
                                    <tr>
                                        <th>Url 1 </th>
                                        <td>{{ @$product->classification->team }}</td>
                                    </tr>
                                    <tr>
                                        <th>Url 2 </th>
                                        <td>{{ @$product->classification->team }}</td>
                                    </tr>

                                    <tr>
                                        <th>Average Rating</th>
                                        <td>{{ @$product->statics->rating }}</td>
                                    </tr>

                                    <tr>
                                        <th>Number of Ratings</th>
                                        <td>{{ @$product->statics->number_of_ratings }}</td>
                                    </tr>

                                    <tr>
                                        <th>Standard Deviation</th>
                                        <td>{{ @$product->statics->standard_deviation }}</td>
                                    </tr>
                                    <tr>
                                        <th>Comments</th>
                                        <td>{{ @$product->statics->comments }}</td>
                                    </tr>
                                    <tr>
                                        <th>Page Views</th>
                                        <td>{{ @$product->statics->page_views }}</td>
                                    </tr>
                                    <tr>
                                        <th>Overall Rank</th>
                                        <td>{{ @$product->statics->overall_rank }}</td>
                                    </tr>
                                    <tr>
                                        <th>Party Rank</th>
                                        <td>{{ @$product->statics->party_rank }}</td>
                                    </tr>
                                    <tr>
                                        <th>All Time Plays</th>
                                        <td>{{ @$product->statics->all_time_plays }}</td>
                                    </tr>
                                    <tr>
                                        <th>This month</th>
                                        <td>{{ @$product->statics->this_month }}</td>
                                    </tr>
                                    <tr>
                                        <th>Parts Exchange</th>
                                        <td>{{ @$product->statics->has_part }}</td>
                                    </tr> 
                                    <tr>
                                        <th>Wants Parts</th>
                                        <td>{{ @$product->statics->wants_part }}</td>
                                    </tr>

                                    <tr>
                                        <th>Own</th>
                                        <td>{{ @$product->statics->own }}</td>
                                    </tr>
                                     <tr>
                                        <th>Previously Owned</th>
                                        <td>{{ @$product->statics->previously_owned }}</td>
                                    </tr>
                                     <tr>
                                        <th>For Trade</th>
                                        <td>{{ @$product->statics->for_trade }}</td>
                                    </tr>
                                     <tr>
                                        <th>Want In Trade</th>
                                        <td>{{ @$product->statics->want_it_trade }}</td>
                                    </tr>
                                     <tr>
                                        <th>Wishlist</th>
                                        <td>{{ @$product->statics->wishlist }}</td>
                                    </tr>
                                     <tr>
                                        <th>Brand</th>
                                        <td>{{ @$product->brand }}</td>
                                    </tr>
                                    <tr>
                                        <th>Company</th>
                                        <td>{{ @$product->company }}</td>
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