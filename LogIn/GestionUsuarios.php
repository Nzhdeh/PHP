<?php

require_once "ConexionBD.php";

class gestionUsuarios
{

    function insertarUsuario($user, $psw) {

        $conBD = ConexionBD::getInstance();
        $conexion = $conBD->getConnection();

        $passw = password_hash($psw,PASSWORD_BCRYPT);

        $stmt = $conexion->prepare("INSERT INTO Usuarios(UserName,Password) VALUES(?,?)");
        $stmt->bind_param('ss',$usu,$psw);

        $usu = $user;
        $psw = $passw;

        $result = $stmt->execute();

        $stmt->close();
        $conBD->closeConnection();

        return $result;
    }

    function  consultarUsuario($user){

        $ret = false;

        $conBD = ConexionBD::getInstance();
        $conexion = $conBD->getConnection();

        $stmt = $conexion->prepare("SELECT * FROM Usuarios WHERE NombreUsuario=?");
        $stmt->bind_param('s',$user);

        $stmt->execute();
        $result = $stmt->get_result();

        if($stmt->affected_rows>0)
        {
            $ret = true;
        }

        $stmt->close();
        $conBD->closeConnection();

        return $ret;

    }


    
    function obtenerHash($user){

        $conBD = ConexionBD::getInstance();
        $conexion = $conBD->getConnection();

        $stmt = $conexion->prepare("SELECT contraseña FROM Usuarios WHERE NombreUsuario=?");
        $stmt->bind_param('s',$user);

        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        $stmt->close();
        $conBD->closeConnection();

        return $row;
    }

}