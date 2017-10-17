<?php
require_once 'rb.php';

$id = substr(htmlspecialchars(trim($_GET['fn'])), 0, 1000);


try {
    $path  = getcwd() . '..\db\database.db';

    echo $path;
    if(file_exists($path)) {
        echo "<h1>Exists $path</h1>";
    }

    R::setup("sqlite:$path");

    R::setAutoResolve(TRUE);        //Recommended as of version 4.2

    $pers = R::load('persons', $id);

    R::trash( $pers );
}

catch(Exception $ex) {
    echo $ex->getMessage();
}
