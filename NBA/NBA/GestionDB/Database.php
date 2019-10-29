<?php

class Database
{

    private $_connection;
    private static $_instance;

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) // Si no hay instancia de Database, crea una
        { 
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function __construct()
    {
        $config = parse_ini_file('../config/config.ini');

        $this->_connection = new mysqli($config['host'], $config['username'],
            $config['password'], $config['dbname']);

        if ($this->_connection->connect_error) {
            trigger_error("Fallo al conectar a MySQL: " . $this->_connection->connect_error,
                E_USER_ERROR);
        }
    }

    public function __clone()
    {
        trigger_error("Clonado de " . get_class($this) . " no permitido: ", E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error("Deserializacion de " . get_class($this) . " no permitido: ", E_USER_ERROR);
    }

    public function getConnection()
    {
        return $this->_connection;
    }

    
    public function closeConnection()
    {
        $this->_connection->close();
        self::$_instance=null;
    }

    public function reconnect(){
        $this->_connection->close();
        self::$_instance=null;
        return self::getInstance()->getConnection();
    }

}
