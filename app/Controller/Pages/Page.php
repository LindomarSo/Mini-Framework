<?php

    namespace App\Controller\Pages;
    use \App\Utils\View;

    class Page
    {
        /**
         * Método responsável por retornar o header da página
         * @return string
         */
        private static function getHeader(){
            return View::render('pages/header',[
                'URL'=>URL
            ]);
        }

        /**
         * Método responsável por retornar o footer da página
         * @return string
         */
        public static function getFooter(){
            return View::render('pages/footer',[
                'URL'=>URL
            ]);
        }

        /**
         * Método responsável por retornar o conteúdo da view
         * @param string $title
         * @param string $content
         * @return string
         */
        public static function getPage($title, $content){
            return View::render('pages/page',[
                'title'=>$title,
                'URL'=> URL,
                'header'=>self::getHeader(),
                'content'=>$content,
                'footer'=>self::getFooter()
            ]);
        }

    }