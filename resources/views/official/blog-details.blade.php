@extends('client.layouts.app')
@section('title') 
    @if (!empty($blogdetails->meta_title)) {!! $blogdetails->meta_title !!} 
    @else {!! $blogdetails->title !!} 
    @endif 
@endsection 

@section('keyword') 
    @if (!empty($blogdetails->meta_keyword)) {{ $blogdetails->meta_keyword }} 
    @else Best IT Training Institute in Noida | Delhi | Gurgaon 
    @endif 
@endsection 

@section('description') 
    @if (!empty($blogdetails->meta_description)) {{ $blogdetails->meta_description }} 
    @else  IT Training Institute in Noida | Delhi | Gurgaon for Industrial Training. We conducts IT Software, Hardware, Network & Security Courses training. Corporate Trainer commands all training program. Week Days, Weekend, 6 Week, 6 Months Industrial Training are available 
    @endif 
@endsection
@section('content')
 

  <link href="{{asset('public/official/css/style.css')}}" rel="stylesheet">
<!--<div class="about-bg page-hearder-area">
    <div class="official-overly"></div> 
  </div>-->
  <?php //echo "<pre>";print_r($blogdetails); ?>
  <!-- END Header -->
  <div class="blog-page area-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="page-head-blog">
            <div class="single-blog-page">
              <!-- search option start -->
          
              <!-- search option end -->
            </div>
            <div class="single-blog-page">
              <!-- recent start -->
              <div class="left-blog">
                <h4>Recent post</h4>
                <div class="recent-post">
                  <!-- start single post -->
                 @if(!empty($bloglist))
					 @foreach($bloglist as $blog)
						<?php 
						if($blog->image!=''){
						$image = unserialize($blog->image);
						$image = $image['thumbnail']['src'];
						//$image = $image['large']['src'];
						}
						?>
				 <div class="recent-single-post">
                    <div class="post-img">
                      <a href="{{url('blog/'.$blog->slug)}}">
						<img src="<?php echo (isset($image)?url($image):"");  ?>" width="96px" height="72px" title="{{$blog->name}}" alt="{{$blog->name}}">
						</a>
						</div>
                    <div class="pst-content">
                     <p> <a href="{{url('blog/'.$blog->slug)}}">{{$blog->name}}</a></p>
                    </div>
                  </div>
				  @endforeach
				  @endif
				  
                
                  
                </div>
              </div>
              <!-- recent end -->
            </div>
         
             
             
          </div>
        </div>
        <!-- End left sidebar -->
        <!-- Start single blog -->
        <div class="col-md-8 col-sm-8 col-xs-12">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
           
              <article class="blog-post-wrapper">
                <div class="post-thumbnail">
					<?php 
				 
						if($blogdetails->image!=''){
						$image = unserialize($blogdetails->image);
						//$image = $image['thumbnail']['src'];
						$image = $image['large']['src'];
						}
						?>
                  <img src="<?php echo (isset($image)?url($image):"");  ?>" title="{{$blogdetails->name}}" alt="{{$blogdetails->name}}" />
                </div>
                <div class="post-information">
                  <h2>{{$blogdetails->name}}</h2>
                  <div class="entry-meta">
                    <!--<span class="author-meta"><i class="fa fa-user"></i> <a href="javascript:void(0)">admin</a></span>-->
                    <span><i class="fa fa-clock-o"></i> <?php echo date('d M Y',strtotime($blogdetails->created_at)); ?></span>
                  
                  </div>
                  <div class="entry-content">
                    <?php echo ucfirst(($blogdetails->description)); ?>
                    
				 
                  </div>
                </div>
              </article>
              <div class="clear"></div>
			  
			  
			   
              
			 
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Blog Area -->
  <div class="clearfix"></div>
@endsection
