<?php


class Libro implements JsonSerializable
{
    private $codigo;
    private $titulo;

    public function __construct($codigo,$titulo)
    {
        $this->codigo=$codigo;
        $this->titulo=$titulo;
    }

    //es para el json
    function jsonSerialize()
    {
        return array(
            'titulo' => $this->titulo,
            'codigo' => $this->codigo
        );
    }

    public function __sleep(){
        return array('titulo' , 'codigo' , 'numpag' );
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }
}