<!--Footer-->
<footer>
<!--tutotials-list-box-->
   <section class="address-box">
      <div class="container">
         <!--col-md-4-->
         <div class="col-md-4 col-sm-4">
            <div class="head-office clearfix">
               <div class="head-icon-box">
                  <i class="fa fa-globe"></i>
               </div>
               <div class="head-info-box">
                  <h4>Head Office</h4>
                  <p>
                     <span>Quick India</span><br>
                     <span>Pillar No.33, NH-19, opposite flyover, Faridabad, New Delhi,<br>(India)<br></span><br>
                  </p>
               </div>
            </div>
         </div>
         <!--col-md-4-->
         <!--col-md-4-->
         <div class="col-md-4 col-sm-4">
            <div class="contact-box clearfix">
               <div class="contact-icon-box">
                  <i class="fa fa-phone"></i>
               </div>
               <div class="contact-info-box">
                  <h4>Call Us</h4>
                  <table>
                     <tbody><tr>
                        <td><span class="">For Enquiry</span></td>
                        <td><span class="">: +91-120-232323</span></td>
                     </tr>
                     <tr>
                        <td><span class="">For Admission</span></td>
                        <td><span class="">: +91-2323232</span></td>
                     </tr>
                     <tr>
                        <td><span class="">For Placement</span></td>
                        <td><span class="">: +91-23232323</span></td>
                     </tr>
                     <tr>
                        <td><span class="">For Feedback</span></td>
                        <td><span class="">: +91-23232323</span></td>
                     </tr>
                  </tbody></table>
               </div>
            </div>
         </div>
         <!--col-md-4-->
         <!--col-md-4-->
         <div class="col-md-4 col-sm-4">
            <div class="Email-box clearfix">
               <div class="Email-icon-box">
                  <i class="fa fa-envelope"></i>
               </div>
               <div class="Email-info-box">
                  <h4>Email</h4>
                  <p>
                     <a href="mailto:info@quickindia.in">info@quickindia.in</a>							
                  </p>
                  <p>
                     <a href="mailto:hr@quickindia.in">hr@quickindia.in</a>							
                  </p>
                  <p>
                     <a href="mailto:admin@quickindia.in">admin@quickindia.in</a>							
                  </p>
                  <p>
                     <a href="mailto:feedback@quickindia.in">feedback@quickindia.in</a>							
                  </p>
               </div>
            </div>
         </div>
         <!--col-md-4-->			
      </div>
   </section>
   <!--address-box-->
   <!--links-resp-->
   <section class="links-resp">
         <div class="paybox">
         <div class="container">
            <div class="row">
               <div class="col-sm-4 col-md-4">
                  <!--follow-sticker-->
                  <div class="follow-sticker">
                     <h4 style="color:#FFF;margin-bottom:10px;padding-bottom:5px;border-bottom:1px solid #aaa;">Follow Us</h4>
                     <ul class="list-inline">
                        <li><a class="facebook" target="_blank" href="https://web.facebook.com/quickindia"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" target="_blank" href="https://twitter.com/quickindia"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="linkedIn" target="_blank" href="https://in.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                        <li><a class="youTube" target="_blank" href=""><i class="fa fa-google-plus"></i></a></li>
                     </ul>
                  </div>
                  <!--follow-sticker-->
               </div>
               <div class="col-sm-4 col-md-4">
                  <h4 style="color:#FFF;margin-bottom:10px;padding-bottom:5px;border-bottom:1px solid #aaa;">Subscribe to our Newsletter</h4>
					<form action="" method="POST" onsubmit="return newsLetter(this)">
					  <div class="input-group">
						 <input type="email" name="email" class="form-control" placeholder="Enter Email">
						 <span class="input-group-btn">
						  <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i></button>
						 </span>
					  </div>
					</form>
             </div>
             <div class="col-sm-4 col-md-4">
               <h4 style="color:#FFF;margin-bottom:10px;padding-bottom:5px;border-bottom:1px solid #aaa;">We Accept Online Payments</h4>            
               <img src="<?php echo asset('client/images/payments.png'); ?>" class="img-responsive" style="max-width:240px;">
            </div>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="copyright-box col-lg-5">
         <div class="row">
         <p>Copyright © 2010-2015 Croma Campus. All rights reserved.</p>
         </div>
      </div>
      <div class="disclaimer-box col-lg-7">
         <div class="row">
         <p>The certification names and logos are the trademarks of their respective owners. <a href="#">View Disclaimer</a></p>
         </div>
      </div>      
   </div>
</section>
<!--links-resp-->
</footer>

<!-- Bootstrap -->
<script type="text/javascript" src="<?php echo asset('client/js/bootstrap.min.js'); ?>"></script>
<!-- Select2 Core JS -->
<script src="<?php echo asset('vendor/select2/js/select2.full.js'); ?>"></script> 
<!--Important Plugin Please Don't Remove-->
<script type="text/javascript" src="<?php echo asset('vendor/validation/validation.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('client/js/plugin.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('client/js/script.js'); ?>"></script>
<!-- Blog Crowsel --> 
<script src="<?php echo asset('client/js/owl.carousel.js'); ?>"></script> 
<script>
            jQuery(document).ready(function() {
              jQuery('.owl-carousel').owlCarousel({
                loop: true,
				 autoplay:true,
    			autoplayTimeout:1000,
    			autoplayHoverPause:true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 2,
                    nav: true
                  },
                  600: {
                    items: 6,
                    nav: true
                  },
                  1000: {
                    items: 8,
                    nav: true,
                    loop: false,
                    margin: 10
                  }
                }
              })
            })
 </script>           
 <script>
jQuery(document).on('click', '.mega-dropdown', function(e) {
  e.stopPropagation();
})
</script>
<script>
	function tick1(){
		$('#ticker_01 li:first').slideUp( function () { $(this).appendTo($('#ticker_01')).slideDown(); });
		}
	setInterval(function(){ tick1 () }, 3000);
	
	function tick2(){
				$('#ticker_02 li:first').slideUp( function () { $(this).appendTo($('#ticker_02')).slideDown(); });
	}
	setInterval(function(){ tick2 () }, 3000);
	
	
	var w = jQuery(window).width();
	if (w > 768) {
	$(".navbar-default .navbar-nav > li > a").click(function(){
          $('html, body').animate({
                    scrollTop: $(".customnav").offset().top - 62+ "px"
           }, 1300);
       });
	}
	
</script>
<script>
	$( ".select2-single, .select2-multiple" ).select2( {
		theme: "bootstrap",
		placeholder: "Select a City",
		maximumSelectionSize: 6,
		containerCssClass: ':all:'
	} );
</script>
</body>
</html>