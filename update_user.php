<?php
include "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = (int) $_POST['id'];
    $user = $_POST['user'];

    if(!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $conexion->prepare("UPDATE login SET user = ?, password = ? WHERE  id = ?");
        $stmt->bind_param("ssi", $user, $password, $id);
    }else {
        $stmt = $conexion->prepare("UPDATE login SET user = ? WHERE id = ?");
        $stmt->bind_param("si", $user, $id);
    }

    if($stmt->execute()) {
        $stmt->close();
        $conexion->close();
        header("location: index.php");
        exit();
    } else {
        echo "Error al actualizar el usuario". $stmt->error;
    }

    $stmt->close();
}

$conexion->close();
?>