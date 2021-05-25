<?php

namespace App\Controller\Admin;

use App\Model\Entity\User as EntityUser;
use App\Utils\View;

class User extends Page
{
     /**
     * Método responsável pela renderização da página de usuários
     * @return string
     */
    public static function getUser($request){
        // RENDERIZA A VIEW 
        $content = View::render('admin/modules/users/index',[
            'page'=>'Usuários',
            'itens'=>self::getItem($request)
        ]);

        return parent::getPanel('Usuários', $content, 'users');
    }

    /**
     * Método responsável pela view de itens
     * @return string
     */
    private static function getItem($request){

        $itens = '';

        $results = EntityUser::getUsers();

        while($obUsers = $results->fetchObject(EntityUser::class)){
            $itens .= View::render('admin/modules/users/item',[
                'id'=>$obUsers->id,
                'nome'=>$obUsers->nome,
                'email'=>$obUsers->email
            ]);
        }

        return $itens;
    }

    /**
     * Método responsável por editar um novo usuário
     * @return string
     */
    public static function getEditUser($request, $id){
        
        // CONTEÚDO
        $content = View::render('admin/modules/users/form',[

        ]);
        // RETORNA CONTEÚDO RENDERIZADO
        return self::getPanel('Editar Usuário', $content, 'users');
    }
}