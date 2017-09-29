<?php session_start(); ?>
    <?php var_dump($_GET); 
    global $app;
	
    $app->checkUserActive();

    ?>
	<div class="header">
	<?php
	if (isset($_GET['url'])){
				$url = explode('/',filter_var(rtrim($_GET['url'], '/'),FILTER_SANITIZE_URL));
			}else{
				$url = '/';
			};
			
		  if(isset($_SESSION['login_user'])){ 

			echo '<button type="button" class="btn btn-success">Your login:' ;
				 echo $_SESSION['login_user'];
			echo '</button>';
                        echo '<button type="button" class="btn btn-success">' ;
				 echo "<a href='".$app->getUrl('logout')."'>Logout</a>";
			echo '</button>';
		
		echo "<ul class='nav nav-pills'>
			<li role='presentation' class='".(($url[0] == '/')? 'active' : '')."'><a href='".$app->getUrl('homepage')."'>Home</a></li>		
			<li role='presentation' class='".(($url[0] == 'users')? 'active' : '')." dropdown'>
				<a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>
				Users <span class='caret'></span>
				</a>
				<ul class='dropdown-menu'>
					<li role='presentation' class='".(($url[0].'/'.((isset($url[1])? $url[1] : '')) == 'users/')? 'active' : '')."'><a href='".$app->getUrl('listUsers')."'>Users</a></li>
					<li role='presentation' class='".(($url[0].'/'.((isset($url[1])? $url[1] : '')) == 'users/newUser')? 'active' : '')."'><a href='".$app->getUrl('addUser')."'>Add User</a></li>
				</ul>
			</li>
                        <li role='presentation' class='".(($url[0] == 'clients/showClients')? 'active' : '')."'><a href='".$app->getUrl('settings')."'>Settings</a></li>
		</ul>";
		}else{
			echo "
			<ul class='nav nav-pills'>
			<li role='presentation' class='".(($url == '')? 'active' : '')."'><a href='".$app->getUrl('homepage')."'>Home</a></li>
			<li role='presentation' class='".(($url == 'signIn')? 'active' : '')."'><a href='".$app->getUrl('register')."'>Register</a></li>
			";
			if(!isset($_SESSION['login_user'])){
				echo "<li role='presentation' class='".(($url == '/Log in')? 'active' : '')."'><a href='".$app->getUrl('login')."'>Log in</a></li>";
			}
		}
	?>
		</ul>
	</div>
