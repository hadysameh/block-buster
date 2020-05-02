@extends('layouts.mapp')

@section('content')


<!-- BEGIN | Header -->

	    {{-- {{$movies}} --}}
	    

<div class="slider movie-items">
	<div class="container">
		<div class="row">
			<div class="social-link">
				<p>Follow us: </p>
				<a href="#"><i class="ion-social-facebook"></i></a>
				<a href="#"><i class="ion-social-twitter"></i></a>
				<a href="#"><i class="ion-social-googleplus"></i></a>
				<a href="#"><i class="ion-social-youtube"></i></a>
			</div>
	    	<div  class="slick-multiItemSlider">

				@for($i=0;$i< (count($movies) > 4? 5:count($movies)) ;$i++)
					<div class="movie-item">
						<div class="mv-img">
						<a href="{{$movies[$i]->id}}"><img src="/storage/{{$movies[$i]->image}}" alt="" width="285" height="437"></a>
						</div>
						<div class="title-in">
							<div class="cate">
								<span class="blue"><a href="#">Sci-fi</a></span>
							</div>
							<h6><a href="/showtimes/{{$movies[$i]->id}}">{{$movies[$i]->movie_name}}</a></h6>
							<p><i class="ion-android-star"></i><span>{{$movies[$i]->rate}}</span> /10</p>
						</div>
					</div>
				@endfor
				
				
	    	</div>
	    </div>
	</div>
</div>
<div class="movie-items">
	<div class="container">
		<div class="row ipad-width">
			<div class="col-md-8">
				<div class="title-hd">
					<h2>in theater</h2>
					<a href="#" class="viewall">View all <i class="ion-ios-arrow-right"></i></a>
				</div>
				<div class="tabs">
					<ul class="tab-links">
						<li class="active"><a href="#tab1">#Popular</a></li>
						<li><a href="#tab2"> #Coming soon</a></li>
						<li><a href="#tab3">  #Top rated  </a></li>
						<li><a href="#tab4"> #Most reviewed</a></li>                        
					</ul>
				    <div class="tab-content">
				        <div id="tab1" class="tab active">
				            <div class="row">
				            	<div class="slick-multiItem">
									@foreach ($movies as $movie)
										<div class="slide-it">
											<div class="movie-item">
												<div class="mv-img">
													<img src="/storage/{{$movie->image}}" alt="" width="185" height="284">
												</div> 
												<div class="hvr-inner">
													<a href="/showtimes/{{$movie->id}}"> Read more <i class="ion-android-arrow-dropright"></i> </a>
												</div>
												<div class="title-in">
													<h6><a href="/showtimes/{{$movie->id}}">{{$movie->movie_name}}</a></h6>
													<p><i class="ion-android-star"></i><span>{{$movie->rate}}</span> /10</p>
												</div>
											</div>
										</div>
									@endforeach
				            	</div>
				            </div>
				        </div>
				       
				    </div>
				</div>
				<div class="title-hd">
					<h2>all movies</h2>		
								
				</div>
				<div class="">					
				    <div class="tab-content">
				        <div id="tab21" class="tab">
				            <div class="row">
								<div style="margin:0px 0px 15px 15px;display:flex;flex-wrap: wrap;justify-content: center">

									@foreach ($movies as $movie)
										<div class="" style="margin-bottom:10px">
											<div class="movie-item">
												<div class="mv-img">
													<img src="/storage/{{$movie->image}}" alt="" style="width:161px;height:243px;">
												</div>
												<div class="hvr-inner">
													<a href="/showtimes/{{$movie->id}}"> Read more <i class="ion-android-arrow-dropright"></i> </a>
												</div>
												<div class="title-in">
													<h6><a href="/showtimes/{{$movie->id}}">{{$movie->movie_name}}</a></h6>
													<p><i class="ion-android-star"></i><span>{{$movie->rate}}</span> /10</p>
												</div>
											</div>											
										</div>
									@endforeach
									
								</div>
				            	
							</div>
						</div>
					</div>
				</div>
				
				
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<div class="ads">
						{{-- <img src="mapp/images/uploads/ads1.png" alt="" width="336" height="296"> --}}
						<div style="height: 300px;width: 300px;background-color: #fff;display: flex;justify-content: center;align-items: center">
							<p style="color:#dd003f;font-family: fantasy;font-size: 28px;text-align: center;">our app is comming soon</p>
							

						</div>
					</div>
					<div class="celebrities">
						<h4 class="sb-title">Spotlight Celebrities</h4>
						<div class="celeb-item">
							<a href="#"><img src="mapp/images/uploads/ava1.jpg" alt="" width="70" height="70"></a>
							<div class="celeb-author">
								<h6><a href="#">Samuel N. Jack</a></h6>
								<span>Actor</span>
							</div>
						</div>
						<div class="celeb-item">
							<a href="#"><img src="mapp/images/uploads/ava2.jpg" alt="" width="70" height="70"></a>
							<div class="celeb-author">
								<h6><a href="#">Benjamin Carroll</a></h6>
								<span>Actor</span>
							</div>
						</div>
						<div class="celeb-item">
							<a href="#"><img src="mapp/images/uploads/ava3.jpg" alt="" width="70" height="70"></a>
							<div class="celeb-author">
								<h6><a href="#">Beverly Griffin</a></h6>
								<span>Actor</span>
							</div>
						</div>
						<div class="celeb-item">
							<a href="#"><img src="mapp/images/uploads/ava4.jpg" alt="" width="70" height="70"></a>
							<div class="celeb-author">
								<h6><a href="#">Justin Weaver</a></h6>
								<span>Actor</span>
							</div>
						</div>
						<a href="#" class="btn">See all celebrities<i class="ion-ios-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection