
@extends('client.layouts.app')
@section('title')
     Package Pricing
@endsection
@section('content') 
 <link href="{{asset('public/official/css/style.css')}}" rel="stylesheet">
<div class="about-bg page-hearder-area">
    <div class="official-overly"></div> 
  </div>   
  <style>
    #pricing{ padding:40px 0px; }
  </style>
  
  <div id="pricing" class="about-area area-padding" >
     <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Pricing Table</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="pri_table_list active">
            <h3>basic <br/> <span>1500 / month</span></h3>
            <ol>
              <li class="check">Unlimited Users Access</li>
              <li class="check">Online system</li>
              <li class="check">Full access</li>
              <li class="check">Push Notification</li>
              <li class="check">Roles & Permissions</li>
               
                <li class="check">Coins(1333)</li>
            </ol>
            <button data-toggle="modal" data-target="#inquiry">sign up now</button>
          </div>
        </div>
		 
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="pri_table_list active">
            <span class="saleon">top sale</span>
            <h3> Gold<br/> <span>INR 8000 Six Months</span></h3>
            <ol>
                <li class="check">Unlimited Users Access</li>
              <li class="check">Online system</li>
              <li class="check">Full access</li>
              <li class="check">Push Notification</li>
                <li class="check">Roles & Permissions</li>
             <!-- <li class="check cross">Support unlimited</li>-->
              <li class="check">Coins(7272)</li>
             
              </ol>
            <button data-toggle="modal" data-target="#inquiry">sign up now</button>
          </div>
        </div>
		
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="pri_table_list active">
              
            <h3>Diamond <br/> <span>INR 12000 Yearly</span></h3>
            <ol>
                <li class="check">Unlimited Users Access</li>
              <li class="check">Online system</li>
              <li class="check">Full access</li>
              <li class="check">Push Notification</li>
              <li class="check">Roles & Permissions</li>
              <!--<li class="check">Support unlimited</li>-->
           <li class="check">Coins(11111)</li>
              
            </ol>
            <button data-toggle="modal" data-target="#inquiry">sign up now</button>
          </div>
        </div>
      </div>
    </div>
 </div>
 @endsection
