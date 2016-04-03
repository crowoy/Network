<?php logged_in_redirect(); ?>
<div class="widget">
	<div id="login_widget">
		<div class="inner" id="login_form">
				<form action="login.php" method="POST">
					<table align="center" cellspacing="0px"; cellpadding: "0px";>
						<tr><td class="login_input" align="center"><input id="login_email" type="text" name="email" placeholder="Email"/></td></tr>
						<tr><td class="login_input" align="center"><input id="login_password" type="password" name="password" placeholder="Password"/></td></tr>
						<tr><td class="login_button" align="center"><input id="login_button" type="submit" value="Log in" /></td></tr>
						<tr><td align="center"><a id="forgot_password" href="recovery.php" align="center">Forgotten your password?</a></td></tr>
					</table>
				</form>
		</div>
	</div>
</div>