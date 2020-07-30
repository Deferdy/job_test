<?php
	session_start();
	$_SESSION = array();
	session_destroy();

	unset($_SESSION);

	unset($_COOKIE);

	header("Cache-Control: no-store, no-cache, must-revalidate");

	header("Location: espace.php");
