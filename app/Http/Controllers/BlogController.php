<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  
use Illuminate\Support\Facades\Input;
use App\Models\Blogdetails;
use Image;
use Auth;
 
class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *	
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		 
		 
        return view('admin.blog.index');
    } 

/**
	* add services
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {   
	 
		$data['button']="Save";
		if($request->isMethod('post') && $request->input('submit')=="Save")
		{
			 
			  $this->validate($request, [
					'name'=>'required|unique:blogdetails,name|max:200', 
					'description'=>'required', 
					'image'=>'required', 
					'meta_title'=>'required', 
					'meta_keywords'=>'required', 
					'meta_description'=>'required', 
					 					
					]);  
					
					
					$blogdetails = new Blogdetails;					
					$blogdetails->name = $request->input('name');
					$blogdetails->slug = generate_slug($request->input('name'));
					$blogdetails->description = $request->input('description');
					$blogdetails->meta_title = $request->input('meta_title');
					$blogdetails->meta_keywords = $request->input('meta_keywords');
					$blogdetails->meta_description = $request->input('meta_description');
					
				//$file = $request->file('logo');
				// LOGO Pictures
				// *************
				if ($request->hasFile('image')) {
					$image = [];
					$filePath = getFolderBlogStructure();
					$file =  $request->file('image');
					$filename = $file->getClientOriginalName();
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename);
			 
					$image['large'] = array(
						'name'=>$filename,
						'alt'=>$filename,
						'width'=>'',
						'height'=>'',
						'src'=>$filePath."/".$filename
					);
					 			
					
					$blogdetails->image = serialize($image);
				}
				
				
					 
					if($blogdetails->save()){
						return redirect('/developer/blog/blogdetails')->with('success','Blog Details successfully added!');
					}else{
						return redirect('/developer/blog/blogdetails')->with('failed','Blog Details not added!');
						
					}
				 
			
		}
        return view('admin.blog.index',$data);
    }
	
	
	/**
	* Edit services
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {  
	 
		 
		$data['edit_data']= Blogdetails::find($id);
		$data['button']="Update";
 
		 //echo "<pre>";print_r($data['edit_data']);die;
		if($request->isMethod('post') && $request->input('submit')=="Update")
		{		 


				$this->validate($request, [
					'name'=>'required|max:200', 
					'description'=>'required', 
					'image'=>'required', 
					'meta_title'=>'required', 
					'meta_keywords'=>'required', 
					'meta_description'=>'required', 	 
					 					
					]); 
			 
					$blogdetails = Blogdetails::find($id);						
					$blogdetails->name = $request->input('name');
					$blogdetails->slug = generate_slug($request->input('name'));
					$blogdetails->description = $request->input('description');
					$blogdetails->meta_title = $request->input('meta_title');
					$blogdetails->meta_keywords = $request->input('meta_keywords');
					$blogdetails->meta_description = $request->input('meta_description');
					
				//$file = $request->file('logo');
				// LOGO Pictures
				// *************
				if ($request->hasFile('image')) {
					$image = [];
					$filePath = getFolderBlogStructure();
					$file = Input::file('image');
					$filename = $file->getClientOriginalName();
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename);
					//$client->logo = $filePath."/".$filename;
					$img = Image::make($destinationPath.'/'.$filename);
					$image['large'] = array(
						'name'=>$filename,
						'alt'=>$filename,
						'width'=>$img->width().'px',
						'height'=>$img->height().'px',
						'src'=>$filePath."/".$filename
					);
					if($img->width()>150){
						$h = $img->height();
						$w = $img->width();
						$newHeight = ($h*150)/$w;
						$img->resize(150,$newHeight);
						$name = $name."_".time();
						$name .= '_150x'.$newHeight.'.'.$ext;
						$img->save($destinationPath.'/'.$name);
						//$client->logo = $filePath.'/'.$name;
						$image['thumbnail'] = array(
							'name'=>$name,
							'alt'=>$name,
							'width'=>'150px',
							'height'=>$newHeight.'px',
							'src'=>$filePath."/".$name
						);
					}
					 if(!empty($blogdetails->image)){
						$oldLogoImages = unserialize($blogdetails->image);
					}
					
					
					$blogdetails->image = serialize($image);
				}

//echo "<pre>";print_r($blogdetails);die;	 		
					 	
					if($blogdetails->save()){

					if(isset($oldLogoImages)){
					foreach($oldLogoImages as $oldImage){
					try{
					if(!unlink(public_path($oldImage['src'])))
					throw new Exception("Old logo image not deleted...");
					}catch(Exception $e){
					echo $e->getMessage();
					}
					}
					}
						return redirect('/developer/blog/blogdetails')->with('success','Blog Details successfully Update!');
					}else{
						return redirect('/developer/blog/edit/'.$id)->with('failed','Blog details  not Update!');
						
					}
		}
        return view('admin.blog.index',$data);
    }
	
	
	
	/**
	* Edit services
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginationBlog(Request $request)
    {    
        if($request->ajax()){
			
			$blogdetails = Blogdetails::orderBy('id','desc');
			if($request->input('search.value')!=''){
				$blogdetails = $blogdetails->where(function($query) use($request){
				$query->orWhere('name','LIKE','%'.$request->input('search.value').'%');
			 
				});
			}
			$blogdetails = $blogdetails->paginate($request->input('length'));
			$recordCollection = [];
			$data = [];
			$recordCollection['draw'] = $request->input('draw');
			$recordCollection['recordsTotal'] = $blogdetails->total();
			$recordCollection['recordsFiltered'] = $blogdetails->total();
		// echo "<pre>";print_r($modesdetails);die;
			foreach($blogdetails as $blog){	 
				// echo "<pre>";print($blog->image);die;

				$image = '';
				$action = '';
				$status = '';
				$separator = '';
			 
				if($blog->image!=''){
				$image = unserialize($blog->image);
				//$image = $image['thumbnail']['src'];
				$image = $image['large']['src'];
				}
				
				if(Auth::user()->current_user_can('administrator')){
    						$action .= $separator.'<a href="/developer/blog/edit/'.$blog->id.'"><i class="fa fa-edit" aria-hidden="true"></i></a> | <a href="/developer/blog/delete/'.$blog->id.'"><i class="fa fa-trash" aria-hidden="true"></i></a>';
    						 
    					}
						
						if(Auth::user()->current_user_can('admin|gb_associate')){
    						$action .= $separator.'<a href="/developer/blog/edit/'.$blog->id.'"><i class="fa fa-edit" aria-hidden="true"></i></a>';
    						 
    					}
						
						if($blog->status=='1'){	
							$status .='Enable &nbsp; <a href="/developer/blog/status/'.$blog->id.'/0" class="btn btn-info btn-circle m-b-5"> <i class="glyphicon glyphicon-ok"></i></a>';
							
						}else{							
							$status .='Disable &nbsp; <a href="/developer/blog/status/'.$blog->id.'/1" class="btn btn-warning btn-circle m-b-5"> <i class="glyphicon glyphicon-remove"></i></a>';						
						}
				
				$data[] = [
					$blog->name,
					$blog->meta_title,
					'<img src="'.url($image).'" width="50px">', 	
					$status,					
					$action,
				];
			}
			$recordCollection['data'] = $data;
			return response()->json($recordCollection);
			
			
		}
    }
	
	public function imageDeleted(Request $request,$id)
	{

 
		 $delet_data = Blogdetails::find($id);	
  
		if($delet_data->image!='')
		{		

			$image = unserialize($delet_data->image);
			$thumbnail = $image['thumbnail']['src'];
			$large = $image['large']['src'];

			if (file_exists($thumbnail))
			{
			unlink($thumbnail);
			}  
			if (file_exists($large))
			{
			unlink($large);
			} 
		 
		}
 
		$edit_data = array('image'  =>"",);	 
		$del = Blogdetails::where('id',$id)->update($edit_data);		 		
		return redirect('developer/blog/edit/'.$id)->with("success","Blog image deleted successfully."); 
		
		
		
	}
	 
	
	public function deleted(Request $request,$id){		 
		 
			$blogdetails = Blogdetails::findorFail($id);

			if($blogdetails->image!='')
			{		

			$image = unserialize($blogdetails->image);		

			if(!empty($image['thumbnail']['src'])){
			$thumbnail = $image['thumbnail']['src'];
			if (file_exists($thumbnail))
			{
			unlink($thumbnail);
			}  
			}

			if(!empty($image['large']['src'])){
			$large = $image['large']['src'];
			if (file_exists($large))
			{
			unlink($large);
			} 
			}
			}
				if($blogdetails->delete()){					 
					return redirect('/developer/blog/blogdetails')->with('success','Blog successfully deleted!');
				}else{
					return redirect('/developer/blog/blogdetails')->with('failed','Blog not deleted!');
				}
		 
	}
	
	 
	
	public function status(Request $request,$id,$val)
	{
		$blogdetails = Blogdetails::find($id);			
		$blogdetails->status = $val;
		if($blogdetails->save()){
		return redirect('developer/blog/blogdetails')->with("success","Status updated successfully.");	
		}else{
		return redirect('developer/blog/blogdetails')->with("failed","Status updated successfully.");
		}
	
	}
	
	
	
	 
}
