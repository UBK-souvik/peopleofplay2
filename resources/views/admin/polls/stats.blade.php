@extends('admin.layouts.master')

@section('title')Poll Stats @endsection

@section('content')
    <section class="content-header">
        <h1>Poll Stats</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.polls.index') }}">All Polls</a></li>
            <li class="active">Poll Stats</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#basic-info-tab">Poll Stats</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="basic-info-tab">
                            <table class="table table-striped table-bordered no-margin">
                                <tbody>
                                    <tr>
                                        <th>Option Number</th>
                                        <th>Total Poll (Number of Clicks)</th>
                                        <th>Percentage %</th>
                                    </tr>
                                    @if(@$poll_count > 0 )
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
                                                        <td>{{@$answer->user->user->first_name .' | '.@$answer->user->user->email}} </td>
                                                        @break
                                                @endswitch
                                                <td>{{$answer->total}}</td>
                                                <td>{{round(($answer->total / $poll_count) * 100,2 )}}%</td>
                                            </tr>
                                    @endforeach
                                    @else 
                                        <tr>
                                            <td colspan='3'><p class="text-center">No poll till now!</p></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
