<?php
include 'core/init.php';
logged_in_redirect();
?>
<div class="body">
	<div id="indexcontainer">
	<?php
	
	//Email/Password Empty Check
	if (empty ($_POST) === false) {
		$email	 	= $_POST['email'];
		$password 	= $_POST['password'];
	
		if (empty ($email) === true || empty ($password) === true) {
			$errors[] = 'You need to enter an Email and Password to Login';
		} elseif (user_exists($email) === false) {
			$errors[] = 'Email does not exist';
		} elseif (user_active($email) === false) {
			$errors[] = 'You haven\'t activated your account';
		} else {
			$login = login($email, $password);
			if ($login === false) {
				$errors[] = 'Email/Password combination is incorrect';
			} else {
				// Set Session
				$_SESSION['user_id'] = $login;
				// Logging Login
				$ip = $_SERVER['REMOTE_ADDR'];
				log_login_success($user_data['user_id'], $ip);
				?>
					<meta http-equiv="refresh" content="0.3;url=index.php" />
					Please wait...
				<?php
				exit();
			}
		}
	} 
	?>
	<div id="index_logo"><h1>Logo</h1></div>
	<div id="login">	
	<h2 class="h1">Login</h2>
	<?php
	include 'includes/head.php';
	
	//ECHO '$errors' if any errors are present & Log Attempt
	if (empty ($errors) === false) {
		// Logging Attempt
		$ip 		= sanitize($_SERVER['REMOTE_ADDR']);
		$username 	= sanitize($_POST['email']);
		$password	= sanitize($_POST['password']);
		
		log_login_fail($email, $password, $ip);
		
		// ECHO Errors
		?>
		<h4 class="h1">We tried to log you in, but...</h4>
			<div id-"login_errors">
				<div class="errors">
					<script type="text/javascript">
						alert("<?php echo output_errors($errors) ?>");
					</script>
				</div>
			</div>
		<?php
	} elseif (empty ($errors) === true){
		?>
		<h4 class="h1">Please Login here, or <a class="link" href="register.php">Register</a></h4>
		<?php
	}	
?>
<div id="register_1_fix">
		<div id="login_hr"><hr></div>
		<br>
			<?php include 'includes/widgets/login.php'; ?>
	</div>
	</div>
   	</div>
	</div>
<?php

include 'includes/overall/footer.php';

?>