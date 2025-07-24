@extends('business.layouts.app')
@section('title')
Quick India | Students
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
      <h1>Lead</h1>
    </div> 
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <!-- Table with stripped rows -->
               
              
				<div class="row">
				    
				     <div id="leads_filter" class="col-md-12" style="border-bottom:2px solid #E6E9ED;margin-bottom:10px;padding-bottom:10px;">
							<form method="GET" action="" novalidate autocomplete="off" class="row g-3">
							    
                            <div class="col-md-4">
                            <label for="Date From" class="form-label">Date From </label>
                            <input type="text" class="form-control leaddf"  value="{{ old('search[leaddf]',(isset($search['leaddf'])) ? $search['leaddf']:"")}}" name="search[leaddf]" placeholder="Create Date From">
                            </div>
                            <div class="col-md-4">
                            <label for="validationDefault02" class="form-label">Date To</label>
                            <input type="text" class="form-control leaddt"  value="{{ old('search[leaddt]',(isset($search['leaddt'])) ? $search['leaddt']:"")}}"  name="search[leaddt]" placeholder="Create Date To">
                            </div>
								 
							  <div class="col-md-4">
                            <label for="filter" class="form-label"></label>
                           	<button type="submit" class="form-control btn btn-block btn-info" style="margin-top: 7px;">Filter</button>
                            </div>
								 
							 
						 
								  
							</form>
						</div>
              <table width="100%" class="table table-striped table-bordered table-hover" id="datatable-view-all-students">
                <thead>
                  <tr>
                      
                    <th>
                    <b>N</b>ame
                    </th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>course</th>
                    <th>City</th>
                     <th>Date</th>
                     <th>Action</th>
                  </tr>
                </thead>
                
                 </table>
            
 
</div>
            </div>
          </div>

        </div>
      </div>
    </section>
    
    <div id="followUpModal" class="modal fade" role="" aria-hidden="false">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
				<!--	<button type="button" class="close" data-dismiss="modal" style="float: right;">&times;</button>-->
					
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					<h4 class="modal-title">Follow Up</h4>
				</div>
				<div class="modal-body" style="padding-top:0">
				</div>
			</div>
		</div>
	</div>


<style>
.x_content{
    padding: 0 5px 6px;
    float: left;
    clear: both;
    margin-top: 5px;
}
.form-label-left .row {
    margin-left: 5px;
}
.form-label-left .col-form-label {
    font-weight: 700;
}
.form-label-left .col-md-4{
    
    
}
.modal-header{
        display: block;
    
}
.btn {
    margin-right: 5px;
}
.close {
    border: none;
    background: #fff;
}
.form-control-static{
    margin-top: 8px;
    margin-bottom: 1rem;
}
 
</style>
  </main><!-- End #main -->
  
 

<script>
 //$('.leaddf,.leaddt').datepicker({dateFormat:"yy-mm-dd"});
</script>
@endsection
