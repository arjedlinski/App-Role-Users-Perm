<div><table class="table table-bordered">
		<tr>
			<th>#</th>
			<th>Login</th>
			<th>Password</th>
			<th>Firstname</th>
			<th>Lastname</th>
			<th>E-mail</th>
			<th>Registration Date</th>
			<th>Operations</th>
		</tr>
		<?php $i = 0;
		$html = '';
		global $app;
		foreach($data as $datas => $value){
			$i++;
			$html .='<tr>';
			$html .= '<th>'.$i.'</th>';
			$html .= '<th>'.$value['login_crm'].'</th>';
			$html .= '<th>'.$value['password_crm'].'</th>';
			$html .= '<th>'.$value['firstname'].'</th>';
			$html .= '<th>'.$value['lastname'].'</th>';
			$html .= '<th>'.$value['email'].'</th>';
			$html .= '<th>'.$value['reg_date'].'</th>';
			$html .= '<th><a href='.$app->getUrl("showUser").''.$value["id"].'><button type="button" class="btn btn-info">Show profile</button></a><br>
			<a href='.$app->getUrl("editUsers").''.$value["id"].'><button type="button" class="btn btn-success">Edit</button></a><br>
			<form class="form-horizontal" id="users-delete" method="post" action='.$app->getUrl("removeUser").''.$value['id'].'>
			<button type="submit" class="btn btn-danger">Delete User</button></th>
			</form>';
			$html .='</tr>';
		}
		$html .= '</table></div>';
echo $html;
	 ?>