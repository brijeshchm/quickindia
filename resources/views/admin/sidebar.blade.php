            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu"> 
		 
						@if(Auth::user()->current_user_can('client_dashboard'))
						<li>
                            <a href="{{url('/developer/dashboard')}}"><i class="fa fa-podcast fa-fw"></i>Client Dashboard</a>
                        </li>
					 	@endif	
						
						@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('lead_dashboard') )
						
						
						<li>
                            <a href="#"><i class="fa fa-home fa-fw"></i>Leads Dashboard<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li>
								<a href="{{url('/developer/lead-dashboard')}}"><i class="fa fa-home fa-fw"></i>Leads Dashboard</a>
								</li>
						 
								<li>
								<a href="{{url('/developer/lead-conversion')}}"><i class="fa fa-dashboard fa-fw"></i>Leads Conversion</a>
								</li>
							 
						 
                            </ul>
                            
                        </li>		
						
						
					 	@endif	
						
					 @if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('all_lead'))
							<li>
								<a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Leads<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="{{url('/developer/new-lead')}}"><i class="fa fa-leanpub fa-fw"></i> Assign Leads</a>
									</li>	
									@if(Auth::user()->current_user_can('administrator'))									
									<!--<li>
										<a href="/developer/lead"><i class="fa fa-leanpub fa-fw"></i> All Leads</a>
									</li>-->
									@endif
										@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('add_lead'))		
								<li>
										<a href="{{url('/developer/lead/add-lead')}}"><i class="fa fa-user fa-fw"></i> Add Lead</a>
									</li>
									@endif
									@if(Auth::user()->current_user_can('administrator'))		
										<li>
										<a href="{{url('/developer/push-lead')}}"><i class="fa fa-leanpub fa-fw"></i> Push Leads</a>
									</li>
								@endif
								
								@if(Auth::user()->current_user_can('administrator'))		
										<li>
										<a href="{{url('/developer/new-lead/not-interested')}}"><i class="fa fa-leanpub fa-fw"></i> Not Interested</a>
									</li>
								@endif
								</ul>
							</li>
							@endif
						@if(Auth::user()->current_user_can('administrator'))							
						 <li>
                            <a href="#"><i class="fa fa-plus-square fa-fw"></i>Roles &amp; Capabilities<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('/developer/permission')}}"><i class="fa fa-users fa-fw"></i> Permissions</a>
                                </li>
						 
                                <li>
                                    <a href="{{url('/developer/role-permission')}}"><i class="fa fa-user-plus fa-fw"></i> Role Permissions</a>
                                </li>
							 
						 
                            </ul>
                            
                        </li>
						@endif
                        @if(Auth::user()->current_user_can('administrator') )
						<li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Users<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('/developer/list-users')}}"><i class="fa fa-users fa-fw"></i> All Users</a>
                                </li>
							     @if(Auth::user()->current_user_can('administrator'))
                                <li>
                                    <a href="{{url('/developer/register')}}"><i class="fa fa-user-plus fa-fw"></i> Create User</a>
                                </li>
								@endif
                            </ul>
                            
                        </li>	
						
						@endif
						
					  @if(Auth::user()->current_user_can('administrator')|| Auth::user()->current_user_can('all_city') )
                        <li>
                            <a href="{{url('/developer/cities')}}"><i class="fa fa-balance-scale fa-fw"></i> Client Cities</a>
                        </li>	 
						@endif
					 @if(Auth::user()->current_user_can('administrator') ||  Auth::user()->current_user_can('all_keyword'))
						
						<li>
								<a href="#"><i class="fa fa-bars fa-fw"></i>Categories<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
								@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('parent_category') )	
								<li>
								<a href="{{url('/developer/parent_category')}}"><i class="fa fa-barcode fa-fw"></i> Parent Category</a>
								</li>
								@endif
								@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('child_category') )	
								<li>
								<a href="{{url('/developer/child_category')}}"><i class="fa fa-bank fa-fw"></i> Child Category</a>
								</li>
								@endif
								@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('all_keyword'))	
								<li>
								<a href="{{url('/developer/keyword')}}"><i class="fa fa-bookmark fa-fw"></i> Business Keywords</a>
								</li>
								@endif
								@if(Auth::user()->current_user_can('administrator'))	
								<li>
								<a href="{{url('/developer/keyword_sell_count')}}"><i class="fa fa-gg-circle fa-fw"></i> Keyword Category Count</a>
								</li> 
								@endif
								</ul>
							</li>
                    
					@endif
						 						
						@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('all_client'))
                        <li>
                            <a href="#"><i class="fa fa-handshake-o fa-fw"></i> Clients<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            @if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('all_client'))
							   <li>
                                    <a href="{{url('/developer/clients/list')}}"><i class="fa fa-handshake-o fa-fw"></i> All Clients</a>
                                </li>
                                <li>
                                    <a href="{{url('/developer/clients/register')}}"><i class="fa fa-user-plus fa-fw"></i> Create Client</a>
                                </li>
                                
                                <li>
                                    <a href="{{url('/developer/clients/meetings')}}"><i class="fa fa-comments fa-fw"></i>Follow Up Client</a>
                                </li>
								 <li>
                                    <a href="{{url('/developer/clients/search')}}"><i class="fa fa-user-plus fa-fw"></i> Search Client</a>
                                </li>
								  @if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('order_history')) 
								<li>
                                    <a href="{{url('/developer/order-history')}}"><i class="fa fa-user-plus fa-fw"></i> Order History</a>
                                </li> 
								@endif	
						
						@endif
						   @if(Auth::user()->current_user_can('administrator')) 						
                                <li>
                                    <a href="{{url('/developer/clients/categories')}}"><i class="fa fa-user-plus fa-fw"></i> Categories</a>
                                </li> 
                                <li>
                                    <a href="{{url('/developer/transactions')}}"><i class="fa fa-user-plus fa-fw"></i> Transactions</a>
                                </li>  									
							@endif
							
							@if(Auth::user()->current_user_can('administrator'))
                                <li>
                                    <a href="{{url('/developer/clients/list/deleted-clients')}}"><i class="fa fa-trash fa-fw"></i> Deleted Clients</a>
                                </li>
							@endif
                            </ul>
                             
                        </li>	
							@endif
							@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('lead_bulk_upload'))
							<li>
								<a href="#"><i class="fa fa-upload fa-fw"></i>Bulk Upload<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="{{url('/developer/bulkupload/lead')}}"><i class="fa fa-upload fa-fw"></i> Lead Bulk Upload</a>
									</li>
								 	<!-- @if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('keyword_bulk_upload'))
									<li>
										<a href="{{url('/developer/bulkupload/keyword')}}"><i class="fa fa-upload fa-fw"></i> Keyword Bulk Upload</a>
									</li>
								@endif -->
								</ul>
							</li>							
							@endif
							
							@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('lead_transfer') )
								<li><a href="{{url('/developer/permanent-transfer')}}"><i class="fa fa-arrow-right"></i>Transfer</a></li>
							@endif
							
							@if(Auth::user()->current_user_can('administrator'))
							<li>
								<a href="#"><i class="fa fa-inr fa-fw"></i>Bank<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="{{url('/developer/mode/modedetails')}}"><i class="fa fa-money fa-fw"></i> Mode Details</a>
									</li>
								 
									<li>
										<a href="{{url('/developer/banks/banksdetails')}}"><i class="fa fa-leanpub fa-fw"></i> Bank Details</a>
									</li>
								
								</ul>
							</li>
						 
							
							@endif
							@if(Auth::user()->current_user_can('administrator'))
							<li>
								<a href="#"><i class="fa fa-cap fa-fw"></i>Occupation<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="{{url('/developer/occupation')}}"><i class="fa fa-money fa-fw"></i> Occupation</a>
									</li>					 
								
								</ul>
							</li>
						 
							
							@endif


						@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('all_zone'))						
							
							<li>
								<a href="#"><i class="fa fa-map-marker fa-fw"></i>Client Area<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
								<li>
								<a href="{{url('/developer/zone')}}"><i class="fa fa-user-plus fa-fw"></i> Zone</a>
								</li>
								<li>
								<a href="{{url('/developer/area')}}"><i class="fa fa-user-plus fa-fw"></i> Area</a>
								</li>

							
								
								</ul>
							</li>
													
						@endif
						
						
							@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('all_SEO'))						
							
							<li>
								<a href="#"><i class="fa fa fa-bullhorn fa-fw"></i>SEO<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
							<li>
								<a href="{{url('/developer/seo')}}"><i class="fa fa-key"></i>Keyword SEO</a>
							</li>
								<li>
								<a href="{{url('/developer/category/seo')}}"><i class="fa fa-list-alt"></i> Category SEO</a>
								</li>

	                           <li>
								<a href="{{url('/developer/childcategory/seo')}}"><i class="fa fa-list-alt"></i> Child Category SEO</a>
								</li>
							
								
								</ul>
							</li>
													
						@endif
						@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('all_SEO') )
						  
							@if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('cms_manager') )
							
							<li>
								<a href="#"><i class="fa fa-gear fa-fw"></i>CMS Manage<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
								<li>
									<a href="{{url('/developer/blog/blogdetails')}}"><i class="fa fa-user-plus fa-fw"></i> Blog</a>
								</li>

							<li>
								<a href="{{url('/developer/testimonials/testimonialsdetails')}}"><i class="fa fa-user-plus fa-fw"></i>Testimonials</a>
							</li>
								
								</ul>
							</li>
							@endif
													
						@endif
						
						
						
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->