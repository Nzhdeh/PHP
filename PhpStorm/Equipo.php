<?php


class Equipo
{
    private $id;
    private $nombre;
    private $jugadores;

    function __construct($id,$nombre,$jugadores)
    {
        $this->id=$id;
        $this->nombre=$nombre;
        $this->jugadores=$jugadores;
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
}