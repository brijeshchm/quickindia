@extends('business.layouts.app')
@section('title')
Profile Logo Quick India
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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Profile Logo & Banner </button>
                </li>
                <li class="nav-item profile_success"></li>
              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                     
                      <form action="{{url('business/saveProfileLogo')}}" id="imageform" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <input type="hidden" name="business_id" value="{{$client->id}}">
                      <div class="row mb-3{{ $errors->has('image') ? ' has-error' : '' }}">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Company Logo </label>
                      <div class="col-md-8 col-lg-9">
                         
                          <?php
							$image = '#';
							if(!empty($client->logo)){
								$logo = unserialize($client->logo);
								if(!isset($logo['thumbnail'])){
									$logo['thumbnail'] = $logo['large'];
								}								
								$image = $logo['large']['src'];
							 
						?>
						 <img src="<?php echo asset('/'.$image); ?>" alt="Profile">
						<a href="{{url('business/profileLogo/logoDel/'.$client->id)}}" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
						<?php  }else{ ?>
                        
                         <input type="file" class="form-control" name="image">
                        	@if ($errors->has('image'))
						<span class="help-block">
							<strong><?php
								foreach ($errors->get('image') as $message) {
									echo $message."<br>";
								}
							?></strong>
						</span>
					@endif
                        <?php  } ?>
                      </div>
                    </div>
                    <div class="row mb-3 {{ $errors->has('profile_pic') ? ' has-error' : '' }}">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Busness Banner</label>
                      <div class="col-md-8 col-lg-9">
                        <?php	
                        if(!empty($client->profile_pic)){
                        $profile_pic = unserialize($client->profile_pic);
                        ?>	
                        <img src="<?php echo asset('/'.$profile_pic['large']['src']); ?>" alt="Profile">
                        <a href="{{url('business/profileLogo/profilePicDel/'.$client->id)}}" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        <?php  }else{ ?>
                        <input type="file" class="form-control" id="profile_pic" name="profile_pic">
                        	@if ($errors->has('profile_pic'))
						<span class="help-block">
							<strong><?php
								foreach ($errors->get('profile_pic') as $message) {
									echo $message."<br>";
								}
							?></strong>
						</span>
					@endif
                        <?php  } ?>
                      </div>
                    </div>

                    <div class="text-center">
                        <input type="hidden" name="profile_logo" value="profileLogo">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
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