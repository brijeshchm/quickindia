@extends('client.layouts.app')
@section('title')
  About quick india Quick India- Local search, IT Training, Playschool, overseas education
@endsection 
@section('keyword')
Quick India- Local search, IT Training, Playschool, overseas education
@endsection
@section('description')
Quick India- Local search, IT Training, Playschool, overseas education
@endsection
@section('content')	

  <link href="{{asset('public/official/css/style.css')}}" rel="stylesheet">
<div class="about-bg page-hearder-area">
    <div class="official-overly"></div> 
  </div>   
  
  
  <div id="about" class="about-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline services-head text-center">
            <h2>About <span>Quick</span> India</h2>
          </div>
        </div>
      </div>
      <div class="row text-center">
        <div class="services-contents">
          <!-- Start Left services -->
          
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">                   
                  <p>
                    Quick India, one of the most promising start-ups lead generation in India in 2023, offers a B2C model as a match-making admission solution to students, professionals study and services. Their quickind.com, provide platform connects education seekers with education providers, coupled with excellent career counseling services.</p>
<p>Quick India is an extensive search engine for students, parents, professionals, and education industry players seeking information on the education sector in India. Users can rely on quickind.com for the most relevant data on institutes, colleges, and universities. </p>
					 
                </div>
                </div>
              </div>
             
            </div>
          </div>  
		  
          <div class="col-md-3 col-sm-3 col-xs-12">
		  <style>
		.modal-header .close {
		margin-top: 4px;
		margin-right: 13px;
		}
		  </style>
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="javascript:void(0)">
											<i class="fa fa-rocket"></i>
										</a>
                  <h6><strong>Vision</strong></h6>
				  <article>
						<?php
							$comment = "Quick India has been created to fulfill a vision of providing quality education through certified institutions. In the modern era, we aim to unify educational societies with the help of technology to build a better nation.";
							if(strlen($comment)>150){
								$replacement = "<span style='display:none;'>";
								$comment = substr_replace($comment,$replacement,150,0);
								$replacement = "</span>";
								$comment = substr_replace($comment,$replacement,strlen($comment),0);
								echo $comment;
								?>
								<a href="javascript:void(0);" class="read-more">Read More..</a>
								<a href="javascript:void(0);" class="read-less hide">Read Less </a>
								<?php
							}else{
								echo $comment;
							}
						?>
					</article>
                  
                </div>
              </div>
             
            </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="javascript:void(0)">
											<i class="fa fa-laptop"></i>
										</a>
                  <h6><strong>USP’s</strong></h6>
				<article>
						<?php
							$comment = "Quick India is the first technology-driven education start-up in India, providing a match-making solution for students' educational needs across all sectors.
					Quick India offers extensive in-house personalized counseling to understand each student's needs and help them make the most informed decisions.";
							if(strlen($comment)>150){
								$replacement = "<span style='display:none;'>";
								$comment = substr_replace($comment,$replacement,150,0);
								$replacement = "</span>";
								$comment = substr_replace($comment,$replacement,strlen($comment),0);
								echo $comment;
								?>
								<a href="javascript:void(0);" class="read-more">Read More..</a>
								<a href="javascript:void(0);" class="read-less hide">Read Less </a>
								<?php
							}else{
								echo $comment;
							}
						?>
					</article>
                  

                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
         
          <div class="col-md-3 col-sm-3 col-xs-12">
        
            <div class=" about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="javascript:void(0)">
											<i class="fa fa-trophy"></i>
										</a>
                  <h6><strong>Quick india  For Institutions</strong></h6>
				     <article>
						<?php
							$comment = "Quick India provides a non-conventional platform that focuses on delivering quality leads and highly motivated candidates. Our extensive in-house one-on-one personalized counseling gives us an edge in offering a highly specific and active database to our clients.";
							if(strlen($comment)>150){
								$replacement = "<span style='display:none;'>";
								$comment = substr_replace($comment,$replacement,150,0);
								$replacement = "</span>";
								$comment = substr_replace($comment,$replacement,strlen($comment),0);
								echo $comment;
								?>
								<a href="javascript:void(0);" class="read-more">Read More..</a>
								<a href="javascript:void(0);" class="read-less hide">Read Less </a>
								<?php
							}else{
								echo $comment;
							}
						?>
					</article>         
				 

                </div>
              </div>
             
            </div>
          </div>    
		  
		  <div class="col-md-3 col-sm-3 col-xs-12">
        
            <div class=" about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="javascript:void(0)">
											<i class="fa fa-user"></i>
										</a>
                  <h6><strong>Quick india  For Students</strong></h6>
				     <article>
						<?php
							$comment = "Students can use Quick India as a one-stop destination to search for information on coaching institutes, IT training centers, overseas education consultants, available courses, college admission processes, and much more. The website offers interactive tools to simplify the process of finding the right alma mater.

Quick India has a repository of over 1,000 institutes, coaching centers, schools, colleges, and 10,000 courses categorized into different streams such as IT training, civil services, entrance exam preparation, management, engineering, medical, arts, distance education, and more. Users can classify their education needs based on location, reviews, and certification.

Quick India's certified business partners ensure quality education, campus placements, top faculty, and fee refund assurance, providing students with a reliable and comprehensive platform for their educational needs.";
							if(strlen($comment)>150){
								$replacement = "<span style='display:none;'>";
								$comment = substr_replace($comment,$replacement,150,0);
								$replacement = "</span>";
								$comment = substr_replace($comment,$replacement,strlen($comment),0);
								echo $comment;
								?>
								<a href="javascript:void(0);" class="read-more">Read More..</a>
								<a href="javascript:void(0);" class="read-less hide">Read Less </a>
								<?php
							}else{
								echo $comment;
							}
						?>
					</article>            
				  

                </div>
              </div>
             
            </div>
          </div>
           
          
        </div>
      </div>
	    <div class="row text-center">
	  <!--<div class=""><img alt="Lead Management Software" class="rotateInLeft" src="{{asset('public/site/img/home-Quick india .png')}}"></div>-->
	  
	  </div>
	  
	  
    </div>
  </div>
   
   
    <!-- Start Service area -->
  
  
  <div id="features" class="services-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline services-head text-center">
            <h2>Quick India Application Features</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="services-contents">
         
		   <div class="">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="javascript:void(0)">
				<img alt="Lead Management Software" src="{{asset('/public/client/images/business/group.png')}}">
										</a>
                  <h4>Quick India: Leads Generation for Business</h4>
                  <ol><li><p><strong>Quality Leads</strong>:</p><ul><li>Generate high-quality leads for educational institutions and service providers.</li><li>Connects institutions with highly motivated and suitable candidates.</li></ul></li><li><p><strong>Targeted Marketing</strong>:</p><ul><li>Reach specific demographics and target audiences based on location, interests, and educational needs.</li><li>Customized marketing campaigns to attract potential students.</li></ul></li><li><p><strong>Personalized Counselling</strong>:</p><ul><li>Extensive in-house one-on-one counseling helps in understanding the needs and preferences of potential students.</li><li>Provides educational institutions with detailed insights and qualified leads.</li></ul></li><li><p><strong>Interactive Platform</strong>:</p><ul><li>Use interactive tools and features to engage with potential students.</li><li>Facilitate direct communication between students and educational institutions.</li></ul></li><li><p><strong>Database Access</strong>:</p><ul><li>Access to a vast database of students looking for various courses and educational opportunities.</li><li>Detailed profiles and data to help institutions tailor their offerings.</li></ul></li><li><p><strong>Reviews and Ratings</strong>:</p><ul><li>Leverage user reviews and ratings to build credibility and attract more leads.</li><li>Positive feedback and testimonials can enhance reputation and lead generation.</li></ul></li><li><p><strong>Certified Partnerships</strong>:</p><ul><li>Being a Quick India Certified Business Partner boosts credibility and trust.</li><li>Assurance of quality education and services attracts more leads.</li></ul></li><li><p><strong>Analytics and Reporting</strong>:</p><ul><li>Detailed analytics and reporting tools to track the effectiveness of lead generation efforts.</li><li>Insights into student preferences and behavior to refine marketing strategies.</li></ul></li><li><p><strong>Location-Based Leads</strong>:</p><ul><li>Generate leads based on specific geographic locations to target local students.</li><li>Customize offerings to meet the needs of the local student population.</li></ul></li><li><p><strong>Engagement Tools</strong>:</p><ul><li>Use forums, discussion boards, and community features to engage with potential leads.</li><li>Foster a sense of community and belonging to attract more students.</li></ul></li><li><p><strong>Career Counselling Integration</strong>:</p><ul><li>Integrate career counseling services to attract students looking for career guidance.</li><li>Position your institution as a comprehensive solution for education and career planning.</li></ul></li> </ol>
                   
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="javascript:void(0)">
					<img alt="Lead Management Software" src="{{asset('/public/client/images/business/head_phone.png')}}">
										</a>
                  <h4>Clearing of doubts using 'chat' with counselor</h4>
                  <ol><li><p><strong>Real-Time Support</strong>:</p><ul><li>Students can chat with certified counselors in real-time to get their queries answered promptly.</li><li>Immediate assistance for any doubts regarding courses, admissions, career paths, and more.</li></ul></li><li><p><strong>Personalized Guidance</strong>:</p><ul><li>One-on-one chat sessions to provide tailored advice based on individual student needs and preferences.</li><li>Helps in making informed decisions about educational and career choices.</li></ul></li><li><p><strong>Convenient and Accessible</strong>:</p><ul><li>Accessible through both desktop and mobile platforms, ensuring students can reach counselors anytime, anywhere.</li><li>User-friendly interface to facilitate smooth communication.</li></ul></li><li><p><strong>Comprehensive Assistance</strong>:</p><ul><li>Counselors can provide information on a wide range of topics, including course details, admission processes, scholarship opportunities, and more.</li><li>Support for both academic and career-related inquiries.</li></ul></li><li><p><strong>Interactive Tools</strong>:</p><ul><li>Use of interactive features such as document sharing, video calls, and screen sharing to enhance the chat experience.</li><li>Enables a more thorough and interactive counseling session.</li></ul></li><li><p><strong>Confidential and Secure</strong>:</p><ul><li>Ensures privacy and confidentiality of student information during chat sessions.</li><li>Secure platform to protect sensitive data and maintain trust.</li></ul></li><li><p><strong>Follow-Up Support</strong>:</p><ul><li>Counselors can schedule follow-up sessions to ensure all doubts are cleared and students are on the right path.</li><li>Continuous support throughout the decision-making process.</li></ul></li><li><p><strong>Feedback Mechanism</strong>:</p><ul><li>Students can provide feedback on their chat experience, helping to improve the quality of counseling services.</li><li>Counselors can track the effectiveness of their guidance and make necessary adjustments.</li></ul></li><li><p><strong>Resource Sharing</strong>:</p><ul><li>Counselors can share links, documents, and other resources directly through the chat to assist students.</li><li>Access to additional reading material, application forms, and relevant websites.</li></ul></li><li><p><strong>Integration with Other Features</strong>:</p><ul><li>Seamless integration with other platform features such as course comparisons, application tracking, and reviews.</li><li>Comprehensive support system combining various tools for a holistic counseling experience.</li></ul></li></ol>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
           
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="javascript:void(0)">
										<img alt="Lead Management Software" src="{{asset('/public/client/images/business/customized-training.png')}}">
										</a>
                  <h4>Real interactive class room and expert faculty Techer</h4>
                  <ol><li><p><strong>Live Virtual Classes</strong>:</p><ul><li>Real-time interactive sessions conducted by expert faculty members.</li><li>Engage students with dynamic content delivery and interactive learning tools.</li></ul></li><li><p><strong>Expertise and Experience</strong>:</p><ul><li>Faculty members with extensive knowledge and experience in their respective fields.</li><li>Provide insights, practical examples, and industry-relevant knowledge.</li></ul></li><li><p><strong>Engagement Tools</strong>:</p><ul><li>Use of interactive tools such as polls, quizzes, and live Q&amp;A sessions to keep students engaged.</li><li>Foster active participation and discussion among students.</li></ul></li><li><p><strong>Personalized Learning</strong>:</p><ul><li>Tailored teaching approaches to address individual learning styles and preferences.</li><li>Adaptive learning techniques to cater to diverse student needs.</li></ul></li><li><p><strong>Collaborative Learning Environment</strong>:</p><ul><li>Facilitate group discussions, peer-to-peer interaction, and collaborative projects.</li><li>Encourage teamwork and communication skills development.</li></ul></li><li><p><strong>Hands-on Activities</strong>:</p><ul><li>Incorporate practical demonstrations, case studies, and simulations to enhance learning outcomes.</li><li>Bridge theoretical knowledge with real-world applications.</li></ul></li><li><p><strong>Multimedia Integration</strong>:</p><ul><li>Utilize multimedia resources such as videos, presentations, and virtual labs to enrich the learning experience.</li><li>Enhance understanding and retention of complex concepts.</li></ul></li><li><p><strong>Feedback and Assessment</strong>:</p><ul><li>Provide immediate feedback on assignments, assessments, and student progress.</li><li>Continuous evaluation to track learning outcomes and address areas of improvement.</li></ul></li><li><p><strong>Accessible Learning Platform</strong>:</p><ul><li>Accessible through desktop and mobile devices, ensuring flexibility in learning.</li><li>Seamless integration with learning management systems for easy navigation and resource access.</li></ul></li><li><p><strong>Continuous Improvement</strong>:</p><ul><li>Faculty regularly update content and teaching methods based on student feedback and industry trends.</li><li>Commitment to delivering high-quality education and enhancing the learning experience.</li></ul></li></ol>
                </div>
              </div>
              
            </div>
          </div>
		  </div>
		   
		
           
          
		
      </div>
	  
	  
	  
    </div>
  </div>
  </div>
  
  
  
   <div class="wellcome-area">
    <div class="well-bg">
      <div class="test-overly"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="wellcome-text subscribe-form">
              <div class="well-text text-center">
                <h2>Welcome To Quick india </h2>
                <p>
                  Quick india  is the best place to track and crack your leads to generate and grow your business.
                </p>
				<div id="sendsubscribe">Your subscribe has been sent. Thank you!</div>
              <div id="errorsubscribe"></div>
			 
			   
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 @endsection
