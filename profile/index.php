<?php include("../templates/header.php"); ?>

<body>
	<link  rel="stylesheet" type="text/css" href="../assets/css/login_register.css">
	<link  rel="stylesheet" type="text/css" href="../assets/css/user-profile.css">

<?php
if (!isset($_SESSION['username'])) 
	require_once("../auth/login_register.php");

if (isset($_SESSION['username'])) {

	// db connection
	db_connect();

	require("bio-update.php");
?>

<div id='bg' class='well'>

<br><br>
<center style = "margin-top:3%;">
	<span style = "color:#000;padding:1%;font-weight:bold;">
		<?php if(isset($_POST["upload_btn"])){require("upload_image.php");}?>
	</span>
	<span id ="msg_span">
		<?php require('profile_setting.php'); ?>
	</span>
</center>

<!--************************PROFILE************************BIO***************AREA***************-->
<br>
	<div id = "edit_profile_div">
		<div id = "profile_div">
			<div>
			    <a id = "user_photo" href="#">
			    	<?php  fetch_pic($_SESSION['pic'], 180, 180);?>
			    </a>
    		</div>
    		<div style = "color: green;font-weight:bold;">
		    	<h3 ><?php echo $_SESSION['username'] . "<br/>";?></h3>
		    	<a href = "#"><?php echo "E-mail: " . $_SESSION['email'];?></a>
			</div>   
		</div>

		<form id="bio-form" method="post">
			<textarea name  = "textarea" id  = "bio-textarea" placeholder="My Biography..."></textarea>
			<input name="bio-btn" style = "width: 100%;cursor:pointer;height: 40px;" 
				type = "submit" class = "input" value ="Update Bio">
		</form>	
	</div>

<br />

<h4 id = "update-reminder"> Update your Biography. Increase your profile strength</h4>
<br>

<!--************************PROFILE************************SETTINGS***************AREA***************-->
	<div id = "profile-settings">
		<center style = "padding:5%;">
			<h4 style = "padding-bottom:2%;" >PROFILE SETTINGS</h4>
			<hr>
			<span style = "float:left; margin-left: 15%;">Change Username</span>
			<form name = "change_uname" method = "post" style = "padding-bottom:1%;color:#000;">
				<input type="text" class = "input" name = "newusername" placeholder = "New username" required/><br />

				<input type="password" class = "input" name = "pword" placeholder = "Enter Password to confirm" required maxlength="18"/><br/>

				<input type= "submit" class = "input submitBtn" name= "change_uname" value= "Change" onClick = ""/>
			</form>
			<br>

			<span style = "float:left; margin-left: 15%;">Change Password</span>
			<form name = "change_pword" method = "post"  style = "color:#000">
				<input type="password" class = "input" name = "oldpword" placeholder = "Old Password" required maxlength="18"/><br/>

				<input type="password" class = "input" name = "newpword" placeholder = "New Password" required maxlength="18"/><br/>

				<input type= "submit" class = "input submitBtn" name= "change_pword" value= "Change" onClick = ""/>
			</form>
		</center>
	</div>
<br>
<!--************************USERS************************PHOTOS***************AREA*******************-->

	<div id = "encloser-div">
		<div id = "my-photos">
			<center><h4>ALL PHOTOS</h4></center>
			<hr>
			<?php  fetch_user_pics(90, 90);?>
		</div>
		<div id = "make-upload-div">
			<form  method = "post" enctype="multipart/form-data">
				<input type='FILE' name='fileToUpload' id='fileToUpload' class = "upload-input" required>
		    	<input type='submit' id = "upload-button" value='Upload' name='upload_btn' class = "upload-input btn-success">
		    </form>
		</div>
	</div>

<br>
<!--*****************************BIOGRAPHY************************************ -->
	<div id = "bio-div">
		<h4 style = "text-align:center;">BIOGRAPHY</h4>
		<hr>
		<p>
			<!--It was July 23rd 1901 and after 15 years of a non-stop pursuit and tracking down, 
			the world’s most notorious outlaws had finally being caught and locked away for 
			good, and it was on this day that I was born. My name, Jack Byte. -->
			<?php if(!is_null($user_bio)) echo $user_bio; ?>
		</p>
	</div>
	<br><br><br><br>
</div>

<!--**************************HANDLING IMAGE ONCLICK EVENTS***********************-->
<script type="text/javascript" src = "../assets/js/user-profile.js"></script>
<noscript>
    This page is trying to run JavaScript and your browser either does not support JavaScript
    or you may have turned-off JavaScript. If you have disabled JavaScript on your computer, please 
    turn on JavaScript. Thank you
</noscript>

<?php
	$db_instance->close();
}
include("../templates/footer.php");
?>