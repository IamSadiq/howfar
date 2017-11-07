<?php
	require('functions.php');

	function validate_email($email){

		global $email_is_valid;
	    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	    { 
	     	$email_is_valid=0;
	    }
	    else
	    {
	     	$email_is_valid = 1;
	    }
	}

	if(isset($_POST['email']) && $_POST['email'] !=""){

		$email = $_POST['email'];
		validate_email($email);

		if ($email_is_valid) {
				
			// db connection
			db_connect();

			$email = $db_instance->real_escape_string($_POST['email']);
			$sql = "SELECT * FROM users WHERE email = '$email'";
			$results = $db_instance->query($sql);

			if ($show = $results->fetch_assoc()) {
				echo $show["email"] . " is already registered";
			}
			else{
				echo $email . " is Ok";
			}
		}
		else{
			echo $email . " is NOT a valid E-mail address";
		}
	}

	if(isset($_POST['pword1']) && $_POST['pword1'] !=""){
		$pword1 = $_POST['pword1'];
		if (strlen($pword1) < 6) {
			echo "password's too weak";
		}
		else if(strlen($pword1) >= 6 && strlen($pword1) < 10){
			echo "fair";
		}
		else
		{
			echo "strong enough";
		}
	}


	if(isset($_POST['pword2']) && $_POST['pword2'] !="" && isset($_POST['pword1']) && $_POST['pword1'] !=""){
		$pword1 = $_POST['pword1'];
		$pword2 = $_POST['pword2'];
		if ($pword2 != $pword1) {
			echo "Passwords Don't Match</span>";
		}
	}

	// Redirect to login_register.php after 3seconds
	header("refresh:3;url=../auth/login_register.php");

?>