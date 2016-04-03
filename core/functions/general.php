<?php

//Email
function email ($to, $subject, $body) {
	mail($to, $subject, $body, 'From:email@email.com');
	exit;
}

//Redirect if not logged in
function protect_page () {
	if (logged_in() === false) {
		header('location:pageredirect.php');
		exit();
	}
}

//Logged in Redirect
function logged_in_redirect () {
	if (logged_in() === true) {
		header('location: index.php');
		exit();
	}
}

//Sanitizing Inputed Data
function sanitize ($data) {
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}

//Errors to User
function output_errors ($errors) {
	//return '<ul><li>'.implode('</li><li>', $errors).'</li></ul>';
	return '-'.implode('\n-', $errors).'\n';
}

?>
