<?php
require_once "../GestionDB/Database.php";
require_once "../Constantes/TablaJugadores.php";
require_once "../GestionDB/GestionEquipos.php";
require_once "../Entidades/Jugador.php";

//Obtiene la conexion de la base de datos con las funciones definides en Database.php
$bd = Database::getInstance();
$conexion = $bd->getConnection();

//Obtiene el objeto gestor de jugadores a partir de la conexion obtenida anteriormente
$gestionEquipos = new GestionEquipos($conexion);

//$id = $_POST['id'];
/*$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$edad = $_POST['edad'];
$idEquipo = $_POST['idEquipo'];

$jugador = new Jugador(0, $nombre, $apellidos, $edad, $idEquipo); */

$equipo = new Equipo(0, $_POST["nombre"], null);

$gestionEquipos->insertarEquipo($equipo);

echo 'Equipo insertado correctamente';

echo '<form action="../Paginas/Equipos.php" method="POST">';
echo '<input type="submit" value="Volver"/>';

//header("Location: ../Paginas/Equipos.php");
