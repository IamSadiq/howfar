<?php

require('../controllers/functions.php');

// db connection
db_connect();
$users_name = array();

	// Displaying users
	$sql = "SELECT * FROM users WHERE LoggedIn = 0 ORDER BY id DESC LIMIT 10";
	if ($result= $db_instance->query($sql)) 
	{
		// Diplay users
		while ($show = $result->fetch_assoc()) 
		{
			$users_pic = $show["profile_pic"];
			$users_name = $show["username"];

			echo "<a href='view_user.php?uname=$users_name' class = 'each-user'>" . fetch_pic($users_pic, 32, 32) . " " . $users_name . "</a><br><br>";
		}
		
	}


$db_instance->close();

?>