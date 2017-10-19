<?php
require_once 'rb.php';

$id = $_GET['id'] + 0;
$fn = $_GET['fn'];
$ln = $_GET['ln'];
$age = $_GET['age'] + 0;

try {
    R::setup('mysql:host=localhost;
        dbname=persons','root','');

    R::setAutoResolve(TRUE);

    $post = R::dispense('persons');
    $post->Id = $id;
    $post->Fn = $fn;
    $post->Ln = $ln;
    $post->Age = $age;

    R::store($post);

    return $post;
}

catch(Exception $ex) {
    echo $ex->getMessage();
}