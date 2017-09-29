<?php
$data = $data->fetch_assoc();
global $app;
?>
	<div id="UsersForm">
		<form class="form-inline" id="users-add" method="post" action="<?php 

			echo $app->getUrl('editUsers').$data['id'];
		
		?>">
			<div class="form-group">
				<label for="firstname">Firstname</label>
				<input value="<?php if (isset($data['firstname'])){echo $data['firstname'];};?>" type="text" id="firstname" name="firstname" required>
			</div>

			<div class="form-group">
				<label for="lastname">Lastname</label>
				<input value="<?php if (isset($data['lastname'])){echo $data['lastname'];};?>" type="text" id="lastname" name="lastname" required>
			</div>
			<div class="form-group">
				<label for="login_crm">Login</label>
				<input value="<?php if (isset($data['login_crm'])){echo $data['login_crm'];};?>" type="text" id="login_crm" name="login_crm" required>
			</div>
			<div class="form-group">
				<label for="email">E-Mail</label>
				<input value="<?php if (isset($data['email'])){echo $data['email'];};?>" type="text" id="email" name="email" required>
			</div>
			<div class="form-group">
				<label for="password_crm">Password</label>
				<input value="<?php if (isset($data['password_crm'])){echo $data['password_crm'];};?>" type="text" id="password_crm" name="password_crm" required>
			</div>
			<div class="form-group">
				<button type="submit">Send</button>

			</div>
		</form>
            <form class="form-inline" id="users-add" method="post" action="<?php 

			echo $app->getUrl('editUsers').$data['id'];
		
		?>">
            
			<input type="checkbox" name="formWheelchair" value="Yes" />

			<div class="form-group">
				<button name="submitperm" type="submit">Put Permissions</button>

			</div>
		</form>
            
		<div id="form-messages"></div>
	</div>