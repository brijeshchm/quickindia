<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>IT Training</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="shortcut icon" href="<?php echo asset('client/images/favicon.png'); ?>" type="image/png"/>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">
  <link href="{{asset('landing/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing/lib/nivo-slider/css/nivo-slider.css')}}" rel="stylesheet">
  <link href="{{asset('landing/lib/owlcarousel/owl.carousel.css')}}" rel="stylesheet">
  <link href="{{asset('landing/lib/owlcarousel/owl.transitions.css')}}" rel="stylesheet">
  <link href="{{asset('landing/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing/lib/animate/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing/lib/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('landing/css/nivo-slider-theme.css')}}" rel="stylesheet">
  <link href="{{asset('landing/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('landing/css/responsive.css')}}" rel="stylesheet"> 
  <link href="{{asset('landing/css/all.css')}}" rel="stylesheet"> 
  <link href="<?php echo asset('vendor/select2/css/select2.min.css'); ?>" rel="stylesheet">
<link href="<?php echo asset('vendor/select2/css/select2-bootstrap.css'); ?>" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#navbar-example">
 
  <header>

    <div id="sticker" class="header-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <nav class="navbar navbar-default"> 
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".bs-example-navbar-collapse-1" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
          
                <a class="navbar-brand page-scroll sticky-logo" href="javascript:void(0)">
                  <h1><span>Quick</span>India</h1>
				  <sub>Your Carrer path begains here</sub>
                  
								</a>
              </div>
            
              <div class="collapse navbar-collapse main-menu bs-example-navbar-collapse-1" id="navbar-example">
                <ul class="nav navbar-nav navbar-right">
                  <!--<li class="active">
                    <a class="page-scroll" href="#home">Home</a>
                  </li>-->
                
				  <li>
                    <a class="page-scroll" href="#Entrance_Exam">IT Training</a>
                  </li>
                  <li>
                    <a class="page-scroll" href="#services">Key Features</a>
                  </li>
				   
                  <li>
                    <a class="page-scroll" href="#team">Happy Faces</a>
                  </li>
				   <li>
                    <a class="page-scroll" href="#about">About</a>
                  </li>
               
                  <li>
                    <a class="page-scroll" href="#faq">FAQ's</a>
                  </li>
                  <!--   <li>
                    <a class="page-scroll" href="#contact">Contact</a>
                  </li>-->
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
   
   
  <div class="clearfix"></div>
   
<style>
sub {
    bottom: .25em;
    color: #fff;
	    font-size: 68%;
}
.searchform {
    position: absolute;
    top: 20% !important;
    left: 32% !important;
    transform: translate(-50%,-50%);
}
.ads-banner-form {
    position: absolute;
	top: 60%;
    left: 82%;
    transform: translate(-40%,-67%);
	    width: 25%;
}
.heading-txt {
    margin: 19px 0 3px !important;
    font-weight: bold;
}
.ads-banner-form input[type=text] {
    border: 0;
    background-color: #fff;
    height: 48px;
    font-size: 16px;
    font-style: italic;
	    margin-top: 3px;
}
 .select2-container--bootstrap .select2-selection.form-control {
    border-radius: 4px;
    height: 48px ! important;
}
.form-control {
    display: block;
    width: 100%;
    height: 43px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
.ads-banner-form p {  
    color: #1D4CAD;
    text-align: center;
    font-size: 21px ! important;
    font-family: Quicksand;
    padding-bottom: 0px;	 
    padding: 6px 0 6px 6px;
    border-radius: 4px;
}

.ads-banner-form h1 {
    text-align: center;
    font-size: 45px;
    color: #fff;
    font-family: 'Quicksand';
}
.landing{
	width:100%;
	float:left;	 
	background-position:center top;
	min-height:656px;
	position:relative;
	background-image: url(../landing/img/quickindia_banner.jpg);
	background-repeat: no-repeat;
	background-size: 100% 678px;
}
.landing::before{
    content: "";
    width: 100%;    
    background-color: rgba(0,0,0,0.5);
    position: absolute;
	top:0;
	left:0;
}
.course-category-box {
     
    padding: 15px;
    border-radius: 4px
}
.dotted-border {
    display: block;
    width: 100%;
    border-top: 1px dotted #333;
    margin: 20px 0;
}
.course-description{
    width: 100%;
    float: left;
    margin-top: 0;
    margin-bottom: 60px;
    position: relative;
    padding: 10px;
    margin-left: 0px;
    background-image: url(../client/images/bg-image.png);
   
    
}

.course-description-offer{
    width: 100%;
    float: left;
    margin-top: 0;
    margin-bottom: 60px;
    position: relative;
    padding: 10px;
    margin-left: 0px;   
}

.course-part{
    width: 100%;
    float: left;
    margin-top: 45px;
    margin-bottom: 60px;
    position: relative;
    padding: 0px 0px;
    margin-left: 0px;
     
     
}
.image-left{
float: left;
margin-bottom: 15px;
}
.course-part .image-content-right {    
    padding: 0px;
    margin-right: -5px; 
    margin-left: 15px;
    
}
.image-content-right p {
    color: #747474;
    line-height: 24px;
    font-family: 'Poppins',sans-serif;
    font-size: 14px;
	padding: 5px;
}
.image-content-right h3{
	padding: 5px;	
}
.inner-category-div {   
    margin: 15px 0;
    margin-right: -15px;
    min-height: 1px;
    border-radius: 4px;    
    box-shadow: 0 0 5px 0 #bbb;
}

.single-well ul li {
    color: #444;
    display: block;   
    padding: 4px 0 0 10px;
}

.features-list ul>li {
    display: inline-block;
    width: 100% !important;    
    text-align: left;
    vertical-align: top;
    transition: box-shadow .3s ease-in-out;
	margin-bottom: 10px;
}

.features-left {
    background-image: url(../client/images/bg-image.png);   
    padding: 0px;
    margin-right: -5px;
    height: 370px;
    text-align: center;
}
.features-right {
    background-image: url(../client/images/bg-image.png);   
    padding: 0px;
    margin-right: -5px;
    height: 370px;
    text-align: center;
}
.features-left h3 {
    color: #C94A30;
    font-size: 23px;
	margin-left: 0px;
}
 .features-right h3  {
    color: #C94A30;
    font-size: 23px;
	margin-left: -110px;
	
}
.course-description h1{
	margin-bottom: 25px;
}
 
 @media (min-width: 1200px)
.container-section {
    width: 99%;
}
.container-section {
    margin-right: auto;
    margin-left: auto;
    width: 99%;
}
.banner_botton_open h4 {
    width: 100%;
    text-align: center;
    font-size: 24px;
}
.searchform h1 {
    text-align: center;
    font-size: 45px;
    color: #1D4CAD;
    font-family: 'Quicksand';
	margin-top: -53px;
}


@media(max-width:767px){
	.course_mark {
    position: absolute;
    left: 50%;    
    transform: translate(-50%, -50%);
    width: 100px;
    height: 25px;
    background: #1D4CAD;
    border-radius: 3px;
    text-align: center;
    bottom: 0px;
}
	.ajax-suggest {
    position: absolute;
    top: 49px;
    left: 50px;
    width: 69%;    
    background: #FFF;
    max-height: 168px;
    overflow: auto;
    z-index: 2000;    
    border-top: none;
    display: none;
    border-radius: 4px;
}
.course-part {
    width: 100%;
    float: left;
    margin-top: 0;
    margin-bottom: 60px;
    position: relative;
    padding: 0px 0px;
    margin-left: 0px;
}
.course-part .image-content-right {
    padding: 0px;  
    margin-left: 0px !important;
}
.ads-banner-form input[type=text] {
    border: 1px solid #ccc;
    background-color: #fff;
    height: 48px;
    font-size: 16px;
    font-style: italic;
    margin-top: 3px;
}
.features-left h3 {
    color: #C94A30;
    font-size: 18px;
    margin-right: 0px; 
	 
}
.searchform h1 {
    text-align: center;
    font-size: 18px;
    color: #1D4CAD;
    font-family: 'Quicksand';
    margin-top: -108px;
}
.features-right h3 {
    color: #C94A30;
    font-size: 18px;
    margin-left: 0px;
	margin-top: 40px;
}
.course-description h3{
	font-size: 17px;
}
.landing {
    width: 100%;
    float: left;
    background-position: center top;
    min-height: 780px;
    position: relative;
    background-image: url(../landing/img/quickindia_banner.jpg);
    background-repeat: no-repeat;
    background-size: 100% 342px;
	margin-bottom: -115px;
}
.tab-menu ul.nav li {
    border: medium none;
    display: inline-block;
    width: 100%;
	margin-left: 0px;
}
.tab-menu ul.nav li a {
    padding: 9px 3px;
	background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border-radius: 20px;
    color: #444;
    display: block;
    font-weight: 500;
    margin-right: 5px;   
    font-family: raleway;
    font-size: 18px;
    margin-bottom: 10px;
    border-color: #eee;
    width: 100%;
}
.tab-menu ul.nav {
    margin: 0;
    padding: 0;
    margin-left: 0px;
}
.searchform {
    position: absolute;
    top: 20% !important;
    left: 32% !important;
    transform: translate(-32%,-50%);
}
.ads-banner-form {
    position: absolute;
    top: 52%;
    left: 76%;
    transform: translate(-78%,-24%);
    width: 95%;
}
.exam_categories_container {
    height: auto !important;
    font-family: din, "Helvetica Neue", Helvetica, Arial, sans-serif;
    cursor: pointer;
    border-top: 1px solid rgb(214, 208, 208);
    border-left: 1px solid rgb(214, 208, 208);
    border-bottom: 1px solid rgb(214, 208, 208);
    border-right: 1px solid rgb(214, 208, 208);
    overflow: hidden;
    padding: 0px;
    transition: all 0.25s ease 0s;
    width: 100%;
}
.exam_categories_container .cat_icon {
    padding-top: 0px !important;
    height: 150px !important;
}
 .categoryBlock {
    float: left;
    margin-top: 85px;
    margin-bottom: 0px;
    position: relative;
    padding: 0px 0px;
    margin-left: -6px !important;
    width: 100%;
}
.icon {
    font-size: 40px !important;
    padding-top: 0px;
    position: absolute;
    top: 15px !important;
    right: 0px !important;
	
}

.course_mark {
    position: absolute;
    left: 50%; 
    transform: translate(-50%, -50%);
    width: 100px;
    height: 25px;
    background: #1D4CAD;
    border-radius: 3px;
    text-align: center;
    bottom: -18px;
}

.single-awesome-project:hover {    
    transition: all 300ms ease;
	transform: translateY(-10px);
    box-shadow: 25px 25px 25px 25px rgba(0, 0, 0, 0.1);
	padding:15px;
}
.event-content.head-team h4 {
    background: transparent none repeat scroll 0 0;
    color: #333;
    padding: 30px 0 10px;
    font-weight: 500;
    text-transform: capitalize;
    font-size: 25px;
    font-weight: 700;
    text-align-last: initial;
}
.banner_botton_open {
    margin: 0 auto;
    width: 96% !important;
    position: absolute;
    position: fixed;
    left: 24% !important;
    top: 13% ! important;
    margin-left: -23%;
    z-index: 999;
    color: #333;
    font-size: 15px;
    line-height: 25px;
    -moz-transition: all 0.3s ease-in-out 0s;
    -webkit-transition: all 0.3s ease-in-out 0s;
    -o-transition: all 0.3s ease-in-out 0s;
    opacity: 0;
    visibility: hidden;
    padding: 8px 30px 30px 30px;
    background: #fff;
    border-radius: 6px;
}
.form-control {
    display: block;
    width: 100%;
    height: 30px ! important;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
.select2-container--bootstrap .select2-selection.form-control {
    border-radius: 4px;
    height: 30px ! important;
}
.jbtn {
    margin-left: 30% !important;
    border-radius: 3px;
    background: #ff6c00;
}
.query {
    margin-left: 30% ! important;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 0px;
    font-weight: 700;
}
.exam_categories_container .exams_list {
    background: #f8f8f8;   
    height: auto !important;
    overflow: hidden;
    position: relative;
}
.ads-banner-form p {
    color: #000;
    text-align: center;
    font-size: 21px ! important;
    font-family: Quicksand;
    padding-bottom: 0px;
    padding: 6px 0 6px 6px;
    border-radius: 4px;
}

.section-headline h2 {
    display: inline-block;
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 15px;
    position: relative;
    text-transform: capitalize;
    color: #002d58;
    margin-top: 0px;
}
}
.categoryBlock {   
    float: left;
    margin-top: 0;
    margin-bottom: 0px;
    position: relative;
    padding: 0px 0px;
    margin-left: -6px !important;
    width: 100%;
}
.quiry-buttom{
	    margin: 8px;
}
.course-category-box a{
	color: #000;
	font-size: 19px;
}
 .course-description h4{	 
	color:#fb641b; 
 }
 .course-category-box .fa{
	color:#fb641b;
}
.jbtn {
    margin-left: 40% !important;
    border-radius: 3px;
    background: #ff6c00;
}

.loginoverlay {
    width: 100%;
    height: 100%;
    z-index: 99;
    position: fixed;
    left: 0;
    top: 0;
    background: #000;
    opacity: .9;
}

.banner_botton_open {
    margin: 0 auto;
    width: 46%;
    position: absolute;
    position: fixed;
    left: 50%;
    top: 11%;
    margin-left: -23%;
    z-index: 999;
    color: #333;
    font-size: 15px;
    line-height: 25px;
    -moz-transition: all 0.3s ease-in-out 0s;
    -webkit-transition: all 0.3s ease-in-out 0s;
    -o-transition: all 0.3s ease-in-out 0s;
    opacity: 0;
    visibility: hidden;
    padding: 8px 30px 30px 30px;
    background: #fff;
    border-radius: 6px;
}
.bannerbottonshowup {
    opacity: 1;
    visibility: visible;
}
required{
	color:red;
}
 .modal {
	     top: 55px;
 }
 
 .query{
	 margin-left:30%;
	 
 }
		</style>
	 
  <div class="landing">
      <div class="searchform">
						<h1>IT Training Courses</h1>
                        <!--<p>Let's uncover the best training providers near you.</p>-->
                        
                        <div class="clearfix"></div>
						
                    </div>
					
					 <div class="ads-banner-form">
						 
                     
                      <div class="row">
                     <div class="heading-txt">
                        <p class="heading-txt-1">Tell us your need, If not now when?</p>
                    </div> 
                    <form class="formaling lead_form" action="{{url('/client/lead/add-lead')}}" role="form"  method="POST">
                       <div class="fieldblock">
                          {{ csrf_field()}}  
                            <div class="col-xs-12 val">
                                <input type="text" placeholder="Your Name *" class=" form-control city-form" name="name" >
								  
                            </div>
                        </div>
                        <div class="fieldblock">                           
                            <div class="col-xs-12 val">
                                <input type="text" placeholder="+91 *" class="form-control city-form" name="mobile" >
                            </div>
                        </div>
                   
                        <div class="fieldblock">
                            
                            <div class="col-xs-12 val">
                                <input type="text" placeholder="Enter Email" class="form-control city-form" name="email">
                            </div>
                        </div>
						<div class="fieldblock">
						<div class="col-xs-12 val">						
						<select class="dropdown-arrow dropdown-arrow-inverse home-popup-form select2-single city form-control city-form" name="city_id" >
						<option value="">Select City</option>						
						</select>	
							<div class="validation"></div>							
										
						</div>
						</div>
						<div class="fieldblock">
						<div class="col-xs-12 val">
						<input type="text" placeholder="Type Interested Course * " class="form-control city-form home-search" name="kw_text" autocomplete="off">
						<div class="ajax-suggest ajax-suggest-lead-ajax" style="display: none;"><ul></ul></div>
						  
						</div>
						</div>
                        <div class="fieldblock">                         
						<div class="col-xs-12">
						<input type="hidden" name="lead_form" value="Entrance Exam Coaching" />
						<input type="hidden" name="b_end" value="2" />
						<div class="clearfix"></div>
						<input type="submit" class="btn btn-primary submit-btn-2 query" value="Quick Query" />
						</div>
                        </div>
                    </form>
                </div>
                </div>
                
                
 
    </div>
  <!-- End Slider Area --> 
  <style>
		 .exam_categories_container {
    border-top: 1px solid #D6D0D0;
    border-left: 1px solid #D6D0D0;
    border-bottom: 1px solid #D6D0D0;
    border-right: 1px solid #D6D0D0;
    height: 330px;
    overflow: hidden;
    font-family: din,"Helvetica Neue",Helvetica,Arial,sans-serif;
    cursor: pointer;
    padding: 0;
    -webkit-transition: all .25s ease;
    -moz-transition: all .25s ease;
    -ms-transition: all .25s ease;
    -o-transition: all .25s ease;
    transition: all .25s ease;
}
 .exam_categories_container .cat_icon {
    padding-top: 30px;
    height: 330px;
}
 .exam_categories_container .exams_list {
    background: #f8f8f8;
    border-left: 0px solid #D6D0D0;
    height: 330px;
    overflow: hidden;
    position: relative;
}
 .exam_categories_container .exams_list ul {
    list-style: none;
    padding: 15px 0 0;
    max-height: 310px;
    overflow: hidden;
    margin-bottom: 5px;
}
 .exam_categories_container .exams_list ul li {
    display: block;
    font-weight: 400;
    font-size: 13px;
    line-height: 23px;
    color: #6d6d6d;
	padding-left: 22px;
}
.exam_categories_container .exams_list li {
    list-style: outside none none;
    margin: 0;
    padding: 0;
    position: relative;
    text-align: left;
}
.exams_list li a:after {
    border-bottom: 5px solid transparent;
    border-left: 7px solid #727272;
    border-top: 7px solid transparent;
    content: "";
    display: block;
    height: 0;
    left: 11px;
    position: absolute;
    top: 5px;
    width: 0;
}
.exam_categories_container .exams_list .odd  h4 {
    padding: 4px;
    color: #fb641b;
    background: #eee;
    border-radius: 4px;
}
.exam_categories_container .exams_list li .odd a {
    background: #eee;
}
 .exam_categories_container:hover .cat_icon {
    background: #ff6c00;
}
 .exam_categories_container .cat_icon {
    padding-top: 30px;
    height: 330px;
}
 .exam_categories_container:hover .cat_icon {
    background: rgb(255, 108, 0);
}
 
 .exam_categories_container {
    height: auto;
    font-family: din, "Helvetica Neue", Helvetica, Arial, sans-serif;
    cursor: pointer;
    border-top: 1px solid rgb(214, 208, 208);
    border-left: 1px solid rgb(214, 208, 208);
    border-bottom: 1px solid rgb(214, 208, 208);
    border-right: 1px solid rgb(214, 208, 208);
    overflow: hidden;
    padding: 0px;
    transition: all 0.25s ease 0s;
}
 .exam_categories_container:hover {
    transform: scale(1.05);
    z-index: 99;
    color: rgb(255, 255, 255) !important;
    border-width: initial;
    border-style: none;
    border-color: initial;
    border-image: initial;
    transition: all 0.25s ease 0s;
}

  .exam_categories_container:hover .exams_list {
    margin-left: -1px;
    border-left: none;
    background: rgb(10, 36, 53) !important;
} 

 
 .exam_categories_container {
    height: auto;
    font-family: din, "Helvetica Neue", Helvetica, Arial, sans-serif;
    cursor: pointer;
    border-top: 1px solid rgb(214, 208, 208);
    border-left: 1px solid rgb(214, 208, 208);
    border-bottom: 1px solid rgb(214, 208, 208);
    border-right: 1px solid rgb(214, 208, 208);
    overflow: hidden;
    padding: 0px;
    transition: all 0.25s ease 0s;
}
.icon {	 
    font-size: 40px;
    padding-top: 0px; 
	position: absolute;
    top: 0px;
    right: 0px;
}
}
 
 .single-awesome-project h4 {
    font-size: 18px;
    font-weight: 600;
    color: #222;
    line-height: 28px;
    padding-bottom: 30px;
    margin-bottom: 20px;
    position: relative;
}
.single-awesome-project p{
    padding: 12px 0 0 0px;
}
.exam_categories_container:hover .icon {
    color: #fff;
}
.connectedclosebtn {
    background: url(../landing/img/cls.gif) no-repeat center center;
    color: #fff;
    cursor: pointer;
    font-size: 15px;
    font-weight: 700;
    height: 29px;
    position: absolute;
    right: 10px;
    text-indent: -9999px;
    top: 10px;
    width: 29px;
}

.single-awesome-project:hover {    
    transition: all 300ms ease;
	transform: translateY(-10px);
    box-shadow: 25px 25px 25px 25px rgba(0, 0, 0, 0.1);
	padding:15px;
	border-radius: 6px;
}

.services-details:hover {    
    transition: all 300ms ease;
	transform: translateY(10px);
    box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.1);
	 
}
.team-img img{	
	    height: 272px;
		    width: 100%;
}

.course_free {
    background: #507aa3;
}

.course_mark {
    position: absolute;    
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    width: 100px;
    height: 25px;
    background: #1D4CAD;
    border-radius: 3px;
    text-align: center;
	bottom: -18px;
}

.course_mark a {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #FFFFFF;
    line-height: 25px;
}
		</style>
		
  <div id="Entrance_Exam" class="faq-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>IT Training</h2>
          </div>
        </div>
      </div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="tab-menu">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
            <!--  <li class="active">
                <a href="#engineering" role="tab" data-toggle="tab">Programming Training</a>
              </li>-->
            
			<!--<li class="active">
                <a href="#university" role="tab" data-toggle="tab">Goverment Entrance Exams</a>
              </li>
              <li>
                <a href="#medical" role="tab" data-toggle="tab">Study Abroad Entrance Exams</a>
              </li> 
			  <li>
                <a href="#LawEntrance" role="tab" data-toggle="tab">Law   Entrance  Exams</a>
              </li> 
			   <li>
                <a href="#MBAEntrance" role="tab" data-toggle="tab">UGC NET Entrance Exams</a>
              </li> -->
			<!--   <li>
                <a href="#PharmacyEntrance" role="tab" data-toggle="tab">Pharmacy Entrance</a>
              </li> -->
			  
			 
            </ul>
          </div>
		  <style>
		  </style>
          <div class="tab-content">
            <div class="tab-pane active" id="engineering">
              <div class="tab-inner">
				<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="single-awesome-project">
					<div class="awesome-img">					
					<div class="inner-box">	<div class="event-content head-team">
					<h4><a href="javascript:void(0)" class="banner_botton">Java Training</a></h4>			 
					</div><div class="icon"><i class="fab fa-java"></i></div><p>Are you looking for the best institute to excel basic and advance knowledge in JAVA, you are at the right platform. quickindia provides the best solution for all your training related queries and also help you to find the best institute for getting your training done.</p>
					<div class="course_mark course_free trans_200"><a href="javascript:void(0)" class="banner_botton">Enquiry Now</a></div>
					</div>				 
				</div>
				</div>
				</div>	
				
				<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="single-awesome-project">
					<div class="awesome-img">					
					<div class="inner-box">	<div class="event-content head-team">
					<h4><a href="javascript:void(0)" class="banner_botton">PHP Training </a></h4>			 
					</div><div class="icon"><i class="fab fa-php"></i></div><p>Are you looking for a career in web development, do you want to learn the basics involved in creating a web page, then start learning with the best institutes, we have that provide PHP training, currently it is a growing field and have a vast job opportunities for the certified candidates.</p>
					<div class="course_mark course_free trans_200"><a href="javascript:void(0)" class="banner_botton">Enquiry Now</a></div>
					</div>				 
				</div>
				</div>
				</div>		
				<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="single-awesome-project">
					<div class="awesome-img">					
					<div class="inner-box">	<div class="event-content head-team">
					<h4><a href="javascript:void(0)" class="banner_botton">Python Training</a></h4>			 
					</div><div class="icon"><i class="fab fa-python"></i></div><p>Python is the best programming language used by every industry, be it small scale or large scale due to large standard library and easy readability it helps the organization to perform fast for the best progress, don’t worry, we have all sorted for you if you are looking to grow in programming base.</p>
					<div class="course_mark course_free trans_200"><a href="javascript:void(0)" class="banner_botton">Enquiry Now</a></div>
					</div>				 
				</div>
				</div>
				</div>
				
				<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="single-awesome-project">
					<div class="awesome-img">					
					<div class="inner-box">	<div class="event-content head-team">
					<h4><a href="javascript:void(0)" class="banner_botton">Machine Learning </a></h4>			 
					</div><div class="icon"><i class="fab fa-head-side-brain"></i></div><p>Are you looking for a career in AI, then machine learning training is the best source to enter into. Machine learning is a software of AI which helps the computer software to learn automatically using the data stored in the cloud. Today it is the most fueled software and many aspirants are looking to make future in it. </p>
					<div class="course_mark course_free trans_200"><a href="javascript:void(0)" class="banner_botton">Enquiry Now</a></div>
					</div>				 
				</div>
				</div>
				</div>	
				
				<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="single-awesome-project">
					<div class="awesome-img">					
					<div class="inner-box">	<div class="event-content head-team">
					<h4><a href="javascript:void(0)" class="banner_botton">Salesforce</a></h4>			 
					</div><div class="icon"><i class="fab fa-salesforce"></i></div><p>Cloud computing is a basic necessity of every industry nowadays, Salesforce as software helps companies to specialize in CRM(Customer Relationship Management) it helps in better understanding the customer and to stay connected with them. Currently, it is the best cloud storing software and many big companies.</p>
					<div class="course_mark course_free trans_200"><a href="javascript:void(0)" class="banner_botton">Enquiry Now</a></div>
					</div>				 
				</div>
				</div>
				</div>	

				<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="single-awesome-project">
					<div class="awesome-img">					
					<div class="inner-box">	<div class="event-content head-team">
					<h4><a href="javascript:void(0)" class="banner_botton">AWS Training</a></h4>			 
					</div><div class="icon"><i class="fab fa-aws"></i></div><p>AWS is a software that helps business to grow, every industry today is looking for growth and this growth, they are finding a good employee and offering amazing package, get your training done now in Amazon web services don’t worry we have already researched and selected institutes for you according to your location.</p>
					<div class="course_mark course_free trans_200"><a href="javascript:void(0)" class="banner_botton">Enquiry Now</a></div>
					</div>				 
				</div>
				</div>
				</div>		
				<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="single-awesome-project">
					<div class="awesome-img">					
					<div class="inner-box">	<div class="event-content head-team">
					<h4><a href="javascript:void(0)" class="banner_botton">Digital Marketing</a></h4>			 
					</div><div class="icon"><i class="fas fa-search-location"></i></div><p>Digital marketing is a course that will help you to stay connected with the most regulated field. As today every business is connected with digital marketing and there is a need in every field of digital marketing. Many institutes provide a digital marketing course, let us find you the best for you to get certified according to the industrial need.</p>
					<div class="course_mark course_free trans_200"><a href="javascript:void(0)" class="banner_botton">Enquiry Now</a></div>
					</div>				 
				</div>
				</div>
				</div>		
				<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="single-awesome-project">
					<div class="awesome-img">					
					<div class="inner-box">	<div class="event-content head-team">
					<h4><a href="javascript:void(0)" class="banner_botton">Sofware Testing</a></h4>			 
					</div><div class="icon"><i class="fa fa-text-width"></i></div><p>Software testing is a process that handles and checks the quality of the developed software. The course will teach you every basic and advance process of software testing, so if you are looking for the same you are on the right path, we help aspirants to inculcate in the desired field with the placement promise.</p>
					<div class="course_mark course_free trans_200"><a href="javascript:void(0)" class="banner_botton">Enquiry Now</a></div>
					</div>				 
				</div>
				</div>
				</div>		
				<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="single-awesome-project">
					<div class="awesome-img">					
					<div class="inner-box">	<div class="event-content head-team">
					<h4><a href="javascript:void(0)" class="banner_botton">Data Science</a></h4>			 
					</div><div class="icon"><i class="fa fa-bar-chart"></i></div><p>As the industries are growing the data is also taking space in the cloud, Data science is a field that helps to analyze that data and to bring forward the insights from structured and unstructured data. Many big companies are looking for Data Scientists making an endless opportunity for the candidates.</p>
					<div class="course_mark course_free trans_200"><a href="javascript:void(0)" class="banner_botton">Enquiry Now</a></div>
					</div>				 
				</div>
				</div>
				</div>		
				<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="single-awesome-project">
					<div class="awesome-img">					
					<div class="inner-box">	<div class="event-content head-team">
					<h4><a href="javascript:void(0)" class="banner_botton">PCB DESGIN</a></h4>			 
					</div><div class="icon"><i class="fas fa-microchip"></i></div><p>As the advancement in technology is rising, making a AI and robotic world inside the human age, the study of Printed circuit board deals with the same, every electronic needs PCB to perform the process, today maximum number of PCB certified professionals are placed in the best companies.</p>
					<div class="course_mark course_free trans_200"><a href="javascript:void(0)" class="banner_botton">Enquiry Now</a></div>
					</div>				 
				</div>
				</div>
				</div>		

			 <div class="col-md-4 col-sm-4 col-xs-12">
				<div class="single-awesome-project">
					<div class="awesome-img">					
					<div class="inner-box">	<div class="event-content head-team">
					<h4><a href="javascript:void(0)" class="banner_botton">RPA Training</a></h4>			 
					</div><div class="icon"><i class="fas fa-robot"></i></div><p>Join the best Robotic Process automation course from the best institute and get the opportunity to be in a process of configuring the computer to combine the human and computer actions for better growth of the industry.</p>
					<div class="course_mark course_free trans_200"><a href="javascript:void(0)" class="banner_botton">Enquiry Now</a></div>
					</div>				 
				</div>
				</div>
				</div>		

			  <div class="col-md-4 col-sm-4 col-xs-12">
				<div class="single-awesome-project">
					<div class="awesome-img">					
					<div class="inner-box">	<div class="event-content head-team">
					<h4><a href="javascript:void(0)" class="banner_botton">SAP Training</a></h4>			 
					</div><div class="icon"><i class="fa fa-cloud"></i></div><p>SAP (system application and product in data processing one of the most rising software in the IT Industry. The number of job opportunities is already dangling in the market, catch the opportunity by joining the best institute recommended by us.</p>
					<div class="course_mark course_free trans_200"><a href="javascript:void(0)" class="banner_botton">Enquiry Now</a></div>
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
  </div>
  
  
  
   
  <!-- End About area -->

  <!-- Start Service area -->
  <div id="services" class="services-area">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline services-head text-center">
            <h2>Key Features</h2>
          </div>
        </div>
      </div>
      <div class="row text-center">
        <div class="services-contents">

          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="javascript:void(0)">
											<i class="fa fa-book"></i>
										</a>
                  <h4>Study Material</h4>
                  <p>
                    Our service provider will provide you Important Questions, solutions, Notes, MCQs, etc. to prepare your Entrance Exams.
                  </p>
                </div>
              </div>
        
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="#">
											<i class="fa fa-file-text"></i>
										</a>
                  <h4>Test Series</h4>
                  <p>
                    Institutes Conduct tests to Boost your exam preparation which helps you to score better with Testbook's Test Series.
                  </p>
                </div>
              </div>
           
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <!-- end col-md-4 -->
            <div class=" about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="javascript:void(0)">
											<i class="fa fa-video-camera"></i>
										</a>
                  <h4>Video Solutions</h4>
                  <p>
                   Our service provider will provide you video solutions to clear your doubt.
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <!-- end col-md-4 -->
            <div class=" about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="javascript:void(0)">
											<i class="fa fa-user"></i>
										</a>
                  <h4>Ask The Expert</h4>
                  <p>
                   Submit your question or Query here, and our experts will contact you about the request as soon as possible.
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
          <!-- End Left services -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <!-- end col-md-4 -->
            <div class=" about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="javascript:void(0)">
											<i class="fa fa-graduation-cap"></i>
										</a>
                  <h4>Mentorship</h4>
                  <p>
                    Our mentors will GUide You to Choose the right Carrer Opportunity for you.
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
          <!-- End Left services -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <!-- end col-md-4 -->
            <div class=" about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="javascript:void(0)">
											<i class="fa fa-phone"></i>
										</a>
                  <h4>24/7 Support</h4>
                  <p>
                  Our Expert Counseling Team will available for you to assist you 24/7.
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Service area -->

  
 
 

  <!-- Start team Area -->
  <div id="team" class="our-team-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Happy Faces  <i class="fa fa-smile-o" aria-hidden="true" style="color: #FFC300;font-size: 42px;"></i></h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="team-top">
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="single-team-member">
              <div class="team-img">
                <a href="javascript:void(0);">
					<img src="{{asset('landing/img/team/1.jpg')}}" alt="">
					</a>
					<div class="team-social-icon text-center">
			
					</div>
              </div>
              <div class="team-content text-center">
                <h4>Akash Gupta</h4>
                    <p> <img src="{{ asset('client/images/star_4.75_new.png') }}"  ></p>
              </div>
            </div>
          </div>
          <!-- End column -->
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="single-team-member">
              <div class="team-img">
                <a href="javascript:void(0);">
										<img src="{{asset('landing/img/team/2.jpg')}}" alt="" >
									</a>
                <div class="team-social-icon text-center">
           
                </div>
              </div>
              <div class="team-content text-center">
                <h4>Rakesh Chaudhary</h4>
                <p> <img src="{{ asset('client/images/star_4_new.png') }}"  ></p>
              </div>
            </div>
          </div>
          <!-- End column -->
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="single-team-member">
              <div class="team-img">
                <a href="javascript:void(0);">
										<img src="{{asset('landing/img/team/3.png')}}" alt="">
									</a>
                <div class="team-social-icon text-center">
                  
                </div>
              </div>
              <div class="team-content text-center">
                <h4>Sweta Jha</h4>
             <p> <img src="{{ asset('client/images/star_4.5_new.png') }}"  ></p>
              </div>
            </div>
          </div>
          <!-- End column -->
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="single-team-member">
              <div class="team-img">
                <a href="javascript:void(0);">
				 <img src="{{asset('landing/img/team/4.png')}}" alt="" >
									</a>
                <div class="team-social-icon text-center">
               
                </div>
              </div>
              <div class="team-content text-center">
                <h4>Ravi Kumar</h4>
               <p> <img src="{{ asset('client/images/star_5_new.png') }}"  ></p>
              </div>
            </div>
          </div>
          <!-- End column -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Team Area -->
 <!-- Start About area -->
  <div id="about" class="about-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>About quickindia</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- single-well start-->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="well-left">
            <div class="single-well">
              <a href="javascript:void(0);">
								  <img src="{{asset('landing/img/about_quickindia.jpg')}}" alt="">
								</a>
            </div>
          </div>
        </div>
        <!-- single-well end-->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="well-middle">
            <div class="single-well">          
              <p>
                quickindia.com is one of the most promising start-ups in India in 2019. Start-up offering B2C model as match-making admission solution to students and Professionals, quickindia.com is unique platform which connects education seekers with education providers with excellent career counselling.</p>
<p>
quickindia.com is an extensive search engine for the students, parents, Professionals and education industry players who are seeking information on education sector in India.One can rely on quickindia.com for getting most relevant data on Institutes, colleges and universities.
              </p>
              <ul>
                <li>
                  <i class="fa fa-check"></i> Free Demo Classes
                </li>
                <li>
                  <i class="fa fa-check"></i> Free Career counselling
                </li>
                <li>
                  <i class="fa fa-check"></i> quickindia For Institutions
                </li>                
              </ul>
            </div>
          </div>
        </div>
        <!-- End col-->
      </div>
    </div>
  </div>
 
  <!-- Faq area start -->
  <div id="faq" class="faq-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Faq Question</h2>
          </div>
        </div>
      </div>
      <div class="row">
	  
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="faq-details">
            <div class="panel-group" id="accordion">
             
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" class="active" data-parent="#accordion" href="#check1">
                                                <span class="acc-icons"></span> What is quickindia?
											</a>
										</h4>
                </div>
                <div id="check1" class="panel-collapse collapse in">
                  <div class="panel-body">
                    <p>
                      quickindia is an extensive search engine for the students, parents, and Professionals, quickindia Only Deals In Education Sector, and helps students to grab their right opportunity.
                    </p>
                  </div>
                </div>
              </div>
            
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#check2">
                                                <span class="acc-icons"></span>Why choose quickindia?
											</a>
										</h4>
                </div>
                <div id="check2" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
                      quickindia is an extensive search engine for the students, parents, and Professionals, here you can find Best Certified Entrance Exams Coaching institutes and compare which institutes are best for you, and which institutes are fulfilling your all requirements.
                    </p>
                  </div>
                </div>
              </div>
               
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#check3">
                                                <span class="acc-icons"></span>How can I register for the exam?
											</a>
										</h4>
                </div>
                <div id="check3" class="panel-collapse collapse ">
                  <div class="panel-body">
                    <p>
                      Go to the Visit official and Complete the registration process by submitting documents and mentioning all your valid information.
                    </p>  

					<p>
                      Pay the application fee Once, registered, you will get notifications for the exam along with all the essential details on the registered number and email id, or Our.
                    </p>
                  </div>
                </div>
              </div>
             
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#check4">
                                                <span class="acc-icons"></span>What Are The Course Duration?
											</a>
										</h4>
                </div>
                <div id="check4" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
                     The duration of Entrance Exams Coaching is approximately 3 Months. However, it is flexible and depending upon the kind of Coaching program you choose, i.e. We provide regular batch, as well as weekend batch and also fast-track batches.
                    </p>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div><div class="col-md-6 col-sm-6 col-xs-12">
          <div class="faq-details">
            <div class="panel-group" id="accordions">
             
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" class="" data-parent="#accordions" href="#check5">
                                                <span class="acc-icons"></span>How do I track my progress?
											</a>
										</h4>
                </div>
                <div id="check5" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
                   All coaching centers conduct tests and give assignments to track the progress of students and to find their strengths and weaknesses with regard to the exam syllabus.
                    </p>
                  </div>
                </div>
              </div>
               
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordions" href="#check6">
                                                <span class="acc-icons"></span> Do these tutorials provide study material?
											</a>
										</h4>
                </div>
                <div id="check6" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
                     Yes, they do. 
                    </p>
                  </div>
                </div>
              </div>
              
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordions" href="#check7">
                                                <span class="acc-icons"></span>What Happen If I miss A class?
											</a>
										</h4>
                </div>
                <div id="check7" class="panel-collapse collapse ">
                  <div class="panel-body">
                    <p>
                      In case you miss your classes due to some unavoidable situations, you need not worry quickindia assures that you are able to make up for the loss and we may get you arranged separate class in the extra time for those topics else you may attend the same in other batches as well.
                    </p>
                  </div>
                </div>
              </div>
              
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordions" href="#check8">
                                                <span class="acc-icons"></span>I Need More info?
											</a>
										</h4>
                </div>
                <div id="check8" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
                    For More Info & any Queries, you can Contact Us on 9876543210 or reach out to us via e-mail @ Info@quickindia.com, or drop a quick Enquiry Our Expert counseling team Will Contact you Soon.
                    </p>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
		
		
        
      </div>
      <!-- end Row -->
    </div>
  </div>
  <!-- End Faq Area -->

  <!-- End reviews Area -->

    <!-- Start Testimonials -->
  <div class="testimonials-area">
    <div class="testi-inner area-padding">
      <div class="testi-overly"></div>
      <div class="container ">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <!-- Start testimonials Start -->
            <div class="testimonial-content text-center">
              <a class="quate" href="#"><i class="fa fa-quote-right"></i></a>
              <!-- start testimonial carousel -->
              <div class="testimonial-carousel">
                <div class="single-testi">
                  <div class="testi-text">
                    <p>
                      It was a dream come true when I ranked 4 in CLAT. I get admission Through quickindia, They provide me best institutes, They have very good teachers Faculty. We had doubt classes, practice sessions and revision classes to ensure that we engross all the topics completely. Overall quickindia is the excellent service provider to recommend others
                    </p>
                    <h6>Akash Gupta</h6>
                  </div>
                </div>
                <!-- End single item -->
                <div class="single-testi">
                  <div class="testi-text">
                    <p>
                      I had a wonderful experience at quickindia. I get best institute and All teachers and staff provided me an extremely friendly environment and gave me all the precious knowledge and information required to clear the examination. And with their precious help I managed to clear all my examinations with a very good score. Thanks quickindia for shaping my career and giving me the right guidance.
                    </p>
                    <h6>Rajesh Chaudhary</h6>
                  </div>
                </div>
                <!-- End single item -->
                <div class="single-testi">
                  <div class="testi-text">
                    <p>
                      I chose to get admission through quickindia, I got admission in the best IAS Academy and all my classes’ selection activity ended at a beautiful destination. Regular practical knowledge disburses by renowned experienced professors helped me scale up my understanding of the subjects. The personal attention of professors not only refurbished my knowledge structure but also deepen the foundation. Experience of this Service provided by quickindia was beyond my expectations.
                    </p>
                    <h6>Sweta Jha</h6>
                  </div>
                </div>
				
				<div class="single-testi">
                  <div class="testi-text">
                    <p>
                      The whole faculty & staff members make the IIT JEE preparation a fun-oriented & self- introspecting journey. The study materials and nurturing with the friendly atmosphere helps a lot for the aspirants like me in this arduous path. Thanks a lot to quickindia Team for guiding me and provide me the best institute.
                    </p>
                    <h6>Ravi Kumar</h6>
                  </div>
                </div>
                <!-- End single item -->
              </div>
            </div>
            <!-- End testimonials end -->
          </div>
          <!-- End Right Feature -->
        </div>
      </div>
    </div>
  </div>
   <div class="course-part">   
            <div class="image-content-right">                
                <div class="content-right">
             <div class="col-xs-12 col-sm-12 col-md-12 form-proceed spacer">
                <div class="col-xs-12 col-sm-6 col-md-6 border-line formleftBlock">
				
				 <div class="heading-txt">Why Fill This Form?</div>
                    <ul class="whyChoose">
                        <li><span><img src="<?php echo asset('client/images/icon-1.png'); ?>"></span>Thousands of students fill this form to get best deals for the preparation of entrance exams.</li>
                        <li><span><img src="<?php echo asset('client/images/icon-2.png'); ?>"></span>Only certified Institutes will contact you with best deals with Full details.</li>
                        <li><span><img src="<?php echo asset('client/images/icon-3.png'); ?>"></span>We Tried to fulfilled your requirements as soon as possible.</li>
                        <li><span><img src="<?php echo asset('client/images/icon-1.png'); ?>"></span>G-21, Third Floor, Sector-3, Noida, 201301, Email:- info@quickindia, Phone:-7011310265, Website:- www.quickindia.com</li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 formrightBlock">
                   
                    <div class="heading-txt">
                         Tell us your need, we will connect you with service experts  
                    </div>
                    <form class="formaling lead_form" action="{{url('/client/lead/add-lead')}}" method="POST">
					  {{ csrf_field()}}  
					    <div class="fieldblock">
                            <div class="col-xs-3 col-sm-3 col-md-3">Name<required>*</required></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" placeholder="Your Name" class=" form-control city-form" name="name">
					 
                            </div>
                        </div>
					   <div class="fieldblock">
                            <div class="col-xs-3 col-sm-3 col-md-3">Mobile<required>*</required></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" placeholder="+91" class="form-control city-form" name="mobile">
					 
                            </div>
                        </div>                   
                        <div class="fieldblock">
                            <div class="col-xs-3 col-sm-3 col-md-3">Email<required></required></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" placeholder="Email" class="form-control city-form" name="email" >
					 
                            </div>
                        </div>
                        <div class="fieldblock">
                            <div class="col-xs-3 col-sm-3 col-md-3">City<required>*</required></div>
                            <div class="col-xs-8 col-sm-8 col-md-8" id="select-city-proceed">
								<input type="hidden" name="lead_form" value="Entrance Exam Coaching" />
								<input type="hidden" name="b_end" value="2" />
                                <select class="dropdown-arrow dropdown-arrow-inverse city-form select2-single city form-control" name="city_id">		 
									<option value="">Select City</option>
									@if(count($cities)>0)
										@foreach($cities as $city)
											<option value="{{strtolower($city->city)}}">{{$city->city}}</option>
										@endforeach
									@endif
								</select>
                            </div>
                        </div>
                        <div class="fieldblock">
                            <div class="col-xs-3 col-sm-3 col-md-3">Interested in<required>*</required></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" placeholder="type text" class="form-control city-form home-search" name="kw_text" autocomplete="off">
								<div class="ajax-suggest ajax-suggest-lead-ajax" style="display: none;"><ul></ul></div>
                            </div>
                        </div>
                     
                        <div class="fieldblock">
                            <div class="col-xs-4 col-sm-4 col-md-4"></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                 <div class="clearfix"></div>                           
								<input type="submit" class="btn btn-primary submit-btn-2 query" value="Get Quotes" />
                                 </div>
                        </div>
                    </form>
                </div>
            </div> </div>
            </div>
         
           </div>	
 	
  
  <div class="banner_botton_open">
	
        <a href="javascript:void(0);" class="connectedclosebtn">&nbsp;</a>
		 <h4>Need Expert Advice ?</h4>
        <div class="jbt"> Fill this form to Grab the best Deals on <span class="orng">quickindia</span></div>
        <div class="popup">
            <form class="lead_form_popup" action="{{url('/client/lead/add-lead')}}" method="POST">
                <aside>	              
						 
						<label>Your name<required>*</required></label>
						<div class="popup-form">
							{{ csrf_field()}}  
                        <input class="form-control home-popup-form" type="text" placeholder="Enter Full Name" name="name" value="">						 	
						</div>
                    
						<label>Your Mobile<required>*</required></label>
						<div class="popup-form">
                        <input class="form-control home-popup-form" type="text" placeholder="Enter Mobile" name="mobile" value="" >
						</div>                     
					 
                        <label>Your Email ID<required></required></label>
						<div class="popup-form">
                       <input class="form-control home-popup-form" type="email" placeholder="Enter Email" name="email" value="" >
						</div>				 
				  
					<label>City<required>*</required></label>
					<div class="popup-form" id="select-city-proceed">						
						<select class="dropdown-arrow dropdown-arrow-inverse home-popup-form select2-single city form-control" name="city_id">
							<option value="">Select City</option>							 
						</select>					 
					</div>                   
					 
					<label>Interested in<required>*</required></label>
					<div class="popup-form">
						<input type="text" placeholder="Type Interested Course * " class="form-control city-form home-search" name="kw_text" autocomplete="off"> 					 
						<div class="ajax-suggest ajax-suggest-lead-ajax" style="display: none;"><ul></ul></div>
					</div>
                         
                    <p>
                        <label class="moblab">&nbsp;</label>
						<input class="jbtn text-align" type="submit" value="Submit" />
						<input type="reset" class="reset_lead_form hide" value="reset" />
                        
                    </p>
                </aside>
            </form>
        </div>    
    </div>

  <style>
  .whyChoose {
    padding: 0;
    margin: 0;
    list-style-type: none;
}
.whyChoose li {
    font-size: 17px;
    color: #333;
    position: relative;
    padding-left: 61px;
    margin-bottom: 15px;
    line-height: 23px;
    border-bottom: 2px solid #eee;
    padding-bottom: 15px;
}
.whyChoose li span {
    position: absolute;
    left: 0;
    top: 0;
    background: #fb641b;
    border-radius: 4px;
    width: 45px;
    border: 1px solid #ef601a;
}
  </style>
  <div class="modal fade" id="msgModal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!--div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div-->
            <div class="modal-body">
            </div>
            <div class="modal-footer" style="text-align:center">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
  <div class="modal fade" id="msgModalpop" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
           
            <div class="modal-body">
            </div>
            <div class="modal-footer" style="text-align:center">
                <button type="button" class="btn btn-default closepop" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
  <!-- End Testimonials -->
  
   <!-- End Contact Area -->

  <!-- Start Footer bottom Area -->
  <footer>
    <div class="footer-area-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="copyright text-center">
              <p>
                &copy; Copyright <strong>Quickindia</strong>. All Rights Reserved
              </p>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </footer>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="{{asset('landing/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('landing/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('landing/lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('landing/lib/venobox/venobox.min.js')}}"></script>
  <script src="{{asset('landing/lib/knob/jquery.knob.js')}}"></script>
  <script src="{{asset('landing/lib/wow/wow.min.js')}}"></script>
  <script src="{{asset('landing/lib/parallax/parallax.js')}}"></script>
  <script src="{{asset('landing/lib/easing/easing.min.js')}}"></script>
  <script src="{{asset('landing/lib/nivo-slider/js/jquery.nivo.slider.js')}}" type="text/javascript"></script>
  <script src="{{asset('landing/lib/appear/jquery.appear.js')}}"></script>
  <script src="{{asset('landing/lib/isotope/isotope.pkgd.min.js')}}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>

  <!-- Contact Form JavaScript File -->
  <script src="{{asset('landing/contactform/contactform.js')}}"></script>

  <script src="{{asset('landing/js/main.js')}}"></script>
  <script src="<?php echo asset('vendor/select2/js/select2.full.js'); ?>"></script> 
  <script>
  $('.banner_botton').click(function(e) {          
            $('<div class="loginoverlay"></div>').insertBefore('.banner_botton_open');
            $('.banner_botton_open').addClass('bannerbottonshowup');
			$(".sub-header").css("visibility", "hidden");   
        });
			
		$('.connectedclosebtn').click(function(e) {
            $('.connectedpopup').removeClass('connectedshowup');
            $('.banner_botton_open').removeClass('bannerbottonshowup');
			$(".sub-header").css("visibility", "visible");
            $('.loginoverlay').fadeOut();
        });
		
  </script>
 
</body>

</html>
