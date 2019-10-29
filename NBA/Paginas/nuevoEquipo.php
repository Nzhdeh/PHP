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
echo '<title>Nuevo equipo</title>';
echo '</head>';

echo '<body background="images/backgrounds/'.$background.'">';

echo '<div>';

echo '<p id="tituloPagina">NUEVO EQUIPO</p><br>';

echo '<form action="../Scripts/nuevoEquipo.php" method="POST">';
//echo '<label>ID: </label><input id="campoTexto" name="id" type="text"></input><br>';
echo '<label>Nombre: </label><input id="campoTexto" name="nombre" type="text"></input><br>';
echo '<br><br>';
echo '<input id="btnInsertarJugador" type="submit" name="crear" value="crear">';
echo '</form>';

echo '</div>';

echo '</body>';