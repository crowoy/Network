<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';

?>
<div class="body">
	<?php
	
	//Checking if all fields have been filled
	if (empty($_POST) === false) {
		$fields = array('old_password'=>$_POST['old_password'],'new_password'=>$_POST['new_password'],'new_password_again'=>$_POST['new_password_again']);
		foreach ($_POST as $key=>$value) {
			if (empty($value) && in_array($value, $fields) === true) {
				$errors[] = 'All fields are required.';
				break 1;
			}
		}
		if (gen_encrypt($_POST['old_password']) === $user_data ['password']) {
				
			//Check New Password matches New Password Again
			if ($_POST['new_password'] !== $_POST['new_password_again']) {
				$errors[] = 'You have incorrectly Retyped your New Password.';
			} 
			
			//Check New Password String is longer than 6 chars
			if (strlen($_POST['new_password']) < 6) {
				$errors [] = 'Your New Password must be longer than 6 characters.';
			}
			
		} else {
			$errors[] = 'Your \'Old Password\' is inncorrect.';
		}
	}
	?>
	
	<h1 class="h1">Change Password</h1>
	
	<?php
	
	if (isset ($_GET['success']) && empty ($_GET['success'])) {
		echo 'You\'ve successfully changed your password.<br><br>';
	} else {
		//Change Password, or output any errors (Stored in $errors)
		if (empty ($_POST) === false && empty ($errors) === true) {
			//Running 'change_password' function then Redirect	
			change_password($session_user_id, $_POST['new_password']);
			header('location: changepassword.php?success');
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
			<tr><td align="right">Old Password:</td><td><input class="input" type="password" name="old_password"/></td></tr>
			<tr><td align="right">New Password:</td><td><input class="input" type="password" name="new_password"/></td></tr>
			<tr><td align="right">Retype New Password:</td><td><input class="input" type="password" name="new_password_again"/></td></tr>
			<tr></tr>
			<tr><td></td><td><input class="button" type="submit" value="Change Password" /></td></tr>
		</table>
	</form>
</div>
<?php 
}
include 'includes/overall/footer.php'; ?>