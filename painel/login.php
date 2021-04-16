<?php
	if(isset($_COOKIE['lembrar'])){
		$user = $_COOKIE['user'];
		$senha = $_COOKIE['senha'];

		$sql = MySql::conectar() -> prepare("SELECT * FROM `tb_painel.usuarios` WHERE user=? AND password=?");
		$sql->execute(array($user,$senha));
		if($sql->rowCount()==1){
			$_SESSION['login'] = true;
			$_SESSION['user'] = $user;
			$_SESSION['senha'] = $senha;

			header('Location:'.INCLUDE_PATH_PAINEL);
			die();			
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image-x/png" href="imagens/login.ico">
	<title>Login Painel</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<section class="login">
		<?php
			if(isset($_POST['acao'])){
				$user = $_POST['nome'];
				$senha = $_POST['senha'];
				$lembrar = @$_POST['lembrar'];

				$sql = MySql::conectar() -> prepare("SELECT * FROM `tb_painel.usuarios` WHERE user=? AND password=?");
				$sql -> execute(array($user,$senha));

				if($sql->rowCount()==1){
					$_SESSION['login'] = true;
					$_SESSION['user'] = $user;
					$_SESSION['senha'] = $senha;

					if($_POST['lembrar']){
						setcookie('lembrar','true',time()+(60*60*24),'/');
						setcookie('user',$user,time()+(60*60*24),'/');
						setcookie('senha',$senha,time()+(60*60*24),'/');
					}

					// Painel::redirect(INCLUDE_PATH_PAINEL);
					header('Location:'.INCLUDE_PATH_PAINEL);
					die();
				}else{
					echo '<div class="alert alert-danger" role="alert">
					  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					  <span class="sr-only">Error:</span>
					  <b>Usuário</b> ou <b>senha</b> inválido!
					</div>';
				}
			}

		?>
		<h3>Bem vido ao Painel</h3>
		<form method="post">
			<div class="form-group">
				<label>Usuário:</label>
				<input class="form-control" type="text" name="nome">
			</div>
			<div class="form-group">
				<label>Senha:</label>
				<input class="form-control" type="password" name="senha">
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<input class="form-control" type="submit" name="acao" value="Login">
					</div>
				</div>
				<div class="col-md-7">
					<div class="form-group">
						<label>Lembrar-me</label>
						<input  type="checkbox" name="lembrar">
					</div>
				</div>
			</div>
		</form>
	</section>
</body>
</html>