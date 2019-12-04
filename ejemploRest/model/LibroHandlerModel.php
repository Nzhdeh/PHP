<?php

require_once "ConsLibrosModel.php";


class LibroHandlerModel
{

    public static function getLibro($id)
    {
        $listaLibros = null;
        $libro = null;
        $ret = null;
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();


        //IMPORTANT: we have to be very careful about automatic data type conversions in MySQL.
        //For example, if we have a column named "cod", whose type is int, and execute this query:
        //SELECT * FROM table WHERE cod = "3yrtdf"
        //it will be converted into:
        //SELECT * FROM table WHERE cod = 3
        //That's the reason why I decided to create isValid method,
        //I had problems when the URI was like libro/2jfdsyfsd

        $valid = self::isValid($id);

        //If the $id is valid or the client asks for the collection ($id is null)
        if ($valid === true || $id == null) {
            $query = "SELECT " . \ConstantesDB\ConsLibrosModel::COD . ","
                . \ConstantesDB\ConsLibrosModel::TITULO . ","
                . \ConstantesDB\ConsLibrosModel::PAGS . " FROM " . \ConstantesDB\ConsLibrosModel::TABLE_NAME;


            if ($id != null) {
                $query = $query . " WHERE " . \ConstantesDB\ConsLibrosModel::COD . " = ?";
            }

            $prep_query = $db_connection->prepare($query);

            //IMPORTANT: If we do not want to expose our primary keys in the URIS,
            //we can use a function to transform them.
            //For example, we can use hash_hmac:
            //http://php.net/manual/es/function.hash-hmac.php
            //In this example we expose primary keys considering pedagogical reasons

            if ($id != null) {
                $prep_query->bind_param('s', $id);
            }

            $prep_query->execute();
            $listaLibros = array();


            //IMPORTANT: IN OUR SERVER, I COULD NOT USE EITHER GET_RESULT OR FETCH_OBJECT,
            // PHP VERSION WAS OK (5.4), AND MYSQLI INSTALLED.
            // PROBABLY THE PROBLEM IS THAT MYSQLND DRIVER IS NEEDED AND WAS NOT AVAILABLE IN THE SERVER:
            // http://stackoverflow.com/questions/10466530/mysqli-prepared-statement-unable-to-get-result

            $prep_query->bind_result($cod, $tit, $pag);
            while ($prep_query->fetch()) {
                $tit = utf8_encode($tit);
                $libro = new LibroModel($cod, $tit, $pag);
                $listaLibros[] = $libro;
            }

//            $result = $prep_query->get_result();
//            for ($i = 0; $row = $result->fetch_object(LibroModel::class); $i++) {
//
//                $listaLibros[$i] = $row;
//            }
        }

        if(count($listaLibros) == 1){

            $ret = $listaLibros[0];

        }else{

            $ret = $listaLibros;
        }
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

    /* Borrar libro
    borra libro con id indicada
    Devuelve filas afectadas
     * */
    public static function deleteLibro($id)
    {
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();
        $filasAfectadas = 0;

        //IMPORTANT: we have to be very careful about automatic data type conversions in MySQL.
        //For example, if we have a column named "cod", whose type is int, and execute this query:
        //SELECT * FROM table WHERE cod = "3yrtdf"
        //it will be converted into:
        //SELECT * FROM table WHERE cod = 3
        //That's the reason why I decided to create isValid method,
        //I had problems when the URI was like libro/2jfdsyfsd

        $valid = self::isValid($id);

        //If the $id is valid
        // id no puede ser null porque el cliente no puede borrar la coleccion
        if ($valid === true ) {
            $query = "DELETE FROM " . \ConstantesDB\ConsLibrosModel::TABLE_NAME
                . " WHERE " . \ConstantesDB\ConsLibrosModel::COD . " = ?";


            $prep_query = $db_connection->prepare($query);
            $prep_query->bind_param('s', $id);


            $prep_query->execute();

            //IMPORTANT: IN OUR SERVER, I COULD NOT USE EITHER GET_RESULT OR FETCH_OBJECT,
            // PHP VERSION WAS OK (5.4), AND MYSQLI INSTALLED.
            // PROBABLY THE PROBLEM IS THAT MYSQLND DRIVER IS NEEDED AND WAS NOT AVAILABLE IN THE SERVER:
            // http://stackoverflow.com/questions/10466530/mysqli-prepared-statement-unable-to-get-result


            $db_connection->close();
            $filasAfectadas = $prep_query->affected_rows;

        }
        return $filasAfectadas;
    }


    /* Insertar libro
       inserta libro (objeto LibroModel)
       Devuelve filas afectadas
       Recibo los parametros del body
        */
    public static function postLibro($bodyParameters)
    {
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();
        $libroCreado = null;
        $filasAfectadas = 0;


        $titulo = $bodyParameters->titulo; //en teoria esto es el titulo
        $numPags = $bodyParameters->numpag; //esto el n paginas


            $query = "INSERT INTO ".\ConstantesDB\ConsLibrosModel::TABLE_NAME
                    ."(".
                    \ConstantesDB\ConsLibrosModel::TITULO .
                ",".
                    \ConstantesDB\ConsLibrosModel::PAGS
                     .")".
                        "VALUES(?,?)";


            $prep_query = $db_connection->prepare($query);
            // esto es asi ??
            $prep_query->bind_param('si', $titulo, $numPags);

            $prep_query->execute();

        $filasAfectadas = $prep_query->affected_rows;

        $db_connection->close();



        return $filasAfectadas;
    }


    /* Actualiza libro

       Devuelve filas afectadas
       Recibo los parametros del body
        */
    public static function putLibro($bodyParameters, $id)
    {
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();
        $libroCreado = null;
        $filasAfectadas = 0;

        $cod = $id;
        $titulo = $bodyParameters->titulo; //en teoria esto es el titulo
        $numPags = $bodyParameters->numpag; //esto el n paginas


        $query = "UPDATE ".\ConstantesDB\ConsLibrosModel::TABLE_NAME
            ." SET ".
            \ConstantesDB\ConsLibrosModel::TITULO .
            " = ? ,".
            \ConstantesDB\ConsLibrosModel::PAGS
            ."= ? " .
            " WHERE " .
            \ConstantesDB\ConsLibrosModel::COD .
            " = ?"
            ;


        $prep_query = $db_connection->prepare($query);
        // esto es asi ??
        $prep_query->bind_param('sii', $titulo, $numPags, $cod);

        $prep_query->execute();

        $filasAfectadas = $prep_query->affected_rows;

        $db_connection->close();



        return $filasAfectadas;
    }



}