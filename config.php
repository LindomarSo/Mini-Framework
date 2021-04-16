<?php

	session_start();
	
	$autoload = function($class){
		if($class == 'Email'){
			require('classes/phpmailer/PHPMailerAutoload.php');
		}
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);

	define('INCLUDE_PATH', 'http://localhost/Bootstrap/Site_completo_com_painel_e_db/');
	define('INCLUDE_PATH_PAINEL', 'http://localhost/Bootstrap/Site_completo_com_painel_e_db/painel/');
	$nome = 'Lindomar';

	define('HOST', 'localhost');
	define('DBNAME', 'bootstrap_projeto');
	define('USER','root');
	define('PASSWORD', '');
?>