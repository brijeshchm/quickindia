<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <link href="{{asset('/public/client/images/quickind-logo-blue.png')}}" rel="icon">
  <link href="{{asset('/public/client/images/quickind-logo-blue.png')}}" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

  
  <link href="{{asset('public/official/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

 
  <link href="{{asset('public/official/lib/nivo-slider/css/nivo-slider.css')}}" rel="stylesheet">
  <link href="{{asset('public/official/lib/owlcarousel/owl.carousel.css')}}" rel="stylesheet">
  <link href="{{asset('public/official/lib/owlcarousel/owl.transitions.css')}}" rel="stylesheet">
  <link href="{{asset('public/official/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/official/lib/animate/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/official/lib/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('public/official/css/nivo-slider-theme.css')}}" rel="stylesheet">
  <link href="{{asset('public/official/css/style.css')}}" rel="stylesheet">

  <!-- Responsive Stylesheet File -->
  <link href="{{asset('public/official/css/responsive.css')}}" rel="stylesheet">

 
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
                <a class="navbar-brand page-scroll sticky-logo" href="{{url('')}}">
                  <h1><img src="{{ asset('/public/client/images/logo.png') }}" style="width: 183px;margin-top: -27px; border: none;border-radius: 50px;" ><!--<div class="logo-text">Quick India</div>--></h1>
                  <!-- Uncomment below if you prefer to use an image logo -->
                 
					</a>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse main-menu bs-example-navbar-collapse-1" id="navbar-example">
                <ul class="nav navbar-nav navbar-right">
                  <li class="<?php if(Request::segment(1) && Request::segment(1)==''){ echo "active"; } ?>">
                    <a class="page-scroll" href="{{url('/')}}">Home</a>
                  </li>
                  <li class="<?php if(Request::segment(1) && Request::segment(1)=='about-us'){ echo "active"; } ?>">
                    <a class="page-scroll" href="{{url('/about-us')}}">About us</a>
                  </li>
                  <li class="<?php if(Request::segment(1) && Request::segment(1)=='features'){ echo "active"; } ?>">
                    <a class="page-scroll" href="{{url('/features')}}">Features</a>
                  </li>
					<li class="<?php if(Request::segment(1) && Request::segment(1)=='faq'){ echo "active"; } ?>">
                    <a class="page-scroll" href="{{url('/faq')}}">FAQ's</a>
                  </li>                  
				<li class="<?php if(Request::segment(1) && Request::segment(1)=='careers'){ echo "active"; } ?>">
                    <a class="page-scroll" href="{{url('/careers')}}">Careers</a>
                  </li>                   
				  <li class="<?php if(Request::segment(1) && Request::segment(1)=='pricing'){ echo "active"; } ?>">
                    <a class="page-scroll" href="{{url('/pricing')}}">Pricing</a>
                  </li>
                  <li class="<?php if(Request::segment(1) && Request::segment(1)=='contact-us'){ echo "active"; } ?>">
                    <a class="page-scroll" href="{{url('/contact-us')}}">Contact Us</a>
                  </li>
                  
                  <li class="<?php if(Request::segment(1) && Request::segment(1)=='sitemap'){ echo "active"; } ?>">
                    <a class="page-scroll" href="{{url('/sitemap')}}">Sitemap</a>
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
   
    
  
  
  <style>

</style>
  
  <!-- Start Footer bottom Area -->
  <footer>
       <section class="address-box">
<div class="container">
<div class="col-md-12 col-sm-12 foot-new-link">         


<ul>
<li><a href="{{url('/about-us')}}" title="About Us">About Us</a></li>
<li><a href="{{url('/pricing')}}" title="pricing">Packege Pricing</a></li>
<li><a href="{{url('/careers')}}" title="Careers">Careers</a></li>


<li><a href="{{url('/contact-us')}}" title="Contact Us">Contact Us</a></li>
<li><a href="{{url('blog')}}" title="Blog">Blog</a></li> 
<li><a href="{{url('business-owners')}}" rel="nofollow" title="Advertise on Quick india">Advertise on Quick India</a></li>
<!--<li><a href="{{url('official/terms-conditions')}}" title="Terms & Conditions">Terms & Conditions</a></li>-->
<li><a href="{{url('/privacy-policy')}}" title="Privacy Policy">Privacy Policy</a></li>
<li><a href="{{url('/copyright-policy')}}" title="Copyright Policy">Copyright Policy</a></li>
</ul>





</div>


</div>
</section>
    
    <div class="footer-area-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="copyright">
              <p>
                &copy; Copyright <strong>Quick India</strong>. All Rights Reserved
              </p>
            </div>
            </div>
			  <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="credits">
            
              Developer & Designed by <a href="https://www.quickindia.com/">Quick India</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up" style="font-size: 20px;"></i></a>

  <!-- JavaScript Libraries -->
  <script src="{{asset('public/official/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('public/official/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('public/official/lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('public/official/lib/venobox/venobox.min.js')}}"></script>
  <script src="{{asset('public/official/lib/knob/jquery.knob.js')}}"></script>
  <script src="{{asset('public/official/lib/wow/wow.min.js')}}"></script>
  <script src="{{asset('public/official/lib/parallax/parallax.js')}}"></script>
  <script src="{{asset('public/official/lib/easing/easing.min.js')}}"></script>
  <script src="{{asset('public/official/lib/nivo-slider/js/jquery.nivo.slider.js')}}" type="text/javascript"></script>
  <script src="{{asset('public/official/lib/appear/jquery.appear.js')}}"></script>
  <script src="{{asset('public/official/lib/isotope/isotope.pkgd.min.js')}}"></script>
 

  <!-- Contact Form JavaScript File -->
  <script src="{{asset('public/official/contactform/contactform.js')}}"></script>

  <script src="{{asset('public/official/js/main.js')}}"></script>
</body>

</html>
