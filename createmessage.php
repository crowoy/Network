<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
?>

<div id='logged_in_central_area'>
	
	<?php include 'includes/loggedin/home/sidebar.php'; ?>
	
	<div id="logged_in_central_area_main">
		<?php include 'includes/loggedin/messages/createmessage.php'; ?>
	</div>
</div>

<?php include 'includes/overall/footer.php'; ?>