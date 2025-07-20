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
                        <p>Let's uncover the best training providers near you.</p>
                        
                        <div class="clearfix"></div>
                      
                    </div>
                
                
 
    </div>


    <div class="clearfix"></div>
   <!--
   <div class="container-menu">
        <nav class="navbar navbar-default customnav">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
                <a class="navbar-brand" href="#" title="All Courses" style="display:none;">All Courses</a>
            </div>

			@if(isset($menuArr) && count($menuArr)>0)
            <div class="collapse navbar-collapse js-navbar-collapse">
                <ul class="nav navbar-nav">
					@foreach($menuArr as $mainMenu)
						<li class="dropdown mega-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="{{ $mainMenu['parent'][0]->pc_icon }}" aria-hidden="true"></i>{{ $mainMenu['parent'][0]->parent_category }}</a>
							@if(isset($mainMenu['child']) && count($mainMenu['child'])>0)
							<ul class="dropdown-menu mega-dropdown-menu row">
								<?php
								$subMenu = [];
								$subMenu['list_one'] = '<li class="col-sm-3 col-md-3"><ul>';
								$subMenu['list_two'] = '<li class="col-sm-3 col-md-3"><ul>';
								$subMenu['list_three'] = '<li class="col-sm-3 col-md-3"><ul>';
								$subMenu['list_four'] = '<li class="col-sm-3 col-md-3"><ul>';
								$i=0;
							 
								foreach($mainMenu['child'] as $subMenuItem){
									$i++;
									if($i=='1'){
										$subMenu['list_one'] .= "<li><a href=\"javascript:showKeywordsList('".$subMenuItem->parent_category_id."','".$mainMenu['parent'][0]->parent_category."','".$subMenuItem->id."','".$subMenuItem->child_category."')\" title='".$subMenuItem->child_category."'>$subMenuItem->child_category</a></li>";
									}
									if($i=='2'){
										$subMenu['list_two'] .= "<li><a href=\"javascript:showKeywordsList('".$subMenuItem->parent_category_id."','".$mainMenu['parent'][0]->parent_category."','".$subMenuItem->id."','".$subMenuItem->child_category."')\" title='".$subMenuItem->child_category."'>$subMenuItem->child_category</a></li>";
									}
									if($i=='3'){
										$subMenu['list_three'] .= "<li><a href=\"javascript:showKeywordsList('".$subMenuItem->parent_category_id."','".$mainMenu['parent'][0]->parent_category."','".$subMenuItem->id."','".$subMenuItem->child_category."')\" title='".$subMenuItem->child_category."'>$subMenuItem->child_category</a></li>";
									}
									if($i=='4'){
										$subMenu['list_four'] .= "<li><a href=\"javascript:showKeywordsList('".$subMenuItem->parent_category_id."','".$mainMenu['parent'][0]->parent_category."','".$subMenuItem->id."','".$subMenuItem->child_category."')\" title='".$subMenuItem->child_category."'>$subMenuItem->child_category</a></li>";
										$i=0;
									}
								}
								$subMenu['list_one']   .= '</ul></li>';
								$subMenu['list_two']   .= '</ul></li>';
								$subMenu['list_three'] .= '</ul></li>';
								$subMenu['list_four']  .= '</ul></li>';
								 
								echo $subMenu['list_one'].$subMenu['list_two'].$subMenu['list_three'].$subMenu['list_four'];
								?>
							</ul>
							@endif
						</li>						
					@endforeach
                </ul>
            </div>
			@endif
        </nav>
		
		</div>
		-->
		<style>
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
    background-color: #fff;
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
    font-size: 18px;
	margin-right: 220px;
}
 .features-right h3  {
    color: #C94A30;
    font-size: 18px;
	margin-right: 33px;
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
.categoryBlock {    
    float: left;
    margin-top: 0;
    margin-bottom: 60px;
    position: relative;
    padding: 0px 0px;
    margin-left: 10px !important;
}
.features-left h3 {
    color: #C94A30;
    font-size: 18px;
    margin-right: 0px; 
}
}
.categoryBlock {   
    float: left;
    margin-top: 0;
    margin-bottom: 60px;
    position: relative;
    padding: 0px 0px;
    margin-left: -6px !important;
    width: 100%;
}
.quiry-buttom{
	    margin: 8px;
}
.course-category-box a{
	color: #005DFF;
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
					<a href="{{url('/clat-coaching')}}">CLAT Coaching</a>				 
					 
				</div>
				</div></div>
						
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="{{url('/neet-entrance-coaching')}}">Neet Eentrance</a>				 
					 
				</div>
				</div></div>
						
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="{{url('/du-llb-coaching')}}">DU LLB Coaching</a>				 
					 
				</div>
				</div></div>	
					
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="{{url('/clat-coaching')}}">CLAT Entrance</a>				 
					 
				</div>
				</div></div>	
					
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="{{url('/aiims-coaching')}}">AIIMS Entrance</a>				 
					 
				</div>
				</div></div>
									
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="{{url('/gate-coaching')}}">GATE Entrance</a>				 
					 
				</div>
				</div></div>
									
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="{{url('/ssc-coaching')}}">SSC Entrance</a>				 
					 
				</div>
				</div></div>
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="{{url('/pcs-coaching')}}">PCS Entrance</a>				 
					 
				</div>
				</div></div>

				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="{{url('/ias-coaching')}}">IAS Entrance</a>				 
					 
				</div>
				</div></div>	
				<div class="col-md-2">
				<div class="inner-category-div">			 
				<div class="course-category-box">
					<a href="{{url('/iit-jee')}}">IIT JEE Entrance</a>				 
					 
				</div>
				</div></div>
				
				 
				
				
				<!--		
				<div class="col-md-3">
				<div class="inner-client-div">
				
				<a href="http://localhost:8000/training/rvmcad-soft" title="RVMCAD SOFT" tabindex="0"></a>
				<div class="grid-info">
					<h3><a href="http://localhost:8000/training/rvmcad-soft" title="RVMCAD SOFT" tabindex="0"> <strong>NEET Entrance Exam Coaching</strong> </a></h3>
				
					<strong><i class="fa fa-map-marker"></i> </strong>
					
				</div>
				</div></div>
				
				
						
				<div class="col-md-3">
				<div class="inner-client-div">
				 
				<a href="http://localhost:8000/training/creative-animation" title="Creative Animation" tabindex="0"></a>
				<div class="grid-info">
					<h3><a href="http://localhost:8000/training/creative-animation" title="Creative Animation" tabindex="0"> <strong>IPS Entrance Coaching</strong> </a></h3>
				
					<strong><i class="fa fa-map-marker"></i> </strong>
					
				</div>
				</div></div>
				
				
						
				<div class="col-md-3">
				<div class="inner-client-div">
				 
				<a href="http://localhost:8000/training/nansat-digital-marketing-institute" title="Nansat Digital Marketing institute" tabindex="0"></a>
				<div class="grid-info">
					<h3><a href="http://localhost:8000/training/nansat-digital-marketing-institute" title="Nansat Digital Marketing institute" tabindex="0"> <strong>GATE Coaching</strong> </a></h3>
				
					<strong><i class="fa fa-map-marker"></i> </strong>
				
				</div>
				</div>
				</div>-->
				
				
						 
					
            
        </div>
			
			
			
			</div>
 
                   

                </div>

 

                 

            </div>
             
		<div class="clearfix"></div>		 
		<div class="course-description">  
		<h4>Home Credit Instant Personal Loan Upto 2 Lakhs for All</h4>

		<p>Home Credit provides online personal loan to salaried & self-employed individuals in India with minimal documentation. As we know personal loans are unsecured loans provided to individuals on the basis of their credit history. Personal loans can be huge reassurance in times of adhoc financial crunch. It can be your ‘all weather’ friend to serve all your purposes and leave your savings untouched. Get multipurpose personal loan without any collateral or security from us.</p>	
		<h4>Types of Personal Loans</h4>
		<p>On the basis of your needs, below are the different types of loans which can be availed in India from Home Credit:</p>	
		<h4>Types of Personal Loans</h4>
		<p>On the basis of your needs, below are the different types of loans which can be availed in India from Home Credit:</p>	
		<h4>Types of Personal Loans</h4>
		<p>On the basis of your needs, below are the different types of loans which can be availed in India from Home Credit:</p>	
		<h4>Types of Personal Loans</h4>
		<p>On the basis of your needs, below are the different types of loans which can be availed in India from Home Credit:</p>
		<h4>Types of Personal Loans</h4>
		<p>On the basis of your needs, below are the different types of loans which can be availed in India from Home Credit:</p>	
		<h4>Types of Personal Loans</h4>
		<p>On the basis of your needs, below are the different types of loans which can be availed in India from Home Credit:</p>	 
		 
		<h4>Best Instant Personal Loan Offers</h4>
		<p>Home Credit India offers instant loan online starting from Rs. 25,000 to Rs. 2,00,000 with quick approval and fast disbursals at a competitive rate of interest. Pay easy EMIs as low as Rs.1000* and quickly meet your financial needs with 0 % processing fees.
		Borrowing from family and friends can be embarrassing in most cases. Instant loans by Home Credit can get you fastest cash at the click of a button. Now, no more sharing awkward moments with family and friends.</p>	 
		<span class="dotted-border"></span>
	</div>
		
		 
		 
		 
 
		 
      <div class="course-part">   
            
      <div class="image-left">
		<img src="{{asset('landingimage/entrance-image.jpg')}}" width="100%" title="Software Development Services" alt="Software Development Services">
            </div>
            
       
            <div class="image-content-right">                
                <div class="content-right">
             <div class="col-xs-12 col-sm-12 col-md-12 form-proceed spacer">
                <div class="col-xs-12 col-sm-7 col-md-7 border-line formleftBlock">
                    <div class="heading-txt">
                        <p class="heading-txt-1">Tell us your need, we will connect you with service experts </p>
                    </div>
                    <form class="formaling lead_form" action="{{url('/lead/add-lead')}}" method="POST">
                        <div class="fieldblock">
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">City*</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8" id="select-city-proceed">
								<input type="hidden" name="lead_form_" value="1" />
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
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Email*</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" placeholder="Email" class="form-control city-form" name="email">
                            </div>
                        </div>
                        <div class="fieldblock">
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Tell us more</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <textarea class="form-control city-form" id="exampleTextarea" rows="3" placeholder="Provide any specific details for your need" name="remark"></textarea>
                                <div class="clearfix"></div>
                                <!--button type="button" class="btn btn-primary submit-btn-2">Get Quotes</button-->
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
 

		<div class="blog" >
		<div class="tab-content">  
		<div class="features-list" >
		<div class="course-description-offer">                     

			<div class="col-md-6">
			<div class="features-left">            

			<h3> How beneficial are the Entrance Exam Coaching</h3>
			 
		
			<div class="single-well">   
			<ul>
			<li>
			<i class="fa fa-check"></i>IT hiring manager up front end skillls.
			</li>
			<li>
			<i class="fa fa-check"></i>Key development tools with SEO Specialist Responsibilities.
			</li>

			<li>
			<i class="fa fa-check"></i>Open Web Developer with Designer.
			</li>
			<li>
			<i class="fa fa-check"></i>Management Direction.
			</li>
			<li>
			<i class="fa fa-check"></i>Quickindia Lead provider Service Manager.
			</li>
			<li>
			<i class="fa fa-check"></i>Opening Marketing Executive Operater Manager.
			</li>
			<li>
			<i class="fa fa-check"></i>Opening Marketing Executive Telesales and Telemarketing Manager.
			</li>
			<li>
			<i class="fa fa-check"></i>Opening Business Development Executive  
			</li>
			<li>
			<i class="fa fa-check"></i>Digital Marketing   
			</li>


			</ul>
			

			</div>
			 
			</div>
		 
			</div>
			<div class="col-md-6">
			<div class="features-right">			              

			<h3> Why should you offer cybersecurity awareness training for employees?</h3>
			<p style="text-align: justify;font-weight: 500;padding: 0px 15px;">Now, this doesn’t mean that employees are conspiring to bring about the downfall of the company. Nothing that sinister. But as humans, employees make mistakes, they’re trusting of fake identities, tempted by clickbai.</p>
 
			
			</div>
			
			</div>
				 	  
			                        
          
 

		 








		</div>
		</div>






		</div>




		</div>

    
		
 	
		
		<div class="clearfix"></div>
        
		 
 
<div class="banner_botton_open">
	
        <a href="javascript:void(0);" class="connectedclosebtn">&nbsp;</a>
		 <h4>Need Expert Advice ?</h4>
        <div class="jbt"> Fill this form to Grab the best Deals on <span class="orng">Quickindia</span></div>
        <div class="popup">
            <form class="lead_form" action="{{asset('/developer/lead')}}" method="POST">
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