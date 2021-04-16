<?php
	
	include('../config.php');
	$data = array();
	$assunto = 'Nova mensagem do site';
	$corpo = '';
	foreach ($_POST as $key => $value) {
		$corpo .= ucfirst($key). ": ".$value;
		$corpo .="<hr>";
	}

	$info = array('assunto'=>$assunto,'corpo'=> $corpo);
	$mail = new Email('host','seu email','sua senha','nome');
	$mail -> addAddress('destinatário', 'nome');
	$mail -> formatarEmail($info);

	if($mail->enviarEmail($info)){
		$data['sucesso'] = true;
	}else{
		$data['erro'] = true;
	}

	die(json_encode($data));
?>