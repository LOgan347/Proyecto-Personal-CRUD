<?php 
include "config.php";

//obtener todos los id
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM login WHERE id = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        header("location: index.php");
        exit();
    } else {
        echo "Error al borrar el usuario:" . $conexion->error;
    }

    $stmt->close();
} else {
    echo "ID no valido";
}

$conexion->close();
?>