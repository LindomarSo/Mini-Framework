<?php
 //Ativa o buffer de saída e enquanto o buffer estiver ativo não envia a saída do script
 //Permitindo que tudo seja carregado para só depois ser enviado
  ob_start();
  include('../config.php');

  if(isset($_SESSION['login']) == true){
    include('main.php');
  }else{
    include('login.php');
  }
  //Envia e desativa o buffer de saída
  ob_end_flush();
?>