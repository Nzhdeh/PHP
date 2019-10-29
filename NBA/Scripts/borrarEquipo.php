<?php
require_once "../GestionDB/Database.php";
require_once "../Constantes/TablaJugadores.php";
require_once "../GestionDB/GestionEquipos.php";
require_once "../Entidades/Jugador.php";

//Obtiene la conexion de la base de datos con las funciones definides en Database.php
$bd = Database::getInstance();
$conexion = $bd->getConnection();

//Obtiene el objeto gestor de equipos a partir de la conexion obtenida anteriormente
$gestionEquipos = new GestionEquipos($conexion);

$gestionEquipos->borrarEquipo($_POST['id']);

echo '<h2 id="mensajeGrande">Equipo borrado correctamente</h2>';

echo '<form action="../Paginas/Equipos.php" method="POST">';
echo '<input type="submit" value="Volver"/>';

