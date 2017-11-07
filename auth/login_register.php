<link  rel="stylesheet" type="text/css" href="assets/css/login_register.css">
<center>
	<header>
		<nav style = "color: white; font-style: italic">
			<h3>HowFar, we're delighted to have you!</h3>
		</nav>
	</header>
</center>
<body id = "background_div">
<article>
	<section>
		<center>
		<?php $username = ""; ?>
		<br>
		<span id="msg_span">
			<?php include("auth/login_register_validation.php"); ?>
		</span>
		<br>
		<div class="block loginDiv"> 
			<div class = "Login-Register-Header">
				<h3 style = "text-align: center; ">Login</h3>
			</div>
			
			<div class = "Login-Register-Body">
				<form name ="login" method = "post">
					<input type="text" class = "input" name="username" placeholder = "Email or Username" value = "<?php echo $username; ?>" required><br />
					<span></span><br />
					<input type="password" class = "input" name="password" placeholder = "Password" required><br />
					<span></span><br />
					<input type="submit" class = "input submitBtn" name="login" value="Access Account"/>
				</form>
				<span style = "color:white; padding-top: 1%;">Not a member? <b><a href = "#" id = "register"> JOIN NOW </a></b></span>
				<p><a href="forgot-password/">Forgot password</a></p>
			</div>
		</div>



		<div class="block registerDiv"> 
			<div class = "Login-Register-Header">
				<h3 style = "text-align: center;"class="block">Create an Account</h3>
				<span class="closeRegister block">x</span>
			</div>
			<div class = "Login-Register-Body">
				<form name = "signUp" method = "post" style = "padding-bottom: 20px;">
					<input type="text" class = "input" id ="email" name = "email" placeholder = "Email" onblur ="check_email()" required><br />
					<span style = "color:green" id = "email_error"></span><br />

					<input type="password" class = "input" id ="pword1" name = "pword1" onblur="check_pword()" placeholder = "Choose Password" required minlength="8"><br/>
					<span style = "color:green" id="pword1Error"></span><br />

					<input type="password" class = "input" id ="pword2" name = "pword2" onblur="confirm_pword()" placeholder = "Confirm Password" required minlength="8"><br/>
					<span style = "color:green" id="pword2Error"></span><br />
					<!--<input type="radio" name ="radio" required="required"><span style = "color:white"> Agree & accept</span><strong><a href="terms.php"> policy</a></strong><br />-->

					<input type= "submit" class = "input submitBtn" name= "signup" value= "Create Account"/>
				</form>
			</div>
		</div>
		<br><br><br>
		<strong><span style = "color: white">By Signing up you're are agreeing to our <a href="terms/">Terms and conditions</a></span></strong>
		</center>
		<br>
	</section>
</article>
<!-- MY CUSTOM SCRIPTS -->
<script type="text/javascript" src="assets/js/login_register.js"></script>
<noscript>
    This page is trying to run JavaScript and your browser either does not support JavaScript
    or you may have turned-off JavaScript. If you have disabled JavaScript on your computer, please 
    turn on JavaScript. Thank you
</noscript>