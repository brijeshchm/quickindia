@extends('business.layouts.app')
@section('title')
Quick India | Business Keyword
@endsection 
@section('keyword')
Find Best It Training Centre near You, Find Best It Training Institute near You, Find Top 10 IT Training Institute near You, Find Best Entrance Exam Preparation Centre Near you, Top 10 Entrance Exam Centre Near you, Find Best Distance Education Centre Near You, Find Top 10 Distance Education Centre Near You, Find Best School And Colleges Near You, Find Top 10 school And College Near You, Get Education Loan, GET Free career Counselling, Find Best overseas education consultants Near you, Find Top 10 overseas education consultants Near you

@endsection
@section('description')
Find Only Certified Training Institutes, Coaching Centers near you on Estivaledge and Get Free counseling, Free Demo Classes, and Get Placement Assistence.
@endsection
@section('content')	
 

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Business keywords</h1>
    </div> 
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <!-- Table with stripped rows -->
               
                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                  <!-- Profile Edit Form -->
                     <form class="profileSave" method="POST">
                        <input type="hidden" name="business_id" value="">
                      
                   <!-- #endregion -->
 
                 
                <div class="form-group">
                    <label>City:</label>
                    <select class="form-control">
                        <option>Ms</option>
                        <option>Mr</option>
                        <option>Mrs</option>
                    </select>
                    <label>Zone:</label>
                     <select class="form-control">
                        <option>Single</option>
                        <option>Married</option>
                    </select>
                </div>
                
                
                
            <div class="text-center"> 
                 <input type="hidden" name="savePersonal" value="savePersonalForm">
                <button type="submit" class="btn btn-primary">Save & Continue</button>
        
              </div>
 

                  
                  </form><!-- End Profile Edit Form -->

                </div>
	
				<div class="row">
				    
				    
              <table width="100%" class="table table-striped table-bordered table-hover" id="datatable-assigned-keywords">
                <thead>
                  <tr>
                      
                    <th>Keywords</th>
                    <th>Parent Category</th>
                    <th>Child Category</th>
                    <th>City</th>
                     
                      
                  </tr>
                </thead>
                
                 </table>
            
 
</div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
@endsection
