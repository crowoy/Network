<?php 
include 'core/init.php';
include 'includes/head.php'; ?>

<body>
<div class="body">
	<?php
	//Checking if all fields have been filled
	if (empty($_POST) === false) {
			
			//Check Email Exists
			if (user_exists($_POST['recovery_email']) === false) {
				$errors[] = 'This Email Address has not been registered. <a href="register.php">Register?</a>';
			}
			//Checking Email is Valid
			if (filter_var($_POST['recovery_email'], FILTER_VALIDATE_EMAIL) === false) {
				$errors [] = 'You need to enter a valid Email Address.';
			}
			//Checking Email doesn't have any spaces
			if (preg_match("/\\s/", $_POST['recovery_email']) === true) {
				$errors[] = 'Your Email Address cannot contain spaces.';
			}
			
		} elseif (isset ($_POST['recovery_email']) == true && empty ($_POST['recovery_email']) === true) {
			$errors[] = 'You have to enter your Email Address';
		}
	?>
	<div id="indexcontainer">
	<div id="index_logo"><h1>Logo</h1></div>
	<div id="contact_us_form">
	<h1 class="h1">Contact Us</h1>
	<div id="register_hr_1"><hr></div>
	
	<?php
	
	if (isset ($_GET['success']) && empty ($_GET['success'])) {
		echo '<br><br><br>We have sent you a new password.<br><br>';
	} else {
		//Send New Password, or output any errors (Stored in $errors)
		if (empty ($_POST['recovery_email']) === false && empty ($errors) === true) {
			//Logging Successful Recovery
			$ip = sanitize($_SERVER['REMOTE_ADDR']);
			log_pass_recovery_success($ip);
			//Running 'recover_password' function then Redirect	
			recover_password($user_id, $_POST['recovery_email']);
			?>
			<meta http-equiv="refresh" content="0.5;url=recovery.php?success" />
			Please wait...
			<?php
		} elseif (empty($errors) === false) {
			//Logging Password Recovery Fail
			$ip = sanitize($_SERVER['REMOTE_ADDR']);
			log_pass_recovery_fail($ip);
			//Output Errors
			?>
			<div class="errors"></div>
				
				<!--<?php //echo output_errors($errors); ?>-->
				
				<script type="text/javascript">
						alert("<?php echo output_errors($errors) ?>");
				</script>
			</div>
			<?php
		}
	?>
	
	<br>
	
	<center>If you have any problems/bugs, or want to suggest somethings, please contact us here.</center>
	
	<br>
	<br>
	<br>
	
	<form action="" method="POST">
		<table align="center" class="table">
			<tr><td id="contact_us_from" align="right">From:</td><td><input type="text" id="contact_us_from_field" name="contact_us_from_field" /></td></tr>
			<tr><td id="contact_us_message">Message:</td><td><input type="text" id="contact_us_message_field" name="contact_us_message_field"/></td></tr>
			<tr><td></td><td><input id="contact_us_form_button" type="submit" value="Send Message" /></td></tr>
		</table>
	</form>

</div>

<?php 
}
include 'includes/overall/footer.php'; ?>