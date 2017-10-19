<?php
require_once 'rb.php';
echo "Table Persons: ";
try {
    R::setup('mysql:host=localhost;
        dbname=persons','root','');

    R::setAutoResolve(TRUE);

    $rows = R::getAll( 'select * from persons' );

    //print_r($rows);


    $html = '<table id="persons" border="1">';
    // header row
    $html .= '<tr>';
    foreach($rows[0] as $key=>$value){
        $html .= '<th>' . htmlspecialchars($key) . '</th>';
    }
    $html .= '</tr>';

    // data rows
    foreach( $rows as $key=>$value) {
        $html .= '<tr>';
        foreach ($value as $key2 => $value2) {
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
        }
        $html .= '</tr>';
    }

    echo $html;

    return $rows;
}

catch(Exception $ex) {
    echo $ex->getMessage();
}
