<?php

require_once "ConsLibrosModel.php";


class LibroHandlerModel
{
    //esta es la funcion que obtiene un libro en concreto por su codigo
    public static function getLibro($id)
    {
        $listaLibros = null;
        $libro = null;
        $ret = null;
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $valid = self::isValid($id);


        if ($valid === true || $id == null) {
            $query = "SELECT " ." L.". \ConstantesDB\ConsLibrosModel::COD . ","
                ." L.". \ConstantesDB\ConsLibrosModel::TITULO . "," .\ConstantesDB\ConsFormatoModel::NOMBRE ."," .\ConstantesDB\ConsFormatoModel::NUMPAG .
                 " FROM " . \ConstantesDB\ConsLibrosModel::TABLE_NAME ." as L "
            . " inner join ". \ConstantesDB\ConsLibrosFormatoModel::TABLE_NAME ." as LF " . " on ". " L.".\ConstantesDB\ConsLibrosModel::COD." = "." LF".\ConstantesDB\ConsLibrosFormatoModel::CODLIBRO
            ." inner join ". \ConstantesDB\ConsFormatoModel::TABLE_NAME . "as F ". " on ". " LF.".\ConstantesDB\ConsLibrosFormatoModel::CODLIBRO." = "." F.".\ConstantesDB\FormatoModel::ID;

            //esto es para cuando queremos un libro en concreto
            if ($id != null) {
                $query = $query . " WHERE " . \ConstantesDB\ConsLibrosModel::COD . " = ?";
            }

            $prep_query = $db_connection->prepare($query);

            if ($id != null) {
                $prep_query->bind_param('i', $id);
            }

            $prep_query->execute();

            //esto esta mal,deberia ser de tipo LibroFormato que contiene a libro y a formato
            $listaLibros = array();


            $prep_query->bind_result($cod, $tit, $pag);
            while ($prep_query->fetch()) {
                $tit = utf8_encode($tit);
                $libro = new LibroModel($cod, $tit, $pag);
                $listaLibros[] = $libro;
            }
        }

        if(count($listaLibros) == 1){

            $ret = $listaLibros[0];

        }else{

            $ret = $listaLibros;
        }
        $db_connection->close();
        return $ret;
    }

    //esta es la funcion que obtiene todos los libros
    public static function getLibros()
    {
        $listaLibros = null;
        $libro = null;
        $ret = null;
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        //$valid = self::isValid($id);


        //if ($valid === true || $id == null) {
            $query = "SELECT " ." L.". \ConstantesDB\ConsLibrosModel::COD . ","
                ." L.". \ConstantesDB\ConsLibrosModel::TITULO . "," .\ConstantesDB\ConsFormatoModel::NOMBRE ."," .\ConstantesDB\ConsFormatoModel::NUMPAG .
                " FROM " . \ConstantesDB\ConsLibrosModel::TABLE_NAME ." as L "
                . " inner join ". \ConstantesDB\ConsLibrosFormatoModel::TABLE_NAME ." as LF " . " on ". " L.".\ConstantesDB\ConsLibrosModel::COD." = "." LF".\ConstantesDB\ConsLibrosFormatoModel::CODLIBRO
                ." inner join ". \ConstantesDB\ConsFormatoModel::TABLE_NAME . "as F ". " on ". " LF.".\ConstantesDB\ConsLibrosFormatoModel::CODLIBRO." = "." F.".\ConstantesDB\FormatoModel::ID;

            //esto es para cuando queremos un libro en concreto
//            if ($id != null) {
//                $query = $query . " WHERE " . \ConstantesDB\ConsLibrosModel::COD . " = ?";
//            }

            $prep_query = $db_connection->prepare($query);

            //if ($id != null) {
                $prep_query->bind_param('s', $id);
            //}

            $prep_query->execute();

        //esto esta mal,deberia ser de tipo LibroFormato que contiene a libro y a formato
            $listaLibros = array();

            $prep_query->bind_result($cod, $tit, $pag);
            while ($prep_query->fetch()) {
                $tit = utf8_encode($tit);
                $libro = new LibroModel($cod, $tit, $pag);
                $listaLibros[] = $libro;
            }
        //}

//        if(count($listaLibros) == 1){
//
//            $ret = $listaLibros[0];
//
//        }else{

            $ret = $listaLibros;
        //}
        $db_connection->close();
        return $ret;
    }

    //returns true if $id is a valid id for a book
    //In this case, it will be valid if it only contains
    //numeric characters, even if this $id does not exist in
    // the table of books
    public static function isValid($id)
    {
        $res = false;

        if (ctype_digit($id)) {
            $res = true;
        }
        return $res;
    }
}