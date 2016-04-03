<?php

//Starting Session
session_start ();
error_reporting(0);

//Requiring All Connections and Functions
require 'database/connect.php';
require 'functions/security.php';
require 'functions/general.php';
require 'functions/users.php';
require 'functions/messages.php';
require 'functions/posts.php';

//Storing User Information in Variable
if (logged_in() === true) {
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'password', 'first_name', 'other_names', 'last_name', 'email', 'custom_url', 'friends');
		if (user_active($user_data['email']) === false) {
			session_destroy();
			header('location:logout.php');
			exit();
		}
}


//Arrays that are used to store information
$errors 	= array();
$messages 	= array();
$sender		= array();

?>