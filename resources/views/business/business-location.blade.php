@extends('business.layouts.app')
@section('title')
Location Service | Location
@endsection 
@section('keyword')
Find Best It Training Centre near You, Find Best It Training Institute near You, Find Top 10 IT Training Institute near You, Find Best Entrance Exam Preparation Centre Near you, Top 10 Entrance Exam Centre Near you, Find Best Distance Education Centre Near You, Find Top 10 Distance Education Centre Near You, Find Best School And Colleges Near You, Find Top 10 school And College Near You, Get Education Loan, GET Free career Counselling, Find Best overseas education consultants Near you, Find Top 10 overseas education consultants Near you

@endsection
@section('description')
Find Only Certified Training Institutes, Coaching Centers near you on Quick India and Get Free counseling, Free Demo Classes, and Get Placement Assistence.
@endsection
@section('content')	
<style>
    .help-block{  
    color: #ff0000;
    position: relative;
    margin-top: 61px;
    display: block;
    margin-left: -150px;
    }
    .select2-container--bootstrap .select2-selection--single {
    height: 46px !important;
    line-height: 1.42857143;
    padding: 6px 24px 6px 12px;
}
</style>
  <main id="main" class="main">
    <section class="section profile">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Business Location</button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
               
                     <form class="buss_location" method="POST" onsubmit="return businessController.saveBusinessLocation(this,<?php echo (isset($client->id)? $client->id:""); ?>)">
                        <input type="hidden" name="client_id" value="{{$client->id}}">                 
                 
                <div class="form-group">
                    <label>City:</label>
                    <select class="form-control select2-city" name="city_id" onchange="get_zone(this.value);">

                      <option value="">Select City</option>
                        @if(!empty($citylist))
                          @foreach($citylist as $city)                       
                        <option value="{{ $city->id}}">{{$city->city}}</option>
                        @endforeach
                        @endif
                      
                    </select>
                    <label>Zone:</label>
                     <select class="form-control show_zoneList" name="zone_id" onchange="get_otherZone(this.value);">
                     
                    </select>
                    <div class="show_otherInput" ></div>

                </div>                            
                
            <div class="text-center"> 
                 <input type="hidden" name="savePersonal" value="savePersonalForm">
                <button type="submit" class="btn btn-primary">Save & Continue</button>
        
              </div>
 

                  
                  </form><!-- End Profile Edit Form -->

                </div>
	<div class="row"> 
      <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="datatable-assigned-zones" role="grid" aria-describedby="datatable-assigned-zones_info" style="width: 100%;">
					<thead>
					<tr role="row">
            <th>City</th><th>Zone</th><th>Action</th></tr>
					</thead>
					 
      
      </table>
                
              </div> 
              </div> 

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

<script>

function get_zone(city,zone){

	var token = $('input[name=_token]').val();
	$.ajax({
	type: "post",	 
	url: "{{URl('business/zone/getAjaxZone')}}",
	data: {city:city,zone:zone},
	headers: {'X-CSRF-TOKEN': token},		
	cache: false,
	success: function(data)
	{
		$(".show_zoneList").html(data);
	}
	});
}


function get_otherZone(other){
 
 if(other == 'Other'){
		$(".show_otherInput").html('<input class="form-control" value="" name="other" style="margin-top: 22px;">');
 }else{
  
    $(".show_otherInput").html('');

 }
	 
}
</script>
 @endsection