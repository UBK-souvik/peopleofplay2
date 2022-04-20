            <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Quiz <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control select2" name="quiz_id" >
                            <option value="">Select</option>
                            @foreach($quizzes as $quiz_row)
                              <option value="{{ $quiz_row->id }}" <?php if(isset($question->quiz_id) && !empty($question->quiz_id)){ echo "selected"; } ?> >{{ $quiz_row->title }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>