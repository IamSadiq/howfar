<?php 
include("../templates/header.php");
global $page_num;

$page_num = "<script type='text/javascript'> getPageNum(); </script>";


if (!isset($_SESSION['username'])) 
	require_once("../auth/login_register.php");

/*******************************************************************************
*4 DEBUGGING PURPOSES,2 if conditns were used here instead of an if-else condtn* 
*cos if session NOT set it takes users to login & register page and afterwards,*
*in an if-else conditn,, it neva auto executes the ELSE conditn, unless  users *
*reload the homepage. We never want to force users to always do stuff, we      *
*developers should rather tweak to please them.                                *
********************************************************************************/

if (isset($_SESSION['username'])) {
	//include_user_navbar();

	// db connection
	db_connect();

	$username = $db_instance->real_escape_string($_SESSION['username']);

	$sql = "UPDATE users SET LoggedIn = 1 WHERE username = '$username'";
	$db_instance->query($sql);

	$sql = "SELECT * FROM users WHERE username = '$username' AND Blocked = 1";
	$results = $db_instance->query($sql);
	
	if ($show = $results->fetch_assoc()) {
		//echo "user is blocked";
?>
<script type="text/javascript">user_is_blocked = 1;</script>
<noscript>
	This page is trying to run JavaScript and your browser either does not support JavaScript
	or you may have turned-off JavaScript. If you have disabled JavaScript on your computer, please 
	turn on JavaScript. Thank you
</noscript>
<?php
}
else
{
?>
<script type="text/javascript">user_is_blocked = 0;</script>
<noscript>
	This page is trying to run JavaScript and your browser either does not support JavaScript
	or you may have turned-off JavaScript. If you have disabled JavaScript on your computer, please 
	turn on JavaScript. Thank you
</noscript>
<?php	
}

?>

<body>

<div id = "chat_bg" class="container-fluid background">

	<br /><br />
	<div id = "menu_div_encloser" class = "menu-users-div">
		<div  id = "menu_div" >
	        <ul class="nav nav-sidebar">
	        	<li><a href="#">Voice Call<p><img src="../assets/images/menu_logo/call.png"></p></a></li>
	            <li><a href="#">SMS<p><img src="../assets/images/menu_logo/sms.jpg"></p></a></li>
	            <li><a href="#">Video Chat<p><img src="../assets/images/menu_logo/videoChat.png"></p></a></li>
	            <li><a href="#">Private Chat<p><img src="../assets/images/menu_logo/pc.png"></p></a></li>
	        </ul>
	    </div>
	</div>

	    <div id = "users_div" class="menu-users-div">
	        <div id = "online_users_encloser">
	        	<span class = "online-offline-span">ONLINE</span><br>
	        	<div id = "online_users">
		    		<center><img src="../assets/images/load1.gif"></center>
	        	</div>
	        </div>

	        <br><br>
	        <div id = "offline_users_encloser">
	        	<span class = "online-offline-span">OFFLINE</span><br>
	        	<div id = "offline_users">
		    		<center><img src="../assets/images/load1.gif"></center>
	        	</div>
	        </div>
	    </div>

		<center>			
      	
		<div id = "encloser">
			<div id ="mobile_menu">
				<div class="block mobile_menu_icon"><a href="#"><img class="menu_icon" src="../assets/images/menu_logo/call.png"></a></div>
	            <div class="block mobile_menu_icon"><a href="#"><img class="menu_icon" src="../assets/images/menu_logo/sms.jpg"></a></div>
	            <div class="block mobile_menu_icon"><a href="#"><img class="menu_icon" src="../assets/images/menu_logo/videoChat.png"></a></div>
	            <div class="block mobile_menu_icon"><a href="#"><img class="menu_icon" src="../assets/images/menu_logo/chat.jpg"></a></div>
	            <hr>
	        </div>

	        <div id = "msg_div_encloser">
		        <?php
					echo "<span id ='welcome_user' class ='pop_up_msgs'>Welcome ".$username."</span>";
					require('admin.php');			
				?>
		        
		        <br/>
		        
				<!-- ****************************INPUT MESSAGE *********************************-->
				<div id = "msg_div">
					<span id ="empty_msg_span" class ="pop_up_msgs">Can't send blank messages</span>
					<form name = "chat_form">
						<input type="text" name="msg" id="msg_input_field" value="" class="textbox" 
						autocomplete="off" placeholder="Enter message here..." />
						<img id="emoticon_dropper" src="../assets/emoticons/sadsmile.gif" alt="" />
						<img id="emoticon_undropper" src="../assets/emoticons/smile.gif" alt="" />
						<input type = "submit" name="submit_btn" onclick = "submit_chat()" value = "Send" id ="send_btn" /><br /><br />
						<div id="emoticon_box"><?php echo show_emoticons(); ?></div>
					</form>
				</div>
			</div>
			
			<br /><br />
			
			<div id ="chat_logs_encloser">
				<div id ="chat_logs">
					<center>
						<h4>PLEASE WAIT</h4>
						<img src="../assets/images/load1.gif">
					</center>
				</div>
			</div>	
			
			<br />
			<button id ="load_more_span" class="btn" onclick = "pageCounter()">  Load Older </button>
		</div>
		</center>
</div>

<script type="text/javascript" src = "../assets/js/ajax.js"></script>
<script type="text/javascript" src = "../assets/js/functions_script.js"></script>
<noscript>
	This page is trying to run JavaScript and your browser either does not support JavaScript
	or you may have turned-off JavaScript. If you have disabled JavaScript on your computer, please 
	turn on JavaScript. Thank you
</noscript>

<script type="text/javascript" data-cfasync="false">
        var websiteConfig = websiteConfig || {};
        websiteConfig.address = '../index.php';
        websiteConfig.apiUrl = '../api.json';
        websiteConfig.preferredLanguage = 'en';
                websiteConfig.back_to_top_button = {"enabled":true,"topOffset":300,"animationTime":500};
                angular.module('website.plugins', []);
</script>
<?php 
}
include("../templates/footer.php");
?>
