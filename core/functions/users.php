<?php

//Total Users
function total_users () {
	$total_users_query = mysql_query("SELECT COUNT(`user_id`) FROM `users`");
	return mysql_result($total_users_query, 0);
}

//Get User Data
function user_data ($user_id) {
	$data 		= array ();
	$user_id 	= (int) $user_id;
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	if ($func_num_args > 1) {
		unset ($func_get_args[0]);
		
		$fields = '`'.implode('`, `', $func_get_args).'`';
		$user_data_query = mysql_query ("SELECT $fields FROM `users` WHERE `user_id` = '$user_id'");
		$data	= mysql_fetch_assoc($user_data_query);
		
		return $data;
	} 
}

//Logged in Check
function logged_in () {
	if (isset ($_SESSION['user_id'])) {
		return true;
	} else {
		return false;
	}
}

//User Exists Check
function user_exists ($email) {
	$email = sanitize ($email);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

//User Active Check
function user_active ($email) {
	$email 				= sanitize ($email);
	$user_active_query 	= mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `active` = 1");
	return (mysql_result($user_active_query, 0) == 1) ? true : false;
}

//Get ID Number from Email
function user_id_from_email ($email) {
	$email = sanitize($email);
	$user_id_from_email_query 	= mysql_query("SELECT `user_id` FROM `users` WHERE `email` = '$email'");
	return mysql_result($user_id_from_email_query, 0, 'user_id');
}

//Get First Name from Email
function first_name_from_email ($email) {
	$email = sanitize($email);
	$first_name_from_email_query = mysql_query("SELECT `first_name` FROM `users` WHERE `email` = '$email'");
	return mysql_result($first_name_from_email_query, 0, 'first_name');
}

//Get First Name from ID
function first_name_from_id ($user_id) {
	$user_id = sanitize($user_id);
	$first_name_from_id_query = mysql_query("SELECT `first_name` FROM `users` WHERE `user_id` = '$user_id'");
	return mysql_result($first_name_from_id_query, 0, 'first_name');
}

//Get Last Name from ID
function last_name_from_id ($user_id) {
	$user_id = sanitize($user_id);
	$last_name_from_id_query = mysql_query("SELECT `last_name` FROM `users` WHERE `user_id` = '$user_id'");
	return mysql_result($last_name_from_id_query, 0, 'last_name');
}

//Get Full Name from ID
function full_name_from_id ($user_id) {
	$user_id = sanitize($user_id);
	return first_name_from_id($user_id).' '.last_name_from_id($user_id);
}

//Get ID Number from Custom URL
function user_id_from_custom_url ($custom_url) {
	$custom_url 					= sanitize($custom_url);
	$user_id_from_custom_url_query 	= mysql_query("SELECT `user_id` FROM `users` WHERE `custom_url` = '$custom_url'");
	return mysql_result($user_id_from_custom_url_query, 0, 'user_id');
}

//Register
function register_user () {
	$register_email 		= sanitize($_POST['email']);
	$register_first_name 	= sanitize($_POST['first_name']);
	$register_last_name		= sanitize($_POST['last_name']);
	$register_password		= gen_encrypt($_POST['password']);
	$email_code				= md5($register_email + microtime());
	$custom_url				= rand(1000000000, 9999999999);
	
	$custom_url_query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `custom_url` = '$custom_url'");
	
	while (mysql_result($custom_url_query, 0) >= 1) {
		$custom_url	= rand(1000000000, 9999999999);
	}
	
	mysql_query("INSERT INTO `users` SET 
		`email` 		= '$register_email',
		`email_code`	= '$email_code',
		`first_name` 	= '$register_first_name',
		`last_name` 	= '$register_last_name',
		`password` 		= '$register_password',
		`custom_url`	= '$custom_url'
	");
	
	email($register_email, 'Activate your account', "
	Hello ".$register_first_name.",\n\nClick the link below to activate your account.\n\nhttp://localhost/LearningPHP/Form/activate.php?email=".$register_email."&email_code=".$email_code."\n\n-Oliver Crow");
}

//Activate User
function activate ($activate_email, $activate_email_code) {
	$activate_email 		= mysql_real_escape_string($activate_email);
	$activate_email_code 	= mysql_real_escape_string($activate_email_code);
	
	$activate_email_query 	= mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$activate_email' AND `email_code` = '$activate_email_code' AND `active` = 0");
	
	if (mysql_result($activate_email_query, 0) == 1) {
		mysql_query("UPDATE `users` SET `active` = 1 WHERE `email` = '$activate_email'");
	} else {
		return false;
	}
}

//Change Name
function change_name ($user_id, $new_first_name, $new_other_names, $new_last_name) {
	$user_id 			= (int)$user_id;
	$new_first_name 	= sanitize($_POST['new_first_name']);
	$new_other_names 	= sanitize($_POST['new_other_names']);
	$new_last_name 		= sanitize($_POST['new_last_name']);
	
	mysql_query("UPDATE `users` SET `first_name` = '$new_first_name', `other_names` = '$new_other_names', `last_name` = '$new_last_name' WHERE `user_id` = $user_id");
}

//Change Email
function change_email ($user_id, $new_email) {
	$user_id	 	= (int)$user_id;
	$new_email		= sanitize($new_email);
	
	mysql_query("UPDATE `users` SET `email` = '$new_email' WHERE `user_id` = '$user_id'");
}

//Change Password
function change_password ($user_id, $new_password) {
	$user_id	 	= (int)$user_id;
	$new_password 	= gen_encrypt($new_password);
	
	mysql_query("UPDATE `users` SET `password` = '$new_password' WHERE `user_id` = '$user_id'");
}

//Change Custom URL
function change_custom_url ($user_id, $new_custom_url) {
	$user_id	 	= (int)$user_id;
	$new_custom_url	= sanitize($new_custom_url);
	
	mysql_query("UPDATE `users` SET `custom_url` = '$new_custom_url' WHERE `user_id` = '$user_id'");
}

//Checking if String has Spaces
function space_check ($string) {
	if (strstr($_POST['new_custom_url'], ' ') === FALSE) {
		return FALSE;
	} else {
		return TRUE;
	}
}

//URL Exists Check
function custom_url_exists ($custom_url_exists) {
	$custom_url_exists 	= sanitize ($custom_url_exists);
	$query 				= mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `custom_url` = '$custom_url_exists'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

//Recover Password (by Email)
function recover_password ($user_id,$recovery_email) {
	$recovery_email 	= sanitize($_POST['recovery_email']);
	$new_password		= rand(10000000, 99999999);
	$new_password_md5	= md5($new_password);
	$first_name			= first_name_from_email($recovery_email);
	
	mysql_query("UPDATE `users` SET `password` = '$new_password_md5' WHERE `email` = '$recovery_email'");
	
	email($recovery_email, 'Recover Password', "
	Hello ".$first_name.",\n\nHere is your new password: ".$new_password."\n\n-Oliver Crow");
}

//Login
function login ($email, $password) {
	$user_id = user_id_from_email($email);
	
	$email = sanitize($email);
	$password = gen_encrypt($password);
	
	$login_query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
	
	return (mysql_result($login_query, 0) == 1) ? $user_id : false;
}

?>