<?php

namespace App\Http;

use \App\Http\Middleware\Queue;
use \Closure;
use \Exception;
use \ReflectionFunction;

class Router
    {
        /**
         * URL completa do projeto (raiz do projeto)
         * @var string
         */

        private $url = '';

        /**
         * Prefixo de todas as rotas
         * @var string
         */

        private $prefix = '';

        /**
         * Índice de rotas
         * @var array
         */

        private $routes = [];

        /**
         * Instância de Request
         * @var Request
         */

        private $request; 

        /**
         * Método responsável por iniciar a classe
         * @var string $url
         */

        public function __construct($url){
            $this->request = new Request($this);
            $this->url = $url;
            $this->setPrefix();
        }

        /**
         * Método responsável por definir o prefixo das rotas
         */

        public function setPrefix(){
            // INFORMAÇÕES DA URL ATUAL
            $parseUrl = parse_url($this->url); // parse_url() função que retorna informações da url
            
            // DEFINE PREFIXO

            $this->prefix = $parseUrl['path'] ?? '';
        }

        /**
         * Método responsável por adicionar uma rota na classe
         * @param string $method
         * @param string $route
         * @param array $params
         */

        private function addRoute($method, $route, $params = []){
            // VALIDAÇÃO DOS PARÂMETROS
            foreach($params as $key => $value){
                if($value instanceof Closure){
                   $params['controller'] = $value;
                   unset($params[$key]); 
                   continue;
                }
            }

            // MIDDLEWARES DA ROTA
            $params['middlewares'] = $params['middlewares'] ?? [];

            // VARIÁVEIS DA ROTA
            $params['variables'] = [];
            
            // PADRÃO DE VALIDAÇÃO DAS VARIÁVEIS DA ROTA
            $patternVariables = '/{(.*?)}/';
            if(preg_match_all($patternVariables,$route,$matches)){
                $route = preg_replace($patternVariables,'(.*?)', $route);
                $params['variables'] = $matches[1];
            }
           
            // PADRÃO DE VALIDAÇÃO DA URL   
            $patternRoute = '/^'.str_replace('/','\/',$route).'$/';
            
            // ADICIONA ROTA DENTRO DA CLASSE
            $this->routes[$patternRoute][$method] = $params;
        }

        /**
         * Método responsável por definir uma rota de get
         * @param string $route
         * @param array $params
         */

        public function get($route, $params = []){
            return $this->addRoute('GET', $route, $params);
        }

        /**
         * Método responsável por definir uma rota de post
         * @param string $route
         * @param array $params
         */

        public function post($route, $params = []){
            return $this->addRoute('POST', $route, $params);
        }

        /**
         * Método responsável por definir a rota de PUT 
         * @param string $route
         * @param array $params
         */

         public function put($route, $params = []){
             return $this->addRoute('PUT', $route, $params);
         }

         /**
          * Método responsável por definir a rota de delete
          * @param string $route
          * @param array $params
          */

          public function delete($route, $params = []){
              return $this->addRoute('DELETE',$route, $params);
          }

        /**
         * Método responsável por retornar a URI desconsiderando o prefixo
         * @return string
         */

        private function getUri(){
            // URI DA RESQUEST
            $uri = $this->request->getUri();
            
            // FATIA A URI COM O PREFIXO
            $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
            
            // RETORNA A URI SEM PREFIXO
            return end($xUri);
        }

        /**
         * Método responsável por retornar os dados da rota atual
         * @return array
         */

        private function getRoute(){
            // URI
            $uri = $this->getUri();

            // METHOD
            $httpMethod = $this->request->getHttpMethod();
            
            // VALIDA AS ROTAS 
            foreach($this->routes as $patternRoute => $methods){
                // VERIFICA SE A ROTA BATE COM O PADRÃO 
                
                if(preg_match($patternRoute,$uri,$matches)){
                    // VERIFICA O METODO 
                    
                    if(isset($methods[$httpMethod])){
                        // REMOVE A PRIMEIRA POSIÇÃO
                        unset($matches[0]);
                        
                        // VARIÁVEIS PROCESSADAS
                        $keys = $methods[$httpMethod]['variables'];
                        $methods[$httpMethod]['variables'] = array_combine($keys,$matches);
                        $methods[$httpMethod]['variables']['request'] = $this->request;

                        // RETORNO DOS PARÊMETROS DA ROTA
                        return $methods[$httpMethod];
                    }else{
                        // MÉTODO NÃO PERMITIDO DEFINIDO
                        throw new Exception("Método não é permitido", 405);
                    }
                }
            }

            // URAL NÃO ENCONTRADA
            throw new Exception("URL não encontrada", 404);
        }

        /**
         *  Método responsável por executar a rota atual
         * @return Response
         */

        public function run(){
            try
            {
                // OBTEM A ROTA ATUAL
                $route = $this->getRoute();
                
                // VERIFICA O CONTROLADOR
                if(!isset($route['controller'])){
                    throw new Exception("A URL não pôde ser processada", 500);
                }

                // ARGUMENTOS DA FUNÇÃO
                $args = [];

                // REFLECTION FUNCTION 
                $reflection = new ReflectionFunction($route['controller']);
                foreach($reflection->getParameters() as $parameter){
                    $name  = $parameter->getName();
                    $args[$name] = $route['variables'][$name] ?? '';
                }
               
                // RETORNA A EXECUÇÃO DA FILA DE MIDDLEWARES
                return (new Queue($route['middlewares'],$route['controller'],$args))->next($this->request);
            }catch(Exception $e)
            {
                
                return new Response($e->getCode(), $e->getMessage());
            }
        }

        /**
         * Método responsável por pegar a URL sem os GETs
         * @return string
         */
        public function getCurrentUrl(){
            return $this->url.$this->getUri();
        }

        /**
         * Método responsável por fazer o redirecionamento da página
         * @param string
         */
        public function redirect($route){
            // REDIRECIONA
            header('location: '.$this->url.$route);
            exit;
        }
    }