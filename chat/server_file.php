<?php
require("../controllers/functions.php");
session_start();

// db connection
db_connect();

if (isset($_SESSION['username'])) 
{
	global $lim_val, $offset_val;

	//$name = htmlspecialchars($_SESSION['username']);
	//$message = htmlspecialchars($_GET['message']);

	/****************************************************************************/
	/******Preventing sql injection, using mysqli real escape string method******/
	/****************************************************************************/
	/**/   $name = $db_instance->real_escape_string($_SESSION['username']);     //
	/**/   $message = $db_instance->real_escape_string($_GET['message']);       //
	/****************************************************************************/
	/****************************************************************************/

	date_default_timezone_set('Africa/Nairobi');
	$time = date('h:i:s a', time());
	$time = date('h:i A', strtotime($time));
	//$time = date('Y-m-d h:m:s');
	//$time = date("h:mma 'on' MMM d, y");
	//$time = date("h:mma") . 'on' . date("MMM d, y");
	$sql = "INSERT INTO chat_logs(username, message, message_time, profile_pic) 
		VALUES('{$name}', '{$message}', '{$time}', '{$_SESSION["pic"]}')";

	//$db_instance->query($sql);
	if ($db_instance->query($sql)){
		//echo "Insertion Successful!!! ";
	}
	else
		echo "<span id 'sending_failed'>Unable to send message</span>";

	$sql = "SELECT * FROM chat_logs ORDER BY id DESC LIMIT $lim_val OFFSET $offset_val";
	
	if ($result= $db_instance->query($sql)) 
	{
		while ($show = $result->fetch_assoc()) 
		{
			$msg = stripcslashes($show["message"]);
			$msg = parseString($msg);
			echo "<div class = 'user_name_div'>". fetch_pic($show["profile_pic"],25,25) . $show["username"] . "</div>" 
				. "<center><div id = 'inner_msg_div'>" 
					. $msg 
				. "</div></center>"
				. "<small id = msg_sent_date>" 
					. $show["message_time"] 
				. "</small><br />"; 
		}
	}
	
}


$db_instance->close();
?>