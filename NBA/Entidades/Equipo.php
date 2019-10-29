<?php

    Class Equipo
    {
        var $id;
        var $nombre;
        var $jugadores;

        function __construct($id, $nombre, $jugadores)
        {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->jugadores = $jugadores;
        }

        function getId() { return $this->id; }
        function setId($id) { $this->id = $id; }

        function getNombre() { return $this->nombre; }
        function setNombre($nombre) { $this->nombre = $nombre; }

        function getEquipos() { return $this->equipos; }
        function setEquipos($equipos) { $this->equipos = $equipos; }

        /**
         * Comentario: obtiene el número de jugadores que tiene el equipo.
         * Prototipo: function numeroJugadores()
         * Entrada: No hay
         * Salida: El número de jugadores
         * Precondiciones: No hay
         * Postcondiciones: Asociado al nombre devuelve el número de jugadores que tiene el equipo.
         */
        function numeroJugadores() { return sizeof($this->jugadores); }
    }