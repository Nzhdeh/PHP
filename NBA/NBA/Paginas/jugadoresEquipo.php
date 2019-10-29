<?php

require_once "../GestionDB/Database.php";
require_once "../Constantes/TablaJugadores.php";
require_once "../Constantes/TablaEquipos.php";
require_once "../GestionDB/GestionJugadores.php";
require_once "../GestionDB/GestionEquipos.php";
require_once "../Utils/Utils.php";

//Obtiene la conexion de la base de datos con las funciones definides en Database.php
$bd = Database::getInstance();
$conexion = $bd->getConnection();

//Obtiene el objeto gestor de jugadores a partir de la conexion obtenida anteriormente
$gestionJugadores = new GestionJugadores($conexion);
$gestionEquipos = new GestionEquipos($conexion);

//Obtiene todos los jugadores de la base de datos.
$resultado = $gestionJugadores->obtenerJugadoresPorEquipo($_POST["id"]); 

$background = Utils::randomBackground();

/*
//Recorre cada jugador y lo imprime en pantalla (este código no funcionaría si la clase Jugador no tuviera implementado __toString() )
for($x = 0 ; $x < sizeof($resultado) ; $x++)
{
    echo (string)$resultado[$x];
    echo "<br>";
}

echo "<br>";
echo "<br>";
echo "<br>";

*/

echo '<head>';
echo '<link rel="stylesheet" type="text/css" href="CSS/estilo.css">';
echo '<link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">';
echo '<title>'.$_POST["nombre"].'</title>';
echo '</head>';

echo '<body background="images/backgrounds/'.$background.'">';

echo '<div>';

echo '<h2 id="nombreEquipoGrande">'.$_POST["nombre"].'</h2>';

//En lugar de imprimirlo usando __toString(), mete a los jugadores en una tabla.
if(sizeof($resultado) > 0)
{
    echo '<table border=\"1\">';
    echo '<tr>';
    echo '<th>' . \Constantes_DB\TablaJugadores::ID . '</th>';
    echo '<th>' . \Constantes_DB\TablaJugadores::NOMBRE . '</th>';
    echo '<th>' . \Constantes_DB\TablaJugadores::APELLIDOS . '</th>';
    echo '<th>' . \Constantes_DB\TablaJugadores::EDAD . '</th>';
    //echo '<th>Equipo</th>';
    echo '<th></td>';
    echo '<th></td>';
    echo '</tr>';

    for($x = 0 ; $x < sizeof($resultado) ; $x++)
    {
        $equipo = $gestionJugadores->obtenerEquipoDeJugador($resultado[$x]);

        echo '<tr>';
        echo '<form method="POST">';
        echo '<td><input name="id" type="hidden" value="'. $resultado[$x]->getId() .'">'. $resultado[$x]->getId() .'</input></td>';
        echo '<td><input name="nombre" type="hidden" value="'. $resultado[$x]->getNombre() .'">'. $resultado[$x]->getNombre()  .'</input></td>';
        echo '<td><input name="apellidos" type="hidden" value="'. $resultado[$x]->getApellidos() .'">'. $resultado[$x]->getApellidos() .'</input></td>';
        echo '<td><input name="edad" type="hidden" value="'. $resultado[$x]->getEdad() .'">'. $resultado[$x]->getEdad() .'</input></td>';
        echo '<input name="idEquipo" type="hidden" value="'. $resultado[$x]->getIdEquipo() .'"></input>';
        echo '<td id="tdBtnTable"><input type="submit" id="btnTable" name="editar" formaction="../Paginas/editarJugador.php" value="Editar"></td>';
        echo '<td id="tdBtnTable"><input type="submit" id="btnTable" name="borrar" formaction="../Scripts/borrarJugador.php" value="Borrar"></td>';
        echo '</form>';
        echo '</tr>';
    }
    echo '</table>';
} 

echo '<br>';

echo '<form action="../Paginas/nuevoJugador.php" method="POST">';
echo '<input id="btnInsertarJugador" type="submit" value="Insertar jugador"/>';

echo '<br>';
echo '<br>';

echo '<a id="btnVolverAListaEquipos" href="Equipos.php">Volver a la lista de equipos</a>';

echo '</div>';

echo '</body>';
