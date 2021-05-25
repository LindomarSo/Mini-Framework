<?php

namespace App\Controller\Admin;

use App\Model\Entity\User;
use App\Utils\View;
use App\Session\Admin\Login as SessionLogin;

class Login extends Page
{
    /**
     * Método Responsável pelo login do painel
     * @param Request $request
     * @return string
     */
    public static function getLogin($request, $msg = null){
        $status = !is_null($msg) ? Alert::getSuccess($msg) : '';

        $content = View::render('admin/login',[
            'title'=>'Login',
            'msg'=>$status
        ]);

        return parent::getPage('Login', $content);
    }

    /**
     * Método responsável por definir o login do usuário
     * @param Request $request
     */
    public static function setLogin($request){
        // VARIÁVEIS DO POST
        $postVars = $request->getPostVars();
        
        $email = $postVars['email'] ?? '';
        $senha = $postVars['senha'] ?? '';

        // BUSCA USUÁRIO PELO E-MAIL
        $obUser = User::getUserByEmail($email);

        if(!$obUser instanceof User){
            return self::getLogin($request, 'E-mail ou senha inválidos!');
        }

        //VERIFICA A SENHA DO USUÁRIO
        if(!password_verify($senha, $obUser->senha)){
            return self::getLogin($request, 'E-mail ou senha inválidos!');
        }
        
        // CRIA A SESSÃO DE LOGIN
        SessionLogin::login($obUser);

        // REDIRECIONA O USUÁRIO PARA A HOME DO ADMIN
        $request->getRouter()->redirect('/admin');
    }

    /**
     * Método responsável por deslogar o usuário
     * @param Request $request
     */
    public static function setLogout($request){
        // DESTROI A SESSÃO
        SessionLogin::logout();

        $request->getRouter()->redirect('/admin/login');
    }
}