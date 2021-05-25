<?php

    namespace App\Http;

    class Request 
    {
        /**
         * Instância de Router
         * @var Router
         */
        private $router;

        /**
         * Método HTTP da requisição
         * @var string
         */
        private $httpMethod;

        /**
         * URI da nossa página
         * @var string
         */
        private $uri;

        /**
         * Parâmetros da URL
         * @var array
         */
        private $queryParams = [];

        /**
         * Parâmetros POST
         * @var array
         */
        private $postVars = [];

        /**
         * Guardar cabeçalho da requisição
         * @var array
         */
        private $headers = [];

        /**
         * Construtor da página 
         */
        public function __construct($router){
            $this->router = $router;
            $this->queryParams = $_GET ?? [];
            $this->postVars = $_POST ?? [];
            $this->headers = getallheaders(); // FUNÇÃO QUE OBTEM TODOS OS HEADERS
            $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
            $this->uri = $_SERVER['REQUEST_URI'] ?? '';
        }

        /**
         * Método responsável por retornar a rota de Router
         * @return string
         */
        public function getRouter(){
            return $this->router;
        }

        /**
         * Método para retornar o método HTTP da requisição
         * @return string
         */
        public function getHttpMethod(){
            return $this->httpMethod;
        }

        /**
         * Método responsável por retornar a uri da requisição
         * @return string
         */
        public function getUri(){
            return $this->uri;
        }

        /**
         * Método responsável por retornar os headers da requisição
         * @return array
         */
        public function getHeaders(){
            return $this->headers;
        }

        /**
         * Método responsável por retornar os queryParams da requisição
         * @return array
         */
        public function getQueryParams(){
            return $this->queryParams;
        }

        /**
         * Método responsável por retornar os parâmetros de post
         * @return array
         */
        public function getPostVars(){
            return $this->postVars;
        }
    }