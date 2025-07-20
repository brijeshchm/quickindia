 <!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
<meta name="csrf-token" content="{{ csrf_token() }}">	 
<link rel="canonical" href="{{ URL::current() }}"/>

<link rel="shortcut icon" href="{{ URL::asset('logo/favicon.png') }}" type="image/x-icon">   
<base href="{{asset('')}}" >
  <!-- Favicons -->
  <!--<link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">-->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">
  <!-- Bootstrap CSS File -->
  <link href="{{asset('site/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{asset('site/lib/nivo-slider/css/nivo-slider.css')}}" rel="stylesheet">
  <link href="{{asset('site/lib/owlcarousel/owl.carousel.css')}}" rel="stylesheet">
  <link href="{{asset('site/lib/owlcarousel/owl.transitions.css')}}" rel="stylesheet">
  <link href="{{asset('site/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('site/lib/animate/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('site/lib/venobox/venobox.css')}}" rel="stylesheet">

  <!-- Nivo Slider Theme -->
  <link href="{{asset('site/css/nivo-slider-theme.css')}}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{asset('site/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('site/css/cstyle.css')}}" rel="stylesheet">

  <!-- Responsive Stylesheet File -->
  <link href="{{asset('site/css/responsive.css')}}" rel="stylesheet">

    <link href="{{asset('site/slider/thumbs2.css')}}" rel="stylesheet" /> 
     <link href="{{asset('site/slider/thumbnail-slider.css')}}" rel="stylesheet" type="text/css" />  
    
    
</head>

<body data-spy="scroll" data-target="#navbar-example">

 

  <header>
    <!-- header-area start -->
    <div id="sticker" class="header-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">

            <!-- Navigation -->
            <nav class="navbar navbar-default">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".bs-example-navbar-collapse-1" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
                <!-- Brand -->
                <a class="navbar-brand page-scroll sticky-logo" href="{{asset('home')}}">     
                  <?php $sitesettings = App\Models\Sitesetting::find('1'); 
				  //echo "<pre>";print_r($sitesettings);die;
				  ?>
				  @if(!empty($sitesettings->logo))
                   <img src="{{asset('upload/'.$sitesettings->logo)}}" style="width:140px;">  
			   @endif
								</a>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse main-menu bs-example-navbar-collapse-1" id="navbar-example">
                <ul class="nav navbar-nav navbar-right">
				
                  <li class="@if(Request::segment(1)=='home') active @endif" >
                    <a class="page-scroll" href="{{asset('home')}}">Home</a>
                  </li>
                  <li class="@if(Request::segment(1)=='about-us') active @endif">
                    <a class="page-scroll" href="{{asset('who-we-are')}}">Who We Are</a>
                  </li>
                  <li class="@if(Request::segment(1)=='services') active @endif">
                    <a class="page-scroll" href="{{asset('services')}}">Services</a>
                  </li>
                  <li class="@if(Request::segment(1)=='career') active @endif">
                    <a class="page-scroll" href="{{asset('career')}}">Career</a>
                  </li>
                  <li class="@if(Request::segment(1)=='clients') active @endif">
                    <a class="page-scroll" href="{{asset('clients')}}">Clients</a>
                  </li> 
				  
				  <li class="@if(Request::segment(1)=='how-we-work') active @endif">
                    <a class="page-scroll" href="{{asset('how-we-work')}}">How We Work</a>
                  </li>
                  <li class="dropdown" >
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Technology <i class="fa fa-caret-down"></i></a>
						<ul class="dropdown-menu">
						<?php $technology= App\Models\Technology::all() ?>
						@if(!empty($technology))
						@foreach ($technology as $page)
							<li><a href="{{url('technology/'.$page->url)}}">{{ $page->name }}</a></li>
						@endforeach
						@endif
						


						</ul>
					</li>
                  <li class="@if(Request::segment(1)=='contact-us') active @endif">
                    <a class="page-scroll" href="{{asset('contact-us')}}">Contact Us</a>
                  </li>
					 
					
                </ul>
              </div>
              <!-- navbar-collapse -->
            </nav>
            <!-- END: Navigation -->
          </div>
        </div>
      </div>
    </div>
    <!-- header-area end -->
  </header>
  <!-- header end -->
@yield('content')
  
  
  <!-- Start Footer bottom Area -->
  <footer>
    <div class="footer-area">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="footer-content">
              <div class="footer-head">
                <div class="footer-logo">
				@if(!empty($sitesettings->logo))
                   <img src="{{asset('upload/'.$sitesettings->logo)}}">  
			   @endif             
                </div>

                <p>Pradyumna Info Tech is a global information technology, consulting and outsourcing company. As one of India's top IT administrations firms, Pradyumna Info Tech IT administrations has bolster foundation spread crosswise areas in India.</p>
                <div class="footer-icons">
                  <ul>
                    <li>
                      <a href="@if(!empty($sitesettings->facebook)) {{$sitesettings->facebook}}@endif" target="_blank"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                      <a href="@if(!empty($sitesettings->twitter)) {{$sitesettings->twitter}}@endif" target="_blank"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                      <a href="@if(!empty($sitesettings->google)) {{$sitesettings->google}}@endif" target="_blank"><i class="fa fa-google"></i></a>
                    </li>
                    <li>
                      <a href="@if(!empty($sitesettings->instagram)) {{$sitesettings->instagram}}@endif" target="_blank"><i class="fa fa-pinterest"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- end single footer -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="footer-content">
              <div class="footer-head">
                <h4>information</h4>
                <p>
                  Pradyumna Info Tech is a software product and services company that focuses on driving a differentiated customer experience, accelerating cycle time and improving business outcomes through an integration of digital solutions,non-linear commercial models.
                </p>
                <div class="footer-contacts">
                  <p><span>Tel:</span> @if(!empty($sitesettings->mobile)) {{$sitesettings->mobile}}@endif</p>
                  <p><span>Email:</span> @if(!empty($sitesettings->email)) {{$sitesettings->email}}@endif</p>              
                  
                </div>
              </div>
            </div>
          </div>
          <!-- end single footer -->
         <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="footer-content">
              <div class="footer-head">
                <h4>Tools</h4>
                <div class="flicker-img">
                 <ul>
                    <li>
                     <h5> <a href="{{url('who-we-are')}}">Who We Are</a></h5>
                    </li>
                    <li>
                      <h5><a href="{{url('services')}}">Services</a></h5>
                    </li>
                     <li>
                      <h5><a href="{{url('clients')}}">Clients</a></h5>
                    </li>
                     <li>
                      <h5><a href="{{url('career')}}">Career</a></h5>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
    <!--<div class="footer-area-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="copyright text-center">
              <p>
                &copy; Copyright <strong>Pradyumna info Tech</strong>. All Rights Reserved
              </p>
            </div>
            <div class="credits">
              
            </div>
          </div>
        </div>
      </div>
    </div>-->
  </footer>

  <a href="javascript:void(0)" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="{{asset('site/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('site/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('site/lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('site/lib/venobox/venobox.min.js')}}"></script>
  <script src="{{asset('site/lib/knob/jquery.knob.js')}}"></script>
  <script src="{{asset('site/lib/wow/wow.min.js')}}"></script>
  <script src="{{asset('site/lib/parallax/parallax.js')}}"></script>
  <script src="{{asset('site/lib/easing/easing.min.js')}}"></script>
  <script src="{{asset('site/lib/nivo-slider/js/jquery.nivo.slider.js')}}" type="text/javascript"></script>
  <script src="{{asset('site/lib/appear/jquery.appear.js')}}"></script>
  <script src="{{asset('site/lib/isotope/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('site/slider/thumbnail-slider.js')}}" type="text/javascript"></script>  
 <!-- <script src="{{asset('site/slider2/thumbnail-slider.js')}}" type="text/javascript"></script>-->
  <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>-->

  <!-- Contact Form JavaScript File -->
  <script src="{{asset('site/contactform/contactform.js')}}"></script>

  <script src="{{asset('site/js/main.js')}}"></script>
</body>

</html>














