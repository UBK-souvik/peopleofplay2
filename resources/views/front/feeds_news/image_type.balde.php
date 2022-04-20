<div class="popFeedImagePreview">
                  <div class="col-ting my-4">
                    <div class="control-group file-upload cropie-demo" id="file-upload1">
                      <div class="image-box text-center"  >
                        <div class="image-box-text">
                          <div class="popFeedIcon">
                            <img src="{{ asset('front/images/feed/feed_images.png') }}" class="img-fluid mb-1">
                          </div>
                          <div class="upload-btn-wrapper">
                            <button type="button" class="btn"><i class="fa fa-plus" aria-hidden="true"></i>Add Image</button>
                            <input type="file" class="imagefeed btn upload-file" name="photo" value="Add Image">
                          </div>
                          <!--   <span class="btn"><i class="fa fa-plus" aria-hidden="true"></i> Add Image</span> -->
                        </div>
                        <img src="" alt="" class="img-fluid uploadimg viewImagePreview">
                        <input type="hidden" name="image_name" class="imageName crop_img1" value="">
                      </div>
                        
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="button" class="btn btn-sm btn-success upload-result d-none">Upload Image</button>
                  <div id="image-preview" class="image-preview" style="background:#e1e1e1;padding:30px;height:300px; margin-bottom: 20px;">
                  </div>
                </div>
                <div class="form-group 666" style="text-align: center;">
                  <button type="button" class="btn btn-info btn-sm reset-crop" onclick="resetCrop(this);" style="margin-top:2%; display: none;">Reset Crop</button>
                </div>

                <div class="popFeedTitle">
                  <div class="form-group">
                    <input id="Title" type="text" name="title" class="form-control" placeholder="Title" value="">
                  </div>
                </div>
                <div class="popFeedCaption">
                  <div class="form-group">
                    <textarea class="form-control" rows="7" id="Caption" placeholder="Caption" value="" name="caption"></textarea>
                  </div>
                </div>