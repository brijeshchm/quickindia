    <li class="nav-item">
        <a class="nav-link " href="{{url('business/dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Your Dashboard</span>
        </a>
    </li> 
<!--     
    <li class="nav-item">
    <a class="nav-link " href="{{url('business/enquiry')}}">
      <i class="bi bi-people"></i>
      <span>Enquiry</span>
    </a>
    </li>  -->

     <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#enquiry-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Enquiry</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="enquiry-nav" class="nav-content collapse <?php if(Request::segment(2)=='myLead' || Request::segment(2)=='new-enquiry' || Request::segment(2)=='favorite-enquiry' || Request::segment(2)=='manage-enquiry'){ echo  "show"; }   ?>" data-bs-parent="#sidebar-nav">
            
        <li>
            <a class="<?php if(Request::segment(2)=='new-enquiry') { echo "active"; } ?>" href="{{url('business/new-enquiry')}}">
              <i class="bi bi-circle"></i><span>New Enquiry</span>
            </a>
          </li>
        <li>
            <a class="<?php if(Request::segment(2)=='myLead') { echo "active"; } ?>" href="{{url('business/myLead')}}">
              <i class="bi bi-circle"></i><span>My lead</span>
            </a>
          </li>
          
          <li>
            <a class="<?php if(Request::segment(2)=='favorite-enquiry') { echo "active"; } ?>" href="{{url('business/favorite-enquiry')}}">
              <i class="bi bi-envelope"></i><span>Favorite Enquiry</span>
            </a>
          </li>
          
          <li>
            <a class="<?php if(Request::segment(2)=='manage-enquiry') { echo "active"; } ?>" href="{{url('business/manage-enquiry')}}">
              <i class="bi bi-circle"></i><span>Manage Enquiry</span>
            </a>
          </li>
        
         
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#profile-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-vcard"></i><span>Profile</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="profile-nav" class="nav-content collapse <?php if(Request::segment(2)=='profileInfo' || Request::segment(2)=='personal-details' || Request::segment(2)=='location-information' || Request::segment(2)=='gallery-pictures' || Request::segment(2)=='profile-logo'   || Request::segment(2)=='business-location'){ echo  "show"; }   ?>" data-bs-parent="#sidebar-nav">
            
        <li>
            <a class="<?php if(Request::segment(2)=='personal-details') { echo "active"; } ?>" href="{{url('business/personal-details')}}">
              <i class="bi bi-circle"></i><span>Personal Details</span>
            </a>
          </li>
        <li>
            <a class="<?php if(Request::segment(2)=='profileInfo') { echo "active"; } ?>" href="{{url('business/profileInfo')}}">
              <i class="bi bi-circle"></i><span>Business Information</span>
            </a>
          </li>
          
          <li>
            <a class="<?php if(Request::segment(2)=='profile-logo') { echo "active"; } ?>" href="{{url('business/profile-logo')}}">
              <i class="bi bi-circle"></i><span>Business Logo</span>
            </a>
          </li>
          <li>
            <a class="<?php if(Request::segment(2)=='business-location') { echo "active"; } ?>" href="{{url('business/business-location')}}">
              <i class="bi bi-circle"></i><span>Business Location</span>
            </a>
          </li>
          <li>
            <a class="<?php if(Request::segment(2)=='gallery-pictures') { echo "active"; } ?>" href="{{url('business/gallery-pictures')}}">
              <i class="bi bi-circle"></i><span>Business Pictures</span>
            </a>
          </li>
          
        </ul>
    </li>
        
        <li class="nav-item">
        <a class="nav-link " href="{{url('business/keywords')}}">
          <i class="bi bi-book-half"></i>
          <span>Business Keywords</span>
        </a>
        </li> 
       
     
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#account-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-check"></i><span>Account</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="account-nav" class="nav-content collapse <?php if(Request::segment(2)=='package' || Request::segment(2)=='billing-history' || Request::segment(2)=='coins-history' || Request::segment(2)=='account-settings' ||  Request::segment(2)=='account-settings'){ echo  "show"; }   ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a class="<?php if(Request::segment(2)=='account-settings') { echo "active"; } ?>" href="{{url('business/account-settings')}}">
              <i class="bi bi-gear"></i><span>Account Settings</span>
            </a>
          </li>
           
          <li>
            <a class="<?php if(Request::segment(2)=='package') { echo "active"; } ?>" href="{{url('business/package')}}">
              <i class="bi bi-currency-rupee"></i><span>Package</span>
            </a>
          </li>
          <li>
            <a class="<?php if(Request::segment(2)=='billing-history') { echo "active"; } ?>" href="{{url('business/billing-history')}}">
              <i class="bi bi-circle"></i><span>Invoice History</span>
            </a>
          </li>
          <li>
            <a  class="<?php if(Request::segment(2)=='coins-history') { echo "active"; } ?>" href="{{url('business/coins-history')}}">
              <i class="bi bi-circle"></i><span>Coins History</span>
            </a>
          </li>
          
        </ul>
      </li> 
      <li class="nav-heading"></li>
    

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('business/help')}}">
          <i class="bi bi-envelope"></i>
          <span>Help Center</span>
        </a>
      </li> 

    
<style>
/*  
.sidebar {
  width: 250px;
  background-color: #f1f5f9;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  transform: translateX(0);
  transition: transform 0.3s ease;
  z-index: 1000;
}

.main-content {
  margin-left: 250px;
  padding: 20px;
  transition: margin-left 0.3s ease;
} */

/*  
@media (max-width: 768px) {
  .sidebar {
    transform: translateX(0%);  
    width: 150px; 
    margin: 60px 0px;
  }
  .sidebar-nav .nav-link i {
    font-size: 12px;
    margin-right: 10px;
    color: #4154f1;
}
.sidebar-nav .nav-content a {
    display: flex;
    align-items: center;
    font-size: 14px;
    font-weight: 600;
    color: #012970;
    transition: 0.3;
    padding: 10px 0 10px 12px;
    transition: 0.3s;
}
  .main-content {
    margin-left: 0; 
    padding: 15px;
  }

  
  .sidebar.open {
    transform: translateX(0); width: ;
  }

  
  .overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
  }

  .overlay.active {
    display: block;
  }

  .sidebar-nav .nav-link {
    display: flex;
    align-items: center;
    font-size: 12px;
    font-weight: 600;
    color: #4154f1;
    transition: 0.3;
    background: #f6f9ff;
    padding: 5px 6px;
    border-radius: 4px;
}
}

 
@media (max-width: 480px) {
  .sidebar {
    width: 150px;  
    margin: 60px 0px;
  }

  .main-content {
    padding: 10px;
  }

  #main {
    margin-top: 60px;
    padding: 20px 30px;
    transition: all 0.3s;
    transform: translateX(33%);
}
} */
</style>
       
 
 

 
