<?php
	$login = $_SESSION['user'];
	if(!empty($login))
	{
            $db = $registry->db;
		echo 'Witaj <b>'.$login.'</b>';		
		if($db::isUserInRole($login,'admin'))
		{	
			echo '(admin) |';
		}
		?> 
			<a href="/<?=APP_ROOT?>/account/logout">Logout</a>
		<?php
	}
	else
	{
	//	var_dump($_SESSION);
		?>
		<a href="/<?=APP_ROOT?>/account/login">Sign in</a> &nbsp; |  	
		<a href="/<?=APP_ROOT?>/account/register">Sign up</a>
		<?php
	}

?>