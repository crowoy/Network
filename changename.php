<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';

?>
<div class ="body">
	<?php
	
	//Checking if all fields have been filled
	if (empty($_POST) === false) {
		$fields = array(
			'new_first_name'	=> sanitize($_POST['new_first_name']),
			'new_last_name' 	=> sanitize($_POST['new_last_name'])
		);
		foreach ($_POST as $key=>$value) {
			if (empty($value) && in_array($value, $fields) === true) {
				$errors[] = 'You must enter a First and Surname';
				break 1;
			}
		}
		
		//Checking Password Entered matches Password
		if (gen_encrypt($_POST['password']) === $user_data['password']) {
			
		} else {
			$errors[] = 'Password is incorrect.';
		}
	}
	?>
	
	<h1 class="h1">Change Name</h1>
	
	<?php
	
	if (isset ($_GET['success']) && empty ($_GET['success'])) {
		echo 'You\'ve successfully changed your name(s).<br><br>';
	} else {
		//Change Name, or output any errors (Stored in $errors)
		if (empty ($_POST) === false && empty ($errors) === true) {
			//Running 'change_name' function then Redirect	
			change_name($session_user_id, $_POST['new_first_name'], $_POST['new_other_names'], $_POST['new_last_name']);
			header('location: changename.php?success');
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
				<tr><td align="right">First Name:</td><td><input class="input" type="text" name="new_first_name" placeholder="<?php echo $user_data['first_name']; ?>"/></td></tr>
				<tr><td align="right">Other Name(s) <i>(Optional)</i></td><td><input class="input" type="text" name="new_other_names" placeholder="<?php echo $user_data['other_names']; ?>"/></td></tr>
				<tr><td align="right">Surname:</td><td><input class="input" type="text" name="new_last_name" placeholder="<?php echo $user_data['last_name']; ?>" /></td></tr>
			</tbody>
			<tbody><tr><td colspan="2"><hr></td></tr></tbody>
			<tbody>
				<tr><td align="right">Password:</td><td><input class="input" type="password" name="password" /></td></tr>
			</tbody>
			<tr><td></td><td><input class="button" type="submit" value="Change Name" /></td></tr>
		</table>
	</form>
</div>
<?php 
}
include 'includes/overall/footer.php'; 
?>