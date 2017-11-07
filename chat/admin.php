<?php 
/**
* 
*/

class Admin
{
	var $username;

	//konstruktur
	function Admin()
	{
		//$this->set_user($username);
	}

	function user_isAdmin($username){
		db_connect();
		global $db_instance;
		$sql = "SELECT * FROM users WHERE username = '$username' AND isAdmin = 1";
		$results = $db_instance->query($sql);

		if ($show = $results->fetch_assoc())
			return 1;
		else
			return 0;
	}

	function set_user($username){
		$this->$username = $username;
	}

	function get_user(){
		return $this->$username;
	}

	public function Block_user($username){
		db_connect();
		global $db_instance;
	
		if($this->user_isAdmin($username))
			echo $username . " is Admin";
		else{
			$sql = "SELECT * FROM users WHERE username = '$username' AND Blocked = 0";
			$results = $db_instance->query($sql);
			if ($show = $results->fetch_assoc()) {
				$sql = "UPDATE users SET Blocked = 1 WHERE username = '$username'";
				if ($db_instance->query($sql)) {
					echo $username . " has been blocked";
				}
			}
			else
			{
				$sql = "SELECT * FROM users WHERE username = '$username'";
				$results = $db_instance->query($sql);
				if ($show = $results->fetch_assoc())
					echo $username . " is already blocked";
				else
					echo "No such user";
			}
		}
	}

	public function unBlock_user($username){
		db_connect();
		global $db_instance;
		if($this->user_isAdmin($username))
			echo $username . " is Admin";
		else{
			$sql = "SELECT * FROM users WHERE username = '$username' AND Blocked = 1";
			$results = $db_instance->query($sql);
			if ($show = $results->fetch_assoc()) {
				$sql = "UPDATE users SET Blocked = 0 WHERE username = '$username'";
				if ($db_instance->query($sql)) {
					echo $username . " has been unblocked";
				}
			}
			else
			{
				$sql = "SELECT * FROM users WHERE username = '$username'";
				$results = $db_instance->query($sql);
				if ($show = $results->fetch_assoc())
					echo $username . " is already unblocked";
				else
					echo "No such user";
			}
		}
	}

}
?>


<?php
$sql = "SELECT * FROM users WHERE username = '$username' AND isAdmin = 1";

$results = $db_instance->query($sql);
if ($show = $results->fetch_assoc()) {
?>
<style type="text/css">
	#admin_props{background-color: silver;padding-bottom: 1%;width:100%;border: 1px solid;font-weight: bold;}
	#admin_h4{font-weight: bold;}
	.admin_inputs{border: 1px solid;}
</style>
<div id ="admin_props">
    <H4 id ="admin_h4">Admin Privileges</H4>
    <form method="post">
      	<input type='submit' value='Block' name='blockBtn' class = "admin_inputs">
      	<input type='text' name='usertoblock' class = "admin_inputs" placeholder='username' >

        <input type='submit' value='unBlock' name='unblockBtn' class = "admin_inputs">
        <input type='text' name='usertounblock' class = "admin_inputs" placeholder='username'>
    </form>
</div>

<?php
	$admin = new Admin;
				
	if (isset($_POST["blockBtn"]) && $_POST["usertoblock"] != "") {
		$username = $db_instance->real_escape_string($_POST["usertoblock"]);
		//$admin->set_user($_POST["usertoblock"]);
		$admin->Block_user($username);
	}

	if (isset($_POST["unblockBtn"]) && $_POST["usertounblock"] != "") {			
		$username = $db_instance->real_escape_string($_POST["usertounblock"]);			
		//$admin->set_user($_POST["useruntoblock"]);			
		$admin->unBlock_user($username);			
	}	
}
else
{
	?>
	<style type="text/css">#admin_props {visibility: hidden;display: none;}</style>
	<?php
}

$db_instance->close();

?>