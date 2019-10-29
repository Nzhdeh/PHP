<?php

Class Utils
{

    static function randomBackground()
    {
        $backgrounds = scandir("../Paginas/images/backgrounds");

        $backgrounds = array_slice($backgrounds, 3);

        $background = $backgrounds[array_rand($backgrounds)];

        return $background;
    }

}