<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;

use App\Models\ParentCategory; //Model

class ParentCategoryController extends Controller
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
		$parent_categories = ParentCategory::orderBy('id','desc')->get();
		return view('admin/parent_category',['parent_categories'=>$parent_categories]);		
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
            'parent_category' => 'required|max:255|unique:parent_category'
        ]);

        if ($validator->fails()) {
            return redirect("developer/parent_category")
                        ->withErrors($validator)
                        ->withInput();
        }
		
		
		
		$parent_category = new ParentCategory;
		$parent_category->parent_category = $request->input('parent_category');
		$parent_category->parent_slug = generate_slug($request->input('parent_category'));
			$alt = $request->input('parent_category'); 
		 	if ($request->hasFile('category_icon')) {
					$image = [];
					$filePath = getFolderCategoryStructure();
					$file =  $request->file('category_icon');
					$filename = $file->getClientOriginalName();
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename);
				 	
                    $image['category_icon'] = array(
                    'name'=>$filename,
                    'alt'=>$alt,						
                    'src'=>$filePath."/".$filename
                    );	
					 
					$parent_category->category_icon = serialize($image);
				} 
				
					if ($request->hasFile('category_banner')) {
					$image = [];
					$filePath = getFolderCategoryStructure();
					$file =  $request->file('category_banner');
					$filename = $file->getClientOriginalName();
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename);
				 	
                    $image['category_banner'] = array(
                    'name'=>$filename,
                    'alt'=>$alt,						
                    'src'=>$filePath."/".$filename
                    );	
					 
					$parent_category->category_banner = serialize($image);
				}
		 
		 
		if($parent_category->save()){
			$this->success_msg .= 'Parent Category added succesfully!';
			$request->session()->flash('success_msg', $this->success_msg);
		}else{
			$this->danger_msg .= 'Parent Category not added!';
			$request->session()->flash('danger_msg', $this->danger_msg);
		}
		return redirect("developer/parent_category");		
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
			$parent_category = ParentCategory::find($id);
			$request->session()->put('parentCategoryToUpdate', $parent_category->id);
			return response()->json(['status'=>1,'msg'=>'<input type="hidden" name="_token" value="'.csrf_token().'"><input type="hidden" value="'.$parent_category->id.'" name="id"><div class="form-group"><label>Enter the name:</label><input type="text" name="parent_category" class="form-control" value="'.$parent_category->parent_category.'"></div><div class="form-group"><label>Enter the ICON:</label><input type="text" name="pc_icon" class="form-control" value="'.$parent_category->pc_icon.'" placeholder="fa fa-fw fa-icon_name"></div>']);
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
        //
		if(!$request->user()->current_user_can('administrator')){
			return view('errors.unauthorised');
		}
		if($request->session()->has('parentCategoryToUpdate')){

			$validator = Validator::make($request->all(), [
				'parent_category' => 'required|max:255|unique:parent_category,parent_category,'.$request->input('id')
			]);

			if ($validator->fails()) {
				return redirect("developer/parent_category")
							->withErrors($validator)
							->withInput();
			}		
			
			$parentCategoryToUpdate = $request->session()->get('parentCategoryToUpdate');
			if($parentCategoryToUpdate == $request->input('id')){
				$parent_category = ParentCategory::find($parentCategoryToUpdate);
				$parent_category->parent_category = $request->input('parent_category');
				$parent_category->parent_slug = generate_slug($request->input('parent_category'));
				$parent_category->pc_icon = $request->input('pc_icon');
				$parent_category->save();
				$this->success_msg .= 'Parent Category updated succesfully!';
				$request->session()->flash('success_msg', $this->success_msg);
				return redirect("developer/parent_category");
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
			ParentCategory::destroy($id);
			return response()->json(['status'=>1,'msg'=>'Parent Category deleted succesfully!!']);
		} 		
    }
    
    
    public function editCategory(Request $request, $id)
    {
        
       $edit_data =  ParentCategory::findOrFail($id);
		//echo "<pre>";print_r($edit_data);die;
		return view('admin/category/editCategory',['edit_data'=>$edit_data]);
    }


  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editStoreCategory(Request $request)
    {
    
		if(!$request->user()->current_user_can('administrator')){
			return view('errors.unauthorised');
		}
		 

			$validator = Validator::make($request->all(), [
				'parent_category' => 'required|max:255|unique:parent_category,parent_category,'.$request->input('id')
			]);
			//dd($validator->getMessageBag());

			if ($validator->fails()) {
				return redirect("developer/editCategory/".$request->input('id'))
							->withErrors($validator)
							->withInput();
			}		
			
		 
				$category = ParentCategory::find($request->input('id'));
				$category->parent_category = $request->input('parent_category');
				$category->parent_slug = generate_slug($request->input('parent_category'));
			 
					$alt = $request->input('parent_category'); 
				if ($request->hasFile('category_icon')) {
					$image = [];
					$filePath = getFolderCourseStructure();
					$file =  $request->file('category_icon');
					$filename = $file->getClientOriginalName();
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename);
				 	
                    $image['category_icon'] = array(
                    'name'=>$filename,
                    'alt'=>$alt,						
                    'src'=>$filePath."/".$filename
                    );	
					 
					$category->category_icon = serialize($image);
				}else{
				    
				    $category->category_icon = $category->category_icon;	
				}
	            if ($request->hasFile('category_banner')) {
					$image = [];
					$filePath = getFolderCourseStructure();
					$file =  $request->file('category_banner');
					$filename = $file->getClientOriginalName();
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename);
				 	
                    $image['category_banner'] = array(
                    'name'=>$filename,
                    'alt'=>$alt,						
                    'src'=>$filePath."/".$filename
                    );	
					 
					$category->category_banner = serialize($image);
				}else{
				    
				    $category->category_banner = $category->category_banner;	
				}
				
			 
				$category->save();
				$this->success_msg .= 'Category updated succesfully!';
				$request->session()->flash('success_msg', $this->success_msg);
				return redirect("developer/parent_category");
			
				
    }

    
    
    public function imageDeleted(Request $request,$id)
	{
		 $delet_data = ParentCategory::find($id);	
 
		if($delet_data->category_icon!='')
		{		
			$image = unserialize($delet_data->category_icon);
			$thumbnail = ''.$image['category_icon']['src'];
			if (file_exists($thumbnail))
			{
			unlink($thumbnail);
			}  
		}
 
		$edit_data = array('category_icon'  =>"",);	 
		$del = ParentCategory::where('id',$id)->update($edit_data);		 		
		return redirect('developer/editCategory/'.$id)->with("success","Icon image deleted successfully."); 
	}
	
	
    public function imageBannerDeleted(Request $request,$id)
	{
		 $delet_data = ParentCategory::find($id);	
 
		if($delet_data->category_banner!='')
		{		
			$image = unserialize($delet_data->category_banner);
			$thumbnail = ''.$image['category_banner']['src'];
			if (file_exists($thumbnail))
			{
			unlink($thumbnail);
			}  
		}
 
		$edit_data = array('category_banner'  =>"",);	 
		$del = ParentCategory::where('id',$id)->update($edit_data);		 		
		return redirect('developer/editCategory/'.$id)->with("success","Icon image deleted successfully."); 
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
		 
		$parentCategory = ParentCategory::findOrFail($id);	 
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
