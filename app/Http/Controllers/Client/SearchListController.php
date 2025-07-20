<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

//models
use App\Keyword;
use App\Models\Client\AssignedKWDS;
use App\Models\Client;
use App\Models\Citieslists;
use Session;
use App\Models\Client\Comment;

class SearchListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $city, $search_kw)
    {
		$city = ucwords(str_replace("-"," ",$city)); 
		$clientLists =  Client::where('logo','<>','')->where('business_intro','<>','')->limit(12)->get();	
	 
		$keyword = DB::table('keyword')
		->join('parent_category','keyword.parent_category_id','=','parent_category.id')
		->join('child_category','keyword.child_category_id','=','child_category.id')
		->where('keyword','LIKE',ucwords(str_replace("-"," ",$search_kw)))
		->select('keyword.*','parent_category.*','child_category.*','keyword.id as key_id','keyword.faqq1','keyword.faqa1','keyword.faqq2','keyword.faqa2','keyword.faqq3','keyword.faqa3','keyword.faqq4','keyword.faqa4','keyword.faqq5','keyword.faqa5','keyword.meta_title','keyword.meta_description','keyword.meta_keywords','keyword.top_description','keyword.bottom_description','keyword.ratingvalue','keyword.ratingcount')
	        ->first();	

			$clientscheck = DB::table('clients')
			->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
			->join('keyword','assigned_kwds.kw_id','=','keyword.id')
			->join('citylists','assigned_kwds.city_id','=','citylists.id')
			->leftJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')			
			->select('clients.*','citylists.city','assigned_kwds.sold_on_position','c.rating','c.comment_count')
			->where('citylists.city','LIKE',$city)
			->where('clients.active_status','1')
			->where('keyword.keyword','LIKE',ucwords(str_replace("-"," ",$search_kw)))
			//->where('assigned_kwds.sold_on_position','!=','king')
			->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'platinum\' THEN 1 WHEN \'diamond\' THEN 2 WHEN \'FreeListing\' THEN 3 END)'),'asc')
			->groupBy('client_id')			
			//->orderby(DB::raw('(CASE `clients`.`certified_status` WHEN \'1\' THEN 1 END)'),'DESC')		
			->get();
			 

		if(!empty($clientscheck) && count($clientscheck)>0){				
				$clientsList = $clientscheck;
				
		}else{
				
				$clientsList = DB::table('clients')
				->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
				->join('keyword','assigned_kwds.kw_id','=','keyword.id')
				->join('citylists','assigned_kwds.city_id','=','citylists.id')
				->leftJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')			
				->select('clients.*','citylists.city','assigned_kwds.sold_on_position','c.rating','c.comment_count')
		
				//->where('clients.active_status','1')
				->where('keyword.keyword','LIKE',ucwords(str_replace("-"," ",$search_kw)))
		
				->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'platinum\' THEN 1 WHEN \'diamond\' THEN 2 WHEN \'FreeListing\' THEN 3 END)'),'asc')
			//	->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'platinum\' THEN 1 WHEN \'diamond\' THEN 2 END)'),'asc')
				//->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'premium\' THEN 1 WHEN \'platinum\' THEN 2 WHEN \'royal\' THEN 3 WHEN \'preferred\' THEN 4 END)'),'asc')
				->groupBy('client_id')			
				//->orderby(DB::raw('(CASE `clients`.`certified_status` WHEN \'1\' THEN 1 END)'),'DESC')		
				->get();				
		}		
			 
		if(!empty($keyword)){			    
			    
				$onlyClients = DB::table('clients')
				->leftJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')
				->select('clients.*','c.rating','c.comment_count')
				->where('city','LIKE',$city)
				->where('business_name','LIKE',ucwords(str_replace("-"," ",$search_kw)))
				->orWhere('business_name','LIKE',ucwords(str_replace("-","-",$search_kw)))
				->get(); 
					
			
				$kingClientsList = DB::table('clients')
				->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
				->join('keyword','assigned_kwds.kw_id','=','keyword.id')
				->join('citylists','assigned_kwds.city_id','=','citylists.id')
				->rightJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count,comment_content  FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')		
				->select('clients.*','citylists.city','assigned_kwds.sold_on_position','c.rating','c.comment_count','c.comment_content')
				->where('citylists.city','LIKE',$city)
				->where('keyword.keyword','LIKE',ucwords(str_replace("-"," ",$search_kw)))->get();	
					
				$reviewsClientsList = DB::table('clients')
				->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
				->join('keyword','assigned_kwds.kw_id','=','keyword.id')
				->join('citylists','assigned_kwds.city_id','=','citylists.id')
				->rightJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count,comment_content  FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')
				->select('clients.*','citylists.city','assigned_kwds.sold_on_position','c.rating','c.comment_count','c.comment_content')
				->where('citylists.city','LIKE',$city)
				->where('keyword.keyword','LIKE',ucwords(str_replace("-"," ",$search_kw)))		 
				->get();
			
				$searchInCity = Citieslists::where('city','LIKE',$city)->first();	
				$cities = Citieslists::select('id','city')->get();
				$subcategory= DB::table('child_category')
					->join('parent_category','child_category.parent_category_id','=','parent_category.id')		
					->where('parent_category_id',$keyword->parent_category_id)
					->select('parent_category.*','child_category.*')
					->get(); 
				return view('client.searchlist',['clientsList'=>$clientsList,'subcategory'=>$subcategory,'reviewsClientsList'=>$reviewsClientsList,'searchedKW'=>ucwords(str_replace("-"," ",$search_kw)),'searchedInCity'=>$searchInCity,'onlyClients'=>$onlyClients,'keyword'=>$keyword,'city'=>$city,'clientLists'=>$clientLists,'citiesList'=>$cities]);		    
			    
			    
			    
		}else{
			    
					$clients = Client::where('business_slug',$search_kw)->get();
					if(!empty($clients)){
					if(!empty($clients) && count($clients)==0){
					$search_kw =  ucwords(str_replace("-"," ",$search_kw));
					$clients = Client::where('business_name',$search_kw)->get();
					}


					$cities = Citieslists::select('id','city')->get();
					$clientLists =  Client::where('logo','<>','')->where('business_intro','<>','')->where('city','noida')->where('paid_status','1')->limit(12)->get();		
					if(count($clients)>0){
					foreach($clients as $c){
					$client = $c;
					break;
					}

					$comments = Comment::where('comment_client_ID',$client->id)
					->where('comment_approved',1)
					->orderBy('created_at','desc')         
					->paginate(10);

					$sum = Comment::where('comment_client_ID',$client->id)
					->where('comment_approved',1)
					->sum('rating');
					$count = Comment::where('comment_client_ID',$client->id)
					->where('comment_approved',1)
					->count();
					$avgRating = 0;
					if($count!=0)
					$avgRating = ($sum/($count*5))*5;
					//'(SELECT COUNT(*) as count, SUM(`rating`) as sum_rating, MONTH(DATE(`created_at`)) as month, DATE(`created_at`) as created_at FROM `comments` WHERE `comment_client_ID`='.$client->id.' AND `comment_approved`=1 AND DATE(`created_at`)>=\':date\' GROUP BY MONTH(DATE(`created_at`)) ORDER BY created_at desc LIMIT 0,3) AS temp'
					$graphQuery = Comment::select(DB::raw('*'))
					->from(DB::raw('(SELECT COUNT(*) as count, SUM(`rating`) as sum_rating, MONTH(DATE(`created_at`)) as month, DATE(`created_at`) as created_at FROM `comments` WHERE `comment_client_ID`='.$client->id.' AND `comment_approved`=1 GROUP BY MONTH(DATE(`created_at`)) ORDER BY created_at desc LIMIT 0,3) AS temp'))
					->orderBy('created_at')
					->get();
					$barGraphQuery = Comment::select(DB::raw('*'))
					->from(DB::raw('(SELECT COUNT(*) as count, SUM(`rating`) as sum_rating, rating FROM `comments` WHERE `comment_client_ID`='.$client->id.' AND `comment_approved`=1 GROUP BY `rating`) AS temp'))
					->orderBy('rating','desc')
					->get();

					$assignedKwds = DB::table('assigned_kwds')
					->join('keyword','keyword.id','=','assigned_kwds.kw_id')
					->join('citylists','assigned_kwds.city_id','=','citylists.id')
					->join('child_category','child_category.id','=','assigned_kwds.child_cat_id')
					->select('keyword.keyword','citylists.city','child_category.child_category as child_category_name')
					->where('assigned_kwds.client_id','=',$client->id)
					->groupBy('kw_id')
					->get();	

					$assignedCity = DB::table('assigned_kwds')
					->join('keyword','keyword.id','=','assigned_kwds.kw_id')
					->join('citylists','assigned_kwds.city_id','=','citylists.id')
					->join('child_category','child_category.id','=','assigned_kwds.child_cat_id')
					->select('keyword.keyword','citylists.city','child_category.child_category as child_category_name')
					->where('assigned_kwds.client_id','=',$client->id)
					->groupBy('assigned_kwds.city_id')
					->get();


					return view('client.client-detail',['client'=>$client,'cities'=>$cities,'comments'=>$comments,'count'=>$count,'sum'=>$sum,'avgRating'=>number_format($avgRating, 1, '.', ''),'graphQuery'=>$graphQuery,'barGraphQuery'=>$barGraphQuery,'assignedKwds'=>$assignedKwds,'clientLists'=>$clientLists,'clients'=>$clients,'assignedCity'=>$assignedCity]);
					}else{
					return view('client.errorpage');

					}
			}
		
		}

 
	 
	}
		 

           
	
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function keyword(Request $request,$search_kw)
    {
		$city = str_replace("-"," ",$search_kw);
	 
		$clientLists =  Client::where('logo','<>','')->where('business_intro','<>','')->limit(12)->get();	
		$clientsList = DB::table('clients')
			->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
			->join('keyword','assigned_kwds.kw_id','=','keyword.id')
			->join('citylists','assigned_kwds.city_id','=','citylists.id')
			->leftJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')			
			->select('clients.*','citylists.city','assigned_kwds.sold_on_position','c.rating','c.comment_count')
			->where('citylists.city','LIKE',$city)
			->where('clients.active_status','1')
			->where('keyword.keyword','LIKE',ucwords(str_replace("-"," ",$search_kw)))
			//->where('assigned_kwds.sold_on_position','!=','king')
			->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'platinum\' THEN 1 WHEN \'diamond\' THEN 2 WHEN \'FreeListing\' THEN 3 END)'),'asc')
			//->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'premium\' THEN 1 WHEN \'platinum\' THEN 2 WHEN \'royal\' THEN 3 WHEN \'preferred\' THEN 4 END)'),'asc')
			->groupBy('client_id')			
			//->orderby(DB::raw('(CASE `clients`.`certified_status` WHEN \'1\' THEN 1 END)'),'DESC')		
			->get();
			
			 $onlyClients = DB::table('clients')
			->leftJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')
			->select('clients.*','c.rating','c.comment_count')
			->where('city','LIKE',$city)
			->where('business_name','LIKE',ucwords(str_replace("-"," ",$search_kw)))
			->orWhere('business_name','LIKE',ucwords(str_replace("-","-",$search_kw)))
			->get(); 
			
		 
				
		 
		$kingClientsList = DB::table('clients')
			->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
			->join('keyword','assigned_kwds.kw_id','=','keyword.id')
			->join('citylists','assigned_kwds.city_id','=','citylists.id')
			->rightJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count,comment_content  FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')
		
			->select('clients.*','citylists.city','assigned_kwds.sold_on_position','c.rating','c.comment_count','c.comment_content')
			->where('citylists.city','LIKE',$city)
			->where('keyword.keyword','LIKE',ucwords(str_replace("-"," ",$search_kw)))
			->where('assigned_kwds.sold_on_position','=','preferred')
			->get();	
			
			$reviewsClientsList = DB::table('clients')
			->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
			->join('keyword','assigned_kwds.kw_id','=','keyword.id')
			->join('citylists','assigned_kwds.city_id','=','citylists.id')
			->rightJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count,comment_content  FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')
			->select('clients.*','citylists.city','assigned_kwds.sold_on_position','c.rating','c.comment_count','c.comment_content')
			->where('citylists.city','LIKE',$city)
			->where('keyword.keyword','LIKE',ucwords(str_replace("-"," ",$search_kw)))		 
			->get();
			
			
	
		$searchInCity = Citieslists::where('city','LIKE',$city)->first();	
	
		  
			
		$keyword = DB::table('keyword')
		->join('parent_category','keyword.parent_category_id','=','parent_category.id')
		->join('child_category','keyword.child_category_id','=','child_category.id')
		->select('keyword.*','parent_category.*','child_category.*','keyword.id as key_id','keyword.faqq1','keyword.faqa1','keyword.faqq2','keyword.faqa2','keyword.faqq3','keyword.faqa3','keyword.faqq4','keyword.faqa4','keyword.faqq5','keyword.faqa5','keyword.meta_title','keyword.meta_description','keyword.meta_keywords','keyword.top_description','keyword.bottom_description','keyword.ratingvalue','keyword.ratingcount')
		->where('keyword','LIKE',ucwords(str_replace("-"," ",$search_kw)))->first();
		 
 	
		return view('client.searchlist',['clientsList'=>$clientsList,'kingClientsList'=>$kingClientsList,'reviewsClientsList'=>$reviewsClientsList,'searchedKW'=>ucwords(str_replace("-"," ",$search_kw)),'searchedInCity'=>$searchInCity,'onlyClients'=>$onlyClients,'keyword'=>$keyword,'city'=>$city,'clientLists'=>$clientLists]);
		
 
		
    }	
}
