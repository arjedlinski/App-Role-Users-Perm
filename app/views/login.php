<?php global $app;?>
	<form id="users-login" method="post" action="<?php echo $app->getUrl('login');?>">
		<div class="field">
			<label for="login_crm">Name:</label>
			<input type="text" id="login_crm" name="login_crm" required>
		</div>

		<div class="field">
			<label for="password_crm">Password:</label>
			<input type="password" id="password_crm" name="password_crm" required>
		</div>

		<div class="field">
			<input type="submit" value="Submit" name="submit" />
		</div>
	</form>
