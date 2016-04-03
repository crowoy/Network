<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
//echo $user_data['friends'].'<br>';
echo message_get_friends_names_from_ids($user_data['friends']);
//echo '<br>hello';
?>
<div id="logged_in_central_area">
	
	<?php include 'includes/loggedin/home/sidebar.php'; ?>
	
	<div id="logged_in_central_area_main">
		<?php include 'includes/loggedin/home/post.php'; ?>
	</div>

</div>
<?php include 'includes/overall/footer.php'; ?>