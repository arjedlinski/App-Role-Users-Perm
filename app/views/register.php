	<div id="UsersForm">
		<form class="form-inline" id="users-add" method="post" action="<?php 
                    global $app;
                    echo $app->getUrl('register');
		
		?>">
			<div class="form-group">
				<label for="firstname">Firstname</label>
				<input type="text" id="firstname" name="firstname" required>
			</div>

			<div class="form-group">
				<label for="lastname">Lastname</label>
				<input type="text" id="lastname" name="lastname" required>
			</div>
			<div class="form-group">
				<label for="login_crm">Login</label>
				<input value="<?php if (isset($data['login_crm'])){echo $data['login_crm'];};?>" type="text" id="login_crm" name="login_crm" required>
			</div>
			<div class="form-group">
				<label for="password_crm">Password</label>
				<input value="<?php if (isset($data['password_crm'])){echo $data['password_crm'];};?>" type="text" id="password_crm" name="password_crm" required>
                        </div>
			<!-- <div class="form-group">
				<label for="login">Login</label>
				<input type="text" id="login" name="login" required>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="text" id="password" name="password" required>
			</div> -->
			<div class="form-group">
				<label for="email">E-Mail</label>
				<input  type="text" id="email" name="email" required>
			</div>
			
			<div class="form-group">
				<button name="submit" type="submit">Send</button>

			</div>
		</form>
		<div id="form-messages"><?php echo isset($data['message'])? $data['message']: '';?></div>
	</div>