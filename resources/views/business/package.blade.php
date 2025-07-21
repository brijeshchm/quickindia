@extends('business.layouts.app')
@section('title')
Quick India | package
@endsection 
@section('keyword')
Find Best It Training Centre near You, Find Best It Training Institute near You, Find Top 10 IT Training Institute near You, Find Best Entrance Exam Preparation Centre Near you, Top 10 Entrance Exam Centre Near you, Find Best Distance Education Centre Near You, Find Top 10 Distance Education Centre Near You, Find Best School And Colleges Near You, Find Top 10 school And College Near You, Get Education Loan, GET Free career Counselling, Find Best overseas education consultants Near you, Find Top 10 overseas education consultants Near you

@endsection
@section('description')
Find Only Certified Training Institutes, Coaching Centers near you on Quickinida and Get Free counseling, Free Demo Classes, and Get Placement Assistence.
@endsection
@section('content')	

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Package</h1>
      
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
         

        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Membership</button>
                </li>

               

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Package Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-2 label ">Membership Type : </div>
                    <div class="col-lg-3 col-md-6"><?php  echo $client->client_type; ?> Membership</div>
               
                    <div class="col-lg-3 col-md-2 label"><?php  echo $client->client_type; ?> Membership Ends on </div>
                    <div class="col-lg-3 col-md-6"><?php
                     
                    if($client->expired_on !=='0000-00-00 00:00:00'){ echo date('d M, Y',strtotime($client->expired_on)); } ?></div>
                 
                   
                    
                  </div>
                  
                <?php  if($client->client_type != 'Diamond'){ ?>
                  <div class="row">
                       <div class="col-lg-3 col-md-2 label">Remaining Cons</div>
                    <div class="col-lg-3 col-md-6"><a href="{{url('business/buy-package')}}">Buy Package</a>
                    </div>
                    <div class="col-lg-3 col-md-4 label">Extent Membership</div>
                    <div class="col-lg-3 col-md-8"><a href="">EXTEND PLATINUM MEMBERSHIP</a></div>
                      
                  </div>
                <?php  } 
                    function dataEncodeJsonBase64($o){
                    $o = json_encode($o);
                    $o = base64_encode($o);
                    return $o;
                    }
                    function dataDecodeJsonBase64($o){
                    $o = base64_decode($o);
                    $o = json_decode($o); 
                    
                    return $o;
                    }
                
                ?>
                
                </div>
              </div> 
              
              
               <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Buy Details </h5>

                  <div class="row">
                    <div class="col-lg-2 col-md-4 label "><i class="bi bi-currency-rupee"></i> 1000: </div>
                    <div class="col-lg-2 col-md-8"> 1111 Coins</div>
                    <?php 
                   // echo "<pre>";print_r($client);
                        $data1['name'] = trim($client->business_name);
                        $data1['email'] = trim($client->email);
                        $data1['amt'] = trim(1000);
                        $data1['phone'] = $client->mobile;
                        $data1['coins'] = trim(1111);
                        $data1['country'] = $client->country;
                        $data1['state'] = $client->state;
                        $data1['city'] = $client->city;
                        $data1['id'] = $client->id;
                        $data1['username'] = $client->username;
                        $resultData1000 = dataEncodeJsonBase64($data1);
                    ?>
                     <div class="col-lg-3 col-md-8"> <a href="{{url('business/pay-deposit/?status=correction&o='.$resultData1000)}}">Buy Package</a></div>
                  </div>
                    <div class="row">
                    <div class="col-lg-2 col-md-4 label "><i class="bi bi-currency-rupee"></i> 2000 : </div>
                    <div class="col-lg-2 col-md-8"> 2272 Coins</div>
                     <?php 
                        $data2['name'] = $client->business_name;
                        $data2['email'] = $client->email;
                        $data2['amt'] = trim(2000);
                        $data2['phone'] = $client->mobile;
                        $data2['coins'] = trim(2272);
                        $data2['country'] = $client->country;
                        $data2['state'] = $client->state;
                        $data2['city'] = $client->city;
                        $data1['id'] = $client->id;
                        $data1['username'] = $client->username;
                        $resultData2000 = dataEncodeJsonBase64($data2);
                    ?>
                     <div class="col-lg-3 col-md-8"> <a href="{{url('business/pay-deposit/?status=correction&o='.$resultData2000)}}">Buy Package</a></div>
                  </div>
                  
                       <div class="row">
                    <div class="col-lg-2 col-md-4 label "><i class="bi bi-currency-rupee"></i> 3000 : </div>
                    <div class="col-lg-2 col-md-8"> 3529 Coins</div>
                      <?php 
                        $data3['name'] = trim($client->business_name);
                        $data3['email'] = trim($client->email);
                        $data3['amt'] = trim(3000);
                        $data3['phone'] = $client->mobile;
                        $data3['coins'] = trim(3529);
                        $data3['country'] = $client->country;
                        $data3['state'] = $client->state;
                        $data3['city'] = $client->city;
                        $data3['id'] = $client->id;
                        $data3['username'] = $client->username;
                        $resultData3000 = dataEncodeJsonBase64($data3);
                    ?>
                     <div class="col-lg-3 col-md-8"> <a href="{{url('business/pay-deposit/?status=correction&o='.$resultData3000)}}">Buy Package</a></div>
                  </div>
                 
                    <div class="row">
                    <div class="col-lg-2 col-md-4 label "><i class="bi bi-currency-rupee"></i> 5000 : </div>
                    <div class="col-lg-2 col-md-8"> 6099 Coins</div>
                    <?php 
                        $data4['name'] = trim($client->business_name);
                        $data4['email'] = trim($client->email);
                        $data4['amt'] = trim(5000);
                        $data4['phone'] = $client->mobile;
                        $data4['coins'] = trim(6099);
                        $data4['country'] = $client->country;
                        $data4['state'] = $client->state;
                        $data4['city'] = $client->city;
                        $data4['id'] = $client->id;
                        $data4['username'] = $client->username;
                        $resultData5000 = dataEncodeJsonBase64($data4);
                    ?>
                     <div class="col-lg-3 col-md-8"> <a href="{{url('business/pay-deposit/?status=correction&o='.$resultData5000)}}">Buy Package</a></div>
                  </div>
                  
                     <div class="row">
                    <div class="col-lg-2 col-md-4 label "><i class="bi bi-currency-rupee"></i> 10000 : </div>
                    <div class="col-lg-2 col-md-8"> 12500 Coins</div>
                     <?php 
                        $data5['name'] = trim($client->business_name);
                        $data5['email'] = trim($client->email);
                        $data5['amt'] = trim(10000);
                        $data5['phone'] = $client->mobile;
                        $data5['coins'] = trim(12500);
                        $data5['country'] = $client->country;
                        $data5['state'] = $client->state;
                        $data5['city'] = $client->city;
                        $data5['id'] = $client->id;
                        $data5['username'] = $client->username;
                        $resultData10000 = dataEncodeJsonBase64($data5);
                    ?>
                     <div class="col-lg-3 col-md-8"> <a href="{{url('business/pay-deposit/?status=correction&o='.$resultData10000)}}">Buy Package</a></div>
                  </div>
             


                     <div class="row">
                    <div class="col-lg-12">

                        <strong>Note: 18% GST Extra on above packages </strong>

                    </div>
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