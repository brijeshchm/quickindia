@extends('business.layouts.app')
@section('title')
Gallary Picture Quick India
@endsection 
@section('keyword')
Find Best It Training Centre near You, Find Best It Training Institute near You, Find Top 10 IT Training Institute near You, Find Best Entrance Exam Preparation Centre Near you, Top 10 Entrance Exam Centre Near you, Find Best Distance Education Centre Near You, Find Top 10 Distance Education Centre Near You, Find Best School And Colleges Near You, Find Top 10 school And College Near You, Get Education Loan, GET Free career Counselling, Find Best overseas education consultants Near you, Find Top 10 overseas education consultants Near you

@endsection
@section('description')
Find Only Certified Training Institutes, Coaching Centers near you on Estivaledge and Get Free counseling, Free Demo Classes, and Get Placement Assistence.
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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Gallery Picture</button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                  <!-- Profile Edit Form -->
                    <?php if(!empty($client->pictures)):
                    $picture = unserialize($client->pictures);
                   // echo "<pre>";print_r($picture);
                    /* $picture = array_diff($picture, array('')); */
                    /* $picture = array_slice($picture,0);
                    for($i=(count($picture));$i<12;$i++){
                    $picture[$i]['large']['name'] = '';
                    } */
                    for($i=0;$i<12;$i++){
                    if(!isset($picture[$i])){
                    $picture[$i]['large']['name'] = '';
                    }
                    }
                    else:
                    for($i=0;$i<12;$i++){
                    $picture[$i]['large']['name'] = '';
                    }
                    endif; ?>
                  <form action="{{url('business/saveGallary')}}" id="imageform" method="post" enctype="multipart/form-data">
                     {{csrf_field()}}
                     <input type="hidden" name="business_id" value="{{$client->id}}">
                    <div class="row mb-3">
                        <?php for($i=0;$i<12;$i++){
                      
                      ?>
                      <div class="col-md-4 col-lg-4" id="image{{$i+1}}">
                        	@if(empty($picture[$i]['large']['name']))
						<input type="file" class="form-control" name="image{{$i+1}}" accept=".png, .jpg, .jpeg">
						@endif
						<span class="help-block">
							@if(isset($picture[$i]['large']['src'])&&!empty($picture[$i]['large']['src']))
							<img src="{{asset('public/'.$picture[$i]['large']['src'])}}" style="height:75px;width:75px;">
							<a href="javascript:void(0)" class="remove-thumbnail btn btn-danger btn-sm" data-srno="image{{$i+1}}" title="remove"><i class="bi bi-trash" aria-hidden="true"></i></a>
							@endif
						</span>
                       <div class="pt-2"></div>
                       <!-- <div class="pt-2">
                          <a href="javascript:void(0);" id="getImage" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                         
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                           <div id="preview" onclick="kiyo()"></div>
                        </div>-->
                      </div>
                      <?php  } ?>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="fourth_form_submit" value="Save &amp; Exit">Save Changes</button>
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