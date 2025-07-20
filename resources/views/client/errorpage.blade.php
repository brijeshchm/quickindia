@extends('client.layouts.app')
@section('title')
Quick India-  Oops !Page Not Found
@endsection 
@section('keyword')
Quick India- Oops !Page Not Found
@endsection
@section('description')
Quick India-  Oops !Page Not Found
@endsection
@section('content')	
<div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 third-add-section"><img src="<?php echo asset('client/images/thirdAdd.jpg'); ?>"></div>
        </div>
</div> 
<div class="container">

			
			 <div class="row">
                <div class="col-sm-12 col-md-12 banner-details">
				<h4 class="Oops-txt">Oops! No Result Found </h5>				 
				  <h2 class="error-txt"></h2>
</div>
</div>

</div>
 <div class="clearfix"></div>
    <div class="container">
	 
	  <div class="add-section">
	   <div class="col-xs-12"> 				
			 
		<?php if(!empty($clientLists)): ?>
			<?php foreach($clientLists as $client):
				$image = '';
				if($client->logo!=''):
					$image = unserialize($client->logo);
					$image = $image['large']['src'];
				
			?>
			
				<div class="col-md-3">
				<div class="inner-client-div">
			 
				<figure><img class="" src="<?php echo url(''.$image); ?>" style="width:100%;"></figure>
				<div class="grid-info">
					<h3><a href="{{url('training').'/'.generate_slug($client->business_slug)}}" title="{{$client->business_name}}" tabindex="0"><div title="{{$client->business_name}}"><strong>{{$client->business_name}}</strong></div></a></h3>
				
					<strong>{{ucfirst($client->city)}}</strong>
					<a href="{{url('training').'/'.generate_slug($client->business_slug)}}" class="get-quotes" tabindex="0">View</a>
				</div>
				</div></div>
				
				
			<?php 
			endif;
			endforeach; 
			
			endif
			?>
                </div>
                </div>
                </div>
               
 
@endsection