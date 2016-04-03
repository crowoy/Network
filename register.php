<?php 
include 'core/init.php';
logged_in_redirect();
include 'includes/head.php';
?>
<div class="body"></div>
	<?php
	
	//Checking if all fields have been filled
	if (empty($_POST) === false) {
		$fields = array(
			'first_name'		=>$_POST['first_name'],
			'last_name'			=>$_POST['last_name'],
			'email'				=>$_POST['email'],
			'password'			=>$_POST['password'],
			'password_again'	=>$_POST['password_again']
		);
		
		foreach ($_POST as $key=>$value) {
			if (empty($value) && in_array($value, $fields) === true) {
				$errors[] = 'All fields are required.';
				break 1;
			}
		}
		if (empty($errors) === true) {
			//Checking User (Email) doesn't already exist
			if (user_exists($_POST['email']) === true) {
				$errors[] = 'Sorry, the email \''.htmlentities($_POST['email']).'\' is already in use.';
			}
			//Checking Email doesn't have any spaces
			if (preg_match("/\\s/", $_POST['email']) == true) {
				$errors[] = 'Your Email Address cannot contain spaces.';
			}
			//Checking Email matches Email Again
			if ($_POST['email'] !== $_POST['email_again']) {
				$errors[] = 'Your Email does not match your Retyped Email.';
			}
			//Checking Password String is longer than 6 chars
			if (strlen($_POST['password']) < 6) {
				$errors[] = 'You Password must be at least 6 characters.';
			}
			//Checking Email is Valid
			if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
				$errors [] = 'You need to enter a valid Email Address.';
			}
			
		}
	}
	
	?>

	<div id="indexcontainer">
	<div id="index_logo"><h1>Logo</h1></div>
	<div id="register">		
	<h1>Register</h1>
	<div id="register_hr_1"><hr></div>
	
	<?php
	
	if (isset ($_GET['success']) === true && empty ($_GET['success']) === true) {
		echo 'You\'ve been registered successfully.<br><br> Please check your email to activate your account.<br><br> Then <a class ="link_register" href="login.php">Login</a>.';
	} else {
	
		//Registering User, or outputting any errors (Stored in $errors)
		if (empty ($_POST) === false && empty ($errors) === true) {
			//Logging Successful Register
			$ip = sanitize($_SERVER['REMOTE_ADDR']);
			log_register_success($ip);		
			//Running 'register_user' function then Redirect
			register_user();
			?>
			<meta http-equiv="refresh" content="0.5;url=register.php?success" />
			Please wait...
			<?php
		} elseif (empty($errors) === false) {
			//Logging Register Fail
			$ip = sanitize($_SERVER['REMOTE_ADDR']);
			log_register_fail($ip);
			//Output Errors
			?>
				<div id-"register_errors">
				<div class="errors">
					
					<!--<?php echo output_errors($errors); ?>-->
					
					<script type="text/javascript">
						alert("<?php echo output_errors($errors) ?>");
					</script>
				</div>
				</div>

		   			<div id="register_1_fix">
							
			<?php
		}

		include 'includes/widgets/register.php'; ?>
	   				</div>
   				</div>
   	</div>
</div>
<?php
}
include 'includes/overall/footer.php'; ?>