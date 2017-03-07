<?php
	session_start();
	echo 'Welcome '.$_SESSION['name'].' your username: '.$_SESSION['username'].' was created with a password of '.$_SESSION['password'].' and a hash of '.$_SESSION['hash']." <br>";
	echo "The create user script is working.";
	exit;
?>
