<?php
require_once 'rb.php';

$id = $_GET['id']+0;

try {
    R::setup('mysql:host=localhost;
        dbname=persons','root','');

    R::setAutoResolve(TRUE);

    $post = R::load('persons', $id);
    echo $post;

    R::trash($post);

    return $post;
}

catch(Exception $ex) {
    echo $ex->getMessage();
}