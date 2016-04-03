<?php 
include 'core/init.php';
if (logged_in() === true) {
	header('location: home.php');
}
?>

<!doctype html>
<html>

<?php include 'includes/head.php'; ?>

<body>
	
	<!--<div id="index_top_right">
		<a id="index_contact_us" href="register.php">Register</a>
		<a id="index_contact_us" href="contact.php">Contact us</a>
	</div>-->
	
	<div id="indexcontainer">
   		<?php 
   			if (logged_in() === true) {
   				header('location: home.php');
   			} else {
   				include 'includes/index_login_register.php';
			}
   		?>
   	</div>
   	
</body>

</html>

<?php include 'includes/footer.php'; ?>

