@extends('client.layouts.app')
@section('title')
Estivaledge- Training in 
@endsection 
@section('keyword')
Estivaledge- Training in 
@endsection
@section('description')
Estivaledge- Training in 
@endsection
@section('content')	
	
	<style>
		.inner-client-div .grid-info h3{
			height:auto;
		}
		.inner-client-div .grid-info .get-quotes{
			margin-top:-25px;
		}
		.font-11{
			font-size:11px;
		}
	</style>
    <div class="container">
        <div class="clearfix"></div>
        <h2 class="title">Our Valued <span>Clients</span> ({{ $clientCategory->name or "" }})</h2>
        <div class="clientBlock">
		
		<?php if(count($clients)>0): ?>
			<?php foreach($clients as $client):
				$image = '';
				if($client->logo!=''):
					$image = unserialize($client->logo);
					$image = ''.$image['large']['src'];
				endif;
			?>
				<div class="col-md-3"><div class="inner-client-div">
				<figure class="text-center"><img class="" src="<?php echo url($image); ?>"></figure>
				<div class="grid-info">
					<h3><a href="#" title="{{$client->business_name}}" tabindex="0"><abbr title="{{$client->business_name}}"><b>{{$client->business_name}}</b></abbr></a>
					</h3>
					<div class="font-11"><span><i class="fa fa-mobile"></i>&nbsp;+91-{{$client->mobile or "mobile not available"}}</span></div>
					<?php
						$arr=[];
						if(!empty($client->address)){
							$arr['address'] = $client->address;
						}
						if(!empty($client->landmark)){
							$arr['landmark'] = $client->landmark;
						}
						if(!empty($client->city)){
							$arr['city'] = $client->city;
						}
						if(!empty($client->state)){
							$arr['state'] = $client->state;
						}
						if(!empty($client->country)){
							$arr['country'] = $client->country;
						}
						$addr = getAddress($arr,20);
						if($addr->ispositiveresponse){
						?>
							<?php if($addr->issubstr): ?>
								<div class="font-11"><span><i class="fa fa-map-marker"></i>&nbsp;{{ $addr->substr }} <a href="#" data-toggle="tooltip" data-placement="bottom" title="{{ $addr->fullstr }}">read more</a></span></div>
							<?php else: ?>
								<div class="font-11"><span><i class="fa fa-map-marker"></i>&nbsp;{{ $addr->fullstr }}</span></div>
							<?php endif;						
						}
					?>
					<!--a href="{{url('training').'/'.$client->business_slug}}" class="get-quotes" tabindex="0">View</a-->
					<div class="text-left">
						<a href="javascript:void(0)" style="color:#FC641B">
							<?php
								$avgRating = 0;
								if($client->comments_count!=0)
									$avgRating = ($client->ratings_sum/($client->comments_count*5))*5;
								
								$whole = floor($avgRating);
								$fraction = $avgRating - $whole;
								$remain = 5-$whole;
								for($i=0;$i<$whole;++$i){
									echo "<i aria-hidden=\"true\" class=\"fa fa-star\"></i>";
								}
								if($fraction>0&&$fraction<1){
									echo "<i aria-hidden=\"true\" class=\"fa fa-star-half-o\"></i>";
									--$remain;
								}
								for($i=0;$i<$remain;++$i){
									echo "<i aria-hidden=\"true\" class=\"fa fa-star-o\"></i>";
								}
							?>
							<!--i aria-hidden="true" class="fa fa-star"></i>
							<i aria-hidden="true" class="fa fa-star"></i>
							<i aria-hidden="true" class="fa fa-star"></i>
							<i aria-hidden="true" class="fa fa-star-half-o"></i>
							<i aria-hidden="true" class="fa fa-star-o"></i-->
						</a> (<span class="font-11">{{$avgRating}}/{{$client->comments_count}} reviews</span>)
					</div>
					<!--div style="font-size:11px;" class="text-align:left"><div class="clearfix"></div></div-->
					<a href="{{url('training').'/'.$client->business_slug}}" class="get-quotes" tabindex="0">View</a>
				</div>
				</div></div>
			<?php endforeach; ?>
		<?php else: ?>
			<h1 class="alert alert-danger">No client found under this category...</h1>
		<?php endif; ?>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection