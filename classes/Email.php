<?php

	
	class Email
	{
		private $mailer;
		
		public function __construct($host,$username,$senha, $nome)
		{
			$this->mailer =  new PHPMailer;

			$this->mailer->isSMTP();
			$this->mailer->Host =$host; // configuração disponibilizada pela hospedagem
			$this->mailer->SMTPAuth = true;		// Autenticação SMTP
			$this->mailer->Username = $username; // Email que vai fazer o disparo 
			$this->mailer->Password = $senha; // Senha do Email
			$this->mailer->SMTPSecure = 'tls';	// Habilita a criptografia tls e varia de hospdagem
			$this->mailer->Port = '587'; // varia de acordo com o servidor tcp

			$this->mailer->setFrom($username, $nome); // Tem que colocar o mesmo endereço 

			$this->mailer->isHTML(true); // Estou permitindo código HTML no Email
			$this->mailer->charSet = 'UTF-8';

		}

		public function addAddress($email,$nome){
			$this->mailer->addAddress($email, $nome); // addAddress para  destintário
		}

		public function formatarEmail($info){
			$this->mailer->Subject = $info['assunto'];
			$this->mailer->Body = $info['corpo'];
			$this->mailer->AltBody = strip_tags($info['corpo']);
		}

		public function enviarEmail(){
			if($this->mailer->send()){
				return true;
			}else{
				return false;
			}
		}
	}
?>