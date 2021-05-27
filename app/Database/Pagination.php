<?php

namespace App\Database;

class Pagination 
{
    /**
     * Número máximo de registros por página
     * @var integer
     */
    private $limit;

    /**
     * Quantidade total de resultados no banco
     * @var integer
     */
    private $results;

    /**
     * Quantidade de páginas
     * @var integer
     */
    private $pages;

    /**
     * Página atual
     * @var integer
     */
    private $currentPage;

    /**
     * Construtor da classe
     * @param integer $results
     * @param integer $currentPage
     * @param integer $limit
     */
    public function __construct($results, $currentPage, $limit = 10){
        $this->results = $results;
        $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
        $this->limit = $limit;
        $this->calculate();
    }

    /**
     * Método responsável por calcular a paginação
     */
    private function calculate(){
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

        // VERIFICA SE A PÁGINA ATUAL NÃO EXCEDE O NÚMERO DE PÁGINAS 
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }

    /**
     * Método responsável por retornar a clásula limit SQL
     * @return string
     */
    public function getLimit(){
        $offset = ($this->limit * ($this->currentPage - 1));
        return $offset.','.$this->limit;
    }

    /**
     * Método responsável por retornar as opções de páginas disponíveis 
     * @return array
     */
    public function getPages(){
        // NÃO RETORNAR PÁGINAS 
        if($this->pages == 1) return [];

        // PÁGINAS
        $paginas = [];
        for($i = 1; $i <= $this->pages ; $i++){
            $paginas[] = [
                'paginas'=>$i,
                'atual'=>$i == $this->currentPage
            ];
        }

        return $paginas;
    }
}