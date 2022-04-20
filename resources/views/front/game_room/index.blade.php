@extends('front.layouts.pages')
@section('content')
@php
$str_current_url =  url()->current();
$base_url = url('/');
$user_current_info = get_current_user_info();
$arr_menu_list = App\Helpers\UtilitiesTwo::getMenuLinks($base_url, $user_current_info);
$str_link_drop_menu_dictionary_random = $arr_menu_list['str_link_drop_menu_dictionary_random'];

$str_current_date_new = date('Y-m-d');

$int_recent_words_count_flag = 1;
@endphp
  <style>
.GameBox .card{
    border: unset;
}
.GameBox .card-body {
    padding: 0.25rem;
}


.GameBox .card-deck {
  margin: 0px;
  justify-content: space-between;
}

.GameBox .card-deck .card {
  margin: 0 0 1rem;
}
.GameAppsName {
    padding: 10px 0;
}
.GameRoomShadow {
    background-color: #ffffff;
    box-shadow: 0px 2px 4px 1px #8c8c8c !important;
    border-radius: 12px;
    padding: 20px;
}
.GameBox .GameAppsImage img {
    border-radius: 30px;
    max-width: 150px;
    max-height: 150px;
    min-width: 150px;
    min-height: 150px;
}

@media (min-width: 576px) and (max-width: 767.98px) {
  .GameBox .card-deck .card {
    -ms-flex: 0 0 33.33%;
    flex: 0 0 33.33%;
  }

}

@media (min-width: 768px) and (max-width: 991.98px) {
  .GameBox .card-deck .card {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
  }
  .GameAppsName h5 {
    font-size: 15px;
}
.GameAppsName p {
    font-size: 12px;
}
.GameBox .GameAppsImage img {
    max-width: 120px;
    max-height: 120px;
    min-width: 120px;
    min-height: 120px;
}
}

@media (min-width: 992px)
{
  .GameBox .card-deck .card {
    -ms-flex: 0 0 30.2%;
    flex: 0 0 30.2%;
  }
}
@media (max-width: 767px){
.GameAppsName h5 {
      font-size: 16px;
  }
  .GameAppsName p {
    font-size: 13px;
}
}
@media (max-width: 400px){
  .GameRoomHeading h2 {
      font-size: 20px;
  }
}

  </style>

<div class="col-md-6 col-lg-7">
  <main class="page-content">
    <div class="GameRoomContainer">
      <div class="GameRoomShadow">
      <div class="GameRoomHeading">
        <h2>POP Game Room</h2>
      </div>
      <hr>
      <div class="row">
       <div class="col-md-12">
          <div class="GameBox">
            <div class="card-deck">
              <div class="card">
                <div class="card-body text-center">
                  <div class="GameApps">
                    <div class="GameAppsImage">
                          <img src="{{ asset('front/images/game-app-img.jpg') }}" alt="game-app-img" class="img-fluid">
                    </div>
                    <div class="GameAppsName">
                      <h5 class="mb-0">3 Truths & a Lie</h5>
                      <p>Can you spot the lie?</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body text-center">
                  <div class="GameApps">
                    <div class="GameAppsImage">
                       <img src="{{ asset('front/images/game-app-img.jpg') }}" alt="game-app-img" class="img-fluid">
                    </div>
                    <div class="GameAppsName">
                      <h5 class="mb-0">Guess the Decade!</h5>
                      <p>Do you know when these iconic toys and games were introduced?</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body text-center">
                  <div class="GameApps">
                    <div class="GameAppsImage">
                       <img src="{{ asset('front/images/game-app-img.jpg') }}" alt="game-app-img" class="img-fluid">
                    </div>
                    <div class="GameAppsName">
                      <h5 class="mb-0">Toy Trivia Test</h5>
                      <p>Only true toy nerds will get 12/14 on this toy trivia quiz!</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body text-center">
                  <div class="GameApps">
                    <div class="GameAppsImage">
                       <img src="{{ asset('front/images/game-app-img.jpg') }}" alt="game-app-img" class="img-fluid">
                    </div>
                    <div class="GameAppsName">
                      <h5 class="mb-0">3 Truths & a Lie</h5>
                      <p>Can you spot the lie?</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body text-center">
                  <div class="GameApps">
                    <div class="GameAppsImage">
                       <img src="{{ asset('front/images/game-app-img.jpg') }}" alt="game-app-img" class="img-fluid">
                    </div>
                    <div class="GameAppsName">
                      <h5 class="mb-0">3 Truths & a Lie</h5>
                      <p>Can you spot the lie?</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body text-center">
                  <div class="GameApps">
                    <div class="GameAppsImage">
                       <img src="{{ asset('front/images/game-app-img.jpg') }}" alt="game-app-img" class="img-fluid">
                    </div>
                    <div class="GameAppsName">
                      <h5 class="mb-0">3 Truths & a Lie</h5>
                      <p>Can you spot the lie?</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
       </div>
      </div>
      </div>
    </div>
  </main>
</div>

@endsection
@section('scripts')
<script>      
      
   $(document).ready(function(){
   
    get_autocomplete_dictionary_search_data_new("home-site-search-dictionary-input");
   
   });
   
   
   function get_autocomplete_dictionary_search_data_new(input_text_id)  
   
   {   
   
      $("#"+input_text_id).autocomplete({
   
           source: function( request, response ) {
   
         // Fetch data
   
         $.ajax({
   
        url: base_url_new + '/home/get-ajax-site-dictionary-data',
   
        type: 'post',
   
        dataType: "json",
   
        data: {
   
         search: request.term,
   
         token: ajax_csrf_token_new,
   
        },
   
        headers: {
   
         'X-CSRF-TOKEN': ajax_csrf_token_new
   
        },
   
        success: function( data ) {
   
         response( data );
   
        }
   
         });
   
        },
   
      minLength: 1
   
       }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
   
      
      var item_image = '';
      var item_type = 0;
   
      item_type = item.type;
   
      var full_image_upload_path_new = '';
      var item_link_slug_prefix = '';
      var str_slug_prefix_new = '';
      
        str_slug_prefix_new =  '/pop-dictionary';   
   
        var inner_html = '<a href="' + base_url_new + str_slug_prefix_new + '/' + item.slug + '"><div class="list_item_container"><div class="image"><span class="label">' + item.title + '</span></div></div></a>';
   
           return $( "<li></li>" )
   
               .data( "item.ui-autocomplete", item )
               .append(inner_html)
               .appendTo( ul );
   
       }
   
    
    }
      
</script>   
@endsection