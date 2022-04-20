@extends('front.layouts.pages')
@section('content')
<?php echo "sadf"; die; ?>
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
    <div class="left-column">
        <div class="First-column bg-white p-2 m-2" style="border:1px solid lightgrey">
            <div class="">
                <div class="row">
                    <div class="col-md-3">
                        <?php if(!empty($user->profile_image))
                        {
                            ?>
                            <div class="profile_img_wrap">
                                <img src="{{imageBasePath($user->profile_image)}}" class="img-fluid">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-9">
                        <div class="paragraph k_text_sec">
                            <h2>
                              {{ $user->username }}
                              <?php //{{$user->first_name .' '. $user->last_name}} ?>
                          </h2>
                          <ul class="d-flex flex-row ul-text-color">
                            <li>
                             @php
                             $int_role_flag =0;
                             @endphp

                             @foreach($user->roles ?? [] as $role)
                             @php
                             if($int_role_flag == 2)
                             {
                                break;
                            }
                            @endphp

                            {{$role->role}}
                            @if($int_role_flag == 0)
                            |
                            @endif
                            @php
                            $int_role_flag++;
                            @endphp
                            @endforeach
                        </li>
                        {{-- <li class="mx-3">Trustee</li>
                        <li>Award recipient</li> --}}
                    </ul>
                    <hr>
                    <p class="p-text">{{$user->description}}</p>
                    {{-- <p>Born: {{@Carbon\Carbon::parse($user->dob)->format('d M Y')}} (age {{@Carbon\Carbon::parse($user->dob)->age}})
                    </p>
                        <p>Contact Info :  <!-- View <span class="span-style">agent, manager, legal
                        and company</span> -->

                        @include("front.profile.view_contact_info_popup")

                    </p>
                    <p> More at : @include("front.profile.more_at_poppro_popup")

                    </p> --}}
                </div>
            </div>
        </div>
    </div>

    @if(!empty($gallery_image_data))
    @include("front.user.modules.images_gallery")
    @endif

    @if(!empty($gallery_known_for_data))
    @include("front.user.modules.known_for_images")
		<!--<span class="span-style mt-3 px-3">See all birthdays &gt;&gt; </span>
          <hr class="mt- bg-dark"> -->
          @endif


          @if(!empty($awards))
          <div class="wrap-text">
              <h3>Awards</h3>
          </div>
          <div class="row desktopveiw">
              <div class="col-md-12">
                  <div>
                      <table class="table event_table">
                          <tbody>
                            @foreach($awards ?? [] as $award)
                            <tr class="py-1 px-3">
                                {{-- {{dd($award)}} --}}
                                {{-- <td class="py-0 px-1"><img src="https://portraitsbnw.com/priya/updated/images/Awards/award1.jpg" ></td> --}}
                                <td class="dac_name">{{@$award->eventAward->name}}</td>
                                <td>...</td>
                                <td>
                                  <a href="{{route('front.user.awardnominee.index')}}?id={{@$award->eventAward->id}}">View</a>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>

              <div class="mt-3">
                  <span class="span-style1" data-toggle="modal" data-target=".bs-example-modal-lg">See all Awards >></span>
              </div>
          </div>
      </div>
      @endif


      @if(!empty($gallery_video_data))
      @include("front.user.modules.videos_gallery")
      @endif

@if(!empty($user->email) || !empty($user->mobile) || !empty($user->website))
      <h3 class="">Contact Information</h3>
      <div class="row ">
          <div class="col-md-12">
            @if(!empty($user->email))<p class="text-black p-0 mb-1"><strong>Primary Email</strong> : {{ $user->email }}</p>@endif
            @if(!empty($user->mobile))<p class="text-black p-0 mb-1"><strong>Primary Mobile</strong> : {{ $user->mobile }}</p>@endif
            @if(!empty($user->website))<p class="text-black p-0 mb-1"><strong>Website</strong> : {{ $user->website }}</p>@endif
        </div>
    </div>
    @endif
</div>

@if(!empty($news))
<div class="NextbackgroundColor px-3">
    <div class="wrap-text d-flex text-white">
        <h3>Did you know?</h3>
        <p class="span-style ml-auto">
            @foreach ($news->categories ?? [] as $category)
            <a href="#">
                {{$category->category->name ?? null}}
            </a>
            @if($loop->remaining)
            |
            @else
        &gt;</p>
        @endif
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="wrap-gallery my-3">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{imageBasePath($news->featured_image)}}"
                            class="img-fluid mr-3">
                        </div>
                        <div class="col-md-9">
                            <div class="paragraphdesign">
                                <p>{{$news->title}}<br>
                                    {{$news->created_at->diffForHumans() ?? null}} <br><br>

                                    {!! $news->description !!}
                                    <!-- <span class="span-style">See more&gt;&gt;</span> -->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="span-style1"><a href="{{route('front.pages.news')}}">See more Top News &gt;&gt;</a></span>
        </div>
    </div>
</div>
@endif
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
