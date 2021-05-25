<?php

    namespace App\Controller\Pages;
    use \App\Utils\View;

    class Home extends Page
    {
        /**
         * 
         */
        public static function getHome(){
            // VIEW DA HOME
            $content = View::render('pages/home',[
                'name'=>'Lindomar Dev',
                'description'=>'Programmer'
            ]);

            // VIEW DA PÁGINA 
            return parent::getPage('Page - Home', $content);
        }
    }