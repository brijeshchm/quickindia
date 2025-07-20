@extends('client.layouts.app')
@section('title')
Estivaledge- Institute list
@endsection 
@section('keyword')
Estivaledge- Institute list
@endsection
@section('description')
Estivaledge- Institute list
@endsection
@section('content')	
 
    <div class="container">
        <div class="clearfix"></div>
        <h2 class="title">Our Valued <span>Client Categories </span></h2>
        <div class="clientBlock">
		
		<?php if(count($clientCategories)>0): ?>
			<?php foreach($clientCategories as $clientCategory):
				$image = '';
				if($clientCategory->image!=''):
					$image = unserialize($clientCategory->image);
					$image = $image['large']['src'];
				endif;
			?>
				<div class="col-md-3"><div class="inner-client-div">
				<figure><img class="" src="<?php echo url($image); ?>"></figure>
				<div class="grid-info">
					<h3><a href="javascript:void(0)" title="{{$clientCategory->name}}" tabindex="0"><abbr title="{{$clientCategory->name}}"><b>{{$clientCategory->name}}</b></abbr></a></h3>
					<span>501 verified partners</span>
					<a href="{{url('clients').'/'.generate_slug($clientCategory->name)}}" class="get-quotes" tabindex="0">View All</a>
				</div>
				</div></div>
			<?php endforeach; ?>
		<?php endif; ?>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection