<?php session_start();require("../controllers/functions.php"); ?>
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
    <link href="../assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../assets/css/chat_log_div.css">
    
    <!-- JS | Scripts-->
    <script type="text/javascript" src = "../assets/js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src"../assets/js/index.js"></script>

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
            <a class="navbar-brand" href="../index.php">
                <span>H</span>OWFAR
            </a>
        </div>
        </div>
        
        <div id="navbar" class="navbar-collapse collapse nav_menu">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../profile/" id = "user_pic"></a></li>
            <li class = "general_nav" style ="font-weight:bold;"><a href="../chat/" id="chat_nav"></a></li>
            <li class = "general_nav" style ="font-weight:bold;"><a href="#">CONTACT</a></li>
            <li class = "general_nav" style ="font-weight:bold;"><a href="../about/">ABOUT</a></li>
            <li>
                <a href="../logout/">
                    <img id = "logout-btn" class='img-circle' src="../assets/images/menu_logo/logout.jpg" rel="logout-button">
                </a>
            </li>
          </ul>
        </div>
        
      </div>
    </nav>
    <script type="text/javascript">
      document.getElementById("user_pic").innerHTML = "<?php if (isset($_SESSION['pic'])) {fetch_pic($_SESSION['pic'],25,25);};?>";
      document.getElementById("chat_nav").innerHTML = "<?php if (isset($_SESSION['pic'])) {echo 'CHAT';};?>";
    </script>
</head>