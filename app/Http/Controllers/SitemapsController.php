<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App;
use URL;
use File;
use DB;

//models
use App\Models\Client\Client;
use App\Models\Keyword;
 

class SitemapsController extends Controller
{ 
    public function index(){
        
     
        $keywords = DB::table('keyword');
		//	$keywords = $keywords->join('cities','cities.id','=','keyword.city_id');
			$keywords = $keywords->select('keyword','updated_at');
			/* $keywords = $keywords->orWhere('cities.city','LIKE','noida');
			$keywords = $keywords->orWhere('cities.city','LIKE','delhi');
			$keywords = $keywords->orWhere('cities.city','LIKE','gurgaon');
			$keywords = $keywords->orWhere('cities.city','LIKE','faridabad');
			$keywords = $keywords->orWhere('cities.city','LIKE','ghaziabad');
			$keywords = $keywords->orWhere('cities.city','LIKE','greater noida'); */
			$keywords = $keywords->get();
		 
          return response()->view('client.sitemap', ['keywords' => $keywords])->header('Content-Type', 'text/xml');
        
        
      //  echo "test";die;
		//$sitemap = App::make("sitemap");
		
		// ************
		// STATIC LINKS
		/*	$sitemap->add(URL::to('/'), (new \DateTime())->format(DATE_ATOM), '1.00', 'weekly');
			$sitemap->add(URL::to('/disclaimer'), (new \DateTime())->format(DATE_ATOM), '0.80', 'weekly');
			$sitemap->add(URL::to('/business-owners'), (new \DateTime())->format(DATE_ATOM), '0.80', 'weekly');
			$sitemap->add(URL::to('/clients'), (new \DateTime())->format(DATE_ATOM), '0.80', 'weekly');
			
			*/
		// STATIC LINKS
		// ************
		
		// ********************
		// GETTING STATIC FILES
		/*	$directory = resource_path();
			if(File::exists($directory."/views/client/html")){
				$files = File::allFiles($directory."/views/client/html");
				foreach($files as $file){
					//echo (string)$file."\n";
					$file = explode('/',$file);
					$file = end($file);
					$file = preg_replace('/php/i','html',$file);
					$sitemap->add(URL::to('/'.$file), (new \DateTime())->format(DATE_ATOM), '0.80', 'weekly');
				}
			}
			*/
		// GETTING STATIC FILES
		// ********************
		
		// *************
		// CLIENTS LINKS
			/* $clients = Client::all();
			foreach($clients as $client){
				$sitemap->add(URL::to('/client-detail/'.$client->business_slug), $client->updated_at, '0.80', 'daily');
			} */
		// CLIENTS LINKS
		// *************
		
		// ****************************************
		// SEARCHLIST URL BASED ON CITY AND KEYWORD
		/*	$keywords = DB::table('keyword');
			$keywords = $keywords->join('cities','cities.id','=','keyword.city_id');
			$keywords = $keywords->select('keyword.*','cities.city');
			/* $keywords = $keywords->orWhere('cities.city','LIKE','noida');
			$keywords = $keywords->orWhere('cities.city','LIKE','delhi');
			$keywords = $keywords->orWhere('cities.city','LIKE','gurgaon');
			$keywords = $keywords->orWhere('cities.city','LIKE','faridabad');
			$keywords = $keywords->orWhere('cities.city','LIKE','ghaziabad');
			$keywords = $keywords->orWhere('cities.city','LIKE','greater noida'); */
		/*	$keywords = $keywords->get();
			foreach($keywords as $keyword){
				$sitemap->add(URL::to('/'.generate_slug($keyword->city).'/'.generate_slug($keyword->keyword)), $keyword->updated_at, '0.80', 'weekly');
			}
	 
		$sitemap->store('xml', 'sitemap');
		return $sitemap->render('xml');*/
	}
	
	
	
	public function noida(){
      
        $keywords = DB::table('keyword');
        $keywords = $keywords->select('keyword','updated_at');
        $keywords = $keywords->get();
        return response()->view('client.sitemap-noida', ['keywords' => $keywords])->header('Content-Type', 'text/xml');
	}
	
	public function delhi(){
      
        $keywords = DB::table('keyword');
        $keywords = $keywords->select('keyword','updated_at');
        $keywords = $keywords->get();
        return response()->view('client.sitemap-delhi', ['keywords' => $keywords])->header('Content-Type', 'text/xml');
	}
	public function gurgaon(){
      
        $keywords = DB::table('keyword');
        $keywords = $keywords->select('keyword','updated_at');
        $keywords = $keywords->get();
        return response()->view('client.sitemap-gurgaon', ['keywords' => $keywords])->header('Content-Type', 'text/xml');
	}
	
	
	public function faridabad(){
      
        $keywords = DB::table('keyword');
        $keywords = $keywords->select('keyword','updated_at');
        $keywords = $keywords->get();
        return response()->view('client.sitemap-faridabad', ['keywords' => $keywords])->header('Content-Type', 'text/xml');
	}
	
	
	public function ghaziabad(){
      
        $keywords = DB::table('keyword');
        $keywords = $keywords->select('keyword','updated_at');
        $keywords = $keywords->get();
        return response()->view('client.sitemap-ghaziabad', ['keywords' => $keywords])->header('Content-Type', 'text/xml');
	}
	
	public function mumbai(){
      
        $keywords = DB::table('keyword');
        $keywords = $keywords->select('keyword','updated_at');
        $keywords = $keywords->get();
        return response()->view('client.sitemap-mumbai', ['keywords' => $keywords])->header('Content-Type', 'text/xml');
	}
	
	
	public function pune(){
      
        $keywords = DB::table('keyword');
        $keywords = $keywords->select('keyword','updated_at');
        $keywords = $keywords->get();
        return response()->view('client.sitemap-pune', ['keywords' => $keywords])->header('Content-Type', 'text/xml');
	}
	
	
	public function greaterNoida(){
      
        $keywords = DB::table('keyword');
        $keywords = $keywords->select('keyword','updated_at');
        $keywords = $keywords->get();
        return response()->view('client.sitemap-greaterNoida', ['keywords' => $keywords])->header('Content-Type', 'text/xml');
	}
	
	
		public function chandigarh(){
      
        $keywords = DB::table('keyword');
        $keywords = $keywords->select('keyword','updated_at');
        $keywords = $keywords->get();
        return response()->view('client.sitemap-chandigarh', ['keywords' => $keywords])->header('Content-Type', 'text/xml');
	}
	
	public function meerut(){
      
        $keywords = DB::table('keyword');
        $keywords = $keywords->select('keyword','updated_at');
        $keywords = $keywords->get();
        return response()->view('client.sitemap-meerut', ['keywords' => $keywords])->header('Content-Type', 'text/xml');
	}
	
	public function bangalore(){
      
        $keywords = DB::table('keyword');
        $keywords = $keywords->select('keyword','updated_at');
        $keywords = $keywords->get();
        return response()->view('client.sitemap-bangalore', ['keywords' => $keywords])->header('Content-Type', 'text/xml');
	}
	
	
	public function storeSitemap(){
		$sitemap = App::make("sitemap");
		
		// ************
		// STATIC LINKS
			$sitemap->add(URL::to('/'), (new \DateTime())->format(DATE_ATOM), '1.00', 'weekly');
			$sitemap->add(URL::to('/disclaimer'), (new \DateTime())->format(DATE_ATOM), '0.80', 'weekly');
			$sitemap->add(URL::to('/business-owners'), (new \DateTime())->format(DATE_ATOM), '0.80', 'weekly');
			$sitemap->add(URL::to('/clients'), (new \DateTime())->format(DATE_ATOM), '0.80', 'weekly');
		// STATIC LINKS
		// ************
		
		// ********************
		// GETTING STATIC FILES
			$directory = resource_path();
			if(File::exists($directory."/views/client/html")){
				$files = File::allFiles($directory."/views/client/html");
				foreach($files as $file){
					//echo (string)$file."\n";
					$file = explode('/',$file);
					$file = end($file);
					$file = preg_replace('/php/i','html',$file);
					$sitemap->add(URL::to('/'.$file), (new \DateTime())->format(DATE_ATOM), '0.80', 'weekly');
				}
			}
		// GETTING STATIC FILES
		// ********************
		
		// *************
		// CLIENTS LINKS
			/* $clients = Client::all();
			foreach($clients as $client){
				$sitemap->add(URL::to('/client-detail/'.$client->business_slug), $client->updated_at, '0.80', 'daily');
			} */
		// CLIENTS LINKS
		// *************
		
		// ****************************************
		// SEARCHLIST URL BASED ON CITY AND KEYWORD
			$keywords = DB::table('keyword');
			$keywords = $keywords->join('cities','cities.id','=','keyword.city_id');
			$keywords = $keywords->select('keyword.*','cities.city');
			/* $keywords = $keywords->orWhere('cities.city','LIKE','noida');
			$keywords = $keywords->orWhere('cities.city','LIKE','delhi');
			$keywords = $keywords->orWhere('cities.city','LIKE','gurgaon');
			$keywords = $keywords->orWhere('cities.city','LIKE','faridabad');
			$keywords = $keywords->orWhere('cities.city','LIKE','ghaziabad');
			$keywords = $keywords->orWhere('cities.city','LIKE','greater noida'); */
			$keywords = $keywords->get();
			foreach($keywords as $keyword){
				$sitemap->add(URL::to('/'.generate_slug($keyword->city).'/'.generate_slug($keyword->keyword)), $keyword->updated_at, '0.80', 'weekly');
			}
		// SEARCHLIST URL BASED ON CITY AND KEYWORD
		// ****************************************
		$sitemap->store('xml', 'sitemap');		
	}
}
