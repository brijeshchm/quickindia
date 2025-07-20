<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>GrewBox</title>

<!-- Bootstrap -->
<link href="<?php echo asset('client/css/bootstrap.css'); ?>" rel="stylesheet">
<link href="<?php echo asset('client/fonts/font-awesome.min.css'); ?>" rel="stylesheet">
<link href="<?php echo asset('client/customfont/stylesheet.css'); ?>" rel="stylesheet">
<!-- Select2 Core CSS -->
<link href="<?php echo asset('vendor/select2/css/select2.min.css'); ?>" rel="stylesheet">
<!-- Select2-Bootstrap CSS -->
<link href="<?php echo asset('vendor/select2/css/select2-bootstrap.css'); ?>" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo asset('client/js/jquery-1.11.2.min.js'); ?>"></script>

<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
<link href="<?php echo asset('client/css/bo/business-owner-style.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('client/css/owl.carousel.css'); ?>">
<link href="<?php echo asset('client/css/bo/media.css'); ?>" rel="stylesheet">

</head>
<body>
<header id="header">
<div class="business-scrollheadsearch showform">
<div class="filterForm">
<form>
<select class="select2-single location locationbtn">
	<optgroup label="Popular Cities">
		<option>Delhi</option>
		<option>Agra</option>
		<option selected>Noida</option>
		<option>Aligarh</option>
		<option>Jhansi</option>
		<option>Bangalore</option>
	</optgroup>
</select>
<input type="text" placeholder="What service you need today!" class="col-md-7 serviceneed">
<input type="submit" class="col-md-2 submitbtn" value="GO">
</form>
<div class="clearfix"></div>
</div>
</div>


<div class="container">
<div class="logo">
    <a href="index.html">
        <img src="<?php echo asset('client/images/gb_logo.png'); ?>" alt=""/>
    </a>
</div>
<div class="head-right">
    <a href="{{ url('business-owners') }}" class="freelisting">Free Listing</a>
    |
    <a href="#">Sign In</a>
    | 
    <a href="business-owners.html">Sign Up</a>
</div>
</div>
</header>
<!--header id="header">
<div class="container">
<div class="logo">
    <a href="index.html">
        <img src="<?php //echo asset('client/images/gb_logo.png'); ?>" alt=""/>
    </a>
</div>
<div class="head-right">
    <a href="#" class="freelisting">Free Listing</a>
    |
     <a href="#" id="login">Sign In</a>
    | 
    <a href="#signup">Sign Up</a>
</div>
</div>
</header>

<div class="business-scrollheadsearch showform">
<div class="filterForm">
<form>
<select class="select2-single location locationbtn">
	<optgroup label="Popular Cities">
		<option>Delhi</option>
		<option>Agra</option>
		<option selected>Noida</option>
		<option>Aligarh</option>
		<option>Jhansi</option>
		<option>Bangalore</option>
	</optgroup>
</select>
<input type="text" placeholder="What service you need today!" class="col-md-7 serviceneed">
<input type="submit" class="col-md-2 submitbtn" value="GO">
</form>
</div>
</div-->