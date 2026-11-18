<?php
//se llama a la conexion 
include 'config.php';

// se verifica el metodo POST
if($_SERVER["REQUEST_METHOD"]=="POST"){
    // se guarda el usuario obtenido en una variable
    $user = $_POST['user'];
    // se guarda la contraseña con una encriptacion HASH
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //contraseña encriptada

    //Consulta preparada anti SQL INYECTION
    $stmt = $conexion->prepare("INSERT INTO login (user, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $password); // ss dos strings
    
    //se verifica que la insercion halla sido exitosa
    if($stmt->execute()){
        //se cierran las conexiones
        $stmt->close();
        $conexion->close();
        //se redirije a la pagina principal
        header("Location: index.php");
        exit();
    } else {
        //en caso de error se muestra
        echo "Error al insertar el usuario: ". $stmt->error;
    }
    $stmt->close();
}
$conexion->close();
?>