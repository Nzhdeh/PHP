<?php

require_once "Database.php";
require_once "../Constantes/TablaJugadores.php";
require_once "../Constantes/TablaEquipos.php";
require_once "../Entidades/Jugador.php";
require_once "../Entidades/Equipo.php";

Class GestionJugadores
{
    var $conexion;
    var $jugadores;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    /**
     * Comentario: Obtiene todos los jugadores de la base de datos
     * Prototipo: function obtenerTodosLosJugadores()
     * Entrada: No hay
     * Salida: Un array con todos los jugadores de la base de datos.
     * Precondiciones: La conexión con la base de datos debe estar abierta.
     * Postcondiciones: Asociado al nombre devuelve un array con todos los jugadores de la base de datos.
     */
    function obtenerTodosLosJugadores()
    {
        $consulta = "SELECT ". \Constantes_DB\TablaJugadores::ID . " , "
        . \Constantes_DB\TablaJugadores::NOMBRE . " , "
        . \Constantes_DB\TablaJugadores::APELLIDOS . " , "
        . \Constantes_DB\TablaJugadores::EDAD . " ," 
        . \Constantes_DB\TablaJugadores::IDEQUIPO . " "
        ." FROM ". \Constantes_DB\TablaJugadores::TABLE_NAME;

        $resultado = $this->conexion->query($consulta);

        if($resultado->num_rows > 0)
        {
            $jugadores = array();

            while($row = $resultado->fetch_assoc()) 
            {
                $jugador = new Jugador(
                    $row[\Constantes_DB\TablaJugadores::ID],
                    $row[\Constantes_DB\TablaJugadores::NOMBRE], 
                    $row[\Constantes_DB\TablaJugadores::APELLIDOS], 
                    $row[\Constantes_DB\TablaJugadores::EDAD],
                    $row[\Constantes_DB\TablaJugadores::IDEQUIPO]);
                
                array_push($jugadores, $jugador);
            }
        }

        return $jugadores;
    }

    /**
     * Comentario: Obtiene todos los jugadores de un equipo de la base de datos
     * Prototipo: function obtenerJugadoresPorEquipo($idEquipo)
     * Entrada: $idEquipo la ID del equipo del que se desea obtener todos sus jugadores
     * Salida: Un array con todos los jugadores de un equipo.
     * Precondiciones: La conexión con la base de datos debe estar abierta.
     * Postcondiciones: Asociado al nombre devuelve un array con todos los jugadores de un equipo en base de datos.
     */
    function obtenerJugadoresPorEquipo($idEquipo)
    {
        $consulta = "SELECT ". \Constantes_DB\TablaJugadores::ID . " , "
        . \Constantes_DB\TablaJugadores::NOMBRE . " , "
        . \Constantes_DB\TablaJugadores::APELLIDOS . " , "
        . \Constantes_DB\TablaJugadores::EDAD . " ," 
        . \Constantes_DB\TablaJugadores::IDEQUIPO . " "
        ." FROM ". \Constantes_DB\TablaJugadores::TABLE_NAME. " WHERE " . \Constantes_DB\TablaJugadores::IDEQUIPO  . " = " . $idEquipo;

        $resultado = $this->conexion->query($consulta);

        $jugadores = array();

        if($resultado->num_rows > 0)
        {
            while($row = $resultado->fetch_assoc()) 
            {
                $jugador = new Jugador(
                    $row[\Constantes_DB\TablaJugadores::ID],
                    $row[\Constantes_DB\TablaJugadores::NOMBRE], 
                    $row[\Constantes_DB\TablaJugadores::APELLIDOS], 
                    $row[\Constantes_DB\TablaJugadores::EDAD],
                    $row[\Constantes_DB\TablaJugadores::IDEQUIPO]);
                
                array_push($jugadores, $jugador);
            }
        }

        return $jugadores;
    }

    /**
     * Comentario: Borra un jugador de la base de datos dado su ID.
     * Prototipo: borrarJugador($id)
     * Entrada: $id la ID del jugador que se desea borrar.
     * Salida: No hay
     * Precondiciones: La conexión con la base de datos debe estar abierta.
     * Postcondiciones: Elimina el jugador de la base de datos correspondiente al ID dado, si no hay ningún jugador con dicha ID, la función no hace nada.
     */
    function borrarJugador($id)
    {
        $stmt = $this->conexion->prepare("DELETE FROM ".\Constantes_DB\TablaJugadores::TABLE_NAME." WHERE ".\Constantes_DB\TablaJugadores::ID." = (?)");

        $bind = $stmt->bind_param('i', $id);

        /*if ($bind === false)
        {
            echo "ERROR AL BINDEAR";
        } */

        $stmt->execute();

        /*if ( false === $stmt ) {
            echo "ERROR AL EJECUTAR";
        }*/

        $stmt->close();
    }

    /**
     * Comentario: Actualiza un jugador de la base de datos dado su ID.
     * Prototipo: actualizarJugador($jugador)
     * Entrada: $jugador El objeto Jugador con el jugador a actualizar, se utilizará su ID para localizarlo en la base de datos y el resto de atributos para modificarlo.
     * Salida: No hay
     * Precondiciones: La conexión con la base de datos debe estar abierta.
     * Postcondiciones: Actualiza el jugador de la base de datos, utilizando su ID para localizarlo y el resto de atributos para actualizarlo.
     *                  Si no hay ningún jugador con el ID del objeto Jugador dado, la función no hará nada.
     */
    function actualizarJugador($jugador)
    {
        $stmt = $this->conexion->prepare("UPDATE ".\Constantes_DB\TablaJugadores::TABLE_NAME." SET ".\Constantes_DB\TablaJugadores::NOMBRE." = ? ,
                                                               ".\Constantes_DB\TablaJugadores::APELLIDOS." = ? ,
                                                               ".\Constantes_DB\TablaJugadores::EDAD." = ? , 
                                                               ".\Constantes_DB\TablaJugadores::IDEQUIPO." = ? WHERE ".\Constantes_DB\TablaJugadores::ID." = (?)");

        $id = $jugador->getId();
        $nombre = $jugador->getNombre();
        $apellidos = $jugador->getApellidos();
        $edad = $jugador->getEdad();
        $idEquipo = $jugador->getIdEquipo();

        $bind = $stmt->bind_param('ssiii', $nombre, $apellidos, $edad, $idEquipo, $id);

        /*if ($bind === false)
        {
            echo "ERROR AL BINDEAR";
        }

         $stmt->bind_param('s', $jugador->getNombre());
        $stmt->bind_param('s', $jugador->getApellidos());
        $stmt->bind_param('i', $jugador->getEdad());
        $stmt->bind_param('i', $jugador->getIdEquipo());
        $stmt->bind_param('i', $jugador->getId()); */

        $stmt->execute();

        $stmt->close();
    }

    /**
     * Comentario: Inserta un jugador en la base de datos.
     * Prototipo: actualizarJugador($jugador)
     * Entrada: $jugador El jugador a insertar en la base de datos.
     * Salida: No hay
     * Precondiciones: La conexión con la base de datos debe estar abierta.
     * Postcondiciones: Inserta el jugador en la base de datos, si la ID correspondiente al objeto Jugador dado ya existe en la base de datos, la función no hará nada.
     */
    function insertarJugador($jugador)
    {
        $stmt = $this->conexion->prepare("INSERT INTO ".\Constantes_DB\TablaJugadores::TABLE_NAME." (
                                                                 ".\Constantes_DB\TablaJugadores::NOMBRE.", 
                                                                 ".\Constantes_DB\TablaJugadores::APELLIDOS.", 
                                                                 ".\Constantes_DB\TablaJugadores::EDAD.", 
                                                                 ".\Constantes_DB\TablaJugadores::IDEQUIPO.") VALUES(?,?,?,?)");

        $nombre = $jugador->getNombre();
        $apellidos = $jugador->getApellidos();
        $edad = $jugador->getEdad();
        $idEquipo = $jugador->getIdEquipo();

        $bind = $stmt->bind_param('ssii', $nombre, $apellidos, $edad, $idEquipo);

        if ($bind === false)
        {
            echo "ERROR AL BINDEAR";
        }

        $stmt->execute();

        if($stmt === false)
        {
            echo "ERROR AL EJEECUTAR";
        }

        $stmt->close();
    }

    /**
     * Comentario: Obtiene el equipo perteneciente al jugador dado
     * Prototipo: obtenerEquipoDeJugador($jugador)
     * Entrada: $jugador El jugador del que se desea obtener su equipo
     * Salida: El objeto Equipo perteneciente al jugador dado.
     * Precondiciones: La conexión con la base de datos debe estar abierta.
     * Postcondiciones: Asociado al nombre devuelve el objeto Equipo al cual el jugador pasado por parametro pertenece en la base de datos.
     *                  Se utiliza la ID del jugador para buscarlo en la base de datos y buscar a qué equipo pertenece.
     */
    function obtenerEquipoDeJugador($jugador)
    {
        $stmt = $this->conexion->prepare("SELECT ".\Constantes_DB\TablaEquipos::TABLE_NAME.".".\Constantes_DB\TablaEquipos::ID.",
                                        ".\Constantes_DB\TablaEquipos::TABLE_NAME.".".\Constantes_DB\TablaEquipos::NOMBRE."
                                         FROM ".\Constantes_DB\TablaJugadores::TABLE_NAME."
                                         INNER JOIN ".\Constantes_DB\TablaEquipos::TABLE_NAME."
                                         ON ".\Constantes_DB\TablaJugadores::TABLE_NAME.".".\Constantes_DB\TablaJugadores::IDEQUIPO."
                                         = ".\Constantes_DB\TablaEquipos::TABLE_NAME.".".\Constantes_DB\TablaEquipos::ID."
                                         WHERE ".\Constantes_DB\TablaJugadores::TABLE_NAME.".".\Constantes_DB\TablaJugadores::ID." = ?");

        $idJugador = $jugador->getId();

        $bind = $stmt->bind_param('i', $idJugador);

        $stmt->execute();

        $resultado = $stmt->get_result();

        $fila = $resultado->fetch_assoc();

        $equipo = new Equipo($fila["id"], $fila["nombre"], null);

        $stmt->close();

        return $equipo;
    }


}