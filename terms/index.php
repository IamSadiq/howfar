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

<style type="text/css">
	#term_div {
		text-align:left;
		width:40%;
		border: 1px solid;
		padding:1%;
		color: white;
		opacity: 1.0;
		background-color:#323232;
		font-family:georgia;
	}
	#term_div_header{
		margin-top:-1%;
		text-align:center;
	}
	#bg {
		background-image: url("../assets/images/nature.png");
	}
	@media screen and (max-height: 950px) {
	#collapse_btn {visibility: hidden;display: none;}
	#term_div {	min-width: 300px;}

	}

	@media screen and (max-width: 768px) {
	#collapse_btn {visibility: hidden;display: none;}
	#term_div {	min-width: 300px;}

	}

	@media screen and (max-width: 500px) {
	#collapse_btn {visibility: visible;display: inline;}
	#term_div {	min-width: 95%;}

	}
</style>

<div id = "bg" class="container-fluid">
<br><br>
	<center style ="margin-top:3.5%;">

		<div id = "term_div">
			<h3 id ="term_div_header">Terms And Conditions</h3>
			<hr>
			<ul>
				<li><p>You must not buy or sell HowFar accounts.</p></li>
				<li><p>You must not create multiple accounts.</p></li>
				<li><p>You must not use bots, auto-clickers, or external scripts on the website.</p></li>
				<li><p>You must not post content, and use the website in a way that is hateful, threatening, or 
					pornographic.</li>
				<li><p>incites violence, or contains nudity or graphic or gratuitous violence;</p></li>
				<li><p>unlawful, misleading, malicious, or discriminatory.</p></li>
				<li><p>You must not upload viruses or other malicious code.</p></li>
				<li><p>You must not do anything that could disable, overburden, or 
				impair the proper working of HowFar.</p></li>
				<li><p>If we disable your account, you must not create another one.</p></li>
				<li><p>Anyone found to be breaking any of these will be removed from HowFar permanently.</p></li>
			</ul>
		</div>
	</center>
	<br>
</div>
<?php
include('../templates/footer.php');
?>