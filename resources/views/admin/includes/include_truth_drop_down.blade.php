					  
						  <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">{{$int_question_id}}<i class="has-error">*</i></label>
                        <div class="col-sm-6">
						  @php
						   $str_truth_drop_down_name ='ques_'.$int_question_id.'_truth_val';
						   $str_ques_val_name_new = 'ques_'.$int_question_id.'_val';
						   $int_truth_drop_down_val = @$question->$str_truth_drop_down_name;
						   $str_str_ques_val = @$question->$str_ques_val_name_new;
						   
						  @endphp
						  
						  <span>
                          <input type="text" class="form-control" name="{{$str_ques_val_name_new}}" placeholder="Truth or Lie" value="{{@$str_str_ques_val}}">
                          </span>
						</div>
                      </div>