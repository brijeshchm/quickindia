<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="utf-8">	
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>@yield('title')</title>
<meta name="keywords" content="@yield('keyword')" >
<meta name="description" content="@yield('description')" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">	
<link rel="canonical" href="{{ URL::current() }}"/> 
<link rel="shortcut icon" href="{{asset('client/images/quickind-logo-blue.png')}}" type="image/png"/>
<meta http-equiv="content-language" content="en-IN">
<meta name="classification" content="directory portal" />

<meta name="distribution" content="local" />
<meta content="All" name="WebCrawlers" />
<meta content="All, FOLLOW" name="MSNBots" />
<meta content="All" name="Googlebot-Image" />
<meta content="All, FOLLOW" name="BINGBots" />
<meta content="All, FOLLOW" name="YAHOOBots" />
<meta content="All, FOLLOW" name="GoogleBots" />
<meta name="copyright" content="quickindia">
<meta name="author" content="quickindia" />
<meta http-equiv="CACHE-CONTROL" content="PUBLIC" />
<meta name="publisher" content="" />
<meta name="identifier-URL" content="{{url('/')}}">
<meta name="msvalidate.01" content="" />
<meta name="p:domain_verify" content="6b026cb56a0cbb53c2811890ecdc5b07"/>
<meta name="google-site-verification" content="XwopxjB-09taNCDkXgTI6O5xdT-MmgnIZT0d4cIYqFk"/>
<meta name="url" content="{{url('/')}}" />
<meta name="DC.title" content="@yield('keyword')" />
<meta name="distribution" content="global" />
<meta name="geo.region" content="IN-UP" />
<meta name="geo.placename" content="Noida" />
<meta name="geo.position" content="28.535516;77.391026" />
<meta name="ICBM" content="28.535516, 77.391026" />
<meta name="robots" content="index, follow" />
<meta name="Revisit-after" content="7 Days" />
<meta property="og:locale" content="en_IN" />
<meta property="og:type" content="website" />
<meta property="og:title" content="@yield('title')" />
<meta property="og:description" content="@yield('description')" />
<meta property="og:url" content="https://quickindia.in/" />
<meta property="og:site_name" content="quickindia" />
<meta property="fb:app_id" content="https://www.facebook.com/quickindofficial/" />
<meta property="og:image" content="{{asset('client/images/quickind-logo-blue.png')}}" />
<meta property="og:image:secure_url" content="{{asset('client/images/logo.png')}}" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="628" />
<meta property="og:image:alt" content="quickind" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:description" content="@yield('keyword')" />


<meta name="rating" content="general">
<meta name="robots" content="ALL">
<meta name="googlebot" content=" index, follow ">
<meta name="bingbot" content=" index, follow " >
<meta name="reply-to" content="info@quickindia.in">
<meta name="expires" content="never" >
<link rel="alternate" href="https://quickindia.in/" hreflang="en-in" />


<!-- SCRIPT-SPINNER -->  
<script src="<?php echo asset('vendor/spinner/spin.min.js') ?>" async></script>	
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
<link href="<?php echo asset('client/css/bootstrap.css'); ?>" rel="stylesheet"> 
<link href="<?php echo asset('vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo asset('client/customfont/stylesheet.css'); ?>" rel="stylesheet">
<link href="<?php echo asset('vendor/select2/css/select2.min.css'); ?>" rel="stylesheet">
<link href="<?php echo asset('vendor/select2/css/select2-bootstrap.css'); ?>" rel="stylesheet">
<link href="<?php echo asset('admin/vendor/datatables-plugins/dataTables.bootstrap.css'); ?>" rel="stylesheet">

<link href="<?php echo asset('admin/vendor/datatables-responsive/dataTables.responsive.css'); ?>" rel="stylesheet">

<script type="text/javascript" src="<?php echo asset('client/js/jquery-1.11.2.min.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo asset('client/js/jquery.galleriffic.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo asset('client/js/jquery.opacityrollover.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo asset('client/js/bootstrap.min.js'); ?>" ></script>
  
<link href="<?php echo asset('client/css/style.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('client/css/owl.carousel.css'); ?>">
<link rel="stylesheet" href="<?php echo asset('client/css/galleriffic-1.css'); ?>" type="text/css" />
<link href="<?php echo asset('client/css/login-popup.css'); ?>" rel="stylesheet">
<link href="<?php echo asset('client/css/media.css'); ?>" rel="stylesheet">
<!------Google Analytic Script Start----->
 
 
<!------Google Analytic Script End----->
<!--<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "url": "https://quickindia.in",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Noida",
    "addressRegion": "Uttar Pradesh",
    "postalCode": "201301",
    "streetAddress": ""
  },
  "description": "An Education Information Provider.",
  "name": "QuickIndia",
  "contactPoint": [{
    "@type": "ContactPoint",
    "telephone": "+91-7011310265",
    "contactType": "Customer service"
  }],
  "logo": "https://quickindia.in/public/client/images/quickind-logo-blue.png",
  "sameAs": ["https://www.facebook.com/quickindiaofficial/"]
}
</script>-->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-EPFNYL5C8D"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-EPFNYL5C8D');
</script>


</head>

<body>    <!-- SPINNER -->    
<div id="spinnerBkgd"></div>    <div id="spinnerCntr"></div>    <!-- SPINNER -->	
   
    
     <header id="header">
        <div class="container">
            <div class="logo">
                <h1 title="quickind">                  
                    <a href="{{url('/')}}"><img src="<?php echo asset('client/images/logo.png'); ?>" alt="Quick india" class="img-responsive" /></a> 
                </h1>
            </div>
     
		 
			<?php 
		 
			if(!Auth::guard('clients')->check()){ ?>
			
                    
                    <div class="head-right-lout">
                        	<div class="head-left">
				    
				     <a href="{{ url('business-owners') }}" class="freelisting">
				         
				        <h6 style="background-color: #E52626;line-height: 1.3;margin-bottom: 0px;border-radius: 3px;color: #fff;">Business</h6> <i class="fa fa-handshake-o" aria-hidden="true"></i> <span> Free Listing</span></a>  
			
                    </div>
                    <div class="head-right">
                    |  <a href="javascript:void(0);" id="login">Sign In</a> / <a href="{{ url('business-owners') }}">Sign Up</a> 
                    </div>
                    </div>
		 <?php }else{ ?>
		 	<div class="head-right-lout"> 
				<?php $clientID = auth()->guard('clients')->user()->id;
				$client = App\Models\Client\Client::find($clientID);   	 							 
				if(!empty($client->logo)){
					$logo = unserialize($client->logo);
				if(!isset($logo['thumbnail'])){
					$logo['thumbnail'] = $logo['large'];
				}								
					$image = $logo['large']['src'];
				?>
				<img src="<?php echo asset(''.$image); ?>" alt="Profile" class="rounded-circle" style="max-height: 36px;border-radius: 50% !important;">

				<?php } ?>
		 	 
		  
		 	 
		 	 <ul class="nav navbar-top-links navbar-right">
                
				
				<li class="dropdown open">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('business/dashboard')}}" aria-expanded="true">  
                    <?php 
               
                    
                    
                    echo ucfirst(auth()->guard('clients')->user()->business_name); ?>
                     <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user"> 
                        <li><a href="{{url('business/profileInfo')}}">Profile</a></li> 
                        <li><a href="{{ url('client/logout') }}">Logout</a>
                        </li>
                    </ul>
                    
                </li>
                
            </ul>
		 <a href="{{url('business/dashboard')}}"><strong></strong></a> 
		 </div>
		 <?php  } ?>
		<style>
		.select2-dropdown--below{ 
		    width: 372px;
		    
		}
		</style>
		</div>
    </header>
     <div class="scrollheadsearch<?php echo (Route::getCurrentRoute()->uri() != '/')?' fixedform':''; ?>">
		<div class="filterForm"> 
		 
				<form action="/searchlist" method="GET" class="search-form" autocomplete="off">
				    
				    <input type="text" class="col-md-3  serviceneed location locationbtn city cityList" name="city">
						   <div class="city-result">
                  <ul></ul>
                  </div>
			 
					
					
					<div class="search-bar"> 
					<input type="text" placeholder="What service you need today!" class="col-md-7 serviceneed home-search searchInput" name="search_kw" >
				   <span class="clear-btn clearBtn">✖</span>
					<div class="ajax-suggest" style="display: none;"><ul></ul></div>
					</div>
				</form>
			</div>
    </div>
  <style>
     .search-bar .clear-btn {
            position: absolute;
            right: 135px;
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: #666;
            margin-top: 12px;
        }
        .search-bar .voice-btn {
            position: absolute;
            right: 40px;
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: #1a73e8;
                margin-top: 12px;
        }
         .search-bar {
         position: relative;
         /*display: flex;*/
         background: #fff;
         }
       
</style>
   <script>
     
const clearButtons = document.getElementsByClassName('clearBtn');
const searchInputs = document.getElementsByClassName('searchInput');

for (let i = 0; i < clearButtons.length; i++) {
clearButtons[i].addEventListener('click', () => {
searchInputs[i].value = '';
});
}
    </script>

	@yield('content')
	
	 <div class="clearfix"></div>
	<div class="modal fade" id="showKeywordsList" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					 
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="cityKWForm" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<form class="search-form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" name="search_kw" class="home-search form-control" autocomplete="off" readonly>
					</div>
					<div class="form-group">
						<select name="city" class="city form-control">
						</select>
					</div>
				</div>
				<div class="modal-footer" style="text-align:center">
					<button type="submit" class="btn btn-default">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
				</form>
			</div>
		</div>
	</div> 
	
	
	
 
    <div class="container">
        <div class="main-footer">
        <div><h4>Popular Categories</h4>
        <?php 
        
        $cityes = App\Models\Citieslists::where('city',Request::segment(1))->first();
        if($cityes){
            $city = $cityes->city;
        }else{
            
            $city = "delhi";
        }
       
         ?>
        <ul>
            <li><a title="Coaching &amp; Tuitions" href="{{url('coaching-tuitions')}}" tabindex="0" >Coaching &amp; Tuitions</a></li>  |
            <li><a title="Business Services" href="{{url('business-services')}}" tabindex="0" >Business Services</a></li> |
            <li><a title="Home Construction &amp; Renovation" href="{{url('home-construction')}}" tabindex="0" >Home Construction &amp; Renovation</a></li> |
            
            <li><a title="Personal Finance Services" href="{{url('categories/personal-finance-services')}}" tabindex="0" >Personal Finance Services</a></li> |
            <li><a title="Tours &amp; Travels" href="{{url('categories/tours-travel-services')}}" tabindex="0" >Tours &amp; Travels</a></li> |
            <li><a title="Property" href="{{url('home-construction/property-dealer')}}" tabindex="0"  >Property Dealer</a></li> | 
            <li><a title="Rentals" href="{{url('Rentals')}}" tabindex="0" >Rental Property</a></li> |
            <li><a title="PG" href="{{url('pg-hostels')}}" tabindex="0" >PG & Hostel</a></li> |
            <li><a title="Computer Courses & Training" href="{{url('computer-courses-training')}}" tabindex="0" >Computer Courses & Training</a></li> |
            
            <li><a title="Study Abroad" href="{{url('study-abroad')}}" tabindex="0" >Study Abroad</a></li> |
            <li><a title="Home Services" href="{{url('home-services')}}" tabindex="0" >Home Services</a></li> |
            <li><a title="Parties, Special Occasions &amp; Wedding" href="{{url('wedding-organizers')}}" tabindex="0" >Parties, Special Occasions &amp; Wedding</a></li> |
            <li><a title="Electric Services" href="{{url('delhi/categories/electric-services')}}" tabindex="0" >Electric Services</a></li> | 
            <li><a title="Government Exam" href="{{url('delhi/categories/entrance-exams-coaching')}}" tabindex="0" >Government Exam</a></li> |
            <li><a title="Electric Services" href="{{url('web-designers')}}" tabindex="0" >Web Designers</a></li> |
            <li><a title="Medical" href="{{url('medical')}}" tabindex="0" >Medical</a></li> |
            <li><a title="Carpenters" href="{{url('carpenters')}}" tabindex="0" >Carpenters</a></li> |
            <li><a title="Health & Wellness" href="{{url('health-wellness')}}" tabindex="0" >Health & Wellness</a></li> |
            <li><a title="Yoga" href="{{url('yoga')}}" tabindex="0" >Yoga</a></li> |
            <li><a title="tax Consultants" href="{{url('tax-consultants')}}" tabindex="0" >CA & TAX Consultants</a></li> 
           
            </ul>
            </div>
            <div><h4>Business Services</h4>
            <ul> 
            <li><a title="Patient Care Service" href="{{url('patient-care-services')}}" tabindex="0" >Patient Care Service</a></li> |
            <li><a title="Home Appliances Repair &amp; Services" href="{{url('home-appliances-repair-services')}}" tabindex="0" >Home Appliances Repair &amp; Services</a></li> |
            <li><a title="Packers and Movers" href="{{url('packers-movers')}}" tabindex="0" >Packers and Movers</a></li> |
            <li><a title="AC Services" href="{{url('ac-repair-services')}}" tabindex="0" >AC Services</a></li> |
            <li><a title="Cleaning Services" href="{{url('cleaning-services')}}" tabindex="0" >Cleaning Services</a></li> |
            
            <li><a title="Security Guards" href="{{url('security-guards-services')}}" tabindex="0" >Security Guards</a></li> |
             <li><a title="Architects" href="{{url('architects')}}" tabindex="0" >Architects</a></li> |
            <li><a title="Building Consultants &amp; Contractors" href="{{url('building-consultants-contractors')}}" tabindex="0" >Builders &amp; Contractors</a></li> | 
            <li><a title="Interior Designers &amp; Decorators" href="{{url('interior-designers-decorators')}}" tabindex="0" >Interior Designers &amp; Decorators</a></li> |
            <li><a title="Housekeeping Services" href="{{url('housekeeping-services')}}" tabindex="0" >Housekeeping Services</a></li> |
            <li><a title="Painting Contractors" href="{{url('painting-contractors')}}" tabindex="0" >Painting Contractors</a></li> |
            <li><a title="Modular Kitchen Dealers" href="{{url('modular-kitchen-dealers')}}" tabindex="0" >Modular Kitchen Dealers</a></li> | 
            <li><a title="Waterproofing Contractors" href="{{url('waterproofing-contractors')}}" tabindex="0" >Waterproofing Contractors</a></li> 
           
            </ul>
            </div>
            <div><h4>Education Training</h4>
            <ul><li><a title="Job Training" href="{{url('job-training')}}" tabindex="0" >Job Training</a></li> |
            <li><a title="School Tuitions" href="{{url('schools-colleges')}}" tabindex="0" >Schools & Colleges</a></li> |
            <li><a title="Entrance Exam Coaching" href="{{url('delhi/categories/entrance-exams-coaching')}}" tabindex="0" >Entrance Exam Coaching</a></li> |
            <li><a title="Competitive Exam Coaching" href="{{url('competitive-exam-coaching')}}" tabindex="0" >Competitive Exam Coaching</a></li> |
            <li><a title="Distance Education" href="{{url('distance-education')}}" tabindex="0" >Distance Education</a></li> |
            <li><a title="Language Training" href="{{url('language-training')}}" tabindex="0" >Language Training</a></li> |
            <li><a title="Overseas Education" href="{{url('overseas-education-consultants')}}" tabindex="0" >Overseas Education</a></li> |
            <li><a title="College &amp; University Tuitions" href="{{url('college-tuition')}}" tabindex="0" >College &amp; University Tuitions</a></li> |
            <li><a title="Bank &amp; Insurance Exam Coaching" href="{{url('bank-insurance-exam-coaching')}}" tabindex="0" >Bank &amp; Insurance Exam Coaching</a></li> |
            <li><a title="Placement Consultancies" href="{{url('placement-consultants')}}" tabindex="0" >Placement Consultants</a></li> 
            </ul>
            </div>
            <div><h4>Personal Service</h4>
            <ul><li><a title="Loans" href="{{url('loan')}}" tabindex="0" >Loans</a></li> |
            <li><a title="Visa Consultants" href="{{url('visa-consultants')}}" tabindex="0" >Visa Consultants</a></li> |
            <li><a title="Beauty Parlour Services" href="{{url('beauty-parlour-services')}}" tabindex="0" >Beauty Parlour Services</a></li> |
            <li><a title="Event Organisers" href="{{url('event-organisers')}}" tabindex="0" >Event Organisers</a></li> |
            <li><a title="Catering Services" href="{{url('catering-services')}}" tabindex="0" >Catering Services</a></li> |
            <li><a title="Photographers &amp; Videographers" href="{{url('photographers-videographers')}}" tabindex="0" >Photographers &amp; Videographers</a></li> |
            <li><a title="Astrologers" href="{{url('astrologers')}}" tabindex="0" >Astrologers</a></li> |
            <li><a title="Vehicle Rentals" href="{{url('vehicle-rental')}}" tabindex="0" >Vehicle Rentals</a></li> |
            <li><a title="Massage Centres" href="{{url('massage-centres')}}" tabindex="0" >Massage Centres</a></li> |
            <li><a title="Advocates &amp; Lawyers" href="{{url('advocates-lawyers')}}" tabindex="0" >Advocates &amp; Lawyers</a></li> 
            </ul>
            </div>
       
       <div><h4>Cities of (India)</h4>
            <ul><li><a title="Chennai" href="{{url('chennai')}}" tabindex="0" >Chennai</a></li>
            <li><a title="Mumbai" href="{{url('mumbai')}}" tabindex="0" >Mumbai</a></li>
            <li><a title="Hyderabad" href="{{url('hyderabad')}}" tabindex="0" >Hyderabad</a></li>
            <li><a title="Bangalore" href="{{url('bangalore')}}" tabindex="0" >Bangalore</a></li>
            <li><a title="Delhi" href="{{url('delhi')}}" tabindex="0" >Delhi</a></li>
            <li><a title="Kolkata" href="{{url('kolkata')}}" tabindex="0" >Kolkata</a></li>
            <li><a title="Pune" href="{{url('pune')}}" tabindex="0" >Pune</a></li>
            <li><a title="Ahmedabad" href="{{url('ahmedabad')}}" tabindex="0" >Ahmedabad</a></li>
            <li><a title="Faridabad" href="{{url('faridabad')}}" tabindex="0" >Faridabad</a></li>
            <li><a title="Ghaziabad" href="{{url('ghaziabad')}}" tabindex="0" >Ghaziabad</a></li>
            <li><a title="Noida" href="{{url('noida')}}" tabindex="0" >Noida</a></li>
            <li><a title="Gurgaon" href="{{url('gurgaon')}}" tabindex="0" >Gurgaon</a></li>
            <li><a title="Greater Noida" href="{{url('greaternoida')}}" tabindex="0" >Greater Noida</a></li>
            <li><a title="Chandigarh" href="{{url('chandigarh')}}" tabindex="0" >Chandigarh</a></li>
            <li><a title="Coimbatore" href="{{url('coimbatore')}}" tabindex="0" >Coimbatore</a></li>
            <li><a title="Jaipur" href="{{url('jaipur')}}" tabindex="0" >Jaipur</a></li>
            <li><a title="Nagpur" href="{{url('nagpur')}}" tabindex="0" >Nagpur</a></li>
            <li><a title="Surat" href="{{url('surat')}}" tabindex="0" >Surat</a></li>
            <li><a title="Vadodara" href="{{url('vadodara')}}" tabindex="0" >Vadodara</a></li>
            <li><a title="Vijayawada" href="{{url('vijayawada')}}" tabindex="0" >Vijayawada</a></li>
            <li><a title="Visakhapatnam" href="{{url('visakhapatnam')}}" tabindex="0" >Visakhapatnam</a></li>
            <li><a title="Indore" href="{{url('indore')}}" tabindex="0" >Indore</a></li>
            <li><a title="Lucknow" href="{{url('lucknow')}}" tabindex="0" >Lucknow</a></li></ul>
            </div>
        
            
            </div>
             </div>
		
	 
	<div class="footer-new">
        <div class="container-fluid">
            <div class="row">
        <div class="col-lg-9 col-md-12 col-sm-12">
        <h2>A Few Stats About <span> Quickindia </span></h2>
        <ul class="seoabout_listing">
        <li>
        <div class="image"><i class="fa fa-calendar" aria-hidden="true"></i></div>
        <h3>Since </h3>
        <h5>2023</h5>
        </li>
        <li class="returncustomer">
        <div class="image"><i class="fa fa-level-up" aria-hidden="true"></i></div>
        <h3>350+</h3>
        <h5>Register Business</h5>
        </li>

        <li class="returncustomer">
        <div class="image"><i class="fa fa-smile-o" aria-hidden="true"></i></div>
        <h3>200+</h3>
        <h5>Satisfied Clients </h5>
        </li>

        <li class="returncustomer">
        <div class="image"><i class="fa fa-mobile" aria-hidden="true"></i></div>
        <h3>6000+</h3>
        <h5>Business Keyword </h5>
        </li>

        <li class="returncustomer">
        <div class="image"><i class="fa fa-thumbs-up" aria-hidden="true"></i></div>
        <h3>200+ Years</h3>
        <h5>Team Experience
        </h5>
        </li>



        <li>
        <div class="image"><i class="fa fa-globe" aria-hidden="true"></i></div>
        <h3>Countries</h3>
        <h5>3+</h5>
        </li>


        </ul>
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12">
        <div class="footr-new-right">
        <div class="enquiry-img"><img src="{{url('images/enquiry-img.png')}}" alt="Project" width="100" height="100"></div>
        <h2>Do you have <br><span>any Requirement in your mind?</span></h2>
        <div class="footer-get"> <a href="{{url('business-owners')}}">Get Started </a>
        <span>or</span>  <a href="{{url('business-owners')}}">Get Quote</a></div>
        </div>
        </div>
        </div>
    </div>
    </div>
<footer>

<section class="address-box">
<div class="container">
<div class="col-md-12 col-sm-12 foot-new-link">         


<ul>
<li><a href="{{url('/about-us')}}" title="About Us">About Us</a></li>
<li><a href="{{url('/pricing')}}" title="pricing">Package Pricing</a></li>
<li><a href="{{url('/careers')}}"  title="Careers">Careers</a></li>
<li><a href="{{url('/contact-us')}}" title="Contact Us">Contact Us</a></li>
<li><a href="{{url('blog')}}" title="Blog">Blog</a></li> 
<li><a href="{{url('business-owners')}}" rel="nofollow" title="Advertise on quickindia">Advertise on Quickindia</a></li>
<!--<li><a href="{{url('official/terms-conditions')}}" title="Terms & Conditions">Terms & Conditions</a></li>-->
<li><a href="{{url('/privacy-policy')}}" title="Privacy Policy">Privacy Policy</a></li>
<li><a href="{{url('/copyright-policy')}}" title="Copyright Policy">Copyright Policy</a></li>
</ul>

</div>


</div>
</section>

    <section class="links-resp">
        <div class="paybox">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="follow-sticker">
                            <h4 style="color:#FFF;margin-bottom:10px;padding-bottom:5px;border-bottom:1px solid #aaa;">Follow Us</h4>
                           <ul class="list-inline">
                                <li><a class="facebook"  href="https://www.facebook.com//" title="Like us on Facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="twitter"  href="https://twitter.com/quickindia" title="Follow us on Twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="linkedIn"  href="https://www.linkedin.com/company/quickindia" title="Follow us on Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="youTube"  href="" title="Follow us on youTube"><i class="fa fa-youtube-play"></i></a></li>
                                <li><a class="pinterest"  href="https://in.pinterest.com/quickindia/" title="Follow us on Pinterest"><i class="fa fa-pinterest"></i></a></li>
                                <li><a class="instagram"  href="https://www.instagram.com/quickindia/" title="Follow us on Instagram"><i class="fa fa-instagram"></i></a></li>
                                <li><a class="quara"  href="https://www.quora.com/profile/quickindia" title="Follow us on Quara"><i class="fa fa-quora"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <h4 style="color:#FFF;margin-bottom:10px;padding-bottom:5px;border-bottom:1px solid #aaa;">Subscribe to our Newsletter</h4>
                        <form action="{{url('newsletter')}}" method="POST" onsubmit="return newsletter(this)">
                            <div class="input-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter Email">
                                <span class="input-group-btn">
                                        <input type="reset" class="hide" name="reset" />
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i></button>
                                    </span>
                            </div>
                            <em class="nl_err" style="color:red;padding-top:20px;"></em>
                        </form>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <h4 style="color:#FFF;margin-bottom:10px;padding-bottom:5px;border-bottom:1px solid #aaa;">We Accept Online Payments</h4>
                        <img src="<?php echo asset('client/images/payments.png'); ?>" class="img-responsive" style="max-width:240px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright-box col-lg-5">
                <div class="row">
                    <p>Copyrights © 2023. All Rights Reserved.</p>
                </div>
            </div>
            <div class="disclaimer-box col-lg-7">
                <div class="row">
                    <p>The certification names and logos are the trademarks of their respective owners. <a href="#">View Disclaimer</a></p>
                </div>
            </div>
        </div>
    </section>
</footer>
  
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

<!--login pass-->
 <!--
<div class="loginpopup">
    <div class="popwraper">
        <a href="javascript:void(0);" class="closebtn">&times;</a>
        <div class="col-xs-12 col-sm-5 col-md-5 formleft">
            <h2>Login</h2>
            <p>Get access to your Profile, Reviews and Recommendations</p>
        </div>
        <div class="col-xs-12 col-sm-7 col-md-7 formright">
            <form action="" method="POST" autocomplete="on" id="login-form" class="text-center">
                <div class="input-layout">
                    <input type="text" class="cleanup validate-empty" name="mobile" id="mobile" value="" required>
                    <span class="highlight"></span>
                    <label>Enter Registered Mobile</label>
                    <div class="alert alert-error alert-email" style="display: none;">Oops! Mobile is required.</div>
                </div>
              <div class="input-layout">
									<input type="password" class="cleanup validate-empty" name="password" id="password" value="" required>
									<span class="highlight"></span>
									<label>Enter Paasword</label>
									<div class="alert alert-error alert-email" style="display: none;">Oops! OTP is required.</div>
								</div>
                <div class="_1avdGP">
                    <button class="_39M2dMsubmit" type="submit" id="btn-login"> <span><span>Continue</span></span></button>
                </div>
                <button class="jUwFiZ" onclick="window.location.href='{{ url('business-owners') }}'"><span>New User? Sign up</span></button>
                <input class="hide" type="reset" name="reset" />
            </form>
        </div>
    </div>
</div>--> 
<!--OTP Send meassage-->
 
<div class="loginpopup">
    <div class="popwraper">
        <a href="javascript:void(0);" class="closebtn">&times;</a>
        <div class="col-xs-12 col-sm-5 col-md-5 formleft">
            <h2>Login</h2>
            <p>Get access to your Profile, Reviews and Recommendations</p>
        </div>
        <div class="col-xs-12 col-sm-7 col-md-7 formright">
            <form action="" method="POST" autocomplete="on" id="login-form" class="text-center">
                <div class="input-layout">
                    <input type="text" class="cleanup validate-empty" name="email" id="mobile" value="" required>
                    <span class="highlight"></span>
                    <label>Enter Registered Email</label>
                    <div class="alert alert-error alert-email" style="display: none;">Oops! Mobile is required.</div>
                </div>
              
                <div class="_1avdGP">
                    <button class="_39M2dMsubmit" type="submit" id="btn-login"> <span><span>Continue</span></span></button>
                </div>
                 <input class="hide" type="reset" name="reset" />
            </form>
           
               
        </div>
    </div>
</div> 

 <div id="messagemodel" class="modal fade" role="dialog" data-backdrop="static"><div class="modal-dialog"><div class="modal-content"><div class="modal-body" style="padding:0;"><button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 4px; top: 4px;opacity: 1; width: 35px; height: 35px; background: #fff; border-radius: 0 0 0 10px;"><span aria-hidden="true">×</span></button><div class="imgclass"></div><h3 style="text-align: center; font-size: 21px; font-weight: 600; margin-top: 16px;">Thank you for reaching out to us.</h3><div class="successhtml"></div><div class="failedhtml"></div><div style="text-align:center;"></div></div></div></div></div>
<script src="<?php echo asset('vendor/select2/js/select2.full.js'); ?>"></script>

<script src="<?php echo asset('admin/vendor/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo asset('admin/vendor/datatables-plugins/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo asset('admin/vendor/datatables-responsive/dataTables.responsive.js'); ?>"></script>

<script src="<?php echo asset('vendor/validation/validation.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('client/js/plugin.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('client/js/script.js'); ?>"></script>
<script src="<?php echo asset('client/js/owl.carousel.js'); ?>"></script>
<script>
    jQuery(document).ready(function() {
        jQuery('.owl-carousel').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 6,
                    nav: true
                },
                1000: {
                    items: 8,
                    nav: true,
                    loop: false,
                    margin: 10
                }
            }
        })
        $(function() {
            $('.carousel').carousel({
                interval: 2000
            });
        });
    })
</script>
<script>
    jQuery(document).on('click', '.mega-dropdown', function(e) {
        e.stopPropagation()
    })
</script>
<script>
    function tick1() {
        $('#ticker_01 li:first').slideUp(function() {
            $(this).appendTo($('#ticker_01')).slideDown();
        });
    }
    setInterval(function() {
        tick1()
    }, 3000);
    function tick2() {
        $('#ticker_02 li:first').slideUp(function() {
            $(this).appendTo($('#ticker_02')).slideDown();
        });
    }
    setInterval(function() {
        tick2()
    }, 3000);
    var w = jQuery(window).width();
    if (w > 768) {
        $(".navbar-default .navbar-nav > li > a").click(function() {
            $('html, body').animate({
                scrollTop: $(".customnav").offset().top - 62 + "px"
            }, 1300);
        });
    }
</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        // We only want these styles applied when javascript is enabled
        $('div.navigation').css({
            'width': '25%',
            'float': 'right'
        });
        $('div.content').css('display', 'block');
        // Initially set opacity on thumbs and add
        // additional styling for hover effect on thumbs
        var onMouseOutOpacity = 0.67;
        $('#thumbs ul.thumbs li').opacityrollover({
            mouseOutOpacity: onMouseOutOpacity,
            mouseOverOpacity: 1.0,
            fadeSpeed: 'fast',
            exemptionSelector: '.selected'
        });
        // Initialize Advanced Galleriffic Gallery
		if($('#thumbs').length){
			var gallery = $('#thumbs').galleriffic({
				delay: 2500,
				numThumbs: 15,
				preloadAhead: 10,
				enableTopPager: true,
				enableBottomPager: true,
				maxPagesToShow: 7,
				imageContainerSel: '#slideshow',
				controlsContainerSel: '#controls',
				captionContainerSel: '#caption',
				loadingContainerSel: '#loading',
				renderSSControls: true,
				renderNavControls: true,
				playLinkText: 'Play Slideshow',
				pauseLinkText: 'Pause Slideshow',
				prevLinkText: '&lsaquo; Previous Photo',
				nextLinkText: 'Next Photo &rsaquo;',
				nextPageLinkText: 'Next &rsaquo;',
				prevPageLinkText: '&lsaquo; Prev',
				enableHistory: false,
				autoStart: false,
				syncTransitions: true,
				defaultTransitionDuration: 900,
				onSlideChange: function(prevIndex, nextIndex) {
					// 'this' refers to the gallery, which is an extension of $('#thumbs')
					this.find('ul.thumbs').children()
						.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
						.eq(nextIndex).fadeTo('fast', 1.0);
				},
				onPageTransitionOut: function(callback) {
					this.fadeTo('fast', 0.0, callback);
				},
				onPageTransitionIn: function() {
					this.fadeTo('fast', 1.0);
				}
			});			
		}
    });
</script>
<script>
    $(function() {
        $('.bottom-icon a').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        
      /*  setTimeout(function() {	          
		   $('.inquiry-popup').click();		 
		   $('.clientBlock').click();
			    $('<div class="loginoverlay"></div>').insertBefore('.bestDealpopup');
				$('.bestDealpopup').addClass('dealshowup');
        }, 3000); 	
        */
        
        $('.serchlist-btn').click(function(e) {          
            $('<div class="loginoverlay"></div>').insertBefore('.bestDealpopup');
            $('.bestDealpopup').addClass('dealshowup');
        }); 
		
		$('.connected-right').click(function(e) {          
            $('<div class="loginoverlay"></div>').insertBefore('.connectedpopup');
            $('.connectedpopup').addClass('connectedshowup');
			$(".sub-header").css("visibility", "hidden");   
        });
		
		$('.banner_botton').click(function(e) {          
            $('<div class="loginoverlay"></div>').insertBefore('.banner_botton_open');
            $('.banner_botton_open').addClass('bannerbottonshowup');
			$(".sub-header").css("visibility", "hidden");   
        });
		
		
		
		
		
		$('.open-popup').click(function(e) {          
           $('<div class="loginoverlay"></div>').insertBefore('.bestDealpopup');
            $('.bestDealpopup').addClass('dealshowup');
        });
		$('.side-data-btn').click(function(e) {            
           $('<div class="loginoverlay"></div>').insertBefore('.bestDealpopup');
            $('.bestDealpopup').addClass('dealshowup');
        });
        $('.dealclosebtn').click(function(e) {
            $('.bestDealpopup').removeClass('dealshowup');
            $('.loginoverlay').fadeOut();
        }); 
		$('.closepop').click(function(e) {
            $('.bestDealpopup').removeClass('dealshowup');
            $('.loginoverlay').fadeOut();
        }); 
		
		$('.connectedclosebtn').click(function(e) {
            $('.connectedpopup').removeClass('connectedshowup');
            $('.banner_botton_open').removeClass('bannerbottonshowup');
			$(".sub-header").css("visibility", "visible");
            $('.loginoverlay').fadeOut();
        });
         
    });
</script>
<script>
    $(".select2-single").select2({
        theme: "bootstrap",
        placeholder: "Select a City",
        //maximumSelectionSize: 6,
        containerCssClass: ":all:",
        ajax: {
            url: "/cities/getajaxcities",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                }
            },
            processResults: function(data) {
                return {
                    results: $.map(data.cities, function(obj) {
                        if(obj.city){
                        return {
                            id: obj.city,
                            text: obj.city
                        };
                        }else{
                           return {
                            id: obj.zone,
                            text: obj.zone
                        }; 
                            
                        }
                    })
                }
            },
            cache: true
        }
    });
    $(".select2-single-state").select2({
        theme: "bootstrap",
        placeholder: "Select State",
        maximumSelectionSize: 6,
        containerCssClass: ":all:"
    });
    if(localStorage.getItem('city')){
        $('.cityList').val(localStorage.getItem('city'));
    }else{
        const apiKey = '3ad5f90d651b46f6877197d1c64b2129';
        if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const {latitude,longitude} = position.coords;
            console.log(latitude);
            console.log(longitude);
            const url = `https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=${apiKey}`;

            fetch(url)
            .then(response => response.json())
            .then(data => {          
                $(".cityList").val(data.results[0].components._normalized_city.toLowerCase());
            })
            .catch(error => {
            
            });
        }, function(error) {
            
        });
        }
    }
    $('.home-search').val(localStorage.getItem('keyword'));

   
</script>

   
</body>
</html>
