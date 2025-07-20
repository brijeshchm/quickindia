 

@extends('client.layouts.app')
@section('title')
     Blog  
@endsection
@section('content')
<link href="{{asset('public/official/css/style.css')}}" rel="stylesheet">
<div class="about-bg page-hearder-area">
    <div class="official-overly"></div> 
  </div>  
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
                <h4>recent post</h4>
                <div class="recent-post">
                  <!-- start single post -->
				  
                       @if(!empty($blogrecents))
					 @foreach($blogrecents as $blogrecent)
						<?php 
						if($blogrecent->image!=''){
						$image = unserialize($blogrecent->image);
						//$image = $image['thumbnail']['src'];
						$image = $image['large']['src'];
						}
						?>
				  <div class="recent-single-post">
                    <div class="post-img">
					<a href="{{url('blog/'.$blogrecent->slug)}}">
					  <img src="<?php echo (isset($image)?asset($image):"");  ?>" width="96px" height="72px" title="{{$blogrecent->name}}" alt="{{$blogrecent->name}}">
					</a>
                    </div>
                    <div class="pst-content">
                      <p><a href="{{url('blog/'.$blogrecent->slug)}}"><?php echo ucfirst($blogrecent->name);?> .</a></p>
                    </div>
                  </div>
				    @endforeach
				  @endif
                
                  <!-- End single post -->
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
           @if(!empty($bloglist))
					 @foreach($bloglist as $blog)
						<?php 
						if($blog->image!=''){
						$image = unserialize($blog->image);
						//$image = $image['thumbnail']['src'];
						$image = $image['large']['src'];
						}
						?>
		  <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="single-blog">
                <div class="single-blog-img">
                  <a href="{{url('blog/'.$blog->slug)}}">
					  <img src="<?php echo (isset($image)?asset($image):"");  ?>" title="{{$blog->name}}" alt="{{$blog->name}}">
				</a>
                </div>
                <div class="blog-meta">
				 
					<span class="date-type">
					<i class="fa fa-calendar"></i><?php echo date('M, d Y',strtotime($blog->created_at)); ?>
					</span>
					</div>
					<div class="blog-text">
					<h4>
					<a href="{{url('blog/'.$blog->slug)}}">{{$blog->name}}</a>
					</h4>
                  <p>
                   <?php echo ucfirst(substr($blog->description,0,220));?>
				    
                  </p>
                </div>
                <span>
					<a href="{{url('blog/'.$blog->slug)}}" class="ready-btn">Read more</a>
				</span>
              </div>
            </div>
			  @endforeach
				  @endif
				  {{ $bloglist->links() }}
		 
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Blog Area -->

  <div class="clearfix"></div>
 @endsection
