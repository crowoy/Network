<div class="body">
	
	<div id="settings_main">
		<div id="settings_name_email_password">
			<table align="center" class="table">
				<tr><td><a class="link_settings" href="changename.php"><strong>Change Name -</strong> <i><?php echo $user_data['first_name'].' '.$user_data['other_names'].' '.$user_data['last_name']; ?></i></a></td></tr>
				<tr><td><a class="link_settings" href="changeemail.php"><strong>Change Email -</strong> <i><?php echo $user_data['email']; ?></i></a></td></tr>
				<tr><td><a class="link_settings" href="changepassword.php"><strong>Change Password</strong></a></td></tr>
				<tr><td colspan="2"><hr></td></tr>
			</table>
		</div>
		
		<div id="settings_changeurl">
			<table align="center" class="table">
				<tr><td colspan="2"><?php include 'changeurl.php'; ?></td></tr>
				<tr><td colspan="2"><strong>Custom URL:</strong></td></tr>
				<tr><td>http://example.com/</td>
					<td><form action="" method="POST">
						<input class="input" type="text" name="new_custom_url" placeholder="<?php echo $user_data['custom_url']; ?>"/>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input class="button" type="submit" value="Get URL" />
						</form>
					</td>
				</tr>
			</table>
		</div>
	</div>

</div>