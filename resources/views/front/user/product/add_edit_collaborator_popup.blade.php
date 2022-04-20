<div class="modal" id="myModal">

                            <div class="modal-dialog modal-md">

                              <div class="modal-content">

                                <div class="modal-header text-center kbg_black">

                                  <h4 class="modal-title text-white mt-2">Collborators Add/Edit</h4>

                                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                                </div>

                                <div class="modal-body p-3">

                                  <div class="">

                                    <form id="AddEditCollabModalForm" method="post" enctype="multipart/form-data" onsubmit="submitEditCollabModalForm(this,'add_collaboration_id'); return false;">

                                      @csrf

                                      <input type="hidden" name="collaboration_id" id="add_collaboration_id">

                                      <input type="hidden" name="product_id" value="{{@$product->id}}">

                                      <input type="hidden" name="collab_hidden_user_image" id="collab_hidden_user_image" >

									  <input type="hidden" name="collab_user_id_hidden" id="collab_user_id_hidden">

                                      <div class="col-md-12">

                                        <div class="row">

                                          

										  {{-- <div class="col-md-5 pl-0">

                                            <img src="" id="blah2" name="collab-blah2" class="imgThreeNine">

                                            <div class="mt-3 mb-2">

                                              <input type="file" name="collab_user_image" onchange="readURL2(this);" class="custom-file-input1 ">

                                            </div>                                            

                                          </div> --}}

										  

                                          <div class="col-md-6 px-0">

                                            <div class="form-group">

                                              <label for="email">User Name:</label>

											  <!-- <input id="collab_user_name" class="form-control collab_user_name" name="collab_user_name" > -->

                        <select name="collab_user_name" id="collab_user_name" class="form-control input-sm select2-multiple-collab" multiple>
                          @foreach($collaborator_list as $collaborator_lists)
                          <option id="collab_people_id_{{@$collaborator_lists->id}}" value="{{@$collaborator_lists->id}}">{{@$collaborator_lists->text}}</option>
                          @endforeach
                        </select>

                       <!-- <option value="">Select</option> 

                       </select>

                                              <input type="text" class="form-control" name="collab_user_name" id="collab_user_name" placeholder="User Name" value=""> -->

                                            </div>

                                          </div>

                                          <div class="col-md-6 px-0">

                                            <div class="form-group">

                                              <label for="pwd">User Roles:</label>

                                              <select class="form-control" name="collab_user_role" id="collab_user_role">

                                                  <option value="">Select User Role</option>

                                                @foreach(users_user_roles() as $key => $value)

                                                  <option value="{{$key}}">{{$value}}</option>

                                                @endforeach

                                              </select>

                                            </div>



                                           



                                          </div>

                                        </div>

                                        <div class="row">

                                          <button type="submit" class="btn btnAll AddEditCollabModalSave">Save</button>

                                        </div>

                                      </div>

                                    </form>

                                  </div>

                                </div>

                                <!-- <div class="modal-footer">

                                  <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>

                                </div> -->

                              </div>

                            </div>

                          </div>