<?php
require("../controllers/functions.php");

// db connection
db_connect();
global $lim_val, $offset_val;

	$sql = "SELECT * FROM chat_logs ORDER BY id DESC LIMIT $lim_val OFFSET $offset_val";
	$result = $db_instance->query($sql);	

	//date_default_timezone_set('Africa/Lagos');
	while ($show = $result->fetch_assoc()) 
	{
		$message = stripcslashes($show["message"]);
		$message = parseString($message);
		echo "<div class = 'user_name_div'>". fetch_pic($show["profile_pic"],25,25) . $show["username"] . "</div>" 
			. "<center>
				<div id = 'inner_msg_div'>" 
					. $message 
				."</div>
			   </center>"
			   ."<small id = msg_sent_date>" 
				 . $show["message_time"] 
			   ."</small><br />";  
	}


$db_instance->close();
?>