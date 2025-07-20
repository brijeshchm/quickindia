<div class="col-lg-3">
					<div class="sidebar">
						<div class="sidebar_background"></div>
						<div class="sidebar_top"><a href="{{url('courses')}}">Information Of Course</a></div>
						<div class="sidebar_content">

							<!-- Features -->
							<div class="sidebar_section features">						 
							<div class="features_content">

								<ul class="features_list">
								<li class="d-flex flex-row align-items-start justify-content-start">
								<div class="feature_title"><i class="fa fa-phone" aria-hidden="true"></i><span>Call Us</span>	 </div>
								<div class="feature_text ml-auto">	<p>+91-+91 70113 10265 </p><p>
								91 70113 10265</p></div>
								</li>
								<li class="d-flex flex-row align-items-start justify-content-start">
								<div class="feature_title"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i><span>Email:-</span></div>
								<div class="feature_text ml-auto"><p>info@quickindia.in</p></div>
								</li>
								</ul>
								
							</div>
							</div>
								<div class="sidebar_section features">
								<div class="sidebar_title">Drop us a query</div>
								<div class="features_content">

							 
								<div class="drop-query-box">

								<h2 class="red-heading"></h2>

								<!--my-widget-->

								<div class="my-widget">

								<form method="post" action="" for="form" class="addenquiryvalidation">

								<div class="form-group">
								<div class="inner-addon left-addon">
								<i class="fa fa-user fa-lg"></i>
								<input type="hidden" name="iq_course_name" class="form-control" value="Software Testing – Program 2(Using QTP/UFT 12.0)">
								<input type="text" class="form-control" name="iq_name" placeholder="Enter Name" data-rule="iq_name" data-msg="Please enter name">
								<div class="validation"></div>
								</div>
								</div>
								<div class="form-group">
								<div class="inner-addon left-addon">
								<i class="fa fa-envelope fa-lg"></i>
								<input type="email" class="form-control" name="iq_email" placeholder="Enter Email" data-rule="iq_email" data-msg="Please enter email">
								<div class="validation"></div>
								</div>
								</div>
								<div class="form-group">
								<div class="inner-addon left-addon">
								<i class="fa fa-phone fa-lg"></i>
								<input type="tel" class="form-control" name="iq_mobile" placeholder="Enter Mobile No." data-rule="iq_mobile" data-msg="Please enter contact number">
								<div class="validation"></div>
								</div>
								</div>
								<div class="form-group">
								<div class="inner-addon left-addon">
								<i class="fa fa-book fa-lg"></i>
								<input type="text" class="form-control" name="iq_course" placeholder="Enter Language" data-rule="iq_course" data-msg="Please enter language">
								<div class="validation"></div>
								 
								</div>
								</div>
								 
								<div class="form-group">
								<div class="inner-addon left-addon">
								<i class="fa fa-building fa-lg"></i>
								<input type="text" class="form-control" name="iq_city" placeholder="Enter City/Area" data-rule="iq_city" data-msg="Please enter city">
								<div class="validation"></div>
							 
								</div>
								</div>
								<div class="form-group">
								<div class="inner-addon">
								<textarea class="form-control" name="iq_message" rows="3" data-rule="iq_message" data-msg="Please enter inquiry" placeholder="Enter your query"></textarea>
									<div class="validation"></div>
								</div>
							
								</div>



								<div class="form-group">
								<div class="inner-addon checkbox">
								<input type="checkbox" value="" id="iq_check_sidebar" name="iq_check_sidebar" class="css-checkbox" data-rule="iq_check_sidebar" data-msg="Please checked">
								<div class="validation"></div>
								<label for="iq_check_sidebar" class="css-label human" style="background-position: 0px 0px;">I am Human.</label>
							 
								</div>
								</div>

								<input type="submit" class="btn btn-submit" value="Submit">
								 
								</form>



								</div>

								<!--my-widget-->

								</div>
							 
								 </div>
								</div>
							<!--<div class="sidebar_section features">
								<div class="sidebar_title">Course Features</div>
								<div class="features_content">
									<ul class="features_list">

										 
										<li class="d-flex flex-row align-items-start justify-content-start">
											<div class="feature_title"><i class="fa fa-clock-o" aria-hidden="true"></i><span>Duration</span></div>
											<div class="feature_text ml-auto">2 weeks</div>
										</li>

										 
										<li class="d-flex flex-row align-items-start justify-content-start">
											<div class="feature_title"><i class="fa fa-bell" aria-hidden="true"></i><span>Lectures</span></div>
											<div class="feature_text ml-auto">10</div>
										</li>

									 
										<li class="d-flex flex-row align-items-start justify-content-start">
											<div class="feature_title"><i class="fa fa-id-badge" aria-hidden="true"></i><span>Quizzes</span></div>
											<div class="feature_text ml-auto">3</div>
										</li>

									 
										<li class="d-flex flex-row align-items-start justify-content-start">
											<div class="feature_title"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span>Pass Percentage</span></div>
											<div class="feature_text ml-auto">60</div>
										</li>

										 
										<li class="d-flex flex-row align-items-start justify-content-start">
											<div class="feature_title"><i class="fa fa-thumbs-down" aria-hidden="true"></i><span>Max Retakes</span></div>
											<div class="feature_text ml-auto">5</div>
										</li>
									</ul>
								</div>
							</div>-->

							<!-- Cert -->
							<div class="sidebar_section cert">
								<div class="sidebar_title">Certification</div>
								<div class="cert_image"><img src="{{asset('site/images/cert.jpg')}}" alt="Certification"></div>
							</div>

							<!-- You may like -->
							<div class="sidebar_section like">
								<div class="sidebar_title">You may like</div>
								<div class="like_items">

									<!-- Like Item -->
									
									@if(!empty($courses_list))
										@foreach($courses_list as $course)
									<div class="like_item d-flex flex-row align-items-end justify-content-start">
										<div class="like_title_container">										  
											<a href="courses/@if(!empty($course->url)){{ $course->url}} @endif">
											<div class="like_subtitle">
											<div class="flag-language">
											<img src="{{asset('upload/'.$course->icon)}}" alt="@if(!empty($course->title)){{ $course->title }} @endif"> 
											</div>
											</div>
											<div class="like_title">@if(!empty($course->name)){{ $course->name }} @endif</div></a>
										
										</div>
										<a href="javascript:void(0)" data-toggle="modal" data-target="#enquiryModel"><div class="like_price ml-auto" >Quick Query</div></a>
									</div>
									@endforeach
									@endif
									
									<!--
									<div class="like_item d-flex flex-row align-items-end justify-content-start">
										<div class="like_title_container">										  
											<a href="{{url('english-in-noida')}}">
											<div class="like_subtitle">
											<div class="flag-language">
											<img src="{{asset('site/images/English.svg')}}" alt="English language"> 
											</div>
											</div>
											<div class="like_title">English</div></a>
										
										</div>
										<a href="javascript:void(0)" data-toggle="modal" data-target="#enquiryModel"><div class="like_price ml-auto" >Quick Query</div></a>
									</div>
									<div class="like_item d-flex flex-row align-items-end justify-content-start">
										<div class="like_title_container">										  
											<a href="{{url('french-in-noida')}}">
											<div class="like_subtitle">
												<div class="flag-language"><img src="{{asset('site/images/French.svg')}}" alt="French Language"> </div>
												</div>
											<div class="like_title">French</div></a>
										
										</div>
										<a href="javascript:void(0)" data-toggle="modal" data-target="#enquiryModel"><div class="like_price ml-auto" >Quick Query</div></a>
									</div>	
									
									<div class="like_item d-flex flex-row align-items-end justify-content-start">
										<div class="like_title_container">										  
											<a href="{{url('german-in-noida')}}">
											<div class="like_subtitle">	<div class="flag-language"><img src="{{asset('site/images/German.svg')}}" alt="German Language">
											</div>
											</div>
											<div class="like_title">German</div></a>
										
										</div>
										<a href="javascript:void(0)" data-toggle="modal" data-target="#enquiryModel"><div class="like_price ml-auto" >Quick Query</div></a>
									</div>	

									<div class="like_item d-flex flex-row align-items-end justify-content-start">
										<div class="like_title_container">										  
											<a href="{{url('swedish-in-noida')}}">
											<div class="like_subtitle">
												<div class="flag-language">
											<img src="{{asset('site/images/Swedish.svg')}}" alt="Swedish Language"> 
											</div>
											</div>
											<div class="like_title">Swedish</div></a>
										
										</div>
									<a href="javascript:void(0)" data-toggle="modal" data-target="#enquiryModel"><div class="like_price ml-auto" >Quick Query</div></a>
									</div>	

									<div class="like_item d-flex flex-row align-items-end justify-content-start">
										<div class="like_title_container">										  
											<a href="{{url('hindi-in-noida')}}">
											<div class="like_subtitle">
												<div class="flag-language">
											<img src="{{asset('site/language/Hindi.svg')}}" alt="Hindi Language"> 
											</div>
											</div>
											<div class="like_title">Hindi</div></a>
										
										</div>
										<a href="javascript:void(0)" data-toggle="modal" data-target="#enquiryModel"><div class="like_price ml-auto" >Quick Query</div></a>
									</div>

									<div class="like_item d-flex flex-row align-items-end justify-content-start">
										<div class="like_title_container">										  
											<a href="{{url('chinese-in-noida')}}">
											<div class="like_subtitle">
												<div class="flag-language">
											<img src="{{asset('site/language/China.svg')}}" alt="Chinese Language"> 
											</div>
											</div>
											<div class="like_title">Chinese</div></a>
										
										</div>
										<a href="javascript:void(0)" data-toggle="modal" data-target="#enquiryModel"><div class="like_price ml-auto" >Quick Query</div></a>
									</div>

								 	
									
									<div class="like_item d-flex flex-row align-items-end justify-content-start">
										<div class="like_title_container">										  
											<a href="{{url('spanish-in-noida')}}">
											<div class="like_subtitle">
												<div class="flag-language">
											<img src="{{asset('site/language/Spain.svg')}}" alt="Spain language">
											</div>
											</div>
											<div class="like_title">Spain</div></a>
										
										</div>
									<a href="javascript:void(0)" data-toggle="modal" data-target="#enquiryModel"><div class="like_price ml-auto" >Quick Query</div></a>
									</div>	
									
									<div class="like_item d-flex flex-row align-items-end justify-content-start">
										<div class="like_title_container">										  
											<a href="{{url('japanese-in-noida')}}">
											<div class="like_subtitle">
												<div class="flag-language">
											<img src="{{asset('site/language/Japanese.svg')}}" alt="Japanese language">

											</div>
											</div>
											<div class="like_title">Japanese</div></a>
										
										</div>
										<a href="javascript:void(0)" data-toggle="modal" data-target="#enquiryModel"><div class="like_price ml-auto" >Quick Query</div></a>
									</div>

									 
									-->
									 
									 
								</div>
							</div>
						</div>
					</div>
				</div>
