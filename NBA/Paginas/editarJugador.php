<?php
require_once "../GestionDB/Database.php";
require_once "../Constantes/TablaJugadores.php";
require_once "../GestionDB/GestionJugadores.php";
require_once "../GestionDB/GestionEquipos.php";
require_once "../Entidades/Jugador.php";
require_once "../Utils/Utils.php";

//Obtiene la conexion de la base de datos con las funciones definides en Database.php
$bd = Database::getInstance();
$conexion = $bd->getConnection();

//Obtiene el objeto gestor de jugadores a partir de la conexion obtenida anteriormente
$gestionJugadores = new GestionJugadores($conexion);

$gestionEquipos = new GestionEquipos($conexion);

$equipos = $gestionEquipos->obtenerTodosLosEquipos();

$background = Utils::randomBackground();

echo '<head>';
echo '<link rel="stylesheet" type="text/css" href="CSS/estilo.css">';
echo '<link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">';
echo '<title>Editar jugador</title>';
echo '</head>';

echo '<body background="images/backgrounds/'.$background.'">';

echo '<div>';

echo '<p id="tituloPagina">EDITAR JUGADOR</p>';

echo '<form action="../Scripts/editarJugador.php" method="POST">';
echo '<input id="campoTexto" name="id" type="hidden" value="'. $_POST["id"] .'"></input><br>';
echo '<label>Nombre: </label><input id="campoTexto" name="nombre" type="text" value="'. $_POST["nombre"] .'"></input><br>';
echo '<label>Apellidos: </label><input id="campoTexto" name="apellidos" type="text" value="'. $_POST["apellidos"]  .'"></input><br>';
echo '<label>Edad: </label><input id="campoTexto" name="edad" type="text" value="'. $_POST["edad"]  .'"></input><br>';
echo '<label>Equipo: </label>';

echo '<select id="selectEquipo" name="idEquipo">';

foreach($equipos as $equipo)
{
    echo '<option value="'. $equipo->getId() .'">'. $equipo->getNombre() .'</option>';
}

echo '</select>';

echo '<br><br>';
echo '<input id="btnInsertarJugador" type="submit" name="editar" value="Editar">';
echo '</form>';

echo '</div>';

echo '</body>';