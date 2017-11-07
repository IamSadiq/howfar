<?php include("../templates/header.php"); 

if (!isset($_SESSION['username'])) {
	echo "<style type='text/css'>
			#navbar {visibility: hidden;display: none;}
			.general_nav {visibility: visible;display: inline;}
		  </style>";
}

if (isset($_SESSION['username'])){
	include_user_navbar();
}

?>

<link  rel='stylesheet' href='../assets/css/login_register.css'>

<style type="text/css">
	.users_nav {visibility: hidden;display: none;}
	#bg{
			background-image: url('images/nature.png');
		  	height: inherit;
		  	margin-top: 1%;
		  	padding: 8%;
		}

	#input-form{
		 	border: 1px solid;
		  	width: 40%;
		  	color: white;
		  	height: 35%;
		  	background-color: #323232;
		  	opacity: 1.0;
		  	padding: 2%;
		}

		#msg-span{
			width: 40%;
			color: white;
			font-weight:bold;
			font-family: georgia;
		}

		#reset-pword-span {
			color: white;
			font-weight: bold;
			padding: 1%;
		}

		#email_input{color: #000;font-weight: bold;width: 70%;}
		#send_btn{color: #000;font-weight: bold;width: 70%;}

		@media screen and (max-width: 500px) {
			#collapse_btn {visibility: visible;display: inline;}
			#msg-span{min-width: 80%;}
			#input-form{min-width: 80%;}

		}

		@media screen and (max-width: 768px) {
			#collapse_btn {visibility: visible;display: inline;}
			#msg-span{min-width: 80%;}
			#input-form{min-width: 80%;}

		}
</style>

<div id = "bg">
	<br><br>
	<center>
		<span id = "reset-pword-span"><?php  validate(); ?></span><br><br>
		<div id = "input-form" method = "post">
			<span id = "msg-span">Enter your registered email below, a link to reset your password will be sent to you shortly after</span><br>
			<form name = "pword-reset" method = "post">
				<input type="text" name="email" id="email_input" class = "input" required="required"  autocomplete="on" placeholder="Enter registered email" /><br>
				<input type="submit" name = "btn"  id = "send_btn" value = "Reset Password" class = "input" >
			</form>
		</div>
	</center>
</div>

<?php 
//$db_instance->close();


function validate(){

	if(isset($_POST['btn']) && isset($_POST['email']) && $_POST['email'] !="") {

		global $db_instance;
		$email_is_valid = 0;
		$email = $_POST['email'];

		//check email validity
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			$email_is_valid=0;
		else				    
			$email_is_valid=1;

		if ($email_is_valid) {

			// db connection
			db_connect();
						
			$email = $db_instance->real_escape_string($_POST['email']);
			$sql = "SELECT * FROM users WHERE email = '$email'";
			$results = $db_instance->query($sql);

			if ($show = $results->fetch_assoc()) {
				$lost_hashed_password = $show["password"];
		
				mail($email, "Hashed password recovered", 
					"Your lost password <br> Password: " . $lost_hashed_password . 
						"<br> If you didn't request this, discard it. Your password is secured");
				/*$name = "sid";
				$email_address = "hello@magana.com";
				$phone = "33774477";
				$message = "hello sid";

								// Create the email and send the message
				$to = 'asiddik5@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
				$email_subject = "Website Contact Form:  $name";
				$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
				$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
				$headers .= "Reply-To: $email_address";	
				mail($to,$email_subject,$email_body,$headers);*/

				echo "A reset link has been sent to your mail";
			}
			else
			{
				echo $email . " is not registered";
			}
		}
		else
		{
			echo $email . " is not a valid address";
		}
	}
}								    				    									
include("../templates/footer.php");
 ?>