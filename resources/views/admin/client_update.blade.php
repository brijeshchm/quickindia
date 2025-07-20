<?php echo View::make('admin/header'); ?>
<style>
#btnAllRight,#btnRight,#btnLeft,#btnAllLeft{
	display:block;
	margin:5px auto;
	width:30px;
}
</style>     
 
   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                     <h1 class="page-header">Update "{{{ ucwords($client->business_name) }}}"</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<style>


.page-header {
    padding-bottom: 9px;
    margin: 4px 0 20px;
    border-bottom: 1px solid #eee;
}


	#sidebar {
	width: 250px;
	background-color: #1E3A8A;
	color: white;
    padding: 9px;
    display: flex;
    flex-direction: column;
    gap: 5px;
    height: auto;
	}
	#page-content{
	display: flex;
	}
        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar-item:hover {
            background-color: #2a3b6c;
        }

        .sidebar-item.active {
            background-color: #3b5998;
        }

        .sidebar-item i {
            font-size: 20px;
        }

        /* Content Area Styles */
        .section-content {
            flex: 1;
            padding: 0px 20px;
            background-color: #fff;
            display: none;
        }

        .section-content.active {
            display: block;
        }

        /* Form Styles */
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 7px 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group label span {
            color: red;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group select {
            appearance: none;
            background: url('data:image/svg+xml;utf8,<svg fill="black" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>') no-repeat right 10px center;
            background-size: 12px;
        }

        .save-btn {
            background-color: #f4a261;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .save-btn:hover {
            background-color: #e68a00;
        }
    </style>
  <div id="page-content"> 
  <div id="sidebar">
        <div class="sidebar-item active" onclick="showContent('location')">
            <i>📍</i> Location Information
        </div>
        <div class="sidebar-item" onclick="showContent('contact')">
            <i>📞</i> Contact Information
        </div>
        <div class="sidebar-item" onclick="showContent('other')">
            <i>ℹ️</i>Other Information
        </div>
        <div class="sidebar-item" onclick="showContent('uploadProfile')">
            <i>📷</i> Company Logo
        </div>
        <div class="sidebar-item" onclick="showContent('upload')">
            <i> 📷</i> Upload Gallery
        </div>
        <div class="sidebar-item" onclick="showContent('keywords')">
            <i>🔑</i> Assigned Keywords
        </div>
        <div class="sidebar-item" onclick="showContent('leads')">
            <i>📋</i> View All Lead
        </div>
        <div class="sidebar-item" onclick="showContent('discussion')">
            <i>💬</i> Discussion
        </div>
        <div class="sidebar-item" onclick="showContent('payment')">
            <i>💳</i> Payment Order
        </div>
    </div>

    <!-- Content Area -->
    <div class="section-content active" id="location">
        <div class="form-container">
			<h4>Location Information</h4>
		 
			<form class="form-horizontal" autocomplete="off" action="" onsubmit="return ClientController.editSaveClientLocation(this,<?php echo (isset($client->username)? $client->username:""); ?>)" enctype="multipart/form-data" method="POST">
					{{csrf_field()}}
			 
					<div class="form-group col-md-6">
						<div class="col-md-12"> 
						<label>Business Name: <sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>				
																	
						<?php if(Auth::user()->role == 'update_business_name' || Auth::user()->role == 'administrator'): ?>
							<input type="text" class="form-control" name="business_name" value="{{ $client->business_name}}">
							<?php else: ?>
							<input type="text" class="form-control" name="business_name" value="{{ $client->business_name}}" readonly>
						
							<?php endif; ?> 
						</div>
					</div>
					
					<div class="form-group col-md-6">
						<div class="col-md-12"> 
						<label>Landmark: </label>
						
							<input type="text" class="form-control" name="landmark" value="{{ $client->landmark}}">
						</div>
					</div>

 



					<div class="form-group col-md-6">
						<div class="col-md-12"> 
						<label>City: <sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>							
						<select class="dropdown-arrow dropdown-arrow-inverse city-form select2_single city" name="city">
						<option value="">Select City</option>

						  @if(!empty($citylist))
							  @foreach($citylist as $city)
						  <option value="{{$city->city}}" @if ($city->city== old('city'))
								selected="selected"	
							@else
							{{ (isset($client) && $client->city == $city->city ) ? "selected":"" }} @endif>{{$city->city}}</option>
						  @endforeach
						  @endif

						</select>
						</div>
					</div>
					<div class="form-group col-md-6">
						<div class="col-md-12"> 
						<label>State: <sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>
						
							<?php $states = getStates(); ?>
							<select class="form-control select2-single-state" name="state">
								<?php
									$selected = '';
									foreach($states as $state){
										$selected = ($state==$client->state)?"selected":"";
										echo "<option value=\"".$state."\" ".$selected.">".$state."</otpion>";
									}
								?>
							</select>
							 
						</div>
					</div>
					<div class="form-group col-md-6">
							<div class="col-md-12"> 
						<label>Country:</label>
					
							<input type="text" class="form-control" name="country" value="{{ $client->country}}">
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-sm-12"> 
						<label>Address: </label>
						
							<textarea class="form-control" name="address" rows="4" id="address">{{ $client->address}}</textarea>
						</div>
					</div>
					<input type="hidden" name="location_info" value="location_info" >
					<div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-4 text-right">
							<input type="submit" value="SAVE" class="btn btn-warning">
						</div>
					</div>
				</form>
		 
             
        </div>
    </div>

    <!-- Placeholder Content for Other Sections -->
    <div class="section-content" id="contact">
        <div class="form-container">
            <h4>Contact Information</h4>
           
			<form class="form-horizontal"  action="" onsubmit="return ClientController.ediSaveContactInfo(this,<?php echo (isset($client->username)? $client->username:""); ?>)" method="POST">
				{{csrf_field()}}
				<div class="form-group col-md-6">
					<div class="col-md-12">
					<label>First Name: </label>
						<input type="text" class="form-control" name="first_name" value="{{ $client->first_name }}" placeholder="Enter First Name">
					</div>
				</div>
				<div class="form-group col-md-6">
					<div class="col-md-12"> 
					<label>Last Name: </label>
					<input type="text" class="form-control" name="last_name" value="{{ $client->last_name }}" placeholder="Enter Last Name">
					</div>
				</div>
				<div class="form-group col-md-6">
					<div class="col-sm-12"> 
					<label>Primary Mobile No: <sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>
					
						<input type="text" class="form-control" name="mobile" value="{{ $client->mobile }}" placeholder="Enter Primary Number">
					</div>
				</div>
				<div class="form-group col-md-6">
					<div class="col-sm-12"> 
					<label>Secondary Mobile No: </label>
					
						<input type="text" class="form-control" name="sec_mobile" value="{{ $client->sec_mobile}}" placeholder="Enter Secondary No">
					</div>
				</div>
				<div class="form-group col-md-6">
					<div class="col-sm-12"> 
					<label>Landline No: </label>
					
					 <input type="text" class="form-control" name="landline" value="{{ $client->landline}}" placeholder="Enter Landline no"> 
					</div>
				</div>			 
				<div class="form-group col-md-6">
					<div class="col-sm-12"> 
					<label>Toll Free No: </label>
					
						<input type="text" class="form-control" name="tollfree" value="{{ $client->tollfree}}" placeholder="Enter Toll Free no">
					</div>
				</div>
				<div class="form-group col-md-6">
					<div class="col-sm-12"> 
					<label>Email: <sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>
					 
						<input type="text" class="form-control" name="email" value="{{ $client->email}}" placeholder="Enter Email id">
					</div>
				</div>
				<div class="form-group col-md-6">
					<div class="col-sm-12"> 
					<label>Website: </label>					 
						<input type="text" class="form-control" name="website" value="{{ $client->website}}" placeholder="Enter Website">
					</div>
				</div>
				<div class="form-group"> 
					<div class="col-sm-12"> 
					<input type="hidden" name="contact_info" value="contact_info">
					<div class="col-sm-offset-2 col-sm-4 text-right">
						<input type="submit" value="SAVE" class="btn btn-warning">
					</div>
					</div>
				</div>
			</form>
							</p>
        </div>
    </div>
    <div class="section-content" id="other">
        <div class="form-container">
            <h4>Other Information</h4>
            
				<form id="submitConversionClient" class="form-horizontal" method="POST">
					{{csrf_field()}}
					<div class="form-group col-md-12">
						<div class="col-md-12"></div>
						<label>Conversion Client: <sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>
													 
						<select class="form-control conversion_status" name="conversion_status">
						<option value="">Select Conversion</option>				
							
						<option value="1" <?php if(isset($client->conversion_status) && $client->conversion_status==1){ echo "selected"; } ?>>Conversion</option>
						
						<option value="0" <?php if(isset($client->conversion_status) && $client->conversion_status==0){ echo "selected"; } ?> >Non Conversion</option>			 	
						</select>
						
						</div>
						<div class=" form-group col-md-1">
							<input type="hidden" name="id" id="client_id" value="<?php echo (isset($client->username)? $client->username:""); ?>"
							 
							<input type="hidden" name="submit_conversion_client" value="1" />
						</div>
					 
				</form>

					<div class="row">
					<form method="POST" action="#" id="assignedZone" onsubmit="return assignedZoneController.submit(this,<?php echo (isset($client->username)? $client->username:""); ?>)">
									{{ csrf_field() }}
								
				
					<div class="form-group">
						<div class="col-md-4">
						<labelfor="">City:</label>
						<select name="city_id" class="form-control"></select>
						 
					</div>
					</div>
									
					<div class="col-md-4">
					<div class="form-group">
						<label for="">Zone:</label>
						<select name="zone_id" class="form-control"></select>
					  
					</div>
					</div>
									 
					<div class="col-md-4">
					<div class="form-group">					 
						<input type="submit" class="btn btn-warning" value="Submit" style="margin-top:20px;">
					</div>
					</div>
									 
								</form>
								</div>


					<div class="col-md-12">
					<div class="row">
					<div class=" table-responsive">
					<table width="100%" class="table table-striped table-bordered table-hover" id="datatable-assigned-zones">
					<thead>
					<tr>
					<!--th>Area</th-->
					<th>Zone</th>
					<th>City</th>
					<th>Action</th>
					</tr>
					</thead>
					</table>
					</div>
					</div>
					</div>

				 
        </div>
    </div>
    <div class="section-content" id="uploadProfile">
        <div class="form-container">
            <h4>Company Logo</h4>
           	<form class="form-horizontal" autocomplete="off" action="" onsubmit="return ClientController.editSaveClientProfileLogo(this,<?php echo (isset($client->username)? $client->username:""); ?>)" enctype="multipart/form-data" method="POST"> 
			<div class="form-group">
			<div class="col-md-12">
					<textarea class="form-control" rows="5" name="business_intro" placeholder="Enter Business Introduction Here...">{{ $client->business_intro }}</textarea>
				</div>
			</div>
		 
			
			<div class="form-group">
				<div class="col-md-6">
					<label for="year_of_estb">Year of Establishment:</label>
					<input type="text" class="form-control" id="year_of_estb" name="year_of_estb" placeholder="Select Date (YYYY)" value="{{ $client->year_of_estb or "" }}">
				</div>
			</div>
			<div class="form-group"> 
				<div class="col-md-6">
					<label for="certifications">Certifications:</label>
					<input type="text" class="form-control" id="certifications" name="certifications" value="<?php echo (empty($client->certifications))?"":implode(',',unserialize($client->certifications)); ?>" placeholder="Comma separated certifications">
				</div>
			</div>
			<div class="form-group"> 
				<div class="col-md-6">
					<label for="logo">Upload Logo:</label>					
					<?php
						if(!empty($client->logo)){
							
						$logo = unserialize($client->logo);
							
						if(!isset($logo['thumbnail'])){
							$logo['thumbnail'] = $logo['large'];
						}						
					?>
					<img src="{{asset('/'.$logo['thumbnail']['src'])}}" width="100">  
					
				<a href="{{url('developer/clients/update/profileLogo/logoDel/'.$client->username)}}" class="btn btn-danger btn-sm" title="Remove my profile image" width="100"><i class="fa fa-trash"></i></a>
						<?php   }else{ ?>
							
								<input type="file" class="form-control" id="logo" name="image" accept=".png,.jpeg,jpg">
							
							<?php  	}  ?>
						
				</div>
				</div>
				<div class="form-group"> 
				<div class="col-md-6">
					<label for="">Upload Profile Pic:</label>
				
					<?php
						
						if(!empty($client->profile_pic)){
							$profile_pic = unserialize($client->profile_pic);
							if(!isset($profile_pic['thumbnail'])){
								$profile_pic['thumbnail'] = $profile_pic['large'];
							}
						
					?>
					<?php if(!empty($profile_pic['thumbnail'])){ ?><img src="{{asset('/'.$profile_pic['thumbnail']['src'])}}" width="100"><?php  } ?>
						<a href="{{url('developer/clients/update/profileLogo/profilePicDel/'.$client->username)}}" class="btn btn-danger btn-sm" title="Remove my profile image" width="100"><i class="fa fa-trash"></i></a>
					<?php  }else{ ?>
								<input type="file" class="form-control" id="profile_pic" name="profile_pic" accept=".png,.jpeg,jpg">
								
					
					<?php  } ?>
				
				</div>
			</div>

			<input type="hidden" name="profile_logo" value="profile_logo" >
					<div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-4 text-right">
							<input type="submit" value="SAVE" class="btn btn-warning">
						</div>
			</div>

			</form>

        </div>
    </div>
    <div class="section-content" id="upload">
        <div class="form-container">
            <h2>Upload Gallery</h2>
             <?php if(!empty($client->pictures)):
					$picture = unserialize($client->pictures);					
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
					<form class="form-horizontal" enctype="multipart/form-data" onsubmit="return ClientController.uploadClientGalleryPics(this,<?php echo (isset($client->username)? $client->username:""); ?>)" method="POST" >
						{{csrf_field()}}
					<div class="form-group">
					<?php for($i=0;$i<12;$i++): ?>
						<div class="col-md-4 line-space" id="image{{$i+1}}">
							@if(empty($picture[$i]['large']['name']))
							<input type="file" class="form-control" name="image{{$i+1}}" accept=".jpeg,.JPEG,.png">
							@endif
							<span class="help-block">
								@if(isset($picture[$i]['large']['src'])&&!empty($picture[$i]['large']['src']))
								<img src="{{asset('/'.$picture[$i]['large']['src'])}}" style="height:75px;width:75px;">
								<a href="javascript:void(0)" class="remove-thumbnail" data-srno="image{{$i+1}}" title="remove"><i class="fa fa-times fa-fw" aria-hidden="true"></i></a>
								@endif
							</span>
						</div>
						<?php if(($i+1)%3==0){echo "<div class=\"clearfix\"></div>";} ?>
					<?php endfor; ?>
						<hr>
						<input type="hidden" name="upload_pics" value="upload_pics">
						<div class="col-md-4 col-md-offset-4">
							<input type="submit" class="btn btn-info btn-block line-space" value="SAVE">
						</div>
					</div>
				</form>


        </div>
    </div>
    <div class="section-content" id="keywords">
        <div class="form-container">
            <h4>Assigned Keywords</h4>
         
			<form id="submitActiveStatus" class="form-horizontal" enctype="multipart/form-data" action="{{ url('developer/clients/update')."/".$client->username }}" method="POST">
				{{csrf_field()}}
				<div class="form-group col-md-6" style="display:flex">
					<div class="col-md-12">
						 Client Active Status: 
						<input type="checkbox" style="height:14px;width:14px;" class="active_status" name="active_status" value="1" <?php echo ($client->active_status)?"checked":""; ?> />
					</div>
					<div class="col-md-1">						 
						<input type="hidden" name="submit_active_status" value="1" />
					</div>
				</div>
			</form>



			<div>
				<form id="submitPaidStatus" class="form-horizontal" enctype="multipart/form-data" action="{{ url('developer/clients/update')."/".$client->username }}" method="POST">
					{{csrf_field()}}
					<div class="form-group col-md-6">
						<div class="col-md-12">
							Client Paid Status: 
							<input type="checkbox" style="height:14px;width:14px;" class="paid_status" name="paid_status" value="1" <?php echo ($client->paid_status)?"checked":""; ?> />
						</div>
						<div class="col-md-1">
							
							<input type="hidden" name="submit_paid_status" value="1" />
						</div>
					</div>
				</form>
			</div>	

		
				<div>
					<form id="submitCertifiedStatus" class="form-horizontal" enctype="multipart/form-data" action="{{ url('developer/clients/update')."/".$client->username }}" method="POST">
						{{csrf_field()}}
						<div class="form-group col-md-6">
							<div class="col-md-12">
								 Client Certified Status: 
								<input type="checkbox" style="height:14px;width:14px;" class="certified_status" name="certified_status" value="1" <?php echo ($client->certified_status)?"checked":""; ?> />
							</div>
							<div class="col-md-1">
								<label style="visibility:hidden">Submit:</label>
								<input type="hidden" name="submit_certified_status" value="1" />
							</div>
						</div>
					</form>
				</div>
							 
				<div>

					<?php
					$clientTypes = getClientsType();
					?>
					<form id="submitClientType" class="form-horizontal" enctype="multipart/form-data" action="{{ url('developer/clients/update')."/".$client->username }}" method="POST">
						{{csrf_field()}}
						<div class="form-group">
							<div class="col-md-6">
								<label>Client Package Name:</label>
									@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('client_package_name'))
								<select class="select2-single form-control client_type" name="client_type">
									<?php
										foreach($clientTypes as $key => $value){
											$selected = "";
											if($key == $client->client_type):
												$selected = "selected";
											endif;
											?>
											<option value="{{ $key }}" <?php echo $selected; ?>>{{ $value }}</option>
											<?php
										}
									?>
								</select>
								@else
									<?php
										foreach($clientTypes as $key => $value){
											if($key == $client->client_type):
												echo "<p>$value</p>";
											endif;
										}
									?>
								@endif
							</div>
							<div class="col-md-1">
								 
								<input type="hidden" name="submit_client_type" value="1" />
								 
							</div>
						</div>
					</form>
				</div>
						
				
			<div id="leads_count" style="display:<?php echo ($client->client_type==="Gold" || $client->client_type==="Diamond"|| $client->client_type==="Platinum")?"block":"none"; ?>;">
						<form class="form-horizontal" id="count_based_subscription_form" enctype="multipart/form-data" action="{{ url('developer/clients/update')."/".$client->username }}" method="POST">
							{{csrf_field()}}
							<div class="form-group">
						 
								<div class="col-md-6">
									<label>Coins Remaining:</label>
									<input type="text" class="form-control" value="{{$client->coins_amt}}" readonly />
								</div>
									@if($request->user()->current_user_can('administrator') || $request->user()->current_user_can('manager') )
								<div class="col-md-1">
									<label style="visibility:hidden">Submit:</label>
									<input type="hidden" name="submit_leads_count" value="1" />
								 
								</div>
								@endif
							</div>
						</form>
						<form class="form-horizontal" id="yearly_subs_form" enctype="multipart/form-data" action="{{ url('developer/clients/update')."/".$client->username }}" method="POST">
							{{csrf_field()}}
							<div class="form-group">
								<div class="col-md-3">
									<label>Starting Date:</label>
									<input type="text" class="form-control x_date" name="expired_from" value="{{date_format(date_create($client->expired_from),'Y-m-d')}}" />
								</div>
								<div class="col-md-3">
									<label>End Date:</label>
									<input type="text" class="form-control y_date" name="expired_on" value="{{date_format(date_create($client->expired_on),'Y-m-d')}}" />
								</div>
									@if($request->user()->current_user_can('administrator') || $request->user()->current_user_can('manager') )
								<div class="col-md-2">
									<label style="visibility:hidden">Submit:</label>
									<input type="hidden" name="submit_yrly_subs_starting_date" value="1" />
									<button type="submit" class="btn btn-warning btn-block kw-submit">SAVE</button>
								</div>
								@endif
							</div>
						</form>
						
						<form class="form-horizontal" id="max_kw_form" enctype="multipart/form-data" action="{{ url('developer/clients/update')."/".$client->username }}" method="POST">
							{{csrf_field()}}
							<div class="form-group">
								<div class="col-md-3">
									<label>Max Keywords:</label>
									<input type="number" min=0 step=1 class="form-control" name="max_kw" value="{{$client->max_kw}}" />
								</div>
								@if($request->user()->current_user_can('administrator') || $request->user()->current_user_can('manager') )
								<div class="col-md-2">
									<label style="visibility:hidden">Submit:</label>
									<input type="hidden" name="submit_max_kw" value="1" />
									<button type="submit" class="btn btn-warning btn-block kw-submit">SAVE</button>
								</div>
								@endif
							</div>
						</form>
						
					</div>


				<div id="ass_kw_wrapper" style="display:<?php echo ($client->client_type==="general")?"block":"block"; ?>;">
				<form class="form-horizontal" enctype="multipart/form-data" action="{{ url('developer/clients/update')."/".$client->username }}" method="POST" id="kw_form" name="kw_form" >
						{{csrf_field()}}
						<div class="form-group">
							
				<input type="hidden" name="client_id" id="clientIDASSKW" value="{{$client->username}}">
						
				<div class="col-md-3">
						<label>City:</label>
						<select class="select2-single form-control city" name="city"  >
							@if(!empty($citylist))
									<option value="">Select City</option>
								@foreach($citylist as $distinctCity)
									<option value="{{$distinctCity->id}}">{{ucfirst($distinctCity->city)}}</option>
								@endforeach
							@endif
						</select>
					</div>
						
						
						<div class="col-md-3">									 
							<label for="">Zone:</label>
							<select name="zone_id" class="form-control zone" ></select>		 
						
						</div>
											

						<div class="col-md-3">
							<label>Parent:</label>
								<select class="select2-single form-control parent" id="parentv" name="parent">
								@if(!empty($parentCategory))
										<option value="">Select Parent</option>
									@foreach($parentCategory as $parent)
										<option value="{{$parent->id}}">{{ucfirst($parent->parent_category)}}</option>
									@endforeach
								@endif
							</select>								
							
						</div>
							<div class="col-md-3">
								<label>Child:</label>
								<select class="select2-single form-control child" name="child" id="childv" >
								</select>
							</div>
							
							<div class="col-md-3">
								<label>Keywords:</label>
								<select class="form-control kw" name="kw" id="kwv" >
								
								</select>
							</div>
							 
							<div class="col-md-3">
								<label>Position:</label>
								<select class="select2-single form-control position" name="position" id="positionv">
							<!--	<option value="Free Listing">Free Listing</option>-->
								</select>
							</div>
							<div class="col-md-3">
								<label>Price:</label>
								<input type="text" class="form-control price" disabled>
							</div>
							<input type="hidden" name="kw-submit" value="kw-submit">
							<div class="col-md-3">
								<label style="visibility:hidden">Submit:</label>
								<input type="reset" class="btn btn-default hide reset_kw_submit" />
								<button type="submit" class="btn btn-warning btn-block kw-submit"><i class="fa fa-plus fa-fw" aria-hidden="true"></i></button>
							</div>
						</div>
						<div class="form-group">
						</div>
					</form>
					<style>
					.check-box{
						height:18px;
						width:20px;
						cursor:pointer;
					}
					</style>
					<div class="table-responsive col-md-12">
						<table width="100%" class="table table-striped table-bordered table-hover" id="datatable-assigned-keywords"><!--dataTables-example-->
							<caption>Assigned Keywords</caption>
							<thead>
								<tr>
									<th><input type="checkbox" id="check-all" class="check-box"></th></th>											 
									<th>KW</th>
									<th>Child Category</th>
									<th>Parent Category</th>
									<th>City</th>
									<th>Zone</th>
									<th>Position</th>
									<!--<th>Price</th>-->
									<th>Action</th>
								</tr>
							</thead>
							 
						</table>
						<form class="form-horizontal" enctype="multipart/form-data" action="{{ url('developer/clients/update')."/".$client->username }}" method="POST">
							{{csrf_field()}}
							<div class="form-group">
							@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('export_assign_keyword'))
								<div class="col-md-2">
									<input type="submit" class="btn btn-success btn-block" name="kw-export" value="Export">
								</div>	 
								@endif
									@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('assign_keyword_delete'))
								<div class="col-md-4">
									<button type="button" class="btn btn-success btn-block" onclick="javascript:assignedKeywordController.deleteSelectedAssignedKwds()">Delete Selected</button>
								</div>
								@endif
								 
							</div>
						</form>
					</div>

								 
							</div>


			 
        </div>
    </div>
    <div class="section-content" id="leads">
        <div class="form-container">
            <h4>View All Leads</h4>
           <div class="table-responsive col-md-12">
					<table width="100%" class="table table-striped table-bordered table-hover" id="datatable-view-all-leads">
						<thead>
							<tr>
								<th>Name</th>
								<th>Mobile</th>
								<th>Email</th>										 
								<th>Course</th>
								<th>City</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Name</th>
								<th>Mobile</th>
								<th>Email</th>										 
								<th>Course</th>
								<th>City</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<form class="form-horizontal" enctype="multipart/form-data" action="{{ url('developer/clients/update')."/".$client->username }}" method="POST">
					{{csrf_field()}}
					<div class="form-group">
						@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('export_assign_lead') )
						<div class="col-md-3">
							<label style="visibility:hidden">Submit:</label>
							<input type="submit" class="btn btn-success btn-block" name="lead-export" value="Export">
						</div>
						@endif
					</div>
				</form>
        </div>
    </div>
    <div class="section-content" id="discussion">
        <div class="form-container">
            <h4>Client Discussion</h4>
			 
            
        </div>
    </div>
    <div class="section-content" id="payment">
        <div class="form-container">
            <h4>Payment Order</h4>
			<div>
					<form id="submitPackageStatus" class="form-horizontal" enctype="multipart/form-data" action="{{ url('developer/clients/update')."/".$client->username }}" method="POST">
						{{csrf_field()}}
						
						<div class="form-group">
						
							<div class="col-md-2">	
							<label>Package:-</label>
							</div>
							<div class="col-md-2">
								<label>Gold: Six Months</label>
								<input type="radio" style="height:14px;width:14px;" class="package_status" name="package_status" value="Gold" <?php echo (isset($client->client_type) && $client->client_type=='Gold')?"checked":""; ?> />
							</div> 
							<div class="col-md-2">
								<label>Diamond:</label>
								<input type="radio" style="height:14px;width:14px;" class="package_status" name="package_status" value="Diamond" <?php echo (isset($client->client_type) && $client->client_type=='Diamond')?"checked":""; ?> />
							</div>
							<div class="col-md-2">
								<label>Platinum:</label>
								<input type="radio" style="height:14px;width:14px;" class="package_status" name="package_status" value="Platinum" <?php echo (isset($client->client_type) && $client->client_type=='Platinum')?"checked":""; ?> />
							</div>
							<div class="col-md-1">
								<label style="visibility:hidden">Submit:</label>
								<input type="hidden" name="submit_packege_status" value="1" />
							</div>
						</div>
					</form>
				</div>
			<div>
			<form  class="form-horizontal order_validation" onsubmit="return client.submitClientPayOrder(this)"  method="post">
					{{csrf_field()}}
					 
					<input type="hidden" name="client-id" value="<?php echo $client->username; ?>" />
					<div class="form-group">
					<label class="col-sm-2">Business Name<sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>
					
					<div class="col-md-4"> 
						
					<input type="text" name="business_name" class="form-control" value="{{$client->business_name}}" placeholder="Business Name"> 
					</div>
					</div> 								
					
					<div class="form-group">
					<label class="col-sm-2">Package Name <sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>
					
					<div class="col-md-4"> 								 
					<input type="text" name="package_name" class="form-control" value="{{$client->client_type}}" placeholder="Package Name"> 
					</div>
					</div>				 
					<div class="form-group">
					<label class="col-sm-2">Paid Amount<sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>
					
					<div class="col-md-4"> 							 
					<input type="text" name="paid_amount" id="paid_amount" class="form-control" placeholder="Paid Amount" onkeypress="return isNumericKeyCheck(event);" onblur="handlingPaiAmt()"> 
					</div>
					</div> 
					
					<div class="form-group">
					<label class="col-sm-2">Coins <sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>
					<div class="col-md-3">
					<label>Coins:</label>
					<input type="text" min=0 step=1 class="form-control" name="coins_amt" id="coins_per_lead" value="" onkeypress="return isNumericKeyCheck(event);" readonly/>
					</div>
					
					
					
					</div>
								
					<div class="form-group">
					<label class="col-sm-2">GST <sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>
					<div class="col-md-4"> 	
					<label class="radio-inline">
					<input type="radio" name="gst_status" value="Yes" onchange="paidgst(this.value)">Yes
					</label>
					<label class="radio-inline">
					<input type="radio" name="gst_status" value="No" onchange="nopaidgst(this.value)">No
					</label>

					</div>	
					</div>	
					<div class="form-group">
					<label class="col-sm-2">GST Amount</label>
					
					<div class="col-md-4"> 
						
					<input type="number" name="gst_tax" id="gst_tax" class="form-control" placeholder="GST Amount"> 
					</div>
					</div> 
					
					<div class="form-group">
					<label class="col-sm-2">GST Total Amount<sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>
					
					<div class="col-md-4"> 
						
					<input type="number" name="gst_total_amount" id="gst_total_amount" class="form-control" placeholder="GST Total Amount" > 
					</div>
					</div> 


					<div class="form-group">
					<label class="col-sm-2">TDS<sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>
					<div class="col-md-4"> 	
					<label class="radio-inline">
					<input type="radio" name="tds_status" value="Yes" onchange="paidtds(this.value)" >Yes
					</label>
					<label class="radio-inline">
					<input type="radio" name="tds_status" value="No" onchange="nopaidtds(this.value)" >No
					</label>

					</div>	
					</div>	
					<div class="form-group">
					<label class="col-sm-2">TDS Amount</label>
					
					<div class="col-md-4"> 
						
					<input type="number" name="tds_amount" id="tds_amount" class="form-control" placeholder="TDS Amount" > 
					</div>
					</div> 
					
					<div class="form-group">
					<label class="col-sm-2">Total Amount<sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>						 
					<div class="col-md-4"> 								 
					<input type="number" name="total_amount" id="total_amount" class="form-control" placeholder="Total Amount" > 
					</div>
					</div> 
					 
						
					
					<div class="form-group">
							<label class="col-sm-2" for="stud-payment_mode">Payment Mode<sup><i style="color:red" class="fa fa-asterisk fa-fw" aria-hidden="true"></i></sup></label>
							<div class="col-sm-4">
								<?php
																					
									foreach($moderesults as $moderesult){
										$modes[$moderesult->slug] = $moderesult->mode;
									}
								?>										
								<select class="form-control" id="stud-payment_mode" name="stud-payment_mode" >
									<option value="">Select Payment Mode</option>
									<?php foreach($modes as $key => $value): ?>
										<option value="<?php echo $key; ?>" <?php echo ($key=='cash')?"selected":""; ?>><?php echo $value; ?></option>
									<?php endforeach; ?>
										
								</select>
							</div>
						</div>					
						<?php foreach($modes as $key=>$value): ?>
							<?php if($key!='cash' && $key!='cheque'): ?>
								<div class="form-group hide-mode <?php echo $key; ?>">
									<label class="col-sm-2" for="stud-<?php echo $key; ?>"><?php echo $value; ?></label>
									<div class="col-sm-4">          
										<select class="form-control" id="stud-<?php echo $key; ?>" name="stud-<?php echo $key; ?>">
											<option value="" selected="selected">-- Select <?php echo $value; ?> --</option>
											<?php
											$banks =  App\Models\Banksdetails::where('mode',$key)->get();	
												 
												if( count($banks) > 0 ){
													foreach ($banks as $bank) {
														echo "<option value=\"".$bank->name."\">".$bank->name."</option>";
													}
												}
											?>
										</select>
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
						<div class="form-group hide-mode cheque">
							<label class="col-sm-2" for="stud-chq_no">Cheque Number</label>
							<div class="col-sm-4">          
								<input type="text" class="form-control" id="stud-chq_no" name="stud-chq_no" placeholder="Enter Cheque Number">
							</div>
						</div>	
						
						<div class="form-group hide-mode bank">
							<label class="col-sm-2" for="stud-card_no">Card Number</label>
							<div class="col-sm-4">          
								<input type="text" class="form-control" maxlength="4" id="
								
								" name="stud-card_no" placeholder="Enter Last 4 Digit of Card Number">
							</div>
						</div>	
						
					 
					
					<div class="form-group">
					<label class="col-sm-2">Transaction-Id:</label>							 
					<div class="col-md-4"> 								 
					<input type="text" name="transactionid" class="form-control" placeholder="Enter Transaction-Id"> 
					
					</div>
					</div>	
					
					<div class="form-group">
					<label class="col-sm-2">Select ID Proof:</label>							 
					<div class="col-md-4"> 								 
					<select class="form-control" name="selectproofid"> 
					<option value="">Select ID Proof</option>
					<option value="Pan Card">Pan Card</option>
					<option value="Adhar Card">Adhar Card</option>
					<option value="Passport">Passport</option>
					<option value="Driver Licence">Driver Licence</option>
					</select>
					
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-2">ID Proof:</label>							 
					<div class="col-md-4"> 								 
					<input type="text" name="proofid" class="form-control" placeholder="Enter ID proof"> 
					
					</div>
					</div>
					<br>
					<div class="form-group">
						<div class="col-md-4 col-md-offset-2">
							<input type="hidden" name="pay-submit" value="savepay">
						<input type="hidden" class="resetData" >
							<input type="submit" class="btn btn-warning btn-block payOrder" value="Payment"> 
						</div>
						</div>
					
				</form>
				</div>
				<div class="table-responsive col-md-12">
						<table width="100%" class="table table-striped table-bordered table-hover" id="datatable-payment-history">
							<caption>Payment History</caption>
							<thead>
								<tr>
									<th>Date</th>
									<th>Paid Amount</th>
									<th>GST</th>
									<th>Total Amount</th>
									<th>Pay Mode</th>
									<th>Order PDF</th>
									<th>Proforma Invoice</th>
									<th>Invoice PDF</th>
									<th>Action</th>
								</tr>
							</thead>
							
							<tbody>
							
							</tbody>
								
						</table>
				</div>
								
								
								
								
								<!-- Modal -->
		 
								<script>
				 
		function paidgst(gst){			
			 
			var paid = parseInt($('#paid_amount').val());		
			//var tot = parseInt(((paid)*(.18)));			 
			 var tot = Math. round(((paid)*(.18)));			 
			 var gstamount = $('#gst_tax').val(tot);			 
			 var tatol= parseInt(paid + tot);			 
			 var tobe = $('#gst_total_amount').val(tatol);	 
			 
		}
		
		function nopaidgst(gstno){
			var paid = parseInt($('#paid_amount').val());		
			 var tot = parseInt(0);			 
			 var gstamount = $('#gst_tax').val(tot);			 
			 var tatol= paid + tot;			 
			 var tobe = $('#gst_total_amount').val(tatol);				   
		}
		
		function paidtds(tds){			
			 
			var tdspaid = parseInt($('#paid_amount').val());			 		 
			var gst_total_amount = parseInt($('#gst_total_amount').val());			 		 
			 var tottds = Math. round(((tdspaid)*(2))/100);			 
			 var gstamount = $('#tds_amount').val(tottds);			 
			 var tdstatol= parseInt(gst_total_amount - tottds);			 
			 var tdstobe = $('#total_amount').val(tdstatol);	 
			 
		}
		
		function nopaidtds(tdsno){
			var tdspaid = parseInt($('#paid_amount').val());	
			var gst_total_amount = parseInt($('#gst_total_amount').val());				
			 var tottds = parseInt(0);			 
			 var gstamount = $('#tds_amount').val(tottds);			 
			 var tdstatol= gst_total_amount - tottds;			 
			 var tdstobe = $('#total_amount').val(tdstatol);				   
		}
		
		 
		</script>
		
					 
					
        </div>
    </div>
</div>
    <script>
        function showContent(sectionId) {
            // Hide all content sections
            document.querySelectorAll('.section-content').forEach(content => {
                content.classList.remove('active');
            });

            // Remove active class from all sidebar items
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.classList.remove('active');
            });

            // Show the selected content section
            document.getElementById(sectionId).classList.add('active');

            // Highlight the selected sidebar item
            document.querySelector(`.sidebar-item[onclick="showContent('${sectionId}')"]`).classList.add('active');
        }
    </script>
</div>
 
<?php echo View::make('admin/footer'); ?>
