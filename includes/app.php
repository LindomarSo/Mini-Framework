<?php

// AUTOLOAD COMPOSER

use \App\Http\Middleware\Queue;
use \App\Database\Database;

require __DIR__.'/../vendor/autoload.php';  

// CARREGA AS VARIÁVEIS DE AMBIENTE DO PROJETO
\App\Common\Environment::load(__DIR__.'/../');

//CARREGAR AS CONFIGURAÇÕES DO BANCO 
Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS')
);

// DEFINE O MAPEAMENTO DE MIDDLEWARES
Queue::setMap([
    'maintenance'=>\App\Http\Middleware\Maintenance::class,
    'required-admin-logout'=>\App\Http\Middleware\RequireAdminLogout::class,
    'required-admin-login'=>\App\Http\Middleware\RequireAdminLogin::class
]);

// DEFINE O MAPEAMENTO PADRÃO PARA TODOAS A ROTAS
Queue::setDefault([
    'maintenance'
]);