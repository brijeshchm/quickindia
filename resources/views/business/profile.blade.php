@extends('business.layouts.app')
@section('title')
Profile Quick India
@endsection 
@section('keyword')
Find Best It Training Centre near You, Find Best It Training Institute near You, Find Top 10 IT Training Institute near You, Find Best Entrance Exam Preparation Centre Near you, Top 10 Entrance Exam Centre Near you, Find Best Distance Education Centre Near You, Find Top 10 Distance Education Centre Near You, Find Best School And Colleges Near You, Find Top 10 school And College Near You, Get Education Loan, GET Free career Counselling, Find Best overseas education consultants Near you, Find Top 10 overseas education consultants Near you

@endsection
@section('description')
Find Only Certified Training Institutes, Coaching Centers near you on Quick India and Get Free counseling, Free Demo Classes, and Get Placement Assistence.
@endsection
@section('content')	

  <main id="main" class="main">
    <section class="section profile">
      <div class="row">
        
        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

 
 
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Profile Information</button>
                </li>

                <li class="nav-item profile_success">
                    </li>
 

              </ul>
              <div class="tab-content pt-2">

             <style>
 .form-control {
            flex: 1;
            padding: 12px;
            background: #f5f5f5;
            border: 2px solid #ddd;
            border-radius: 4px;
            color: #000;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #a5a2c9;
            background: #fff;
        }
         .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 15px;
        }

        .form-group label {
            color: #000;
            font-size: 1em;
            flex: 0 0 150px;
            letter-spacing: 1px;
        }

              @media (max-width: 768px) {
           
            .form-group {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-group label {
                flex: none;
            }

            .form-control {
                width: 100%;
                border-radius: 4px;
            }

            .verify-btn, .image-upload button, .save-btn {
                border-radius: 4px;
            }
        }

        
              </style>
             

                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">



                <form class="profileSave" method="POST">
                        <input type="hidden" name="business_id" value="{{$client->id}}">
                      
                   <!-- #endregion -->
 
                 
                <div class="form-group">
                    <label>Business Name:</label>
                  
                      <input type="hidden" name="business_id" value="{{$client->id}}">
                       <input name="business_name" type="text" class="form-control" value="<?php if($client->business_name){ echo $client->business_name; } ?>">
                    <label>*Email:</label>
                      <input name="email" type="email" class="form-control" id="Email" value="<?php if(!empty($client->email)){ echo $client->email; } ?>" placeholder="Please enter Email" readonly>
                </div>
                <div class="form-group">
                    <label>Address:</label>
                     <textarea name="address" class="form-control" id="about" style="height: 100px">{{$client->address}}</textarea>
                    <label>Landmark:</label>
                    <input name="landmark" type="text" class="form-control"   value="<?php if($client->landmark){ echo $client->landmark; } ?>">
                </div>
                <div class="form-group">
                    <label>City:</label>
                    <select class="form-control dropdown-arrow dropdown-arrow-inverse city-form select2-single city" name="city">
						<option value="">Select City</option>
						@if(!empty($client->city))
						<option value="{{$client->city}}" selected>{{$client->city}}</option>
						@endif
						
						</select>
                    <label>State:</label>
                    <?php $states = getStates(); ?>
						<select class="select2-single-state form-control" id="state" name="state">
							<?php
								$selected = '';
								foreach($states as $state){
									$selected = ($state==$client->state)?"selected":"";
									echo "<option value=\"".$state."\" ".$selected.">".$state."</otpion>";
								}
							?>
						</select>
                    
                </div>
                <div class="form-group">
                    <label>Country:</label>
                   	<input type="text" class="form-control" id="country" name="country" value="{{$client->country}}">
                    <label>year of Establishment:</label>              
                        <input name="year_of_estb" type="text" class="form-control" value="<?php if($client->year_of_estb){ echo $client->year_of_estb; } ?>" placeholder="Please enter (YYYY)" maxlength="4">
                    
                </div>
                <div class="form-group">
               
                    <label>Business Info:</label>
                   
                     <textarea name="business_intro" class="form-control" id="about" style="height: 100px">{{$client->business_intro}}</textarea>
                    
                </div>

                <div class="form-group">
              
                    <label>Certifications(Comma separated if more than 1):</label>
                        <input name="certifications" type="text" class="form-control" value="<?php echo (empty($client->certifications))?"":implode(',',unserialize($client->certifications)); ?>">
                </div>
                <div class="form-group">
                    <label>Area:</label>
                    <input type="text" class="form-control" placeholder="Enter Area">
                    <label>Pincode:</label>
                    <input type="text" class="form-control" placeholder="Enter Pincode">
                </div>
              
                   <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Hours of Operation</label>
                      <div class="col-md-4 col-lg-4">
                         <label class="radio-inline"><input type="radio" name="display_hofo" value="0" <?php echo (empty($client->display_hofo) || $client->display_hofo == '0')?"checked":""; ?>>Display Hours of Operation</label>
                      </div>
                       <div class="col-md-4 col-lg-5">
                         <label class="radio-inline"><input type="radio" name="display_hofo" value="1" <?php echo (!empty($client->display_hofo) || $client->display_hofo == '1')?"checked":""; ?>>Do Not Display Hours of Operation</label>
                      </div>
                    </div>
                 
            <div class="text-center"> 
                 <input type="hidden" name="savePersonal" value="savePersonalForm">
                <button type="submit" class="btn btn-primary">Save & Continue</button>
        
              </div>
 

                  
                  </form><!-- End Profile Edit Form -->

                 
                </div>

                 
                
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

 @endsection