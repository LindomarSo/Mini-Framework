<?php

namespace App\Controller\Admin;

use App\Utils\View;

class Alert 
{
    /**
     * Método responsável por renderizar uma view de sucesso
     * @return string
     */
    public static function getSuccess($msg){
        return View::render('admin/alert/status',[
            'msg'=>$msg,
            'tipo'=>'success'
        ]);
    }

    /**
     * Método responsável por retornar uma mensgem de erro
     * @return string
     */
    public static function getError($msg){
        return View::render('admin/alert/status',[
            'msg'=>$msg,
            'tipo'=>'danger'
        ]);
    }
}