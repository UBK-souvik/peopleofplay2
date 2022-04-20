@extends('admin.layouts.master')

@section('title') Edit Sidebar List Page @endsection

@section('content')

    <section class="content-header">
        <h1> Sidebar List Page</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }} </a></li>
            <li><a href="{{ url('admin/cms/sidebar-page') }}"> Sidebar List Page </a></li>
            <li class="active">Edit Sidebar List Page</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Display Order</label>
                                <div class="col-sm-6">
                                    <!-- <input type="text" readonly="" name="display_order" class="form-control" value="{{$main_list_page->display_order}}"> -->
                                    <select name="display_order" class="form-control">
                                        @foreach (config('cms.sidebar_type') as $key => $value)
                                            <option value="{{$key}}" 
                                                {{ $main_list_page->display_order == $key ? 'selected' : ''}}>{{$key}} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-6">
                                <input type="text" name="title" class="form-control" value="{{$main_list_page->title}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-6">
                                    <select name="type" class="form-control">
                                    @foreach (config('cms.sidebar_type') as $key => $value)
                                    <option value="{{$key}}" {{ $main_list_page->type == $key ? 'selected' : 'disabled'}}>{{ucfirst($value)}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status"  class="form-control">
                                    @foreach (config('cms.action_status') as $key => $value)
                                    <option value="{{$key}}" {{ $main_list_page->status == $key ? 'selected' : ''}}>{{$value}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <hr>
                            @if($main_list_page->type == 2)
                                <div id="video_section" >
                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label">Video Link</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="Link[]" class="form-control" 
                                            value="{{(isset($main_list_page->videos[0]->video_link) ) ? $main_list_page->videos[0]->video_link : ''}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->videos[0]->content}}">
                                        </div>
                                    </div>
                                </div>
                            @else
                                <span id="isExpandable" >
                                    @switch($main_list_page->type)
                                        @case(4)
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->products ?? [] as $p =>  $product)
                                                            @if($p == 0)
                                                                <option selected value="{{@$product->product->id}}">{{@$product->product->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->products[0]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->products ?? [] as $p =>  $product)
                                                            @if($p == 1)
                                                                <option selected value="{{@$product->product->id}}">{{@$product->product->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->products[1]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->products ?? [] as $p =>  $product)
                                                            @if($p == 2)
                                                                <option selected value="{{@$product->product->id}}">{{@$product->product->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->products[2]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->products ?? [] as $p =>  $product)
                                                            @if($p == 3)
                                                                <option selected value="{{@$product->product->id}}">{{@$product->product->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->products[3]->content}}">
                                                </div>
                                            </div>
                                        @break

                                        @case(2)
                                            @foreach ($main_list_page->products ?? [] as $product)
                                            <option selected value="{{@$product->product->id}}">{{@$product->product->name}}</option>
                                            @endforeach
                                        @break

                                        @case(5)
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->users ?? [] as $u => $users)
                                                            @if($u == 0)
                                                                <option selected value="{{@$users->user->id}}">{{@$users->user->first_name .' | '.@$users->user->email}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->users[0]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->users ?? [] as $u => $users)
                                                            @if($u == 1)
                                                                <option selected value="{{@$users->user->id}}">{{@$users->user->first_name .' | '.@$users->user->email}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->users[1]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->users ?? [] as $u => $users)
                                                            @if($u == 2)
                                                                <option selected value="{{@$users->user->id}}">{{@$users->user->first_name .' | '.@$users->user->email}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->users[2]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->users ?? [] as $u => $users)
                                                            @if($u == 3)
                                                                <option selected value="{{@$users->user->id}}">{{@$users->user->first_name .' | '.@$users->user->email}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->users[3]->content}}">
                                                </div>
                                            </div>
                                        @break
                                            
                                        @case(3)
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->news ?? [] as $n => $new)
                                                            @if($n == 0)
                                                                <option selected value="{{@$new->news->id}}">{{@$new->news->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->news[0]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->news ?? [] as $n => $new)
                                                            @if($n == 1)
                                                                <option selected value="{{@$new->news->id}}">{{@$new->news->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->news[1]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->news ?? [] as $n => $new)
                                                            @if($n == 2)
                                                                <option selected value="{{@$new->news->id}}">{{@$new->news->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->news[2]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->news ?? [] as $n => $new)
                                                            @if($n == 3)
                                                                <option selected value="{{@$new->news->id}}">{{@$new->news->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->news[3]->content}}">
                                                </div>
                                            </div>
                                        @break
                                        
                                        @case(6)
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->companies ?? [] as $u => $users)
                                                            @if($u == 0)
                                                                <option selected value="{{@$users->user->id}}">{{@$users->user->first_name .' | '.@$users->user->email}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->companies[0]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->companies ?? [] as $u => $users)
                                                            @if($u == 1)
                                                                <option selected value="{{@$users->user->id}}">{{@$users->user->first_name .' | '.@$users->user->email}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->companies[1]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->companies ?? [] as $u => $users)
                                                            @if($u == 2)
                                                                <option selected value="{{@$users->user->id}}">{{@$users->user->first_name .' | '.@$users->user->email}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->companies[2]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->companies ?? [] as $u => $users)
                                                            @if($u == 3)
                                                                <option selected value="{{@$users->user->id}}">{{@$users->user->first_name .' | '.@$users->user->email}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->companies[3]->content}}">
                                                </div>
                                            </div>
                                        @break

                                        @case(7)
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->interviews ?? [] as $i => $inter)
                                                            @if($i == 0)
                                                                <option selected value="{{@$inter->interview->id}}">{{@$inter->interview->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->interviews[0]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->interviews ?? [] as $i => $inter)
                                                            @if($i == 1)
                                                                <option selected value="{{@$inter->interview->id}}">{{@$inter->interview->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->interviews[1]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->interviews ?? [] as $i => $inter)
                                                            @if($i == 2)
                                                                <option selected value="{{@$inter->interview->id}}">{{@$inter->interview->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->interviews[2]->content}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                                <div class="col-sm-6">
                                                    <select  class="form-control select-ajax" name="expandable[]" id="select-ajax">
                                                        @foreach ($main_list_page->interviews ?? [] as $i => $inter)
                                                            @if($i == 3)
                                                                <option selected value="{{@$inter->interview->id}}">{{@$inter->interview->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="label" class="col-sm-2 control-label expandable-label">Content</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="content[]" value="{{@$main_list_page->interviews[3]->content}}">
                                                </div>
                                            </div>
                                        @break
                                    @endswitch
                                </span>
                            @endif
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="button" class="btn btn-success" id="updateBtn">{{ adminTransLang('update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')

<script type="text/javascript">
    jQuery(function ($) {

        // Change Type Event
        function onChangeOfType() {
            // var isExpandable = $('#isExpandable');
            // var video_section = $('#video_section');
            // var type = $('[name="type"]');
            // isExpandable.hide();
            // video_section.hide();
            // if($.inArray(parseInt(type.val()),[1,2,4,6]) !== -1) {
            //     isExpandable.show();
            // }
            // else if($.inArray(parseInt(type.val()),[3]) !== -1) {
            //     video_section.show();
            // }

        }

        onChangeOfType();
        $(document).on('change','[name="type"]',function() {
            // $('#select-ajax').val('');
            // // onChangeOfType()
        });
        // End Change Type Event

        // Select2 Ajax
        $(".select-ajax").select2({
            minimumInputLength: 2,
            ajax: {
                url: '{{route("admin.cms.sidebar.search")}}',
                // dataType: 'json',
                placeholder: "Search Item",
                allowClear: true,
                type: "GET",
                quietMillis: 100,
                delay: 250,
                data: function (term) {
                    return {
                        query: term,
                        type: $('[name="type"]').val()
                    };
                },
                processResults: function (data,params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                        pagination: {
                            more: (params.page * 50) < data.total
                        },
                        cache:true
                    }
                }
            }
        });
        // End Select1 Ajax


        // On Form Submit
        $(document).on('click', '#updateBtn', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('admin.cms.sidebar_page.update', ['id' => $main_list_page->id]) }}",
                data: $('form').serialize(),
                dataType: 'json',
                type: 'POST',
                beforeSend: function () {
                    $('#updateBtn').attr('disabled', true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    $('#updateBtn').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    $('#updateBtn').attr('disabled', false);
                    $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    window.location.replace('{{ route("admin.cms.sidebar_page.index")}}');
                }
            });
        });
        // End On Form Submit
    });
</script>

@endsection
