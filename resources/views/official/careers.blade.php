
@extends('client.layouts.app')
@section('title')
     Privacy Policy
@endsection
@section('content') 
<div class="about-bg page-hearder-area">
    <div class="official-overly"></div> 
  </div>   
  
  
  <div id="careers" class="about-area area-padding">
     <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Careers</h2>
          </div>
        </div>
      </div>
      <div class="row">
          
       <div class="col-md-6 col-sm-6 col-xs-12">
			<h4>Quick India have good opportunity of careers :-</h4>        
		<div class="well-middle">
            <div class="single-well">             
              
              
              <ul>
                <li>
                  <i class="fa fa-check"></i>IT hiring manager up front end skillls.
                </li>
                <li>
                  <i class="fa fa-check"></i>Key development tools with SEO Specialist Responsibilities.
                </li>
                 
				<li>
                  <i class="fa fa-check"></i>Open Web Developer with Designer.
                </li>
				<li>
                  <i class="fa fa-check"></i>Management Direction.
                </li>
				<li>
                  <i class="fa fa-check"></i>Quick India Lead provider Service Manager.
                </li>
				<li>
                  <i class="fa fa-check"></i>Opening Marketing Executive Operater Manager.
                </li>
				<li>
                  <i class="fa fa-check"></i>Opening Marketing Executive Telesales and Telemarketing Manager.
                </li>
				<li>
                  <i class="fa fa-check"></i>Opening Business Development Executive  
                </li>
				<li>
                  <i class="fa fa-check"></i>Digital Marketing   
                </li>
 

              </ul>
				
 
			</div>
			</div>

 
        </div>
        
		 <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form contact-form">
              <div id="sendmessage">Your Information has been sent. Thank you!</div>
              <div id="errormessage"></div>
              <form action="javascript:void()" method="post" role="form" class="careerForm">
                <div class="form-group">
				{{csrf_field()}}
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validation"></div>
                </div>
				<div class="form-group">
                  <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Your Mobile" data-rule="mobile" data-msg="Please enter mobile" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="designation" id="designation" placeholder="Enter Designation" data-rule="minlen:4" data-msg="Please enter designation" />
                  <div class="validation"></div>
                </div>

				<div class="form-group">
                  <input type="text" class="form-control" name="skills" id="skills" placeholder="Enter Skills" data-rule="minlen:4" data-msg="Please enter skills" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Job Description"></textarea>
                  <div class="validation"></div>
                </div>
                <div class="text-center"><button type="submit">Submit</button></div>
              </form>
            </div>
          </div>
		
         
      </div>
      <!-- end Row -->
    </div>
  
	 </div>
 @endsection
