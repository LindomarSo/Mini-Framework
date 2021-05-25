<?php

namespace App\Controller\Admin;

use App\Utils\View;

class Page 
{
    /**
     * Módolos disponíveis no painel
     * @var array
     */
    private static $modules = [
        'home'=> [
            'label'=>'Home',
            'link'=>URL.'/admin'
        ],
        'users'=>[
            'label'=>'Usuários',
            'link'=>URL.'/admin/users'
        ]
    ];

    /**
     * Método reponsável pela view de page Admin
     * @return string
     */
    public static function getPage($title, $content){
        return View::render('admin/page',[
            'title'=>$title,
            'content'=>$content,
            'URL'=>URL
        ]);
    }

    /**
     * Método responsável por carregar a página principal
     * @return string
     */
    public static function getHome($request){
        $content = View::render('admin/modules/home/index',[
            'nome'=>'Lindomar'
        ]);

        return self::getPanel('Painel', $content, 'home');
    }

    /**
     * Método reponsável por carregar o painel
     * @return string
     */
    public static function getPanel($title, $content, $currentModule){
        // RETORNA VIEW DE MENU
        $contentPainel = View::render('admin/panel',[
            'menu'=>self::getMenu($currentModule),
            'content'=>$content
        ]);

        return self::getPage($title,$contentPainel);
    }

    /**
     * Método responsável por carregar o menu
     * @return string
     */
    private static function getMenu($currentModule){
        // LINKS DO MENU
        $links = '';

        foreach(self::$modules as $hash => $module){
            $links .= View::render('admin/menu/link',[
                'label'=>$module['label'],
                'link'=>$module['link'],
                'current'=>$hash == $currentModule ? 'text-danger' : ''
            ]);
        }
        return View::render('admin/menu/index',[
            'links'=>$links
        ]);
    }
}