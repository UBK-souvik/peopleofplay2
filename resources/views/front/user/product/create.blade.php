@extends('front.layouts.pages')
@section('content')

<div class="left-column">
    <div class="container bg-white">
        <form  id="productForm">
            @csrf
            <div id="FirstRow_Product" class="row mt-3">
                <div class="col-md-12">
                    <div id="file-upload-form" class="uploader">
                        <input id="file-upload" type="file" name="main_image" class="custom-file-input1" accept="image/*" /><label
                            for="file-upload" id="file-drag">
                            <img id="file-image" src="#" alt="Preview" class="hidden">
                            <div id="start">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <div></div>
                                <div id="notimage" class="hidden"></div>
                                <span id="file-upload-btn" class="btn edit-btn-style">Add Products
                                    Image</span>
                            </div>
                            <div id="response" class="hidden">
                                <div id="messages"></div>
                                <progress class="progress" id="file-progress" value="0">
                                    <span>0</span>%
                                </progress>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div id="SecondRow_Product" class="row">
                <div class="col-md-3 Login-Style rounded">
                    <div class="form-group d-none" >
                        <label for="ProductID">Product ID</label>
                        <input id="ProductID" type="text" class="form-control"
                        readonly name="product[product_id_number]" value="{{generateRandomString()}}"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="AverageRating">Average Rating</label>
                        <input id="Average Rating"type="text" name="rating" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="ProductName">Product Name</label>
                        <input id="ProductName" type="text" name="product[name]" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Productdescription">Product description</label>
                        <textarea class="form-control" rows="10" name="product[description]" id="Productdescription"
                            placeholder=""></textarea>
                    </div>
                </div>
                <div class="col-md-3 Login-Style rounded w-12">
                    <div class="form-group">
                        <label for="Brand">Brand</label>
                        <input id="Brand" type="text" name="product[brand]"class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Company">Company</label>
                        <input id="Company" type="text" name="product[company]" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Countriessold">Countries sold</label>
                        <input id="Countriessold" type="text" name="product[countries_sold]" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Year launched">Year launched</label>
                        <input id="Yearlaunched" type="number" name="product[year_launched]" class="form-control"
                            placeholder="">
                    </div>
                </div>
                <div class="col-md-3 Login-Style rounded w-12">
                    <div class="form-group">
                        <label for="Ratings">Ratings</label>
                        <input id="Ratings" type="number" name="product[ratings]" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Comments">Comments</label>
                        <textarea class="form-control" rows="1" name="product[comments]" id="Comments" placeholder=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Interest">Interest</label>
                        <select name="product[interest]" class="custom-select">
                            <option >Select</option>
                            @foreach (config('cms.product_interest') as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Frustration Free packaging">Frustration Free packaging</label>
                        <select name="product[frustration_free_packaging]" class="custom-select">
                            <option >Select</option>
                            @foreach (config('cms.common_options') as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 Login-Style rounded w-12">
                    <div class="form-group">
                        <label for="Environmentally-friendly">Environmentally-friendly</label>
                        <select name="product[environmentally_friendly]" class="custom-select">
                            <option >Select</option>
                            @foreach (config('cms.common_options') as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Setting for Play">Setting for Play</label>
                        <select name="product[setting_for_play]" class="custom-select">
                            <option >Select</option>
                            @foreach (config('cms.setting_for_play') as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Number of players">Number of players</label>
                        <input id="number_of_players" type="number" name="product[number_of_players]" class="form-control"
                        placeholder="">
                        {{-- <select name="Number of players" class="custom-select">
                            <option >Select</option>
                            <option value="1">1</option>
                            <option value="1 to 2">1 to 2</option>
                            <option value="2">2</option>
                            <option value="2 to 3">2 to 3</option>
                            <option value="3">3</option>
                            <option value="3 to 4">3 to 4</option>
                            <option value="4">4</option>
                            <option value="1 to 4">1 to 4</option>
                            <option value="4 to 5">4 to 5</option>
                            <option value="5">5</option>
                            <option value="1 to 5">1 to 5</option>
                            <option value="4 to 5">4 to 5</option>
                            <option value="6">6</option>
                        </select> --}}
                    </div>
                    <div class="form-group">
                        <label for="Playing Time">Playing Time</label>
                        <select name="product[playing_time]" class="custom-select">
                            <option >Select</option>
                            @foreach (config('cms.playing_time') as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <div id="Third_Product" class="row">
                <div class="col-md-4 Login-Style rounded">
                    <div class="form-group">
                        <label for="Age">Age</label>
                        <select name="product[age]" class="custom-select">
                            <option >Select</option>
                            @foreach (config('cms.playable_age') as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Community">Community</label>
                        <input id="Community"
                        name="product[community]"
                        type="textarea"  class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="MinimumAge">What is the minimum age you recommend for this
                            game?</label>
                        <input id="MinimumAge" type="number" name="product[minimum_age]" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="MaximumPage">What is the maximum age you recommend for this
                            game?</label>
                        <input id="MaximumPage" type="number" name="product[maximum_age]" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="ComplexityRating">'Complexity' Rating</label>
                        <input id="ComplexityRating" type="number" name="product[complexity_rating]"
                            class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-md-4 Login-Style rounded w-12">
                    <div class="form-group">
                        <label for="'How heavy (difficult/complex) is this game?">'How heavy
                            (difficult/complex) is this
                            game?</label>
                        <select class="custom-select" name="product[difficulty]" >
                            <option >Select</option>
                            @foreach (config('cms.product_game_difficulty') as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Audience">Audience</label>
                        <input id="Audience" type="text" name="product[audience]" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Alternate Names:">Alternate Names:</label>
                        <input id="AlternateNames:" type="name" name="product[alternate_names]"
                            class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="MyRatings">My rating</label>
                        <input id="MyRatings" type="number" name="product[my_rating]" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Buy">Buy</label>
                        <input id="Buy" type="text" name="product[buy]" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-md-4 Login-Style rounded w-12">
                    <div class="form-group">
                        <label for="Add to Collection">Add to Collection</label>
                        <input id="AddtoCollection" type="text" name="product[add_to_collection]"
                            class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Log Play">Log Play</label>
                        <input id="LogPlay" type="text" name="product[log_play]" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Like">Like</label>
                        <input id="Like" type="text" name="product[like]" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Subscribe">Subscribe</label>
                        <input id="Subscribe" type="text" name="product[subscribe]" class="form-control"
                            placeholder="">
                    </div>
                </div>
            </div>
            <h3 class="Tile-style social my-3">Team</h3>
            <div id="Four_Product" class="row">
                <div class="col-md-6">
                    <div id="file-upload-form-second" class="uploader-second">
                        <input id="file-upload-second" type="file" name="fileUpload" accept="image/*" />
                        <label for="file-upload-second" id="file-drag-second">
                            <img id="file-image-second" src="#" alt="Preview" class="hidden">
                            <div id="start-second">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <div></div>
                                <div id="notimage-second" class="hidden"></div>
                                <span id="file-upload-btn-second" class="btn edit-btn-style">Add User
                                    image</span>
                            </div>
                            <div id="response-second" class="hidden">
                                <div id="messages-second"></div>
                                <progress class="progress-second" id="file-progress-second" value="0">
                                    <span>0</span>%
                                </progress>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 Login-Style rounded w-12">
                    <div class="form-group">
                        <label for="User Name">User Name</label>
                        <input id="UserName" type="text" name="User Name" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="User Roles">User Roles</label>
                        <input id="UserRoles" type="text" name="User Roles" class="form-control"
                            placeholder="">
                    </div>
                </div>
            </div>
            <h3 class="Tile-style social my-3">Image gallery</h3>
            <div id="Five_Product" class="row">
                <div class="col-md-6">
                    <!--Modal to display when image is clicked-->
                    <div id="individualImagePreview" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><i
                                            class="fa fa-times"></i></button>
                                </div>
                                <div class="modal-body">
                                    <img src="" alt="default image" class="img-responsive"
                                        id="individualPreview" />
                                </div>
                                <div class="modal-footer" id="displayTags">
                                    <div class="pull-left">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--Modal to display progress information while uploading data to server-->
                    <div id="progressModal2" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">

                                </div>
                                <div class="modal-body">
                                    <div id="ajaxLoad">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped active"
                                                role="progressbar" aria-valuemax="100"
                                                id="progressIndicator" style="">
                                                <span class="sr-only">45% Complete</span>
                                            </div>
                                        </div>

                                        <i class="fa fa-cog fa-spin fa-4x"></i>
                                    </div>
                                    <h4 id="successResponse">File upload details shown here. Progress
                                        bar using ajax and
                                        cleaning the data and
                                        displaying preview
                                    </h4>
                                </div>
                                <div class="modal-footer hide-element">
                                    <button type="button" class="btn btn-default"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="container">
                        <div class="alert hide-element" role="alert" id="errorMessaage"></div>
                        <div class="alert hide-element" role="alert" id="file-error-message">
                            <span class='glyphicon glyphicon-remove-circle'></span>
                            <p></p>
                        </div>
                        {{-- <form class="well" id="imagesUploadForm"> --}}
                            <label for="file">Select files to upload</label>
                            <br />
                            <!--<div class="form-group input-group">
                  <span class='input-group-addon'>
                      <span class="glyphicon glyphicon-camera"></span>
                  </span>
                  <input type="file" class="form-control" name="image" accept="image/*"/>
              </div> -->
                            <span class="btn btn-file edit-btn-style">
                                Browse <input type="file" multiple="multiple" name="gallery[]" accept="image/*"
                                    id="uploadImages" /></span>
                            <p class="help-block">
                                Only jpg,jpeg,png file with maximum size of 2 MB is allowed.
                            </p>
                            <p class='text-muted'>
                                Even if the file extensions are changed the script makes sure only jpeg
                                or png files are
                                uploaded. Don't trust what you just read? Change bmp to png and try to
                                upload!!!!
                            </p>
                            <button type="button" data-toggle="modal" data-target="#myModal"
                                class="btn btn-lg btn-file edit-btn-style disabled" value="Preview"
                                name="imagesUpload" id="imagesUpload">Preview</button>
                        {{-- </form> --}}
                        <div id="uploadDataInfo" class="alert hide-element">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">
                                <i class="fa fa-times"></i>
                            </a>
                            <p class="" id="toManyFilesUploaded"></p>
                            <p class="" id="filesCount"></p>
                            <p class="" id="filesSupported"></p>
                            <p class="" id="filesUnsupported"></p>
                        </div>
                        <div class="hide-element" id="previewImages">
                            <div class="media">
                                <div class="media-left">

                                    <img class="media-object thumbnail" src="img/200x200.gif" alt=""
                                        id="0" title="" data-toggle="modal"
                                        data-target="#individualImagePreview" />
                                </div>
                                <div class="media-body">
                                    <p><label for="description">Description: </label><input type="text"
                                            class="form-control" value="" name="description" /></p>
                                    <p><label for="caption">Caption: </label><input type="text"
                                            class="form-control" value="" name="caption" /></p>
                                    <p><label for="tags">Tags:max of 3 tags.comma seperated
                                        </label><input type="text" class="form-control" value=""
                                            name="tags" /></p>
                                    <a role="button" class="btn btn-primary hide-element"
                                        id="undo0">Undo</a>
                                    <a role="button" class="btn btn-danger pull-right"
                                        id="delete0">Delete</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-left">
                                    <img class="media-object thumbnail" src="img/200x200.gif" alt=""
                                        id="1" title="" data-toggle="modal"
                                        data-target="#individualImagePreview" />
                                </div>
                                <div class="media-body">
                                    <p><label for="description">Description: </label><input type="text"
                                            class="form-control" value="" name="description" /></p>
                                    <p><label for="caption">Caption: </label><input type="text"
                                            class="form-control" value="" name="caption" /></p>
                                    <p><label for="tags">Tags: </label><input type="text"
                                            class="form-control" value="" name="tags" /></p>
                                    <a role="button" class="btn btn-primary hide-element"
                                        id="undo1">Undo</a>
                                    <a role="button" class="btn btn-danger pull-right"
                                        id="delete1">Delete</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-left">
                                    <img class="media-object thumbnail" src="img/200x200.gif" alt=""
                                        id="2" title="" data-toggle="modal"
                                        data-target="#individualImagePreview" />
                                </div>
                                <div class="media-body">
                                    <p><label for="description">Description: </label><input type="text"
                                            class="form-control" value="" name="description" /></p>
                                    <p><label for="caption">Caption: </label><input type="text"
                                            class="form-control" value="" name="caption" /></p>
                                    <p><label for="tags">Tags: </label><input type="text"
                                            class="form-control" value="" name="tags" /></p>
                                    <a role="button" class="btn btn-primary hide-element"
                                        id="undo2">Undo</a>
                                    <a role="button" class="btn btn-danger pull-right"
                                        id="delete2">Delete</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-left">
                                    <img class="media-object thumbnail" src="img/200x200.gif" alt=""
                                        id="3" data-toggle="modal"
                                        data-target="#individualImagePreview" />
                                </div>
                                <div class="media-body">
                                    <p><label for="description">Description: </label>
                                        <input type="text" class="form-control" name="description"
                                            value="" /></p>
                                    <p><label for="caption">Caption: </label>
                                        <input type="text" class="form-control" name="caption"
                                            value="" /></p>
                                    <p><label for="tags">Tags: </label>
                                        <input type="text" class="form-control" name="tags" value="" />
                                    </p>
                                    <a role="button" class="btn btn-primary hide-element"
                                        id="undo3">Undo</a>
                                    <a role="button" class="btn btn-danger pull-right"
                                        id="delete3">Delete</a>
                                </div>
                            </div>
                            {{-- <button class="btn btn-primary pull-left" id="sendImagesToServer"
                                data-toggle="modal" data-target="#progressModal" data-keyboard="false"
                                data-backdrop="static">Update &amp;
                                Preview</button> --}}
                        </div>
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><i
                                                class="fa fa-times"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="myCarousel" class="carousel slide">
                                            <div class="carousel-inner" role="listbox"
                                                id="previewItems">
                                            </div>
                                            <!-- Left and right controls -->
                                            <a class="left carousel-control" href="#myCarousel"
                                                role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left"
                                                    aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#myCarousel"
                                                role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right"
                                                    aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="modal-footer hide-element">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="Tile-style social my-3">Classification</h3>
            <div id="Five_Product" class="row">
                <div class="col-md-3 Login-Style rounded">
                    <div class="form-group">
                        <label for="Type">Type</label>
                        <select name="classification[type]" class="custom-select">
                            <option >Select</option>
                            @foreach (config('cms.classification_type') as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Category">Category</label>
                        <select name="classification[category_id]" class="custom-select">
                            <option>Select</option>
                            @foreach ($category as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 Login-Style rounded">
                    <div class="form-group">
                        <label for="Sub-Categories">Sub-Categories</label>
                        <input id="Sub-Categories" type="text" name="classification[sub_category]"
                            class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Delivery Mechanism">Delivery Mechanism</label>
                        <select name="classification[delivery_mechanism]" class="custom-select">
                            <option >Select</option>
                            @foreach (config('cms.delivery_mechanism') as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="col-md-3 Login-Style rounded w-12">
                    <div class="form-group">
                        <label for="Toy Type">Toy Type</label>
                        <select name="classification[toy_type]" class="custom-select">
                            <option >Select</option>
                            @foreach (config('cms.toy_type') as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Game Type">Game Type</label>
                        <select name="classification[game_type]"  class="custom-select">
                            <option >Select</option>
                            @foreach (config('cms.game_type') as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 Login-Style rounded w-12">
                    <div class="form-group">
                        <label for="Propose Offical Link">Propose Offical Link</label>
                        <input type="url" id="ProposeOfficalLink" name="classification[official_link]"
                            placeholder="Propose Offical Link URL here" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Social Media">Social Media</label>
                        <input type="url" id="SocialMedia" name="classification[social_media]"
                            placeholder="Social Media URL here" class="form-control">
                    </div>
                </div>
            </div>
            <h3 class="Tile-style social my-3">Additional Suggestions</h3>
            <div id="Five_Product" class="row">
                <div class="col-md-6 Login-Style rounded">
                    <div class="form-group">
                        <label for="Language Dependence">Language Dependence</label>
                        <select name="additional_suggestion[language_dependence]" class="custom-select">
                            <option >Select</option>
                            @foreach (config('cms.language_dependence') as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 Login-Style rounded">
                    <div class="form-group">
                        <label for="ShowValue">Show Value that has the most poll numbers</label>
                        <input id="ShowValue" type="text" name="additional_suggestion[poll_number_value]" class="form-control"
                            placeholder="">
                    </div>
                </div>
            </div>
            <h3 class="Tile-style social my-3">Community Stats</h3>
            <div id="Six_Product" class="row">
                <div class="col-md-4 Login-Style rounded">
                    <div class="form-group">
                        <label for="Own">Own</label>
                        <input id="Own" type="text" name="community_stats[own]" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Wishlist">Wishlist</label>
                        <input id="Wishlist" type="text" name="community_stats[wishlist]" class="form-control"
                            placeholder="">
                    </div>
                </div>
                <div class="col-md-4 Login-Style rounded">
                    <div class="form-group">
                        <label for="ForTrade">For Trade</label>
                        <input id="ForTrade" type="text" name="community_stats[for_trade]" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Want In Trace">Want In Trace</label>
                        <input id="WantInTrace" type="text" name="community_stats[want_it_trade]" class="form-control"
                            placeholder="">
                    </div>
                </div>
                <div class="col-md-4 Login-Style rounded">
                    <div class="form-group">
                        <label for="Has Parts">Has Parts</label>
                        <select name="community_stats[has_part]"  class="custom-select">
                            <option >Select</option>
                            @foreach (config('cms.other_action') as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Wants Parts">Wants Parts</label>
                        <select name="community_stats[wants_part]" class="custom-select">
                            <option >Select</option>
                            @foreach (config('cms.other_action') as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <h3 class="Tile-style social my-3">Buy a Copy</h3>
            <div id="Seven_Product" class="row">
                <div class="col-md-6 Login-Style rounded">
                    <div class="form-group">
                        <label for="Suggested retail">Suggested retail</label>
                        <input id="Suggestedretail" type="number" name="buy_from[0][suggested_retail]"
                            class="form-control" placeholder="">
                            <input  type="hidden" name="buy_from[0][type]" value="1">
                    </div>
                    <div class="form-group">
                        <label for="Amazon.com">Amazon.com</label>
                        <input id="Amazoncom" type="url" name="buy_from[0][amazon]" class="form-control"
                            placeholder="">
                    </div>
                </div>
                <div class="col-md-6 Login-Style rounded">
                    <div class="form-group">
                        <label for="Ebay.com">Ebay.com</label>
                        <input id="Ebaycom" type="url" name="buy_from[0][ebay]" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Buy on PoP">Buy on PoP</label>
                        <input id="BuyonPoP" type="text" name="buy_from[0][pop]" class="form-control"
                            placeholder="">
                    </div>
                </div>
            </div>
            <h3 class="Tile-style social my-3">Vedio</h3>
            <div id="Eight_Product" class="row">
                <div class="col-md-6 Login-Style rounded">
                    <div class="form-group">
                        <label for="Suggested retail">Suggested retail</label>
                        <input id="Suggestedretail" type="number" name="buy_from[1][suggested_retail]"
                            class="form-control" placeholder="">
                            <input  type="hidden" name="buy_from[1][type]" value="2">

                    </div>
                    <div class="form-group">
                        <label for="Amazon.com">Amazon.com</label>
                        <input id="Amazoncom" type="url" name="buy_from[1][amazon]" class="form-control"
                            placeholder="">
                    </div>
                </div>
                <div class="col-md-6 Login-Style rounded">
                    <div class="form-group">
                        <label for="Ebay.com">Ebay.com</label>
                        <input id="Ebaycom" type="url" name="buy_from[1][ebay]" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Buy on PoP">Buy on PoP</label>
                        <input id="BuyonPoP" type="url" name="buy_from[1][pop]" class="form-control"
                            placeholder="">
                    </div>
                </div>
            </div>

            <div id="Nine_Product" class="row">
                <div class="col-md-4 Login-Style rounded">
                    <h3 class="Tile-style social my-3">In-Depth Reviews</h3>
                    <div class="form-group">
                        <label for="Review">Review</label>
                        <textarea class="form-control" rows="5" id="Review" name="other[in_depth_review]"></textarea>
                    </div>
                </div>
                <div class="col-md-4 Login-Style rounded">
                    <h3 class="Tile-style social my-3">Similar Products</h3>
                    <div id="file-upload-form-third" class="uploader-third">
                        {{-- <input id="file-upload-third"accept="image/*" /> --}}
                        <label for="file-upload-third" id="file-drag-third">
                            <img id="file-image-third" src="#" alt="Preview" class="hidden">
                            <div id="start-third">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <div></div>
                                <div id="notimage-third" class="hidden"></div>
                                <span id="file-upload-btn-third" class="btn edit-btn-style">Add Product
                                    image</span>
                            </div>
                            <div id="response-third" class="hidden">
                                <div id="messages-third"></div>
                                <progress class="progress-third" id="file-progress-third" value="0">
                                    <span>0</span>%
                                </progress>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="col-md-4 Login-Style rounded">
                    <h3 class="Tile-style social my-3">Forums</h3>
                    <div class="form-group">
                        <label for="Forum categories">Forum categories</label>
                        <input id="Forumcategories" type="text" name="other[forum_categories]"
                            class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Forum">Forum</label>
                        <input id="Forum" type="text" name="other[forum]" class="form-control" placeholder="">
                    </div>

                </div>
            </div>
            <div id="Ten_Product" class="row">
                <div class="col-md-4 Login-Style rounded">
                    <h3 class="Tile-style social my-3">Files</h3>
                    <div class="form-group">
                        <label for="Files" class="custom-file-upload form-control">Choose Files</label>
                        <input id="Files" type="file" name="Files" class="fileboxinput" placeholder="">
                    </div>
                </div>
                <div class="col-md-4 Login-Style rounded">
                    <h3 class="Tile-style social my-3">Ratings</h3>
                    <div class="form-group">
                        <label for="Ratings">Ratings</label>
                        <input id="Ratings" type="text" name="other[ratings]" class="form-control"
                            placeholder="">
                    </div>
                </div>
                <div class="col-md-4 Login-Style rounded">
                    <h3 class="Tile-style social my-3">Versions</h3>
                    <div id="file-upload-form-fourth" class="uploader-fourth">
                        <input id="file-upload-fourth" type="file" name="fileUpload" accept="image/*" />
                        <label for="file-upload-fourth" id="file-drag-fourth">
                            <img id="file-image-fourth" src="#" alt="Preview" class="hidden">
                            <div id="start-fourth">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <div></div>
                                <div id="notimage-fourth" class="hidden"></div>
                                <span id="file-upload-btn-fourth" class="btn edit-btn-style">Add Product
                                    image</span>
                            </div>
                            <div id="response-fourth" class="hidden">
                                <div id="messages-fourth"></div>
                                <progress class="progress-fourth" id="file-progress-fourth" value="0">
                                    <span>0</span>%
                                </progress>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <h2 class="Tile-style social my-3 text-center">Google Analytics/Statistics</h2>
            <h3 class="Tile-style social my-3">Play Stats</h3>
            <div id="Eleven_Product" class="row">
                <div class="col-md-4 Login-Style rounded">
                    <div class="form-group">
                        <label for="Average Rating">Average Rating</label>
                        <input id="AverageRating" type="number"
                            class="form-control" name="stats[rating]">
                    </div>
                    <div class="form-group">
                        <label for="Number of Ratings">Number of Ratings</label>
                        <input id="NumberofRatings" type="number" name="stats[number_of_ratings]"
                            class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-md-4 Login-Style rounded">
                    <div class="form-group">
                        <label for="Standard Deviation">Standard Deviation</label>
                        <input id="StandardDeviation" type="text" name="stats[standard_deviation]"
                            class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Comments">Comments</label>
                        <textarea class="form-control" rows="1" id="Comments" name="stats[comments]"></textarea>
                    </div>
                </div>
                <div class="col-md-4 Login-Style rounded">
                    <div class="form-group">
                        <label for="Fans">Fans</label>
                        <input id="Fans" type="text" name="stats[fans]" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Page Views">Page Views</label>
                        <input id="PageViews" type="text" name="stats[page_views]" class="form-control"
                            placeholder="">
                    </div>
                </div>
            </div>
            <div id="Twelve_Product" class="row">
                <div class="col-md-4 Login-Style rounded">
                    <h3 class="Tile-style social my-3">Play Ranks</h3>
                    <div class="form-group">
                        <label for="Overall Rank">Overall Rank</label>
                        <input id="OverallRank" type="number" name="stats[overall_rank]" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Party Rank">Party Rank</label>
                        <input id="PartyRank" type="number" name="stats[party_rank]" class="form-control"
                            placeholder="">
                    </div>
                </div>
                <div class="col-md-4 Login-Style rounded">
                    <h3 class="Tile-style social my-3">Play Stats</h3>
                    <div class="form-group">
                        <label for="All Time Plays">All Time Plays</label>
                        <input id="AllTimePlays" type="number" name="stats[all_time_plays]"
                            class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="This month">This month</label>
                        <input id="Thismonth" type="number" name="stats[this_month]" class="form-control"
                            placeholder="">
                    </div>
                </div>
                <div class="col-md-4 Login-Style rounded">
                    <h3 class="Tile-style social my-3">Parts Exchange</h3>
                    <div class="form-group">
                        <label for="Has Parts">Has Parts</label>
                        <select name="stats[has_part]" class="custom-select">
                            <option >Select</option>
                            <option value="Yes">Yes</option>
                            <option value="Yes">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Wants Parts">Wants Parts</label>
                        <select name="stats[wants_part]"  class="custom-select">
                            <option >Select</option>
                            <option value="Yes">Yes</option>
                            <option value="Yes">No</option>
                        </select>
                    </div>

                </div>
            </div>
            <h3 class="Tile-style social my-3">Collection Stats</h3>
            <div id="Thirteen_Product" class="row">
                <div class="col-md-4 Login-Style rounded">
                    <div class="form-group">
                        <label for="Own">Own</label>
                        <input id="Own" type="text" name="stats[own]" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Previously Owned">Previously Owned</label>
                        <input id="PreviouslyOwned" type="text" name="stats[previously_owned]"
                            class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-md-4 Login-Style rounded">
                    <div class="form-group">
                        <label for="For Trade">For Trade</label>
                        <input id="ForTrade" type="text" name="stats[for_trade]" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="Want In Trade">Want In Trade</label>
                        <input id="Want In Trade" type="text" name="stats[want_it_trade]" class="form-control"
                            placeholder="">
                    </div>
                </div>
                <div class="col-md-4 Login-Style rounded">
                    <div class="form-group">
                        <label for="Wishlist">Wishlist</label>
                        <input id="Wishlist" type="text" name="stats[wishlist]" class="form-control"
                            placeholder="">
                    </div>
                </div>
            </div>


    </div>
    <button type="button" class="btn edit-btn-style rounded-0 text-center mt-3 productSubmitButton" >Add</button>

</div>

@endsection
@section('scripts')
<script>
    frontend_show_standard_ckeditor_new('Productdescription');
    $(function ($) {
        $(document).on('click', '.productSubmitButton, #sendImagesToServer', function (e) {
            e.preventDefault();


            var fd = new FormData($('#productForm')[0]);
            var ckeditor_description_new = frontend_get_ckeditor_description_new('Productdescription');
            fd.append('product[description]', ckeditor_description_new);
            $.ajax({
                url: "{{ route('front.user.product.create') }}",
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function () {
                    $('.productSubmitButton').attr('disabled', true);
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    $('.productSubmitButton').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg)
                    console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    $('.productSubmitButton').attr('disabled', false);
                    // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    toastr.success(data.message)
                    // $('#productForm').trigger('reset')
                    // window.location.replace('{{ route("admin.users.index")}}');
                    // window.location.replace('{{ route("front.login")}}');

                }
            });
        });
    });
</script>


{{-- HTML SCRIPTS --}}
<script>
    // File Upload
    //
    function ekUpload() {
      function Init() {

        console.log("Upload Initialised");

        var fileSelect = document.getElementById('file-upload'),
          fileDrag = document.getElementById('file-drag'),
          submitButton = document.getElementById('submit-button');

        fileSelect.addEventListener('change', fileSelectHandler, false);

        // Is XHR2 available?
        var xhr = new XMLHttpRequest();
        if (xhr.upload) {
          // File Drop
          fileDrag.addEventListener('dragover', fileDragHover, false);
          fileDrag.addEventListener('dragleave', fileDragHover, false);
          fileDrag.addEventListener('drop', fileSelectHandler, false);
        }
      }

      function fileDragHover(e) {
        var fileDrag = document.getElementById('file-drag');

        e.stopPropagation();
        e.preventDefault();

        fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
      }

      function fileSelectHandler(e) {
        // Fetch FileList object
        var files = e.target.files || e.dataTransfer.files;

        // Cancel event and hover styling
        fileDragHover(e);

        // Process all File objects
        for (var i = 0, f; f = files[i]; i++) {
          parseFile(f);
          uploadFile(f);
        }
      }

      // Output
      function output(msg) {
        // Response
        var m = document.getElementById('messages');
        m.innerHTML = msg;
      }

      function parseFile(file) {

        console.log(file.name);
        output(
          '<strong>' + encodeURI(file.name) + '</strong>'
        );

        // var fileType = file.type;
        // console.log(fileType);
        var imageName = file.name;

        var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
        if (isGood) {
          document.getElementById('start').classList.add("hidden");
          document.getElementById('response').classList.remove("hidden");
          document.getElementById('notimage').classList.add("hidden");
          // Thumbnail Preview
          document.getElementById('file-image').classList.remove("hidden");
          document.getElementById('file-image').src = URL.createObjectURL(file);
        } else {
          document.getElementById('file-image').classList.add("hidden");
          document.getElementById('notimage').classList.remove("hidden");
          document.getElementById('start').classList.remove("hidden");
          document.getElementById('response').classList.add("hidden");
          document.getElementById("file-upload-form").reset();
        }
      }

      function setProgressMaxValue(e) {
        var pBar = document.getElementById('file-progress');

        if (e.lengthComputable) {
          pBar.max = e.total;
        }
      }

      function updateFileProgress(e) {
        var pBar = document.getElementById('file-progress');

        if (e.lengthComputable) {
          pBar.value = e.loaded;
        }
      }

      function uploadFile(file) {

        var xhr = new XMLHttpRequest(),
          fileInput = document.getElementById('class-roster-file'),
          pBar = document.getElementById('file-progress'),
          fileSizeLimit = 1024; // In MB
        if (xhr.upload) {
          // Check if file is less than x MB
          if (file.size <= fileSizeLimit * 1024 * 1024) {
            // Progress bar
            pBar.style.display = 'inline';
            xhr.upload.addEventListener('loadstart', setProgressMaxValue, false);
            xhr.upload.addEventListener('progress', updateFileProgress, false);

            // File received / failed
            xhr.onreadystatechange = function (e) {
              if (xhr.readyState == 4) {
                // Everything is good!

                // progress.className = (xhr.status == 200 ? "success" : "failure");
                // document.location.reload(true);
              }
            };

            // Start upload
            xhr.open('POST', document.getElementById('file-upload-form').action, true);
            xhr.setRequestHeader('X-File-Name', file.name);
            xhr.setRequestHeader('X-File-Size', file.size);
            xhr.setRequestHeader('Content-Type', 'multipart/form-data');
            xhr.send(file);
          } else {
            output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
          }
        }
      }

      // Check for the various File API support.
      if (window.File && window.FileList && window.FileReader) {
        Init();
      } else {
        document.getElementById('file-drag').style.display = 'none';
      }
    }
    ekUpload();
  </script>

  <script>
    // File Upload second
    //
    function ekUploadsecond() {
      function Init() {

        console.log("Upload Initialised");

        var fileSelect = document.getElementById('file-upload-second'),
          fileDrag = document.getElementById('file-drag-second'),
          submitButton = document.getElementById('submit-button-second');

        fileSelect.addEventListener('change', fileSelectHandler, false);

        // Is XHR2 available?
        var xhr = new XMLHttpRequest();
        if (xhr.upload) {
          // File Drop
          fileDrag.addEventListener('dragover', fileDragHover, false);
          fileDrag.addEventListener('dragleave', fileDragHover, false);
          fileDrag.addEventListener('drop', fileSelectHandler, false);
        }
      }

      function fileDragHover(e) {
        var fileDrag = document.getElementById('file-drag-second');

        e.stopPropagation();
        e.preventDefault();

        fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
      }

      function fileSelectHandler(e) {
        // Fetch FileList object
        var files = e.target.files || e.dataTransfer.files;

        // Cancel event and hover styling
        fileDragHover(e);

        // Process all File objects
        for (var i = 0, f; f = files[i]; i++) {
          parseFile(f);
          uploadFile(f);
        }
      }

      // Output
      function output(msg) {
        // Response
        var m = document.getElementById('messages-second');
        m.innerHTML = msg;
      }

      function parseFile(file) {

        console.log(file.name);
        output(
          '<strong>' + encodeURI(file.name) + '</strong>'
        );

        // var fileType = file.type;
        // console.log(fileType);
        var imageName = file.name;

        var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
        if (isGood) {
          document.getElementById('start-second').classList.add("hidden");
          document.getElementById('response-second').classList.remove("hidden");
          document.getElementById('notimage-second').classList.add("hidden");
          // Thumbnail Preview
          document.getElementById('file-image-second').classList.remove("hidden");
          document.getElementById('file-image-second').src = URL.createObjectURL(file);
        } else {
          document.getElementById('file-image-second').classList.add("hidden");
          document.getElementById('notimage-second').classList.remove("hidden");
          document.getElementById('start-second').classList.remove("hidden");
          document.getElementById('response-second').classList.add("hidden");
          document.getElementById("file-upload-form-second").reset();
        }
      }

      function setProgressMaxValue(e) {
        var pBar = document.getElementById('file-progress-second');

        if (e.lengthComputable) {
          pBar.max = e.total;
        }
      }

      function updateFileProgress(e) {
        var pBar = document.getElementById('file-progress-second');

        if (e.lengthComputable) {
          pBar.value = e.loaded;
        }
      }

      function uploadFile(file) {

        var xhr = new XMLHttpRequest(),
          fileInput = document.getElementById('class-roster-file-second'),
          pBar = document.getElementById('file-progress-second'),
          fileSizeLimit = 1024; // In MB
        if (xhr.upload) {
          // Check if file is less than x MB
          if (file.size <= fileSizeLimit * 1024 * 1024) {
            // Progress bar
            pBar.style.display = 'inline';
            xhr.upload.addEventListener('loadstart-second', setProgressMaxValue, false);
            xhr.upload.addEventListener('progress-second', updateFileProgress, false);

            // File received / failed
            xhr.onreadystatechange = function (e) {
              if (xhr.readyState == 4) {
                // Everything is good!

                // progress.className = (xhr.status == 200 ? "success" : "failure");
                // document.location.reload(true);
              }
            };

            // Start upload
            xhr.open('POST', document.getElementById('file-upload-form-second').action, true);
            xhr.setRequestHeader('X-File-Name', file.name);
            xhr.setRequestHeader('X-File-Size', file.size);
            xhr.setRequestHeader('Content-Type', 'multipart/form-data');
            xhr.send(file);
          } else {
            output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
          }
        }
      }

      // Check for the various File API support.
      if (window.File && window.FileList && window.FileReader) {
        Init();
      } else {
        document.getElementById('file-drag-second').style.display = 'none';
      }
    }
    ekUploadsecond();
  </script>


  <script>
    // File Upload Third
    //
    function ekUploadthird() {
      function Init() {

        console.log("Upload Initialised");

        var fileSelect = document.getElementById('file-upload-third'),
          fileDrag = document.getElementById('file-drag-third'),
          submitButton = document.getElementById('submit-button-third');

        fileSelect.addEventListener('change', fileSelectHandler, false);

        // Is XHR2 available?
        var xhr = new XMLHttpRequest();
        if (xhr.upload) {
          // File Drop
          fileDrag.addEventListener('dragover', fileDragHover, false);
          fileDrag.addEventListener('dragleave', fileDragHover, false);
          fileDrag.addEventListener('drop', fileSelectHandler, false);
        }
      }

      function fileDragHover(e) {
        var fileDrag = document.getElementById('file-drag-third');

        e.stopPropagation();
        e.preventDefault();

        fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
      }

      function fileSelectHandler(e) {
        // Fetch FileList object
        var files = e.target.files || e.dataTransfer.files;

        // Cancel event and hover styling
        fileDragHover(e);

        // Process all File objects
        for (var i = 0, f; f = files[i]; i++) {
          parseFile(f);
          uploadFile(f);
        }
      }

      // Output
      function output(msg) {
        // Response
        var m = document.getElementById('messages-third');
        m.innerHTML = msg;
      }

      function parseFile(file) {

        console.log(file.name);
        output(
          '<strong>' + encodeURI(file.name) + '</strong>'
        );

        // var fileType = file.type;
        // console.log(fileType);
        var imageName = file.name;

        var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
        if (isGood) {
          document.getElementById('start-third').classList.add("hidden");
          document.getElementById('response-third').classList.remove("hidden");
          document.getElementById('notimage-third').classList.add("hidden");
          // Thumbnail Preview
          document.getElementById('file-image-third').classList.remove("hidden");
          document.getElementById('file-image-third').src = URL.createObjectURL(file);
        } else {
          document.getElementById('file-image-third').classList.add("hidden");
          document.getElementById('notimage-third').classList.remove("hidden");
          document.getElementById('start-third').classList.remove("hidden");
          document.getElementById('response-third').classList.add("hidden");
          document.getElementById("file-upload-form-third").reset();
        }
      }

      function setProgressMaxValue(e) {
        var pBar = document.getElementById('file-progress-third');

        if (e.lengthComputable) {
          pBar.max = e.total;
        }
      }

      function updateFileProgress(e) {
        var pBar = document.getElementById('file-progress-third');

        if (e.lengthComputable) {
          pBar.value = e.loaded;
        }
      }

      function uploadFile(file) {

        var xhr = new XMLHttpRequest(),
          fileInput = document.getElementById('class-roster-file-third'),
          pBar = document.getElementById('file-progress-third'),
          fileSizeLimit = 1024; // In MB
        if (xhr.upload) {
          // Check if file is less than x MB
          if (file.size <= fileSizeLimit * 1024 * 1024) {
            // Progress bar
            pBar.style.display = 'inline';
            xhr.upload.addEventListener('loadstart-third', setProgressMaxValue, false);
            xhr.upload.addEventListener('progress-third', updateFileProgress, false);

            // File received / failed
            xhr.onreadystatechange = function (e) {
              if (xhr.readyState == 4) {
                // Everything is good!

                // progress.className = (xhr.status == 200 ? "success" : "failure");
                // document.location.reload(true);
              }
            };

            // Start upload
            xhr.open('POST', document.getElementById('file-upload-form-third').action, true);
            xhr.setRequestHeader('X-File-Name', file.name);
            xhr.setRequestHeader('X-File-Size', file.size);
            xhr.setRequestHeader('Content-Type', 'multipart/form-data');
            xhr.send(file);
          } else {
            output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
          }
        }
      }

      // Check for the various File API support.
      if (window.File && window.FileList && window.FileReader) {
        Init();
      } else {
        document.getElementById('file-drag-third').style.display = 'none';
      }
    }
    ekUploadthird();
  </script>

  <script>
    // File Upload fourth
    //
    function ekUploadfourth() {
      function Init() {

        console.log("Upload Initialised");

        var fileSelect = document.getElementById('file-upload-fourth'),
          fileDrag = document.getElementById('file-drag-fourth'),
          submitButton = document.getElementById('submit-button-fourth');

        fileSelect.addEventListener('change', fileSelectHandler, false);

        // Is XHR2 available?
        var xhr = new XMLHttpRequest();
        if (xhr.upload) {
          // File Drop
          fileDrag.addEventListener('dragover', fileDragHover, false);
          fileDrag.addEventListener('dragleave', fileDragHover, false);
          fileDrag.addEventListener('drop', fileSelectHandler, false);
        }
      }

      function fileDragHover(e) {
        var fileDrag = document.getElementById('file-drag-fourth');

        e.stopPropagation();
        e.preventDefault();

        fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
      }

      function fileSelectHandler(e) {
        // Fetch FileList object
        var files = e.target.files || e.dataTransfer.files;

        // Cancel event and hover styling
        fileDragHover(e);

        // Process all File objects
        for (var i = 0, f; f = files[i]; i++) {
          parseFile(f);
          uploadFile(f);
        }
      }

      // Output
      function output(msg) {
        // Response
        var m = document.getElementById('messages-fourth');
        m.innerHTML = msg;
      }

      function parseFile(file) {

        console.log(file.name);
        output(
          '<strong>' + encodeURI(file.name) + '</strong>'
        );

        // var fileType = file.type;
        // console.log(fileType);
        var imageName = file.name;

        var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
        if (isGood) {
          document.getElementById('start-fourth').classList.add("hidden");
          document.getElementById('response-fourth').classList.remove("hidden");
          document.getElementById('notimage-fourth').classList.add("hidden");
          // Thumbnail Preview
          document.getElementById('file-image-fourth').classList.remove("hidden");
          document.getElementById('file-image-fourth').src = URL.createObjectURL(file);
        } else {
          document.getElementById('file-image-fourth').classList.add("hidden");
          document.getElementById('notimage-fourth').classList.remove("hidden");
          document.getElementById('start-fourth').classList.remove("hidden");
          document.getElementById('response-fourth').classList.add("hidden");
          document.getElementById("file-upload-form-fourth").reset();
        }
      }

      function setProgressMaxValue(e) {
        var pBar = document.getElementById('file-progress-fourth');

        if (e.lengthComputable) {
          pBar.max = e.total;
        }
      }

      function updateFileProgress(e) {
        var pBar = document.getElementById('file-progress-fourth');

        if (e.lengthComputable) {
          pBar.value = e.loaded;
        }
      }

      function uploadFile(file) {

        var xhr = new XMLHttpRequest(),
          fileInput = document.getElementById('class-roster-file-fourth'),
          pBar = document.getElementById('file-progress-fourth'),
          fileSizeLimit = 1024; // In MB
        if (xhr.upload) {
          // Check if file is less than x MB
          if (file.size <= fileSizeLimit * 1024 * 1024) {
            // Progress bar
            pBar.style.display = 'inline';
            xhr.upload.addEventListener('loadstart-fourth', setProgressMaxValue, false);
            xhr.upload.addEventListener('progress-fourth', updateFileProgress, false);

            // File received / failed
            xhr.onreadystatechange = function (e) {
              if (xhr.readyState == 4) {
                // Everything is good!

                // progress.className = (xhr.status == 200 ? "success" : "failure");
                // document.location.reload(true);
              }
            };

            // Start upload
            xhr.open('POST', document.getElementById('file-upload-form-fourth').action, true);
            xhr.setRequestHeader('X-File-Name', file.name);
            xhr.setRequestHeader('X-File-Size', file.size);
            xhr.setRequestHeader('Content-Type', 'multipart/form-data');
            xhr.send(file);
          } else {
            output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
          }
        }
      }

      // Check for the various File API support.
      if (window.File && window.FileList && window.FileReader) {
        Init();
      } else {
        document.getElementById('file-drag-fourth').style.display = 'none';
      }
    }
    ekUploadfourth();
  </script>



  <script>
    var imgUpload = document.getElementById('upload_imgs'),
      imgPreview = document.getElementById('img_preview'),
      imgUploadForm = document.getElementById('img-upload-form'),
      totalFiles, previewTitle, previewTitleText, img;

    imgUpload.addEventListener('change', previewImgs, false);
    imgUploadForm.addEventListener('submit', function (e) {
      e.preventDefault();
      alert('Images Uploaded! (not really, but it would if this was on your website)');
    }, false);

    function previewImgs(event) {
      totalFiles = imgUpload.files.length;

      if (!!totalFiles) {
        imgPreview.classList.remove('quote-imgs-thumbs--hidden');
        previewTitle = document.createElement('p');
        previewTitle.style.fontWeight = 'bold';
        previewTitleText = document.createTextNode(totalFiles + ' Total Images Selected');
        previewTitle.appendChild(previewTitleText);
        imgPreview.appendChild(previewTitle);
      }

      for (var i = 0; i < totalFiles; i++) {
        img = document.createElement('img');
        img.src = URL.createObjectURL(event.target.files[i]);
        img.classList.add('img-preview-thumb');
        imgPreview.appendChild(img);
      }
    }
  </script>


  <script>
    var imgUpload = document.getElementById('upload_imgs'),
      imgPreview = document.getElementById('img_preview'),
      imgUploadForm = document.getElementById('img-upload-form'),
      totalFiles, previewTitle, previewTitleText, img;

    imgUpload.addEventListener('change', previewImgs, false);
    imgUploadForm.addEventListener('submit', function (e) {
      e.preventDefault();
      alert('Images Uploaded! (not really, but it would if this was on your website)');
    }, false);

    function previewImgs(event) {
      totalFiles = imgUpload.files.length;

      if (!!totalFiles) {
        imgPreview.classList.remove('quote-imgs-thumbs--hidden');
        previewTitle = document.createElement('p');
        previewTitle.style.fontWeight = 'bold';
        previewTitleText = document.createTextNode(totalFiles + ' Total Images Selected');
        previewTitle.appendChild(previewTitleText);
        imgPreview.appendChild(previewTitle);
      }

      for (var i = 0; i < totalFiles; i++) {
        img = document.createElement('img');
        img.src = URL.createObjectURL(event.target.files[i]);
        img.classList.add('img-preview-thumb');
        imgPreview.appendChild(img);
      }
    }
  </script>

  <script>
    $(document).ready(function () {
      $('[data-toggle="tooltip"]').tooltip({
        html: true
      });
      $('.media').addClass('hide-element');
      $('#imagesUploadForm').submit(function (evt) {
        evt.preventDefault();
      });
      $('#edit').click(function () {
        console.log('click detected inside circl-o of edit');
        $('#edit').toggleClass('fa-circle-o').toggleClass('fa-check-circle');
        if ($('#edit').hasClass('fa-check-circle')) {
          $('#captionForImage').toggleClass('hide-element');
        } else {
          $('#captionForImage').toggleClass('hide-element');
        }
      });
      $('#delete').click(function () {
        console.log('click detected inside circl-o of delete');
        $('#delete').toggleClass('fa-circle-o').toggleClass('fa-times-circle');
      });
      //namespace variable to determine whether to continue or not
      var proceed = false;
      //Ensure that FILE API is supported by the browser to proceed
      if (window.File && window.FileReader && window.FileList && window.Blob) {
        if (window.webkitURL || window.URL) {
          $('#errorMessaage').removeClass('hide-element').addClass(
            'alert-success').html('<span class="glyphicon glyphicon-ok"></span>\n\
            <span class="sr-only">Success:</span>Great your browser is compatiblle for Files API. \n\
Enjoy the demo');
          proceed = true;
        } else {
          $('#errorMessaage').removeClass('hide-element').addClass(
            'alert-warning').html('<span class="glyphicon glyphicon-exclamation-sign"></span>\n\
            <span class="sr-only">Warning:</span>The browser does not support few APIs used in this demo.\n\
But we will be back with a solution.');
        }

      } else {
        $('#errorMessaage').removeClass('hide-element').addClass(
          'alert-warning').html('<span class="glyphicon glyphicon-exclamation-sign"></span>\n\
            <span class="sr-only">Warning:</span>Snap looks like you still live in stone age. \n\
Wake up..Time to update the browser');
      }
      if (proceed) {
        var input = "";
        var formData = new FormData();
        $('input[type=file]').on("change", function (e) {
          var counter = 0;
          var modalPreviewItems = "";
          input = this.files;
          $($(this)[0].files).each(function (i, file) {
            formData.append("file[]", file);
          });
          $('#previewImages').removeClass('hide-element');
          $('#imagesUpload').removeClass('disabled');
          var successUpload = 0;
          var failedUpload = 0;
          var extraFiles = 0;
          var size = input.length;
          $(input).each(function () {
            var reader = new FileReader();
            var uploadImage = this;
            console.log(this);
            reader.readAsArrayBuffer(this);
            reader.onload = function (e) {
              var magicNumbers = validateImage.magicNumbersForExtension(e);
              var fileSize = validateImage.isUploadedFileSizeValid(uploadImage);
              var extension = validateImage.uploadFileExtension(uploadImage);
              var isValidImage = validateImage.validateExtensionToMagicNumbers(magicNumbers);
              var thumbnail = validateImage.generateThumbnail(uploadImage);
              if (fileSize && isValidImage) {
                $('#' + counter).parents('.media').removeClass('hide-element');
                $('#' + counter).attr('src', thumbnail).height('200');
                $('#uploadDataInfo').removeClass('hide-element').addClass('alert-success');
                successUpload++;
                modalPreviewItems += carouselInsideModal.createItemsForSlider(thumbnail, counter);

              } else {
                $('#uploadDataInfo').removeClass('hide-element alert-success').addClass('alert-warning');
                failedUpload++;
              }
              counter++;
              if (counter === size) {
                $('#myCarousel').append(carouselInsideModal.createIndicators(successUpload,
                "myCarousel"));
                $('#previewItems').append(modalPreviewItems);
                $('#previewItems .item').first().addClass('active');
                $('#carouselIndicators > li').first().addClass('active');
                $('#myCarousel').carousel({
                  interval: 2000,
                  cycle: true
                });
                if (size > 4) {
                  $('#toManyFilesUploaded').html("Only files displayed below will be uploaded");
                  extraFiles = size - 4;
                }

                $('#filesCount').html(successUpload + " files are ready to upload");
                if (failedUpload !== 0 || extraFiles !== 0) {
                  failedUpload === 0 ? "" : failedUpload;
                  extraFiles === 0 ? "" : extraFiles;
                  $('#filesUnsupported').html(failedUpload + extraFiles +
                    " files were not  for upload");
                }

              }
            };
          });

        });
        $(document).on('click', '.glyphicon-remove-circle', function () {
          $('#file-error-message').addClass('hide-element');
        });
        $("body").on("click", ".media-object", function () {
          var image = $(this).attr('src');
          $("#individualPreview").attr('src', image);
          var tags = [];
          var displayTagsWithFormat = "";
          ($(this).parents('.media').find('input[type="text"]')).each(function () {
            if ($(this).attr('name') === 'tags') {
              tags = $(this).val().split(",");
              $.each(tags, function (index) {
                displayTagsWithFormat += "<span class = 'label-tags label'>#" + tags[index] +
                  "  <i class='fa fa-times'></i></span>";
              });
              $("#displayTags").html("<div class='pull-left'>" + displayTagsWithFormat + "</div>");
              //console.log(tags);
            }
          });
        });
        var toBeDeleted = [];
        var eachImageValues = [];
        $('.media').each(function (index) {
          var imagePresent = "";
          $("body").on("click", "#delete" + index, function () {
            imagePresent = $("#" + index).attr('src');
            $("#undo" + index).removeClass('hide-element');
            $("#" + index).attr('src', './img/200x200.gif');
            $("#delete" + index).addClass('hide-element');
            toBeDeleted.push(index);
            //console.log(toBeDeleted);
            $("#delete" + index).parent().find('input[type="text"]').each(function () {
              var attribute = $(this).attr('name');
              var attributeValue = $(this).val();
              eachImageValues[attribute + index] = attributeValue;
              //console.log(eachImageValues);

            });
            //console.log(toBeDeleted.length);
            if (toBeDeleted.length === 4) {
              $('#sendImagesToServer').prop('disabled', true).html('No Files to Upload');

            } else {
              $('#sendImagesToServer').prop('disabled', false).html('Update &amp; Preview');
            }

            $("#delete" + index).parent().find('input[type="text"]').prop('disabled', true).addClass(
              'disabled');
          });
          $("body").on("click", "#undo" + index, function () {
            $("#" + index).attr('src', imagePresent);
            $("#undo" + index).addClass('hide-element');
            $("#delete" + index).removeClass('hide-element');
            var indexToDelete = toBeDeleted.indexOf(index);
            if (indexToDelete > -1) {
              toBeDeleted.splice(indexToDelete, 1);
              // console.log(toBeDeleted);
              $("#delete" + index).parent().find('input[type="text"]').prop('disabled', false).removeClass(
                'disabled');
            }
            if (toBeDeleted.length === 4) {
              $('#sendImagesToServer').prop('disabled', true).html('No Files to Upload');

            } else {
              $('#sendImagesToServer').prop('disabled', false).html('Update &amp; Preview');
            }
          });
        });
        $('body').on("click", "#sendImagesToServer1", function (e) {
            e.preventDefault();
          //alert('click');
          //var imageData = new Object();
          //console.log(eachImageValues);
          /*var imageData = new imageInformation('desc', 'cap', 'tags', true);
          var imageData2 = new imageInformation('desc1', 'cap1', 'tags1', true);
          var arrayList =[];
          arrayList.push(imageData);
          arrayList.push(imageData2);
          console.log(JSON.stringify(arrayList));*/
          /*
         * custom event for ajax calls code taken from below link:
         * http://stackoverflow.com/questions/166221/how-can-i-upload-files-asynchronously
         * $(':button').click(function(){
    var formData = new FormData($('form')[0]);
    $.ajax({
        url: 'upload.php',  //Server script to process data
        type: 'POST',
        xhr: function() {  // Custom XMLHttpRequest
            var myXhr = $.ajaxSettings.xhr();
            if(myXhr.upload){ // Check if upload property exists
                myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
            }
            return myXhr;
        },
        //Ajax events
        beforeSend: beforeSendHandler,
        success: completeHandler,
        error: errorHandler,
        // Form data
        data: formData,
        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
    });
});
        function progressHandlingFunction(e){
    if(e.lengthComputable){
        $('progress').attr({value:e.loaded,max:e.total});
    }
}
         */

          var counter = 0;
          var imageData = "";
          var consolidatedData = [];
          $('.media').each(function () {
            var description = "";
            var caption = "";
            var tags = "";
            $('.media').find('input[type="text"]').each(function (index) {
              if ((index === 0 || index <= 11) && counter <= 11) {
                counter++;
                var attributeName = "";
                var attributeValue = "";

                attributeName = $(this).attr('name');
                attributeValue = $(this).val();
                switch (attributeName) {
                  case "description":
                    description = attributeValue;
                    // console.log(description);
                    break;
                  case "caption":
                    caption = attributeValue;
                    // console.log(caption);
                    break;
                  case "tags":
                    tags = attributeValue;
                    // console.log(tags);
                    break;
                  default:
                    break;
                }
                if (counter % 3 === 0) {
                  imageData = new imageInformation(description, caption, tags);
                  consolidatedData.push(imageData);
                  //JSON.stringify(consolidatedData);
                  //console.log(toBeDeleted);
                }
              }
            });
          });
          imageData = new deleteList(toBeDeleted);
          consolidatedData.push(imageData);
          var sendData = JSON.stringify(consolidatedData);
          formData.append("important", sendData);
          $.ajax({
            type: 'POST',
            url: 'upload.php',
            xhr: function () {
              var customXhr = $.ajaxSettings.xhr();
              if (customXhr.upload) {
                customXhr.upload.addEventListener('progress', progressHandlingFunction,
                false); // For handling the progress of the upload
              }
              return customXhr;
            },
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
              $('#ajaxLoad').addClass('hide-element');
              $('#successResponse').html(data.message);
              console.log(data.message + " inside success function");
            },
            error: function (data) {
              $('#successResponse').html(data.responseJSON.message).addClass('label label-danger').css({
                'font-size': '18px'
              });
              console.log(data.responseJSON.message + " inside error function");
            }
          });

          function progressHandlingFunction(e) {
            if (e.lengthComputable) {
              $('#progressIndicator').css({
                'width': e.loaded
              });
            }
          };
          //
          //console.log(JSON.stringify(consolidatedData));
        });

        function imageInformation(description, caption, tags) {
          this.description = description;
          this.caption = caption;
          this.tags = tags;
        };

        function deleteList(toBeDeleted) {
          this.toBeDeleted = toBeDeleted;
        };
        var validateImage = {
          magicNumbersForExtension: function (event) {
            var headerArray = (new Uint8Array(event.target.result)).subarray(0, 4);
            var magicNumber = "";
            for (var counter = 0; counter < headerArray.length; counter++) {
              magicNumber += headerArray[counter].toString(16);
            }
            return magicNumber;
          },
          isUploadedFileSizeValid: function (fileUploaded) {
            var fileSize = fileUploaded.size;
            var maximumSize = 2097125;
            var isValid = "";
            if (fileSize <= maximumSize) {
              isValid = true;
            } else {
              isValid = false;
            }
            return isValid;
          },
          uploadFileExtension: function (fileUploaded) {
            var fileExtension = "";
            var imageType = "";
            imageType = fileUploaded.type.toLowerCase();
            fileExtension = imageType.substr((imageType.lastIndexOf('/') + 1));
            return fileExtension;
          },
          validateExtensionToMagicNumbers: function (magicNumbers) {
            var properExtension = "";
            if (magicNumbers.toLowerCase() === "ffd8ffe0" || magicNumbers.toLowerCase() === "ffd8ffe1" ||
              magicNumbers.toLowerCase() === "ffd8ffe8" ||
              magicNumbers.toLocaleLowerCase() === "89504e47") {
              properExtension = true;

            } else {
              properExtension = false;
            }
            return properExtension;
          },
          generateThumbnail: function (uploadImage) {
            if (window.URL)
              imageSrc = window.URL.createObjectURL(uploadImage);
            else
              imageSrc = window.webkitURL.createObjectURL(uploadImage);
            return imageSrc;
          }
        };
        var carouselInsideModal = {
          createIndicators: function (carouselLength, dataTarget) {
            var carouselIndicators = '<ol class = "carousel-indicators" id="carouselIndicators">';
            for (var counter = 0; counter < carouselLength; counter++) {
              carouselIndicators += '<li data-target = "#' + dataTarget + '"data-slide-to="' + counter +
                '"></li>';
            }
            carouselIndicators += "</ol>";
            return carouselIndicators;
          },
          createItemsForSlider: function (imgSrc, counter) {
            var item = '<div class = "item">' + '<img src="' + imgSrc + '" id="preview' + counter +
            '" /></div>';
            return item;
          }
        };
      }
    });
  </script>
{{-- End HTML SCRIPTS --}}
@endsection
