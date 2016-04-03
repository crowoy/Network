<?php 
include 'core/init.php';
logged_in();
include 'includes/overall/header.php';

?>
<div class="body">
	<?php
	
	if (isset ($_GET['success']) === true && empty ($_GET['success']) === true) {
		?>
		
		<h2 class="h1">Thanks, we've activated your account.</h2>
		<p>You're free to log in!</p>
		<?php
	}
	
	if (isset ($_GET['email']) && isset ($_GET['email_code'])) {
		$activate_email			= trim($_GET['email']);
		$activate_email_code 	= trim($_GET['email_code']);
		
		if (user_exists($activate_email) === false) {
			$errors[] = 'Oops, something went wrong, and we couldn\'t find that email address.';
		} elseif (activate($activate_email, $activate_email_code) === false) {
			$errors[] = 'We had problems activating your account.';
		}
		
		if (empty($errors) === false) {
		?>
			
			<h2 class="h1">Oops</h2>
		<?php
			?>
			<div class="errors">
				<?php
				echo output_errors($errors);
				?>
			</div>
			<?php
		} else {
			header('location:activate.php?success');
			exit();
		}
		
	} else {
		header('location:index.php');
		exit();
	}
	
	?>
</div>
<?php

include 'includes/overall/footer.php'; 
?>