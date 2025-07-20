@extends('client.layouts.app')
@section('title')
Estivaledge- Institute in {{Request::segment(1)}}
@endsection 
@section('keyword')
Estivaledge- Institute in {{Request::segment(1)}}
@endsection
@section('description')
Estivaledge- Institute in {{Request::segment(1)}}
@endsection
@section('content')	

    <div class="container">
        <div class="clearfix"></div>
          <h2 class="title">Certified Business <span>Partners</span></h2>
        <div class="clientBlock">
		
		<?php 
			
	 
		if(count($cityclients)>0): ?>
			<?php foreach($cityclients as $clients):
				$image = '';
				if($clients->logo!=''):
					$image = unserialize($clients->logo);
					$image = ''.$image['large']['src'];
				
			?>
				<div class="col-md-3"><div class="inner-client-div">
				<figure><?php if(!empty($image)){ ?><img class="" src="<?php echo asset($image); ?>"> <?php }else{ ?> <img src="<?php echo asset('client/images/default_pp_small.jpg'); ?>" alt="Business Logo" title="Business Logo" height="141" style="width:100%" /><?php  } ?></figure>
				<div class="grid-info">
					<h3><a href="#" title="{{$clients->business_name}}" tabindex="0"><abbr title="{{$clients->business_name}}"><b>{{$clients->business_name}}</b></abbr></a></h3>
					<span><i class="fa fa-map-marker"></i> {{ucfirst($clients->city)}}</span>
					<a href="{{url('training').'/'.generate_slug($clients->business_slug)}}" class="get-quotes" tabindex="0">View</a>
				</div>
				</div></div>
			<?php

endif;

			endforeach; ?>
		<?php endif; ?>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection