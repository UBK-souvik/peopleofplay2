@extends('admin.layouts.master')

@section('title') Add Product Category @endsection

@section('content')

    <section class="content-header">
        <h1> @if(!empty(@$category->id)) Edit Product Category @else Create Product Category @endif </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.user_role.index') }}">All Product Categories</a></li>
            <li class="active">@if(!empty(@$category->id)) Edit Product Category @else Create Product Category @endif </li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body" id="add-edit-user-main-box-body-div">
                            <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                            <form class="form-horizontal" action="{{route('admin.category.create')}}" id="add-edit-user-main-box-body-form" method="post">
        						            {{ csrf_field() }}
                                <input type="hidden" name="category_id" value="@if(!empty($category->id)){{$category->id}}@endif">
                                <div class="accordion">
                                    <div class="accordion__header is-active">
                                        <h2>Details</h2>
                                        <span class="accordion__toggle"></span>
                                    </div>
                                    <div class="accordion__body is-active">
                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 control-label">Group Name<i class="has-error">*</i></label>
                                          <div class="col-sm-6">
                                            <select required="" class="form-control" name="group_id" id="group_id">
                                                <option value="">Select Group</option>
                                                @foreach(config('cms.group') as $key => $value)
                                                  <option value="{{$key}}" @if(!empty($category->group_id) && $category->group_id == $key ) selected @endif>{{$value}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                       </div>
                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 control-label">Product Category Name<i class="has-error">*</i></label>
                                          <div class="col-sm-6">
                                             <input required type="text" class="form-control" name="category_name" placeholder="Product Category Name" value="@if(!empty($category->category_name)){{$category->category_name}}@endif">
                                          </div>
                                       </div>
                                    </div>
                                </div>

                                <div class="col-sm-6" style="margin-top: 8px;">
                                    <div class="row">
                                        <button type="submit" class="btn btn-success" id="createBtn">Save</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="box-footer">

                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection


@section('scripts')

@endsection