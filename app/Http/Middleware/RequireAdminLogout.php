<?php

namespace App\Http\Middleware;

use App\Session\Admin\Login;

class RequireAdminLogout
{
    /**
     * Método responsável por executar o middleware
     * @param Request $request 
     * @param Closure $next
     * @return Response
     */
    public function handle($request, $next){
        // VERIFICA SE O USUÁRIO ESTA LOGADO 
        if(Login::isLogado()){
            $request->getRouter()->redirect('/admin');
        }

        // CONTINUA A EXECUÇÃO
        return $next($request);
    }
}