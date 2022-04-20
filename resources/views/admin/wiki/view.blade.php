@extends('admin.layouts.master')
@section('title') {{ $data->title }} @endsection
<style type="text/css">
   .table-striped tbody tr {
   text-align: inherit;
   }
</style>
@section('content')
<section class="content-header">
   <h1> {{ 'Wiki Details' }}</h1>
   <ol class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
      <li><a href="{{ route('admin.wiki.index') }}">All Wiki</a></li>
      <li class="active">{{ adminTransLang('detail') }}</li>
   </ol>
</section>
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box">
            <div class="box-body" id="add-edit-user-main-box-body-div">
               <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
               <form class="form-horizontal" id="">
                  <div class="accordion">
                     <div class="accordion__header is-active">
                        <h2>Wiki - {{ $data->title }}</h2>
                        <!-- <span class="accordion__toggle"></span> -->
                     </div>
                     <div class="accordion__body is-active">
                        <table class="table table-striped table-bordered no-margin table-bordered">
                           <tbody>
                            
                            <tr>
                                <td>
                                    <b>Title</b>
                                </td>
                                <td>
                                    {{ $data->title }}
                                </td>
                                <td>
                                   <b> Category </b>
                                </td>
                                <td style="word-break: break-all;">
                                    {{ $data->name }}
                                </td>
                            </tr>
                            <tr>
                                <td><b>URL</b></td>
                                <td colspan="3" style="word-break: break-all;"> {{ @$data->url }} </td>
                            </tr>
                             <tr>
                                <td>
                                    <b>Statu</b>
                                </td>
                                <td>
                                    @if(@$data->status ==1)
                                    {{ 'Active' }}
                                    @else
                                    {{ 'Inactive' }}

                                    @endif
                                </td>
                                <td>
                                   <b> Image </b>
                                </td>
                                <td style="word-break: break-all;">
                                    <img  src="{{ @imageBasePath($data->featured_image) }}" class="imgFifty">
                                </td>
                            </tr>
                            <tr>
                                <td><b>Description</b></td>
                                <td colspan="3" style="word-break: break-all;"> {{ @$data->description }} </td>
                            </tr>
                          
                           </tbody>
                        </table>
                     </div>                   
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection