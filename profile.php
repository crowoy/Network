<?php 
include 'core/init.php';
include 'includes/overall/header.php';
?>
<div class="body">
	<?php
	if (isset ($_GET['custom_url']) === true && empty ($_GET['custom_url']) === false) {
		$custom_url = $_GET['custom_url'];
		
		if (custom_url_exists($custom_url) === true) {
			$user_id		= user_id_from_custom_url($custom_url);
			$profile_data 	= user_data($user_id, 'first_name', 'other_names', 'last_name', 'email');
			
			?>
			
				<div id="profileheader"><h1><?php echo $profile_data['first_name'].'\'s Profile' ?></h1></div>
				
				<div id="profilebody">
					<p>Full Name: <?php echo $profile_data['first_name'].' '.$profile_data['other_names'].' '.$profile_data['last_name'] ?></p>
					<p>Email: <?php echo $profile_data['email']; ?></p>
				</div>
			
			<?php
		}
		
	} else {
		header('location:index.php');
		exit();
	}
	?>
</div>
<?php
include 'includes/overall/footer.php'; ?>