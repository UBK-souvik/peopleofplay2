<?php 
$int_user_id_sel_new = 0;
$str_author_onchange = '';
$int_is_classified_page = 0;
$current_url_new = url()->current();
$int_is_blog_page = 0;
$int_is_did_you_know_page = 0;
$int_is_question_page = 0;

if(strpos($current_url_new, '/admin/classified/')>0)
{
 $int_is_classified_page = 1;	  
 $str_author_onchange = 'return get_classified_user_url(this.value);';
}

if(strpos($current_url_new, '/admin/blog/')>0)
{
 $int_is_blog_page = 1;
}

if(strpos($current_url_new, '/admin/did-you-know/')>0)
{
 $int_is_did_you_know_page = 1;
}

if(strpos($current_url_new, '/admin/question/')>0)
{
 $int_is_question_page = 1;
}

if(strpos($current_url_new, 'admin/quiz-question/update/')>0)
{
 $int_is_quiz_question_page = 1;
}


if(!empty($int_is_classified_page) && !empty($classified) && !empty($classified->user_id))
{
  $int_user_id_sel_new = $classified->user_id;	
}

if(!empty($int_is_blog_page) && !empty($blog) && !empty($blog->user_id))
{
  $int_user_id_sel_new = $blog->user_id;	
}

if(!empty($int_is_did_you_know_page) && !empty($news) && !empty($news->user_id))
{
  $int_user_id_sel_new = $news->user_id;	
}

if(!empty($int_is_question_page) && !empty($question) && !empty($question->user_id))
{
  $int_user_id_sel_new = $question->user_id;	
}
if(!empty($int_is_quiz_question_page) && !empty($question) && !empty($question->user_id))
{
  $int_user_id_sel_new = $question->user_id;  
}

 ?>

<div class="form-group">
  <label for="name" class="col-sm-2 control-label">Author <i class="has-error">*</i></label>
  <div class="col-sm-6">
    <select class="form-control select2" name="user_id" onchange="<?php echo e($str_author_onchange); ?>">
      <option value="">Select</option>
      <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
      $arr_user_row =  json_decode(@$user_row);
      $key = @$arr_user_row->id;
      $status = @$arr_user_row->text;
      ?>							   
      <option value="<?php echo e($key); ?>" <?php echo e(isset($int_user_id_sel_new) && $int_user_id_sel_new == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
  </div>
</div>