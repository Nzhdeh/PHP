<?php
require_once "Libros.php";
require_once "Formato.php";

class LibroFormato implements JsonSerializable
{
    //creo que aqui es mejor poner un objeto Libro y Un objeto Formato
    private $libro;
    private $formato;

    public function __construct(Libro $libro,Formato $formato)
    {
        $this->codigoLibro=$libro;
        $this->idFormato=$formato;
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
            'libro' => $this->libro,
            'formato' => $this->formato
        );
    }

    public function __sleep(){
        return array('titulo '.$this->libro->getCodigo(). ' codigo '.$this->libro->getTitulo
        . ' numPaginas '. $this->formato->getIdFormato() .' nombreFromato '.$this->formato->getNombre);
    }

    /**
     * @return mixed
     */
    public function getLibro()
    {
        return $this->libro;
    }

    /**
     * @param mixed $libro
     */
    public function setLibro($libro)
    {
        $this->libro = $libro;
    }

    /**
     * @return mixed
     */
    public function getFormato()
    {
        return $this->formato;
    }

    /**
     * @param mixed $formato
     */
    public function setFormato($formato)
    {
        $this->formato = $formato;
    }

    /**
     * @return Libro
     */
    public function getCodigoLibro()
    {
        return $this->codigoLibro;
    }

    /**
     * @return Formato
     */
    public function getIdFormato()
    {
        return $this->idFormato;
    }
}