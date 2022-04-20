@extends('admin.layouts.master')



@section('title') Create Product @endsection





<style>

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

    <section class="content-header">

        <h1> Create Product</h1>

        <ol class="breadcrumb">

           <li><a href="http://52.66.150.6/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>

           <li><a href="http://52.66.150.6/admin/users">All Product</a></li>

           <li class="active">Create Product</li>

        </ol>

    </section>

    <section class="content">

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

                              <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Product ID <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Product ID">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="email" class="col-sm-2 control-label">Product Name <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="email" placeholder="Product Name">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="category" class="col-sm-2 control-label">Category <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <select class="form-control">

                                     <option>Select One</option>

                                     <option> One</option>

                                     <option> One</option>

                                     <option> One</option>

                                   </select>

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="mobile" class="col-sm-2 control-label">Product Description <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                  <textarea class="form-control" name="description"></textarea>

                                </div>

                             </div>

                          </div>

                          <div class="accordion__header">

                              <h2>Buy a copy</h2>

                              <span class="accordion__toggle"></span>

                          </div>

                          <div class="accordion__body">

                              <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Product Price <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Product Price">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Amazon.com <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Amazon.com">

                                </div>

                             </div>

                          </div>

                          <div class="accordion__header">

                              <h2>Collaborators</h2>

                              <span class="accordion__toggle"></span>

                          </div>

                          <div class="accordion__body">

                              <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

                                  <thead>

                                    <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">User Image</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">User Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="">User Role</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="">Action</th></tr>

                                    </thead>

                                    <tbody>

                                    <tr role="row" class="odd">

                                      <td class="sorting_1 dtr-control">Gecko</td>

                                      <td>Firefox 1.0</td>

                                      <td style="">Win 98+ / OSX.2+</td>

                                      <td><a href="#"><i class="fa fa-edit fa-fw"></i></a><a href="#" class="danger"><i class="fa fa-key fa-fw"></i></a></td>

                                    </tr>

                                    <tr role="row" class="even">

                                      <td class="sorting_1 dtr-control">Gecko</td>

                                      <td>Firefox 3.0</td>

                                      <td style="">Win 2k+ / OSX.3+</td>

                                      <td><a href="#"><i class="fa fa-edit fa-fw"></i></a><a href="#" class="danger"><i class="fa fa-key fa-fw"></i></a></td>

                                    </tr>

                                    <tr role="row" class="odd">

                                      <td class="sorting_1 dtr-control">Gecko</td>

                                      <td>Camino 1.0</td>

                                      <td style="">OSX.2+</td>

                                      <td><a href="#"><i class="fa fa-edit fa-fw"></i></a><a href="#" class="danger"><i class="fa fa-key fa-fw"></i></a></td>

                                    </tr>

                                    <tr role="row" class="even">

                                      <td class="sorting_1 dtr-control">Gecko</td>

                                      <td>Camino 1.5</td>

                                      <td style="">OSX.3+</td>

                                      <td><a href="#"><i class="fa fa-edit fa-fw"></i></a><a href="#" class="danger"><i class="fa fa-key fa-fw"></i></a></td>

                                    </tr>

                                </tbody>

                              </table>

                          </div>



                          <div class="accordion__header">

                              <h2>Classification</h2>

                              <span class="accordion__toggle"></span>

                          </div>

                          <div class="accordion__body">

                              <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Product Price <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Product Price">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Toy Type <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <select class="form-control">>

                                     <option>One</option>

                                     <option>One</option>

                                     <option>One</option>

                                     <option>One</option>

                                     <option>One</option>

                                   </select>

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Launched <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Launched">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Inventor <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Inventor">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Team <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Team">

                                </div>

                             </div>

                          </div>



                          <div class="accordion__header">

                              <h2>Offical Link</h2>

                              <span class="accordion__toggle"></span>

                          </div>

                          <div class="accordion__body">

                              <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Url Link <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Url Link">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Url Link <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Url Link">

                                </div>

                             </div>

                          </div>



                          <div class="accordion__header">

                              <h2>Social Media</h2>

                              <span class="accordion__toggle"></span>

                          </div>

                          <div class="accordion__body">

                              <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Amazon<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Amazon">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Houzz<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Houzz">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Tidal<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Tidal">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Youtube<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Youtube">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Bandcamp<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Bandcamp">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">iTunes<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="iTunes">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">TikTok<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="TikTok">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Pinterest<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Pinterest">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Beatport<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Beatport">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">LinkedIn<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="LinkedIn">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">TripAdvisor<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="TripAdvisor">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Tumblr<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Tumblr">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Blogger<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Blogger">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Odnoklassniki<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Odnoklassniki">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Vimeo<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Vimeo">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Instagram<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Instagram">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Deezer<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Deezer">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">RSS<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="RSS">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Vkontakte<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Vkontakte">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Behance<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Behance">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">DeviantArt<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="DeviantArt">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Snapchat<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Snapchat">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Yelp<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Yelp">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Coroflot<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Coroflot">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Flickr<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Flickr">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">SoundCloud<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="SoundCloud">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Facebook<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Facebook">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">GooglePlay<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="GooglePlay">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Spotify<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Spotify">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Twitter<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Twitter">

                                </div>

                             </div> 

                          </div>



                          <div class="accordion__header">

                              <h2>Statistics</h2>

                              <span class="accordion__toggle"></span>

                          </div>

                          <div class="accordion__body">

                            <h2 class="inner_heading">Play Stats</h2>

                              <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Average Rating<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Average Rating">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Standard Deviation<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Standard Deviation">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Fans <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Fans">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Number of Ratings <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Number of Ratings">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Comments <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Comments">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Page Views <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Page Views">

                                </div>

                             </div>





                             <h2 class="inner_heading">Play Ranks</h2>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Overall Rank <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Overall Rank">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Party Rank <i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Party Rank">

                                </div>

                             </div>



                             <h2 class="inner_heading">Play Stats</h2>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">All Time Plays<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="All Time Plays">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">This month<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="This month">

                                </div>

                             </div>





                             <h2 class="inner_heading">Parts Exchange</h2>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Has Parts<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Has Parts">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Wants Parts<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Wants Parts">

                                </div>

                             </div>

                          </div>





                          <div class="accordion__header">

                              <h2>Collection Stats</h2>

                              <span class="accordion__toggle"></span>

                          </div>

                          <div class="accordion__body">

                              <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Own<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Own">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">For Trade<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="For Trade">

                                </div>

                             </div><div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Wishlist<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Wishlist">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Previously Owned<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Previously Owned">

                                </div>

                             </div>

                             <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Want In Trade<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Want In Trade">

                                </div>

                             </div>

                          </div>

                          <div class="accordion__header">

                              <h2>Product Metadata</h2>

                              <span class="accordion__toggle"></span>

                          </div>

                          <div class="accordion__body">

                            <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Brand<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Brand">

                                </div>

                             </div>

                          <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Company<i class="has-error">*</i></label>

                                <div class="col-sm-6">

                                   <input type="text" class="form-control" name="name" placeholder="Company">

                                </div>

                             </div>

                          </div>

                      </div>

                    </form>

                 </div>

                 <div class="box-footer">

                    <div class="col-sm-offset-1 col-sm-6">

                       <button type="button" class="btn btn-success" id="createBtn">Create</button>

                    </div>

                 </div>

              </div>

           </div>

        </div>

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





    