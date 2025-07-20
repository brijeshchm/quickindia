@extends('client.layouts.app')
@section('title')
Quick India- Business Services
@endsection 
@section('keyword')
Quick India-  Business Services list 
@endsection
@section('description'),  
Quick India- Business Services POPULAR CATEGORIES, B2B & BUSINESS SERVICES
@endsection
@section('content')	
	<style>
		.inner-client-div .grid-info h3{
			height:auto;
		}
		.inner-client-div .grid-info .get-quotes{
			margin-top:-25px;
		}
		.font-11{
			font-size:11px;
		}
		.course-program ul li {
        	border: 0.5px solid#ccc;
            padding: 12px 14px;
            text-align: center;
            margin: 5px 0px 24px 70px;
            display: inline-flex;
            grid-gap: 46px 106px;
            box-shadow: 0 0 10px 0 #e3e3e3;
		    
		}
		.course-program ul li:hover{ background: linear-gradient(180deg, #ecf4f3, #f1f5f5)
		  }
	</style>
	
	<div class="container">
        <div class="row"> 
            <div class="col-xs-12 col-sm-12 col-md-12 third-add-section">
               
                 <?php  
                    if(!empty($part_id->child_banner)){
                    $cicons= unserialize($part_id->child_banner); 
                    if (!empty($cicons)) {
                    ?>
                    
                    <img src="{{asset(''.$cicons['child_banner']['src'])}}">
                    
                    <?php  }else{ ?>
                    
                    <img src="<?php echo asset('client/images/computer-courses-training.jpg'); ?>">
                    <?php  } }else{ 
                        
                        if(!empty($part_id->category_banner)){
                    $cicons= unserialize($part_id->category_banner); 
                    if($cicons){
                    ?>
                    
                    <img src="{{asset(''.$cicons['category_banner']['src'])}}">
                    
                    
                    <?php  } }else{  ?>
                    <img src="<?php echo asset('client/images/computer-courses-training.jpg'); ?>">
                    
                    <?php } } ?>  
                </div>
        </div>
    </div>
  
    <div class="container">
        <div class="clearfix"></div>
        <h2 class="title">Our  <span>Business Services</a></span> </h2>
       <br>
       
       
        <div class="category-box">
	   <div class="business-services">
	   	<ul class="content-list intent">	
	    
	    
		@if(!empty($childCategory))
			@foreach($childCategory as $child)
  @if(!empty($child->keyword))
	<li class="">
	   <?php  if(!empty($child->icon)){
                
         $data = json_decode($child->icon, true);
            if (!empty($data)) {
            ?>

            <img src="{{asset(''.$data['src'])}}" alt="{{ $data['name'] }}">

            <?php  }   } ?>
	    	<a href="{{generate_slug($child->keyword)}}" title="<?php if(!empty($child->keyword)) { echo $child->keyword; } ?>" class="keystore"><?php if(!empty($child->keyword)) { echo $child->keyword; } ?></a> 
	    
	    
	      </li>@endif
	   
	   @endforeach
	   @endif
	   
	   </ul>
	   </div>
	   </div>
	   
	   
	  
	   
	   
	   
	   
	   
	   
	 
        <div class="clearfix"></div>
    </div>
    
       
@endsection