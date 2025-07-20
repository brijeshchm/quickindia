<style>
.inquiryForm .form .validation {
    color: red;
  //  display: none;
    margin: 0 0 20px;
    font-weight: 400;
    font-size: 13px;
}
</style>
	<!-- Modal -->

			<div class="modal fade" id="enquiryModel" tabindex="-1" role="dialog" aria-labelledby="schedule-popup-label" aria-hidden="true">

			  <div class="modal-dialog modal-lg">

			   <div class="modal-content">

				<div class="modal-header">
 
				 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i>

				 </span></button>

				 <h4 class="modal-title" id="sendinquiry">Your message has been sent. Thank you!</h4>
				<div id="errorinquiry"></div>
			   </div>

			   <div class="modal-body">
 
				 <!--row-->
				<div class="row">
					<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
					<img src="{{asset('site/images/inquiry.png')}}" />
					</div>
					<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

				 <div class="my-widget">

					<form method="post" action="" for="form" class="addenquiryvalidation" autocomplete="off">
{{csrf_field() }}
								<div class="form-group">
								<div class="inner-addon left-addon">
								<i class="fa fa-user fa-lg"></i>
								<input type="hidden" name="iq_course_name" class="form-control" value="{{Request::segment(1)}}">
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
								<input type="checkbox" value="1" id="iq_check_sidebar" name="iq_check_sidebar" class="css-checkbox" data-rule="iq_check_sidebar" data-msg="Please checked">
								<div class="validation"></div>
								<label for="iq_check_sidebar" class="css-label human" style="background-position: 0px 0px;">I am Human.</label>
							 
								</div>
								</div>

								<input type="submit" class="btn btn-submit" value="Submit">
								 
								</form>



					</div>
					</div>
					</div>

			 <!--row-->

			</div>



			</div>

			</div>

			</div>


<style>
#scholarship-exam-modal .modal-dialog .modal-content .modal-header {
    background: #313b3d;
    color: #fff;
    text-transform: uppercase;
    border-bottom: 1px solid #e5e5e5;
}

#scholarship-exam-modal h4>img {
    width: 35px;
    height: 35px;
    position: absolute;
    left: 15px;
    top: 8px;
}
.modal-title {    
    color: #008000;
	display:none;
}
 
.pull-right {   
    padding-left: 70px;
}


</style>

<!--End Scholarship Exam-->
<!--Start Jonportal Exam-->
 

<style>
#jobportalModal .modal-header, #jobportalModal h4, #jobportalModal .close {
  background-color: #313b3d;
  color:white !important;
  text-align: center;
  font-size: 30px;
}
.modal-footer, #login-button {
  background-color: #313b3d;
  border: 1px solid #313b3d;
}
</style>
<div class="container">
  <!-- Modal -->
   
</div>
<!--End Jonportal Exam-->

