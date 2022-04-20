@extends('front.layouts.pages')
@section('content')
      

<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
   <div class="left-column bg-black1 krow_margin kproduct NewQuizDetail">
     <div class="First-column bg-black1 pt-0">
       <div class="container px-4">
          <div class="row  mt-3">
             <?php foreach($quiz_data as $quiz){ ?>
               {{ $quiz->title }} 
               <br>
               {{ $quiz->description }}
             <?php } ?>
       </div>
     </div>
   </div>
</div>
</div>
@endsection
