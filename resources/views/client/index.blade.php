@extends('client.layouts.app')
@section('title')
A Local Search Engine for Businesses | Quick india
@endsection 
@section('keyword')
Find Best It Training Centre near You, Find Best It Training Institute near You, Find Top 10 IT Training Institute near You, Find Best Entrance Exam Preparation Centre Near you, Top 10 Entrance Exam Centre Near you, Find Best Distance Education Centre Near You, Find Top 10 Distance Education Centre Near You, Find Best School And Colleges Near You, Find Top 10 school And College Near You, Get Education Loan, GET Free career Counselling, Find Best overseas education consultants Near you, Find Top 10 overseas education consultants Near you
@endsection
@section('description')
Find Only Certified Training Institutes, Coaching Centers near you on QuickIndia and Get Free counseling, Free Demo Classes, and Get Placement Assistence.
@endsection
@section('content')
<div class="banner">
   <div class="searchform">
      <h1>Explore Your Choice</h1>
      <p>Let's uncover the best service providers near you.</p>
      <div class="filterForm">
          
          
<style>
     .search-bar .clear-btn {
            position: absolute;
            right: 70px;
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: #666;
                margin-top: 17px;
        }
        .search-bar .voice-btn {
            position: absolute;
            right: 40px;
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: #1a73e8;
                margin-top: 17px;
        }
        
       
</style>

         <?php  
            $location =    (unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']))); 
            $locationCity =  $location['geoplugin_city'];
            if(!$locationCity){
            $locationCity ="delhi";
            }
            ?>
         <form action="/searchlist" method="GET" class="search-form" autocomplete="off">
             <input type="text" class="col-md-4 col-sm-4 location city cityList" name="city" id="locationBtn" >
            <div class="city-result">
                  <ul></ul>
            </div> 
           <!-- <div style="position:relative;">
               <input type="text" placeholder="What service you need today!" name="search_kw" class="col-md-8 col-sm-8 serviceneed home-search">
               <div class="ajax-suggest" style="display: none;">
                  <ul></ul>
               </div>
            </div>-->
            
            
               <div style="position:relative;" class="search-bar">
            
               <input type="text" placeholder="What service you need today!" name="search_kw" class="col-md-8 col-sm-8 serviceneed home-search" id="searchInput">
               <span class="clear-btn" id="clearBtn">✖</span>
             
               <div class="ajax-suggest" style="display: none;">
                  <ul></ul>
               </div>
            </div>
         </form>
           <script>
     
        const clearBtn = document.getElementById('clearBtn');
        const searchInput = document.getElementById('searchInput');
        clearBtn.addEventListener('click', () => {
            searchInput.value = '';
        });
    </script>
      
         <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
   </div>
</div>
<div class="clearfix"></div>
<!--<div class="container-menu">
   <nav class="navbar navbar-default customnav">
      <div class="navbar-header">
         <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="#" title="All Courses" style="display:none;">All Service</a>
      </div>
      @if(!empty($menuArr))
      <div class="collapse navbar-collapse js-navbar-collapse">
         <ul class="nav navbar-nav">
            @foreach($menuArr as $mainMenu)
            <li class="dropdown mega-dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="{{ $mainMenu['parent'][0]->pc_icon }}" aria-hidden="true"></i>{{ $mainMenu['parent'][0]->parent_category }}</a>
               @if(!empty($mainMenu['child']))
               <ul class="dropdown-menu mega-dropdown-menu row">
                  <?php
                     $subMenu = [];
                     $subMenu['list_one'] = '<li class="col-sm-3 col-md-3"><ul>';
                     $subMenu['list_two'] = '<li class="col-sm-3 col-md-3"><ul>';
                     $subMenu['list_three'] = '<li class="col-sm-3 col-md-3"><ul>';
                     $subMenu['list_four'] = '<li class="col-sm-3 col-md-3"><ul>';
                     $i=0;
                     
                     	foreach($mainMenu['child'] as $subMenuItem){
                     	$i++;
                     	if($i=='1'){
                              $subMenu['list_one'] .= "<li><a href='".url(strtolower($locationCity).'/categories/'.$mainMenu['parent'][0]->parent_slug.'/'.$subMenuItem->child_slug)."' title='".$subMenuItem->child_category."'   >$subMenuItem->child_category</a></li>"; 
                     
                     	}
                     	if($i=='2'){
                     	    
                     		$subMenu['list_two'] .= "<li><a href='".url(strtolower($locationCity).'/categories/'.$mainMenu['parent'][0]->parent_slug.'/'.$subMenuItem->child_slug)."' title='".$subMenuItem->child_category."' >$subMenuItem->child_category</a></li>";
                     	}
                     	if($i=='3'){
                     		$subMenu['list_three'] .= "<li><a href='".url(strtolower($locationCity).'/categories/'.$mainMenu['parent'][0]->parent_slug.'/'.$subMenuItem->child_slug)."' title='".$subMenuItem->child_category."' >$subMenuItem->child_category</a></li>";
                     	}
                     	if($i=='4'){
                     		$subMenu['list_four'] .= "<li><a href='".url(strtolower($locationCity).'/categories/'.$mainMenu['parent'][0]->parent_slug.'/'.$subMenuItem->child_slug)."' title='".$subMenuItem->child_category."' >$subMenuItem->child_category</a></li>";
                     		$i=0;
                     	}
                     }
                     
                     $subMenu['list_one']   .= '</ul></li>';
                     $subMenu['list_two']   .= '</ul></li>';
                     $subMenu['list_three'] .= '</ul></li>';
                     $subMenu['list_four']  .= '</ul></li>';
                      
                     echo $subMenu['list_one'].$subMenu['list_two'].$subMenu['list_three'].$subMenu['list_four'];
                     ?>
               </ul>
               @endif
            </li>
            @endforeach
         </ul>
      </div>
      @endif
   </nav>
</div>-->
<style>
   .items-list {
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
   gap: 10px;
   margin-bottom: 20px;
   }
   .items {
   background-color: white;
   border-radius: 10px;
   box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
   display: flex;
   flex-direction: column;
   align-items: center;
   padding: 15px;
   text-align: center;
   transition: transform 0.3s;
   }
   .items:hover {
   transform: translateY(-5px);
   }
   .items img {
   width: 60px;
   height: 60px;
   margin-bottom: 10px;
   }
   .title-serv a {
   font-size: 11px;
   color: #333;
   text-decoration: none;
   font-weight: 500;
   }
   .title-serv a:hover {
   color: #007bff;
   }
</style>
<div class="container">
   <div class="services" >
      <div class="items-list">
         <div class="img-items">             
         <div class="items">
            <a href="{{url('categories/computer-courses')}}" > <img src="{{asset('img/IT-Training.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('categories/computer-courses')}}" >Professional Courses </a></span>
         </div>
         <div class="img-items">  
         <div class="items">
            <a href="{{url('categories/electric-services')}}" >
            <img src="{{asset('img/electric-services.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('categories/electric-services')}}" >Electric Services </a></span>
         </div>
         <div class="img-items">    
       
         <div class="items">
            <a href="{{url('categories/entrance-exams-coaching')}}"  >
            <img src="{{asset('img/government-exam.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('categories/entrance-exams-coaching')}}"  >Government Exam</a> </span>
         </div>
         <div class="img-items">     
         <div class="items">
            <a href="{{url('categories/study-abroad')}}" >
            <img src="{{asset('img/study-abroad.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('categories/study-abroad')}}" >Study Abroad </a></span>
         </div>
         <div class="img-items">      
         <div class="items">
            <a href="{{url('categories/spa-beauty')}}" >
            <img src="{{asset('img/Spa & Beauty.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('categories/spa-beauty')}}" >Spa & Beauty</a> </span>
         </div>
         <div class="img-items">             <div class="items">
            <a href="{{url('categories/repairs-services')}}" >
            <img src="{{asset('img/Repairs-Services.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('categories/repairs-services')}}" > Repair Services</a> </span>
         </div>
         <div class="img-items">             
         <div class="items">
            <a href="{{url('categories/packers-movers')}}" >
            <img src="{{asset('img/Packers-movers.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('categories/packers-movers')}}" >Packers & Movers</a></span>
         </div>
         <div class="img-items">           
         <div class="items">
            <a href="{{('interior-designer')}}" class="keystore">
            <img src="{{asset('img/interior-design.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{('interior-designer')}}" > Interior Design</a> </span>
         </div>
         <div class="img-items">           
         <div class="items">
            <a href="{{('event-organisers')}}" class="keystore">
            <img src="{{asset('img/Event-organizers.png')}}"></a>
             </div>
            <span class="title-serv"> <a href="event-organisers" class="keystore">Event- Organizers</a> </span>
         </div>
         <div class="img-items">             
         <div class="items"><a href="{{url('categories/professional')}}" >
            <img src="{{asset('img/Professional.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('categories/professional')}}" >Professional </a></span>
         </div>
         <div class="img-items">           
         <div class="items"><a href="{{url('categories/contractors')}}" >
            <img src="{{asset('img/contractors.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('categories/contractors')}}" >Contractors</a></span>
         </div>
         <div class="img-items">            
         <div class="items"><a href="{{('/hotels')}}" class="keystore" >
            <img src="{{asset('img/Hotels.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{('hotels')}}" class="keystore">Hotels</a></span>
         </div>
         <div class="img-items">        
         <div class="items"><a href="{{url('restaurants')}}" class="keystore">
            <img src="{{asset('img/Restaurants.png')}}"></a>
             </div>
            <span class="title-serv">
                <a href="{{url('restaurants')}}" class="keystore">Restaurants</a></span>
         </div>
         <div class="img-items">          
         <div class="items"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/distance-education')}}" >
            <img src="{{asset('img/Education.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/distance-education')}}" >Education</a></span>
         </div>
         <div class="img-items">         
         <div class="items"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/rent-buy')}}" >
            <img src="{{asset('img/Rent-buy.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/rent-buy')}}" >Rent & Buy</a></span>
         </div>
         <div class="img-items">       
         <div class="items"><a href="{{url('categories/sports-academy')}}" >
            <img src="{{asset('img/sports.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('categories/sports-academy')}}" >Sport Academy</a></span>
         </div>
         <div class="img-items">   
         <div class="items"><a href="{{('/pg-hostels')}}" >
            <img src="{{asset('img/PG hOTELS.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('/pg-hostels')}}" >PG/Hostels</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/dentists')}}" >
            <img src="{{asset('img/Dentists.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/dentists')}}" >Dentists</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/medical')}}" >
            <img src="{{asset('img/Medical.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/medical')}}" >Medical</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/real-estate-agent')}}" >
            <img src="{{asset('img/real-state.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/real-estate-agent')}}" >Real State</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/loan')}}" >
            <img src="{{asset('img/Loan.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/loan')}}" >Loan</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/carpenters')}}" >
            <img src="{{asset('img/Carpenters.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/carpenters')}}" >Carpenters</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/health-wellness')}}" >
            <img src="{{asset('img/health-wellness.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/health-wellness')}}" >Health & Wellness</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/dancing')}}" >
            <img src="{{asset('img/Dancing.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/dancing')}}" >Dance Academy</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/yoga')}}" >
            <img src="{{asset('img/Yoga.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/yoga')}}" >Yoga</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/income-tax-consultants')}}" >
            <img src="{{asset('img/tax-consultants.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/income-tax-consultants')}}" >Tax Consultants</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/security-system')}}" >
            <img src="{{asset('img/CCTV-security.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/security-system')}}" >CCTV Security</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/web-technologies')}}" >
            <img src="{{asset('images/Web-Designers.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/web-technologies')}}" >Web Designers</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url('job-training')}}" >
            <img src="{{asset('img/Jobs.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('job-training')}}" >Jobs</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url('tours-and-travels')}}" >
            <img src="{{asset('images/tour-travels.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('tours-and-travels')}}" >Tours & Travels</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url('aws-training')}}" >
            <img src="{{asset('images/aws-cloud.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('aws-training')}}" >AWS Training</a></span>
         </div>
         <div class="img-items">             <div class="items"><a href="{{url('school-tuition')}}" >
            <img src="{{asset('images/school.png')}}"></a>
             </div>
            <span class="title-serv"><a href="{{url('school-tuition')}}" >Schools</a></span>
         </div>
      </div>
   </div>

   <style>
    /* .popular-searches {
  padding: 40px 20px;
  background: #f9f9f9;
}

.popular-title h5 {
  font-size: 1.5rem;
  margin-bottom: 10px;
  color: #333;
}

.popular-title .title_icon img {
  height: 40px;
  margin: 0 auto;
}

.popular-list {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
  margin-top: 30px;
}

.popular-list .col-md-2 {
  flex: 1 1 150px;
  max-width: 220px;
  text-align: center;
}

.popular-div {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  transition: transform 0.3s ease;
}

.popular-div:hover {
  transform: translateY(-5px);
}

.popular-div figure {
  margin: 0;
  padding: 0;
}

.popular-div img {
  width: 100%;
  height: 150px;
  object-fit: cover;
  display: block;
}

.grid-info h3 {
  font-size: 1rem;
  padding: 10px;
  color: #333;
}

.grid-info a {
  text-decoration: none;
  color: inherit;
}

.grid-info span {
  display: inline-block;
  font-weight: 600;
}

/* Responsive Tweaks */
@media (max-width: 768px) {
  .popular-list .col-md-2 {
    flex: 1 1 45%;
  }
}

@media (max-width: 480px) {
  .popular-list .col-md-2 {
    flex: 1 1 100%;
  }
} */
</style>
<div class="popular-searches">
      <div class="popular-title text-center">
         <h5>Popular Searches</h5>
         <div class="title_icon"><img src="/client/images/logo.png" alt="logo"></div>
      </div>
      <div class="popular-list">
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/computer-courses')}}" title="IT Training" tabindex="0">
                  <img class="" src="popular/IT-Training.jpg" alt="IT-Training" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/computer-courses')}}"   tabindex="0"> <span>IT Training</span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/entrance-exams-coaching')}}" title="Entrance exam" tabindex="0">
                  <img class="" src="popular/Entrance-Exam.jpg" alt="Entrance-Exam" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/entrance-exams-coaching')}}"   tabindex="0"> <span>Entrance exam </span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/packers-movers')}}"   tabindex="0" title="Packers & Movers" tabindex="0">
                  <img class="" src="popular/Packers-Movers.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/packers-movers')}}"   tabindex="0"> <span>Packers & Movers</span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/interior-designer')}}" title="Interior Design" tabindex="0">
                  <img class="" src="popular/Interior-design.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/interior-designer')}}"   tabindex="0"> <span>Interior Design</span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/real-estate-agent')}}" title="Estate Agents" tabindex="0">
                  <img class="" src="popular/real-estate-agent.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/real-estate-agent')}}"   tabindex="0"> <span>Real Estate Agents</span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/carpenters')}}" title="Carpenters" tabindex="0">
                  <img class="" src="popular/carpenter.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/carpenters')}}"   tabindex="0"> <span>Carpenters</span> </a></h3>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="popular-searches">
      <div class="popular-title text-center">
         <h5>Repairs & Services</h5>
         <div class="title_icon"><img src="/client/images/logo.png" alt="logo"></div>
      </div>
      <div class="popular-list">
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/ac-service')}}" title="AC Service" tabindex="0">
                  <img class="" src="popular/AC-Service.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/ac-service')}}"   tabindex="0"> <span>AC Service</span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/car-service')}}" title="Car Services" tabindex="0">
                  <img class="" src="popular/car-services.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/car-service')}}"   tabindex="0"> <span>Car Services</span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/laundry-service')}}" title="Laundry Services" tabindex="0">
                  <img class="" src="popular/washing-machines.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/laundry-service')}}"   tabindex="0"> <span>Laundry Services</span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/electricity-service')}}" title="Electricity Services" tabindex="0">
                  <img class="" src="popular/Electricity-Services.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/electricity-service')}}"   tabindex="0"> <span>Electrician Services</span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url('hotels')}}" title="Hotel Services" tabindex="0">
                  <img class="" src="popular/Hotel-Services.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url('hotels')}}"   tabindex="0"> <span>Hotels </span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/clinical-research-training')}}" title="Fitness Services" tabindex="0">
                  <img class="" src="popular/Fitness-Services.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/clinical-research-training')}}"   tabindex="0"> <span>Health & Fitness</span> </a></h3>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="popular-searches">
      <div class="popular-title text-center">
         <h5>Wedding Planning</h5>
         <div class="title_icon"><img src="/client/images/logo.png" alt="logo"></div>
      </div>
      <div class="popular-list">
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url('catering-services')}}" title="Catering Services" tabindex="0">
                  <img class="" src="popular/Catering-Services.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url('catering-services')}}"   tabindex="0"> <span>Catering Services</span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/banquet-halls')}}" title="Banquet Halls" tabindex="0">
                  <img class="" src="popular/Banquet-Halls.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/banquet-halls')}}"   tabindex="0"> <span>Banquet Halls </span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url('stage-decorators')}}" title="Stage Decorators" tabindex="0">
                  <img class="" src="popular/Stage-Decorators.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url('stage-decorators')}}"   tabindex="0"> <span>Stage Decorators</span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url('makeup-artists')}}" title="Makeup Artists" tabindex="0">
                  <img class="" src="popular/makeup-artists.jpg"  alt=""></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url('makeup-artists')}}"   tabindex="0"> <span>Makeup Artists</span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url('mehendi-artists')}}" title="Mehendi Artists" tabindex="0">
                  <img class="" src="popular/Mehendi-Artists.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url('mehendi-artists')}}"   tabindex="0"> <span>Mehendi Artists</span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url('bridal-wear')}}" title="Bridal Wear" tabindex="0">
                  <img class="" src="popular/Bridal-Wear.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url('bridal-wear')}}"   tabindex="0"> <span>Bridal Wear</span> </a></h3>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="popular-searches">
      <div class="popular-title text-center">
         <h5>Entrance Exams </h5>
         <div class="title_icon"><img src="/client/images/logo.png" alt="logo"></div>
      </div>
      <div class="popular-list">
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/entrance-exams-coaching')}}" title="Air Force & Navy / SSR / MR" tabindex="0">
                  <img class="" src="popular/air-force-navy.jpg"  alt="Air Force & Navy / SSR / MR" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/entrance-exams-coaching')}}"   tabindex="0"> <span>Air Force & Navy / SSR / MR </span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/entrance-exams-coaching')}}" title="UPSC & IAS" tabindex="0">
                  <img class="" src="popular/UPSC-IAS.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/categories/entrance-exams-coaching')}}"   tabindex="0"> <span>UPSC & IAS</span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/ssc-cgl')}}" title="SSC CGL JEE" tabindex="0">
                  <img class="" src="popular/SSC-CGL-JEE.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/ssc-cgl')}}"   tabindex="0"> <span>SSC CGL JEE </span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/rrb-ntpc-coaching')}}" title="NTPC & RRB Railway" tabindex="0">
                  <img class="" src="popular/NTPC-RRB-Railway.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/rrb-ntpc-coaching')}}"   tabindex="0"> <span>NTPC & RRB Railway </span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/cat-coaching')}}" title="CAT" tabindex="0">
                  <img class="" src="popular/CAT-exam.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/cat-coaching')}}"   tabindex="0"> <span>CAT/NEET</span> </a></h3>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="popular-div">
               <figure><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/ctet-coaching')}}" title="CTET Super TET" tabindex="0">
                  <img class="" src="popular/CTET-Super-TET.jpg"  alt="" ></a>
               </figure>
               <div class="grid-info ">
                  <h3><a href="{{url(strtolower(str_replace(" ","-",$locationCity)).'/ctet-coaching')}}"   tabindex="0"> <span>CTET Super TET</span> </a></h3>
               </div>
            </div>
         </div>
      </div>
   </div>
   
   
   <div class="">
      <div class="clearfix"></div>
      <h2 class="title">Our Courses <span>Computer Courses & Training</a></span> </h2>
      <br>
      <div class="category-box">
         <div class="course-program">
            <div class="row">
               <div class="">
                  <div class="course-list">
                     <?php $i = 0; $x = 0; ?>
                     <?php  $city = strtolower(str_replace(" ","-",$locationCity));
                        if(!$city){
                            $city = "delhi";
                        }
                        
                        
                        ?>
                     @if(!empty($subcategory))
                     @foreach($subcategory as $category)
                      <div class="crs-img-items">
                     <div class="course-items">
                        <a href="{{url(strtolower($city).'/categories/'.$category->parent_slug.'/'.$category->child_slug)}}" title="<?php if(!empty($category->child_category)){  echo $category->child_category; } ?>" > 
                        <?php  if(!empty($category->pc_icon)){
                           $vicons= unserialize($category->pc_icon); ?> 
                        <img src="{{asset($vicons['pc_icon']['src'])}}" width="100">	 <?php 
                           }else{ ?>
                        <img src="{{asset('images/it-training.png')}}">
                        <?php  } ?>
                        </a>
                        </div>
                        <span class="course-title"><a href="{{url(strtolower($city).'/categories/'.$category->parent_slug.'/'.$category->child_slug)}}" ><?php if(!empty($category->child_category)){  echo substr($category->child_category,0,16); } ?></a></span>
                     </div>
                     @endforeach
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
   </div>
   
   <div class="">
      <div class="clearfix"></div>
      <h2 class="title">Our <span>Entrance Exams Coaching</a></span> </h2>
      <br>
      <div class="category-box">
         <div class="course-program">
            <div class="row">
               <div class="">
                  <div class="course-list">
                     <?php $i = 0; $x = 5; ?>
                     @if(!empty($entranceExam))
                     @foreach($entranceExam as $entrance)
                     @if( $entrance->child_slug != 'hotel-management-entrance-exam-coaching')
                      <div class="crs-items">
                     <div class="course-items">
                        <a href="{{url(strtolower($city).'/categories/'.$entrance->parent_slug.'/'.$entrance->child_slug)}}" title="<?php if(!empty($entrance->child_category)){  echo $entrance->child_category; } ?>" >
                        <?php  if(!empty($entrance->pc_icon)){
                           $enicons= unserialize($entrance->pc_icon); ?> 
                        <img src="{{asset($enicons['pc_icon']['src'])}}" width="100">	 <?php 
                           }else{ ?>
                        <img src="{{asset('images/it-training.png')}}">
                        <?php  } ?>
                        </a>
                        </div>
                        <span class="course-title"><a href="{{url(strtolower($city).'/categories/'.$entrance->parent_slug.'/'.$entrance->child_slug)}}" title="<?php if(!empty($entrance->child_category)){  echo $entrance->child_category; } ?>" ><?php if(!empty($entrance->child_category)){  echo substr($entrance->child_category,0,16); } ?></a></span>
                     </div>
                     @endif
                     @endforeach
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
   </div>
   <div class="">
      <div class="clearfix"></div>
      <h2 class="title">Our <span>Study Abroad</a></span> </h2>
      <br>
      <div class="category-box">
         <div class="course-program">
            <div class="row">
               <div class="">
                  <div class="course-list">
                     <?php   $x = 9; ?>
                     <?php  $city = strtolower(str_replace(" ","-",$locationCity));
                        if(!$city){
                            $city ="delhi";
                        }
                        ?>
                     @if(!empty($studyAbroad))
                     @foreach($studyAbroad as $study)
                     @if($study->child_slug !='overseas-journalism-education-consultants' && $study->child_slug !='overseas-engineering-education-consultant')
                      <div class="crs-items">
                     <div class="course-items">
                        <a href="{{url(strtolower($city).'/categories/'.$study->parent_slug.'/'.$study->child_slug)}}" title="<?php if(!empty($study->child_category)){  echo $study->child_category; } ?>" >
                        <?php  if(!empty($study->pc_icon)){
                           $abicons= unserialize($study->pc_icon); ?> 
                        <img src="{{asset(''.$abicons['pc_icon']['src'])}}" width="100">	 <?php 
                           }else{ ?>                                        
                        <img src="{{asset('images/it-training.png')}}">
                        <?php  } ?>
                        </a>
                        </div>
                        <span class="course-title"><a href="{{url(strtolower($city).'/categories/'.$study->parent_slug.'/'.$study->child_slug)}}" title="<?php if(!empty($study->child_category)){  echo $study->child_category; } ?>" ><?php if(!empty($study->child_category)){  echo substr($study->child_category,0,16); } ?></a></span>
                     </div>
                     @endif
                     @endforeach
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
   </div>
   <div class="blog" >
      <div class="tab-content">
         <div class="review-list" >
            <div class="blogBlock">
               <div class="blog-title text-center">
                  <h5>Blog</h5>
                  <div class="title_icon"><img src="/client/images/logo.png" alt="logo"></div>
               </div>
               <div class="col-md-12">
                  @if(!empty($blogdetails))
                  @foreach($blogdetails as $blog)
                  <?php
                     if($blog->image!=''){
                     $image = unserialize($blog->image);
                     $image = $image['thumbnail']['src'];
                     }	 
                     ?>
                  <div class="col-md-4">
                     <div class="reviews-left" >
                        <h4> <a href="{{url('blog/'.$blog->slug)}}"><img src="<?php echo (isset($image)?asset($image):"");  ?>" width="100%" height="150px" title="{{$blog->name}}" alt="{{$blog->name}}"></a></h4>
                        <h3> <a href="{{url('blog/'.$blog->slug)}}">{{$blog->name}}</a></h3>
                        <p style="text-align: justify;font-weight: 500;padding: 0px 15px;"><?php echo ucfirst(substr($blog->description,0,220));?>.<a href="{{url('blog/'.$blog->slug)}}">View More...</a></p>
                     </div>
                  </div>
                  @endforeach
                  @endif
                  <nav><a href="{{url('/blog')}}" class="viewall-txt">View All</a></nav>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="banner_botton_open">
      <a href="javascript:void(0);" class="connectedclosebtn">&nbsp;</a>
      <div class="jbt"> Fill this form to Grab the best Deals on <span class="orng">QuickInd</span></div>
      <div class="popup">
         <form class="lead_form" onsubmit="return homeController.saveEnquiry(this)" method="POST">
            <aside>
               <label>Your name<span>*</span></label>
               <div class="popup-form">
                  {{ csrf_field()}}  
                  <input class="form-control home-popup-form" type="text" placeholder="Enter Full Name" name="name" value="">
               </div>
               <label>Your Mobile<span>*</span></label>
               <div class="popup-form">
                  <input class="form-control home-popup-form" type="text" placeholder="Enter Mobile" name="mobile" value="">
               </div>
               <label>Your Email ID<span>*</span></label>
               <div class="popup-form">
                  <input class="form-control home-popup-form" type="text" placeholder="Enter Email" name="email" value="">
               </div>
               <label>City<span>*</span></label>
               <div class="popup-form" id="select-city-proceed">
                  <select class="dropdown-arrow dropdown-arrow-inverse home-popup-form select2-single city" name="city_id">
                     <option value="">Select City</option>
                  </select>
               </div>
               <label>Interested in<span>*</span></label>
               <div class="popup-form">
                  <input type="text" placeholder="Type text" class="form-control city-form home-search" name="kw_text" autocomplete="off">
               </div>
               <div class="ajax-suggest ajax-suggest-lead-ajax" style="display: none;">
                  <ul></ul>
               </div>
               <p>
                  <label class="moblab">&nbsp;</label>
                  <input class="jbtn" type="submit" value="Submit" />
                  <input type="reset" class="reset_lead_form hide" value="reset" />
               </p>
            </aside>
         </form>
      </div>
      <section>
         <div class="jpb">
            <p> Your number will be shared only to these experts</p>
            <p>
               <span class="bul"></span> Get Free Expert Online Counseling 
            </p>
            <p>
               <span class="bul"></span> Get Free Demo Classes
            </p>
            <p>
               <span class="bul"></span> Get Fees & Discounts
            </p>
         </div>
      </section>
   </div>
</div>
<div class="connectedpopup">
   <a href="javascript:void(0);" class="connectedclosebtn">&nbsp;</a>
   <div class="jbt"> Fill this form and get best deals from "<span class="orng">QuickInd</span>"</div>
   <div class="popup">
      <form class="lead_form" onsubmit="return homeController.saveEnquiry(this)" >
         <aside>
            <label>Your name<span>*</span></label>
            <div class="popup-form">
               <input class="form-control city-form" type="text" placeholder="Enter Full Name" name="name" value="">
               <input type="hidden" name="lead_form" value="1">
            </div>
            <label>Your Mobile<span>*</span></label>
            <div class="popup-form">
               <input class="form-control city-form" type="text" placeholder="Enter Mobile" name="mobile" value="">
            </div>
            <label>Your Email ID<span>*</span></label>
            <div class="popup-form">
               <input class="form-control city-form" type="text" placeholder="Enter Email" name="email" value="">
            </div>
            <label>City<span>*</span></label>
            <div class="popup-form" id="select-city-proceed">
               <select class="dropdown-arrow dropdown-arrow-inverse city-form select2-single city" name="city_id">
                  <option value="">Select City</option>
               </select>
            </div>
            <label>Interested in<span>*</span></label>
            <div class="popup-form">
               <input type="text" placeholder="Type text" class="form-control city-form home-search" name="kw_text" autocomplete="off">
            </div>
            <div class="ajax-suggest ajax-suggest-lead-ajax" style="display: none;">
               <ul></ul>
            </div>
            <p>
               <label class="moblab">&nbsp;</label>
               <input class="jbtn" type="submit" value="Submit" />
               <input type="reset" class="reset_lead_form hide" value="reset" />
            </p>
         </aside>
      </form>
   </div>
   <section >
      <div class="jpb">
         <p>
            <span class="bul"></span> Your requirement is sent to the selected relevant businesses
         </p>
         <p>
            <span class="bul"></span> Businesses compete with each other to get you the Best Deal 
         </p>
         <p>
            <span class="bul"></span> You choose whichever suits you best
         </p>
         <p>
            <span class="bul"></span> Contact Info sent to you by SMS/Email
         </p>
      </div>
   </section>
</div>
@endsection