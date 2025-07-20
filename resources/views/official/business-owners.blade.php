@extends('client.layouts.app')
@section('title')
Quick India- Local search, IT Training, Playschool, overseas education
@endsection 
@section('keyword')
Quick India- Local search, IT Training, Playschool, overseas education
@endsection
@section('description')
Quick India- Local search, IT Training, Playschool, overseas education
@endsection
@section('content')	

<?php
$authClient = 0;
 
if(Auth::guard('clients')->check()){
	$authClient = 1;
	$showFirstForm = 1;
	if(Session::has('show_first_form'))
		$showFirstForm = 0;
	if(Session::has('show_second_form'))
		$showFirstForm = 0;
	if(Session::has('show_third_form'))
		$showFirstForm = 0;
	if(Session::has('show_fourth_form'))
		$showFirstForm = 0;
}
?>
 
<?php 
 
if(!$authClient): ?>
<style>

@media(max-width:767px){
	#first_image, #second_image, #third_image {
    color: #787878;
    font-size: 18px;
    font-weight: bold;    
    float: left;
    margin: -27px 5px 1px 48px;
}
.faq-details h4.check-title {
    color: #444;
    font-size: 13px !important;
    font-weight: 500;
    margin-bottom: 0;
    line-height: 25px !important;
}
	.growthbusiness {
    width: 99%;
    float: left;
    margin-top: 0;
    margin-bottom: 60px;
    position: relative;
    padding: 0px 0px;
    margin-left: 0px;
   height: auto !important;
    background-repeat: no-repeat;
    background-image: url(../client/images/bg-image.png);
}
.business-clientBlock .img-responsive{ 
    width: 34px;
    float: left;
    margin-left: -50px;
	    margin-bottom: 15px;
	}
.business-clientBlock span {
    color: #787878;
    font-size: 16px;
    font-weight: bold;
    display: block;
    margin-top: 4px;
	margin-top: 5px;
    width: 232px;

}
}
 
</style>
<div class="business-banner">
<div class="container">
<div class="row">


<div class="col-sm-5 col-md-5">
<div class="business-quickrequestfotm">
<h1 class="hide">Business Owners</h1>
<h2>List Your Business </h2>
<?php if(count($errors)>0): ?>
	<div class="alert alert-danger">
		@foreach($errors->all() as $error)
		{{ $error }}.<br>
		@endforeach 
	</div>
<?php endif;  ?>
@if(Session::has('success_msg'))
	<div class="alert alert-success">
		{{Session::get('success_msg')}}
	</div>
@endif
@if(Session::has('danger_msg'))
	<div class="alert alert-danger">
		{{Session::get('danger_msg')}}
	</div>
@endif


<form class="form-style-9" id="business-form" action="{{url('/business-owners')}}" method="POST">
{{csrf_field()}}
<!--<p><select class="dropdown-arrow dropdown-arrow-inverse city-form select2-single city"   name="city"><option value="">Select City</option></select></p>-->
<p><input type="text" placeholder="Business/Company Name" class="pull-left" autocomplete="off" name="business_name" value="{{old('business_name')}}"></p>
<!--<p><input type="text" class="field-style field-split pull-left" placeholder="First Name" name="first_name" value="{{old('first_name')}}">
<input type="text" class="field-style field-split pull-right" placeholder="Last Name" name="last_name" value="{{old('last_name')}}"></p>-->
<p><input type="email" class="field-style pull-left"  placeholder="Enter Email" name="email" value="{{old('email')}}"></p>
<p><input type="text" class="field-style pull-right" placeholder="Enter Mobile Number" name="mobile" value="{{old('mobile')}}"></p> 

<p><input class="pull-left" type="submit" name="initial_form_submit" value="Start Your Business"></p>
</form>


</div>
</div>
<div class="col-sm-7 col-md-7">
    <img class="img-responsive" src="<?php echo asset('public/client/images/growing.svg'); ?>" style="width: 500px;height: 387px;">
 
</div>
</div>
</div>
</div>

<style>
.growthbusiness {
    width: 99%;
    float: left;
    margin-top: 0;
    margin-bottom: 60px;
    position: relative;
    padding: 0px 0px;
    margin-left: 0px;
    height: 490px;
    background-repeat: no-repeat;
    background-image: url(../client/images/bg-image.png);
}
#faq {
    width: 99%;
    float: left;
    margin-top: 0;
    margin-bottom: 60px;
    position: relative;
    padding: 0px 0px;
    margin-left: 0px;
    height: auto;
    background-repeat: no-repeat;
    background-image: url(../client/images/bg-image.png);
}
.growthbusiness li{
	list-style-type:square;
	margin-left: 18px;
}
</style>
  <div class="blog" >
            <div class="tab-content">  
<div class="" >
 <div class="growthbusiness">
  <div class="blog-title text-center">
            <h3>How Quick India help You to Grow your Business</h3>  			
            </div>
			 
      <div class="col-md-12">    
            
     <div class="col-md-6">           
     <h3> <a href="javascript:void(0)">How Quick India help You to Grow your Business?</a></h3>
     <p>Education is the main root of developing your life into a stable place to help you grow and to achieve success in the future. Quick India a growing education consultancy provider understand the growth. A company builds to help in providing the basic need of every individual related to education.</p>
		<h3> <a href="javascript:void(0)">What is Quick India?</a></h3>
		<p>Quick India is an extensive search engine for the students, parents, and professionals, those who are seeking an education platform for giving growth to their career and to build their future. We only deal with the education sector and helps students and professionals to grab the right opportunity at the right time, we have associated with a number of institutes, colleges and universities to help them provide the right candidate and to help them to grow their business.</p>

  <h3> <a href="javascript:void(0)"> Benefits you will get after associating with us:</a></h3>
               
 
<ul><li>If the provided leads are out of your locality or category, we work on the same to replace it as soon as possible.</li>
<li>We have the policy to refund on those leads that failed to commit.</li>
<li>We provide end to end support to deliver the best needed.</li>
<li>The information about leads will be distributed by SMS on your registered number and mailing on your registered email id.</li>

</ul>

		
	</div>
            
       <div class="col-md-6">
                 <h3> <a href="javascript:void(0)">Why choose Quick India for growing your business?</a></h3>
               
<p>There are a few aspects that make us different from others and the aim directed towards helping the users and the client to get the best opportunity because:</p>
<ul><li>The work module is very different from others.</li>
<li>We follow the conversion module.</li>
<li>We provide dual manually verified leads to your business.</li></ul><br>
<p>These aspects make us different from others but there are few more things that make us unique and pops up the priority for you to choose us:</p>
<ul><li>	The leads are generated in both ways organic and inorganic</li>
<li>	We have a co-branding relationship with our own channel partners making us more capable and worthy to choose.</li>
<li>	The leads provided by us are all verified twice by our expert counselors, in order to provide you genuine candidates.</li></ul>

<h3> <a href="javascript:void(0)">contact Us :</a></h3>
		<p>Contact: +91 70113 10265, Email: info@Quick India.com, Website: www.Quick India.com.</p>
		<p>Other ways can be; by registering your business as a free listing, don’t worry, our marketing team is always happy to find you.</p>



			    
			            
               
               
           
            </div> 
			
			  
            </div>
             
         
     
 
</div>
</div>
                     

              

 
           
            </div>
			  
 
		
 
        </div>
		
		
		
 <?php endif; ?>
<div class="clearfix"></div>
<div class="wrap-middle-section">
<div class="container">


<!-- <div class="clearfix"></div> -->

 
<!-- Slide Section -->

<!--Start New Section-->
<h2 class="business-title text-center">Benefits of listing your business with Quick India</h2>
<div class="business-clientBlock">
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
		<img class="img-responsive" src="<?php echo asset('public/client/images/business/group.png'); ?>" alt="Leads that Convert to Business" />
		<span>Leads that Convert to Business</span>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
		<img class="img-responsive" src="<?php echo asset('public/client/images/business/profile.png'); ?>" alt="Ready-to-Share Profile" />
		<span>Ready-to-Share Profile</span>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
		<img class="img-responsive" src="<?php echo asset('public/client/images/business/head_phone.png'); ?>" alt="Reliable Customer Support" />
		<span>Reliable Customer Support</span>
	</div>
</div>

 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <style>
 .faq-details h4.check-title {
    color: #444;
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 0;
    line-height: 25px;
}
 
.panel-default>.panel-heading {
    background-color: transparent;
    border: medium none;
    color: #333;
}
.panel-heading {
    padding: 1px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
} 
.faq-details a span.acc-icons {
    position: relative;
}
.faq-details a span.acc-icons::before {
    color: #333;
    content: "";
    font-family: fontawesome;
    font-size: 24px;
    height: 40px;
    left: -51px;
    line-height: 39px;
    position: absolute;
    text-align: center;
    top: -10px;
    width: 42px;
}
.faq-details h4.check-title a.active, .faq-details a.active span.acc-icons::before {
    color: #3EC1D5;
}
.faq-details h4.check-title a {
    color: #333;
    display: block;
    font-weight: 700;
    letter-spacing: 2px;
    margin-left: 40px;
    padding: 6px 10px;
    text-decoration: none;
}
::selection {
    background: #3EC1D5;
    text-shadow: none;
}
.faq-details a.active span.acc-icons::before {
    content: "";
    font-family: fontawesome;
    font-size: 24px;
    height: 40px;
    left: -51px;
    line-height: 39px;
    position: absolute;
    text-align: center;
    top: -10px;
    width: 42px;
}
 </style>
<div id="faq" class="faq-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>FAQ's</h2>
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
											<a data-toggle="collapse" class="" data-parent="#accordion" href="#check1">
                                                <span class="acc-icons"></span> What is Quick India?
											</a>
										</h4>
                </div>
                <div id="check1" class="panel-collapse collapse in">
                  <div class="panel-body">
                    <p>
                     Quick India is an extensive search engine for the students, parents, and Professionals, Quick India Only Deals In Education Sector and helps students to grab their right opportunity, and helps business owners to grow their business.
                    </p>
                  </div>
                </div>
              </div>
            
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#check2">
                                                <span class="acc-icons"></span>Why choose Quick India for growing your business?
											</a>
										</h4>
                </div>
                <div id="check2" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
                      Our Work Module Is Completely Different, we work on the Conversion module, and we Provide you  Dual Manually Verified Leads to your Business. 
                    </p>
                  </div>
                </div>
              </div>
               
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#check3">
                                                <span class="acc-icons"></span>What Happen If my leads commitment did not get fulfilled?
											</a>
										</h4>
                </div>
                <div id="check3" class="panel-collapse collapse ">
                  <div class="panel-body">
                    <p>
                      In case we are unable to fulfill our committed no of leads, we will refund your remaining amount.
                    </p>  

					 
                  </div>
                </div>
              </div>
             
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#check4">
                                                <span class="acc-icons"></span> What happens if I received a lead from out of my city/category?
											</a>
										</h4>
                </div>
                <div id="check4" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
                     If you get a lead which is either out from your Locality or Category Then we will replace it as soon as possible.
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
                                                <span class="acc-icons"></span>How Diffrent your leads quality from others?
											</a>
										</h4>
                </div>
                <div id="check5" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
					our leads are dual manually verified by our expert counselors, so no need to worry about it.
                    </p>
                  </div>
                </div>
              </div>
               
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordions" href="#check6">
                                                <span class="acc-icons"></span>How do you generate leads?
											</a>
										</h4>
                </div>
                <div id="check6" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
                    we generate leads organically as well as inorganic leads, and we have Our own channels partners
                    </p>
                  </div>
                </div>
              </div>
              
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordions" href="#check7">
                                                <span class="acc-icons"></span>How will I get Leads?
											</a>
										</h4>
                </div>
                <div id="check7" class="panel-collapse collapse ">
                  <div class="panel-body">
                    <p>
                     You will receive Leads on your Registered contact no through sms, and also on Your registered Email Id.
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
                    For More Info & any Queries, you can Contact Us on +91 70113 10265 or reach out to us via e-mail @ info@Quick India.com, or list your business as free listing, our marketing team Will Contact you Soon.
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
 


</div>
</div>
<div class="clearfix"></div>

<script>
 
$(function() {
  setTimeout(function() {
    $('.business_success').fadeOut('fast');
  }, 5000);
});
</script>
@endsection
