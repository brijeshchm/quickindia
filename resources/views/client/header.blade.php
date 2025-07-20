<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="csrf-token" content="<?php echo csrf_token(); ?>">
	<link rel="canonical" href="{{ URL::current() }}"/>
	<?php
	if(Route::getCurrentRoute()->uri() == '/'){
		echo "<title>quickind- Local search, IT Training, Playschool, overseas education</title>";
	}else{
		echo (isset($keyword))?"<title>".$keyword->meta_title."</title>":"<title></title>";
	}
	?>
	<meta http-equiv="content-language" content="en-IN">
	<meta name="classification" content="directory portal" />
	<meta name="distribution" content="local" />
	<meta content="All" name="WebCrawlers" />
	<meta content="All, FOLLOW" name="MSNBots" />
	<meta content="All" name="Googlebot-Image" />
	<meta content="All, FOLLOW" name="BINGBots" />
	<meta content="All, FOLLOW" name="YAHOOBots" />
	<meta content="All, FOLLOW" name="GoogleBots" />
	<meta name="copyright" content="quickind">
	<meta name="author" content="quickind" />
	<meta http-equiv="CACHE-CONTROL" content="PUBLIC" />
	<meta name="publisher" content="https://plus.google.com/b/117863031279904706665/" />
	<meta name="identifier-URL" content="{{url('/')}}">

	@if(Route::getCurrentRoute()->uri() == '/')
		<meta name="google-site-verification" content="fhy9s9bE1BIryEBpN91uj_Oik-M0KB-4yxF3-r7A_iQ" />
		<meta name="msvalidate.01" content="BB4E9B6304A4EFBF9E075F8AFA73178C" />
		<meta name="p:domain_verify" content="dfa20783ab3841e8b189a4672f058e29" />
	@endif

		<!---Google Tags Start-->
	<?php
	if(Route::getCurrentRoute()->uri() == '/'){
		?>
		<meta name="title" content="quickind- Local search, IT Training, Overseas Education, Playschool" />
		<meta name="description" content="quickind works as local search for education institutes like IT training institutes, playschool, upsc preparation, overseas education consultant, bank preparation, medical preparation, coaching and tuition.">
		<?php
	}else{
		?>
		<meta name="title" content="{{ (isset($keyword))?$keyword->meta_title:"" }}" />
		<meta name="description" content="{{ (isset($keyword))?$keyword->meta_description:"" }}">
		<?php
	}
	?>
	<meta name="keywords" content="{{ (isset($keyword))?$keyword->meta_keywords:"" }}" />
	<meta name="url" content="{{url('/')}}" />
		<!---Google Tags End-->
	
	@if(Route::getCurrentRoute()->uri() == '/')
	<meta name="DC.title" content="quickind -Find Best Suggestion, Play School & Day Care, Training Institutes, Overseas Education, Noida, Delhi NCR" />

	<link rel="canonical" href="{{url('/')}}" />

		<!--Twitter Card Tags Start-->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:image" content="/blueprint/images/social-banner-quickind.png">
	<meta name="twitter:creator" content="@quickindOfficial" />
	<meta name="twitter:title" content="quickind- Local search, IT Training, Playschool, overseas education" />
	<meta name="twitter:description" content="quickind works as local search for education institutes like IT training institutes, playschool, upsc preparation, overseas education consultant, bank preparation, medical preparation, coaching and tuition." />
	<meta name="twitter:keywords" content="it training institute, play school, day care, best play school in noida, preschool noida, overseas education, engineering courses." />
	<meta name="twitter:url" content="{{url('/')}}" />
		<!--Twitter Card Tags End-->

		<!--Facebook Tags Start-->
	<meta property="Locale" content="en_IN" />
	<meta property="fb:app_id" content="1879851965561649" />
	<meta property="og:url" content="{{url('/')}}" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="quickind- Local search, IT Training, Playschool, Overseas Education" />
	<meta property="og:description" content="quickind works as local search for education institutes like IT training institutes, playschool, upsc preparation, overseas education consultant, bank preparation, medical preparation, coaching and tuition." />
	<meta property="og:image" content="/blueprint/images/social-banner-quickind.png" />
		<!--Facebook Tags End-->

	<meta name="distribution" content="global" />
	<meta name="geo.region" content="IN-UP" />
	<meta name="geo.placename" content="Noida" />
	<meta name="geo.position" content="28.535516;77.391026" />
	<meta name="ICBM" content="28.535516, 77.391026" />

	<link rel="publisher" href="https://plus.google.com/101207635814475877620">
	<link rel="author" href="https://plus.google.com/101207635814475877620">
	<link rel="canonical" href="{{url('/')}}" />
	@endif

	<meta name="robots" content="index, follow" />
	<meta name="Revisit-after" content="7 Days" />
    <!-- SCRIPT-SPINNER -->  
	<script src="<?php echo asset('vendor/spinner/spin.min.js') ?>"></script>	
	<link rel="icon" href="/client/images/favicon.png" type="image/png"/>
	<link rel="shortcut icon" href="/client/images/favicon.png" type="image/png"/>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
	<link href="<?php echo asset('client/css/bootstrap.css'); ?>" rel="stylesheet">
	<!--link href="<?php //echo asset('client/fonts/font-awesome.min.css'); ?>" rel="stylesheet"-->
	<link href="<?php echo asset('vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo asset('client/customfont/stylesheet.css'); ?>" rel="stylesheet">
	<link href="<?php echo asset('vendor/select2/css/select2.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo asset('vendor/select2/css/select2-bootstrap.css'); ?>" rel="stylesheet">
	
    <!-- DataTables CSS -->
    <link href="<?php echo asset('admin/vendor/datatables-plugins/dataTables.bootstrap.css'); ?>" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="<?php echo asset('admin/vendor/datatables-responsive/dataTables.responsive.css'); ?>" rel="stylesheet">
	
	<script type="text/javascript" src="<?php echo asset('client/js/jquery-1.11.2.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('client/js/jquery.galleriffic.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('client/js/jquery.opacityrollover.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('client/js/bootstrap.min.js'); ?>"></script>
	
	<!--[if lt IE 9]>
		  <script src="<?php echo asset('client/js/html5shiv.min.js'); ?>"></script>
		  <script src="<?php echo asset('client/js/respond.min.js'); ?>"></script>
	<![endif]-->
	
    <script src="<?php echo asset('vendor/rgraph/RGraph.common.core.js'); ?>"></script>
    <script src="<?php echo asset('vendor/rgraph/RGraph.common.key.js'); ?>"></script>
    <script src="<?php echo asset('vendor/rgraph/RGraph.hbar.js'); ?>"></script>

    <script src="<?php echo asset('vendor/rgraph/RGraph.common.dynamic.js'); ?>"></script>
    <script src="<?php echo asset('vendor/rgraph/RGraph.common.tooltips.js'); ?>"></script>
    <script src="<?php echo asset('vendor/rgraph/RGraph.common.csv.js'); ?>"></script>
    <script src="<?php echo asset('vendor/rgraph/RGraph.line.js'); ?>"></script>
	
    <link href="<?php echo asset('client/css/style.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('client/css/owl.carousel.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('client/css/galleriffic-1.css'); ?>" type="text/css" />
    <link href="<?php echo asset('client/css/login-popup.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('client/css/media.css'); ?>" rel="stylesheet">
 
	@if(\Route::current()->getName()=='home-page')
	<script type="application/ld+json">
		{
		  "@context": "http://schema.org",
		  "@type": "Organization",
		  "url": "https://www.quickind.com",
		//  "logo": "https://quickind.com/client/images/logo.png",
		  "contactPoint" : [
			{ "@type" : "ContactPoint",
			  "telephone" : "+91-90581 00001",
			  "contactType" : "customer service"
			} ],
			"sameAs" : [ "https://www.facebook.com/quickindOfficial",
			"https://twitter.com/quickindOfficial",
			"https://www.linkedin.com/company/quickindofficial"
			]	   
		}
	</script>
	@endif
	@if(\Route::current()->getName()=='search-list')
	<script type="application/ld+json">
		{
			"@context": "http://schema.org/",
			"@type": "webpage",
			"name": "{{ $keyword->keyword or "" }} in {{ $searchedInCity->city or "" }}",
			"image":"{{ asset('client/images/star_5.png') }}",
			"description": "{{ $keyword->keyword or "" }} in {{ $searchedInCity->city or "" }}",
			"aggregateRating": {
			"@type": "AggregateRating",
			"ratingValue": "4.5",
			"bestRating": "5",
			"ratingCount": "700"
			}
		}
	</script>
	@endif
<!------Google Analytic Script Start----->
 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-97092102-1', 'auto');
  ga('send', 'pageview');

</script>
<!------Google Analytic Script End----->
</head>

<body>    <!-- SPINNER -->    <div id="spinnerBkgd"></div>    <div id="spinnerCntr"></div>    <!-- SPINNER -->	
    <header id="header">
        <div class="container">
            <div class="logo">

                <h1 title="quickind">
                  
                    <a href="{{ url('/') }}"><img src="<?php echo asset('client/images/quickind-logo.png'); ?>" alt="" class="img-responsive" /><div class="logo-text">quickind<sup>.com</sup></div></a>
                </h1>
            </div>
            <div class="logo-sm">
                <h1 title="quickind">
                    <a href="{{ url('/') }}"><img src="<?php echo asset('client/images/quickind-logo.png'); ?>" alt="" class="img-responsive" /><div class="logo-text">quickind<sup>.com</sup></div></a>
                </h1>
            </div>
			<?php if(Auth::guard('clients')->check()): ?>
				<div class="head-right">
					<strong>Welcome :</strong>
					<a href="{{ url('client-detail/'.auth()->guard('clients')->user()->business_slug) }}" class="" title="{{ auth()->guard('clients')->user()->business_name }}">{{ substr(auth()->guard('clients')->user()->business_name,0,14) }}{{ (strlen(auth()->guard('clients')->user()->business_name)>15)?"...":"" }} <i class="fa fa-fw fa-user" aria-hidden="true"></i></a>
					<ul class="setting-dd">
						<li><i class="fa fa-user" aria-hidden="true"></i><a href="{{ url('business-owners') }}">Edit Profile</a></li>
						<li><i class="fa fa-crosshairs" aria-hidden="true"></i><a href="{{ url('business-owners/changepassword') }}">Change Password</a></li>
						<li class="lgout-line-up"><i class="fa fa-gear" aria-hidden="true"></i><a href="javascript:void(0)">Settings</a></li>
						<li class="lgout"><a href="{{ url('client/logout') }}">Logout</a></li>
					</ul>	
				</div>
			<?php else: ?>
				<div class="head-right-lout"> <a href="#" id="login">Sign In</a> / <a href="{{ url('business-owners') }}">Sign Up</a> </div>
			<?php endif; ?>
        </div>
    </header>
    <div class="scrollheadsearch<?php echo (Route::getCurrentRoute()->uri() != '/')?' fixedform':''; ?>">
        <div class="filterForm">
            <form action="/searchlist" method="GET" class="search-form" autocomplete="off">
                <select class="select2-single location locationbtn city" name="city">
					<optgroup label="Popular Cities">
						<option value="">Select City</option>
						@if(count($cities)>0)
							@foreach($cities as $citys)
						<option value="{{strtolower($citys->city)}}" <?php  if(strtolower(str_replace("-"," ",Request::segment(1))) == strtolower($citys->city)){  echo "selected"; }elseif(strtolower($location['geoplugin_city']) == strtolower($citys->city)){ echo "selected";
								}  ?>>{{$citys->city}}</option>
							@endforeach
						@endif
					</optgroup>
				</select>
                <input type="text" placeholder="What service you need today!" class="col-md-7 serviceneed home-search" name="search_kw">
                <input type="submit" class="col-md-2 submitbtn" value="GO">
				<div class="ajax-suggest" style="display: none;"><ul></ul></div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>