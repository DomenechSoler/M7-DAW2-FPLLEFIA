<?php
$host =  'mysql-p0domenechsoler.alwaysdata.net';
$dbname = 'p0domenechsoler_clubespro';
$username = '394077';
$password = 'Kilizan24';


$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die('Error de Conexión: ' . $mysqli->connect_error);
}


$mysqli->set_charset("utf8");
?>