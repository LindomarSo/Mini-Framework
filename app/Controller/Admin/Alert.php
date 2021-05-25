<?php

namespace App\Controller\Admin;

use App\Utils\View;

class Alert 
{
    /**
     * Método responsável por renderizar uma view de sucesso
     */
    public static function getSuccess($msg){
        return View::render('admin/alert/status',[
            'msg'=>$msg
        ]);
    }
}