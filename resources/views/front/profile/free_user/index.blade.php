@extends('front.layouts.pages')

@section('content')

<style>

    /*.profile_img_wrap{
        width:300px;
        max-height: 300px;
        overflow: hidden;
        margin-right: 10px;
    }*/

    .k_text_sec{
        width: 100%;
    }

    .k_text_sec p{
        margin: 0;
        padding: 0;
    }

    .span-style {
         margin-left: 0px;
    }

    .overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: -14px;
        opacity: 0;
        transition: .5s ease;
        background-color: rgba(0,0,0,0.5)!important;
        margin-left: 14px;
        height: 21%;
        width: 95%;
        top: 79%;
    }

    .overlay1 {
        position: absolute;
        left: -6px;
        opacity: 0;
        transition: .5s ease;
        background-color: rgba(0,0,0,0.5)!important;
        margin-left: 14px;
        height: 21%;
        width: 92%;
        top: 79%;
    }

    .awards_box_wrap{
        margin-right: 10px;
        width: 180px;
        height: 210px;
        overflow: hidden;
    }

  .event_table{
    width: auto!important;
  }

  .event_table th {
    text-align: center;
    font-weight: 500!important;
    font-size: 16px !important;
}

  .event_table tr td img{
    width: 40px;
    height: 40px;
  }

  .event_table tr td{
    font-weight:500!important;
  }

  .event_table tbody tr{
        background-color: none!important;
        border-bottom: 1px solid lightgrey;
        margin-bottom: 3px;
  }

  .event_table .dac_name{
    color: #3D8E99;
    /*width: 250px;*/
  }

  .event_table .mac_name{
    color: #3D8E99;
    width: 175px;
  }



</style>
    <div class="col-md-6 col-lg-7">
        <div class="left-column">
        <div class="First-column bg-white p-3">
            <h3 class="">Contact Information</h3>
            <div class="row ">
              <div class="col-md-12">
                @if(!empty($user->first_name))
                    <p class="text-black p-0 mb-1"><strong>Primary Email</strong> : {{@$user->first_name .' '. @$user->last_name}}</p>

                @endif

                @if(!empty($user->email))

                    <p class="text-black p-0 mb-1"><strong>Primary Email</strong> : {{ @$user->email }}</p>

                @endif

                @if(!empty($user->mobile))

                    <p class="text-black p-0 mb-1"><strong>Primary Mobile</strong> : {{ @$user->mobile }}</p>

                @endif

                @if(!empty($user->website))

                    <p class="text-black p-0 mb-1"><strong>Website</strong> : {{ @$user->website }}</p>

                @endif

              </div>

            </div>

        </div>
    

    </div>
    <!-- <div class="feed">
        <div class="top-banner bg-box-shadow text-center">
            <h3>Welcome to People of Play</h3>
            <h6>YOUR PREMIER PLAY RESOURCE</h6>
           <p> Feel the Community and Network like never before with: 
            our Events, POPpedia, Dictionary, Classifieds, 
            and the brand new POP Feed.</p>
            <span>Set your Interests for your Personalized Experience</span>
        </div>
        <div class="feed-main-box">
             <div class="feed-box bg-box-shadow">
                <div class="w-100 clearfix feed-profile d-flex ">
                    <div class="profile-img w-50 d-flex align-items-center">
                        <div class="prof-image mr-2">
                            <img src="{{ asset('front/images/image1.jpg') }}" alt="profileimage" class="img-fluid rounded-circle">
                        </div>
                        <div class="Prof-name">
                            <span>Peggy Brown</span>
                        </div>
                    </div>
                     <div class="add-favorites w-50 d-table">
                        <div class="d-table-cell align-middle text-right">
                            <span><i class="fa fa-star-o" aria-hidden="true"></i> Add to Favorites</span>
                        </div>
                    </div>
                </div>
                <div class="feed-top-text my-4">
                    <h4>Peggy Brown on Rachel Ray!</h4>
                </div>
                <div class="feed-image-post">
                     <img src="{{ asset('front/images/lego_toys_img.jpeg') }}" alt="lego_toys_img" class="img-fluid">
                </div>
                <div class="feed-bottom-text">
                    <div class="feed-msg mt-2">
                        <p>Throwback to when I was on The Rachael Ray Show. Hope to be back on soon</p>
                    </div>
                    <div class="feed-tag">
                        <ul class="nav tag-list">
                          <li class="nav-item">
                            <a class="nav-link" href="#">#Games </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">#GameInventor</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">#RachaelRay</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">#TV</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">#Interview</a>
                          </li>
                        </ul>
                    </div>
                    <div class="feed-anchor">
                        <ul class="nav ankr-list">
                          <li class="nav-item">
                            <a class="nav-link" href="#">@RachelRay</a>
                          </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>

@endsection



@section('scripts')

<script>

    /*var scroll = new SmoothScroll('a[href*="#"]');

    $(document).ready(function () {

        $(".owl-carousel").owlCarousel();

    });*/

</script>

@endsection

