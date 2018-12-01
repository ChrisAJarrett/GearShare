<?php

/* LOCAL VERSION */
$dsn = 'mysql:host=localhost;dbname=gearshare;charset=utf8';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error = $e->getMessage();
    include('error.php');
    exit();
}

/* This is the live ps11 version */

//$host = 'localhost';
//$dbase = 'c2375a08test';
//$username = 'c2375a08'
//$pw = 'c2375aU!'

//$dsn = 'mysql:host=localhost;dbname=c2375a08test';
//
//$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
//
//try {
//   $db = new PDO($dsn, 'c2375a08', 'c2375aU!', $options);
//
//} catch (PDOException $e) {
//
//
//  $error = $e->getMessage();
//  include('error.php');
//  exit();
//}

?>