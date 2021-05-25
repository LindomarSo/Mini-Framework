<?php

use \App\Http\Response;
use \App\Controller\Admin;

//ROTA DE USUÁRIOS
$obRouter->get('/admin/users', [
    'middlewares'=>[
        'required-admin-login'
    ],
    function($request){
        return new Response('200', Admin\User::getUser($request));
    }
]);

//ROTA EDITAR UM USUÁRIO (GET)
$obRouter->get('/admin/users/{id}/edit', [
    'middlewares'=>[
        'required-admin-login'
    ],
    function($request,$id){
        return new Response('200', Admin\User::getEditUser($request, $id));
    }
]);