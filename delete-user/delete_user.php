<?php 
// llamamos a la conexion
include __DIR__ . "/../configuraciones/config.php";

// verificamos la obtencion de un id
if(isset($_GET['id'])){
    // guardamos el id en una variable
    $id = $_GET['id'];
    // eliminamos el id con una consulta preparada
    $stmt = $conexion->prepare("DELETE FROM login WHERE id = ?");
    $stmt->bind_param("i", $id); // i de int
    // se verifica su ejecucion 
    if($stmt->execute()){
        // redirijimos a la pagina de inicio
        header("location: ../index.php");
        exit();
    } else {
        // si hubo errores
        echo "Error al borrar el usuario:" . $conexion->error;
    }
    // cerramos la conexion
    $stmt->close();
} else {
    // si el id no llego
    echo "ID no valido";
}
// cerramos la conexion
$conexion->close();
?>