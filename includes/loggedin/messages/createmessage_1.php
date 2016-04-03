<?php 
include 'core/init.php';
protect_page();
include 'includes/head.php';


	if (isset ($_POST) === true) {
	//Checking if POST is empty
	if (isset ($_POST) === true && empty($_POST) === false) {
		//Setting POST as Variable
		$to = sanitize($_POST['updating_status_textbox']);
	} 
	
	if (isset ($_POST) === true && empty($errors) === true) {
		//Checking Post isn't longer than 255 chars
		if (strlen($new_post) > 255) {
			$errors[] = 'Your post cannot be longer than 255 characters.';
		}
		//Checking Post hasn't been posted by same user
		if (posted_before($new_post) === true) {
			$errors[] = 'You can\'t post the same thing twice.';
		}
		//Checking is Post is blank
		if (empty($new_post) === true) {
			$errors[] = 'You have to enter something.';
		}
	}
	
	if (isset ($_POST) === true && empty ($_POST) === false && empty ($errors) === true) {
		//Post the Post
		$ip = sanitize($_SERVER['REMOTE_ADDR']);
		post($new_post, $ip);
		header ('location: home.php');
	} elseif (empty ($errors) === false) {
		// Logging Attempt
		$user_id	= $user_data['user_id'];
		$ip 		= sanitize($_SERVER['REMOTE_ADDR']);
		$new_post 	= sanitize($new_post);
		
		log_post_fail($ip, $user_id, $new_post)
		
		// ECHO Errors
		?>
				<div id-"post_errors">
				<div class="errors">
					
					<!--<?php echo output_errors($errors); ?>-->
					
					<script type="text/javascript">
						alert("<?php echo output_errors($errors) ?>");
					</script>
				</div>
				</div>
			<?php
	}
	}
?>
<meta http-equiv="refresh" content="0.3;url=index.php" />
Please wait...