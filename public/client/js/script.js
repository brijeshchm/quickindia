/*if('undefined' === typeof window.jQuery){
	throw new Error('This code requires jQuery');
}*/
$.ajaxSetup({	headers: {	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')	}	});

// **************
// SPINNER OBJECT
// 	var mainSpinner = (function(){
// 		var opts = {
// 		lines: 13 // The number of lines to draw
// 		, length: 28 // The length of each line
// 		, width: 14 // The line thickness
// 		, radius: 42 // The radius of the inner circle
// 		, scale: 1 // Scales overall size of the spinner
// 		, corners: 1 // Corner roundness (0..1)
// 		, color: '#000' // #rgb or #rrggbb or array of colors
// 		, opacity: 0.25 // Opacity of the lines
// 		, rotate: 0 // The rotation offset
// 		, direction: 1 // 1: clockwise, -1: counterclockwise
// 		, speed: 1 // Rounds per second
// 		, trail: 60 // Afterglow percentage
// 		, fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
// 		, zIndex: 2e9 // The z-index (defaults to 2000000000)
// 		, className: 'spinner' // The CSS class to assign to the spinner
// 		, top: '50%' // Top position relative to parent
// 		, left: '50%' // Left position relative to parent
// 		, shadow: false // Whether to render a shadow
// 		, hwaccel: false // Whether to use hardware acceleration
// 		, position: 'absolute' // Element positioning
// 		};
// 		var spinnerBkgd = document.getElementById('spinnerBkgd');
// 		var target = document.getElementById('spinnerCntr');
// 		var spinner = new Spinner(opts);
// 		return {
// 			start:function(){
// 				spinner.spin(target);
// 				spinnerBkgd.style.display = 'block';
// 			},
// 			stop:function(){
// 				spinner.stop();
// 				spinnerBkgd.style.display = 'none';
// 			}
// 		}
// 	})();
	
	
// SPINNER OBJECT
// **************

// ***********
// DATA TABLES
	var dataTableViewAllLeads = $('#datatable-view-all-leads').dataTable({
		"fixedHeader": true,
		"processing":true,
		"serverSide":true,
		"paging":true,
		"responsive":true,
		"searching":false,
		"ajax":{
			url:removeHashFromURL(window.location.href)+"/get-leads",
			data:function(d){
				d.page = (d.start/d.length)+1;
				d.columns = null;
				d.order = null;
			}
		}
	}).api();
	
	
 
	
	
// ***********
// DATA TABLES
	var dataTableViewAllStudent = $('#datatable-view-all-students').dataTable({
		"fixedHeader": true,
		"processing":true,
		"serverSide":true,
		"paging":true,
		"responsive":true,
		"searching":false,
		"ajax":{
			url:removeHashFromURL(window.location.href)+"/get-students",
			data:function(d){
				d.page = (d.start/d.length)+1;
				d.columns = null;
				d.order = null;
			}
		}
	}).api();
	
	
	
	var dataTableViewAllDiscussion = $('#datatable-view-all-Discussion').dataTable({
		"fixedHeader": true,
		"processing":true,
		"serverSide":true,
		"paging":true,
		"responsive":true,
		"searching":false,
		"ajax":{
			url:removeHashFromURL(window.location.href)+"/get-Discussion",
			data:function(d){
				d.page = (d.start/d.length)+1;
				d.columns = null;
				d.order = null;
			}
		}
	}).api();
	
var dataTableAssignedKeywords = $('#datatable-assigned-keywords').dataTable({
	"fixedHeader": true,
	"processing":true,
	"serverSide":true,
	"responsive":true,
	"searching":false,
	"paging":true,
	"ajax":{
		url:removeHashFromURL(window.location.href)+"/get-paginated-assigned-keywords",
		data:function(d){
			d.page = (d.start/d.length)+1;
			d.columns = null;
			d.order = null;
		}
	}
}).api();



var dataTablePaymentHistory = $('#datatable-payment-history').dataTable({
	"fixedHeader": true,
	"processing":true,
	"serverSide":true,
	"paging":true,
	"responsive":true,
	"searching":false,
	"ajax":{
		url:removeHashFromURL(window.location.href)+"/get-paginated-payment-history",
		data:function(d){
			d.page = (d.start/d.length)+1;
			d.columns = null;
			d.order = null;
		}
	}
}).api();
// DATA TABLES
// ***********

// ***************
// FORGOT PASSWORD
	var fp = (function(){
		return {
			getFPF:function(){
				$('.closebtn').click();
				
				$.ajax({
					url:"/resetp",
					type:"GET",
					data:{action:"getFPF"},
					success:function(data,textStatus,jqXHR){
						$('body').append(data);
						
						$('#pass-reset-modal').modal({keyboard:false,backdrop:'static'});
						$("#pass-reset-modal").on('hidden.bs.modal', function () {
							$(this).data('bs.modal', null);
							$('#pass-reset-modal').remove();
						});
					}
				});
				return false;
			},
			getOTPF:function(form){
				var username = $(form).find('*[name="username"]').val();
				var mobile = $(form).find('*[name="mobile"]').val();
				if(username=='' || mobile==''){
					return false;
				}
				
				$.ajax({
					url:"/resetp",
					type:"GET",
					data:{action:"getOTPF",username:username,mobile:mobile},
					success:function(data,textStatus,jqXHR){
						$(form).find('.has-error:not(:last)').removeClass('has-error');
						$(form).find('.help-block:not(:last)').remove();
						if(typeof data.error!=='undefined'){
							for(var i in data.error.fields){
								$(form).find('*[name="'+i+'"]').closest('.form-group').addClass('has-error');
								$('<span class="help-block"><strong>'+data.error.fields[i]+'</strong></span>').insertAfter($(form).find('*[name="'+i+'"]'));
							}
							
							return;
						}
						
						$('#pass-reset-modal').modal('hide');
						$('body').append(data);
						$('#pr-otp-modal').modal({keyboard:false,backdrop:'static'});
						$("#pr-otp-modal").on('hidden.bs.modal', function () {
							$(this).data('bs.modal', null);
							$('#pr-otp-modal').remove();
						});
					}
				});
				return false;
			},
			submitOTPF:function(form){
				var otp = $(form).find('*[name="otp"]').val();
				if(otp==''){
					return false;
				}
				
				$.ajax({
					url:"/resetp",
					type:"GET",
					data:{action:"submitOTPF",otp:otp},
					success:function(data,textStatus,jqXHR){
						$(form).find('.has-error:not(:last)').removeClass('has-error');
						$(form).find('.help-block:not(:last)').remove();
						if(typeof data.error!=='undefined'){
							for(var i in data.error.fields){
								$(form).find('*[name="'+i+'"]').closest('.form-group').addClass('has-error');
								$('<span class="help-block"><strong>'+data.error.fields[i]+'</strong></span>').insertAfter($(form).find('*[name="'+i+'"]'));
							}
							
							return;
						}
						
						$('#pr-otp-modal').modal('hide');
						$('body').append(data);
						$('#pr-conf-modal').modal({keyboard:false,backdrop:'static'});
						$("#pr-conf-modal").on('hidden.bs.modal', function () {
							$(this).data('bs.modal', null);
							$('#pr-conf-modal').remove();
						});
					}
				});
				return false;
			},
			close:function(){
				$('#pass-reset-modal').modal('hide');
			},
			closeotpf:function(){
				$('#pr-otp-modal').modal('hide');
			},
			closeconff:function(){
				$('#pr-conf-modal').modal('hide');
			}
		}
	})();
// FORGOT PASSWORD
// ***************


var homeController = (function(){
		return {
			checked_Ids:[],
			saveEnquiry:function(THIS){				
				var $this = $(THIS), 
				data  = $this.serialize();	
			//	alert('inner');
		/*	$('button[type="submit"]').prop('disabled','disabled');	
			$('input[type="text"],input[type="tel"]').keyup(function() {
			if($(this).val() != '') {
			$(':input[type="submit"]').prop('disabled', false);
			} });*/  
			
			//alert(data);
			$.ajax({
					url:"/client/lead/saveEnquiry",
					type:"POST",
					data:data,
					dataType: 'json',
					success:function(response,textStatus,jqXHR){
					    						
					   // alert(response);
						//alert('hello');
					   // alert(response.errors);
						if(response.statusCode){
						   
							//window.location.href ="/thanks";			 
					//	 $('button[type="submit"]').removeAttr('disabled');
 
						
						    $('.connectedclosebtn').click();
						    $('.dealclosebtn').click();
							$(".reset_lead_form").click();
							$("#messagemodel").modal();
							$('.imgclass').html('<img src="/images/Thanks.png" style="width: 100%;text-align: center;margin: auto;display: block;">');					
							$('.successhtml').html("<p class='text-center' style='font-weight: 600;'>Your Submission has been received. <br> Our experts will reach out to you in the next 24 hours.</p>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
						//	removeValidationErrors($this);
							$this.find('.jinp').removeClass('has-error');
							$this.find('.help-block').remove();
							// window.location.href ="/thanks";
							
						}else{			
                            $('.connectedclosebtn').click();
						    $('.dealclosebtn').click();
							$(".reset_lead_form").click();
							$("#messagemodel").modal();
							$('.imgclass').html('<img src="/images/message_alert.png" style="width: 50%;text-align: center;margin: auto;display: block;">');			
							$('.failedhtml').html("<p class='text-center'>Some Error Please Try again.</p>");	
							$('#messagemodel').modal({backdrop:"static",keyboard:false});							
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
					   	var response = JSON.parse(jqXHR.responseText);
						if(response.status){
						   
						var errors=response.errors;
						$this.find('.form-inline').find('.jinp').removeClass('has-error');
						$this.find('.help-block').remove();					 
						for (var key in errors) {
						if(errors.hasOwnProperty(key)){
						var el = $this.find('*[name="'+key+'"]');
						$('<span class="help-block"><strong>'+errors[key][0]+'</strong></span>').insertAfter(el);
						el.closest('.form-inline').find('.jinp').addClass('has-error');
						}		}

						}else{
                            $('.connectedclosebtn').click();
						    $('.dealclosebtn').click();
							$(".reset_lead_form").click();
							$("#messagemodel").modal();
							$('.imgclass').html('<img src="/public/images/message_alert.png" style="width: 50%;text-align: center;margin: auto;display: block;">');			
							$('.failedhtml').html("<p class='text-center'>Some Error Please Try Again.</p>");	
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
						}
						 
					}
				});
				return false;
			},
			
				saveTwoEnquiry:function(THIS){				
				var $this = $(THIS), 
				data  = $this.serialize();	
			//	alert('inner');
		/*	$('button[type="submit"]').prop('disabled','disabled');	
			$('input[type="text"],input[type="tel"]').keyup(function() {
			if($(this).val() != '') {
			$(':input[type="submit"]').prop('disabled', false);
			} });*/  
			
			//alert(data);
			$.ajax({
					url:"/client/lead/saveTwoEnquiry",
					type:"POST",
					data:data,
					dataType: 'json',
					success:function(response,textStatus,jqXHR){
					    						
					   // alert(response);
						//alert('hello');
					   // alert(response.errors);
						if(response.statusCode){
						   
							//window.location.href ="/thanks";			 
					//	 $('button[type="submit"]').removeAttr('disabled');
 
						
						    $('.connectedclosebtn').click();
						    $('.dealclosebtn').click();
							$(".reset_lead_form").click();
							$("#messagemodel").modal();
							$('.imgclass').html('<img src="/public/images/Thanks.png" style="width: 100%;text-align: center;margin: auto;display: block;">');					
							$('.successhtml').html("<p class='text-center' style='font-weight: 600;'>Your Submission has been received. <br> Our experts will reach out to you in the next 24 hours.</p>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
						//	removeValidationErrors($this);
							$this.find('.jinp').removeClass('has-error');
							$this.find('.help-block').remove();
							// window.location.href ="/thanks";
							
						}else{			
                            $('.connectedclosebtn').click();
						    $('.dealclosebtn').click();
							$(".reset_lead_form").click();
							$("#messagemodel").modal();
							$('.imgclass').html('<img src="/public/images/message_alert.png" style="width: 50%;text-align: center;margin: auto;display: block;">');			
							$('.failedhtml').html("<p class='text-center'>Some Error Please Try again.</p>");	
							$('#messagemodel').modal({backdrop:"static",keyboard:false});							
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
					   	var response = JSON.parse(jqXHR.responseText);
						if(response.status){
						   
						var errors=response.errors;
						$this.find('.form-inline').find('.jinp').removeClass('has-error');
						$this.find('.help-block').remove();					 
						for (var key in errors) {
						if(errors.hasOwnProperty(key)){
						var el = $this.find('*[name="'+key+'"]');
						$('<span class="help-block"><strong>'+errors[key][0]+'</strong></span>').insertAfter(el);
						el.closest('.form-inline').find('.jinp').addClass('has-error');
						}		}

						}else{
                            $('.connectedclosebtn').click();
						    $('.dealclosebtn').click();
							$(".reset_lead_form").click();
							$("#messagemodel").modal();
							$('.imgclass').html('<img src="/public/images/message_alert.png" style="width: 50%;text-align: center;margin: auto;display: block;">');			
							$('.failedhtml').html("<p class='text-center'>Some Error Please Try Again.</p>");	
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
						}
						 
					}
				});
				return false;
			},
		};
	})();	
			
function newsletter(THIS){
	var $this = $(THIS);
	
	if($this.find('input[name="email"]').val() == ''){
		return false;
	}
	
	$.ajax({
		url: $this.attr('action'),
		type: "POST",
		data: new FormData(THIS),
		contentType:false,
		cache:false,
		processData:false,
		success: function(response) {
			if(response.status){
				$this.find('.nl_err').text(response.message);
				//alert(response.message);
				$this.find('input[name="reset"]').click();
			}else{
				//alert(response.message);
				$this.find('.nl_err').text(response.message);
			}
		},
		error: function(response) {
			alert("An error occured");
		}
	});
	return false;
}

function uploadProfilePic(clientID){
	alert(clientID);
}

/* function openGBVerified(){
	alert()
	//e.preventDefault();
	$('<div class="loginoverlay"></div>').insertBefore('.gbVerifiedPopup');
	$('.gbVerifiedPopup').addClass('dealshowup');
	$('html, body').animate({
		scrollTop: $(".gbVerifiedPopup").offset().top - 15 + "px"
	}, 1300);
} */

function showCategory(parent_id,parent_slug){
 
 //alert(parent_id);
	//alert(c.replace(/[^a-z0-9\s]/gi,'-'));
	//alert(cat_url)
	 $.ajax({
		type:"post",
		url:"/category/"+parent_slug,
		data:{parent_id:parent_id},
		success:function(response){			
			alert(response);
			//return false;
			location.href="/category/"+parent_slug;
			
			/* if(response.status){
				//alert(JSON.stringify(response.message));
				var kwdsList = response.message;
				var i = 0;
				var subMenu = [];
				subMenu['list_one']   = '<div class="col-md-4"><ul>';
				subMenu['list_two']   = '<div class="col-md-4"><ul>';
				subMenu['list_three'] = '<div class="col-md-4"><ul>';
				for(var k in kwdsList){
					i++;
					if(i==1){
						subMenu['list_one']   += "<li><a href=\"javascript:getCitiesOfKW('"+parentID+"','"+childID+"','"+parentCat+"','"+childCat+"','"+kwdsList[k]['keyword']+"')\">"+kwdsList[k]['keyword']+"</a></li>";
					}
					if(i==2){
						subMenu['list_two']   += "<li><a href=\"javascript:getCitiesOfKW('"+parentID+"','"+childID+"','"+parentCat+"','"+childCat+"','"+kwdsList[k]['keyword']+"')\">"+kwdsList[k]['keyword']+"</a></li>";
					}
					if(i==3){
						subMenu['list_three'] += "<li><a href=\"javascript:getCitiesOfKW('"+parentID+"','"+childID+"','"+parentCat+"','"+childCat+"','"+kwdsList[k]['keyword']+"')\">"+kwdsList[k]['keyword']+"</a></li>";
						i=0;
					}					
				}
				subMenu['list_one']   += '</ul></div>';
				subMenu['list_two']   += '</ul></div>';
				subMenu['list_three'] += '</ul></div><div class="clearfix"></div>';
				$('#showKeywordsList .modal-body').html(subMenu['list_one']+subMenu['list_two']+subMenu['list_three']);
			}else{
				
			} */
		}
	}); 
	 
	/* 
	$('#showKeywordsList .modal-title').text(parent_cat+"["+child_cat+"]");
	$('#showKeywordsList').modal({keyboard:false,backdrop:'static'});
	var formToSend = $('<form><input name="parent_cat_id" value="'+parent_id+'" /><input name="child_cat_id" value="'+child_id+'" /></form>');
	var parentID  = parent_id,
	    childID   = child_id,
		parentCat = parent_cat,
		childCat  = child_cat;
	$.ajax({
		type:"POST",
		url:"/getKWList",
		data:formToSend.serialize(),
		success:function(response){
			if(response.status){
				//alert(JSON.stringify(response.message));
				var kwdsList = response.message;
				var i = 0;
				var subMenu = [];
				subMenu['list_one']   = '<div class="col-md-4"><ul>';
				subMenu['list_two']   = '<div class="col-md-4"><ul>';
				subMenu['list_three'] = '<div class="col-md-4"><ul>';
				for(var k in kwdsList){
					i++;
					if(i==1){
						subMenu['list_one']   += "<li><a href=\"javascript:getCitiesOfKW('"+parentID+"','"+childID+"','"+parentCat+"','"+childCat+"','"+kwdsList[k]['keyword']+"')\">"+kwdsList[k]['keyword']+"</a></li>";
					}
					if(i==2){
						subMenu['list_two']   += "<li><a href=\"javascript:getCitiesOfKW('"+parentID+"','"+childID+"','"+parentCat+"','"+childCat+"','"+kwdsList[k]['keyword']+"')\">"+kwdsList[k]['keyword']+"</a></li>";
					}
					if(i==3){
						subMenu['list_three'] += "<li><a href=\"javascript:getCitiesOfKW('"+parentID+"','"+childID+"','"+parentCat+"','"+childCat+"','"+kwdsList[k]['keyword']+"')\">"+kwdsList[k]['keyword']+"</a></li>";
						i=0;
					}					
				}
				subMenu['list_one']   += '</ul></div>';
				subMenu['list_two']   += '</ul></div>';
				subMenu['list_three'] += '</ul></div><div class="clearfix"></div>';
				$('#showKeywordsList .modal-body').html(subMenu['list_one']+subMenu['list_two']+subMenu['list_three']);
			}else{
				
			}
		}
	}); */
}


function showKeywordsList(parent_id, parent_cat, child_id, child_cat){

	$('#showKeywordsList .modal-title').text(parent_cat+"["+child_cat+"]");
	$('#showKeywordsList').modal({keyboard:false,backdrop:'static'});
	var formToSend = $('<form><input name="parent_cat_id" value="'+parent_id+'" /><input name="child_cat_id" value="'+child_id+'" /></form>');
	var parentID  = parent_id,
	    childID   = child_id,
		parentCat = parent_cat,
		childCat  = child_cat;
	$.ajax({
		type:"GET",
		url:"/getKWList",
			dataType: 'json',
		data:formToSend.serialize(),
		success:function(response){
		    //	response = JSON.stringify(response);
		    
			if(response.status){
				//alert(JSON.stringify(response.message));
				var kwdsList = response.message;
			 
				var i = 0;
				var subMenu = [];
				subMenu['list_one']   = '<div class="col-md-4"><ul>';
				subMenu['list_two']   = '<div class="col-md-4"><ul>';
				subMenu['list_three'] = '<div class="col-md-4"><ul>';
				for(var k in kwdsList){
					i++;
					if(i==1){
						subMenu['list_one']   += "<li><a href=\"javascript:getCitiesOfKW('"+parentID+"','"+childID+"','"+parentCat+"','"+childCat+"','"+kwdsList[k]['keyword']+"')\">"+kwdsList[k]['keyword']+"</a></li>";
					}
					if(i==2){
						subMenu['list_two']   += "<li><a href=\"javascript:getCitiesOfKW('"+parentID+"','"+childID+"','"+parentCat+"','"+childCat+"','"+kwdsList[k]['keyword']+"')\">"+kwdsList[k]['keyword']+"</a></li>";
					}
					if(i==3){
						subMenu['list_three'] += "<li><a href=\"javascript:getCitiesOfKW('"+parentID+"','"+childID+"','"+parentCat+"','"+childCat+"','"+kwdsList[k]['keyword']+"')\">"+kwdsList[k]['keyword']+"</a></li>";
						i=0;
					}					
				}
				subMenu['list_one']   += '</ul></div>';
				subMenu['list_two']   += '</ul></div>';
				subMenu['list_three'] += '</ul></div><div class="clearfix"></div>';
				$('#showKeywordsList .modal-body').html(subMenu['list_one']+subMenu['list_two']+subMenu['list_three']);
			}else{
				
			}
		}
	});
}

function getCitiesOfKW(parent_id,child_id,parent_cat,child_cat,keyword){
	 
  			var city = "delhi";
			searchKW = keyword;
			searchKW = searchKW.replace(/\s+/g, '-').toLowerCase();
			city = city.replace(/[_\s]+/g, '-').toLowerCase();
			location.href="/"+city+"/"+searchKW;
}
			
function getCitiesOfKW_old(parent_id,child_id,parent_cat,child_cat,keyword){
	$('#cityKWForm .modal-title').text(parent_cat+" -> "+child_cat+" -> "+keyword);
	$('#cityKWForm .home-search').val(keyword);
	$('#cityKWForm').modal({keyboard:false,backdrop:'static'});
	var formToSend = $('<form><input name="parent_cat_id" value="'+parent_id+'" /><input name="child_cat_id" value="'+child_id+'" /><input name="kw" value="'+keyword+'" /></form>');
	$.ajax({
		type:"GET",
		url:"/getCityKWList",
		dataType: 'json',
		data:formToSend.serialize(),
		success:function(response){
			if(response.status){
				//alert(JSON.stringify(response.message));
				var kwdsList = response.message;
			//	alert(kwdsList);
				var html = "<option value=\"\">--Select the City--</option>";
				for(var k in kwdsList){
					html += "<option value=\""+(kwdsList[k]['city']).toLowerCase()+"\">"+kwdsList[k]['city']+"</option>";
				}
				$('#cityKWForm .city').html(html);
			}else{
				
			}
		}
	});	
}



/*  login password*/
/*
function submitForm(){
	 var data = $("#login-form").serialize();
	$.ajax({
		type:"POST",
		 url:"/client-login",
		 data:data,
		beforeSend:function(){
			$("#error").fadeOut();
			$("#btn-login").html("<span class=\"glyphicon glyphicon-transfer\"></span> &nbsp; sending ...");
		},
		success:function(response){
			 if(response.status){
				$("#btn-login").html('<img src="/client/images/btn-ajax-loader.gif" /> &nbsp; Signing In ...');
			 setTimeout(function(){ window.location.href = "/business-owners"; },2000);
			}else{
				$('#login-form').prepend('<div class="alert alert-danger">'+response.msg+'</div>');
				$("#btn-login").html('<span><span>Login</span></span>');
				$("#error").fadeIn(1000, function(){						
				 $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response.msg+' !</div>');
				$("#btn-login").html(' <span><span>Login</span></span>');
				}); 
			 }
		}
	});
	 return false;
 }
 */
/* mobile otp important */
 function submitForm(){
	var data = $("#login-form").serialize();
	$.ajax({
		type:"POST",
		url:"/client-login",
		data:data,
		beforeSend:function(){
			$("#error").fadeOut();
			$("#btn-login").html("<span class=\"glyphicon glyphicon-transfer\"></span> &nbsp; sending ...");
		},
		success:function(data,textStatus,jqXHR){
			if(data.statusCode && data.statusCode == 1){
				$('.input-layout').replaceWith(data.data.payload);
				$("#btn-login").html('<span><span>Continue</span></span>');
				$('.input-layout').before(data.data.message);
			}
			else if(data.statusCode && data.statusCode == 2){
				$("#btn-login").html('<img src="/public/client/images/btn-ajax-loader.gif" /> &nbsp; '+data.data.message+' ...');
				setTimeout(function(){ window.location.href = "/business/dashboard"; },2000);
			}
			else{
				$(".alert").remove();
				$('#login-form').prepend('<div class="alert alert-danger">'+data.data.message+'</div>');
				$("#btn-login").html('<span><span>Continue</span></span>');
			}
		}
	});
	return false;
} 

 
// ****************
// HELPER FUNCTIONS
	/**
	 * Removing hash from the given url
	 *
	 * @param url
	 * @return url without hash 
	 */
	function removeHashFromURL($url=null){
		if($url==null) return;
		return $url.substr(0,($url.indexOf('#')==(-1))?$url.length:$url.indexOf('#'));
	}
// HELPER FUNCTIONS
// ****************

+(function($){
	$(document).ready(function(){
		/* var popoverTemplate = ['<div class="timePickerWrapper popover" style="min-width:300%">',
			'<div class="arrow"></div>',
			'<div class="popover-content">',
			'</div>',
			'</div>'].join('');

		var content = ['<div class="col-md-4">asfaf asfsadf</div>',
			'<div class="col-md-4">asdf asdfasf</div>',
			'<div class="col-md-4">asfa</div>','<div class="col-md-4">asfaf asfsadf</div>',
			'<div class="col-md-4">asdf asdfasf</div>',
			'<div class="col-md-4">asfa</div>','<div class="col-md-4">asfaf asfsadf</div>',
			'<div class="col-md-4">asdf asdfasf</div>',
			'<div class="col-md-4">asfa</div>', ].join('');		
		$('[data-toggle="popover"]').popover({
			html:true,
			content: content,
			template: popoverTemplate,
			trigger: 'click'
		}); */
		
		// INCLUDE CSRF TOKEN IN HEADER IN EACH REQUEST
		// ********************************************
	

/*
$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-Token': $('input[name="_token"]').val()
    }
});

*/
		// *****************************************
		// SET WIDTH OF "SELECT A CITY" ON HOME PAGE
			//$('.filterForm .select2-container').css('width','145px');
		// SET WIDTH OF "SELECT A CITY" ON HOME PAGE
		// *****************************************
		
		// SELECT ALL CHECKBOX
		// *******************
		$('input[name="payment_mode_accepted[select_all]"]').on('change',function(){
			var k = this.checked?true:false;
			if(k){
				$(this).closest('.form-group').find('input[type="checkbox"]').prop('checked',true);
			}else{
				$(this).closest('.form-group').find('input[type="checkbox"]').prop('checked',false);
			}
		});
		// *******************
		// SELECT ALL CHECKBOX
		
		// LEAD FORM SUBMISSION
		// ********************
 
		// ONSUBMIT SEARCH FORM
		// ********************
		$('.search-form').submit(function(e){
			e.preventDefault();
			var $city = $(this).find('.city').val();
			var searchKW = $(this).find('.home-search').val();
			localStorage.setItem('keyword',searchKW);	
			 var city = $(this).find('.cityList').val();
            localStorage.setItem('city',city);
			var message = '';
			if(searchKW==''){
				if(searchKW==''){
					return;
				}
				else if(searchKW!=''){
					message = "Please, <strong>select the city</strong> in which you are looking for <strong>"+$(this).find('input[name="search_kw"]').val()+"</strong>";
				}
				else if(searchKW==''){
					message = "Please, <strong>enter the service</strong> for which you are looking";
				}
				$('#msgModal .modal-dialog').removeClass('modal-md').addClass('modal-sm');
				$('#msgModal .modal-body').html(message);
				$('#msgModal').modal({keyboard:false,backdrop:'static'});				
				return;
			}
			var searchKW = $(this).find('.home-search').val();
			var city = $(this).find('.city').val();
		 
			searchKW = searchKW.replace(/\s+/g, '-').toLowerCase();
			if(city){
				city = city.replace(/[_\s]+/g, '-').toLowerCase();
				localStorage.setItem('city',city);
				location.href="/"+city+"/"+searchKW;
			}else{
				location.href="/"+searchKW;
			}
			
		});
		
		// ONCLICK TO SEARCH RESULTS
		// *************************
		$(document).on('click','.ajax-suggest ul>li',function(e){
			e.preventDefault();
			$(this).closest('form').find(".home-search").val($(this).find('a').text());
			//$(".home-search").closest('form').submit();
			var closestForm = $(this).closest('form');
			if(closestForm.hasClass('search-form')){
				closestForm.submit();
			}
			$(this).closest('form').find(".ajax-suggest").hide();
			$(this).closest('form').find(".ajax-suggest ul").html("");
		});
		
		
		$(document).on('click','.resultCode ul>li',function(e){ 	
		$(this).closest('form').find(".location").val($(this).find('a').text());	
		var closestForm = $(this).closest('form');
			if(closestForm.hasClass('search-form')){
				closestForm.submit();
			}
		$(this).closest('form').find(".resultCode").hide();
	});
	
	 $(document).on('click','.keystore',function(e){
        e.preventDefault();             
         var slug =$(this).attr('href');      
           slug = slug.replace(/\s+/g, '-').toLowerCase();  
           localStorage.setItem('keyword',slug);	
		   var city=  localStorage.getItem('city');	
		   if(city){
            window.location.href="/"+city+"/"+slug;
		   }else{
		       window.location.href="/"+slug;
		   }
        });
		
		// SEARCHING KEYDOWN
		// *****************
		$(".home-search").on('keydown',function(evt){	
			
			if($(this).closest('form').find('.ajax-suggest ul>li').length>0){
				if($(this).closest('form').find('.ajax-suggest ul li.active').length>0){
					if(evt.keyCode == '38'){
						//alert(38)
						if($(this).closest('form').find('.ajax-suggest ul li.active').is(':first-child')){
							$(this).closest('form').find('.ajax-suggest ul li.active').removeClass('active');
							$(this).closest('form').find('.ajax-suggest ul>li').last().addClass('active');
						}else{
							$(this).closest('form').find('.ajax-suggest ul li.active').removeClass('active').prev().addClass('active');
						}
					}
					if(evt.keyCode == '40'){
						//alert(40)
						if($(this).closest('form').find('.ajax-suggest ul li.active').is(':last-child')){
							$(this).closest('form').find('.ajax-suggest ul li.active').removeClass('active');
							$(this).closest('form').find('.ajax-suggest ul>li').first().addClass('active');
						}else{
							$(this).closest('form').find('.ajax-suggest ul li.active').removeClass('active').next().addClass('active');
						}
					}
				}else{
					$(this).closest('form').find('.ajax-suggest ul>li').first().addClass('active');
				}
			}
		});
		
		// SEARCHING ENGINE
		// ****************
		$(".home-search").on('keyup',function(evt){
			// alert('dd');
			if(evt.keyCode == '38'||evt.keyCode == '40'){
				$(this).val($('.ajax-suggest ul li.active>a').text());
				return;
			}
			var key = $(this).val();
			var yearly_subs_form = $(this).closest('form');
			//alert(yearly_subs_form);
			if(key!=""){
				$(this).closest('form').find(".ajax-suggest").show();
				$(this).closest('form').find(".ajax-suggest ul").html("<li><a href='#'>Loading...</a><li>");
				var $this = $(this);
			var formToSend = $('<form><input name="city" value="'+yearly_subs_form.find(".city").val()+'" /><input name="search_kw" value="'+yearly_subs_form.find(".home-search").val()+'" /></form>');
				
				$.ajax({
					type: "POST",
					url: '/kw/search',
					data: formToSend.serialize(),
					dataType: 'json',
					success: function(response) {
						if(response.status){
							//alert(JSON.stringify(response.message));
							$this.closest('form').find(".ajax-suggest ul").html(response.message);
						}else{
							//alert(response.message);
							$this.closest('form').find(".ajax-suggest ul").html("<li><a href='#'>Nothing found...</a><li>");	
						}
					}
				});	
			}else{
				$(this).closest('form').find(".ajax-suggest").hide();
				$(this).closest('form').find(".ajax-suggest ul").html("");
			}
		});
		
		
		$(".cityList").on('keyup',function(evt){
			 var key = $(this).val();
			 console.log(key);
		if(key.length >0)
    	{   
        	 
            	$.ajax({
                	url:"/getCityList",
                	type:'get',
                	data:{id:key},
                	success:function(data){
						 
                	$('.city-result').html(data);
                	 
                	}
            	});
        	}else{
			 
        		 
                	$.ajax({
                	url:"/getCityList",
                	type:'get',
                	data:{id:key},
                	success:function(data){
                	$('.city-result').html(data);
                	 
                	}
                	});
    	 
    	}
		});
		
		// HANDLING REVIEW SUBMIT
		// **********************
		$('#commentform').submit(function(e){
			e.preventDefault();
			var msg = 'Please check if all the mandatory fields are filled as listed below:<br> <span class="orng" style="font-weight:normal">"Rating", "Name", "Mobile", "Email" &amp; "Comment"</span><br> to submit your<br>review and rating.<br><br><br><strong>Thanks,<br>Quick India Team<br></strong>';
			if(($('#commentform').find('[name="s_rating"]').length==1 && $('#commentform').find('[name="s_rating"]').val()=='')||($('#commentform').find('[name="comment_author"]').length==1 && $('#commentform').find('[name="comment_author"]').val()=='')||($('#commentform').find('[name="comment_author_phone"]').length==1 && $('#commentform').find('[name="comment_author_phone"]').val()=='')||($('#commentform').find('[name="comment_author_email"]').length==1 && $('#commentform').find('[name="comment_author_email"]').val()=='')||($('#commentform').find('[name="comment_content"]').length==1 && $('#commentform').find('[name="comment_content"]').val()=='')){
				$('#myModal .modal-body').html(msg);
				$('#myModal').modal();
				return;
			}
			$.ajax({
				type:"POST",
				url: '/review',
			 
				//data:{"formdata":$(this).serialize()},
				data:$(this).serialize(),
				dataType: 'json',
				success: function(data){
					if(!data.status){
						$('#comment_reset').click();
						$('.s_active').removeClass('s_active');
						var imageUrl = '/client/images/empty-star.png';
						for(var i=0;i<5;++i){
							//alert($('.s_rating[data-s_rating="'+(i+1)+'"]').data('s_rating'));
							$('.s_rating[data-s_rating="'+(i+1)+'"]').css('background-image', 'url(' + imageUrl + ')');
						}
						$('#msgModal .modal-body').html(data.message);
						$('#msgModal').modal();						
					}
					else if(data.status){
						$('#comment_reset').click();
						$('.s_active').removeClass('s_active');
						var imageUrl = '/client/images/empty-star.png';
						for(var i=0;i<5;++i){
							//alert($('.s_rating[data-s_rating="'+(i+1)+'"]').data('s_rating'));
							$('.s_rating[data-s_rating="'+(i+1)+'"]').css('background-image', 'url(' + imageUrl + ')');
						}
						$('#msgModal .modal-body').html(data.message);
						$('#msgModal').modal();
						location.reload();
					}
				},
				error: function(data){
					$('#comment_reset').click();
					$('.s_active').removeClass('s_active');
						var imageUrl = '/client/images/empty-star.png';
						for(var i=0;i<5;++i){
							//alert($('.s_rating[data-s_rating="'+(i+1)+'"]').data('s_rating'));
							$('.s_rating[data-s_rating="'+(i+1)+'"]').css('background-image', 'url(' + imageUrl + ')');
						}
					$('#msgModal .modal-body').html("Please fill the mandatory fields with proper values");
					$('#msgModal').modal();
				}
			});
		});
		
		// PLAYING WITH STAR RATING
		// ************************
		$(document).on('mouseover','.s_rating',function(){
			var s_rating = $(this).data('s_rating');
			var imageUrl = '/client/images/full-star.png';
			for(var i=0;i<s_rating;++i){
				//alert($('.s_rating[data-s_rating="'+(i+1)+'"]').data('s_rating'));
				$('.s_rating[data-s_rating="'+(i+1)+'"]').css('background-image', 'url(' + imageUrl + ')');
			}
		});
		
		$(document).on('mouseout','.s_rating',function(){
			var s_rating = 0;
			if($('.s_active').length){
				s_rating = $('.s_active').data('s_rating');
			}
			var imageUrl = '/client/images/empty-star.png';
			for(var i=s_rating;i<5;++i){
				//alert($('.s_rating[data-s_rating="'+(i+1)+'"]').data('s_rating'));
				$('.s_rating[data-s_rating="'+(i+1)+'"]').css('background-image', 'url(' + imageUrl + ')');
			}
		});
		
		$(document).on('click','.s_rating',function(e){
			e.preventDefault();
			if($('.s_active').length){
				$('.s_active').removeClass('s_active');
			}
			$(this).addClass('s_active');
			$('input[name="s_rating"]').val($(this).data('s_rating'));
			$('html, body').animate({
				scrollTop: $("#wrt").offset().top-130
			}, 1000);
			var msg = 'Please provide your <span class="orng" style="font-weight:normal">"Name", "Mobile", "Email" &amp; "Comment"</span> to submit your<br>review and rating.<br><br><br><strong>Thanks,<br>Quick India Team<br></strong>';
			if(($('#commentform').find('[name="s_rating"]').length==1 && $('#commentform').find('[name="s_rating"]').val()=='')||($('#commentform').find('[name="comment_author"]').length==1 && $('#commentform').find('[name="comment_author"]').val()=='')||($('#commentform').find('[name="comment_author_phone"]').length==1 && $('#commentform').find('[name="comment_author_phone"]').val()=='')||($('#commentform').find('[name="comment_author_email"]').length==1 && $('#commentform').find('[name="comment_author_email"]').val()=='')||($('#commentform').find('[name="comment_content"]').length==1 && $('#commentform').find('[name="comment_content"]').val()=='')){
				$('#myModal .modal-body').html(msg);
				$('#myModal').modal();
			}
		});
		
		$(document).on('click','.c_trigger',function(e){
			e.preventDefault();
			$('html, body').animate({
				scrollTop: $("#wrt").offset().top-130
			}, 1000);
			$('.tab-content > div').removeClass('active in');
			$('.tab-content > #wrt').addClass('active in');
			$('.newtab > li').removeClass('active');
			$('.newtab > li > a[href="#wrt"]').parents('li').addClass('active');
		});
		
		$('#g_MapsModal').on('shown.bs.modal', function(){
			initMap();
		});
		
		$(document).on('click','.loc_trigger',function(e){
			e.preventDefault();
			$('#g_MapsModal').modal();
			//initMap();
			//$('#map_canvas').css({"position":"fixed"});
			//initialize();
		});
		
		/* $(document).on('submit','#business-form',function(e){
			e.preventDefault();
			//alert('test');
			$('.business-slide-section').slideToggle();
		}); */
		
		
		
		// LOGIN FORM VALIDATION
		// *********************
		if(typeof $.fn.validate == 'function'){
			$("#login-form").validate({
				errorElement: 'small',
				rules:{
					 password:{
						required:true
					},
					/*email:{
						required:true,
						//email:true
					} */
					mobile:{
						required:true
					},
					/* otp:{
						required:true
					} */
				},
				messages:{
					 password:{
						required:"Please enter your password"
					},
					/*email:{
						required:"Please enter your email",
						//email:"Enter valid email"
					} */
					mobile:{
						required:"Please enter the registered mobile"
					},
					/* otp:{
						required:"Please enter the OTP"
					} */
				},
				submitHandler:submitForm
			});
		}
		
		// ACTION TOOK PLACE WHEN CLICK ON '.REMOVE-THUMBNAIL'
		// ***************************************************
		$(document).on('click','.remove-thumbnail',function(e){
			e.preventDefault();
			var srno = $(this).data('srno');
			var target = $('#'+srno);
			//alert($(this).data('srno'));
			target.prepend("<input type=\"file\" class=\"form-control\" name=\""+srno+"\">");
			target.find('.help-block').remove();
		});
		
		// TOGGLE HOURS OF OPERATION
		// *************************
		$(document).on('click','.max-min',function(){
			$('.today').toggleClass('hide');
			$('.otherday').toggleClass('hide');
		});
		
		// TOGGLE FORMS ON BUSINESS OWNERS PAGE
		// ************************************
		$(document).on('click','.acc-head',function(e){
			e.preventDefault();
			$this = $(this);
			$('.acc-body').slideUp();
			$this.next().slideToggle();
		});
		
		// ANIMATE PAGE SCROLL WHEN FILL THE BUSINESS FORM
		// ***********************************************
		var forms_group = $('#forms_group');
		if(forms_group.length){
			
			var offset = forms_group.offset();
			$('html, body').animate({
				scrollTop: offset.top - 60
			}, 400);			
		}
		
		// HANDLING HOURS OF OPERATION TIME VALIDATION
		// *******************************************
		$(document).on('change','.time-from',function(){
			var $this = $(this);
			var id = $this.attr('id');
			var corr_id = id.replace("[from]", "[to]");
			if($this.val()==''){
				$this.data('time','');
				$('select[id="'+corr_id+'"]').val('');
				$('select[id="'+corr_id+'"]').data('time','');
			}
			else if($this.val()=='24:00'){
				$this.data('time','24:00');
				$('select[id="'+corr_id+'"]').val('24:00');
				$('select[id="'+corr_id+'"]').data('time','24:00');
			}
			else{
				if($this.find('option:selected').data('time_in_min') > $('select[id="'+corr_id+'"]').find('option:selected').data('time_in_min')){
					alert('Open time cannot be greater then close time');
					$this.val($this.data('time'));
				}else{
					$this.data($this.val());
				}
			}
		});
		$(document).on('change','.time-to',function(){
			var $this = $(this);
			var id = $this.attr('id');
			var corr_id = id.replace("[to]", "[from]");
			if($this.val()==''){
				$this.data('time','');
				$('select[id="'+corr_id+'"]').val('');
				$('select[id="'+corr_id+'"]').data('time','');
			}
			else if($this.val()=='24:00'){
				$this.data('time','24:00');
				$('select[id="'+corr_id+'"]').val('24:00');
				$('select[id="'+corr_id+'"]').data('time','24:00');
			}
			else{
				if($this.find('option:selected').data('time_in_min') < $('select[id="'+corr_id+'"]').find('option:selected').data('time_in_min')){
					alert('Open time cannot be greater then close time');
					$this.val($this.data('time'));
				}else{
					$this.data($this.val());
				}
			}
		});
		
		
		 
		$(document).on('submit','.location_info',function(e){
		e.preventDefault();		  
		$.ajax({
			type: "POST",
			url: $('.location_info').attr('action'),
			data: $('.location_info').serialize(),
			dataType: 'json',
			success: function(response) {				
				if(response.status){					 
				 $('.location_success').text(response.result);
				// removeValidationErrors($this);
				}else{
					 alert(response.result);
				}
				
			},
			error:function(jqXHR, textStatus, errorThrown){
				var response = JSON.parse(jqXHR.responseText);	
				if(response.status){						 
				var errors = response.errors;						 
				$('.location_info').find('.form-group').removeClass('has-error');
				$('.location_info').find('.help-block').remove();
				for (var key in errors) {
				if(errors.hasOwnProperty(key)){	

				var el = $('.location_info').find('*[name="'+key+'"]');
				$('<span class="help-block"><strong>'+errors[key][0]+'</strong></span>').insertAfter(el);
				el.closest('.form-group').addClass('has-error');
				}
				}
				//alert($this,response.errors);
				//showValidationErrors($this,response.errors);
				}else{
				alert('Something went wrong');
				}
				
			}
		});
	});
		
		$(document).on('submit','.contact_info',function(e){
		e.preventDefault();		  
		$.ajax({
			type: "POST",
			url: $('.contact_info').attr('action'),
			data: $('.contact_info').serialize(),
			dataType: 'json',
			success: function(response) {				
				if(response.status){					
				  
				  $('.contact_success').text(response.result);
				}else{
					 alert(response.result);
				}
				
			},
			error:function(jqXHR, textStatus, errorThrown){
				var response = JSON.parse(jqXHR.responseText);	
				if(response.status){						 
				var errors = response.errors;						 
				$('.contact_info').find('.form-group').removeClass('has-error');
				$('.contact_info').find('.help-block').remove();
				for (var key in errors) {
				if(errors.hasOwnProperty(key)){	

				var el = $('.contact_info').find('*[name="'+key+'"]');
				$('<span class="help-block"><strong>'+errors[key][0]+'</strong></span>').insertAfter(el);
				el.closest('.form-group').addClass('has-error');
				}
				}
				//alert($this,response.errors);
				//showValidationErrors($this,response.errors);
				}else{
				alert('Something went wrong');
				}
				
			}
		});
	});
	$(document).on('submit','.client_discussion',function(e){
		e.preventDefault();	
			
		$.ajax({
			type: "POST",
			url: $('.client_discussion').attr('action'),
			data: $('.client_discussion').serialize(),
			dataType: 'json',
			success: function(response) {				
				if(response.status){					  
				  $('.discussion_success').text(response.result);
				  dataTableViewAllDiscussion.ajax.reload(null,false);
				}else{
					 alert(response.result);
				}
				
			},
			error: function(response) {
				alert("An error occured");
			}
		});	
		
	});
		
		
		// MOBILE NO LIMIT
		$(document).find('input[name="mobile"]').attr('maxlength',10);
		$(document).on('keydown','input[name="mobile"]',function(e){
			if($(this).val().length!=0 && e.keyCode==13){
				verifyDemo();
			}
			if($(this).val().length==0 && e.keyCode==13){
				event.preventDefault();
			}
			if($(this).val().length==0 && (e.keyCode == 48 || e.keyCode == 96)){
				e.preventDefault();
			}
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				 // Allow: Ctrl+A,Ctrl+C,Ctrl+V, Command+A
				((e.keyCode === 65 || e.keyCode === 86 || e.keyCode === 67) && (e.ctrlKey === true || e.metaKey === true)) || 
				 // Allow: home, end, left, right, down, up
				(e.keyCode >= 35 && e.keyCode <= 40)) {
					 // let it happen, don't do anything
					 return;
			}
			// Ensure that it is a number and stop the keypress
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});
	// MOBILE NO LIMIT
		
		
		function removeValidationErrors($this){
		$this.find('.form-group').removeClass('has-error');
		$this.find('.help-block').remove();
	}
		
		
	 
function showValidationErrors($this,errors){ $this.find('.form-group').removeClass('has-error'); $this.find('.help-block').remove(); for (var key in errors) { if(errors.hasOwnProperty(key)){ var el = $this.find('*[name="'+key+'"]'); $('<span class="help-block"><strong>'+errors[key][0]+'</strong></span>').insertAfter(el); el.closest('.form-group').addClass('has-error'); } } }
		
		
		
		
		
		
		
		
		
		
		
		
	});
})(jQuery);