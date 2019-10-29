<?php

require_once "../GestionDB/Database.php";
require_once "../Constantes/TablaEquipos.php";
require_once "../GestionDB/GestionEquipos.php";
require_once "../Utils/Utils.php";

//Obtiene la conexion de la base de datos con las funciones definides en Database.php
$bd = Database::getInstance();
$conexion = $bd->getConnection();

//Obtiene el objeto gestor de equipos a partir de la conexion obtenida anteriormente
$gestionEquipos = new GestionEquipos($conexion);

//Obtiene todos los equipos de la base de datos.
$resultado = $gestionEquipos->obtenerTodosLosEquipos(); 

echo '<head>';
echo '<link rel="stylesheet" type="text/css" href="CSS/estilo.css">';
echo '<link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">';
echo '<title>Equipos</title>';
echo '</head>';

echo '<body background="images/backgrounds/background1.jpg">';

echo '<div>';

//Mete a los equipos en una tabla.
if(sizeof($resultado) > 0)
{
    echo '<table>';
    echo '<tr>';
    echo '<th>' . \Constantes_DB\TablaEquipos::ID . '</th>';
    echo '<th>' . \Constantes_DB\TablaEquipos::NOMBRE . '</th>';
    echo '<th><img id="imgPlayers" src="images/user.png"></td>';
    echo '<th></th>';
    echo '<th></th>';
    echo '</tr>';

    for($x = 0 ; $x < sizeof($resultado) ; $x++)
    {
        echo '<tr>';
        echo '<form method="POST">';
        echo '<td><input name="id" type="hidden" value="'. $resultado[$x]->getId() .'">'. $resultado[$x]->getId() .'</input></td>';
        echo '<td><input name="nombre" type="hidden" value="'. $resultado[$x]->getNombre() .'">'. $resultado[$x]->getNombre()  .'</input></td>';
        echo '<td>' . $resultado[$x]->numeroJugadores() . '</td>';
        echo '<td id="tdBtnTable"><input type="submit" id="btnTable" name="editar" formaction="../Paginas/jugadoresEquipo.php" value="Editar"></td>';
        echo '<td id="tdBtnTable"><input type="submit" id="btnTable" name="borrar" formaction="../Scripts/borrarEquipo.php" value="Borrar"></td>';
        echo '</form>';
        echo '</tr>';
    }
    echo '</table>';
} 

echo '<br>';

echo '<form action="../Paginas/nuevoEquipo.php" method="POST">';
echo '<input id="btnInsertarJugador" type="submit" value="Crear nuevo equipo"/>';

echo '</div>';

echo '</body>';