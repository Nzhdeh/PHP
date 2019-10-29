<?php
require_once "../GestionDB/Database.php";
require_once "../Constantes/TablaJugadores.php";
require_once "../GestionDB/GestionJugadores.php";
require_once "../GestionDB/GestionEquipos.php";
require_once "../Entidades/Jugador.php";

$idEquipo = $_POST["idEquipo"];

//Obtiene la conexion de la base de datos con las funciones definides en Database.php
$bd = Database::getInstance();
$conexion = $bd->getConnection();

//Obtiene el objeto gestor de jugadores a partir de la conexion obtenida anteriormente
$gestionJugadores = new GestionJugadores($conexion);
$gestionEquipos = new GestionEquipos($conexion);

$gestionJugadores->borrarJugador($_POST['id']);

$equipo = $gestionEquipos->obtenerEquipoPorId($idEquipo);

echo '<h2 id="mensajeGrande">Jugador borrado correctamente</h2>';

echo '<form action="../Paginas/jugadoresEquipo.php" method="POST">';
echo '<input name="id" type="hidden" value="' . $idEquipo . '"></input>';
echo '<input name="nombre" type="hidden" value="' . $equipo->getNombre() . '"></input>';
echo '<input type="submit" value="Volver"/>';

