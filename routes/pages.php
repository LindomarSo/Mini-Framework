<?php

use \App\Controller\Pages;
use \App\Http\Response;

$obRouter->get('/', [
    function(){
        return new Response(200, Pages\Home::getHome());
    }
]);

$obRouter->get('/sobre', [
    function(){
        return new Response(200, Pages\Home::getHome());
    }
]);
 
$obRouter->get('/contato/{idPagina}/{acao}', [
    function($idPagina, $acao){
        return new Response(200, $idPagina.'-'.$acao);
    }
]);