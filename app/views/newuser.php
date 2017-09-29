<div id="UsersForm">
	<form class="form-horizontal" id="users-add" method="post" action="<?php global $app; echo $app->getUrl('addUser'); ?>">
		<div class="field form-group">
			<label class="col-sm-2 control-label" for="firstname">firstname:</label>
			<div class="col-sm-10">
				<input type="text" id="firstname" name="firstname" value="<?php if(isset($data['firstname'])){echo $data['firstname'];}?>" class="form-control" required>
			</div>
		</div>

		<div class="field form-group">
			<label class="col-sm-2 control-label" for="lastname">lastname:</label>
			<div class="col-sm-10">
				<input type="text" id="lastname" name="lastname" value="<?php if(isset($data['lastname'])){echo $data['lastname'];}?>" class="form-control" required>
			</div>
		</div>
		<div class="field form-group">
			<label class="col-sm-2 control-label" for="login_crm">login:</label>
			<div class="col-sm-10">
				<input type="text" id="login_crm" name="login_crm" class="form-control" required>
			</div>
		</div>
		<div class="field form-group">
			<label class="col-sm-2 control-label" for="password_crm">password:</label>
			<div class="col-sm-10">
				<input type="text" id="password_crm" name="password_crm" class="form-control" required>
			</div>
		</div>

		<div class="field">
			<button type="submit" class="btn btn-default">Send</button>
		</div>
	</form>
	<div id="form-messages"></div>
</div>