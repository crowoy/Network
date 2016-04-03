<?php

// Post the Post
function post ($new_post, $ip) {
	$post 		= sanitize ($new_post);
	$user_id 	= $user_data['user_id'];
	$ip			= sanitize($ip);
	$time 			= date("H:i:s");
	$date			= date("d-m-Y");
	
	mysql_query ("INSERT INTO `posts` SET
		`user_id`	= '$user_id',
		`body`		= '$post',
		`ip`		= '$ip',
		`time`		= '$time',
		`date`		= '$date'
	");
}

// Check if Post has been posted before
function posted_before ($new_post) {
	$new_post 	= sanitize ($new_post);
	$user_id 	= $user_data['user_id'];
	
	$query = mysql_query ("SELECT COUNT(`post_id`) FROM `posts` WHERE `body` = '$new_post' AND `user_id` = '$user_id'");
	
	return (mysql_result($query, 0) == 1) ? true : false;
}

?>