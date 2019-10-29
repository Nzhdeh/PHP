<?php
require_once "../GestionDB/Database.php";
require_once "../Constantes/TablaJugadores.php";
require_once "../GestionDB/GestionJugadores.php";
require_once "../GestionDB/GestionEquipos.php";
require_once "../Entidades/Jugador.php";
require_once "../Utils/Utils.php";

$bd = Database::getInstance();
$conexion = $bd->getConnection();

$gestionEquipos = new GestionEquipos($conexion);

$equipos = $gestionEquipos->obtenerTodosLosEquipos();

$background = Utils::randomBackground();

echo '<head>';
echo '<link rel="stylesheet" type="text/css" href="CSS/estilo.css">';
echo '<link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">';
echo '<title>Nuevo jugador</title>';
echo '</head>';

echo '<body background="images/backgrounds/'.$background.'">';

echo '<div>';

echo '<p id="tituloPagina">NUEVO JUGADOR</p>';

echo '<form action="../Scripts/nuevoJugador.php" method="POST">';
echo '<input id="campoTexto" name="id" type="hidden"></input><br>';
echo '<label>Nombre: </label><input id="campoTexto" name="nombre" type="text"></input><br>';
echo '<label>Apellidos: </label><input id="campoTexto" name="apellidos" type="text"></input><br>';
echo '<label>Edad: </label><input id="campoTexto" name="edad" type="text"></input><br>';
echo '<label>Equipo: </label>';

echo '<select id="selectEquipo" name="idEquipo">';

foreach($equipos as $equipo)
{
    echo '<option value="'. $equipo->getId() .'">'. $equipo->getNombre() .'</option>';
}

echo '</select>';

echo '<br><br>';
echo '<input id="btnInsertarJugador" type="submit" name="crear" value="crear">';
echo '</form>';

echo '</div>';

echo '</body>';