<?php
  if(isset($_GET['sair'])){
    Painel::logout();
  }
  $sobre = MySql::conectar() -> prepare("SELECT * FROM `tb_sobre`");
  $sobre -> execute();
  $sobre = $sobre -> fetch()['sobre'];
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image-x/png" href="imagens/download.ico"/>
    <title>Painel de Controle</title>
    <link href="<?php echo INCLUDE_PATH_PAINEL; ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top"><!-- navbar-fixed-top -->
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">System</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul id="alvo" class="nav navbar-nav">
            <li class="active"><a res_sys="sobre" href="#">Editar Sobre</a></li>
            <li><a res_sys="cadastrar_equipe" href="#">Cadastrar Equipe</a></li>
            <li><a res_sys="listar_equipe" href="#">Listar Equipe</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo INCLUDE_PATH_PAINEL; ?>?sair"><span class="glyphicon glyphicon-off"></span> Sair!</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="box">
    <header id="header">
       <div class="container">
         <div class="row">
           <div class="col-md-10">
            <h2><span class="glyphicon glyphicon-cog"></span> Painel de Controle</h2>
           </div>
           <div class="col-md-2">
            <p><span class="glyphicon glyphicon-time"></span> Seu último login foi em: 12/06/2019</p>
           </div>
         </div><!--row-->
       </div><!--container-->
    </header>
    <section class="bread">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
        </ol>
      </div>
    </section>
    <section class="principal">
      <div class="container">
        <div class="row">
          <div id="menuSelecionado" class="col-md-3">
            <a href="#" res_sys="sobre" class="list-group-item active"><span class="glyphicon glyphicon-pencil"></span> Editar Sobre</a>
            <a href="" res_sys="cadastrar_equipe" class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span> Cadastrar Equipe</a> 
            <a res_sys="listar_equipe" href="#" class="list-group-item"><span class="glyphicon glyphicon-pencil"></span> Listar Equipe <span class="badge">20</span></a>
            </div>
            <div id="sobre" class="col-md-9">
              <?php

                if(isset($_POST['editar_sobre'])){
                  $sobre = $_POST['sobre'];
                  Painel::delete('tb_sobre');
                  if(Painel::insert('tb_sobre',$sobre)){
                    echo '<div class="alert alert-success" role="alert"><b>Sucesso!</b> O código sobre foi editado!</div>'; 
                    $sobre = MySql::conectar() -> prepare("SELECT * FROM `tb_sobre`");
                    $sobre -> execute();
                    $sobre = $sobre -> fetch()['sobre'];
                  }else{
                    echo '<div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                      <span class="sr-only">Error:</span>
                     Algo deu errado ao atualizar!
                    </div>';
                  }
                }else if(isset($_POST['cadastrar_equipe'])){
                  $nome = $_POST['nome'];
                  $descricao = $_POST['descricao'];
                  $sql = MySql::conectar() -> prepare("INSERT INTO `tb_equipe` VALUES(null,?,?)");
                  $sql -> execute(array($nome,$descricao));
                  echo '<div class="alert alert-success" role="alert"><b>Sucesso!</b> O Usuário cadastrado com sucesso!</div>';
                  $equipe = MySql::conectar() -> prepare("SELECT `id`,`nome` FROM `tb_equipe`");
                  $equipe -> execute();
                  $equipe = $equipe -> fetchAll();
                }
              ?>
              <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #337ab7; color: white;">
                  <h3 class="panel-title">Sobre</h3>
                </div>
                <div class="panel-body">
                  <form method="post">
                    <div class="form-group">
                      <label>Código HTML:</label>
                      <textarea name="sobre"  class="form-control"style="height: 140px; resize: vertical;"><?php echo $sobre; ?></textarea>
                    </div>
                    <input type="hidden" name="editar_sobre" value="">
                    <button type="submit" name="acao" class="btn btn-default">Enviar</button>
                  </form>
                </div>
              </div>
              <div id="cadastrar_equipe" class="panel panel-default">
                <div class="panel-heading" style="background-color: #337ab7; color: white;">
                  <h3 class="panel-title">Cadastrar Equipe:</h3>
                </div>
                <div class="panel-body">
                  <form method="post">
                    <div class="form-group">
                      <label>Nome do membro:</label>
                      <input type="text" class="form-control" name="nome">
                    </div>
                    <div class="form-group">
                      <label>Código HTML:</label>
                      <textarea class="form-control" name="descricao" style="height: 140px; resize: vertical;"></textarea>
                    </div>
                    <input type="hidden" name="cadastrar_equipe" value="">
                    <button type="submit" class="btn btn-default">Enviar</button>
                  </form>
                </div>
              </div>
              <div id="listar_equipe" class="panel panel-default">
                <div class="panel-heading" style="background-color: #337ab7; color: white;">
                  <h3 class="panel-title">Membros da equipe:</h3>
                </div>
                <div class="panel-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>#</th>
                      </tr> 
                    </thead>
                    <tbody>
                      <?php
                       $equipe = MySql::conectar() -> prepare("SELECT `id`,`nome` FROM `tb_equipe`");
                       $equipe -> execute();
                       $equipe = $equipe -> fetchAll();
                        foreach($equipe as $key => $value){
                      ?>
                      <tr>
                        <td><?php echo $value['id']; ?></td>
                        <td><?php echo $value['nome']; ?></td>
                        <td><button class="btn btn-danger deletar-membro" id_membro="<?php echo $value['id']; ?>"><span class="glyphicon glyphicon-trash"></span> Excluir</button></td>
                      </tr>
                    <?php }?>
                    </tbody>
                  </table>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php INCLUDE_PATH_PAINEL; ?>js/bootstrap.min.js"></script>
    <script src="<?php INCLUDE_PATH_PAINEL; ?>js/functions.js"></script>
  </body>
</html> 