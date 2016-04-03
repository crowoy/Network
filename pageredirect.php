<?php 
include 'core/init.php';
include 'includes/head.php';
include 'sidebar.php';
logged_in_redirect();
?>
<!doctype html>
<html>


   	
    
	    <div id="container">
	    	

<body>
	<div id="indexcontainer">
		<div class="center_page">
	   		<h2 class="h1">Sorry, you need to be logged in to do that...</h2>
	   		<p>Please <a href="register.php">Register</a> or <a href="index.php">Log In</a></p>
   		</div>
   	</div>
</body>

<?php include 'includes/overall/footer.php'; ?>