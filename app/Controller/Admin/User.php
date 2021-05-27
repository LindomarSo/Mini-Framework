<?php

namespace App\Controller\Admin;

use App\Database\Pagination;
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
            'itens'=>self::getItem($request, $obPaginator),
            'status'=>self::getStatus($request) ?? '',
            'links'=>parent::getPagination($request, $obPaginator)
        ]);

        return parent::getPanel('Usuários', $content, 'users');
    }

    /**
     * Método responsável pela view de itens
     * @return string
     */
    private static function getItem($request, &$obPaginator){

        $itens = '';

        // QUANTIDADE TOTAL DE REGISTROS
        $quantidadeTotal = EntityUser::getUsers(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
        // PÁGINA ATUAL 
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;    
        // INSTÂNCIA DE PAGINATOR
        $obPaginator = new Pagination($quantidadeTotal, $paginaAtual, 2);
        
        $results = EntityUser::getUsers(null,'id ASC',$obPaginator->getLimit());

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
     * Método responsável por criar um novo usuário
     * @param Request $request 
     * @return string
     */
    public static function getNewUser($request){
        $content = View::render('admin/modules/users/form',[
            'description'=>'Criar Usuário',
            'nome'=>'',
            'email'=>'',
            'status'=>self::getStatus($request)
        ]);

        return parent::getPanel('Criar novo usuário', $content, 'users');
    }

    /**
     * Método responsável por criar um novo usuário
     * @param Request $request 
     */
    public static function setNewUser($request){
        // VARIÁVEIS DO POST
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $nome = $postVars['nome'] ?? '';
        $senha = $postVars['senha'] ?? '';
       
        $obUser = EntityUser::getUserByEmail($email);
        
        // VERIFICA A INSTÂNCIA
        if($obUser instanceof EntityUser){
            $request->getRouter()->redirect('/admin/users/new?status=duplicated');
        }
        
        // INSTÂNCIA DA CLASSE
        $obUsers = new EntityUser;
        
        // CADASTRAR NO BANCO 
        $obUsers->nome = $nome;
        $obUsers->email = $email;
        $obUsers->senha = password_hash($senha, PASSWORD_DEFAULT);

        $obUsers->cadastrar();

        $request->getRouter()->redirect('/admin/users?status=created');
    }

    /**
     * Método responsável por editar um novo usuário
     * @return string
     */
    public static function getEditUser($request, $id){
        // BUSCAR UM USUÁRIO PELO ID
        $obUser = EntityUser::getUserById($id);
        
        // VALIDA A INSTÂNCIA 
        if(!$obUser instanceof EntityUser){
            $request->getRouter()->redirect('admin/modules/users');
        }

        // CONTEÚDO
        $content = View::render('admin/modules/users/form',[
            'description'=>'Editar Usuário',
            'nome'=>$obUser->nome,
            'email'=>$obUser->email,
            'status'=>self::getStatus($request)
        ]);
        // RETORNA CONTEÚDO RENDERIZADO
        return self::getPanel('Editar Usuário', $content, 'users');
    }

    /**
     * Método responsável por por receber variáveis de edição via post 
     * @param Request $request
     * @param integer $id 
     */
    public static function setEditUser($request, $id){
        // POST VARS
        $postVars = $request->getPostVars();
        $nome = $postVars['nome'] ?? '';
        $email = $postVars['email'] ?? '';
        $senha = $postVars['senha'] ?? '';

        // OBTÉM UM USUÁRIO PELO ID
        $obUser = EntityUser::getUserByEmail($email);

        // VALIDA A INSTÂNCIA 
        if($obUser instanceof EntityUser && $id != $obUser->id){
            $request->getRouter()->redirect('/admin/users/'.$id.'/edit?status=duplicated');
        }

        // ATUALIZA O USUÁRIO
        $obUser->nome = $nome;
        $obUser->email = $email;
        $obUser->senha = password_hash($senha, PASSWORD_DEFAULT);

        $obUser->atualizar();

        $request->getRouter()->redirect('/admin/users?status=update');
    }

    /**
     * Método responsável pela view de delete de usuário 
     * @param Request $request 
     * @param integer $id
     * @return string
     */
    public static function getDeleteUser($request, $id){
        // BUSCA UM USUÁRIO PELO ID
        $obUser = EntityUser::getUserById($id);
        
        $content = View::render('admin/modules/users/delete',[
            'nome'=>$obUser->nome,
            'id'=>$obUser->id
        ]);

        return self::getPanel('Excluir Usuário', $content, 'users');
    }

    /**
     * Método responsável por deletar um usuário do banco
     * @param Request $request 
     * @param integer $id 
     */
    public static function setDeleteUser($request, $id){
        // OBTÉM UM USUÁRIO PELO ID
        $obUser = EntityUser::getUserById($id);

        // VERIFICA A INSTÂNCIA
        if(!$obUser instanceof EntityUser){
            $request->getRouter()->redirect('/admin/users');
        }
        
        $obUser->excluir();

        $request->getRouter()->redirect('/admin/users?status=deleted');
    }

    /**
     * Método responsável por retornar a mensagem de statatus
     * @param Request $request
     * @return string
     */
    public static function getStatus($request){
        // QUERY PARAMS
        $queryParams = $request->getQueryParams();
        
        // STATUS
        if(!isset($queryParams['status'])) return '';

        switch($queryParams['status']){
            case 'created':
                return Alert::getSuccess('Usuário criado com sucesso!');
                break;
            case 'duplicated':
                return Alert::getError('O e-mail digitado já existe!');
                break;  
            case 'update':
                return Alert::getSuccess('Usuário atualizado com sucesso!');
                break;  
            case 'deleted':
                return Alert::getSuccess('Usuário deletado com sucesso!');
                break;    
        }
    }
}