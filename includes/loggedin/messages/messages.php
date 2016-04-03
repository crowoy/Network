<div id="messages_central_area">
	<table class="table" border="0" cellpadding="0px" cellspacing="0px">
		<tr>
			<td id="messages_table_create_message" colspan="2"><a class="link" href="createmessage.php">Create a New Message</a></td>
		</tr>
		<tr>
			<td id="messages_table_line" colspan="2"><hr></td>
		</tr>
		<tr id="messages_table_headings">
			<td><strong>Subject</strong></td>
			<td><strong>From</strong></td>
		</tr>
		<tr>
			<td id="messages_table_subject"><?php  echo message_output(subject_from_id($user_data['user_id'])); ?></td>
			<td id="messages_table_from"><?php  echo message_output(user_id_from_to($user_data['user_id'])); ?></td>
		</tr>
	</table>
</div>