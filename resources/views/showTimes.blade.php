@extends('layouts.mapp')

@section('content')

   <div class="hero mv-single-hero">
       <div class="container">
           <div class="row">
               <div class="col-md-12">
                   <!-- <h1> movie listing - list</h1>
                   <ul class="breadcumb">
                       <li class="active"><a href="#">Home</a></li>
                       <li> <span class="ion-ios-arrow-right"></span> movie listing</li>
                   </ul> -->
               </div>
           </div>
       </div>
   </div>
    <div class="page-single movie-single movie_single">
        <div class="container">                                                                                      
            <div class="row ipad-width2">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="movie-img ">
                        <img src="/storage/{{$movie->image}}" alt="">
                        <div class="movie-btn">	
                            <div class="btn-transform transform-vertical red">
                                <div><a href="#" class="item item-1 redbtn" target="blank"> <i class="ion-play"></i> Watch Trailer</a></div>
                                @if($movie->trailer_link != 'comming soon')
                                    <div><a href="{{$movie->trailer_link}}" class="item item-2 redbtn fancybox-media hvr-grow"><i class="ion-play"></i></a></div>
                                @endif

                            </div>
                            {{-- <div class="btn-transform transform-vertical">
                                <div><a href="#" class="item item-1 yellowbtn"> <i class="ion-card"></i> Buy ticket</a></div>
                                <div><a href="#" class="item item-2 yellowbtn"><i class="ion-card"></i></a></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="movie-single-ct main-content">
                        <h1 class="bd-hd">{{$movie->movie_name}}</h1>
                        <div class="social-btn">
                            <a href="#" class="parent-btn"><i class="ion-heart"></i> Add to Favorite</a>
                            <div class="hover-bnt">
                                <a href="#" class="parent-btn"><i class="ion-android-share-alt"></i>share</a>
                                <div class="hvr-item">
                                    <a href="#" class="hvr-grow"><i class="ion-social-facebook"></i></a>
                                    <a href="#" class="hvr-grow"><i class="ion-social-twitter"></i></a>
                                    <a href="#" class="hvr-grow"><i class="ion-social-googleplus"></i></a>
                                    <a href="#" class="hvr-grow"><i class="ion-social-youtube"></i></a>
                                </div>
                            </div>		
                        </div>
                        <div class="movie-rate">
                            <div class="rate">
                                <i class="ion-android-star"></i>
                                <p><span>{{$movie->rate}}</span> /10<br>
                                    <span class="rv">56 Reviews</span>
                                </p>
                            </div>
                            <div class="rate-star">
                                <p>Rate This Movie:  </p>
                                @for($i=0;$i<$movie->rate;$i++)
                                    <i class="ion-ios-star"></i>
                                @endfor
                                {{-- <i class="ion-ios-star"></i>
                                <i class="ion-ios-star"></i>
                                <i class="ion-ios-star"></i>
                                <i class="ion-ios-star"></i>
                                <i class="ion-ios-star"></i>
                                <i class="ion-ios-star"></i>
                                <i class="ion-ios-star"></i>
                                <i class="ion-ios-star-outline"></i> --}}
                            </div>
                            
                        </div> 
                        <div style="color:#fff">                            
                        <show-times :dates='{{$dates}}' :events='{{$events}}' :movie_id='{{$movie_id}}'></show-times>
                        </div>
                                            
                    </div>
                </div>
            </div>
        </div>
        
    </div>
     


@endsection