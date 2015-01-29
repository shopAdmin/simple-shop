<?php
	session_start();
		//włączenie raportowania błędów 
		//error_reporting(E_ALL);
		
		//zdefiniowanie stałej ze ścieżką
		$site_path = realpath(dirname(__FILE__));
		//$site_path = str_replace('\\','/',$site_path);
		$site_path =  $site_path . "/html";
		define ('__SITE_PATH', $site_path);
		define ('APP_ROOT', 'ciucholand');
		
		//dołączenie pliku init.php
		include 'html\includes\init.php';
		
		//załadowanie routera
		$registry->router = new router($registry);
		$registry->template = new Template($registry);
		$registry->router->setPath(__SITE_PATH . '\controller');
		
?>


<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Ciucholand</title>
		<script src="/<?=APP_ROOT?>/html/content/scripts/jquery-1.8.3.js"></script> 
		<link rel="stylesheet" href="/<?=APP_ROOT ?>/html/content/css/base.css" type="text/css" />     
	</head>
	<body>
	<div id="container">
	  <div id="top">
			<div id="logo">CIUCHOLAND - sklep internetowy</div>		
			<div id="login">
				<?php include 'html\includes\login.php';  ?>
			</div>
			<div id="menu">
				<?php include 'html\includes\menu.php';  ?>
			</div>
		</div>
		
		<div id="content">
	
		<?php
		$registry->router->loader();
		?>
		
		</div>
		<div id="footer">
			Copyright &copy Ciucholand 2014 
		</div>
	</div>
	</body>
</html>




