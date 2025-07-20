@extends('client.layouts.app')
@section('title')
@if(!empty($part_id->meta_title))	
<?php   
$key = preg_replace('/in {{city}}/i','',$part_id->meta_title);
echo trim($key);   ?>
@else
	@if(!empty($part_id->parent_category)){!!$part_id->parent_category!!}@endif  

@endif
@endsection 
@section('keyword')
<?php if(!empty($part_id->meta_keywords)){
$msg = preg_replace('/in {{city}}/i',' ',$part_id->meta_keywords);
echo trim($msg); } ?>
@endsection
@section('description')
<?php if(!empty($part_id->meta_description)){
$descrip = preg_replace('/{{city}}/i',' ',$part_id->meta_description);
echo trim($descrip); } ?> 
@endsection
@section('content')	

<?php $location =  json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$_SERVER['REMOTE_ADDR']}")); 

//echo "<pre>";print_r($location);die;

 
?>
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
        <div class="col-xs-12 col-sm-12 col-md-12 form-section">
            <div class="col-xs-9 col-sm-9 col-md-9 removeLeftSpace">
                <h1 class="hdTitle">				 
					<a href="{{url('')}}/<?php if(!empty($part_id->parent_category)) { echo generate_slug($part_id->parent_category); } ?>" ><?php if(!empty($part_id->parent_category)) { echo $part_id->parent_category; } ?></a> 

                        @if(!empty($part_id)) 	 
                        <?php
                        $rating = $part_id->ratingvalue;
                        $stars = 'star_4.75_new.png';
                        $ext = '.png'; 
                        switch($rating){  
                        case 0:
                        $stars = 'star_1'.$ext;
                        break;
                        case 2:
                        $stars = 'star_2'.$ext;
                        break;
                        case 3:
                        $stars = 'star_3'.$ext;
                        break;
                        case 3.5:
                        $stars = 'star_3.5_new'.$ext;
                        break;
                        case 4:
                        $stars = 'star_4'.$ext;
                        break;
                        case 4.5:
                        $stars = 'star_4.5_new'.$ext;
                        break;
                        case 4.75:
                        $stars = 'star_4.75_new'.$ext;
                        break;
                        case 5:
                        $stars = 'star_5_new'.$ext;
                        break;
                        }
                        ?>
				 
				 	<div itemscope itemtype="https://schema.org/Product" style="font-size: 12px;font-weight: 500;">
			 
				<div itemprop="aggregateRating"
				itemscope itemtype="https://schema.org/AggregateRating">
				<img itemprop="image" src="{{ asset('client/images/'.$stars) }}"  alt="5 Star Rating: Very Good"/>
				<span itemprop="ratingValue"><?php if(!empty($part_id->ratingvalue)) { echo number_format((float)$part_id->ratingvalue, 1, '.', '');  }else{ echo "1.0"; } ?></span>
				out of <span itemprop="bestRating"></span>
				based on <span itemprop="ratingCount">{{$part_id->ratingcount or ""}}</span> ratings
				</div>    
				</div>
				
					 
@endif
			 </h1>
            </div>
              
 
        </div>
       
	 
    </div>
   
    
	   
	    <div class="container">
      
 
       
       
        <div class="category-box">
	   <div class="business-services">
	   	<ul class="content-list intent">	
	   	
	    
		@if(!empty($businessServices))
			@foreach($businessServices as $parent)
 
	<li class=""><?php  if(!empty($parent->pc_icon)){
                    $cicons= unserialize($parent->pc_icon); 
                    if (!empty($cicons)) {
                    ?>
                    
                    <img src="{{asset(''.$cicons['pc_icon']['src'])}}" alt="{{ $cicons['pc_icon']['name'] }}" style="width:30px">
                    
                    <?php  }else{ ?>
                    
                    <img src="<?php echo asset('images/it-training.png'); ?>">
                    <?php  } } ?><a href="{{url('/child/'.$parent->child_slug)}}" title="<?php if(!empty($parent->child_category)){  echo $parent->child_category; } ?>" ><?php if(!empty($parent->child_category)){  echo $parent->child_category; } ?></a> </li>
	   
	   @endforeach
	   @endif
	   
	   </ul>
	   </div>
	   </div>
	   </div>
	   
	   
	   <div class="container">

        <div class="col-sm-9 col-md-9 reviews-box-main mainContainer">
            <a href="#top"></a>
			@if(!empty($clientsList))
				<?php $n=0;?>
				@foreach($clientsList as $client)
				
				<div class="col-sm-12 col-md-12 reviews-box-1 line-content">
				    <div class="client-list-first">
					<div class="col-sm-4 col-md-4 serchlist-img "><a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name or ""}}">
						<?php if(null != $client->logo){
							$profilePic = unserialize($client->logo);
							?><img src="<?php echo asset(''.$profilePic['large']['src']); ?>" alt="{{$client->business_name}}" title="{{$client->business_name}}" height="141" /><?php
						}else{
							?><img src="<?php echo asset('client/images/default_pp_small.jpg'); ?>" alt="Business Logo" title="Business Logo" height="141" style="width:100%" /><?php
						}
						?>
						@if($client->client_type != 'FreeListing')
						<p><a href="#"><i class="fa fa-fw fa fa-thumbs-up serchlist-location-icon" aria-hidden="true"></i></a></p>
						@endif
						</a>
					</div>
					<div class="col-sm-6 col-md-6 aboutcomp">
				 
				 
						<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name or ""}}">
							<span class="serchlist-txt-1">
								<i class="fa fa-fw fa-university serchlist-icon" aria-hidden="true"></i>						 							
								<?php echo ucfirst(strtolower(substr($client->business_name,0,28)));?>  
							</span>
							<?php
								$badge = $client->sold_on_position;
							?>
						 
							 
						</a>
				 
						<div class="certified" <?php if($client->certified_status==1){ ?> style="background-image: url(../client/images/certified-icon.png);" <?php } ?>>
						 
						<?php
							$arr=[];
							if(!empty($client->address)){
								$arr['address'] = $client->address;
							}
							if(!empty($client->landmark)){
								$arr['landmark'] = $client->landmark;
							}
							if(!empty($client->city)){
								$arr['city'] = $client->city;
							}
							if(!empty($client->state)){
								$arr['state'] = $client->state;
							}
							if(!empty($client->country)){
								$arr['country'] = $client->country;
							}
							$addr = getAddress($arr,30);
							if($addr->ispositiveresponse){
							?>
								<div class="serchlist-txt">
									<i class="fa fa-fw fa fa-street-view icon" aria-hidden="true"></i>
									<?php if($addr->issubstr): ?>
										<a href="{{ url('business-details')."/".$client->business_slug }}">{{ ucfirst(strtolower($addr->substr)) }}</a>
										<a href="#" data-toggle="tooltip" data-placement="bottom" title="{{ $addr->fullstr }}">more</a>
									<?php else: ?>
										<a href="{{ url('business-details')."/".$client->business_slug }}">{{ ucfirst(strtolower($addr->substr)) }}</a>
									<?php endif; ?>
								</div>
							<?php						
							}
						?>
						 
						 
						<div class="serchlist-txt"><i class="fa fa-fw fa-clock-o serchlist-icon" aria-hidden="true"></i>
							<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name or ""}}"><span class="serchlist-txt">
							<?php
							if(!empty($client->time)){
								$times = unserialize($client->time);
								$today =  strtolower(date('l'));
								echo "Opening Hrs (".$times[$today]['from']." - ".$times[$today]['to'].")";
							}else{
								echo "No working hours available";
							}
							?>
							</span></a>
						</div>
							<div class="serchlist-txt" >
							<i class="fa fa-fw fa fa-cog serchlist-icon" aria-hidden="true"></i>
							<span class="serchlist-txt">
								<div class="col-md-12 service-text" >
								<ul>
								<?php
								
						$assignedKwds = DB::table('assigned_kwds')
							  ->join('keyword','keyword.id','=','assigned_kwds.kw_id')
							  ->join('child_category','child_category.id','=','assigned_kwds.child_cat_id')
							  ->select('keyword.keyword','child_category.child_category as child_category_name')
							  ->where('assigned_kwds.client_id','=',$client->id)
							  ->limit(2)
							  ->get();

 

					  
									$firstHalf = [];
									$secondHalf = [];
									$i = 1;
									$inPopupArr = [];
									foreach($assignedKwds as $assignedKwd){										 
												 ?>
								
										 <li>
											<a href="<?php echo generate_slug($assignedKwd->keyword) ?>" title="{{$assignedKwd->keyword}}" class="keystore"><?php echo $assignedKwd->keyword; ?></a>
										</li>
												 
												 
												 <?php  }  ?>
							</ul>
									</div>
							
									 
							 </span>
						</div>
						</div>
					 
						<div class="serchlist-txt-btn"><a href="javascript:void(0);" title="{{$client->business_name or ""}}" class="sms-view open-popup"><span>Enquiry Now</span></a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" title="{{$client->business_name or ""}}" class="whatsapp-view open-popup"><span><i class="fa fa-whatsapp"></i> WhatsApp</span></a> &nbsp;&nbsp;&nbsp;<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name or ""}}" class="sms-view"><span>Vew Details</span></a></div>
					
					 
					</div>
					</div>
                    <div class="client-list-second" >
					<div class="col-sm-2 col-md-2 btnBox">
						<a href="{{ url('business-details')."/".$client->business_slug }}"><span class="serchlist-txt-1">User Rating</span></a>
						<div class="serchlist-txt">
							<?php
								if($client->comment_count>0){
									$avgRating = ($client->rating/(5*$client->comment_count))*5;
									$avgRating = number_format($avgRating, 1, '.', '');
									$whole = floor($avgRating);
									$fraction = $avgRating - $whole;
									$remain = 5-$whole;
									for($i=0;$i<$whole;++$i){
									 
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar fullstar'></a>";
									}
									if($fraction>0&&$fraction<1){
								 
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar halfstar'></a>";
										--$remain;
									}
									for($i=0;$i<$remain;++$i){
									 
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar'></a>";
									}
								}else{
									$avgRating = 0.0;
									for($i=0;$i<5;++$i){
									 
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar'></a>";
									}									
								}
							?>
					 
							<a href="{{ url('business-details')."/".$client->business_slug }}"><span class="serchlist-rating">({{$avgRating or "0"}} Rating out of {{$client->comment_count or "0"}} Votes)</span></a>
						</div>
					<button class="serchlist-btn" title="Best Offer {{$client->business_name or ""}}">Enquiry Now</button>
					</div>

					<div class="col-sm-12 col-md-12" style="padding-left:0;">
						<div class="clickBlick"><a href="{{ url('business-details').'/'.$client->business_slug.'/#rewandrate' }}" title="{{$client->business_name or ""}}"><i class="fa fa-fw fa fa-sun-o" aria-hidden="true"></i></a><a href="{{ url('business-details').'/'.$client->business_slug.'/#rewandrate' }}" title="{{$client->business_name or ""}}"><span>Click here to view your friend rating</span></a></div>
					</div>
					
					</div>
				</div>
				@endforeach
			@endif
				 
			
            <ul id="pagin" ></ul>
            <style>
            .current .btn-info{
            color: green;
            }
            
            #pagin li {
            display: inline-block;
            padding: 6px;
            margin: 5px;
            background-color: #C94A30; 
            }
            
            #pagin li a{
            color: #fff;
            }
            </style>
 <script>
 
//Pagination
	pageSize = 10;
	var pageCount =  $(".line-content").length / pageSize;
    
     for(var i = 0 ; i<pageCount;i++){
        
       $("#pagin").append('<li><a href="#top">'+(i+1)+'</a></li> ');
     }
        $("#pagin li").first().find("a").addClass("current")
    showPage = function(page) {
	    $(".line-content").hide();
	    $(".line-content").each(function(n) {
	        if (n >= pageSize * (page - 1) && n < pageSize * page)
	            $(this).show();
	    });        
	}
    
	showPage(1);

	$("#pagin li a").click(function() {
	    $("#pagin li a").removeClass("current btn btn-info");
	    $(this).addClass("current btn btn-info");
	    showPage(parseInt($(this).text())) 
	});
	</script>
			
			
 
			@if(!empty($onlyClients))
				@foreach($onlyClients as $client)
				<div class="col-sm-12 col-md-12 reviews-box-1">
					<div class="col-sm-4 col-md-4 serchlist-img "><a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name or ""}}">
						<?php if(!empty($client->logo)){
							$profilePic = unserialize($client->logo);
							?><img src="<?php echo asset($profilePic['large']['src']); ?>" alt="Logo" height="141" /><?php
						}else{
							?><img src="<?php echo asset('client/images/default_pp_small.jpg'); ?>" alt="Logo" height="141" style="width:100%" /><?php
						}
						?>
						@if($client->client_type != 'FreeListing')
						<p><a href="javascript:void(0)"><i class="fa fa-fw fa fa-thumbs-up serchlist-location-icon" aria-hidden="true"></i></a></p>
						@endif
						</a>
					</div>
					 <div class="col-sm-5 col-md-5 aboutcomp">
			 
						 
						<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name or ""}}">
							<span class="serchlist-txt-1">
								<i class="fa fa-fw fa-university serchlist-icon" aria-hidden="true"></i>						 							
								<?php echo ucfirst(substr($client->business_name,0,28));?>
							</span>
						 
							<img src="<?php echo asset('client/images/preferred.png'); ?>" >	 
							 
						</a>
				 
						<div class="certified" <?php if($client->certified_status==1){ ?> style="background-image: url(../client/images/certified-icon.png);" <?php } ?>>
						 
						<?php
							$arr=[];
							if(!empty($client->address)){
								$arr['address'] = $client->address;
							}
							if(!empty($client->landmark)){
								$arr['landmark'] = $client->landmark;
							}
							if(!empty($client->city)){
								$arr['city'] = $client->city;
							}
							if(!empty($client->state)){
								$arr['state'] = $client->state;
							}
							if(!empty($client->country)){
								$arr['country'] = $client->country;
							}
							$addr = getAddress($arr,30);
							if($addr->ispositiveresponse){
							?>
								<div class="serchlist-txt">
									<i class="fa fa-fw fa fa-street-view icon" aria-hidden="true"></i>
									<?php if($addr->issubstr): ?>
										<a href="{{ url('business-details')."/".$client->business_slug }}">{{ $addr->substr }}</a>
										<a href="#" data-toggle="tooltip" data-placement="bottom" title="{{ $addr->fullstr }}">more</a>
									<?php else: ?>
										<a href="{{ url('business-details')."/".$client->business_slug }}">{{ $addr->substr }}</a>
									<?php endif; ?>
								</div>
							<?php						
							}
						?>
						 
						 
						<div class="serchlist-txt"><i class="fa fa-fw fa-clock-o serchlist-icon" aria-hidden="true"></i>
							<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name or ""}}"><span class="serchlist-txt">
							<?php
							if(!empty($client->time)){
								$times = unserialize($client->time);
								$today =  strtolower(date('l'));
								echo "Opening Hrs (Today ".$times[$today]['from']." - ".$times[$today]['to'].")";
							}else{
								echo "No working hours available";
							}
							?>
							</span></a>
						</div>
							<div class="serchlist-txt" >
							<i class="fa fa-fw fa fa-cog serchlist-icon" aria-hidden="true"></i>
							<span class="serchlist-txt">
								<div class="col-md-12 service-text" >
								<ul>
								<?php
								
						$assignedKwds = DB::table('assigned_kwds')
							  ->join('keyword','keyword.id','=','assigned_kwds.kw_id')
							  ->join('child_category','child_category.id','=','assigned_kwds.child_cat_id')
							  ->select('keyword.keyword','child_category.child_category as child_category_name')
							  ->where('assigned_kwds.client_id','=',$client->id)
							  ->limit(2)
							  ->get();

 

					  
									$firstHalf = [];
									$secondHalf = [];
									$i = 1;
									$inPopupArr = [];
									foreach($assignedKwds as $assignedKwd){										 
												 ?>
								
										 <li>
											<a href="<?php echo generate_slug($assignedKwd->keyword) ?>" title="{{$assignedKwd->keyword}}" class="keystore"><?php echo $assignedKwd->keyword; ?></a>
										</li>
												 
												 
												 <?php  }  ?>
							</ul>
									</div>
							
									 
							 </span>
						</div>
						</div>
					 
						<div class="serchlist-txt-btn"><a href="javascript:void(0);" title="{{$client->business_name or ""}}" class="sms-view open-popup"><span>Enquiry Now</span></a>&nbsp;&nbsp;&nbsp;<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name or ""}}" class="sms-view"><span>View Details</span></a></div>
					
					 
					</div>

					<div class="col-sm-2 col-md-2 btnBox">
						<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name or ""}}"><span class="serchlist-txt-1">User Rating</span></a>
						<div class="serchlist-txt">
							<?php
								if($client->comment_count>0){
									$avgRating = ($client->rating/(5*$client->comment_count))*5;
									$avgRating = number_format($avgRating, 1, '.', '');
									$whole = floor($avgRating);
									$fraction = $avgRating - $whole;
									$remain = 5-$whole;
									for($i=0;$i<$whole;++$i){
									 
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar fullstar'></a>";
									}
									if($fraction>0&&$fraction<1){
								
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar halfstar'></a>";
										--$remain;
									}
									for($i=0;$i<$remain;++$i){
							
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar'></a>";
									}
								}else{
									$avgRating = 0.0;
									for($i=0;$i<5;++$i){
								
										echo "<a href='".url('business-details')."/".$client->business_slug."' class='emptystar'></a>";
									}									
								}
							?>
							
							<a href="{{ url('business-details')."/".$client->business_slug }}" title="{{$client->business_name or ""}}"><span class="serchlist-rating">({{$avgRating or "0"}} Rating out of {{$client->comment_count or "0"}} Votes)</span></a>
						</div>
						<button class="serchlist-btn">Best Offer</button>
					</div>

					<div class="col-sm-12 col-md-12" style="padding-left:0;">
						<div class="clickBlick"><a href="{{ url('business-details').'/'.$client->business_slug.'/#rewandrate' }}"><i class="fa fa-fw fa fa-sun-o" aria-hidden="true"></i></a><a href="{{ url('business-details').'/'.$client->business_slug.'/#rewandrate' }}" title="{{$client->business_name or ""}}"><span>Click here to view your friend rating</span></a></div>
					</div>
				</div>
				@endforeach
			@endif
        </div>
        <style>
        .rightsidedata{
      
        }
        </style>
        <div class="col-sm-3 col-md-3 side-data reviews-box-1 scroll-on rightsidedata">
       
         <style>
         .form-side strong{ color:#0076d7; }
         .form-side{   
            border: 1px solid #ddd;
            border-radius: 5px; 
             
         }
         .side-row-form {
            margin-top: 10px;
            
            text-align: center;
            display: grid
        ;
        }
         </style>
        <div class="side-row-form ">
       
 
      
			 
        </div>
    </div>
    </div>
	  
	  
	   
	   	@if(!empty($part_id->faqq1))
		<div class="container"> 		 
		<div class="category-description">  
		<h4>FAQ:- <?php  if(!empty($part_id->parent_category)){ echo $part_id->parent_category; } ?> </h4> 
			<div itemscope itemtype="https://schema.org/FAQPage">
			<?php if(!empty($part_id->faqq1)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq1)){
			echo $part_id->faqq1;
		  } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" style="display: block;">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa1)){
			echo $part_id->faqa1;
			  } ?>
			 

			</div>
			</div>
			</div>
			<?php } ?>


			<?php if(!empty($part_id->faqq2)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq2)){
		echo $part_id->faqq2; } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa2)){
			echo $part_id->faqa2;
			 } ?>
		 
			</div>
			</div>
			</div>
			<?php } ?>		
			<?php if(!empty($part_id->faqq3)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq3)){
			echo $part_id->faqq3;
		     } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa3)){
		echo $part_id->faqa3;
			 } ?>
			 
			</div>
			</div>
			</div>
			<?php } ?>		
			<?php if(!empty($part_id->faqq4)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq4)){
			echo $part_id->faqq4;
		         } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa4)){
			echo $part_id->faqa4;
		  } ?>
			 
			</div>
			</div>
			</div>
			<?php } ?>		
			<?php if(!empty($part_id->faqq5)){ ?>
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			<h5 itemprop="name"><strong><?php  if(!empty($part_id->faqq5)){
			echo $part_id->faqq5;
			 } ?>?</strong></h5>
			<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<div itemprop="text">
			<?php  if(!empty($part_id->faqa5)){
			echo $part_id->faqa5;
			 } ?>
		 
			</div>
			</div>
			</div>
			<?php } ?>


			</div>
		
		</div>
		
		 
		</div>
		@endif
	 
	   
	   
	   
	 
        <div class="clearfix"></div>
    </div>
    
       	  
<div class="inquiry-popup"></div>

    <div class="bestDealpopup"> 
		<?php 	

$value = Cookie::get('showPopup');	 
	//	if(Auth::guard('clients')->check() || ($value =="yes"))
			?>
        <a href="javascript:void(0);" class="dealclosebtn">&nbsp;</a> 

	   <h4>Need Expert Advice ?</h4>
        <div class="jbt"> Fill this form to Grab the best Deals on "<span class="orng"><?php echo $part_id->parent_category." in "; ?><?php echo strtolower($location->geoplugin_city);  ?></span>"</div>
        <div class="bdc">
             
            <form class="form-inline" action="" method="post" onsubmit="return homeController.saveEnquiry(this)">
                <aside>
			 
                    <p><label for="yn">Your Name <span>*</span></label>
						<input type="hidden" name="lead_form" value="1" />
						<input type="hidden" name="kw_text" value="<?php echo $part_id->parent_category; ?>" />
						<input type="hidden" name="city_id" class="city" value="<?php echo strtolower($location->geoplugin_city);  ?>" />
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