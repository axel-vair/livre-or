<?php
$DB_DSN = 'mysql:host=localhost; dbname=livreor';
$username = 'root';
$password_db = 'root';

try {
    $options =
    [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // BE SURE TO WORK IN UTF8
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//ERROR TYPE
        PDO::ATTR_EMULATE_PREPARES => false // FOR NO EMULATE PREPARE (SQL INJECTION)
    ];
    $conn = new PDO($DB_DSN, $username, $password_db, $options); // PDO CONNECT

}  catch(PDOException $e) { //CATCH ERROR IF NOT CONNECTED
    print "Erreur !: " . $e->getMessage() . "</br>";
    die();
}




