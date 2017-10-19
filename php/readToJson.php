<?php
require_once 'rb.php';

try {
    R::setup('mysql:host=localhost;
        dbname=persons','root','');

    R::setAutoResolve(TRUE);

    $rows = R::getAll( 'select * from persons' );


    foreach($rows as $myObj) {
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

    return $myJSON;
}

catch(Exception $ex) {
    echo $ex->getMessage();
}
