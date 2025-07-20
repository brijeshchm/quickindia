/**
* Template Name: NiceAdmin
* Updated: Jan 29 2024 with Bootstrap v5.3.2
* Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
/*(function() {
  "use strict";
*/
$.ajaxSetup({	headers: {	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')	}	});
  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => e.addEventListener(type, listener))
    } else {
      select(el, all).addEventListener(type, listener)
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Sidebar toggle
   */
  if (select('.toggle-sidebar-btn')) {
    on('click', '.toggle-sidebar-btn', function(e) {
      select('body').classList.toggle('toggle-sidebar')
    })
  }

  /**
   * Search bar toggle
   */
  if (select('.search-bar-toggle')) {
    on('click', '.search-bar-toggle', function(e) {
      select('.search-bar').classList.toggle('search-bar-show')
    })
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Initiate tooltips
   */
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })

  /**
   * Initiate quill editors
   */
  if (select('.quill-editor-default')) {
    new Quill('.quill-editor-default', {
      theme: 'snow'
    });
  }

  if (select('.quill-editor-bubble')) {
    new Quill('.quill-editor-bubble', {
      theme: 'bubble'
    });
  }

  if (select('.quill-editor-full')) {
    new Quill(".quill-editor-full", {
      modules: {
        toolbar: [
          [{
            font: []
          }, {
            size: []
          }],
          ["bold", "italic", "underline", "strike"],
          [{
              color: []
            },
            {
              background: []
            }
          ],
          [{
              script: "super"
            },
            {
              script: "sub"
            }
          ],
          [{
              list: "ordered"
            },
            {
              list: "bullet"
            },
            {
              indent: "-1"
            },
            {
              indent: "+1"
            }
          ],
          ["direction", {
            align: []
          }],
          ["link", "image", "video"],
          ["clean"]
        ]
      },
      theme: "snow"
    });
  }

  /**
   * Initiate TinyMCE Editor
   */
  const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

   
   
    
jQuery(document).on('click', '#razor-pay-now', function (e) {	 
    
    
    var total = (jQuery('form#razorpay-frm-payment').find('input#amount').val() * 100);
    var merchant_order_id = jQuery('form#razorpay-frm-payment').find('input#merchant_order_id').val();
    var merchant_surl_id = jQuery('form#razorpay-frm-payment').find('input#surl').val();
    var merchant_furl_id = jQuery('form#razorpay-frm-payment').find('input#furl').val();
   
    var card_holder_name_id = jQuery('form#razorpay-frm-payment').find('input#billing-name').val();
    var merchant_total = total;
    var merchant_amount = jQuery('form#razorpay-frm-payment').find('input#amount').val();
    var currency_code_id = jQuery('form#razorpay-frm-payment').find('input#currency').val();
      var key_id = jQuery('form#razorpay-frm-payment').find('input#RAZOR_KEY_ID').val();
    var store_name = 'Quick India Pvt Ltd';
    var store_description = 'Fees Pay';
    var store_logo = 'https://quickindia.in/public/client/images/logo.png';
    var email = jQuery('form#razorpay-frm-payment').find('input#billing-email').val();
    var phone = jQuery('form#razorpay-frm-payment').find('input#billing-phone').val();
    var course = jQuery('form#razorpay-frm-payment').find('input#course').val();
    var billing_country = jQuery('form#razorpay-frm-payment').find('input#billing_country').val();
    var billing_state = jQuery('form#razorpay-frm-payment').find('input#billing_state').val();
    var city = jQuery('form#razorpay-frm-payment').find('input#city').val();    
    jQuery('.text-danger').remove();
    if(card_holder_name_id=="") {
      jQuery('input#billing-name').after('<small class="text-danger">Please enter full mame.</small>');
      return false;
    }
    if(email=="") {
      jQuery('input#billing-email').after('<small class="text-danger">Please enter valid email.</small>');
      return false;
    }
    if(phone=="") {
      jQuery('input#billing-phone').after('<small class="text-danger">Please enter valid phone.</small>');
      return false;
    }
    var razorpay_options = {
        key: key_id,
        amount: merchant_total,
        name: store_name,
        description: store_description,
        image: store_logo,
        netbanking: true,
        currency: currency_code_id,
        prefill: {
            name: card_holder_name_id,
            email: email,
            contact: phone
        },
        notes: {
            soolegal_order_id: merchant_order_id,
        },
        handler: function (transaction) {
            jQuery.ajax({
                url:'/business/razorPayCheckout',
                type: 'post',
                data: {razorpay_payment_id: transaction.razorpay_payment_id, merchant_order_id: merchant_order_id, merchant_surl_id: merchant_surl_id, merchant_furl_id: merchant_furl_id, card_holder_name_id: card_holder_name_id, merchant_total: merchant_total, merchant_amount: merchant_amount, currency_code_id: currency_code_id,pay:store_name,course:course,email:email,phone:phone,billing_country:billing_country,billing_state:billing_state,city:city}, 
                dataType: 'json',
                success: function (res) {		 
			var obj =  jQuery.parseJSON(res.data);
                    if(res.msg){
                        alert(res.msg);
                        return false;
                    }                
                   window.location = res.redirectURL+'?getpay='+obj.getpay+'&card_holder_name='+obj.card_holder_name+'&merchant_amount='+obj.merchant_amount+'&order_id='+obj.order_id+'&currency_code_id='+obj.currency_code+'&pay_to='+obj.pay_to+'&course='+obj.course+'&email='+obj.email+'&phone='+obj.phone+'&payment_id='+obj.razorpay_payment_id+'&billing_country='+obj.billing_country+'&billing_state='+obj.billing_state+'&city='+obj.city;
                                   }
            });
        },
        "modal": {
            "ondismiss": function () {
                
            }
        }
    };
    // obj        
    var objrzpv1 = new Razorpay(razorpay_options);
    objrzpv1.open();
        e.preventDefault();
});

  /**
   * Initiate Bootstrap validation check
   */
  var needsValidation = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(needsValidation)
    .forEach(function(form) {
      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })

  /**
   * Initiate Datatables
   */ 
   
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
			url: '/business/saveLocationInformation',
			data: $('.location_info').serialize(),
			dataType: 'json',
			success: function(response) {	
			   
				if(response.status){					 
		 	    $("#messaged").modal("show");
                $('.imgclass').html('<img src="/public/images/success.png" style="width:100%;text-align: center;margin: auto;display: block;">');	
                $('.successhtml').html("<p class='text-center' style='font-weight: 600;'>" +response.result+"</p>");
				}else{
					  $("#messaged").modal("show");
			      $('.imgclass').html('<img src="/public/images/failed.png" style="width: 35%;text-align: center;margin: auto;display: block;">');	
                $('.failedhtml').html("<p class='text-center' style='font-weight: 600;'>" +response.result+"</p>");
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
				mainSpinner.stop();
			}
		});
	});
   
   	$(document).on('submit','.profileSave',function(e){
   	    
		e.preventDefault();	
		$.ajax({
			url: '/business/saveProfile',
			type: "POST",
			dataType: 'json',
			data: $('.profileSave').serialize(),
     
			success: function(response) {				
				if(response.status){					 
				// $('.profile_success').text(response.result);
                $("#messaged").modal("show");
                $('.imgclass').html('<img src="/public/images/success.png" style="width:100%;text-align: center;margin: auto;display: block;">');	
                $('.successhtml').html("<p class='text-center' style='font-weight: 600;'>" +response.result+"</p>");
               // $('#messagemodel').modal({backdrop:"static",keyboard:false});
                
				// removeValidationErrors($this);
				}else{
			     $("#messaged").modal("show");
			      $('.imgclass').html('<img src="/public/images/failed.png" style="width: 35%;text-align: center;margin: auto;display: block;">');	
                $('.failedhtml').html("<p class='text-center' style='font-weight: 600;'>" +response.result+"</p>");
				}
				
			},
			error:function(jqXHR, textStatus, errorThrown){
				var response = JSON.parse(jqXHR.responseText);	
				if(response.status){						 
				var errors = response.errors;						 
				$('.profileSave').find('.form-group').removeClass('has-error');
				$('.profileSave').find('.help-block').remove();
				for (var key in errors) {
				if(errors.hasOwnProperty(key)){	

				var el = $('.profileSave').find('*[name="'+key+'"]');
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
   
   var businessController = (function(){
		return {
			checked_Ids:[],	
			editProfileSave:function(THIS,id){
			    alert('inner');
			  var $this = $(THIS);
			var form = new FormData(THIS);	
		 
				$.ajax({
					url:"/business/saveProfile/"+id,
					type:"POST",					   
					dataType:"json",	
					data:form,
					cache: false,
					contentType: false, 
                    processData: false,                      
					success:function(data){
					    mainSpinner.stop();			
						if(data.status){
                            $("#messaged").modal("show");
                            $('.imgclass').html('<img src="/public/images/success.png" style="width:100%;text-align: center;margin: auto;display: block;">');	
                            $('.successhtml').html("<p class='text-center' style='font-weight: 600;'>" +response.result+"</p>");
						}else{
                                $("#messaged").modal("show");
                                $('.imgclass').html('<img src="/public/images/failed.png" style="width: 35%;text-align: center;margin: auto;display: block;">');	
                                $('.failedhtml').html("<p class='text-center' style='font-weight: 600;'>" +response.result+"</p>");	 	
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
					   		
						var response = JSON.parse(jqXHR.responseText);
						if(response.status){ 
							showValidationErrors($this,response.errors);						 
						}else{
							alert('Something went wrong');
						}		 
					}
				}); 
				 return false;	
			},
		 
			};
})();		



var enquiryController  = (function(){
		return {
			checked_Ids:[],
			 
			getfollowUps:function(id){
			//	mainSpinner.start();
				$.ajax({
					url:"/business/enquiry/follow-up/"+id,
					type:"GET",
					success:function(response){
						$("#followUpModal").modal("show");
						$('#followUpModal .modal-body').html(response.html);
						 $('#expected_date_time').daterangepicker({
							singleDatePicker: true,
							autoUpdateInput: false,
							timePicker: true,
							minDate: new Date(),
							//autoUpdateInput: false,
							locale: {
								format: 'DD-MMMM-YYYY h:mm A'
							},
							singleClasses: "picker_2"
						});
						$('#expected_date_time').on('apply.daterangepicker', function(ev, picker) {
							$('#expected_date_time').val(picker.startDate.format('DD-MMMM-YYYY h:mm A'));
						});
					 
						dataTableFollowUps = $('#datatable-enquiry-followups').dataTable({
							"fixedHeader": true,
							"processing":true,
							"serverSide":true,
							"paging":false,
							"ordering":false,
							"searching":false,
							"lengthChange":false,
							"info":false,
							"autoWidth":false,
							"ajax":{
								url:"/business/enquiry/getfollowups/"+id,
								data:function(d){
									d.page = (d.start/d.length)+1;
									d.columns = null;
									d.order = null;
									d.count = $(".follow-up-count").val();
								}
							}
						}).api(); 
						var prevNextHtml = '';	 	
					 
						for(var i=0;i<recordCollection.length;i++){
							if(recordCollection[i]==id && recordCollection.length != 1){
								if(i==0){
									prevNextHtml += '<a style="background:#2A3F54;color:#fff;padding:6px 25px;" href="javascript:enquiryController.getfollowUps('+recordCollection[i+1]+')" class="btn" title="followUp">Next >></a>';
								}
								else if(i==(recordCollection.length-1)){
									prevNextHtml += '<a style="background:#2A3F54;color:#fff;" href="javascript:enquiryController.getfollowUps('+recordCollection[i-1]+')" class="btn" title="followUp"><< Previous</a>';
								}
								else{
									prevNextHtml += '<a style="background:#2A3F54;color:#fff;" href="javascript:enquiryController.getfollowUps('+recordCollection[i-1]+')" class="btn" title="followUp"><< Previous</a><a style="background:#2A3F54;color:#fff;padding:6px 25px;" href="javascript:enquiryController.getfollowUps('+recordCollection[i+1]+')" class="btn" title="followUp">Next >></a>';
								}
							}
						}
						$('#followUpModal .modal-title').html(prevNextHtml);
						$('#followUpModal').modal({keyboard:false,backdrop:'static'});
						$('#followUpModal .select2-container').css({'width':'100%'});
						//mainSpinner.stop();
					},
					error:function(response){
						//mainSpinner.stop();
					}
				});
				/* var dataTableFollowUps = $('#datatable-followups').dataTable({
					"fixedHeader": true,
					"processing":true,
					"serverSide":true,
					"paging":true,
					"ajax":{
						url:"/lead/getfollowups/",
						data:function(d){
							d.page = (d.start/d.length)+1;
						}
					}
				}).api(); */
			},
			storeFollowUp:function(id,THIS){
				var $this = $(THIS);
				$.ajax({
					url:'/business/enquiry/store-follow-up/'+id,
					type:"post",
					data:$this.serialize(),
					dataType:'json',
					success:function(response){
						if(response.status){
							//$this.find('*[name="status"]').val('');
							//$this.find('*[name="expected_date_time"]').val('');
							$this.find('*[name="remark"]').val('');
							alert('Follow Up created successfully');
							dataTableFollowUps.ajax.reload( null, false );
						//	dataTableExpectedLead.ajax.reload( null, false );
							dataTableLead.ajax.reload(function(){
								$('#datatable-view-all-students').find('[data-toggle="popover"]').popover({html:true,container:'body'});
							},false);
						 
							removeValidationErrors($this);
						}
						if(response.demo_created){
							$this.closest('.x_content').html("<p style='font-size: 24px;font-weight:700;padding-top:20px;text-align:center;'>Lead successfully moved to Demo...</p>");
						}
						mainSpinner.stop();
					},
					error:function(jqXHR, textStatus, errorThrown){
						var response = JSON.parse(jqXHR.responseText);
						if(response.status){
							showValidationErrors($this,response.errors);
						}else{
							alert('Something went wrong');
						}
						mainSpinner.stop();
					}
				});
				return false;
			},
			getAllFollowUps:function(){
				//mainSpinner.start();
				dataTableFollowUps.ajax.reload( null, false );
				return false;
			},
			  
			
			
		};
	})();
  
   
   
 	$(document).on('click','.remove-thumbnail',function(e){
		e.preventDefault();
		var srno = $(this).data('srno'); 
		var target = $('#'+srno); 
		target.prepend("<input type=\"file\" class=\"form-control\" name=\""+srno+"\">");
		target.find('.help-block').remove();
	});	

 //$('.leaddf,.leaddt').datepicker({dateFormat:"yy-mm-dd"});
 
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
			url:"/business/get-enquiry",
			data:function(d){
				d.page = (d.start/d.length)+1;
				d.search['leaddf']=$('*[name="search[leaddf]"]').val();
			    d.search['leaddt']=$('*[name="search[leaddt]"]').val();	
				d.columns = null;
				d.order = null;
			},
			dataSrc:function(json){
			    recordCollection = json.recordCollection; 
			    return json.data;
		    }
		}
	}).api();
	
	
	var dataTableViewAllkeywords = $('#datatable-assigned-keywords').dataTable({
		"fixedHeader": true,
		"processing":true,
		"serverSide":true,
		"paging":true,
		"responsive":true,
		"searching":false,
		"ajax":{
			url:"/business/get-paginated-assigned-keywords",
			data:function(d){
				d.page = (d.start/d.length)+1;
				d.columns = null;
				d.order = null;
			}
		}
	}).api();
 
 

	var dataTableViewAllhistory = $('#datatable-payment-billing-history').dataTable({
		"fixedHeader": true,
		"processing":true,
		"serverSide":true,
		"paging":true,
		"responsive":true,
		"searching":false,
		"ajax":{
			url:"/business/get-billing-history",
			data:function(d){
				d.page = (d.start/d.length)+1;
				d.columns = null;
				d.order = null;
			}
		}
	}).api();
	
	
	
	$(document).on('click','#invoiceBillingPdf',function(e){
	  
		var THIS = $(this);

		var id   = THIS.data('sid'); 
			$.ajax({
			url:"/business/getinvoiceBillingPrintPdf",
			type:"GET",			
			data:{action:'getinvoicePrintPdf',pid:id},
			 
			success: function(response) {        		
				var printWindow = window.open('', '', 'width=700,height=500');
				printWindow.document.write(response);
				return false;

			}

			});	 

	}); 
	
	
  /**
   * Autoresize echart charts
   */
  const mainContainer = select('#main');
  if (mainContainer) {
    setTimeout(() => {
      new ResizeObserver(function() {
        select('.echart', true).forEach(getEchart => {
          echarts.getInstanceByDom(getEchart).resize();
        })
      }).observe(mainContainer);
    }, 200);
  }
  
 
  function removeValidationErrors($this){
      
      $this.find('.form-group').removeClass('has-error');
      $this.find('.help-block').remove(); 
      
      
  }
    function showValidationErrors($this,errors){
        $this.find('.form-group').removeClass('has-error');
        $this.find('.help-block').remove(); 
        for (var key in errors) { 
            if(errors.hasOwnProperty(key)){ 
                var el = $this.find('*[name="'+key+'"]');
                $('<span class="help-block"><strong>'+errors[key][0]+'</strong></span>').insertAfter(el); el.closest('.form-group').addClass('has-error'); 
            }    
        
        }
    }
  $(document).ready(function(){
  
  
   $('.leaddf').daterangepicker();

});
  
  
/*
})(); */