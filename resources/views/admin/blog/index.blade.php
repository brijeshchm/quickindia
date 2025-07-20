<?php echo View::make('admin/header'); ?>

       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><a href="{{url('developer/blog/blogdetails')}}">Blog Details</a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					@if(Session::has('success'))
						<div class="alert alert-success">
							{{Session::get('success')}}
						</div>
					@endif
					@if(Session::has('failed'))
						<div class="alert alert-danger">
							{{Session::get('failed')}}
						</div>
					@endif					
                    <div class="panel panel-info">
                        <div class="panel-body">
						
							<div class=" row">
							 
									 
									<div class="col-md-12 text-right">
										<h4><u><a href="{{url('developer/blog/add')}}">Add Blog</a></u></h4>
									</div>
									 
									 
								 
								 
							</div>
						
						@if(Request::segment(3)=='edit' || Request::segment(3)=='add'	)				
						<div class=" row form-group{{ $errors->has('mode') ? ' has-error' : '' }}">
								<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="form-group">
									<label for="name" class="col-md-2 control-label">Name</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="name" placeholder="Enter Bog Name" value="{{ old('name',(isset($edit_data)) ? $edit_data->name:"")}}">
										@if ($errors->has('name'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('name') }}</strong>
											</span>
										@endif
									</div>
								</div>
								
								<div class="form-group">
									<label for="description" class="col-md-2 control-label">Description</label>
									<div class="col-md-9">
										<textarea class="form-control tinymce-selector" name="description" placeholder="Enter Description">{{ old('description',(isset($edit_data)) ? $edit_data->description:"")}}</textarea>
										@if ($errors->has('description'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('description') }}</strong>
											</span>
										@endif
									</div>
								</div>
								
								<div class="form-group">
									<label for="image" class="col-md-2 control-label">Image<span>*</span></label>
									<div class="col-md-6">
										<input type="file" class="form-control" name="image">
										<span class="blog-block">
										@if(!empty($edit_data))
										<?php 
									 
										$image = unserialize($edit_data->image);
															$image = $image['thumbnail']['src'];

										?>
										@if(isset($image)&&!empty($image))
										<img src="{{url($image)}}" style="height:75px;width:75px;">
										<a href="{{url('developer/blog/del_icon/'.$edit_data->id)}}" title="remove"><i class="fa fa-times fa-fw" aria-hidden="true"></i></a>
										<input type="hidden" class="" name="image" value="{{ $edit_data->image }}" >
										@endif
										@endif
										@if ($errors->has('image'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('image') }}</strong>
											</span>
										@endif
										</span>
									</div>
								</div>
								
								<div class="form-group">
									<label for="meta_title" class="col-md-2 control-label">Meta Title</label>
									<div class="col-md-6">
										<textarea class="form-control" name="meta_title" placeholder="Enter Meta Title">{{ old('meta_title',(isset($edit_data)) ? $edit_data->meta_title:"")}}</textarea>
										@if ($errors->has('meta_title'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('meta_title') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group">
									<label for="meta_keywords" class="col-md-2 control-label">Meta Keywords</label>
									<div class="col-md-6">
										<textarea class="form-control" name="meta_keywords" placeholder="Enter Meta Keywords">{{ old('meta_title',(isset($edit_data)) ? $edit_data->meta_keywords:"")}}</textarea>
										@if ($errors->has('meta_keywords'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('meta_keywords') }}</strong>
											</span>
										@endif
									</div>
								</div>
								
								<div class="form-group">
									<label for="meta_description" class="col-md-2 control-label">Meta Description</label>
									<div class="col-md-6">
										<textarea class="form-control" name="meta_description" placeholder="Enter Meta Description">{{ old('meta_description',(isset($edit_data)) ? $edit_data->meta_description:"")}}</textarea>
										@if ($errors->has('meta_description'))
											<span class="error alert-danger">
												<strong>{{ $errors->first('meta_description') }}</strong>
											</span>
										@endif
									</div>
								</div>
								 

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-primary" name="submit" value="{{$button}}">
											 Submit
										</button>
									</div>
								</div>
									 
								</form>
							</div>
							@else
									
								
							<!--<div class="nc-form row form-group{{ $errors->has('mode') ? ' has-error' : '' }}">
								<form method="POST" action="/developer/mode/add">
									{{ csrf_field() }}
									<div class="col-md-12">
										<h4><u>Add Mode:</u></h4>
									</div>
									 
									 
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 match_ht">
										<label for="mode">Add New Mode:</label>
										<input type="text" class="form-control" name="mode" placeholder="Enter Mode" value="{{ old('mode') }}">
										@if ($errors->has('mode'))
											<span class="help-block">
												<strong>{{ $errors->first('mode') }}</strong>
											</span>
										@endif
									</div>								 
									 
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<label for="" style="visibility:hidden">Submit:</label>
										<input type="submit" class="btn btn-info btn-block form-control" name="submit" value="Save">
									</div>
								</form>
							</div>-->
                            <table width="100%" class="table table-striped table-bordered table-hover" id="datatable-blogdetails">
                                <thead>
                                    <tr>
                                        <th>Name</th>
										<th>Title</th>                                        
										<th>Image</th>                                        
										<th>Status</th>                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
								<tfoot>
                                    <tr>
										<th>Name</th>
										<th>Title</th>                                        
										<th>Image</th>                                       
										<th>Status</th>                                       
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        
							
							@endif
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

			<!-- Modal -->
			<div id="updateKeywordModal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">

				<!-- Modal content-->
				<div class="modal-content">
					<form method="POST" action="/developer/keyword/update">
						<div class="form-group">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Update Keyword</h4>
							</div>
							<div class="modal-body">
								{{ csrf_field() }}
								<input type="hidden" name="id">
 
								
								<div class="col-md-3">
									 
								</div>
								
								<div class="col-md-3">
									<label>Select Child Category:</label>
									<select name="child_category_id" id="update_child_category_id" class="form-control select2-single" style="width:100%">
									</select>
								</div>
								
								<div class="col-md-3">
									<label>Enter Keyword:</label>
									<input type="text" class="form-control" id="update_keyword" name="keyword" placeholder="Enter Child Category">
								</div>
								
								<div class="col-md-3">
									<label>Select Category:</label>
									<select name="category" id="update_category" class="form-control select2-single category" style="width:100%">
										<option value="Category 1">Category 1</option>
										<option value="Category 2">Category 2</option>
										<option value="Category 3">Category 3</option>
										<option value="Category X">Category X</option>
									</select>
								</div>
								
								<div class="col-md-3 premium_price">
									<label>Premium Price:</label>
									<input type="number" class="form-control" id="update_premium_price" name="premium_price">
								</div>
								
								<div class="col-md-3 platinum_price">
									<label>Platinum Price:</label>
									<input type="number" class="form-control" id="update_platinum_price" name="platinum_price">
								</div>
								
								<div class="col-md-3 royal_price">
									<label>Royal Price:</label>
									<input type="number" class="form-control" id="update_royal_price" name="royal_price">
								</div>
								
								<div class="col-md-3 king_price">
									<label>King Price:</label>
									<input type="number" class="form-control" id="update_king_price" name="king_price">
								</div>
								
								<div class="col-md-3 preferred_price">
									<label>Preferred Price:</label>
									<input type="number" class="form-control" id="update_preferred_price" name="preferred_price">
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-info">Update</button>
							</div>
						</div>
					</form>
				</div>

				</div>
			</div>
			<!-- Modal -->
			<!-- deleteKeywordModal -->
			<div id="deleteClient" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
					</div>
				</div>
			</div>
			<!-- deleteKeywordModal -->
        </div>
        <!-- /#page-wrapper -->

<?php echo View::make('admin/footer'); ?>