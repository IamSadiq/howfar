<?php require("../templates/header.php"); include_user_navbar(); require('../controllers/user_ctrl.php'); ?>

<link  rel="stylesheet" type="text/css" href="../assets/css/user-profile.css">
<div class="well"><br/><br/>
	<center>
	<div id = "edit_profile_div" style='margin-left: 0;'>
		<div id = "profile_div">
			<div>
				<a id = "user_photo" href="#">
				    <?php  fetch_pic($pic, 250, 250);?>
				</a>
	    	</div>
	    	<div style = "color: green;font-weight:bold;">
				<h3 ><?php echo $uname . "<br/>";?></h3>
			    <a href = "#"><?php echo "E-mail: " . $email;?></a>
			</div>   
		</div>
		<blockquote>
			<?php echo $bio; ?>
		</blockquote>
	</div>
	</center>
</div>

<?php
require("../templates/footer.php");
?>