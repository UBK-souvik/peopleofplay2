<style>
  #Four_Product .form-group{
        margin-bottom: 0;
      }
</style>
<h3 class="Tile-style social my-3">Collaborators</h3>
        <span class="parent-row">
            <div id="Four_Product" class="row add-row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="Collaborators Image">User Image</label>
                  <div>
                  <input type="file" name="collaborator[image][]" class="CollaboratorsImage custom-file-input2" multiple="" />
                  </div>
				  <input id="collaborator_hidden_image_data" type="hidden" name="collaborator[hidden_image_data][]" value="">
                  <!--<button class="fileuploadervedio-btn">Select a Video File</button>-->
                  <br>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="User Name">User Name</label>
                  <input id="UserName" type="text" name="collaborator[name][]" class="form-control" placeholder="">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="User Roles">User Roles</label>
                  <select name="collaborator[role][]" class="form-control" id="">
                      <option value="">Select</option>
                      @foreach(config('cms.collaborator_role') as $key => $value)
                        <option value="{{$key}}" }>{{$value}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="User Roles" >Action</label>
                  <button type="button" class="btn btn-success add-link">+ Add</button>
                </div>
              </div>
              <!-- <div class="col-md-3" >
                <div class="form-group">
                    <label for="Propose Offical Link">Add more</label>
                    <button type="button" class="btn btn-success add-link">+ Add</button>
                </div>
              </div> -->
            </div>

        </span>



        <!-- <div class="row my-4" >
            <div class="col-md-12">
                <div class="table-responsive text-nowrap">
                    <!--Table
                    <table class="table table-striped edit_productTbl">
                        <thead class="titlestyle table-dark">
                            <tr>
                                <!-- <th></th>
                                <th>User Image</th>
                                <th>User Name</th>
                                <th>User Roles</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody class="tbody_productlist">
                                <tr>
                                    <td class="text-center"><img src="#" class="img-fluid" style="width: 30px;height: 30px;object-fit: cover;"> </td>
                                    <td class="verticalalign text-center"><a href="#">ABC</a></td>
                                    <td class="verticalalign text-center">1221</td>
                                    <td class="verticalalign text-center">
                                        <span class="table-edit">
                                            <a class="span-style1 my-0"  data-toggle="modal" data-target="#myModal">Edit</a>
                                        </span>
                                    </td>
                                    <td class="verticalalign text-center">
                                        <span class="table-delete">
                                            <a class="text-danger my-0" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                        </span>
                                    </td>
                                </tr>
                        </tbody>
                        <!--Table body


                    </table>
                    <div class="div">

                    </div>
                    <!--Table
                </div>
            </div>
        </div> -->



        @foreach(@$product->collaborators ?? [] as $collab)
			@php
			 $collaborator_img_data = $collab->image;
			@endphp
            <div id="Four_Product" class="row add-row">
              <div class="col-md-3">
                <div class="form-group">
                    <label for="Collaborators Image">User Image</label>
                    <img src="{{ url('/') }}{{ $collaborator_photos_folder }}{{ $collaborator_img_data }}" alt="" width="50px" height="50px" class="rounded-circle">
                    <hr style="max-width: 120px;">
                    <div>
                      <input type="file" name="collaborator[image][]" class="CollaboratorsImage custom-file-input2" multiple="" />
                    </div>
					
					<input id="collaborator_hidden_image_data" type="hidden" name="collaborator[hidden_image_data][]" value="{{ $collaborator_img_data }}">
                  <!--<button class="fileuploadervedio-btn">Select a Video File</button>-->
                  <br>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="User Name">User Name</label>
                 <input id="UserName" type="text" name="collaborator[name][]" value="{{$collab->name}}" class="form-control" placeholder="">
                </div>

              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="User Roles">User Roles</label>
                  <select name="collaborator[role][]" class="form-control" id="">
                      <option value="">Select</option>
                      @foreach(config('cms.collaborator_role') as $key => $value)
                        <option value="{{$key}}" {{@$collab->role == $key ? 'selected' : ''}}>{{$value}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-2" >
                <div class="form-group">
                    <label for="Propose Offical Link">Action</label>
                    <button type="button" class="btn btn-danger remove-link">- Remove</button>
                </div>
              </div>
            </div>
            @endforeach
        <!-- </span> -->