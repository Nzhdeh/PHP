<?php

    Class Jugador
    {

        var $id;
        var $nombre;
        var $apellidos;
        var $edad;
        var $idEquipo;
        

        function __construct($id, $nombre, $apellidos, $edad, $idEquipo)
        {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->edad = $edad;
            $this->idEquipo = $idEquipo;
        }

        function setId($id) { $this->id = $id; }
        function getId() { return $this->id; }

        function setNombre($nombre) { $this->nombre = $nombre; }
        function getNombre() { return $this->nombre; }

        function setApellidos($apellidos) { $this->apellidos = $apellidos; }
        function getApellidos() { return $this->apellidos; }

        function setEdad($edad) { $this->edad = $edad; }
        function getEdad() { return $this->edad; }

        function getIdEquipo() { return $this->idEquipo; }
        function setIdEquipo($idEquipo) { $this->idEquipo = $idEquipo; }

        function __toString()
        {
            return (string)$this->id . " " . $this->nombre . " " . $this->apellidos . " " . $this->edad . " años";
        }

    }