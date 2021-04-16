<?php

	class Painel
	{
		public static function login(){
			return isset($_SESSION['login'])?true:false;
		}

		public static function logout(){
			session_destroy();
			setcookie('lembrar','true',time()-(10),'/');
			header('Location:'.INCLUDE_PATH_PAINEL);
			die();
		}

		public static function redirect($url){
			echo '<script>location.href='.$url.'</script>';
		}

		public static function delete($table){
			$sql = MySql::conectar() -> prepare("DELETE FROM `$table`");
			$sql -> execute();
		}

		public static function insert($table,$value){
			$sql = MySql::conectar() -> prepare("INSERT INTO `$table` VALUES(null,?)");
			$sql -> execute(array($value));
			if($sql->rowCount()==1){
				return true;
			}else{
				return false;
			}
		}
	}
?>