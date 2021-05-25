<?php

namespace App\Http\Middleware;

use App\Session\Admin\Login;

class RequireAdminLogin
{
    /**
     * Método responsável por executar o middleware de login
     * @param Request $request 
     * @param Closure  $next
     * @return Response
     */
    public function handle($request, $next){
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO 
        if(!Login::isLogado()){
            $request->getRouter()->redirect('/admin/login');
        }

        // CONTINUA A EXECUÇÃO
        return $next($request);
    }
}