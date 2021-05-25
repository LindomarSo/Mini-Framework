<?php

    require __DIR__.'/vendor/autoload.php'; 
    
    // VARIÁVEIS DE AMBIENTE
    require __DIR__.'/includes/app.php';

    use \App\Http\Router;
   
    // URL DO PROJETO
    define("URL", getenv('URL'));
    
    $obRouter = new Router(URL);

    // ROTAS DAS PÁGINAS
    require __DIR__.'/routes/pages.php';

    //ROTAS DO PAINEL
    require __DIR__.'/routes/admin.php';

    // IMPRIME O RESPONSE DA ROTA
    $obRouter->run()->sendResponse();
