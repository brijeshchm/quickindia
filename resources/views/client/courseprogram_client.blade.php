@extends('client.layouts.app')

@section('title')
@if(!empty($part_id->meta_title))
<?php  
$key = preg_replace('/in {{city}}/i','',$part_id->meta_title);
echo trim($key);  ?>
@else

Quick India- {!!$part_id->parent_category or ""!!} Training in {{Request::segment(1)}} 
@endif  
@endsection 
@section('keyword')
<?php if(!empty($part_id->meta_keywords)){
$msg = preg_replace('/in {{city}}/i',' ',$part_id->meta_keywords);
echo trim($msg); }else{ ?>
Quick India- {!!$part_id->parent_category or ""!!} Training in {{Request::segment(1)}} 

<?php  } ?>
@endsection
@section('description')
<?php if(!empty($part_id->meta_description)){
$descrip = preg_replace('/{{city}}/i',' ',$part_id->meta_description);
echo trim($descrip); }else{ ?> 

Quick India- {!!$part_id->parent_category!!} Training in {{Request::segment(1)}} 

<?php  } ?>
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
        <h2 class="title">Service <span>{{ $part_id->parent_category}}</a></span> </h2>
       <br>
       
       
          <div class="category-box">
	   <div class="business-services">
	   	<ul class="content-list intent">	
	    
	    
		@if(!empty($subcategory))
			@foreach($subcategory as $child)
  @if(!empty($child->keyword))
	<li class="">
	   <?php  if(!empty($child->icon)){
                
         $data = json_decode($child->icon, true);
            if (!empty($data)) {
            ?>

            <img src="{{asset(''.$data['src'])}}" alt="{{ $data['name'] }}">

            <?php  }   } ?>
	    	<a href="{{generate_slug($child->keyword)}}" title="<?php if(!empty($child->keyword)) { echo $child->keyword; } ?>"  class="keystore"><?php if(!empty($child->keyword)) { echo $child->keyword; } ?></a> 
	    
	    
	      </li>@endif
	   
	   @endforeach
	   @endif
	   
	   </ul>
	   </div>
	   </div>
	   
	   
 
	   
	   
	   
	   
	   
	 
        <div class="clearfix"></div>
    </div>
    
      
    
    
    @if(!empty($part_id->faqq1))
		<div class="container"> 		 
		<div class="category-description">  
		<h4>FAQ:- <?php  if(!empty($part_id->parent_category)){ $key = preg_replace('/{{city}}/i',strtoupper($city),$part_id->parent_category); echo trim($key); } ?>  </h4> 
			<div itemscope itemtype="https://schema.org/FAQPage">
			<?php if(!empty($part_id->faqq1)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq1)){
			$faqq1 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$part_id->faqq1);
			echo trim($faqq1); } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" style="display: block;">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa1)){
			$faqa1 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$part_id->faqa1);
			echo trim($faqa1); } ?>
			 

			</div>
			</div>
			</div>
			<?php } ?>


			<?php if(!empty($part_id->faqq2)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq2)){
			$faqq2 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$part_id->faqq2);
			echo trim($faqq2); } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa2)){
			$faqa2 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$part_id->faqa2);
			echo trim($faqa2); } ?>
		 
			</div>
			</div>
			</div>
			<?php } ?>		
			<?php if(!empty($part_id->faqq3)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq3)){
			$faqq3 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$part_id->faqq3);
			echo trim($faqq3); } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa3)){
			$faqa3 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$part_id->faqa3);
			echo trim($faqa3); } ?>
			 
			</div>
			</div>
			</div>
			<?php } ?>		
			<?php if(!empty($part_id->faqq4)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq4)){
			$faqq4 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$part_id->faqq4);
			echo trim($faqq4); } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa4)){
			$faqa4 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$part_id->faqa4);
			echo trim($faqa4); } ?>
			 
			</div>
			</div>
			</div>
			<?php } ?>		
			<?php if(!empty($part_id->faqq5)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq5)){
			$faqq5 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$part_id->faqq5);
			echo trim($faqq5); } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa5)){
			$faqa5 = preg_replace('/{{city}}/i',ucfirst(Request::segment(1)),$part_id->faqa5);
			echo trim($faqa5); } ?>
		 
			</div>
			</div>
			</div>
			<?php } ?>


			</div>
		
		</div>
		
		 
		</div>
		@endif
     <div class="bestDealpopup"> 
		<?php 	

        $value = Cookie::get('showPopup');	 
 
			?>
        <a href="javascript:void(0);" class="dealclosebtn">&nbsp;</a> 

	   <h4>Need Expert Advice ?</h4>
        <div class="jbt"> Fill this form to Grab the best Deals on "<span class="orng"><?php echo $part_id->parent_category." in "; ?>{{Request::segment(1)}}</span>"</div>
        <div class="bdc">
        
            <form class="form-inline" action="" method="post" onsubmit="return homeController.saveEnquiry(this)">
                <aside>
		 
                    <p><label for="yn">Your Name <span>*</span></label>
						<input type="hidden" name="lead_form" value="1" />
						<input type="hidden" name="kw_text" value="<?php echo $part_id->parent_category; ?>" />
						<input type="hidden" name="city_id" class="city" value="{{Request::segment(1)}}" />
                        <input class="jinp" type="text" placeholder="Enter Full Name" name="name" value="">
                    </p>
                    <p>
                        <label for="ymn">Your Mobile<span>*</span></label>
                        <input class="jinp" type="text" placeholder="Enter Mobile" name="mobile" value="">
                    </p>
                    <p>
                        <label for="yei">Your Email ID <span></span></label>
                        <input class="jinp" type="text" placeholder="Enter Email" name="email" value="">
                    </p>
                    <p>
                        <label class="moblab">&nbsp;</label>
					 
						<input class="jbtn" type="submit" name="submit" value="Submit" />
						<input type="reset" class="reset_lead_form hide" value="reset" />
                         
                    </p>
                </aside>
            </form>
        </div>

        <section class="bdn">
            <aside class="jpb">
                <p>
                    <span class="bul"></span>Your number will be shared only to these experts
                </p>
                <p>
                    <span class="bul"></span> Get Free Expert Online Counseling</p>
                <p>
                    <span class="bul"></span> Get Free Demo Classes
                </p>
                <p>
                    <span class="bul"></span> Get Fees & Discounts
                </p>
            </aside>
        </section>
    </div>
    
@endsection