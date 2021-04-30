<?php

//define some constant
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'movieproject');


$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

function varDump($dump)
{
    echo "<pre>";
    var_dump($dump);
    echo "</pre>";
}

function getBeforeChar($string, $char)
{
    $newString = "";
    for ($i = 0; $i < strlen($string); $i++) {
        if ($string[$i] == $char) {
            for ($j = 0; $j < $i; $j++) {
                $newString = $newString . $string[$j];
            }
        }
    }
    return $newString;
}

function getAfterChar($string, $char)
{
    $newString = "";
    for ($i = 0; $i < strlen($string); $i++) {
        if ($string[$i] == $char) {
            for ($j = $i + 1; $j < strlen($string); $j++) {
                $newString = $newString . $string[$j];
            }
        }
    }
    return $newString;
}
