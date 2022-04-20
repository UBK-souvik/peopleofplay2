@extends('admin.layouts.master')

@section('title') Stats @endsection

@section('content')
    <section class="content-header">
        <h1> Stats</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.polls.index') }}">All Users</a></li>
            <li class="active">Stats</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#basic-info-tab">Stats</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="basic-info-tab">
                            <table class="table table-striped table-bordered no-margin">
                                <tbody>
                                    <tr>
                                        <th>Option Number</th>
                                        <th>Total Poll</th>
                                        <th>Percentage</th>
                                    </tr>
                                    @foreach($poll_answers as $answer)
                                    <tr>
                                        @switch(@$answer->type)
                                            @case(1)
                                                <td>{{@$answer->product->product->name}} </td>
                                                @break
                                            @case(2)
                                                <td>{{@$answer->event->event->name}} </td>
                                                @break
                                            @case(3)
                                                <td>{{@$answer->user->user->username .' | '.@$answer->user->user->email}} </td>
                                                @break
                                        @endswitch
                                        <td>{{$answer->total}}</td>
                                        <td>{{($answer->total / $poll_count) * 100}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
