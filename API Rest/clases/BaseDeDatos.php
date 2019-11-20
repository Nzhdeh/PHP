<?php


class BaseDeDatos
{
    private $host = "localhost";
    private $db_name = "api_db";//creo que aqui va el nombre de mi bbdd
    private $username = "root";
    private $password = "root";//nunca contraseña vacia
    public $conn;

    // coneccion
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

}