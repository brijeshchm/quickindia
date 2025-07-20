@extends('client.layouts.app')
@section('title')
Quick India- Training in {{$client->business_name}}
@endsection 
@section('keyword')
Quick India- Training in {{$client->business_name}}
@endsection
@section('description')
Quick India- Training in {{$client->business_name}}
@endsection
@section('content')	

    <div class="container">
		<?php
 
			$profile_pic = [];
			$profile_pic['large']['src'] = 'client/images/default_profile_pic.jpg';
			if(null != $client->profile_pic){
				$profile_pic = unserialize($client->profile_pic);
			}		
			
		?>		
		    
        <div class="banner innerbanner" style="background-image:url(<?php echo asset(''.$profile_pic['large']['src']); ?>);">
			<div class="transbox"></div>
            <div class="row">
                <div class="col-sm-12 col-md-12 banner-details">
                   
						 
				</div>
                <!--<div class="bottom-icon col-xs-12 col-sm-12 col-md-12">
                   <div class="col-xs-2 col-sm-2 col-md-2"> <a href="javascript:void(0)" class="loc_trigger"><i class="fa fa-fw fa fa-map-marker location-icon" aria-hidden="true"></i></a>
                        <div class="txt"><a href="javascript:void(0)" class="loc_trigger">Location</a></div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <a class="c_trigger" style="cursor:pointer"> <i class="fa fa-fw fa fa-pencil-square-o location-icon" aria-hidden="true"></i> </a>
                        <div class="txt"><a href="#c_trigger" class="c_trigger" style="cursor:pointer">Write a Review</a></div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <a href="javascript:void(0)">
							<i class="s_rating emptyStar" data-s_rating="1"></i>
							<i class="s_rating emptyStar" data-s_rating="2"></i>
							<i class="s_rating emptyStar" data-s_rating="3"></i>
							<i class="s_rating emptyStar" data-s_rating="4"></i>
							<i class="s_rating emptyStar" data-s_rating="5"></i>
						</a>
                        <div class="txt mibtexts"><a href="#">your Rating</a></div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#smsEmailModal"> <i class="fa fa-fw fa fa-mobile location-icon" aria-hidden="true"></i></a>
                        <div class="txt"><a href="#" data-toggle="modal" data-target="#smsEmailModal">SMS/Email</a></div>
                    </div>
					@if($client->client_type != 'general')
                    <div class="col-xs-2 col-sm-2 col-md-2 bordernone">
                        <a href="javascript:void(0)"> <i class="fa fa-fw fa fa-thumbs-up location-icon" aria-hidden="true"></i></a>
                        <div class="txt"><a href="javascript:void(0)">Verified</a></div>
                    </div>
					@endif
                </div>-->
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 form-section">
            <div class="col-xs-9 col-sm-9 col-md-9 removeLeftSpace">
                <h3 class="hdTitle">
                   
                    
                    Are you looking for options other than <span class="croma-txt">{{isset($client->business_name)&&!empty($client->business_name)?$client->business_name:""}} </span>? </h3>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 removeRightSpace"><!--<a href="javascript:void()" class="btn btn-primary submit-btn open-popup">Enquiry</a> -->
			
			<a href="javascript:void()" class="btn btn-primary submit-btn stopprocess">Minimize</a></div>
            <div class="col-xs-12 col-sm-12 col-md-12 form-proceed spacer formDiv">
                <div class="col-xs-12 col-sm-7 col-md-7 border-line formleftBlock">
                    <div class="heading-txt">
                        <p class="heading-txt-1">Tell us your need, we will connect you with service experts </p>
                    </div>
                     
                        <form class="formaling lead_form" action="" method="post" onsubmit="return homeController.saveEnquiry(this)">
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
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Training you are interested in</span></div>
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
                            <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">tell us more</span></div>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <textarea class="form-control city-form" id="exampleTextarea" rows="3" placeholder="Provide any specific details for your need" name="remark"></textarea>
                                <div class="clearfix"></div>
                                <!--button type="button" class="btn btn-primary submit-btn-2">Get Quotes</button-->
								<input type="submit" class="btn btn-primary submit-btn-2" value="Get Quotes" />
                                <a href="{{url('privacy-policy')}}" target="_blank" class="pull-right trmcondition">T&C Apply</a> </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-5 formrightBlock">
                    <div class="heading-txt-2"><span>Why Fill This Form?</span></div>
                    <ul class="whyChoose">
                        <li><span><img src="<?php echo asset('client/images/icon-1.png'); ?>"></span>Thousands of customers fill this for to get best deals from training institutes.</li>
                        <li><span><img src="<?php echo asset('client/images/icon-2.png'); ?>"></span>1000+ Institutes contact our customers with best deals after getting details from this form.</li>
                        <li><span><img src="<?php echo asset('client/images/icon-3.png'); ?>"></span>Customer’s requirement gets fulfilled with best offers instantly.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="add-section">
            <div class="col-xs-12 col-sm-4 col-md-3  leftBlock">
        <aside>
                    <div class="col-md-10 col-md-offset-1">
						<?php
							$image = '#';
							if(!empty($client->logo)){
								$logo = unserialize($client->logo);
								if(!isset($logo['thumbnail'])){
									$logo['thumbnail'] = $logo['large'];
								}								
								$image = $logo['large']['src'];
							 
						?>
                        <img src="<?php echo asset(''.$image); ?>" style="margin-bottom:15px;border-radius:0" class="img-responsive" alt="logo">
							<?php } ?>
                    </div>
                    <div class="clearfix"></div>
                </aside>
                
                 
					
                
                
               <!-- <div id="slider">
                    <figure><img src="<?php echo asset('client/images/add1.jpg'); ?>" alt="image error" class="img-responsive img-thumbnail"></figure>
                    <figure><img src="<?php echo asset('client/images/add2.jpg'); ?>" alt="image error" class="img-responsive img-thumbnail"></figure>
                    <figure><img src="<?php echo asset('client/images/add3.jpg'); ?>" alt="image error" class="img-responsive img-thumbnail"></figure>
                    <figure><img src="<?php echo asset('client/images/add1.jpg'); ?>" alt="image error" class="img-responsive img-thumbnail"></figure>
                    <figure><img src="<?php echo asset('client/images/add2.jpg'); ?>" alt="image error" class="img-responsive img-thumbnail"></figure>
                </div>-->
                <aside class="addressBlock">
                    <ul>
                       <!-- <li><i class="fa fa-fw fa fa-phone-square location-icon-1" aria-hidden="true"></i><span class="phone-txt">{{isset($client->landline)&&!empty($client->landline)?"(+91)"."-".$client->stdcode."-".$client->landline:""}}</span></li>
                        <li><i class="fa fa-fw fa fa-mobile location-icon-1" aria-hidden="true"></i><span class="phone-txt">{{isset($client->mobile)&&!empty($client->mobile)?"(+91)".$client->mobile:""}}{{(isset($client->mobile,$client->sec_mobile)&&!empty($client->sec_mobile)&&!empty($client->mobile))?", ":""}}{{isset($client->sec_mobile)&&!empty($client->sec_mobile)?"(+91)".$client->sec_mobile:""}}</span></li>-->
						<?php
						if(!empty($addr->ispositiveresponse)){
						?>
							<li><i class="fa fa-fw fa fa-building-o location-icon-1" aria-hidden="true"></i><span class="phone-txt-1">
							<?php if($addr->issubstr): ?>
								{{ $addr->fullstr }}
								<a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="{{ $addr->fullstr }}">more</a>
							<?php else: ?>
								{{ $addr->fullstr }}
							<?php endif; ?>
							</span></li>
						<?php						
						}
						?>
                        <li><i class="fa fa-fw fa fa-envelope location-icon-1" aria-hidden="true"></i><a href="{{isset($client->email)&&!empty($client->email)?"mailto:".$client->email:"#"}}">Send Enquriy By Mail</a></li>
                        <li><i class="fa fa-fw fa fa-chrome location-icon-1" aria-hidden="true"></i><a target="_blank" href="{{isset($client->website)&&!empty($client->website)?buildWebsiteURL($client->website):'javascript:void(0)'}}">{{isset($client->website)&&!empty($client->website)?$client->website:'Website Not Available'}}</a></li>
                    </ul>
                </aside>
            
                <aside>
                    <h4>Year Established</h4>
                    <ul>
                        <li>{{isset($client->year_of_estb)&&!empty($client->year_of_estb)?$client->year_of_estb:"Not Available"}}</li>
                    </ul>
                </aside>
				<?php if(isset($client->display_hofo)&&empty($client->display_hofo)): //echo "<pre>";print_r(unserialize($client->time));echo "</pre>"; ?>
                <aside>
                    <h4>Business Hours of Operation </strong><small style="cursor:pointer" class="orangeColor pull-right max-min today">Maximize</small><small style="cursor:pointer" class="orangeColor pull-right hide otherday max-min">Minimize</small>
                    </h4>
                    <table class="table">
						<?php
						if(!empty($client->time)){
							$times = unserialize($client->time);
							$today =  strtolower(date('l'));
								?>
								<tr class="today">
									<td><?php echo "Today"; ?></td>
									<td><?php echo $times[$today]['from']." - ".$times[$today]['to']?></td>
								</tr>								
								<?php
							foreach($times as $day => $time){
								?>
								<tr class="hide otherday">
									<td><?php echo ucfirst($day); ?></td>
									<td><?php echo $time['from']." - ".$time['to']; ?></td>
								</tr>
								<?php
							}
						}else{
							echo "<tr><td>No working hours available</td></tr>";
						}
						?>
                        <!--tr>
                            <td>Today</td>
                            <td>09:00am - 09:00pm</td>
                            <td><span class="orangeColor">Open</span></td>
                        </tr>
                        <tr>
                            <td>Today</td>
                            <td>09:00am - 09:00pm</td>
                        </tr-->
                    </table>
                </aside>
				<?php endif; ?>
      
				
                <aside>
                <div class="clearfix"></div>
                </aside>
				<?php if(isset($client->certifications)&&!empty($client->certifications)): ?>
                <aside>
                    <h4>Certifications </strong>
                    </h4>
					<?php
						$certifications = unserialize($client->certifications);
						if(count($certifications)>0):
							foreach($certifications as $certification): ?>
								<div class="col-md-12">
									<div class="row pma" style="margin:5px;"><?php echo ucfirst($certification); ?></div>
								</div>									
							<?php
							endforeach;
						endif;
					?>
                    <div class="clearfix"></div>
                </aside>
				<?php endif; ?>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9 aside-section">
                
                 <div class="about-company">
                     
                       <aside>
                <h2 class="details-txt"><a target="_blank" href="{{isset($client->website)&&!empty($client->website)?buildWebsiteURL($client->website):'javascript:void(0);'}}">{{isset($client->business_name)&&!empty($client->business_name)?$client->business_name:""}}</a>
					 
					</h2>
                    <div class="rating"><span class="green">{{ $avgRating }}</span> <span class="starvote">
						<?php
							$whole = floor($avgRating);
							$fraction = $avgRating - $whole;
							$remain = 5-$whole;
							for($i=0;$i<$whole;++$i){
								echo "<i class=\"fullStar\"></i>";
							}
							if($fraction>0&&$fraction<1){
								echo "<i class=\"hlfStar\"></i>";
								--$remain;
							}
							for($i=0;$i<$remain;++$i){
								echo "<i class=\"emptyStar1\"></i>";
							}
						?>
						 
					</span> <span class="vote">{{ $count }} Votes</span></div>
					
					   <br>
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
							<i class="fa fa-fw fa fa-street-view icon" aria-hidden="true"></i>
							<div class="location-txt">
							<!--script>var clientAddr = "<?php //echo $addr->fullstr; ?>";</script-->
							<script>var clientAddr = "<?php echo $client->address; ?>";</script>
							<?php if($addr->fullstr): ?>
								{{ $addr->fullstr }}
							<?php endif; ?>
							</div>
						<?php						
						}
					?>
                    <br>
                    <br>
					
					  </aside>
                     
                 <style>    
					.heading h3 {
					font-size: 20px;
					color: #0b4f6c;
					margin-bottom: 10px;
					border-bottom: 2px solid #0b4f6c;
					padding-bottom: 5px;
					text-shadow: 1px 1px 2px rgba(0,0,0,0.15);
					}
					.modal-header h3 {
					font-size: 20px;
					color: #0b4f6c;
					margin-bottom: 10px;
					border-bottom: 2px solid #0b4f6c;
					padding-bottom: 5px;
					text-shadow: 1px 1px 2px rgba(0,0,0,0.15);
					}

					.section h2 {
      font-size: 20px;
      color: #0b4f6c;
      margin-bottom: 10px;
      border-bottom: 2px solid #0b4f6c;
      padding-bottom: 5px;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.15);
    }
                 </style>    
                     <div class="heading">
                       
						  <h3>About Company</h3>
                    </div>
                    <div class="tab-content" style="padding-top: 20px;">
						<div id="intro" class="tab-pane fade in active">
							<div class="">
								 
								<h1><i class="fa fa-user fa-fw" style="margin-right:5px;"></i>{{ $client->business_name}}  &nbsp;&nbsp;&nbsp;<i class="fa fa-map-marker fa-fw" style="margin-right:5px;"></i>{{ $client->city}}</h1>
								<div class="inner-intro">
									<p style="text-align:justify;">
									
									 
									<?php 									
									echo substr($client->business_intro,0,1000); ?><a href="#" data-toggle="modal" data-target="#businessIntroModal">..More</a>
									</p>
									<div id="businessIntroModal" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">{{ $client->business_name }}</h4>
												</div>
												<div class="modal-body">
													<p>{!! $client->business_intro!!}</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								 <div class="section">
								<h2><i class="fa fa-cog fa-fw" style="margin-right:5px;"></i>Services Offered</h2>
								</div>
								<?php
 
									$firstHalf = [];
									$secondHalf = [];
									$i = 1;
									$inPopupArr = [];
									foreach($assignedKwds as $assignedKwd){
										$inPopupArr[$assignedKwd->child_category_name][] = $assignedKwd->keyword;
								 
									
										if($i<=40):
											if($i%2==0){
												$secondHalf[]="<li>".$assignedKwd->keyword."</li>";
											}else{
												$firstHalf[]="<li>".$assignedKwd->keyword."</li>";
											}
											++$i;
										endif;
									}
								 
									$html = "";
									foreach($inPopupArr as $key=>$values){
										$html .= "<label class='col-md-12'>{$key}</label>";
										$i=1;
										$inFirstHalf = $inSecondHalf = [];
										foreach($values as $value){
											if($i%2==0){
												$html.="<div class='col-md-6'>".$value."</div>";
											}else{
												$html.="<div class='col-md-6'>".$value."</div>";
											}
											++$i;											
										}
										 
									}
								?>
								<div class="inner-intro">
									<div class="col-md-6">
										<ul>
											<?php echo implode("\r\n",$firstHalf); ?>
										</ul>
									</div>
									<div class="col-md-6">
										<ul>
											<?php echo implode("\r\n",$secondHalf); ?>
										</ul>
									</div>
									<!--<div class="col-md-12 text-right">... <a href="#" data-toggle="modal" data-target="#servicesOfferedModal">More</a></div>
									<div id="servicesOfferedModal" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">×</button>
													<h4 class="modal-title">Services Offered</h4>
												</div>
												<div class="modal-body" style="overflow-y:scroll;height:550px;">
													<div class="container col-md-12">
														{!! $html !!}
														<div class="clearfix"></div>
													</div>
													<div class="clearfix"></div>
												</div>
											</div>
										</div>
									</div>-->
									<div class="clearfix"></div>
								</div>
								<div class="section">
								<h2><i class="fa fa-map-marker fa-fw" style="margin-right:5px;"></i>Serving in City/Cities</h2>
								</div>
								<div class="inner-intro">
									<div class="col-md-6">
                                        <ul>
                                        <li>
                                        @if(!empty($assignedCity))
                                        @foreach($assignedCity as $city)
                                        {{ $city->city }}, 
                                        @endforeach
                                        @endif
                                        </li>
                                        </ul>
									<div class="clearfix"></div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>		
						
						<div class="section">
						 
						
								<h2>Gallery</h2>
							</ul>
							

						</div>
                        <div id="gallery" class="tab-pane fade fade in active">
                              
                                     <div class="col-xs-12 col-sm-6 col-md-6 row" style="margin:0 auto;">
                <?php if(!empty($client->pictures)):
                $pictures = unserialize($client->pictures);
                $pictures = array_slice($pictures,0);
                $picturesCount = count($pictures);
                
                
                ?>
                
                <?php foreach($pictures as $key=>$picture): ?>
                <div class="col-xs-12 col-sm-4 col-md-4 topSpace picthumb"><a href="javascript:void(0);" data-t_img="#<?php echo ($key+1); ?>" class="lightBox"><span>
                <?php if($picture['large']['src']){?>
                <img src="<?php echo asset(''.$picture['large']['src']); ?>" class="img-responsive">
                <?php } ?>
                </span></a></div>
                <?php endforeach; ?>
                
                
                <?php $default= 9-$picturesCount;
                
                if($default){
                for($i=1; $i<= $default; $i++){
                ?>
                
                <div class="col-xs-12 col-sm-4 col-md-4 topSpace picthumb"> <a href="javascript:void(0);" class="lightBox"><span><img src="<?php echo asset('client/images/photo-add.png'); ?>" class="img-responsive" ></span></a></div>
                
                
                <?php  } } ?>
                <?php else: ?>
                <div class="col-xs-12 col-sm-12 col-md-12 row" style="margin:0 auto;">
                <div class="col-xs-12 col-sm-4 col-md-4 topSpace picthumb"> <a href="javascript:void(0);" class="lightBox"><span><img src="<?php echo asset('client/images/photo-add.png'); ?>" class="img-responsive"></span></a></div>
                <div class="col-xs-12 col-sm-4 col-md-4 topSpace picthumb"> <a href="javascript:void(0);" class="lightBox"><span><img src="<?php echo asset('client/images/photo-add.png'); ?>" class="img-responsive" ></span></a></div>
                <div class="col-xs-12 col-sm-4 col-md-4 topSpace picthumb"> <a href="javascript:void(0);" class="lightBox"><span><img src="<?php echo asset('client/images/photo-add.png'); ?>" class="img-responsive" ></span></a></div>
                <div class="col-xs-12 col-sm-4 col-md-4 topSpace picthumb"> <a href="javascript:void(0);" class="lightBox"><span><img src="<?php echo asset('client/images/photo-add.png'); ?>" class="img-responsive" ></span></a></div>
                <div class="col-xs-12 col-sm-4 col-md-4 topSpace picthumb"> <a href="javascript:void(0);" class="lightBox"><span><img src="<?php echo asset('client/images/photo-add.png'); ?>" class="img-responsive" ></span></a></div>
                <div class="col-xs-12 col-sm-4 col-md-4 topSpace picthumb"> <a href="javascript:void(0);" class="lightBox"><span><img src="<?php echo asset('client/images/photo-add.png'); ?>" class="img-responsive" ></span></a></div>
                <div class="col-xs-12 col-sm-4 col-md-4 topSpace picthumb"> <a href="javascript:void(0);" class="lightBox"><span><img src="<?php echo asset('client/images/photo-add.png'); ?>" class="img-responsive"></span></a></div>
                <div class="col-xs-12 col-sm-4 col-md-4 topSpace picthumb"> <a href="javascript:void(0);" class="lightBox"><span><img src="<?php echo asset('client/images/photo-add.png'); ?>" class="img-responsive" ></span></a></div>
                <div class="col-xs-12 col-sm-4 col-md-4 topSpace picthumb"> <a href="javascript:void(0);" class="lightBox"><span><img src="<?php echo asset('client/images/photo-add.png'); ?>" class="img-responsive"></span></a></div>	 
                </div>
                <div class="clearfix"></div>
                <?php endif; ?>
                
                </div>
                
                
                <div class="col-xs-12 col-sm-6 col-md-6 row" style="margin:0 auto;">
                
                
                <form class="formaling lead_form" action="" method="post" onsubmit="return homeController.saveEnquiry(this)">
                <div class="fieldblock">
                <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">City*</span></div>
                <div class="col-xs-8 col-sm-8 col-md-8" id="select-city-proceed">
                <input type="hidden" name="lead_form_" value="1">
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
                <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Service</span></div>
                <div class="col-xs-8 col-sm-8 col-md-8">
                <input type="text" placeholder="Search Courses" class="form-control city-form home-search" name="kw_text" autocomplete="off">
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
                <div class="col-xs-4 col-sm-4 col-md-4"><span class="form-txt">Remarks</span></div>
                <div class="col-xs-8 col-sm-8 col-md-8">
                <textarea class="form-control city-form" id="exampleTextarea" rows="3" placeholder="Provide any specific details for your need" name="remark"></textarea>
                <div class="clearfix"></div>
             
                <input type="submit" class="btn btn-primary submit-btn-2" value="Get Quotes" style="margin-left: 51px;">
                </div>
                </div>
                </form>
                </div>
                <div class="clearfix"></div>
				 
                              
                        </div>
						
						<div class="heading">
						<h3>REVIEWS & RATING</h3>
						    </div>
                        <div id="" class="tab-pane fade fade in active">
                            <!--<div class="col-md-12">
                                <div class="col-md-6">
                                    <canvas id="cvs" width="370" height="170">[No canvas support]</canvas>
                                    <div class="clearfix"></div>
                                </div>
								<?php 
							 
								if(count($graphQuery)>0): ?>
								<?php
									$str = '';
									foreach($graphQuery as $g_query){
										$str .= date_format(date_create($g_query->created_at),'Y-m-d').','.number_format((($g_query->sum_rating/($g_query->count*5))*5), 1, '.', '').'\n';
									}
									
									 
								?>
                                <div class="col-md-6">
                                    <div style="display: none" id="myData">
										2017-01-03,2.0
										2016-12-31,5
                                        2016-11-30,4.8
                                    </div>
									<div style="" id="">
										<?php
											$date = [];
											$data = [];
											$lineLabels = [];
											foreach($graphQuery as $g_query){
												$date[]=date_format(date_create($g_query->created_at),'Y-m-d');
												$data[]=number_format((($g_query->sum_rating/($g_query->count*5))*5), 1, '.', '');
												$lineLabels[] = "";
												$lineLabels[] = "";
												$lineLabels[] = date_format(date_create($g_query->created_at),'M\'Y');
												//echo date_format(date_create($g_query->created_at),'Y-m-d').','.number_format((($g_query->sum_rating/($g_query->count*5))*5), 1, '.', '');
											}
										?>
                                    </div>
									<script>
									//var rawDate = "<?php echo implode(",",$date); ?>";
									var rawData = "<?php echo implode(",",$data); ?>";
									//var lineLabels = ['','','Nov\'2016','','','Dec\'2016','','','Jan\'2017'];
									var lineLabels = [<?php 
										$i=0;
										$count = count($graphQuery);
										foreach($graphQuery as $g_query){
											$i++;
											echo "'','','".date_format(date_create($g_query->created_at),'M-Y')."'";
											if($i!=$count){
												echo ",";
											}
									} ?>];
									var sourceData = [<?php
										$i = 6;
										$labels = [
											"5"=>"Excellent",
											"4"=>"Very Good",
											"3"=>"Good",
											"2"=>"Average",
											"1"=>"Poor"
										];
										foreach($barGraphQuery as $b_g_query){
											--$i;
											if(!$b_g_query->rating){continue;}
											if($i==$b_g_query->rating){
												echo "['".$labels[$b_g_query->rating]."',".number_format((($b_g_query->sum_rating/($sum))*100), 1, '.', '')."]"; 
											}else{
												echo "['".$labels[$i]."',0]"; 
											}
											
											if($i!=1){
												echo ",";
											}											
										}
									?>];
									</script>
                                    <canvas id="svc" width="370" height="170">[No canvas support]</canvas>
                                </div>
								<?php endif; ?>
                            </div>-->
                            <div class="clearfix"></div>
							@if(count($comments)>0)
                            <div class="col-xs-12 col-sm-12 col-md-12" id="reviews-result-resp">
								@foreach($comments as $comment)
                                <div class="reviews-box">
                                    <div class="alllearners_reviews clearfix">
                                        <div class="alllearners_reviews_img_box"><img src="<?php echo asset('client/images/user.png'); ?>" alt=""> </div>
                                        <div class="alllearners_reviews_info_box">
                                            <h5><span style="color:#333;">{{ $comment->comment_author }} </span> <span class="star-rating pull-right">
												<?php
													$whole = floor($comment->rating);
													$fraction = $comment->rating - $whole;
													$remain = 5-$whole;
													for($i=0;$i<$whole;++$i){
														echo "<a href=\"javascript:void(0)\" class=\"emptystar fullstar\"></a>";
													}
													if($fraction>0&&$fraction<1){
														echo "<a href=\"javascript:void(0)\" class=\"emptystar halfstar\"></a>";
														--$remain;
													}
													for($i=0;$i<$remain;++$i){
														echo "<a href=\"javascript:void(0)\" class=\"emptystar\"></a>";
													}
												?>
											 
												</span>
											</h5>
                                            <h6 class="reviewer_profession" style="color:#2874F0"> [{{ getStarCodedStr($comment->comment_author_email,'email') }} | {{ getStarCodedStr($comment->comment_author_phone,'number') }}] <span class="com-date pull-right">{{ date_format(date_create($comment->created_at),"dS-M\' Y") }}</span> </h6>
                                        </div>
                                    </div>
                                    <div class="reviewsquots_box">
										<?php
										$arr = [];
										if(!empty($comment->comment_content)){
											$arr[] = $comment->comment_content;
										}
										$addr = getAddress($arr,300);
										if($addr->ispositiveresponse){
										?>
											<?php if($addr->issubstr): ?>
												<p class="reviewsquots_info reviewsquots_txt">{{ $addr->substr }} <!--span style="display:inline;" class="more-dots">...</span--></p>
												<a data-content="{{ $addr->fullstr }}" class="r-more-info" type="button">More &gt;&gt;</a>
											<?php else: ?>
												<p class="reviewsquots_info reviewsquots_txt">{{ $addr->fullstr }}</p>
											<?php endif; ?>
										<?php						
										}
										?>
									</div>
                                </div>
								@endforeach
								{{ $comments->links() }}
                            </div>
							@else
						<!--	<div class="col-xs-12 col-sm-12 col-md-12" id="reviews-result-resp">
								<div class="well" style="position:absolute;top:-85px;width:97%;">
									No review(s) available !!
								</div>
							</div>-->
							@endif
                        </div>
                        
                        
                        
                        
                        
                      
                      <div class="heading">
                      <h3>WRITE A REVIEW</h3> 
                      </div>
                        <div id="c_trigger" class="tab-pane fade fade in active">
                            <div class="col-md-12 rate-txt">
                                <div class="col-md-6 rate-txt removeLeftSpace">
                                    <p>Please rate your experience</p>
                                </div>
                                <div class="col-md-6 ratingstar text-right removeRightSpace">
                                    
									<a href="javascript:void(0)">
										<i class="s_rating emptyStar" data-s_rating="1"></i>
										<i class="s_rating emptyStar" data-s_rating="2"></i>
										<i class="s_rating emptyStar" data-s_rating="3"></i>
										<i class="s_rating emptyStar" data-s_rating="4"></i>
										<i class="s_rating emptyStar" data-s_rating="5"></i>
									</a>
                                </div>
                            </div>
                            <div>
                                <div class="col-md-12 review-form ">
                                    <div class="col-md-6 removeLeftSpace">
                                        <p class="p-txt">Add Reviews</p>
                                    </div>
                                    <div class="col-md-6 removeRightSpace">
                                        <p class="p-txt-1"><a href="javascript:void(0)">Review Guideline</a></p>
                                    </div>
                                    <div class="clearfix">&nbsp;</div>
                                    <div class="commentform">
                                        <form id="commentform">
											<input type="hidden" name="s_rating">
                                            <div class="row">
                                                <label class="col-xs-12 col-sm-2 col-md-2 contlftspce review-txt">Name <sup><i class="fa fa-fw fa-asterisk" aria-hidden="true" style="color:red;"></i></sup></label>
                                                <input class="col-xs-12 col-sm-5 col-md-5 txtfld" type="text" name="comment_author" placeholder="Enter Name">
                                            </div>
                                            <div class="row">
                                                <label class="col-xs-12 col-sm-2 col-md-2 contlftspce review-txt">Mobile <sup><i class="fa fa-fw fa-asterisk" aria-hidden="true" style="color:red;"></i></sup></label>
                                                <input class="col-xs-12 col-sm-5 col-md-5 txtfld" type="text" name="comment_author_phone" placeholder="Enter phone">
                                            </div>
                                            <div class="row">
                                                <label class="col-xs-12 col-sm-2 col-md-2 contlftspce review-txt">Email Id <sup><i class="fa fa-fw fa-asterisk" aria-hidden="true" style="color:red;"></i></sup></label>
                                                <input class="col-xs-12 col-sm-5 col-md-5 txtfld" type="text" name="comment_author_email" placeholder="Enter Email">
                                            </div>
                                            <div class="row">
                                                <label class="col-xs-12 col-sm-2 col-md-2 contlftspce review-txt">Comment Here</label>
                                            </div>
											<textarea rows="4" cols="50" name="comment_content" class="enter-txt" placeholder="Enter text here..."></textarea>
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                            <input type="reset" id="comment_reset" class="btn btn-primary" value="Reset" style="visibility:hidden" >
                                        </form>
                                    </div>
									<style>
									.vertical-alignment-helper {
										display:table;
										height: 100%;
										width: 100%;
										pointer-events:none; /* This makes sure that we can still click outside of the modal to close it */
									}
									.vertical-align-center {
										/* To center vertically */
										display: table-cell;
										vertical-align: middle;
										pointer-events:none;
									}
									.modal-content {
										/* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
										width:inherit;
										height:inherit;
										/* To center horizontally */
										margin: 0 auto;
										pointer-events: all;
									}
									#smsEmailModal .modal-header, #smsEmailModal h4, #smsEmailModal .close {
									  background-color: #fe610c;
									  color:white !important;
									  text-align: center;
									  font-size: 22px;
									}
									#smsEmailModal .modal-footer, #login-button {
									  background-color: #fe610c;
									  border: 1px solid #fe610c;
									}
									#smsEmailModal .modal-header .close {
										margin-top: -9px;
										margin-right: -32px;
										color:#fff;
										opacity:0.8;
									}
									#smsEmailModal .select2-container--bootstrap{
										width:inherit !important;
									}

									  /* Always set the map height explicitly to define the size of the div
									   * element that contains the map. */
									  #map {
										  width:100%;
										height: 100%;
									  }
									  #floating-panel {
										position: absolute;
										top: 10px;
										left: 25%;
										z-index: 5;
										background-color: #fff;
										padding: 5px;
										border: 1px solid #999;
										text-align: center;
										font-family: 'Roboto','sans-serif';
										line-height: 30px;
										padding-left: 10px;
									  }
									.ajax-suggest-lead-home {
										top: 381px;
										left: 52px;
										width: 78.3%;
										border-radius: 4px;
									}
									</style>
									<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="vertical-alignment-helper">
											<div class="modal-dialog vertical-align-center modal-sm">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
														<h4 class="modal-title" id="myModalLabel">Rating and Review Alert</h4>
													</div>
													<div class="modal-body">
														Please provide your <span class="orng" style="font-weight:normal">"Name", "Mobile", "Email" &amp; "Comment"</span> to submit your<br>review and rating.<br><br><br>
														<strong>
														Thanks,<br>
														Quick India- Team<br>
														</strong>
													</div>
													<!--div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<button type="button" class="btn btn-primary">Save changes</button>
													</div-->
												</div>
											</div>
										</div>
									</div>
									<!--div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:10000000;">
										<div class="vertical-alignment-helper">
											<div class="modal-dialog vertical-align-center modal-sm">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
														<h4 class="modal-title" id="myModalLabel" style="visibility:hidden">Message</h4>
													</div>
													<div class="modal-body">
													</div>
												</div>
											</div>
										</div>
									</div-->
									<div class="modal fade" id="g_MapsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:98%;">
										<div class="vertical-alignment-helper">
											<div class="modal-dialog vertical-align-center" style="width:95%;">
												<div class="modal-content" style="min-height:100%;height:auto;">
													<div class="modal-header" style="background-color:#F2F2F2;color:#000;">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#000">&times;</span><span class="sr-only">Close</span></button>
														<h4 class="modal-title" id="myModalLabel">Google Maps</h4>
													</div>
													<div class="modal-body">
														<div class="row">
														<div class="col-md-3">
															<div class="col-md-12">
																<div class="row">
																 
																<ul style="list-style-type:none;margin-left:-30px;">
																	<li><i class="fa fa-fw fa fa-institution location-icon-1" aria-hidden="true"></i><span class="" style="font-weight:bold;font-size:20px;"><strong>{{ $client->business_name }}</strong></span></li>
																	<li><i class="fa fa-fw fa-map-marker location-icon-1" aria-hidden="true"></i><span class="phone-txt" id="g_MapName">{{$client->address}}</span></li>
																	<!--<li><i class="fa fa-fw fa fa-phone-square location-icon-1" aria-hidden="true"></i><span class="phone-txt">{{isset($client->landline)&&!empty($client->landline)?"(+91)"."-".$client->stdcode."-".$client->landline:""}}</span></li>
																	<li><i class="fa fa-fw fa fa-mobile location-icon-1" aria-hidden="true"></i><span class="phone-txt">{{isset($client->mobile)&&!empty($client->mobile)?"(+91)".$client->mobile:""}}{{(isset($client->mobile,$client->sec_mobile)&&!empty($client->sec_mobile)&&!empty($client->mobile))?", ":""}}{{isset($client->sec_mobile)&&!empty($client->sec_mobile)?"(+91)".$client->sec_mobile:""}}</span></li>-->
																	<li><i class="fa fa-fw fa fa-envelope location-icon-1" aria-hidden="true"></i><a href="{{isset($client->email)&&!empty($client->email)?"mailto:".$client->email:"#"}}">Send Enquriy By Mail</a></li>
																	<li><i class="fa fa-fw fa fa-chrome location-icon-1" aria-hidden="true"></i><a href="{{isset($client->website)&&!empty($client->website)?$client->website:'javascript:void(0)'}}">{{isset($client->website)&&!empty($client->website)?$client->website:'Website Not Available'}}</a></li>
																</ul>
																</div>
															</div>
														</div>
														<div class="col-md-9" style="height:570px">
															<!--<div id="map_canvas" style="width:100%;height:100%;background-color:#e3e3e3;"></div>-->

															<div class="map-area"> 
															<div style="wdith:100%" class="map-container">
															<?php if(!empty($client->address)){?>
															<iframe style="width:100%;height:695px"
															frameborder="0" scrolling="no" style="border:0"
															src="https://www.google.com/maps/embed/v1/search?key=AIzaSyAPFOcLOlCcBCtp764h9HflPfA56VlCFo0&q=<?php echo $client->address; ?>" allowfullscreen>
															</iframe>
															<?php }else{ ?>
															<iframe style="width:100%;height:695px"
															frameborder="0" scrolling="no" style="border:0"
															src="https://www.google.com/maps/embed/v1/search?key=AIzaSyAPFOcLOlCcBCtp764h9HflPfA56VlCFo0&q=Delhi" allowfullscreen>
															</iframe>
															
															<?php  } ?>
															</div>
															</div>  
														</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal fade" id="smsEmailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="vertical-alignment-helper">
											<div class="modal-dialog vertical-align-center">
												<div class="modal-content">
													<div class="modal-header" style="padding:8px 50px;border-radius:4px 4px 0 0">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4><!--span class="glyphicon glyphicon-lock"></span--> Post Your Requirement</h4>
													</div>
													<div class="modal-body" style="padding:22px 50px;">
														<form action="" method="post" onsubmit="return homeController.saveEnquiry(this)" class="lead_form">
														{{csrf_field()}}
														<div class="form-group">
															<label for="name"><span class="glyphicon glyphicon-user"></span> Name</label>
															<input type="text" class="form-control" name="name" placeholder="Name">
														</div>
														<div class="form-group">
															<label for="mobile"><span class="glyphicon glyphicon-phone"></span> Mobile</label>
															<input type="text" class="form-control" name="mobile" placeholder="Mobile Number">
														</div>
														<div class="form-group">
															<label for="email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
															<input type="email" class="form-control" name="email" placeholder="Email">
														</div>
														<div class="form-group">
															<label for="city_id"><span class="glyphicon glyphicon-envelope"></span> City</label>
															<select class="form-control select2-single location city" name="city_id">
																<option value="">Select City</option>
																@if(count($cities)>0)
																	@foreach($cities as $city)
																		<option value="{{$city->city}}">{{$city->city}}</option>
																	@endforeach
																@endif
															</select>
														</div>
														<div class="form-group">
															<label for="course"><span class="glyphicon glyphicon-list"></span> Service Interested</label>
															<input type="text" class="form-control home-search" name="kw_text" placeholder="Course Interested" autocomplete="off">
															<div class="ajax-suggest ajax-suggest-lead-home" style="display: none;"><ul></ul></div>
														</div>
														<input type="reset" class="btn btn-primary hide reset_lead_form" value="reset" />
														<input type="submit" id="login-button" class="btn btn-info btn-block" name="lead_form" value="Request Information" />
														</form>
													</div>
												</div>
												<!--div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
														<h4 class="modal-title" id="myModalLabel">Form</h4>
													</div>
													<div class="modal-body">
														<form action="" method="POST">
															<p><label>Name</label><input type="text" class="form-control" required></p>
															<p><label>Mobile</label><input type="text" class="form-control" required></p>
															<p><label>Email</label><input type="text" class="form-control" required></p>
															<p><label>Course Interested</label><input type="text" class="form-control" required></p>
															<p><input type="submit" class="btn btn-info"></p>
														</form>
													</div>
												</div-->
											</div>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             
                
                
              
				 
				
                <style>
					#intro{
						color:#474849;
					}
					#intro h1{
						font-size:24px;
					}
					#intro h3,#intro h1{
						/*border-bottom:1px solid #ddd;*/
						padding-bottom:8px;
						margin-top:40px;
					}
					#intro h3:after,#intro h1:after{
						content: '';
						display: block;
						/*border-bottom: 1px solid #ddd;*/
						top: 6px;
						position: relative;
						box-shadow: 0 1px 0 #ddd;
					}
					#cvs + span{
						visibility:hidden!important;
					}
					
					#intro h1,#intro h2{
						font-weight:400;
						font-size:18px;
						color:#314252;
						line-height:14px;
						padding:5px 0;	
						margin-top: 3px;
						margin-bottom: 0px;
						font-family:'Open Sans',Arial,sans-serif !important;
					}
					#intro .inner-intro{
						padding-bottom: 6px;
						margin-bottom: 13px;
						/* border-bottom: 1px solid #ddd; */
						font-family:'Open Sans',Arial,sans-serif !important;
						line-height: 1.5em;
					}
					#intro h2{
						margin-bottom:10px;
					}
				</style>
                  <div class="clearfix"></div>
            </div>
        </div>
		
		
    </div>
	<div class="clearfix"></div>
    <script>
        $(document).ready(function() {
            $('.proceedBtn').click(function() {
                $('.proceedBtn').hide();
                $('.stopprocess').show();
                $('.formDiv').slideDown();
            });

            $('.stopprocess').click(function() {
                $('.stopprocess').removeAttr("style");
                $('.proceedBtn').show();
                $('.formDiv').slideUp();
            });

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <div class="galleryPopup">
        <div class="popwraper whiteBg">
           <!-- <a href="javascript:void(0);" class="closebtn"><img src="<?php echo asset('client/images/close2.png'); ?>" alt="" /></a>-->
<button type="button" class="close closebtn" data-dismiss="modal">×</button>
            <div id="gallery" class="content">
                <div class="topinfo"> <strong>{{(isset($client->business_name)&&!empty($client->business_name))?$client->business_name.",":""}}</strong> 
				<?php if($addr->ispositiveresponse){ ?>
					<?php if($addr->issubstr): ?>
						{{ $addr->substr }}
						<a href="javascript:void(0)" style="color:red" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ $addr->fullstr }}">more</a>
					<?php else: ?>
						{{ $addr->fullstr }}
					<?php endif; ?>
				<?php } ?>
                    <span><small style="font-size:inherit" id="p_count"></small> of <?php echo (!empty($client->pictures))?count(unserialize($client->pictures)):""; ?></span></div>
                <div id="controls" class="controls"></div>
                <div class="slideshow-container">
                    <div id="loading" class="loader"></div>
                    <div id="slideshow" class="slideshow"></div>
                </div>
                <div id="caption" class="caption-container"><strong>{{(isset($client->business_name)&&!empty($client->business_name))?$client->business_name.",":""}}</strong>
				<?php if($addr->ispositiveresponse){ ?>
					<?php if($addr->issubstr): ?>
						{{ $addr->substr }}
						<a href="javascript:void(0)" style="color:red" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ $addr->fullstr }}">more</a>
					<?php else: ?>
						{{ $addr->fullstr }}
					<?php endif; ?>
				<?php } ?>
				</div>
            </div>

			<?php if(!empty($client->pictures)):
				$pictures = unserialize($client->pictures);
				$pictures = array_slice($pictures,0);				
			?>
            <div id="thumbs" class="navigation">
                <ul class="thumbs noscript">vvv
					<?php foreach($pictures as $picture): ?>
                    <li>
                        <a class="thumb" href="<?php echo asset(''.$picture['large']['src']); ?>" title=""><img src="<?php echo asset(''.$picture['large']['src']); ?>" style="height:75px;width:100px;" alt="" /></a>
                    </li>
					<?php endforeach; ?>
                </ul>
            </div>
			<?php endif; ?>
        </div>
	</div>
	 <div class="clearfix"></div>
   
@endsection