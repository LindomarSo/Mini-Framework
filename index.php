<?php
  include('config.php');
  $url = isset($_GET['url'])?$_GET['url']:'';
  echo $url;
  $pdo = new PDO('mysql:host=localhost;dbname=bootstrap_projeto','root','');
  $sobre = $pdo -> prepare("SELECT * FROM `tb_sobre`");
  $sobre -> execute();
  $sobre = $sobre -> fetch()['sobre'];
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image-x/png" href="imagens/icone.ico"/>
    <title><?php echo htmlentities('<Code System>'); ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <base base="<?php echo INCLUDE_PATH; ?>">
    <div class="overlay-form"><img src="imagens/ajax-loader.gif"></div>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo htmlentities('<Code System>');?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a href="home">Home</a></li>
            <li><a href="contato">Contato</a></li>
            <li><a href="sobre">Sobre</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="box">
      <section id="home" class="banner">
        <div class="overlay"></div><!--overlay-->
          <div class="container chamada-banner">
            <!-- Para não quebrar no responsivo utiliza a class col-sm-n°-->
            <div class="col-md-12 text-center">
              <h2><?php echo htmlentities('<'); ?>Code System<?php echo htmlentities('>'); ?></h2>
              <p>Empresa voltada para o desenvolvimento Web e o markting digital</p>
              <a href="">Saiba mais</a>
            </div>
          </div><!--container-->
      </section><!--banner-->
      <section class="cadastro-lead"> 
        <div class="container">
          <div class="row text-center">
            <div class="col-md-6">
              <h2 class="white"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Entre na nossa  lista</h2>
            </div>
            <div class="col-md-6">
              <form method="post">
                <input type="email" name="nome" required><input type="submit" name="acao">
              </form>
            </div>
          </div><!--row-->
        </div><!--container-->
      </section><!--cadastro-lead-->
      <section class="depoimento">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h2>Depoimento</h2>
              <blockquote><!--blockquote é utlizada para fazer citação-->
                <p>Que nos consola em toda a nossa tribulação, para que também possamos consolar os que estiverem em alguma tribulação, com a consolação com que nós mesmos somos consolados por Deus.
                </p>
              </blockquote>
            </div>
          </div><!--row-->
        </div><!--container-->
      </section><!--depoimento-->
      <section id="sobre" class="diferenciais">
        <h2 class="text-center">Conheça nossa empresa</h2>
        <div class="container difirenciais-container">
          <div class="row">
            <?php
              echo $sobre;
            ?>
          </div><!--row-->
        </div><!--container-->
      </section><!--diferenciais-->
      <section class="equipe">
        <h2 class="text-center">Equipe</h2>
        <div class="container equipe-container">
          <?php
            $membro = $pdo -> prepare("SELECT * FROM `tb_equipe`");
            $membro -> execute();
            $membro = $membro->fetchAll();  
          ?>
          <div class="row">
            <?php
              for($i = 0; $i < count($membro); $i++){
            ?>
            <div class="col-md-6">
              <div class="equipe-single">
                <div class="row">
                  <div class="col-md-2"> 
                    <div class="user-picture">
                      <div class="user-picture-child">
                        <span class="glyphicon glyphicon-user"></span>
                      </div>
                    </div>
                  </div><!--col-md-3-->
                  <div class="col-md-10">
                    <h3><?php echo $membro[$i]['nome']; ?></h3>
                    <p class="text-justify"><?php echo $membro[$i]['descricao']; ?></p>
                  </div><!--col-md-9-->
                </div><!--row-->
              </div><!--equipe-single-->
            </div>
            <?php } ?>
          </div><!--row-->
        </div><!--container-->
      </section><!--equipe-->
      <section id="contato" class="final-site">
        <div class="container">
          <div class="row">
             <div class="col-md-6">
              <h2>Fale conosco</h2>
                <form method="post">
                  <div class="form-group">
                    <label for="email">Nome:</label>
                    <input type="text" class="form-control" id="email" name="nome" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Edereço de E-mail:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Mensagem:</label>
                    <textarea class="form-control" name="mensgem" required></textarea>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </form>
             </div><!--col-md-6-->
             <div class="col-md-6">
               <h2>Nossos Planos</h2>
               <table class="table table-bordered">
                 <thead>
                  <tr>
                     <th>Plano</th>
                     <th>Mensal</th>
                     <th>Semanal</th>
                   </tr>  
                 </thead>
                 <tbody>
                   <tr>
                     <td>50</td>
                     <td>60</td>
                     <td>70</td>
                   </tr>
                   <tr>
                     <td>50</td>
                     <td>60</td>
                     <td>70</td>
                   </tr>
                   <tr>
                     <td>50</td>
                     <td>60</td>
                     <td>70</td>
                   </tr>
                 </tbody>
               </table>
             </div>
           </div> 
        </div><!--container-->
      </section><!--final-site-->
      <footer>
        <p class="text-center">Todos os Direitos reservados</p>
      </footer>
    </div><!--box-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/functions.js"></script>
  </body>
</html>
