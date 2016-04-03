<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';

?>
<div class="body">
	<?php
	
	//Checking if all fields have been filled
	if (empty($_POST) === false) {
		$fields = array(
			'password'			=> $_POST['password'],
			'new_email' 		=> sanitize($_POST['new_email']),
			'new_email_again' 	=> sanitize($_POST['new_email_again'])
		);
		foreach ($_POST as $key=>$value) {
			if (empty($value) && in_array($value, $fields) === true) {
				$errors[] = 'All fields are required.';
				break 1;
			}
		}
		
		//Checking Password Entered matches Password
		if (gen_encrypt($_POST['password']) === $user_data['password']) {
			
			//Check New Email matches New Email Again
			if ($_POST['new_email'] !== $_POST['new_email_again']) {
				$errors[] = 'You have incorrectly Retyped your New Email.';
			}
			//Checking Email is Valid
			if (filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL) === false) {
				$errors [] = 'You need to enter a valid Email Address.';
			}
			//Checking Email doesn't have any spaces
			if (preg_match("/\\s/", $_POST['new_email']) == true) {
				$errors[] = 'Your Email Address cannot contain spaces.';
			}
			//Checking if Email is same as Old Email
			if ($_POST['new_email'] == $user_data['email']) {
				$errors[] = 'Your account is already registered to that email address.';
			}
			
		} else {
			$errors[] = 'Password is incorrect.';
		}
	}
	?>
	
	<h1 class="h1">Change Email</h1>
	
	<?php
	
	if (isset ($_GET['success']) && empty ($_GET['success'])) {
		echo 'You\'ve successfully changed your email address.<br><br>';
	} else {
		//Change Email, or output any errors (Stored in $errors)
		if (empty ($_POST) === false && empty ($errors) === true) {
			//Running 'change_email' function then Redirect	
			change_email($session_user_id, $_POST['new_email']);
			header('location: changeemail.php?success');
		} elseif (empty($errors) === false) {
			//Output Errors
			?>
			<div class="errors">
				<?php
				echo output_errors($errors);
				?>
			</div>
			<?php
		}
	?>
	
	<form action="" method="POST">
		<table class="table">
			<tbody>
				<tr><td align="right">New Email:</td><td><input class="input"type="text" name="new_email" placeholder="<?php echo $user_data['email']; ?>"/></td></tr>
				<tr><td align="right">Retype New Email:</td><td><input class="input" type="text" name="new_email_again" placeholder="<?php echo $user_data['email']; ?>" /></td></tr>
			</tbody>
			<tbody><tr><td colspan="2"><hr></td></tr></tbody>
			<tbody>
				<tr><td align="right">Password:</td><td><input class="input" type="password" name="password" /></td></tr>
			</tbody>
			<tr><td></td><td><input class="button" type="submit" value="Change Email" /></td></tr>
		</table>
	</form>
</div>
<?php 
}
include 'includes/overall/footer.php'; ?>