@extends('business.layouts.app')
@section('title')
Personal Details
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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Personal Details</button>
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
            position: relative;
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

    .help-block{  
    color: #ff0000;
    position: relative;

    margin-top: 61px;
    display: block;
    margin-left: -207px;
    }
              </style>

                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                 
                <form class="personal_details" method="POST" onsubmit="return profileController.editPersonaleDetailsSave(this,<?php echo (isset($edit_data->id)? $edit_data->id:""); ?>)">
                        <input type="hidden" name="business_id" value="{{$edit_data->id}}">
                      
               
 
                 
                <div class="form-group">
                    <label>Title*:</label>
                    <select class="form-control" name="sirName">
                      <option value=""> Select Sir Name</option>
                      <option value="Ms" @if ('Ms'== old('sirName'))
                      selected="selected"	
                      @else
                      {{ (isset($edit_data) && $edit_data->sirName == 'Ms' ) ? "selected":"" }} @endif >Ms</option>
                      <option value="Mr" @if ('Mr'== old('sirName'))
                      selected="selected"	
                      @else
                      {{ (isset($edit_data) && $edit_data->sirName == 'Mr' ) ? "selected":"" }} @endif>Mr</option>
                      <option value="Mrs" @if ('Mrs'== old('sirName'))
                      selected="selected"	
                      @else
                      {{ (isset($edit_data) && $edit_data->sirName == 'Mrs' ) ? "selected":"" }} @endif>Mrs</option>
                    </select>
                    <label>First Name*:</label>
                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name',(isset($edit_data)) ? $edit_data->first_name:"")}}" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                    <label>Middle Name:</label>
                    <input type="text" class="form-control" value="{{ old('middle_name',(isset($edit_data)) ? $edit_data->middle_name:"")}}" name="middle_name" placeholder="Enter Middle Name">
                    <label>Last Name:</label>
                    <input type="text" class="form-control" value="{{ old('last_name',(isset($edit_data)) ? $edit_data->last_name:"")}}" name="last_name" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                    <label>DOB*:</label>
                    <input type="text" class="form-control dob" value="{{ old('dob',(isset($edit_data)) ? $edit_data->dob:"")}}" name="dob" placeholder="Enter DOB">
                    <label>Email ID*:</label>
                    <input type="email" class="form-control" value="{{ old('email',(isset($edit_data)) ? $edit_data->email:"")}}" name="email" placeholder="Enter Email" readonly>
                    
                </div>
                <div class="form-group">
                    <label>Marital Status*:</label>
                    <select class="form-control" name="marital">
              <option value="Single" @if ('Single'== old('marital'))
								selected="selected"	
							@else
							{{ (isset($edit_data) && $edit_data->marital == 'Single' ) ? "selected":"" }} @endif>Single</option>
            <option value="Married" @if ('Married'== old('marital'))
								selected="selected"	
							@else
							{{ (isset($edit_data) && $edit_data->marital == 'Married' ) ? "selected":"" }} @endif>Married</option>
                    </select>
                    <label>Mobile*:</label>
                   
                    <input type="text" class="form-control" name="mobile" value="{{ old('mobile',(isset($edit_data)) ? $edit_data->mobile:"")}}" placeholder="Enter Mobile" readonly>
                    
                </div>
                <div class="form-group">
                    <label> Second Mobile:</label>
 
                    <input type="text" class="form-control" name="sec_mobile" value="{{ old('sec_mobile',(isset($edit_data)) ? $edit_data->sec_mobile:"")}}" placeholder="Enter Sec Mobile">                   
                    <label>City:</label>
               
                  <select class="form-control" name="city">
                    <option value="">Select City</option>
                  @if($citys)
                  @foreach($citys as $city)
                  <option value="{{$city->city}}"  @if ($city->city== old('city'))
                  selected="selected"	
                  @else
                  {{ (isset($edit_data) && $edit_data->city == $city->city ) ? "selected":"" }} @endif>{{$city->city}}</option>
                  @endforeach
                  @endif
                  </select>

                </div>
                <div class="form-group">
                    <label>Area:</label>
                    <input type="text" class="form-control" name="area" value="{{ old('area',(isset($edit_data)) ? $edit_data->area:"")}}"  placeholder="Enter Area">
                    <label>Pincode:</label>
                    <input type="text" class="form-control" name="pincode" value="{{ old('pincode',(isset($edit_data)) ? $edit_data->pincode:"")}}"  maxlength="6" placeholder="Enter Pincode">
                </div>
                <div class="form-group">
                    <label>Occupation:</label>
                    <select class="form-control" name="occupation">
                      @if($occupations)
                      @foreach($occupations as $occupation)
                        <option value="{{$occupation->name}}"  @if ($occupation->name== old('occupation'))
                        selected="selected"	
                      @else
                      {{ (isset($edit_data) && $edit_data->occupation == $occupation->name ) ? "selected":"" }} @endif>{{$occupation->name}}</option>
                        @endforeach
                        @endif
                         
                      
                    </select>
                    <label>Gender:</label>
                    <select class="form-control" name="gender">
                        <option>Select Gender</option>
                        <option value="Male" @if ('Male'== old('gender'))
								selected="selected"	
							@else
							{{ (isset($edit_data) && $edit_data->gender == 'Male' ) ? "selected":"" }} @endif>Male</option>
                        <option value="Female" @if ('Female'== old('gender'))
								selected="selected"	
							@else
							{{ (isset($edit_data) && $edit_data->gender == 'Female' ) ? "selected":"" }} @endif>Female</option>
                        <option value="Other" @if ('Other'== old('gender'))
								selected="selected"	
							@else
							{{ (isset($edit_data) && $edit_data->gender == 'Other' ) ? "selected":"" }} @endif>Other</option>
                    </select>
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
<script>
 //$('.dob').datepicker({dateFormat:"yy-mm-dd"});
</script>
 @endsection