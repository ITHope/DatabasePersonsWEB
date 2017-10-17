<?php
require_once 'rb.php';

$fn = substr(htmlspecialchars(trim($_GET['fn'])), 0, 1000);
$ln = substr(htmlspecialchars(trim($_GET['ln'])), 0, 1000);
$age = substr(htmlspecialchars(trim($_GET['age'])), 0, 1000);


try {
    $path  = getcwd() . '..\db\database.db';

    echo $path;
    if(file_exists($path)) {
        echo "<h1>Exists $path</h1>";
    }

    R::setup("sqlite:$path");

    R::setAutoResolve(TRUE);        //Recommended as of version 4.2

    $rows = R::getAll( 'select * from persons' );

    return $rows;
}

catch(Exception $ex) {
    echo $ex->getMessage();
}
