@extends('site.layouts.app')
@section('title')
@if(!empty($coursesdetails->title))	 
 {{$coursesdetails->title}}; 
@else
	Croma Campus- Best IT Training Institute in Noida | Delhi | Gurgaon
@endif
@endsection 
@section('keyword')
@if(!empty($coursesdetails->meta_keyword))
	{{$coursesdetails->meta_keywords}};
@else
	Croma Campus: Best IT Training Institute in Noida | Delhi | Gurgaon
@endif
@endsection
@section('description')
@if(!empty($coursesdetails->meta_description))
{{$coursesdetails->meta_description}};
@else
	Croma campus Best IT Training Institute in Noida | Delhi | Gurgaon for Industrial Training. We conducts IT Software, Hardware, Network &amp; Security Courses training. Corporate Trainer commands all training program. Week Days, Weekend, 6 Week, 6 Months Industrial Training are available
@endif
@endsection
@section('content')
<style>
	  a.disabled {
  pointer-events: none;
  cursor: default;
}  


tr th{
	padding: 0px 10px;
}
.transaction-section table tr {
    border-bottom: 1px solid #6d6d6d;
    line-height: 2.9;
}

.transaction-section table tr td {
    text-align: left;
}
@media only screen and (max-width: 767px){
	.red-heading{
		font-size:12px;
	}
	#invoicePrintPdf{
		    margin-left: 70% !important;
    margin-top: 11px !important;
	}
}
	</style>
 
<div class="main">	
		<section class="fee-deposit">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						 <nav>
		                    <div class="nav payment-form" role="tablist">
			                    <a class="nav-item disabled" data-toggle="tab" href="#Student-Detail" role="tab" aria-controls="nav-home" aria-selected="true" >Details</a>
			                    <a class="nav-item disabled" data-toggle="tab" href="#transaction" role="tab" aria-controls="nav-profile" aria-selected="false" >Transaction</a>
			                   
			                    <a class="nav-item active" data-toggle="tab" href="#confirmation" role="tab" aria-controls="nav-about" aria-selected="false">Confirmation</a>
								
							<a class="nav-item"  data-toggle="tab" href="#faceanissue" role="tab" aria-controls="nav-home" aria-selected="true">Face an issue</a>
		                    </div>
		                </nav>
		                <div class="tab-content">
		                     
		                    <div class="tab-pane fade show active" id="confirmation" role="tabpanel" aria-labelledby="confirmation">
		                      <div class="transaction-section">
							 					  
							  
							<table>
							<tr>
							<td><strong>Summary</strong></td>
							<td><strong>Details</strong></td>
							</tr>
							<tr style="background-color:#ddd;color:#003453;">
							<th>Order Id</th>

							<td> <?php echo isset($_GET['order_id'])?$_GET['order_id']:""; ?></td>
							</tr> 							
							  
							
							<tr style="background-color:#f4f5f7;color:#003453;">
							<th>Name</th>

							<td><?php echo isset($_GET['card_holder_name'])?ucfirst($_GET['card_holder_name']):""; ?></td>
							</tr>
							<tr style="background-color:#ddd;color:#003453;">
							<th>Email</th>

							<td><?php echo isset($_GET['email'])?$_GET['email']:""; ?></td>
							</tr>
							<tr style="background-color:#f4f5f7;color:#003453;">
							<th>Course</th>

							<td><?php echo isset($_GET['course'])?$_GET['course']:""; ?></td>
							</tr>
							<tr style="background-color:#ddd;color:#003453;">
							<th>Amount</th>

							<td><?php echo isset($_GET['merchant_amount'])?$_GET['merchant_amount']:""; ?></td>
							</tr>
							<tr style="background-color:#f4f5f7;color:#003453;">
							<th>Pay To</th>

							<td> <?php echo isset($_GET['pay_to'])?$_GET['pay_to']:""; ?></td>
							</tr>
							
							<tr style="background-color:#ddd;color:#003453;">
							<th>Payment id</th>

							<td> <?php echo isset($_GET['payment_id'])?$_GET['payment_id']:""; ?></td>
							</tr>
							
							<tr style="background-color:#f4f5f7;color:#003453;">
							<th>Contact</th>

							<td><?php echo isset($_GET['phone'])?$_GET['phone']:""; ?></td>
							</tr>							 
							 
							<tr style="background-color:#ddd;color:#003453;">
							<th>Address</th>

							<td><?php echo $_GET['city'].', '.$_GET['billing_state'].', '.$_GET['billing_country']; ?></td>
							</tr>
												 
							<tr style="background-color:#f4f5f7;color:#003453;">
							<th>Pay Date</th>

							<td> <?php 	  
							echo date('j<\s\u\p>S</\s\u\p> M Y',strtotime(date('Y-m-d'))); ?></td>
							</tr>
							<tr style="border:none">
							<td>
							<a href="javascript:void(0);" id="invoicePrintPdf" class="btn btn-primary" data-sid="<?php echo $_GET['order_id']; ?>" style="margin-left: 78%;width: 88px;"> <i class="fa fa-print"></i> Print</a></td>
							</tr>

							</table>

								
																
																
						</div>
		                    </div>
		                    
		                    <div class="tab-pane fade" id="faceanissue" role="tabpanel" aria-labelledby="faceanissue">
								<div class="student-payment">
		                      		<h3>Face an issue</h3>
		                      		<form method="POST" onsubmit="return homeController.faceAnIssue(this)" action="" autocomplete="off">
		                       
		                      			<div class="form-inline">
										<input type="hidden" name="_token" value="{{ csrf_token() }}" />
										<div class="ans">
										    <input type="text" name="name" value="{{ old('name', (isset($data->name)) ? $data->name:"")}}" class="form-control" placeholder="Enter Full Name *">
											
										@if ($errors->has('name'))
											<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
										 
										@endif
										</div>
										<div class="ans">
										    <input type="text" name="email" value="{{ old('email',(isset($data->email)) ? $data->email:"")}}"  class="form-control" placeholder="E-mail *">
										    @if ($errors->has('email'))
											<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
										 
										@endif
										</div>
										</div>
		                      			<div class="form-inline">	
										   <div class="ans">
											 <input type="text" name="phone" value="{{ old('phone',(isset($data->phone)) ? $data->phone:"")}}"  class="form-control" maxlength="16" onkeypress="return isNumberKey(event);" placeholder="Contact No. *">
											 @if ($errors->has('phone'))
											<span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>
										 
										@endif
										</div>
										<div class="ans">
										  <textarea type="text" name="remark" class="form-control" placeholder="Enter Face an issue remark *">{{ old('remark',(isset($data->remark)) ? $data->remark:"")}}</textarea>
											@if ($errors->has('remark'))
											<span class="help-block"><strong>{{ $errors->first('remark') }}</strong></span>
										 
										@endif
										</div>
		                      			</div>  
									   
									    <button type="submit" class="face-issue-button" name="submit">Submit</button>
									</form>
		                      	</div>
							</div>
		                      
		                </div>
					</div>
				</div>
			</div>
		</section>

		 
	</div>
<script src="{{asset('select2/js/select2.full.js')}}" async></script>

<script>
/* 
 $(document).ready(function() {
	 alert('ss');

}); */
 //$(".select_country").select2();
</script>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
 /*  $(document).on('click', '#razor-pay-now', function (e) {
	  
    var total = (jQuery('form#razorpay-frm-payment').find('input#amount').val() * 100);
    var merchant_order_id = jQuery('form#razorpay-frm-payment').find('input#merchant_order_id').val();
    var merchant_surl_id = jQuery('form#razorpay-frm-payment').find('input#surl').val();
    var merchant_furl_id = jQuery('form#razorpay-frm-payment').find('input#furl').val();
    var card_holder_name_id = jQuery('form#razorpay-frm-payment').find('input#billing-name').val();
    var address = jQuery('form#razorpay-frm-payment').find('input#billing_address').val();
    var merchant_total = total;
    var merchant_amount = jQuery('form#razorpay-frm-payment').find('input#amount').val();
    var currency_code_id = jQuery('form#razorpay-frm-payment').find('input#currency').val();
    var key_id = jQuery('form#razorpay-frm-payment').find('input#RAZOR_KEY_ID').val();
  //  var key_id = "<?php echo RAZOR_KEY_ID; ?>";
    var store_name = 'Croma Campus Pvt Ltd';
    var store_description = 'Fees Pay';
    var store_logo = 'https://www.cromacampus.com/wp-content/themes/cromacampus/assets/img/logo.png';
    var email = jQuery('form#razorpay-frm-payment').find('input#billing-email').val();
    var phone = jQuery('form#razorpay-frm-payment').find('input#billing-phone').val();
    var course = jQuery('form#razorpay-frm-payment').find('input#course').val();
    var billing_country = jQuery('form#razorpay-frm-payment').find('input#billing_country').val();
    var city = jQuery('form#razorpay-frm-payment').find('input#city').val();
    
    jQuery('.text-danger').remove();

    if(card_holder_name_id=="") {
      jQuery('input#billing-name').after('<small class="text-danger">Please enter full mame.</small>');
      return false;
    }
    if(email=="") {
      jQuery('input#billing-email').after('<small class="text-danger">Please enter valid email.</small>');
      return false;
    }
    if(phone=="") {
      jQuery('input#billing-phone').after('<small class="text-danger">Please enter valid phone.</small>');
      return false;
    }
    
    var razorpay_options = {
        key: key_id,
        amount: merchant_total,
        name: store_name,
        description: store_description,
        image: store_logo,
        netbanking: true,
        currency: currency_code_id,
        prefill: {
            name: card_holder_name_id,
            email: email,
            contact: phone
        },
        notes: {
            soolegal_order_id: merchant_order_id,
        },
        handler: function (transaction) {
            jQuery.ajax({
                url:'/razorPayCheckout',
                type: 'post',
                data: {razorpay_payment_id: transaction.razorpay_payment_id, merchant_order_id: merchant_order_id, merchant_surl_id: merchant_surl_id, merchant_furl_id: merchant_furl_id, card_holder_name_id: card_holder_name_id, merchant_total: merchant_total, merchant_amount: merchant_amount, currency_code_id: currency_code_id,pay:store_name,course:course,email:email,phone:phone,address:address,billing_country:billing_country,city:city}, 
                dataType: 'json',
                success: function (res) {		 
			var obj =  jQuery.parseJSON(res.data);
			   
                    if(res.msg){
                        alert(res.msg);
                        return false;
                    } 
                  //  window.location = res.redirectURL;
                   window.location = res.redirectURL+'?getpay='+obj.getpay+'&card_holder_name='+obj.card_holder_name+'&merchant_amount='+obj.merchant_amount+'&order_id='+obj.order_id+'&currency_code_id='+obj.currency_code+'&pay_to='+obj.pay_to+'&course='+obj.course+'&email='+obj.email+'&phone='+obj.phone+'&address='+obj.address+'&payment_id='+obj.razorpay_payment_id+'&billing_country='+obj.billing_country+'&city='+obj.city;
                   // window.location = res.redirectURL+'?oridd='+razorpay_payment_id+'&'+card_holder_name_id;
					//return false;
                }
            });
        },
        "modal": {
            "ondismiss": function () {
                // code here
            }
        }
    };
    // obj        
    var objrzpv1 = new Razorpay(razorpay_options);
    objrzpv1.open();
        e.preventDefault();
            
}); */
</script>





@endsection