<?php

require_once "Database.php";
require_once "../Constantes/TablaEquipos.php";
require_once "../Entidades/Equipo.php";
require_once "GestionJugadores.php";

Class GestionEquipos
{
    var $conexion;
    var $jugadores;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    /**
     * Comentario: Obtiene un equipo de la base de datos dado su ID.
     * Prototipo: function obtenerEquipoPorId($id)
     * Entrada: El ID del equipo a buscar
     * Salida: Un objeto Equipo con los datos del equipo con el ID dado.
     * Precondiciones: La conexión con la base de datos debe estar abierta.
     * Postcondiciones: Asociado al nombre devuelve un Equipo con todos los datos sacado de la base de datos.
     */
    function obtenerEquipoPorId($id)
    {
        $gestionJugadores = new GestionJugadores($this->conexion);

        $consulta = "SELECT ". \Constantes_DB\TablaEquipos::ID . " , "
        . \Constantes_DB\TablaEquipos::NOMBRE
        ." FROM ". \Constantes_DB\TablaEquipos::TABLE_NAME."
        WHERE ". \Constantes_DB\TablaEquipos::ID . " = ".$id;

        $resultado = $this->conexion->query($consulta);

        $equipos = array();
        $jugadores = array();

        if($resultado->num_rows > 0)
        {
           $row = $resultado->fetch_assoc();

            $jugadores = $gestionJugadores->obtenerJugadoresPorEquipo($row[\Constantes_DB\TablaEquipos::ID]);

            //echo "Numero de jugadores " . $jugadores[0]->getNombre() . "<br>";

            $equipo = new Equipo(
                $row[\Constantes_DB\TablaEquipos::ID],
                $row[\Constantes_DB\TablaEquipos::NOMBRE],
                $jugadores);
        }

        return $equipo;
    }

    /**
     * Comentario: Obtiene todos los equipos de la base de datos.
     * Prototipo: function obtenerTodosLosEquipos()
     * Entrada: No hay
     * Salida: Un array con todos los equipos de la base de datos.
     * Precondiciones: La conexión con la base de datos debe estar abierta.
     * Postcondiciones: Asociado al nombre devuelve un array con todos los equipos de la base de datos.
     */
    function obtenerTodosLosEquipos()
    {
        $gestionJugadores = new GestionJugadores($this->conexion);

        $consulta = "SELECT ". \Constantes_DB\TablaEquipos::ID . " , "
        . \Constantes_DB\TablaEquipos::NOMBRE
        ." FROM ". \Constantes_DB\TablaEquipos::TABLE_NAME;

        $resultado = $this->conexion->query($consulta);

        $equipos = array();
        $jugadores = array();

        if($resultado->num_rows > 0)
        {

            while($row = $resultado->fetch_assoc()) 
            {
                $jugadores = $gestionJugadores->obtenerJugadoresPorEquipo($row[\Constantes_DB\TablaEquipos::ID]);

                //echo "Numero de jugadores " . $jugadores[0]->getNombre() . "<br>";

                $equipo = new Equipo(
                    $row[\Constantes_DB\TablaEquipos::ID],
                    $row[\Constantes_DB\TablaEquipos::NOMBRE],
                    $jugadores);
                
                array_push($equipos, $equipo);
            }
        }

        return $equipos;
    }

    /**
     * Comentario: Borra el equipo y sus jugadores de la base de datos según el ID dado.
     * Prototipo: function borrarEquipo($id)
     * Entrada: La ID del equipo a borrar.
     * Salida: No hay
     * Precondiciones: La conexión con la base de datos debe estar abierta.
     * Postcondiciones: Borra de la base de datos el equipo y los jugadores del equipo de la ID dada
     */
    function borrarEquipo($id)
    {
        $stmt = $this->conexion->prepare("DELETE FROM ". \Constantes_DB\TablaEquipos::TABLE_NAME . " WHERE " . \Constantes_DB\TablaEquipos::ID . " = ?");

        $stmt->bind_param('i', $id);

        $stmt->execute();

        $stmt->close();
    }

    /**
     * Comentario: Inserta un equipo en la base de datos.
     * Prototipo: insertarEquipo($equipo)
     * Entrada: $equipo El equipo a insertar en la base de datos.
     * Salida: No hay
     * Precondiciones: La conexión con la base de datos debe estar abierta.
     * Postcondiciones: Inserta el equipo en la base de datos, si la ID correspondiente al objeto Equipo dado ya existe en la base de datos, la función no hará nada.
     */
    function insertarEquipo($equipo)
    {
        $stmt = $this->conexion->prepare("INSERT INTO ".\Constantes_DB\TablaEquipos::TABLE_NAME." (
                                        ".\Constantes_DB\TablaEquipos::NOMBRE.") VALUES(?)");

        $nombre = $equipo->getNombre();

        $bind = $stmt->bind_param('s', $nombre);

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

}