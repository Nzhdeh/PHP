<?php


class Formato implements JsonSerializable
{
    private $idFprmato;
    private $nombre;
    private $tamaño;
    private $numPaginas;

    public function __construct($idFprmato,$nombre,$tamaño,$numPaginas)
    {
        $this->$idFprmato=$idFprmato;
        $this->$nombre=$nombre;
        $this->$tamaño=$tamaño;
        $this->numPaginas=$numPaginas;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return array(
            'idFormato' => $this->$idFprmato,
            'nombre' => $this->nombre,
            'tamaño' => $this->tamaño,
            'numPaginas'=>$this->numPaginas
        );
    }

    public function __sleep(){
        return array('idFormato' , 'nombre' , 'tamaño','numPaginas' );
    }

    /**
     * @return mixed
     */
    public function getIdFprmato()
    {
        return $this->idFprmato;
    }

    /**
     * @param mixed $idFprmato
     */
    public function setIdFprmato($idFprmato)
    {
        $this->idFprmato = $idFprmato;
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
    public function getTamaño()
    {
        return $this->tamaño;
    }

    /**
     * @param mixed $tamaño
     */
    public function setTamaño($tamaño)
    {
        $this->tamaño = $tamaño;
    }

    /**
     * @return mixed
     */
    public function getNumPaginas()
    {
        return $this->numPaginas;
    }

    /**
     * @param mixed $numPaginas
     */
    public function setNumPaginas($numPaginas)
    {
        $this->numPaginas = $numPaginas;
    }
}