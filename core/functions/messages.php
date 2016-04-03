<?php

// Get Subject from ID
function subject_from_id ($user_id) {
	$user_id = (int) $user_id;
	$subject_from_id_query = mysql_query("SELECT `subject` FROM `messages` WHERE `to` = '$user_id'");
	$row_count = mysql_num_rows($subject_from_id_query);
	$count = 0;
	while ($count < $row_count) {
		$messages[] = mysql_result($subject_from_id_query, $count);
		$count++;
	}
	return $messages;
}

// Get sender's User ID from 'from'
function user_id_from_to ($user_id) {
	$user_id = (int) $user_id;
	$get_sender_id_query = mysql_query("SELECT `from` FROM `messages` WHERE `to` = '$user_id'");
	$row_count = mysql_num_rows($get_sender_id_query);
	$count = 0;
	while ($count < $row_count) {
		$sender[] = first_name_from_id(mysql_result($get_sender_id_query, $count)).' '.last_name_from_id(mysql_result($get_sender_id_query, $count));
		$count++;
	}
	
	return $sender;
}

// Message ID from User ID
function message_id_from_user_id ($user_id) {
	$user_id = (int) $user_id;
	$message_id_from_user_id_query = mysql_query("SELECT `mess_id` FROM `messages` WHERE `to` = '$user_id'");
	$row_count = mysql_num_rows($message_id_from_user_id_query);
	$count = 0;
	while ($count < $row_count) {
		$message_id [] = mysql_result($message_id_from_user_id_query, $count);
		$count++;
	}
	return $message_id;
}

// Message Data to User
function message_output ($message_data) {
	return '<ul style="list-style-type: none"><li>'.implode('</li><li>', $message_data).'</li></ul>';
}

// Get Friend's Names from User_ID
function message_get_friends_names_from_ids ($friends_ids) {
	$friends_ids = explode(' ', $friends_ids);
	print_r($friends_ids);
	echo '<br>';
	foreach ($friends_ids as $friends_names => $names) {
		echo full_name_from_id($names).'<br>';
	}
}

?>