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

//ROTA CRIAR NOVO USUÁRIO
$obRouter->get('/admin/users/new', [
    'middlewares'=>[
        'required-admin-login'
    ],
    function($request){
        return new Response('200', Admin\User::getNewUser($request));
    }
]);

//ROTA CRIAR NOVO USUÁRIO
$obRouter->post('/admin/users/new', [
    'middlewares'=>[
        'required-admin-login'
    ],
    function($request){
        return new Response('200', Admin\User::setNewUser($request));
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

//ROTA EDITAR UM USUÁRIO (POST)
$obRouter->post('/admin/users/{id}/edit', [
    'middlewares'=>[
        'required-admin-login'
    ],
    function($request,$id){
        return new Response('200', Admin\User::setEditUser($request, $id));
    }
]);

//ROTA DELETE UM USUÁRIO (GET)
$obRouter->get('/admin/users/{id}/delete', [
    'middlewares'=>[
        'required-admin-login'
    ],
    function($request,$id){
        return new Response('200', Admin\User::getDeleteUser($request, $id));
    }
]);

//ROTA DELETE UM USUÁRIO (GET)
$obRouter->post('/admin/users/{id}/delete', [
    'middlewares'=>[
        'required-admin-login'
    ],
    function($request,$id){
        return new Response('200', Admin\User::setDeleteUser($request, $id));
    }
]);