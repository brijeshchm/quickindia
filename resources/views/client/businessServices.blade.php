@extends('client.layouts.app')
@section('title')
Quick India- Business Services
@endsection 
@section('keyword')
Quick India-  Business Services list 
@endsection
@section('description'),  
Quick India- Business Services POPULAR CATEGORIES, B2B & BUSINESS SERVICES
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
		.course-program ul li {
        	border: 0.5px solid#ccc;
            padding: 12px 14px;
            text-align: center;
            margin: 5px 0px 24px 70px;
            display: inline-flex;
            grid-gap: 46px 106px;
            box-shadow: 0 0 10px 0 #e3e3e3;
		    
		}
		.course-program ul li:hover{ background: linear-gradient(180deg, #ecf4f3, #f1f5f5)
		  }
	</style>
	
	<div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 third-add-section">
               
                    <?php  
                    if(!empty($part_id->category_banner)){
                    $cicons= unserialize($part_id->category_banner); 
                    if($cicons){
                    ?>
                    
                    <img src="{{asset(''.$cicons['category_banner']['src'])}}" >
                    
                    <?php  }else{ ?>
                    
                    <img src="<?php echo asset('client/images/computer-courses-training.jpg'); ?>">
                    <?php  } }else{ ?>
                    <img src="<?php echo asset('client/images/computer-courses-training.jpg'); ?>">
                    <?php  } ?> 
                </div>
        </div>
    </div>
    <style>.business-services ul li {
       
    padding: 11px 12px;
    text-align: center;
    margin: 5px 0px 20px 5px;
    display: inline-flex;
    grid-gap: 46px 106px;
    box-shadow: 0 0 10px 0 #e3e3e3;
}</style>
    <div class="container">
        <div class="clearfix"></div>
        <h2 class="title">Our  <span>Business Services</a></span> </h2>
       <br>
	   <div class="category-box">
	   <div class="business-services">
	       	@if(!empty($parentCategories))
				<?php $i=0; ?>
			@foreach($parentCategories as $parent)	
	        <div class="sk-collapse">
                <div sulevent="toggleSkGroup" class="sk-group show" hasevent="true">
                    <div class="sk-label">
                        <h3 class="title">{{$parent->parent_category}}</h3>
                        <svg class="icon down-chevron" width="12" height="7.41">
                            <use xlink:href="#skIconDownChevron"></use>
                        </svg>
                    </div>
                    <div class="sk-data">
                        
                            
                        
                        
                        <ul class="content-list intent">
                            
                            
                            <?php   $childCategories = App\Models\ChildCategory::where('parent_category_id',$parent->id)->get();
                            if(!empty($childCategories)){
                                foreach($childCategories as $child){
                            ?>
                        <li><a href="{{url($child->child_slug)}}" tabindex="0" target="_blank">{{$child->child_category}}</a></li> 
                                      <?php } } ?>  
                        </ul>
                    </div>
                </div>
        </div>
        
        
          	@endforeach
			@endif
         
	       
	    
            
	 
	   </div>
	   </div>
	   
	   
	   
	   
	   
	   
	 
        <div class="clearfix"></div>
    </div>
    
       
@endsection