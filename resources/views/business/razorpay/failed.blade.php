@extends('site.layouts.app')
@section('title')
@if(!empty($coursesdetails->title))	 
 {{$coursesdetails->title}}; 
@else
	Crom Campus- Best IT Training Institute in Noida | Delhi | Gurgaon
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

  
<div class="main">	
		<section class="fee-deposit">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						 
		                <div class="tab-content">
		                     
		                    <div class="tab-pane fade show active" id="transaction" role="tabpanel" aria-labelledby="transaction">
		                      <div class="transaction-section">
							   <section class="showcase">
   <div class="container">
    <div class="text-center">
      <h1 class="display-3">Thank You!</h1>
      <p class="lead text-danger">Your transaction has been declined.</p>
      <hr>
      <p>
        Having trouble? <a href="mailto:info@cromacampus.com">Contact us</a>
      </p>
      <p class="lead">
        <a class="btn btn-primary btn-sm" href="{{url('fees-deposit')}}" role="button">Continue to Pay Fees</a>
      </p>
    </div>
    </div>
</section>
							  
							  
							 
								
																
																
								 
		                      </div>
		                    </div>
		                     
		                </div>
					</div>
				</div>
			</div>
		</section>

		 
	</div>
 





@endsection