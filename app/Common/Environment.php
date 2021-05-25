<?php

namespace App\Common;

class Environment
{
    /**
     * Método responsável por carregar as variáveis de abiente do projeto
     * @param string $dir Caminho absoluto da pasta onde se econtra o arquivo .env
     */
    public static function load($dir){
        // VERIFICAR SE O ARQUIVO .ENV EXISTE 
        if(!file_exists($dir.'/.env')){
            return false;
        }

        // DEFINE AS VARIÁVEIS DE AMBIENTE
        $lines = file($dir.'/.env');
        foreach($lines as $line){
            putenv(trim($line));
        }
    }
}