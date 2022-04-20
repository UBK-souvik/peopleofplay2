<div class="row">
          <div class="col-md-4">
            <button type="button" class="btn edit-btn-style" data-toggle="modal"
              data-target="#ModalGalleryVideoForm">
              Add @if($galley_type == 1)
						  {{ 'Image' }}
					    @elseif($galley_type == 2)
						  {{ 'Video' }}
					    @else
						  {{ 'Image' }}	
						@endif
            </button>
			
			<form id="galleryForm" >
        <input type="hidden" name="gallery_id" value="{{@$gallery->id}}">
    @csrf
            <div id="ModalGalleryVideoForm" class="modal fade">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <!--  <div class="modal-header">
                                  <div class="row">
                                    <div class="col-md-3 col">
                                      <img src="images/editprofileimage/placeholder.jpg" class="img-fluid">
                                    </div>
                                    <div class="col-md-9 col">

                                      <div class="d-flex flex-row justify-content-between align-items-center">
                                       <h4 class="font-weight-bold">Add Image</h4>
                                       <i class="fa fa-question-circle-o" aria-hidden="true"></i>

                                     </div>

                                    </div>
                                  </div>

                                </div> -->
                  <div class="modal-body modal-product">
                      <!--   <img src="images/uploadimg.jpg" class=" img-fluid uploadimgplus"> -->
                      <div class="wrapalldiv">
                        
						
						@if($galley_type == 1)
						   <div class="form-group text-center">
                          <div id="file-upload-formsecond" class="uploadersecond">
                            <input type="file" id="file-uploadsecond" name="photo"  accept="image/*" />
                            <label for="file-uploadsecond" id="file-dragsecond" class="label1">
                              <img id="file-imagesecond" src="#" alt="Preview" class="hidden">
                              <div id="startsecond">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <div></div>
                                <div id="notimagesecond" class="hidden"></div>
                                <span id="file-upload-btnsecond" class="btn edit-btn-style">Add Image</span>
                              </div>
                              <div id="responsesecond" class="hidden">
                                <div id="messagessecond"></div>
                                <progress class="progress" id="file-progresssecond" value="0">
                                  <span>0</span>%
                                </progress>
                              </div>
                            </label>
                          </div>
                        </div>
					    @endif
						
						@if($galley_type == 2)
						  <div class="form-group">
                          <label for="VideoUrl">Video Url</label>
                          <input id="VideoUrl" type="text" name="gallery_meta[video_url]" class="form-control" placeholder="">
                          </div>
					    @endif
						
                        <label for="Category" class="bg-default text-uppercase">
						About This  
						@if($galley_type == 1)
						  {{ 'Image' }}
					    @elseif($galley_type == 2)
						  {{ 'Video' }}
					    @else
						  {{ 'Image' }}	
						@endif
						</label>
                        <hr>
                        <div class="form-group">
                          <label for="Title">Title</label>
                          <input id="Title" type="text" name="gallery_meta[title]" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="Caption">Caption</label>
                          <textarea class="form-control" rows="5" name="gallery_meta[caption]" id="Caption" placeholder=""></textarea>
                        </div>
                        <div class="form-group">
                          <label for="PersonTag">Person Tag</label>
						   
						   <select name="persons[]" class="custom-select select2" multiple data-placeholder="Select">
                        {{-- <option value="">Select</option> --}}
                        @foreach ($person as $person_index => $person_value)
                        <option value="{{$person_index}}">                  
                         {{$person_value}}</option>
                        @endforeach
                    </select>
						  
                          <!-- <input id="person-tag-id" type="search"  name="gallery_meta[person]"
                            class="form-control searchaward1"> -->
							
							<!-- <input type="text"  id="person-tag-id" data-role="tagsinput"  name="gallery_meta[person]"
                            class="form-control searchaward1" /> -->
                        </div>
                        <div class="form-group">
                          <label for="product-tag-id">Product Tag</label>
                          <select name="products[]" class="custom-select select2" multiple data-placeholder="Select">
                        {{-- <option value="">Select</option> --}}
                        @foreach ($product as $product_index => $product_value)
                        <option value="{{$product_index}}">
                         {{$product_value}}</option>
                        @endforeach
                    </select>
						  
						  <!-- <input id="product-tag-id" data-role="tagsinput" type="text" name="gallery_meta[product]"
                            class="form-control searchaward1"> -->
                        </div>
                        <div class="form-group">
                          <label for="award-tag-id">Award Tag</label>
                          <select name="awards[]" class="custom-select select2" multiple data-placeholder="Select">
                        {{-- <option value="">Select</option> --}}
                        @foreach ($award as $award_index => $award_value)
                        <option value="{{$award_index}}">
                         {{$award_value}}</option>
                        @endforeach
                    </select>
					
						  <!--<input id="award-tag-id" data-role="tagsinput" type="text" name="gallery_meta[award]"
                            class="form-control searchaward1"> -->
                        </div>
                        <div class="form-group">
                          <label for="company-tag-id">Company Tag</label>
                          <select name="companies[]" class="custom-select select2" multiple data-placeholder="Select">
                        {{-- <option value="">Select</option> --}}
                        @foreach ($company as $company_index => $company_value)
                        <option value="{{$index}}">
                         {{$company_value}}</option>
                        @endforeach
                    </select>
						  <!-- <input  id="company-tag-id" data-role="tagsinput" type="text" name="gallery_meta[company]"
                            class="form-control searchaward1"> -->
                        </div>
                        <div class="form-group">
                          <label for="Other Tag">Other Tag</label>
                          <!-- <input id="OtherTag" type="search" name="gallery_meta[other]"
                            class="form-control searchaward1"> -->
							
							<input type="text" value="" data-role="tagsinput" name="others[]"/>
                        </div>
                        
						@if($galley_type == 1)
						  <div class="form-group">
                          <label for="Url">Url</label>
                          <input id="Url" type="text" name="gallery_meta[url]" class="form-control" placeholder="">
                          </div>
					    @endif
						
                      </div>
                      <div class="modal-footer border-top-0 d-flex justify-content-center"> 
                        <input id="gallery_type" type="hidden" name="gallery_meta[gallery_type]" value="{{ $galley_type }}">

						<button type="submit" data-dismiss="modal" class="btn edit-btn-style gallerySubmitButton">Save</button>
                      </div>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
			</form>
			
          </div>
        </div>
		
		
		<script>
    
</script>