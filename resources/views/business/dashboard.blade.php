@extends('business.layouts.app')
@section('title')
Quick India Dashboard
@endsection 
@section('keyword')
Find Best It Training Centre near You, Find Best It Training Institute near You, Find Top 10 IT Training Institute near You, Find Best Entrance Exam Preparation Centre Near you, Top 10 Entrance Exam Centre Near you, Find Best Distance Education Centre Near You, Find Top 10 Distance Education Centre Near You, Find Best School And Colleges Near You, Find Top 10 school And College Near You, Get Education Loan, GET Free career Counselling, Find Best overseas education consultants Near you, Find Top 10 overseas education consultants Near you

@endsection
@section('description')
Find Only Certified Training Institutes, Coaching Centers near you on Estivaledge and Get Free counseling, Free Demo Classes, and Get Placement Assistence.
@endsection
@section('content')	
 
  <main id="main" class="main">
<style>
.lead-dashboard{
    display:flex;
}
.align-items-center{
    margin-left:10px;
}
</style>
   

     <div class="dashboard">
          
        <div class="cards">
            <div class="card">
                <h3>Archived Enquiry</h3>
                <p><a href="{{url('business/enquiry')}}"><?php echo count($leads); ?> Lead</a></p>
            </div>
            <div class="card">
                <h3>Remaining Coins</h3>
                <p class="coins">
                 <i class="bi bi-currency-rupee"></i> <?php  if($clientDetails->coins_amt) { echo $clientDetails->coins_amt; } ?> 
                </p>
            </div>
        </div>
        
          @if (!empty($leads)) 
            @foreach($leads as $lead)
        <div class="lead-details ">
            <div class="lead enquiry-item">
                <div class="img-cls">
                  <i class="fa fa-uaser"></i> <?php  echo ucfirst(substr($lead->name,0,1)); ?>
                </div>
                <div class="info enquiry-details">
                    <h4><i class="bi bi-person"></i> {{ucfirst($lead->name)}} </h4>
                    <p><span class="icon" >
                      <i class="bi bi-clock"></i>
                    <?php  get_time(strtotime($lead->created)); ?> ago</span></p>
                    <p><i class="bi bi-book"></i>  {{$lead->kw_text}}</p>
                     <div class="details-section">
                    <div class="title">Enquired for <strong>{{$lead->kw_text}}</strong> Send price and other details.</div>
                    <div class="source">@if($lead->email) <i class="bi bi-envelope"></i>{{$lead->email}}@endif</div>
                     <p> </p>
                </div>
                <div class="show-details" onclick="toggleDetails(this)">Show details</div>
                </div>
                
                <div class="map">
                    <h4>@if($lead->city_name)<i class="bi bi-pin-map-fill"></i> {{$lead->city_name}}@endif</h4>
                    <p>@if($lead->zone)<i class="bi bi-pin-map-fill"></i> {{$lead->zone}} @endif</p>
                    <!-- <p>R Programming Training</p> -->
                </div>
                <div class="contact">
                    <i class="bi bi-telephone-fill"></i><a href="tel:91{{$lead->mobile}}"> {{$lead->mobile}}</a>   <a href="https://wa.me/91{{$lead->mobile}}" target="_blank" aria-label="Whatsup"><i class="bi bi-whatsapp" style="color:#14D73F"></i>{{$lead->mobile}}</a>
                </div>
            </div>
        </div>
        @endforeach
        @endif       
    </div>
<<script>
      function toggleDetails(element) {
            const detailsSection = element.previousElementSibling;
            detailsSection.classList.toggle('visible');
            element.textContent = detailsSection.classList.contains('visible') ? 'Hide details' : 'Show details';
        }

        function hideCard(element) {
            const card = element.closest('.enquiry-item');
            card.classList.add('hidden');
        }
</script>>
    
   </main><!-- End #main -->
     @endsection
 