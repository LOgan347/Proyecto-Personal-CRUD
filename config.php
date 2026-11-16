<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto_personal";

$conexion = new mysqli($servername, $username, $password, $dbname);

if($conexion->connect_error){
    die("La conexion ha fallado".$conexion->connect_error);
}

$conexion->set_charset("utf8");
?>