<?php
	session_start();
	require "admin/dbcon.php";
	require_once "functions.php";
	$user = new login_registration_class();
	$user->admin_logout();
	header('Location: index.php');
	exit();
?>