<?php

use \App\Http\Response;
use \App\Controller\Admin;

//ROTA GET LOGIN
$obRouter->get('/admin/login',[
    'middlewares'=>[
        'required-admin-logout'
    ],
    function($request){
        return new Response(200, Admin\Login::getLogin($request));
    }
]);

//ROTA DE POST LOGIN
$obRouter->post('/admin/login',[
    'middlewares'=>[
        'required-admin-logout'
    ],
    function($request){
        return new Response(200, Admin\Login::setLogin($request));
    }
]);

//ROTA GET LOGIN
$obRouter->get('/admin/logout',[
    'middlewares'=>[
        'required-admin-login'
    ],
    function($request){
        return new Response(200, Admin\Login::setLogout($request));
    }
]);