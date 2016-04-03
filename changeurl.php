<?php

//Checking if all fields have been filled
if (empty($_POST) === false) {
	$fields = array('new_custom_url' => $_POST['new_custom_url']);

	foreach ($_POST as $key=>$value) {
		if (empty($value) && in_array($value, $fields) === true) {
			$errors[] = 'You must enter a new URL.';
			break 1;
		}
	}
	
	//Checking if New URL is already taken
	if (custom_url_exists($_POST['new_custom_url']) == true) {
		$errors[] = 'That URL has already been taken.';
	}
	
	//Checking if New URL is longer than 30 chars
	if (strlen($_POST['new_custom_url']) > 30) {
		$errors[] = 'That URL is too long. (Must be under 30 characters)';
	}
	
	//Checking if URL has any Spaces
	if (space_check($_POST['space_check']) === TRUE) {
		$errors[] = 'Your URL cannot contain a space.';
	}
	
}

if (isset ($_GET['success']) && empty ($_GET['success'])) {
	echo 'Custom URL successfully changed.<br><br>';
} else {
	//Change Custom URL, or output any errors (Stored in $errors)
	if (empty ($_POST) === false && empty ($errors) === true) {
		//Running 'change_custom_url' function then Redirect/Refresh	
		change_custom_url($user_data['user_id'], $_POST['new_custom_url']);
		//header('location: settings.php?success');
		?>
		<meta http-equiv="refresh" content="0.1;url=settings.php" />
		<?php
	} elseif (empty($errors) === false) {
		//Output Errors
		?>
		<div class="errors">
			<script type="text/javascript">
				alert("<?php echo output_errors($errors) ?>");
			</script>
			<?php //echo output_errors($errors);?>
		</div>
		<?php
	}
}
?>