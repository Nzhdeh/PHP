<?php
require_once "../GestionDB/Database.php";
require_once "../Constantes/TablaJugadores.php";
require_once "../GestionDB/GestionJugadores.php";
require_once "../GestionDB/GestionEquipos.php";
require_once "../Entidades/Jugador.php";

//Obtiene la conexion de la base de datos con las funciones definides en Database.php
$bd = Database::getInstance();
$conexion = $bd->getConnection();

//Obtiene el objeto gestor de jugadores a partir de la conexion obtenida anteriormente
$gestionJugadores = new GestionJugadores($conexion);
$gestionEquipos = new GestionEquipos($conexion);

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$edad = $_POST['edad'];
$idEquipo = $_POST['idEquipo'];

$jugador = new Jugador($id, $nombre, $apellidos, $edad, $idEquipo);

$gestionJugadores->actualizarJugador($jugador);
$equipo = $gestionEquipos->obtenerEquipoPorId($idEquipo);

echo 'Jugador actualizado correctamente';

echo '<form action="../Paginas/jugadoresEquipo.php" method="POST">';
echo '<input name="id" type="hidden" value="' . $idEquipo . '"></input>';
echo '<input name="nombre" type="hidden" value="' . $equipo->getNombre() . '"></input>';
echo '<input type="submit" value="Volver"/>';

//header("Location: ../Paginas/Equipos.php");
