<h2 class="h1">Hello, <a href="<?php echo $user_data['custom_url']; ?>"><?php echo $user_data['first_name'] ?></a></h2>
<hr>
<br>
<a class="link" href="<?php echo $user_data['custom_url']; ?>">Profile</a>
<br>
<a class="link" href="messages.php">Messages</a>
<br>
<a class="link" href="settings.php">Account Settings</a>
<br><br>
<form action="logout.php" method="POST"><input class="button" type="submit" value="Logout" /></form>