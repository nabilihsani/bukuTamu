<?php 
	session_start();
	unset($_SESSION["loggedin"]);
	
	$url = "\PKL\login.php";
	if (isset($_GET["session_expired"])) {
		$url .= "?session_expired=" . $_GET["session_expired"];
	}
	header("location: $url");
 ?>