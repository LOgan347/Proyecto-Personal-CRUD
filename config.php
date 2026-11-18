<?php
// se crean las variables para la conexion (opcional)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto_personal";
// se crea la conexion
$conexion = new mysqli($servername, $username, $password, $dbname);
// verificamos la conexion
if($conexion->connect_error){
    die("La conexion ha fallado".$conexion->connect_error);
}
// modificamos los caracteres especiales
$conexion->set_charset("utf8");
?>