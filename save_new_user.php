<?php
include 'config.php';

//metodo GET
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $user = $_POST['user'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //contraseña encriptada

    //Consulta preparada anti SQL INYECTION
    $stmt = $conexion->prepare("INSERT INTO login (user, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $password); // ss dos strings

    if($stmt->execute()){
        $stmt->close();
        $conexion->close();
        header("Location: index.php");
        exit();
    } else {
        echo "Error al insertar el usuario: ". $stmt->error;
    }
    $stmt->close();
}
$conexion->close();
?>