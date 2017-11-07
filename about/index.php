<?php
include('../templates/header.php');
if (!isset($_SESSION['username'])) {
	echo "<style type='text/css'>
			#navbar {visibility: hidden;display: none;}
			.general_nav {visibility: visible;display: inline;}
		  </style>";
}

if (isset($_SESSION['username'])) {
	//include_user_navbar();
}
?>

<br><br>
<div id = "backg" class='well'>
<h2 style = "margin-left:20%;">About Us</h2>
	<div style = "width:60%;margin-left:20%;border:1px solid;padding:2%; 
		border-radius:1%;background-color:#f2f9ff;">
		
		<p>
			<big>
				HowFar is a platform designed for social networking, business, marketing
				and user interactions. It still in its infancy stage and ideas are welcome to
				enable it grow and innovate with the ever continuously changing tech industry.
			</big>
		</p>
		<p>
			<big>
				HowFar is a platform designed for social networking, business, marketing
				and user interactions. It still in its infancy stage and ideas are welcome to
				enable it grow and innovate with the ever continuously changing tech industry.
			</big>
		</p>

	</div>
	<br /><br /><br />
</div>

<?php include('../templates/footer.php') ?>