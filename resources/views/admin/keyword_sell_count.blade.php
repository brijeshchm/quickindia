<?php echo View::make('admin/header'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Keyword Sell Count</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					@if(Session::has('success_msg'))
						<div class="alert alert-success">
							{{Session::get('success_msg')}}
						</div>
					@endif
					@if(Session::has('danger'))
						<div class="alert alert-danger">
							{{Session::get('danger')}}
						</div>
					@endif					
                    <div class="panel panel-info">
                        <div class="panel-body">
							<div class="nc-form row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<form method="POST" action="/developer/keyword_sell_count">
									{{ csrf_field() }}
									<div class="col-lg-3">
										<label for="name">Add New Keyword Package:</label>
										<input type="text" class="form-control" name="name" id="name" placeholder="Enter Key Category Name" value="{{ old('name') }}">
										@if ($errors->has('name'))
											<span class="help-block">
												<strong>{{ $errors->first('name') }}</strong>
											</span>
										@endif
									</div>
									<div class="col-lg-3">
										<label for="count">Keyword Max Count:</label>
										<input type="number" class="form-control" name="count" id="count" placeholder="Enter Key Category Count" value="{{ old('count') }}">
										@if ($errors->has('count'))
											<span class="help-block">
												<strong>{{ $errors->first('count') }}</strong>
											</span>
										@endif
									</div>
									<div class="col-lg-3">
										<label for="cat1_price">Category 1 Coin : 80,100)</label>
										<input type="number" class="form-control" name="cat1_price" id="cat1_price" value="{{ old('cat1_price') }}" placeholder="Category 1 Coin">
										@if ($errors->has('cat1_price'))
											<span class="help-block">
												<strong>{{ $errors->first('cat1_price') }}</strong>
											</span>
										@endif
									</div>
									<div class="col-lg-3">
										<label for="cat2_price">Category 2 Coin:(60,90)</label>
										<input type="number" class="form-control" name="cat2_price" id="cat2_price" value="{{ old('cat2_price') }}" placeholder="Category 2 Coin">
										@if ($errors->has('cat2_price'))
											<span class="help-block">
												<strong>{{ $errors->first('cat2_price') }}</strong>
											</span>
										@endif
									</div>
									<div class="col-lg-3">
										<label for="cat3_price">Category 3 Coin :(60,100)</label>
										<input type="number" class="form-control" name="cat3_price" id="cat3_price" value="{{ old('cat3_price') }}" placeholder="Category 3 Coin">
										@if ($errors->has('cat3_price'))
											<span class="help-block">
												<strong>{{ $errors->first('cat3_price') }}</strong>
											</span>
										@endif
									 
									</div>
									<div class="col-lg-3">
										<label for="cat3_price">Category 4 Coin :(100,150)</label>
										<input type="number" class="form-control" name="cat4_price" id="cat4_price" value="{{ old('cat4_price') }}" placeholder="Category 4 Coin">
										@if ($errors->has('cat4_price'))
											<span class="help-block">
												<strong>{{ $errors->first('cat4_price') }}</strong>
											</span>
										@endif
									 
									</div>
									
									<div class="col-lg-3">
										<label for="cat5_price">Category 5 Coin :(120,200)</label>
										<input type="number" class="form-control" name="cat5_price" id="cat5_price" value="{{ old('cat5_price') }}" placeholder="Category 5 Coin">
										@if ($errors->has('cat5_price'))
											<span class="help-block">
												<strong>{{ $errors->first('cat5_price') }}</strong>
											</span>
										@endif
									
									</div>
									
										<div class="col-lg-3" style="margin-top:10px;">
										 
										<input type="submit" class="btn btn-info btn-block" class="form-control" style="margin-top:10px;">
									</div>
									
								</form>
							</div>
							<?php if(isset($keywordSellCounts) && count($keywordSellCounts)>0): ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
									 
                                        <th>Name</th>
                                        <th>Keyword Count</th>
                                        <th>Category 1 Coin</th>
                                        <th>Category 2 Coin</th>
                                        <th>Category 3 Coin</th>
                                         <th>Category 4 Coin</th>
                                        <th>Category 5 Coin</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
									<?php foreach($keywordSellCounts as $keywordSellCount): ?>
                                    <tr>
                                        
                                        <td>{{ $keywordSellCount->name }}</td>
                                        <td>{{ $keywordSellCount->count }}</td>
                                        <td>{{ $keywordSellCount->cat1_price }}</td>
                                        <td>{{ $keywordSellCount->cat2_price }}</td>
                                        <td>{{ $keywordSellCount->cat3_price }}</td>
                                          <td>{{ $keywordSellCount->cat4_price }}</td>
                                        <td>{{ $keywordSellCount->cat5_price }}</td>
                                        <td><a href="javascript:void(0)" onclick="javascript:updateKeywordSellCount({{$keywordSellCount->id}},this)"><i class="fa fa-refresh fa-fw" aria-hidden="true"></i></a> || <a href="javascript:void(0)" onclick="javascript:deleteKeywordSellCount({{$keywordSellCount->id}},this)"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></a></td>
                                    </tr>
									<?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
							<?php else: ?>
							<div class="alert alert-danger">
								Not Found !!
							</div>
							<?php endif; ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

			<!-- Modal -->
			<div id="updateKeywordSellCountModal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-sm">

				<!-- Modal content-->
				<div class="modal-content">
					<form method="POST" action="/developer/keyword_sell_count/update">
					<div class="form-group">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							{{ csrf_field() }}
							<input type="hidden" name="id">
							
							<label style="margin-top:34px;">Keyword Category:</label>
							<input type="text" class="form-control" name="name">
							<label style="margin-top:34px;">Keyword Category Count:</label>
							<input type="number" class="form-control" name="count">
							<label style="margin-top:34px;">Keyword Category 1 Price:</label>
							<input type="number" class="form-control" name="cat1_price" placeholder="0">
							<label style="margin-top:34px;">Keyword Category 2 Price:</label>
							<input type="number" class="form-control" name="cat2_price" placeholder="Keyword Category 2 Price">
							<label style="margin-top:34px;">Keyword Category 3 Price:</label>
							<input type="number" class="form-control" name="cat3_price" placeholder="Keyword Category 3 Price">
							<label style="margin-top:34px;">Keyword Category 4 Price:</label>
							<input type="number" class="form-control" name="cat4_price" placeholder="Keyword Category 4 Price">
							
							<label style="margin-top:34px;">Keyword Category 5 Price:</label>
							<input type="number" class="form-control" name="cat5_price" placeholder="Keyword Category 5 Price">
							
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
        </div>
        <!-- /#page-wrapper -->

<?php echo View::make('admin/footer'); ?>
