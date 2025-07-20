@extends('client.layouts.app')
@section('title')
Quickindia | Your Career Path Begins Here
@endsection 
@section('keyword')
Find Best It Training Centre near You, Find Best It Training Institute near You, Find Top 10 IT Training Institute near You, Find Best Entrance Exam Preparation Centre Near you, Top 10 Entrance Exam Centre Near you, Find Best Distance Education Centre Near You, Find Top 10 Distance Education Centre Near You, Find Best School And Colleges Near You, Find Top 10 school And College Near You, Get Education Loan, GET Free career Counselling, Find Best overseas education consultants Near you, Find Top 10 overseas education consultants Near you

@endsection
@section('description')
Find Only Certified Training Institutes, Coaching Centers near you on Quickindia and Get Free counseling, Free Demo Classes, and Get Placement Assistence.
@endsection
@section('content')	

    <div class="landing">
      <div class="searchform">
						<h1>Entrance Exam Coaching</h1>
                        <!--<p>Let's uncover the best training providers near you.</p>-->
                        
                        <div class="clearfix"></div>
						
                    </div>
					
					 <div class="ads-banner-form">
						 
                     
                      <div class="row">
                     <div class="heading-txt">
                        <p class="heading-txt-1">Tell us your need, If not now when?</p>
                    </div> 
                    <form class="formaling lead_form" action="{{url('/client/lead/add-lead')}}" method="POST">
                        <div class="fieldblock">
                           
                            <div class="col-xs-12" id="select-city-proceed">
								<input type="hidden" name="lead_form" value="Entrance Exam Coaching" />
								<input type="hidden" name="b_end" value="2" />
                                <select class="dropdown-arrow dropdown-arrow-inverse city-form select2-single city" name="city_id">
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
                            
                            <div class="col-xs-12">
                                <input type="text" placeholder="Type Interested in * " class="form-control city-form home-search" name="kw_text" autocomplete="off">
								<div class="ajax-suggest ajax-suggest-lead-ajax" style="display: none;"><ul></ul></div>
                            </div>
                        </div>
                        <div class="fieldblock">
                           
                            <div class="col-xs-12">
                                <input type="text" placeholder="+91 *" class="form-control city-form" name="mobile">
                            </div>
                        </div>
                        <div class="fieldblock">
                           
                            <div class="col-xs-12">
                                <input type="text" placeholder="Your Name *" class=" form-control city-form" name="name">
                            </div>
                        </div>
                        <div class="fieldblock">
                            
                            <div class="col-xs-12">
                                <input type="text" placeholder="Enter Email" class="form-control city-form" name="email">
                            </div>
                        </div>
                        <div class="fieldblock">
                          
                            <div class="col-xs-12">
                                 
                                <div class="clearfix"></div>
                                <!--button type="button" class="btn btn-primary submit-btn-2">Get Quotes</button-->
								<input type="submit" class="btn btn-primary submit-btn-2" value="Quick Query" />
                                </div>
                        </div>
                    </form>
                </div>
                </div>
                
                
 
    </div>


    <div class="clearfix"></div>
   
<style>

.searchform {
    position: absolute;
    top: 20% !important;
    left: 32% !important;
    transform: translate(-50%,-50%);
}
.ads-banner-form {
    position: absolute;
	top: 68%;
    left: 68%;
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
}
.ads-banner-form p {  
    color: cornsilk;
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
	min-height:500px;
	position:relative;
	background-image: url(../landingimage/temporory-entrance-exam.jpg);
	background-repeat: no-repeat;
	background-size: 100% 500px;
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
    margin-top: 0;
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
    margin-left: 460px;
    
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
    color: #fff;
    font-family: 'Quicksand';
	margin-top: -53px;
}


@media(max-width:767px){
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

.features-left h3 {
    color: #C94A30;
    font-size: 18px;
    margin-right: 0px; 
	 
}
.searchform h1 {
    text-align: center;
    font-size: 18px;
    color: #fff;
    font-family: 'Quicksand';
    margin-top: -120px;
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
    min-height: 760px;
    position: relative;
    background-image: url(../landingimage/temporory-entrance-exam.jpg);
    background-repeat: no-repeat;
    background-size: 100% 295px;
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
    left: 68%;
    transform: translate(-78%,-24%);
    width: 66%;
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
    font-size: 75px;
    padding-top: 15px !important;
}
.exam_categories_container .exams_list {
    background: #f8f8f8;
    border-left: 0px solid #D6D0D0;
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
    margin-left: 150px !important;
    border-radius: 3px;
    background: #ff6c00;
}
		</style>
	 

		
		   
		   
 <div class="container-section"> 
  
<div class="clearfix"></div>
        		
		
		<div class="testimonials"> 
 
		 
             
            <div class="tab-content" >
               
	 
			   
				
		<div class="review-list">
			  <div class="categoryBlock">
	 
	  
								
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="javascript:void(0)" class="banner_botton"><i class="fa fa-fw fa-graduation-cap" aria-hidden="true"></i>Engineering</a>				 
					 
				</div>
				</div></div>
						
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="javascript:void(0)" class="banner_botton"><i class="fa fa-fw fa-ticket" aria-hidden="true"></i>Neet Entrance</a>				 
					 
				</div>
				</div></div>
						
				<div class="col-md-2">
				<div class="inner-category-div">		 
				<div class="course-category-box">
					<a href="javascript:void(0)" class="banner_botton"><i class="fa fa-fw fa-balance-scale" aria-hidden="true"></i>DU LLB Coaching</a>				 
					 
				</div>
				</div></div>	
					
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="javascript:void(0)" class="banner_botton"><i class="fa fa-fw fa-search" aria-hidden="true"></i>JIPMER Entrance</a>				 
					 
				</div>
				</div></div>	
					
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="javascript:void(0)" class="banner_botton"><i class="fa fa-fw fa-hospital-o" aria-hidden="true"></i>AIIMS Entrance</a>				 
					 
				</div>
				</div></div>
									
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="javascript:void(0)" class="banner_botton"><i class="fa fa-fw fa fa-gavel" aria-hidden="true"></i>GATE Entrance</a>				 
					 
				</div>
				</div></div>
									
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="javascript:void(0)" class="banner_botton"><i class="fa fa-fw fa-street-view" aria-hidden="true"></i>SSC Entrance</a>				 
					 
				</div>
				</div></div>
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="javascript:void(0)" class="banner_botton"><i class="fa fa-fw fa-desktop" aria-hidden="true"></i>PCS Entrance</a>				 
					 
				</div>
				</div></div>

				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="javascript:void(0)" class="banner_botton"><i class="fa fa-fw fa-ticket" aria-hidden="true"></i>IAS Entrance</a>				 
					 
				</div>
				</div></div>	
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="javascript:void(0)" class="banner_botton"><i class="fa fa-fw fa-globe" aria-hidden="true"></i>IIT JEE Entrance</a>				 
					 
				</div>
				</div></div>
				  	 
					
            
        </div>
			
			
			
			</div>
 
                   

                </div>

 

                 

            </div>
             
		<div class="clearfix"></div>	
 
      <!--<div class="course-part">   
            
      <div class="image-left">
		<img src="{{asset('landingimage/entrance-image-Quickindia.jpg')}}" width="100%" title="Entrance Exam Coaching" alt="Entrance Exam Coaching">
            </div>
            
       
            <div class="image-content-right">                
                <div class="content-right">
             <div class="col-xs-12 col-sm-12 col-md-12 form-proceed spacer">
                <div class="col-xs-12 col-sm-7 col-md-7 border-line formleftBlock">
                    <div class="heading-txt">
                        <p class="heading-txt-1">Tell us your need, we will connect you with service experts </p>
                    </div>
                    <form class="formaling lead_form" action="{{url('/client/lead/add-lead')}}" method="POST">
                        <div class="fieldblock">
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">City*</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8" id="select-city-proceed">
								<input type="hidden" name="lead_form" value="Entrance Exam Coaching" />
								<input type="hidden" name="b_end" value="2" />
                                <select class="dropdown-arrow dropdown-arrow-inverse city-form select2-single city" name="city_id">
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
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Interested in</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" placeholder="type text" class="form-control city-form home-search" name="kw_text" autocomplete="off">
								<div class="ajax-suggest ajax-suggest-lead-ajax" style="display: none;"><ul></ul></div>
                            </div>
                        </div>
                        <div class="fieldblock">
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Mobile*</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" placeholder="+91" class="form-control city-form" name="mobile">
                            </div>
                        </div>
                        <div class="fieldblock">
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Your Name*</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" placeholder="Your Name" class=" form-control city-form" name="name">
                            </div>
                        </div>
                        <div class="fieldblock">
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Email</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" placeholder="Email" class="form-control city-form" name="email">
                            </div>
                        </div>
                        <div class="fieldblock">
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Tell us more</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <textarea class="form-control city-form" id="exampleTextarea" rows="3" placeholder="Provide any specific details for your need" name="remark"></textarea>
                                <div class="clearfix"></div>
                           
								<input type="submit" class="btn btn-primary submit-btn-2" value="Get Quotes" />
                                <a href="https://quickindia.in/privacy-policy" target="_blank" class="pull-right trmcondition">T&C Apply</a> </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-5 formrightBlock">
                    <div class="heading-txt-2"><span>Why Fill This Form?</span></div>
                    <ul class="whyChoose">
                        <li><span><img src="<?php echo asset('client/images/icon-1.png'); ?>"></span>Thousands of customers fill this for to get best deals from education institutes.</li>
                        <li><span><img src="<?php echo asset('client/images/icon-2.png'); ?>"></span>1000+ Institutes contact our customers with best deals after getting details from this form.</li>
                        <li><span><img src="<?php echo asset('client/images/icon-3.png'); ?>"></span>Customer’s requirement gets fulfilled with best offers instantly.</li>
                    </ul>
                </div>
            </div> </div>
            </div>
         
           </div>	-->	
		<div class="course-description">  
		<h1>Entrance Exam Coaching</h1>
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
    height: 330px;
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
    height: 330px;
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
    font-size: 75px;
    padding-top: 65px; 
}
 
.exam_categories_container:hover .icon {
    color: #fff;
}


		</style>
		<div class="col-sm-6 col-xs-6 exam_categories_container" >		
		<div class="exam_categories_wrap">
		<div class="cat_icon col-sm-4 col-xs-12 text-center">
			<i class="fa fa-graduation-cap icon" aria-hidden="true"></i> 
		 
		<h3><a href="javascript:void(0);">ENGINEERING</a></h3></div>
		<div class="exams_list col-sm-8 col-xs-12">
		<ul>
		<li><a href="javascript:void();" class="banner_botton"><h4> JEE 2020 </h4> </a></li>
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4> IIT JAM 2020</h4> </a></li>
		<li><a href="javascript:void(0);" class="banner_botton"><h4> GATE 2020 </h4></a></li>
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4> UPSEE 2020</h4> </a></li>
		<li><a href="javascript:void(0);" class="banner_botton"><h4> BCECE 2020 </h4></a></li>
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4> Assam CEE 2020 </h4> </a></li>
		<li><a href="javascript:void(0);" class="banner_botton"><h4> KEAM 2020 </h4> </a></li>
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4> WBJEE 2020 </h4> </a></li>
		<li><a href="javascript:void(0);" class="banner_botton"><h4> COMEDK UGET 2020 </h4> </a></li>
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4> TS EAMCET 2020 </h4> </a></li>
		</ul> 
	 
		
		</div>
		</div>
		</div>
		<div class="col-sm-6 col-xs-6 exam_categories_container" >		
		<div class="exam_categories_wrap">
		<div class="cat_icon col-sm-4 col-xs-12 text-center banner_botton">
			<i class="fa fa-fw fa-university icon" aria-hidden="true"></i> 
		 
		<h3><a href="javascript:void(0);">University Level Entrance Exams</a></h3></div>
		<div class="exams_list col-sm-8">
		<ul><li><a href="javascript:void();" class="banner_botton"><h4> BITSAT 2020</h4> </a></li>
		<li class="odd"><a href="javascript:void(0);" class="banner_botton" ><h4> UPESEAT 2020</h4> </a></li>
		<li><a href="javascript:void(0);" class="banner_botton"><h4> VITEEE 2020</h4></a></li>
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4> PTU Admission 2020</h4> </a></li>
		<li><a href="javascript:void(0);" class="banner_botton"><h4> Delhi University 2020 </h4></a></li>
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4> JNU Admission 2020 </h4> </a></li>
		<li><a href="javascript:void(0);" class="banner_botton"><h4> Lucknow University 2020 </h4> </a></li>
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4> BHU 2020 </h4> </a></li>
		<li><a href="javascript:void(0);" class="banner_botton"><h4> Allahabad University 2020 </h4> </a></li>
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4>   </h4> </a></li>
		</ul> 
	 
		
		</div>
		</div>
		</div>
		<div class="col-sm-6 col-xs-6 exam_categories_container" >		
		<div class="exam_categories_wrap">
		<div class="cat_icon col-sm-4 col-xs-12 text-center banner_botton">
			<i class="fa fa-fw fa-plus-square icon" aria-hidden="true"></i> 
		 
		<h3><a href="javascript:void(0);">Medical Entrance Exams</a></h3></div>
		<div class="exams_list col-sm-8">
		<ul><li><a href="javascript:void();" class="banner_botton"><h4> NEET 2020</h4> </a></li>
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4> AIIMS 2020</h4> </a></li>
		<li><a href="javascript:void(0);" class="banner_botton"><h4> JIPMER 2020</h4></a></li>		 
 
		</ul> 
	 
		
		</div>
		</div>
		</div>
		<div class="col-sm-6 col-xs-6 exam_categories_container" >		
		<div class="exam_categories_wrap">
		<div class="cat_icon col-sm-4 col-xs-12 text-center banner_botton">
			<i class="fa fa-fw fa-universal-access icon" aria-hidden="true"></i> 
		 
		<h3><a href="javascript:void(0);">MBA Entrance Exams</a></h3></div>
		<div class="exams_list col-sm-8">
		<ul><li><a href="javascript:void();" class="banner_botton"><h4>CAT 2020</h4> </a></li>
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4>MAT 2020</h4> </a></li>
		<li><a href="javascript:void(0);" class="banner_botton"><h4>XAT 2020</h4></a></li>		 
 
		</ul> 
	 
		
		</div>
		</div>
		</div>
		<div class="col-sm-6 col-xs-6 exam_categories_container" >		
		<div class="exam_categories_wrap">
		<div class="cat_icon col-sm-4 col-xs-12 text-center banner_botton">
			<i class="fa fa-fw fa-balance-scale icon" aria-hidden="true"></i> 
		 
		<h3><a href="javascript:void(0);" class="banner_botton">Law Entrance Exams</a></h3></div>
		<div class="exams_list col-sm-8">
		<ul><li><a href="javascript:void();" class="banner_botton"><h4>CLAT 2020</h4> </a></li>
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4>AILET 2020</h4> </a></li>
		<li><a href="javascript:void(0);" class="banner_botton"><h4>LSAT 2020</h4></a></li>		 
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4>DU LLB 2020</h4></a></li>		 
 
		</ul> 
	 
		
		</div>
		</div>
		</div>	

		<div class="col-sm-6 col-xs-6 exam_categories_container" >		
		<div class="exam_categories_wrap">
		<div class="cat_icon col-sm-4 col-xs-12 text-center banner_botton">
			<i class="fa fa-fw fa-hotel icon" aria-hidden="true"></i> 		 
		<h3><a href="javascript:void(0);" class="banner_botton">Pharmacy Entrance Exams</a></h3></div>
		<div class="exams_list col-sm-8">
		<ul>
		<li><a href="javascript:void();" class="banner_botton"><h4>CLAT 2020</h4> </a></li>
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4>AILET 2020</h4> </a></li>
		<li ><a href="javascript:void(0);" class="banner_botton"><h4>LSAT 2020</h4></a></li>		 
		<li class="odd"><a href="javascript:void(0);" class="banner_botton"><h4>DU LLB 2020</h4></a></li>		 
 
		</ul> 		
		</div>
		</div>
		</div>
		
		 
	
		<!--
		<div class="col-md-6">
		<h3><i class="fa fa-fw fa-graduation-cap" aria-hidden="true"></i><a href="javascript:void(0)" class="banner_botton">Engineering Entrance Exams</a></h3>	<span class="dotted-border"></span>
		<h4>JEE Main 2020</h4>

		<p>JEE Main examinations is conducted by the NTA (National Testing Agency). Through this examination, students are eligible to get admission to the B.Tech & B.Arch courses. This exam is organized twice every year in national level. On the basis of JEE Main score, students can get to the various NITs, CFTIs, IITs and other institutions of India.</p> 
		<h4>GATE 2020</h4>
		<p>GATE (Graduate Aptitude Test in Engineering) is a national level examination. This exam is organized for admission to the masters & doctoral degree courses in engineering, technology, architecture & science. It is conducted jointly by the Indian Institute of Science (IISc) & the seven Indian Institutes of Technology (IITs).</p>	
		<h4>IIT JAM 2020</h4>
		<p>IIT JAM examination is organized by the Indian Institutes of Technology (IITs) on a rotation basis. It is a national level entrance test. Through this exam, candidates can get admission to the 2 years M.Sc, Joint M.Sc – Ph.D, M.Sc – Ph.D. dual degree & other post-bachelor degree courses.</p>
		<h4>UPSEE 2020</h4>
		<p>UPSEE examination is conducted to get admission to the 1st year of engineering, pharmacy, architecture, management, etc courses. Through this exam, candidates can also get admission to the 2nd year of engineering, pharmacy & computer application. It is managed by the Dr. APJ Abdul Kalam Technical University (AKTU), Uttar Pradesh.</p>	
		<h4>BCECE 2020</h4>
		<p>BCECE (Bihar Combined Entrance Competitive Examination) is regulated by the BCECEB board. BCECE examination is not conducted for engineering & medical courses. Admissions will be done through JEE Main & NEET UG examinations. However, BCECE entrance exam is conducted for agriculture and pharmacy admission.</p>	 
		 
		<h4>Assam CEE 2020</h4>
		<p>Assam CEE is a state level examination. It is conducted by the Assam Science & Technology University (ASTU). Students can get admission to the various engineering courses in Assam state on the basis of this exam score. Assam CEE (Assam Common Entrance Exam) is organized one time in a year.</p>	
		<h4>KEAM 2020</h4>
		<p>KEAM exam is conducted for those candidates, who seek admission to the engineering courses in Kerala state. It is managed by the Commissioner of Entrance Examination (CEE), Kerala. This exam is a state level entrance test. The authority also release application for medical & architecture courses.</p>
		<h4>WBJEE 2020</h4>
		<p>WBJEE (West Bengal Joint Entrance Examination) is organized by the West Bengal Joint Entrance Examination Board (WBJEEB). This exam is a state level entrance test. It is conducted for admission to the various UG courses in the area of engineering, pharmacy, technology & architecture.</p>
		<h4>COMEDK UGET 2020</h4>
		<p>COMEDK UGET examination is conducted by the COMEDK (Consortium of Medical, Engineering and Dental of Karnataka). It is organized for candidates, those seeking admission to the engineering courses in Karnataka state. This exam is a state level examination. The authority also invites application for architecture courses on the basis of NATA score.</p>
		<h4>TS EAMCET 2020</h4>
		<p>TS EAMCET examination is organized for providing admission to the engineering, pharmacy & agriculture courses in Telangana state. It is a state level admission test. This test is managed by the Jawaharlal Nehru Technological University (JNTU), Hyderabad.</p>
		<h4>CUCET 2020</h4>
		<p>CUCET (Central Universities Common Entrance Test) is a national level examination. This exam is organized by the 11 central universities of India on a rotation basis. Through this exam, students can get admission to the various UG, PG & Ph.D courses.</p>
		<h4>AP EAMCET 2020</h4>
		<p>AP EAMCET (Andhra Pradesh Engineering, Agriculture & Medical Common Entrance Test) is regulated by the JNTU, Kakinada on the behalf of APSCHE. This exam is conducted to offer admission into various engineering, agriculture and pharmacy courses. It is a state level entrance test of AP state.</p>	 
		<h4>OJEE 2020</h4>
		<p>OJEE is a state level entrance test organized by the Odisha state government. Odisha Joint Entrance Examination (OJEE) is conducted for admission to the undergraduate/postgraduate level professional courses. These courses are offered in the field of engineering, technology, pharmacy, management, etc. The admission into 1st year of UG engineering courses is done through JEE Main score.</p>	 
		<h4>LPU NEST 2020</h4>
		<p>LPU NEST (Lovely Professional University National Entrance and Scholarship Test) is a university level admission test. It is held for providing admission to the various engineering programmes offered by the university. This test is administrated by the Lovely Professional University (LPU), Punjab.</p>	 
		<h4>KCET 2020</h4>
		<p>KCET (Karnataka Common Entrance Test) is also known as Karnataka CET (K CET/Kar CET). It is a state level entrance test. This test is organized by the Karnataka Examinations Authority (KEA). Through this exam, students can get admission to the various engineering, pharmacy & architecture courses.</p>	
		</div>
		 <div class="col-md-6">
		<h3><i class="fa fa-fw fa-university" aria-hidden="true"></i><a href="{{url('/entrance-exam-coaching-center-')}}" target="_blank">University Level Entrance Exams</a></h3>
		<span class="dotted-border"></span>
		<h4>BITSAT 2020</h4>
		<p>BITSAT examination is organized by the Birla Institute of Technology and Science (BITS), Pilani. This exam is conducted in a university level. Candidates have to apply for this exam to get admission into integrated first degree courses of BITS campuses. BITSAT (Birla Institute of Technology & Science Admission Test) is a computer based online test.</p>
		<h4>UPESEAT 2020</h4>
		<p>UPESEAT exam is regulated by the University of Petroleum and Energy Studies (UPES), Dehradun. On the basis of this exam score, candidates can get admission to B.Tech course in various disciplines. UPESEAT (University of Petroleum and Energy Studies Engineering Aptitude Test) is a university level examination. The admission into B.Tech course is also done through JEE Main & board merit.</p>	 	
		<h4>VITEEE 2020</h4>
		<p>VITEEE (VIT Engineering Entrance Examination) is a university level examination. This exam is conducted by the VIT University. It is held for providing admission to the B.Tech course in the university & its campuses. Candidates can appear in this exam only through online mode.</p>	
		<h4>PTU Admission 2020</h4>
		<p>PTU (Punjab Technical University) organizes a university level examination. This exam is only for admission to the MBA, M.Sc (Physics, Chemistry, Mathematics, Food Science & Technology) and MA Journalism courses. The admission into other courses is done through national level examination. For B.Tech course, candidates have to qualify JEE Main examination.</p>
		<h4>Delhi University 2020</h4>
		<p>Delhi University (University of Delhi) is one of the famous universities of India. The university runs various bachelors, masters & doctoral level courses. The admission into these courses is done through entrance test or merit based. For admission to the B.Tech course, candidates have to pass the JEE Main examination.</p>	 
		<h4>JNU Admission 2020</h4>
		<p>JNU (Jawaharlal Nehru University) is premier institution which regulates various UG, PG & doctoral degree courses in various fields.  JNUEE (Jawaharlal Nehru University Entrance Examination) is conducted by NTA to enroll candidates in various UG / PG courses. For admission into Biotechnology Programmes, JNU CEEB is conducted.</p>
		<h4>Lucknow University 2020</h4>
		<p>Lucknow University organizes a university level admission test to offer admission into various UG, PG & MBA courses. These courses are offered in the field of science, commerce, arts, law, etc. The university also runs B.Tech programme in various specializations. The admission into B.Tech course is done through UPSEE examination score.</p>	
		<h4>BHU 2020</h4>
		<p>Banaras Hindu University (BHU) conducts a separate examination for admission to the UG, PG and other courses. The university organizes Undergraduate Entrance Test (UET) for UG and Postgraduate Entrance Test (PET) for PG courses admission. It is a university level examination. Through this entrance exam, candidates can get admission to the university & its affiliated colleges.</p>	
		<h4>Allahabad University 2020</h4>
		<p>Allahabad University regulates its own admission test to offer admission into various bachelor & masters degree courses. Candidates can pursue these courses in the field of science, arts, commerce, arts, etc. This test is a university level entrance exam. The university organizes separate admission test for UG & PG courses.</p>	 
	 	</div>
		<div class="col-md-6">
		<h3><i class="fa fa-fw fa-plus-square" aria-hidden="true"></i><a href="javascript:void(0)" class="banner_botton">Medical Entrance Exams</a></h3>
		<span class="dotted-border"></span>
		<h4>NEET 2020</h4>
		<p>NEET (National Eligibility Cum Entrance Test) is a national level medical examination. This entrance test is managed by the NTA (National Testing Agency). On the basis of this exam, candidates get admission into MBBS & BDS courses all over the country. No state or university level medical examinations will be regulated by the state authorities.</p>	
		<h4>AIIMS 2020</h4>
		<p>AIIMS examination is organized for providing admission to the MBBS programme in AIIMS Institutions. Every year, this exam is regulated by the All India Institute of Medical Sciences (AIIMS), New Delhi. It is a national level examination. Through this exam, the admission is offered in the following AIIMS Institutions, i.e. Bhopal, Guntur, Rishikesh, New Delhi, Nagpur, Patna, Jodhpur, Raipur & Bhubaneshwar.</p>	

		<h4>JIPMER 2020</h4>
		<p>JIPMER exam is organized by the Jawaharlal Institute Postgraduate Medical Education & Research, Puducherry. It is conducted to offer admission into MBBS courses in the university & its affiliated campuses. This exam is a national level entrance examination.</p>	
		</div>
		<div class="col-md-6">
		<h3><i class="fa fa-fw fa-universal-access" aria-hidden="true"></i><a href="javascript:void(0)" class="banner_botton">MBA Entrance Exams</a></h3>
		<span class="dotted-border"></span>
		<h4>CAT 2020</h4>
		<p>CAT (Common Admission Test) is conducted for admission to the PG management course all over the country. It is regulated by the Indian Institutes of Management (IIMs). This test is a national level admission test. It is compulsory to qualify this exam for admission to the IIMs & other reputed management institutions.</p>
		<h4>MAT 2020</h4>
		<p>MAT examination is managed by the All India Management Association (AIMA). Through this aptitude test, students can get admission to the MBA/PGDM courses all over the India. It is a national level management aptitude test. This exam is organized four times in a year.</p>	
		<h4>XAT 2020</h4>
		<p>XAT (Xavier Aptitude Test) is a national level entrance test. This test is conducted by the Xavier Labour Relations Institute (XLRI). It is held for providing admission to the various management programmes. XAT score card is accepted by the more than 150 B-Schools of the country.</p>	
		</div>
		<div class="col-md-6">
		<h3><i class="fa fa-fw fa-balance-scale" aria-hidden="true"></i><a href="{{url('law-entrance-exam-coaching')}}" target="_blank">Law Entrance Exams</a></h3>
		<span class="dotted-border"></span>
		<h4>CLAT 2020</h4>
		<p>CLAT examination is conducted for admission to the integrated LLB & LLM courses all over the country. This exam is regulated by the 18 National Law Universities (NLUs) on a rotation basis. CLAT (Common Law Admission Test) is a national level entrance test. CLAT score card is accepted by the all law institutions located in India.</p>	 	<h4>AILET 2020</h4>
		<p>AILET (All India Law Entrance Test) is managed by the National Law University (NLU), New Delhi. It is organized to provide admission into various undergraduate & postgraduate law programmes, i.e. BA LLB (Hons.), LLM & Ph.D. This exam is an all India level examination held one time in a year.</p>
		<h4>LSAT 2020</h4>
		<p>LSAT exam is conducted for providing admission to the various law institutions of India & foreign countries. It is an international level examination. This test is administrated by the Law School Admission Council (LSAC), USA. LSAT (Law School Admission Test) is organized only one times in a year.</p>
		<h4>DU LLB 2020</h4>
		<p>DU LLB Entrance Exam 2020 Syllabus will be based on the topics like analytical abilities, English language comprehension, general knowledge and legal awareness and aptitude. Candidates must prepare from each topics to obtain good marks.</p>
		 
		 </div>
		
		<div class="col-md-6">
		<h3><i class="fa fa-fw fa-hotel" aria-hidden="true"></i><a href="javascript:void(0)" class="banner_botton">Pharmacy Entrance Exams</a></h3>
		<span class="dotted-border"></span>
		<h4>GPAT 2020</h4>
		<p>GPAT (Graduate Pharmacy Aptitude Test) exam is organized by National Testing Agency (NTA). It is organized to offer admission into M.Pharm course. This exam is a national level entrance test. It is a computer based online test held in the month of January every year.</p>	
		<h4>MH CET 2020</h4>
		<p>MH CET examination is conducted for admission to the various pharmacy, engineering & technology courses. It is organized by Government of Maharashtra, State Common Entrance Test Cell. Maharashtra Common Entrance Test (MH CET) is a state level entrance test of Maharashtra state.</p>
		</div>
		<div class="col-md-6">
		<h3><i class="fa fa-fw fa-crop" aria-hidden="true"></i><a href="javascript:void(0)" class="banner_botton">Agriculture Entrance Exams</a></h3>
		<span class="dotted-border"></span>
		<h4>ICAR AIEEA 2020</h4>
		<p>ICAR AIEEA (All India Entrance Exam) is conducted by National Tesing Agency (NTA). This exam is organized to offer admission into UG & PG courses in agriculture & allied science courses. It is a national level examination. The authority organizes separate tests for UG & PG programmes, i.e. AIEEA UG & AIEEA PG.</p>	 
		<h4>JET Agriculture 2020</h4>
		<p>JET Agriculture (Joint Entrance Test) is organized by the Maharana Pratap University of Agriculture and Technology, Udaipur. This exam is held to offer admission into B.Tech (Food Technology/Dairy Technology) & B.Sc. Agriculture/Horticulture/Forestry (Honours) courses. It is a state level agriculture exam of Rajasthan state.</p>	 
		</div>-->
		
		
	</div>
		
		 
		 
		 
 
		
 

		<div class="blog" >
		<div class="tab-content">  
		<div class="features-list" >
		<div class="course-description-offer">                     

			<div class="col-md-6">
			<div class="features-left">            

			<h3>Quickindia beneficial provide the Entrance Exam Coaching</h3>
			 
		
			<div class="single-well">   
			<ul>
			<li>
			<i class="fa fa-check"></i>More about the coaching classes.
			</li>
			<li>
			<i class="fa fa-check"></i>Benefits to enrolling your name at coaching institutes.
			</li>

			<li>
			<i class="fa fa-check"></i>Top 3 High Priority Institutes with connected.
			</li>
			<li>
			<i class="fa fa-check"></i>High students placement institute with connected.
			</li>
			<li>
			<i class="fa fa-check"></i>Quickindia Lead provider Service Managment.
			</li>
			<li>
			<i class="fa fa-check"></i>Quickindia Marketing Executive Operater Manager.
			</li>
			<li>
			<i class="fa fa-check"></i>Quickindia Marketing Executive Telesales and Telemarketing Manager.
			</li>
			<li>
			<i class="fa fa-check"></i>Quickindia Business Development Executive  
			</li>
			<li>
			<i class="fa fa-check"></i>Quickindia Provide Marketing   
			</li>


			</ul>
			

			</div>
			 
			</div>
		 
			</div>
			<div class="col-md-6">
			<div class="features-right">			              

			<h3> Why should you offer Entrance Exam Coaching?</h3>
			<p style="text-align: justify;font-weight: 500;padding: 0px 15px;">Now, this doesn’t mean that employees are conspiring to bring about the downfall of the company. Nothing that sinister. But as humans, employees make mistakes, they’re trusting of fake identities, tempted by clickbai.</p>	
			<p style="text-align: justify;font-weight: 500;padding: 0px 15px;">The coaching institutes provide the students with their study modules and guides that the student can study. Ther generally offer on the point and structured guides so that the student can efficiently research and prepare for the Joint Entrance Examination.</p>
 
			
			</div>
			
			</div>
				 	  
			                        
          
 

		 








		</div>
		</div>






		</div>




		</div>

    
		
      <div class="course-part">   
            
      <div class="image-left">
		<img src="{{asset('landingimage/entrance-image-Quickindia.jpg')}}" width="100%" title="Entrance Exam Coaching" alt="Entrance Exam Coaching">
            </div>
            
       
            <div class="image-content-right">                
                <div class="content-right">
             <div class="col-xs-12 col-sm-12 col-md-12 form-proceed spacer">
                <div class="col-xs-12 col-sm-7 col-md-7 border-line formleftBlock">
                    <div class="heading-txt">
                        <p class="heading-txt-1">Tell us your need, we will connect you with service experts </p>
                    </div>
                    <form class="formaling lead_form" action="{{url('/client/lead/add-lead')}}" method="POST">
                        <div class="fieldblock">
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">City*</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8" id="select-city-proceed">
								<input type="hidden" name="lead_form" value="Entrance Exam Coaching" />
								<input type="hidden" name="b_end" value="2" />
                                <select class="dropdown-arrow dropdown-arrow-inverse city-form select2-single city" name="city_id">
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
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Interested in</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" placeholder="type text" class="form-control city-form home-search" name="kw_text" autocomplete="off">
								<div class="ajax-suggest ajax-suggest-lead-ajax" style="display: none;"><ul></ul></div>
                            </div>
                        </div>
                        <div class="fieldblock">
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Mobile*</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" placeholder="+91" class="form-control city-form" name="mobile">
                            </div>
                        </div>
                        <div class="fieldblock">
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Your Name*</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" placeholder="Your Name" class=" form-control city-form" name="name">
                            </div>
                        </div>
                        <div class="fieldblock">
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Email</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" placeholder="Email" class="form-control city-form" name="email">
                            </div>
                        </div>
                        <div class="fieldblock">
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Tell us more</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                 <div class="clearfix"></div>
                           
								<input type="submit" class="btn btn-primary submit-btn-2" value="Get Quotes" />
                                <a href="https://quickindia.in/privacy-policy" target="_blank" class="pull-right trmcondition">T&C Apply</a> </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-5 formrightBlock">
                    <div class="heading-txt-2"><span>Why Fill This Form?</span></div>
                    <ul class="whyChoose">
                        <li><span><img src="<?php echo asset('client/images/icon-1.png'); ?>"></span>Thousands of customers fill this for to get best deals from education institutes.</li>
                        <li><span><img src="<?php echo asset('client/images/icon-2.png'); ?>"></span>1000+ Institutes contact our customers with best deals after getting details from this form.</li>
                        <li><span><img src="<?php echo asset('client/images/icon-3.png'); ?>"></span>Customer’s requirement gets fulfilled with best offers instantly.</li>
                    </ul>
                </div>
            </div> </div>
            </div>
         
           </div>	
 	
		
		<div class="clearfix"></div>
        
		 
 
<div class="banner_botton_open">
	
        <a href="javascript:void(0);" class="connectedclosebtn">&nbsp;</a>
		 <h4>Need Expert Advice ?</h4>
        <div class="jbt"> Fill this form to Grab the best Deals on <span class="orng">Quickindia</span></div>
        <div class="popup">
            <form class="lead_form" action="{{asset('/client/lead/add-lead')}}" method="POST">
                <aside>	              
						 
						<label>Your name<span>*</span></label>
						<div class="popup-form">
							{{ csrf_field()}}  
                        <input class="form-control home-popup-form" type="text" placeholder="Enter Full Name" name="name" value="">
						</div>
                    
						<label>Your Mobile<span>*</span></label>
						<div class="popup-form">
                        <input class="form-control home-popup-form" type="text" placeholder="Enter Mobile" name="mobile" value="">
						</div> 
                     
					 
                        <label>Your Email ID<span></span></label>
						<div class="popup-form">
                       <input class="form-control home-popup-form" type="email" placeholder="Enter Email" name="email" value="">
						</div>
						 				 
					 
				  
					<label>City<span>*</span></label>
					<div class="popup-form" id="select-city-proceed">						
						<select class="dropdown-arrow dropdown-arrow-inverse home-popup-form select2-single city" name="city_id">
							<option value="">Select City</option>
							 
						</select>
					 
					</div>
                    
					 
					<label>Interested in<span>*</span></label>
					<div class="popup-form">
						<input type="text" placeholder="Type text" class="form-control city-form home-search" name="kw_text" autocomplete="off">
						
					</div>
                         <div class="ajax-suggest ajax-suggest-lead-ajax" style="display: none;"><ul></ul></div>
                    <p>
                        <label class="moblab">&nbsp;</label>
						<input class="jbtn" type="submit" value="Submit" />
						<input type="reset" class="reset_lead_form hide" value="reset" />
                        
                    </p>
                </aside>
            </form>
        </div>

        <section>
            <div class="jpb">
                <p> Your number will be shared only to these experts</p>
                <p>
                    <span class="bul"></span> Get Free Expert Online Counseling </p>
                <p>
                    <span class="bul"></span> Get Free Demo Classes
                </p>
                <p>
                    <span class="bul"></span> Get Fees & Discounts
                </p>
            </div>
        </section>
    </div>
		
		 
    </div>
 
 
  @endsection