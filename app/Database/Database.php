<?php

namespace App\Database;

use \PDOException;
use \PDO;

class Database 
{
    /**
     * Host do banco de dados
     * @var string
     */
    private static $HOST;

    /**
     * Nome do banco 
     * @var string
     */
    private static $DBNAME;

    /**
     * Usuário do banco 
     * @var string
     */
    private static $USER;

    /**
     * Senha do banco 
     * @var string
     */
    private static $PASS;

    /**
     * Instância de PDO 
     * @var PDO
     */
    private $connection;

    /**
     * Nome da tabela 
     * @var string 
     */
    private $table;

    /**
     * Método responsável por iniciar a classe 
     */
    public function __construct($table){
        $this->table = $table;
        $this->connect();
    }

    /**
     * Método responsável por carregar as Constantes
     */
    public static function config($HOST, $DBNAME, $USER, $PASS){
        self::$HOST = $HOST;
        self::$DBNAME = $DBNAME;
        self::$USER = $USER;
        self::$PASS = $PASS;
    }

    /**
     * Método responsável por conectar ao banco de dados
     */
    public function connect(){
        try{
            $this->connection = new PDO("mysql:host=".self::$HOST."; dbname=".self::$DBNAME,self::$USER,self::$PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('Erro ao conectar '.$e->getMessage());
        }
    }

    /**
     * Método responsável por executar a query
     * @param string $qquery
     */
    public function execute($query, $params = []){
        try
        {
            $statment = $this->connection->prepare($query);
            $statment->execute($params);

            return $statment;
        }catch(PDOException $e){
            die("Erro ao executar a query ".$e->getMessage());
        }
    }

    /**
     * Método responsável por fazer um consulta no banco 
     * @param string $where
     * @param string $order
     * @param integer $limit
     * @param string $field
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $field = '*'){
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

        $query = "SELECT ".$field." FROM ".$this->table." ".$where." ".$order." ".$limit;
        
        return $this->execute($query);
    }
}