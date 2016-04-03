<?php

	/*function salt() {
		$seed = '';
		for($i = 0; $i < 16; $i++) {
			$seed .= chr(mt_rand(0, 255));
		}
		// Generate Salt
		$salt = substr(strtr(base64_encode($seed), '+', '.'), 0, 22);
		return $salt;
	}

	//Custom Hash
	function encrypt($password) {
		// Generate Hash
		$salt1 = sha1(md5('$2y$'));
		$hash = crypt($password, $salt1 . $this->rounds . '$' . $this->salt());
		return $hash;
	}
	
	// Verify
	function verifypass($password, $old_hash) {
		// Hash Password with Old Hash
		$hash = crypt($password, $old_hash);
		
		if($hash === $existingHash) {
			return true;
		} else {
			return false;
		}
	}

/* Next the Usage */
/* Start Instance */
/*
/*$bcrypt = new bcrypt(12);

/*echo salt();

/* Two create a Hash you do */
/*echo 'Bcrypt Password: ' . $bcrypt->encrypt('password').'<br>';

/* Two verify a hash you do */
/*$HashFromDB = $bcrypt->encrypt('password'); /* This is an example you would draw the hash from your db */
/*echo 'Verify Password: ' . $bcrypt->verifypass('password', $HashFromDB);
*/

// General Encryption
function gen_encrypt ($data) {
	$data = md5($data);
	return $data;
}

// Log Successful Logins
function log_login_success($user_id, $ip){
	$time 		= date("H:i:s");
	$date		= date("d-m-Y");
	
	mysql_query("INSERT INTO `log_login_success` SET 
		`user_id` 	= '$user_id',
		`ip`		= '$ip',
		`time` 		= '$time',
		`date` 		= '$date'
	");
	//echo $time.'<br>'.$date.'<br>'.$ip;
}

function log_login_fail($email, $password, $ip){
	$time 		= date("H:i:s");
	$date		= date("d-m-Y");
	
	mysql_query("INSERT INTO `log_login_fail` SET 
		`email` 	= '$email',
		`password`	= '$password',
		`ip`		= '$ip',
		`time` 		= '$time',
		`date` 		= '$date'
	");
	//echo $time.'<br>'.$date.'<br>'.$ip;
}

// LOG Successful Register
function log_register_success ($ip) {
	$email 			= sanitize($_POST['email']);
	$email_again	= sanitize($POST['email_again']);
	$first_name 	= sanitize($_POST['first_name']);
	$last_name		= sanitize($_POST['last_name']);
	$password		= gen_encrypt($_POST['password']);
	$ip 			= sanitize ($ip);
	$time 			= date("H:i:s");
	$date			= date("d-m-Y");
	
	mysql_query("INSERT INTO `log_register_success` SET 
		`email` 		= '$email',
		`email_again`	= '$email_again',
		`first_name` 	= '$first_name',
		`last_name` 	= '$last_name',
		`password` 		= '$password',
		`ip`			= '$ip',
		`time`			= '$time',
		`date`			= '$date'
	");
}

// LOG Failed Register
function log_register_fail ($ip) {
	$email 			= sanitize($_POST['email']);
	$email_again	= sanitize($_POST['email_again']);
	$first_name 	= sanitize($_POST['first_name']);
	$last_name		= sanitize($_POST['last_name']);
	$password		= sanitize($_POST['password']);
	$ip 			= sanitize ($ip);
	$time 			= date("H:i:s");
	$date			= date("d-m-Y");
	
	mysql_query("INSERT INTO `log_register_fail` SET 
		`email` 		= '$email',
		`email_again`	= '$email_again',
		`first_name` 	= '$first_name',
		`last_name` 	= '$last_name',
		`password` 		= '$password',
		`ip`			= '$ip',
		`time`			= '$time',
		`date`			= '$date'
	");
}

// LOG Successful Password Recovery
function log_pass_recovery_success ($ip) {
	$email 			= sanitize($_POST['email']);
	$ip 			= sanitize ($ip);
	$time 			= date("H:i:s");
	$date			= date("d-m-Y");
	
	mysql_query("INSERT INTO `log_pass_recovery_success` SET 
		`email` 		= '$email',
		`ip`			= '$ip',
		`time`			= '$time',
		`date`			= '$date'
	");
}

// LOG Failed Password Recovery
function log_pass_recovery_fail ($ip) {
	$email 			= sanitize($_POST['email']);
	$ip 			= sanitize ($ip);
	$time 			= date("H:i:s");
	$date			= date("d-m-Y");
	
	mysql_query("INSERT INTO `log_pass_recovery_fail` SET 
		`email` 		= '$email',
		`ip`			= '$ip',
		`time`			= '$time',
		`date`			= '$date'
	");
}

// LOG Failed Post
function log_post_fail ($ip, $user_id, $new_post) {
	$user_id		= sanitize($user_id);
	$new_post 		= sanitize($new_post);
	$ip 			= sanitize ($ip);
	$time 			= date("H:i:s");
	$date			= date("d-m-Y");
	
	mysql_query("INSERT INTO `log_post_fail` SET 
		`user_id`		= '$user_id',
		`post_body` 	= '$new_post',
		`ip`			= '$ip',
		`time`			= '$time',
		`date`			= '$date'
	");
}

?>