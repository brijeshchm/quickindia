<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;

use DB;
use Image;
use App\Models\ChildCategory; //Model

use App\Models\ParentCategory; //Model

class ChildCategoryController extends Controller
{
	protected $danger_msg = '';
	protected $success_msg = '';
	protected $warning_msg = '';
	protected $info_msg = '';
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         
		if(!$request->user()->current_user_can('administrator')){
			return view('errors.unauthorised');
		}
		$child_categories = DB::table('child_category')
					->join('parent_category', 'child_category.parent_category_id', '=', 'parent_category.id')
					->select('child_category.*', 'parent_category.parent_category')->orderBy('id','desc')
					->get();		
		$parent_categories = ParentCategory::all();
		return view('admin/child_category',['child_categories'=>$child_categories,'parent_categories'=>$parent_categories]);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
		if(!$request->user()->current_user_can('administrator')){
			return view('errors.unauthorised');
		}
        $validator = Validator::make($request->all(), [
            'child_category' => 'required|max:255|unique:child_category'
        ]);

        if($request->hasFile('pc_icon')){
        $validator = Validator::make($request->all(),[					 
        'pc_icon' => 'required|mimes:jpeg,png,jpg,svg,webp|dimensions:min_width=20,min_height=20,max_width=200,max_height=200',		 			
        ]);
        } 

        
        if ($validator->fails()) {
            return redirect("developer/child_category")
                        ->withErrors($validator)
                        ->withInput();
        }

				
				
		
		$child_category = new ChildCategory;
		$child_category->child_category = $request->input('child_category');
		$child_category->child_slug = generate_slug($request->input('child_category'));
		$child_category->parent_category_id = $request->input('parent_category_id');
		
		
        		
        if ($request->hasFile('pc_icon')) {
        	$image = [];
        	$filePath = getFolderCourseStructure();
        
        	$file =  $request->file('pc_icon');
        	$filename = $file->getClientOriginalName();
        	$destinationPath = public_path($filePath);
        	$nameArr = explode('.',$filename);
        	$ext = array_pop($nameArr);
        	$name = implode('_',$nameArr);
        	if(file_exists($destinationPath.'/'.$filename)){
        		$filename = $name."_".time().'.'.$ext;
        	}
        	$alt= $request->input('child_category');
        	$file->move($destinationPath,$filename);
        	 
       	
            $image['pc_icon'] = array(
            'name'=>$filename,
            'alt'=>$filename,						
            'src'=>$filePath."/".$filename
            );	
        	
        	$child_category->pc_icon = serialize($image);
        }
        
    
        		
        if ($request->hasFile('child_banner')) {
        	$image = [];
        	$filePath = getFolderCourseStructure();
        
        	$file =  $request->file('child_banner');
        	$bannerfilename = $file->getClientOriginalName();
        	$destinationPath = public_path($filePath);
        	$nameArr = explode('.',$bannerfilename);
        	$ext = array_pop($nameArr);
        	$name = implode('_',$nameArr);
        	if(file_exists($destinationPath.'/'.$bannerfilename)){
        		$bannerfilename = $name."_".time().'.'.$ext;
        	}
        	$alt= $request->input('child_category');
        	$file->move($destinationPath,$bannerfilename);
        	 
       	
            $image['child_banner'] = array(
            'name'=>$bannerfilename,
            'alt'=>$bannerfilename,						
            'src'=>$filePath."/".$bannerfilename
            );	
        	
        	$child_category->child_banner = serialize($image);
        }
        
				
 
		$child_category->save();
		$this->success_msg .= 'Child Category added succesfully!';
		$request->session()->flash('success_msg', $this->success_msg);
		return redirect("developer/child_category");
    }
 
    public function editChildCategory(Request $request, $id)
    {
        
       $edit_data =  ChildCategory::findOrFail($id);
     
		if(!$request->user()->current_user_can('administrator')){
			return view('errors.unauthorised');
		}
		$child_categories = DB::table('child_category')
					->join('parent_category', 'child_category.parent_category_id', '=', 'parent_category.id')
					->select('child_category.*', 'parent_category.parent_category')
					->get();		
		$parent_categories = ParentCategory::all();
		return view('admin/editChildCategory',['child_categories'=>$child_categories,'parent_categories'=>$parent_categories,'edit_data'=>$edit_data]);
    }


  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeChildCategory(Request $request)
    {
    
		if(!$request->user()->current_user_can('administrator')){
			return view('errors.unauthorised');
		}
		 

			$validator = Validator::make($request->all(), [
				'child_category' => 'required|max:255|unique:child_category,child_category,'.$request->input('id')
			]);
			 
		
        if($request->hasFile('pc_icon')){
        $validator = Validator::make($request->all(),[					 
        'pc_icon' => 'required|mimes:jpeg,png,jpg,svg,webp|dimensions:min_width=20,min_height=20,max_width=200,max_height=200',		 			
        ]);
        } 

			if ($validator->fails()) {
				return redirect("developer/editChildCategory/".$request->input('id'))
							->withErrors($validator)
							->withInput();
			}		
			
		 
				$child_category = ChildCategory::find($request->input('id'));
				$child_category->child_category = $request->input('child_category');
				$child_category->child_slug = generate_slug($request->input('child_category'));
				$child_category->parent_category_id = $request->input('parent_category_id');
				
				if ($request->hasFile('pc_icon')) {
					$image = [];
					$filePath = getFolderCourseStructure();
					$file =  $request->file('pc_icon');
					$filename = $file->getClientOriginalName();
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename);
				 	
                    $image['pc_icon'] = array(
                    'name'=>$filename,
                    'alt'=>$filename,						
                    'src'=>$filePath."/".$filename
                    );	
					 
					$child_category->pc_icon = serialize($image);
				}else{
				    
				    $child_category->pc_icon = $child_category->pc_icon;	
				}

				
					if ($request->hasFile('child_banner')) {
					$image = [];
					$filePath = getFolderCourseStructure();
					$file =  $request->file('child_banner');
					$bannefilename = $file->getClientOriginalName();
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$bannefilename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$bannefilename)){
						$bannefilename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$bannefilename);
				 	
                    $image['child_banner'] = array(
                    'name'=>$bannefilename,
                    'alt'=>$bannefilename,						
                    'src'=>$filePath."/".$bannefilename
                    );	
					 
					$child_category->child_banner = serialize($image);
				}else{
				    
				    $child_category->child_banner = $child_category->child_banner;	
				}

			 
				$child_category->save();
				$this->success_msg .= 'Child Category updated succesfully!';
				$request->session()->flash('success_msg', $this->success_msg);
				return redirect("developer/child_category");
			
				
    }



    public function imageDeleted(Request $request,$id)
	{
		 $delet_data = ChildCategory::find($id);	
 
		if($delet_data->pc_icon!='')
		{
			$image = unserialize($delet_data->pc_icon);
			$thumbnail = ''.$image['pc_icon']['src'];
			if (file_exists($thumbnail))
			{
			unlink($thumbnail);
			}  
		}
 
		$edit_data = array('pc_icon'  =>"",);	 
		$del = ChildCategory::where('id',$id)->update($edit_data);		 		
		return redirect('developer/editChildCategory/'.$id)->with("success","Icon image deleted successfully."); 
	}
	
    public function bannerDeleted(Request $request,$id)
	{
		 $delet_data = ChildCategory::find($id);	
 
		if($delet_data->child_banner!='')
		{
			$image = unserialize($delet_data->child_banner);
			$thumbnail = ''.$image['child_banner']['src'];
			if (file_exists($thumbnail))
			{
			unlink($thumbnail);
			}  
		}
 
		$edit_data = array('child_banner'  =>"",);	 
		$del = ChildCategory::where('id',$id)->update($edit_data);		 		
		return redirect('developer/editChildCategory/'.$id)->with("success","Icon image deleted successfully."); 
	}
	
	
	
	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
		if($request->ajax()){
			if(!$request->user()->current_user_can('administrator')){
				return response()->json(['status'=>0,'msg'=>'Unauthorised access'],200);
			}
			$child_category = ChildCategory::find($id);
			$request->session()->put('childCategoryToUpdate', $child_category->id);
			 
			return response()->json(['status'=>1,'child'=>$child_category]);
		}		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
		if(!$request->user()->current_user_can('administrator')){
			return view('errors.unauthorised');
		}
		if($request->session()->has('childCategoryToUpdate')){

			$validator = Validator::make($request->all(), [
				'child_category' => 'required|max:255|unique:child_category,child_category,'.$request->input('id')
			]);
		 

			if ($validator->fails()) {
				return redirect("developer/child_category")
							->withErrors($validator)
							->withInput();
			}		
			
			$childCategoryToUpdate = $request->session()->get('childCategoryToUpdate');
			if($childCategoryToUpdate == $request->input('id')){
				$child_category = ChildCategory::find($childCategoryToUpdate);
				$child_category->child_category = $request->input('child_category');
				$child_category->child_slug = generate_slug($request->input('child_category'));
				$child_category->parent_category_id = $request->input('parent_category_id');
				$child_category->save();
				$this->success_msg .= 'Child Category updated succesfully!';
				$request->session()->flash('success_msg', $this->success_msg);
				return redirect("developer/child_category");
			}
		}		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
		if($request->ajax()){
			if(!$request->user()->current_user_can('administrator')){
				return response()->json(['status'=>0,'msg'=>'Unauthorised access'],200);
			}
			ChildCategory::destroy($id);
			return response()->json(['status'=>1,'msg'=>'Child Category deleted succesfully!!']);
		} 		
    }

	 /**
     * Remove the specified resource from storage status.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(request $request, $id,$val)
    {
		if($request->ajax()){	
		 
		$parentCategory = ChildCategory::findOrFail($id);	 
		$parentCategory->status=$val;
 
		if ($parentCategory->save()) {
			$status=1;
			$msg="status updated successfully !";
			}else{
			$status=0;
			$msg="status could not be successfully, Please try again !";	
			}		
			return response()->json(['status'=>$status,'msg'=>$msg],200); 
		}
    }
}
