<?php 
require('top.php');
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']=='yes'){
	?>
	<script>
	window.location.href='admin/index.php';
	</script>
	<?php
}
?>        
		<!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Login</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="login-form" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
										</div>
										<span class="field_error" id="login_email_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
										</div>
										<span class="field_error" id="login_password_error"></span>
									</div>
									
									<div class="contact-btn">
										<button type="button" class="fv-btn" onclick="user_login()">Login</button>
										<html>
											<head>
													<meta name="google-signin-client_id" content="1042604492585-ba73ota2srgr2phah8l15aa9fv4nbtdb.apps.googleusercontent.com">
													<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
											</head>
											<body>
													<?php
													if(isset($_SESSION['USER_ID'])){
															?>
															<a href="javascript:void(0)" onclick="logout()">Logout</a>
															<?php
													}else{
															?>
															<div class="g-signin2" data-onsuccess="gmailLogIn"></div>
															<?php
													}
													?>
													
													<script>
													
													function logout(){
														var auth2 = gapi.auth2.getAuthInstance();
														auth2.signOut();  
														jQuery.ajax({
																	url:'logout.php',
																	success:function(result){
																			window.location.href="index.php";
																	}
															});
														
													}
													
													function onLoad(){
														gapi.load('auth2',function (){
																gapi.auth2.init();
														}); 
													}
													
													function gmailLogIn(userInfo){
															var userProfile=userInfo.getBasicProfile();
															
															
															jQuery.ajax({
																	url:'login_check.php',
																	type:'post',
																	data:'id='+userProfile.getId()+'&name='+userProfile.getName()+'&email='+userProfile.getEmail(),
																	success:function(result){
																			window.location.href="index.php";
																	}
															});
													}
													</script>
													
													<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
											</body>
									</html>
										<a href="forgot_password.php" class="forgot_password">Forgot Password</a>
									</div>
								</form>
								<div class="form-output login_msg">
									<p class="form-messege field_error"></p>
								</div>
							</div>
						</div> 
                
				</div>
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Register</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="register-form" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
										</div>
										<span class="field_error" id="name_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="email" id="email" placeholder="Your Email*" style="width:45%">
											
											
											<button type="button" class="fv-btn email_sent_otp height_60px" onclick="email_sent_otp()">Send Verification Code</button>
											
											<input type="text" id="email_otp" placeholder="OTP" style="width:45%" class="email_verify_otp" required>
											
											
											<button type="button" class="fv-btn email_verify_otp height_60px" onclick="email_verify_otp()">Verify</button>
											
											<span id="email_otp_result"></span>
										</div>
										<span class="field_error" id="email_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
										</div>
										<span class="field_error" id="password_error"></span>
									</div>
									
									<div class="contact-btn">
										<button type="button" id="btn_register" disabled class="fv-btn" onclick="user_register()">Register</button>
									</div>
								</form>
								<div class="form-output register_msg">
									<p class="form-messege field_error"></p>
								</div>
							</div>
						</div> 
                
				</div>
					
            </div>
        </section>
		<input type="hidden" id="is_email_verified"/>
	<script>
		function email_sent_otp(){
			jQuery('#email_error').html('');
			var email=jQuery('#email').val();
			if(email==''){
				jQuery('#email_error').html('Please enter email id');
			}else{
				jQuery('.email_sent_otp').html('Please wait..');
				jQuery('.email_sent_otp').attr('disabled',true);
				jQuery.ajax({
					url:'send_otp.php',
					type:'post',
					data:'email='+email+'&type=email',
					success:function(result){
						if(result=='done'){
							jQuery('#email').attr('disabled',true);
							jQuery('.email_verify_otp').show();
							jQuery('.email_sent_otp').hide();
							
						}else if(result=='email_present'){
							jQuery('.email_sent_otp').html('Send OTP');
							jQuery('.email_sent_otp').attr('disabled',false);
							jQuery('#email_error').html('Email id already exists');
						}else{
							jQuery('.email_sent_otp').html('Send OTP');
							jQuery('.email_sent_otp').attr('disabled',false);
							jQuery('#email_error').html('Please try after sometime');
						}
					}
				});
			}
		}
		function email_verify_otp(){
			jQuery('#email_error').html('');
			var email_otp=jQuery('#email_otp').val();
			if(email_otp==''){
				jQuery('#email_error').html('Please enter OTP');
			}else{
				jQuery.ajax({
					url:'check_otp.php',
					type:'post',
					data:'otp='+email_otp+'&type=email',
					success:function(result){
						if(result=='done'){
							jQuery('.email_verify_otp').hide();
							jQuery('#email_otp_result').html('Email id verified');
							if(jQuery('#is_email_verified').val('1')){
								jQuery('#btn_register').attr('disabled',false);
							}
						}else{
							jQuery('#email_error').html('Please enter valid OTP');
						}
					}
					
				});
			}
		}
	</script>
<?php require('footer.php')?>        