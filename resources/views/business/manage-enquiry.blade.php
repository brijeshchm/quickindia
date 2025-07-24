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
          
               
              
              
               <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  

                  <div class="row">
                    <div class="col-lg-4 col-md-4 label "> Pause Lead: </div>
                    <div class="col-lg-4 col-md-8"> <form class="profileSave" method="POST">
                 
        
                    
                    <?php   $clientID = auth()->guard('clients')->user()->id;

                      $client = App\Models\Client\Client::find($clientID);  ?>
                        <div class="form-check form-switch">
                       
                         <input class="form-check-input" type="checkbox" id="pauseLeadChecked"  value="{{ $client->pauseLead??'' }}" data-client_id="{{ $client->id }}" @if(!empty($client->pauseLead)) {{ "checked"}} @endif>
                      
                        </div>
                
                 
          
 

                  
                  </form> </div>
                   
                     
                  </div>
                    <div class="row">
                    <div class="col-lg-4 col-md-4 label ">Client Paid Status : </div>
                    <div class="col-lg-4 col-md-8"> Active</div>
                     
                     <div class="col-lg-3 col-md-8"> <a href="">Un-Paid</a></div>
                  </div>
                  
                       


             
                </div>
              </div> 
              
              

            </div>
          </div>

        </div>
     
      </div>
    </section>

  </main><!-- End #main -->

 @endsection