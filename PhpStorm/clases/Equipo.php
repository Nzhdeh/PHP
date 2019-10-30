<?php


/*
 * aqui iria el estudio de la interfaz
 */
class Equipo
{
    private $id;
    private $nombre;
    private $jugadores;

    function __construct($id,$nombre,$jugadores)
    {
        $this->id=$id;//entero
        $this->nombre=$nombre;//cadena
        $this->jugadores=$jugadores;//array de jugadores
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getJugadores()
    {
        return $this->jugadores;
    }

    /**
     * @param mixed $jugadores
     */
    public function setJugadores($jugadores)
    {
        $this->jugadores = $jugadores;
    }
}