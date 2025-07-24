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
      <h1>Favorite Lead</h1>
    </div> 
     <div class="container">
        <div class="header-enquiry">
            <div class="enquiry-tabs">
        <div class="tab">
            <span>Favorite Lead</span>
            <span class="count"><?php if(!empty($leads)){ echo count($leads); } ?></span>
        </div>
        
    </div> 
             <div class="status">
                <span><a href="{{ url('business/myLead')}}">Total Lead</a> | </span>
                <span><a href="{{ url('business/package')}}">Platinum</a></span>
                <span>0h</span>
            </div>
        </div>

        <div class="enquiries-section">
 

            <div class="tab-content active" id="all">
                @if(!empty($leads))
                @foreach($leads as $lead)
                <div class="enquiry-item assignedLeadsClick">
                    <div class="avatar"><?php  echo ucfirst(substr($lead->name,0,1)); ?></div>
                    <div class="enquiry-details">
                        <h4><i class="bi bi-person"></i> {{ucfirst($lead->name)}} <span class="tag">Favorite</span> <i class="fa-regular bi-star favorite-icon <?php  if($lead->favoriteLead){ echo "favorited"; } ?>" data-favoritleads= "{{ $lead->assignId }}" "></i></h4>
                        <p><i class="bi bi-book"></i> {{$lead->kw_text}}</p>
                        <p>Online Class</p>
                        <p>@if($lead->city_name) <i class="bi bi-pin-map-fill"></i>{{$lead->city_name}}@endif @if($lead->zone)<i class="bi bi-pin-map-fill"></i> {{$lead->zone}} @endif</p>
                       
                        <div class="details-section">
                    <div class="title">Enquired for <strong>{{$lead->kw_text}}</strong> Send price and other details.</div>
                    <div class="source">@if($lead->email) <i class="bi bi-envelope"></i>{{$lead->email}}@endif</div>
                     <p> </p>
                </div>
                <div class="show-details" onclick="toggleDetails(this)">Show details</div>
                    </div>
                     
                  <div class="cont-no">
                    <i class="bi bi-telephone-fill"></i><a href="tel:91{{$lead->mobile}}"> {{$lead->mobile}}</a>   <a href="https://wa.me/91{{$lead->mobile}}" target="_blank" aria-label="Whatsup"><i class="bi bi-whatsapp" style="color:#14D73F"></i>{{$lead->mobile}}</a>
                  </div>
                 
                    <div class="enquiry-time"><i class="bi bi-clock"></i> <?php  get_time(strtotime($lead->created)); ?> ago</div>
                </div>
                @endforeach
                @endif              
                
            </div>

           
        </div>
    </div>

     <script>
        // Tab switching functionality
        document.querySelectorAll('.tab-link').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.tab-link').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                tab.classList.add('active');
                const tabContent = document.getElementById(tab.getAttribute('data-tab'));
                tabContent.classList.add('active');
            });
        });

        // Favorite icon toggle functionality
        document.querySelectorAll('.favorite-icon').forEach(icon => {
            icon.addEventListener('click', () => {
                icon.classList.toggle('fa-solid');
                icon.classList.toggle('fa-regular');
                icon.classList.toggle('favorited');
            });
        });

     
        function toggleDetails(element) {
            const detailsSection = element.previousElementSibling;
            detailsSection.classList.toggle('visible');
            element.textContent = detailsSection.classList.contains('visible') ? 'Hide details' : 'Show details';
        }

        function hideCard(element) {
            const card = element.closest('.enquiry-item');
            card.classList.add('hidden');
        }
 
    </script>
    

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
 
</style>
  </main><!-- End #main -->
  
 

<script>
 //$('.leaddf,.leaddt').datepicker({dateFormat:"yy-mm-dd"});
</script>
@endsection
