<?php
// se llama a la conexion
include __DIR__ . "/../configuraciones/config.php";

// se verifica el metodo post
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // guardamos el id en una variable de tipo entero
    $id = (int) $_POST['id'];
    // guardamos el user
    $user = $_POST['user'];
    // verificamos si la contraseña llego vacia
    if(!empty($_POST['password'])) {
        // si llego una nueva, la encriptamos con metodo hash
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // insertamos los datos con una consulta preparada
        $stmt = $conexion->prepare("UPDATE login SET user = ?, password = ? WHERE  id = ?");
        $stmt->bind_param("ssi", $user, $password, $id);
    }else {
        // si la contraseña llego vacia actualizamos los demas datos con una consulta preparada
        $stmt = $conexion->prepare("UPDATE login SET user = ? WHERE id = ?");
        $stmt->bind_param("si", $user, $id);
    }
    // verficamos su ejecucion
    if($stmt->execute()) {
        // cerramos las conexiones
        $stmt->close();
        $conexion->close();
        // redirijimos a la pagina de inicio
        header("location: ../index.php");
        exit();
    } else {
        // si no se ejecuto mostramos el error
        echo "Error al actualizar el usuario". $stmt->error;
    }
    // cerramos las conexiones
    $stmt->close();
}

$conexion->close();
?>