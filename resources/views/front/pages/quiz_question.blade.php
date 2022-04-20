@extends('front.layouts.pages')
@section('content')
@php
$str_user_name = '';
$str_user_url_new = '#';
$str_profile_image = '';
if(!empty($question_detail[0]->user_id))          
{ 
@$str_user_name = App\Helpers\Utilities::getUserName(@$question_detail[0]->user);
@$str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, @$question_detail[0]->user);
@$str_profile_image = @imageBasePath(@$question_detail[0]->user->profile_image);
}
@endphp           

<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
   <div class="left-column bg-black1 krow_margin kproduct QuizQuestion">
      <div class="QuizTitle py-4 text-center">
         <h2>{{ $quiz_data->title }}</h2>
      </div>
     <div class="First-column bg-black1 pt-0">
       <div class="container px-4">
          <div class="row  mt-3">

            <div class="col-lg-5 mb-4">
                <div class="quizLeftImg mt-4 text-center">
                  <?php
                     if($question_detail[0]->image ==''){
                        $image = asset('front/images/team_new.png/');
                     } else {
                         $image = asset('uploads/images/question_quiz/'.$question_detail[0]->image);
                     }
                   ?>
                   <a href="{{$str_user_url_new}}"><img src="{{ $image }}" class="w-100"></a>
                   <!-- <div class="mt-1 text-center">
                      <a href="{{$str_user_url_new}}">
                         <h5 class="font-weight-normal text-dark">{{$str_user_name}}</h5>
                      </a>
                   </div> -->
                </div>
             </div>
              <div class="col-lg-7 mb-4 deskPadLeft">
               <div class="text-left pt-4">
                  <h2 class="text-center text-md-left mb-4">{{ $question_detail[0]->question }}</h2>
               </div>
               <form id="quiz-form" enctype="multipart/form-data">
                 <div>
                    @php  
                    $arr_questions_ids = App\Helpers\UtilitiesTwo::get_questions_list_new();
                    $int_ascii_val_alphabets = 65;
                    @endphp
                    @foreach($arr_questions_ids as $arr_questions_id_row)
                    @php
                    $int_question_id = $arr_questions_id_row;
                    //$str_ques_val_name_new = 'ques_'.$int_question_id.'_val';
                    $str_question_data_val_new = 'ques_'.$int_question_id.'_val';
                    $str_ques_val_name_new = 'question_id';
                    $str_str_ques_val = @$question_detail[0]->$str_question_data_val_new;
                    $str_val_alphabets = chr($int_ascii_val_alphabets);
                    $int_ascii_val_alphabets++;
                    @endphp    
                    <div id="mainDivId_{{$int_question_id}}">
                       <a onclick="checkQuiz(this)" href="#">
                          <div id="childDivId_{{$int_question_id}}" class="d-flex optionsBox mb-3">
                             <div class="d-flex">
                                <div class="textWrapLetter text-dark mt-1"><span>{{$str_val_alphabets}}</span></div>
                                <input type="hidden" name="" value="{{$int_question_id}}">
                                <div class="labelContainer text-dark mb-0">
                                <p class="mb-0">{{@$str_str_ques_val}}</p>
                                </div>
                             </div>
                          </div>
                       </a>
                    </div>
                    @endforeach
                    <div class="text-center" id="div-id-select-truth"  style="display:none;">
                       <p class="quizTextRed" style="font-size: 18px"><strong>Guess again</strong></p>
                    </div>
                    <div class="text-center"  id="div-id-select-lie" style="display:none;">
                       <p class="quizTextGreen" style="font-size: 18px"><strong>You guessed right!</strong></p>
                    </div>
                    <div class="text-center">
                       <input type="hidden" id="questions_id"  name="questions_id" value="@if(!empty($question_detail[0]->id)){{$question_detail[0]->id}}@endif"> 
                       <input type="hidden" id="quiz_id"  name="quiz_id" value="@if(!empty($question_detail[0]->quiz_id)){{$question_detail[0]->quiz_id}}@endif"> 
                       <!-- <input type="hidden" id="quiz_id"  name="quiz_id" value="@if(!empty($question_detail[0]->id)){{$question_detail[0]->id}}@endif">  -->
                       <input type="hidden" id="which_is_lie"  name="which_is_lie" value="@if(!empty($question_detail[0]->which_is_lie)){{$question_detail[0]->which_is_lie}}@endif">
                       <input type="hidden" name="{{$str_ques_val_name_new}}" id="{{$str_ques_val_name_new}}"  value="">
                       <button type="submit" class="btn playBtnQuiz1 btnAll" id="submitQuiz">Play Again</button>
                    </div>
                 </div>
               </form>
              </div>
          </div>
       </div>
     </div>
   </div>
</div>
</div>
@endsection
@section('scripts')
<script>
   function checkQuiz(val){
      var checkValue  = $(val).find('input').val();
      var str_background_color_new;
      //alert(checkValue);
        var int_which_is_lie = document.getElementById("which_is_lie").value; 
      
      document.getElementById("div-id-select-lie").style.display ="none";
        document.getElementById("div-id-select-truth").style.display ="none";
      
      document.getElementById("question_id").value = checkValue;
      
      if(int_which_is_lie == checkValue)
      {
          str_background_color_new = 'quizBgGreen';
        document.getElementById("div-id-select-lie").style.display ="block";
      }
      else
      {
         str_background_color_new = 'quizBgRed';
              document.getElementById("div-id-select-truth").style.display ="block";         
      }
      
      $( "#mainDivId_" + checkValue + " #childDivId_" + checkValue  ).addClass( str_background_color_new );
   
     
    }
   
   function checkRadio(value) {
    
    document.getElementById("div-id-select-lie").style.display ="none";
    document.getElementById("div-id-select-truth").style.display ="none";
    
    var int_which_is_lie = document.getElementById("which_is_lie").value;
       
    if(value == int_which_is_lie)
       {
      document.getElementById("div-id-select-lie").style.display ="block";
    }
    else
    {
      document.getElementById("div-id-select-truth").style.display ="block";    
    }
      
    //console.log("Choice: ", name);
           //document.getElementById("one-variable-equations").checked = true;
           //document.getElementById("multiple-variable-equations").checked = false;
   
   }
   
   // Event Form
        $(document).on('click', '#submitQuiz', function (e) {
               e.preventDefault();
        
        var fd = new FormData($('#quiz-form')[0]); 
               
               $.ajax({
                   url: "{{ route('front.user.quizquestion.save') }}",
          headers: {
                    'X-CSRF-TOKEN': ajax_csrf_token_new
                   },
                   data: fd,// + '&ckeditor_description_new=' + ckeditor_description_new
                   processData: false,
                   contentType: false,
          dataType: 'json',
                   type: 'POST',
                   beforeSend: function () {
                       $('#submitQuiz').attr('disabled', true);
                       // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                   },
                   error: function (jqXHR, exception) {
                       $('#submitQuiz').attr('disabled', false);
   
                       var msg = formatErrorMessage(jqXHR, exception);
                       toastr.error(msg)
                       console.log(msg);
                       // $('.message_box').html(msg).removeClass('hide');
                   },
                   success: function (data) {
                       $('#submitQuiz').attr('disabled', false);
                       //toastr.success("Quiz Saved Successfully.");
                    window.location.reload();
   
                   }
               });
           });
</script>
@endsection