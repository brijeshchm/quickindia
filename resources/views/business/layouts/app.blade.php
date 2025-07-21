<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title')</title>
  <meta name="keywords" content="@yield('keyword')" >
  <meta name="description" content="@yield('description')" > 
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{asset('client/images/quickind-logo-blue.png')}}" rel="icon">
  <link href="{{asset('business/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">  
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> 
  <link href="{{asset('business/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('/business/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  
 <link href="{{asset('/vendor/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('/vendor/select2/css/select2-bootstrap.css')}}" rel="stylesheet">
 
    <link href="{{asset('vendor/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    
    	<link href="{{asset('admin/vendor/datepicker/jquery-ui.css')}}" rel="stylesheet">
  
  <link href="{{asset('business/assets/css/style.css')}}" rel="stylesheet">  
    <link href="{{asset('business/assets/css/daterangepicker.css')}}" rel="stylesheet">  
   <link href="{{asset('/admin/vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{asset('/admin/vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">

</head>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
 <?php  
    $clientID = auth()->guard('clients')->user()->id;

    $client = App\Models\Client\Client::find($clientID); 

		$leads = DB::table('leads')
				   ->join('assigned_leads','leads.id','=','assigned_leads.lead_id')				  
				   ->select('leads.*','assigned_leads.client_id','assigned_leads.lead_id','assigned_leads.created_at as created')				 
				   
				   ->orderBy('assigned_leads.created_at','desc')
				   ->where('assigned_leads.readLead','0')
				   ->where('assigned_leads.client_id',$clientID)->get()->count();
    

     ?>
    <div class="d-flex align-items-center justify-content-between">
      <a href="{{url('business/dashboard')}}" class="logo d-flex align-items-center">
        <?php  
        			if(!empty($client->logo)){
								$logo = unserialize($client->logo);
								if(!isset($logo['thumbnail'])){
									$logo['thumbnail'] = $logo['large'];
								}								
								$image = $logo['large']['src'];
        ?>

        <?php  }else{ ?>
         <img src="{{asset($image)}}" alt="">
        <?php 
        }  ?>
        <img src="{{asset('client/images/quickind-logo-blue.png')}}" alt="">
        <span class="d-none d-lg-block">{{ $client->business_name ?? 'Quick India' }}</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

  <style>
.patti-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1px 2px;
    flex-wrap: wrap;
    width: 100%;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

.info-head, .notifi {
    display: flex;
    align-items: center;
    color: #606770;
    flex-wrap: wrap; /* Allow wrapping within these containers */
}

.info-head div, .notifi div {
    margin: 5px 10px;
    font-size: 16px; /* Base font size for readability */
}

.ddd {
    margin-right: 10px;
}

.bell {
    color: #1a73e8;
    margin-left: 5px;
}

.form-check {
    display: flex;
    align-items: center;
    margin: 5px 10px;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .patti-header {
        flex-direction: column;
        text-align: center;
        padding: 10px;
    }
.remain-code{
  display: none;
}
.expire{
  display: none;
}
.new-lead{
  display: none;
}
    .info-head, .notifi {
        margin: 3px 0;
        width: 100%;
        display: flex;
        padding: 0px 2px;
        place-content: space-evenly;
    }

    .info-head div, .notifi div {
        margin: 5px 0;
        font-size: 14px; /* Slightly smaller font for mobile */
    }

    .form-check {
        justify-content: center;
    }
}

/* Extra small screens */
@media (max-width: 480px) {
    .patti-header {
        padding: 8px;
    }

    .info-head div, .notifi div {
        font-size: 12px; /* Even smaller font for very small screens */
    }

    .form-check-label {
        font-size: 12px;
    }
}
</style>
 
<div class="patti-header">
    <div class="info-head">
        <div class="package"><a href="{{ url('business/package')}}">{{ $client->client_type ?? '' }}  </a></div>
        <div class="expire">Expire: {{ date('d M, Y',strtotime($client->expired_on)) ?? '' }}</div>
       <form class="profileSave" method="POST">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"  value="{{ $client->pauseLead??'' }}" data-client-id="{{ $client->id }}" @if(!empty($client->pauseLead)) {{ "checked"}} @endif>
            <label class="form-check-label" for="flexSwitchCheckChecked">Pause Lead </label>
        </div>
        </form>
        <div class="remain-code">Remaining Cons: {{ $client->coins_amt ?? '' }}</div>
        <div class="new-lead">New Lead:<a href="{{ url('business/new-enquiry') }}"> <span class="bell"><i class="bi bi-envelope"></i> {{ $leads??''}}</span></a></div>
    </div>
    <div class="notifi">
        
    </div>
</div>
   
  

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

   
 
 
         <li class="nav-item dropdown">

            
          

        </li> 

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li>
       
       

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">  #
           
              <?php
    	 
							 
							if(!empty($client->logo)){
								$logo = unserialize($client->logo);
								if(!isset($logo['thumbnail'])){
									$logo['thumbnail'] = $logo['large'];
								}								
								$image = $logo['large']['src'];
							 
					 
    	?>
            <img src="<?php echo asset(''.$image); ?>" alt="Profile" class="rounded-circle">
            
            <?php }else{ ?>
             <img src="{{asset('business/assets/img/user.png')}}" alt="Profile" class="rounded-circle">
            
            <?php } ?>
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->guard('clients')->user()->business_name }}
             
            </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ auth()->guard('clients')->user()->business_name }} </h6>
              
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{url('business/personal-details')}}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{url('business/account-settings')}}">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
           
          
           

            <li>

              <a class="dropdown-item d-flex align-items-center" href="{{url('business/favorite-enquiry')}}">
                 <i class="bi bi-star"></i>
                <span>Favorite Enquiry</span>
              </a>
            </li>
            <li>

              <a class="dropdown-item d-flex align-items-center" href="{{url('business/manage-enquiry')}}">
                 <i class="bi bi-envelope"></i>
                <span>Manage Enquiry</span>
              </a>
            </li>
            <li>

              <a class="dropdown-item d-flex align-items-center" href="{{url('business/keywords')}}">
                 <i class="bi bi-book-half"></i>
                <span>Service Keywords</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{url('business/package')}}">
                <i class="bi bi-currency-rupee"></i>
                <span>Package</span>
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{url('business/help')}}">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ url('client/logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
 @include('business.layouts.sidebar')
</ul>
</aside>

  
 

    @yield('content')

 
 
 
<footer>
        <div class="footer-item">
            <span><a href="{{ url('business/dashboard') }}"><i class="bi bi-grid"></i>Home</a></span>
        </div>
        <div class="footer-item">
          
           
            <span><a href="{{ url('business/package') }}"><i class="bi bi-currency-rupee"></i>Package</a></span>
        </div>
        <div class="footer-item">
            <span><a href="{{ url('business/new-enquiry') }}"><i class="bi bi-people"></i>Leads</a></span>
        </div>
        <div class="footer-item">
            <span><a href="{{ url('business/account-settings') }}"><i class="bi bi-gear"></i>Settings</a></span>
        </div>
    </footer>
 
 
 
 <div id="messaged" class="modal fade" role="dialog" data-backdrop="static"><div class="modal-dialog"><div class="modal-content">
    <h5 class="modal-title">Quick India Sevice</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="modal-body" style="padding:0;">
        <div class="imgclass"></div>
    <div class="successhtml"></div><div class="failedhtml"></div><div style="text-align:center;"></div></div></div></div></div>
  <!-- Vendor JS Files -->
   
  <script src="{{asset('business/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> 
  
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   
    
<script src="{{asset('admin/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/admin/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('/admin/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
  <script src="{{asset('business/assets/js/main.js')}}"></script>
   <script src="{{asset('/vendor/select2/js/select2.full.js')}}"></script>
   
 
       <script src="{{asset('/business/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('/business/assets/js/daterangepicker.js')}}"></script>
    <script>
    $(".select2-single").select2({
        theme: "bootstrap",
        placeholder: "Select a City",
        maximumSelectionSize: 6,
        containerCssClass: ":all:",
        ajax: {
            url: "/developer/cities/getajaxcities",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                }
            },
            processResults: function(data) {
                return {
                    results: $.map(data.cities, function(obj) {
                        return {
                            id: obj.city,
                            text: obj.city
                        };
                    })
                }
            },
            cache: true
        }
    });
    $(".select2-single-state").select2({
        theme: "bootstrap",
        placeholder: "Select State",
        maximumSelectionSize: 6,
        containerCssClass: ":all:"
    });
</script>
</body>

</html>