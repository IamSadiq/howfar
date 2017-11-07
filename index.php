<?php session_start();require("controllers/functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="HowFar is a massive online chatroom">
    <meta name="author" content="Abubakr Siddique">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php printTitle(); ?></title>

    <!-- CSS | Styles-->
    <link href="assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/chat_log_div.css">
    
    <!-- JS | Scripts-->
    <script type="text/javascript" src = "assets/js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src"assets/js/index.js"></script>

    <nav id = "header" class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" id = "collapse_btn" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <div id ="web-name">
            <a class="navbar-brand" href="index.php">
                <span>H</span>OWFAR
            </a>
        </div>
        </div>
        
        <div id="navbar" class="navbar-collapse collapse nav_menu">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="profile/" id = "user_pic"></a></li>
            <li class = "general_nav" style ="font-weight:bold;"><a href="chat/" id = "chat_nav"></a></li>
            <li class = "general_nav" style ="font-weight:bold;"><a href="contact/">CONTACT</a></li>
            <li class = "general_nav" style ="font-weight:bold;"><a href="about/">ABOUT</a></li>
            <li>
                <a href="logout/">
                    <img id = "logout-btn" class='img-circle' src="assets/images/menu_logo/logout.jpg" rel="logout-button">
                </a>
            </li>
          </ul>
        </div>
        
      </div>
    </nav>
    <script type="text/javascript">
      document.getElementById("user_pic").innerHTML = "<?php if (isset($_SESSION['pic'])) {fetch_pic($_SESSION['pic'],25,25);};?>";
    </script>
</head>

<?php

if (!isset($_SESSION['username']))
	require_once("auth/login_register.php");

/*******************************************************************************
**********************************VERY IMPORTANT********************************
********************************************************************************
*4 DEBUGGING PURPOSES,2 if conditns were used here instead of an if-else condtn* 
*cos if session NOT set it takes users to login & register page and afterwards,*
*in an if-else conditn,, it neva auto executes the ELSE conditn, unless  users *
*reload the homepage and we dnt want to count on that.                         *
********************************************************************************/

if (isset($_SESSION['username'])) {
?>

<body>
	<link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="assets/css/carousel.css">

	<style type="text/css">
		#bgd {margin-top: 1%;font-family: georgia;}
		#menu_div {background-color: white; border: none;}
	</style>

	<script type="text/javascript">
		document.getElementById("user_pic").innerHTML = "<?php fetch_pic($_SESSION['pic'], 25, 25); ?>";
        document.getElementById("chat_nav").innerHTML = "<?php if (isset($_SESSION['pic'])) {echo 'CHAT';};?>";
	</script>

<?php
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

<center id='bgd' >
<div  id = "menu_div">
	<div class="block mobile_menu_icon"><a href="call/">Voice Call<p><img src="assets/images/menu_logo/call.png"></p></a></div>
	<div class="block mobile_menu_icon"><a href="call/">SMS<p><img src="assets/images/menu_logo/sms.jpg"></p></a></div>
	<div class="block mobile_menu_icon"><a href="#">Video Chat<p><img src="assets/images/menu_logo/videoChat.png"></p></a></div>
	          
	<div class="block mobile_menu_icon"><a href="#">Add Room</a></div>
	
</div>

<div id ="mobile_menu">
	<div class="block mobile_menu_icon"><a href="call/"><img class="menu_icon" src="assets/images/menu_logo/mobile/call.png" alt="call"></a></div>
	<div class="block mobile_menu_icon"><a href="sms/"><img class="menu_icon" src="assets/images/menu_logo/mobile/sms.jpg" alt="sms"></a></div>
	<div class="block mobile_menu_icon"><a href="#"><img class="menu_icon" src="assets/images/menu_logo/mobile/videoChat.png" alt="video call"></a></div>
	<div class="block mobile_menu_icon"><a href="#"><img class="menu_icon" src="assets/images/menu_logo/mobile/chat.jpg" alt="private chat"></a></div>
	<hr>
</div>

<!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class=""></li>
        <li class="active" data-target="#myCarousel" data-slide-to="1"></li>
        <li class="" data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item">
          <img class="first-slide img-responsive" src="assets/images/cloud_view.png" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Chat Forum</h1>
              <p>Get a chance to network, meet new friends, buddies</p>
            </div>
          </div>
        </div>
        <div class="item active">
          <img class="second-slide img-responsive" src="assets/images/LA.png" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>News</h1>
              <p>Keep in touch with the world. Weather, politics, sports etc.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide img-responsive" src="assets/images/nature.png" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>What's new</h1>
              <p>Find out what's what and what's new, share work, discoveries, inventions etc.</p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->


	<!-- Sections | Departments -->
	<div id ="rooms" class="container row">
    	<!--<div class="well"><h4>Placeholder</h4></div>-->
    </div>
 </center>

 <script type="text/javascript" src = "assets/js/ajax.js"></script>
<script type="text/javascript" src = "assets/js/functions_script.js"></script>
<noscript>
	This page is trying to run JavaScript and your browser either does not support JavaScript
	or you may have turned-off JavaScript. If you have disabled JavaScript on your computer, please 
	turn on JavaScript. Thank you
</noscript>

<script type="text/javascript" data-cfasync="false">
        var websiteConfig = websiteConfig || {};
        websiteConfig.address = 'index.html';
        websiteConfig.apiUrl = 'api.json';
        websiteConfig.preferredLanguage = 'en';
                websiteConfig.back_to_top_button = {"enabled":true,"topOffset":300,"animationTime":500};
                angular.module('website.plugins', []);
</script>

<?php 
}
?>


	<footer>
		<center style= "background-color: white">
			<h4 style = "opacity: 0.025;cursor:default;">Abubakar Siddique</h4>
				<strong>HowFar&copy; 2017. All rights reserved <br>
				<strong><a href="terms/">Terms and conditions</a></strong>
		</center>
	</footer>
<!--
	<script type="text/javascript" src = "js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src"js/index.js"></script>
	<noscript>
	    This page is trying to run JavaScript and your browser either does not support JavaScript
	    or you may have turned-off JavaScript. If you have disabled JavaScript on your computer, please 
	    turn on JavaScript. Thank you
	</noscript>
-->
	</body> 
	<!--
		<svg style="visibility: hidden; position: absolute; top: -100%; left: -100%;" preserveAspectRatio="none"
		viewBox="0 0 200 200" height="200" width="200"><defs></defs><text style="font-weight:bold;font-size:10pt;
		font-family:Arial, Helvetica, Open Sans, sans-serif;dominant-baseline:middle" y="10" x="0">200x200</text>
		</svg>
	-->
	</html>