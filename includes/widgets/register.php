<?php logged_in_redirect(); ?>
<div class="widget">
	<div id="register_widget">
		<div class="inner" id="register_form">
			<form action="register.php" method="POST">
				<table align="center">
					<tr><td align="center"></td><td><input id="register_information" type="text" name="first_name" placeholder="First Name"/></td></tr>
					<tr><td align="center"></td><td><input id="register_information" type="text" name="last_name" placeholder="Surname"/></td></tr>
					<tr><td align="center"></td><td><input id="register_information" type="text" name="email" placeholder="Email"/></td></tr>
					<tr><td align="center"></td><td><input id="register_information" type="text" name="email_again" placeholder="Retype Email"/></td></tr>
					<tr><td align="center"></td><td><input id="register_information" type="password" name="password" placeholder="Password"/></td></tr>
					<tr></tr>
					<tr><td></td><td align="center"><input type="submit" value="Sign Up" /></td></tr>
				</table>
			</form>
		</div>
	</div>
</div>