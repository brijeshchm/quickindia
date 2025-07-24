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
                    <label>*Title:</label>
                    <select class="form-control">
                        <option>Ms</option>
                        <option>Mr</option>
                        <option>Mrs</option>
                    </select>
                    <label>*First Name:</label>
                    <input type="text" class="form-control" value="aryan">
                </div>
                <div class="form-group">
                    <label>Middle Name:</label>
                    <input type="text" class="form-control" placeholder="Enter Middle Name">
                    <label>Last Name:</label>
                    <input type="text" class="form-control" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                    <label>*DOB:</label>
                    <input type="text" class="form-control" placeholder="Enter DOB">
                    <label>Email ID:</label>
                    <input type="email" class="form-control" placeholder="Enter Email">
                    
                </div>
                <div class="form-group">
                    <label>*Marital Status:</label>
                    <select class="form-control">
                        <option>Single</option>
                        <option>Married</option>
                    </select>
                    <label>Mobile:</label>
                   
                    <input type="text" class="form-control" value="9318345497">
                    
                </div>
                <div class="form-group">
                    <label>Mobile 2:</label>
 
                    <input type="text" class="form-control" placeholder="">
                   
                    <label>City:</label>
                    <input type="text" class="form-control" placeholder="Enter City">
                </div>
                <div class="form-group">
                    <label>Area:</label>
                    <input type="text" class="form-control" placeholder="Enter Area">
                    <label>Pincode:</label>
                    <input type="text" class="form-control" placeholder="Enter Pincode">
                </div>
                <div class="form-group">
                    <label>Occupation:</label>
                    <select class="form-control">
                        <option>Employed</option>
                        <option>Unemployed</option>
                    </select>
                    <label>Gender:</label>
                    <select class="form-control">
                        <option>Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
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

 @endsection