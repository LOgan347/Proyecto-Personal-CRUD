<?php
//se llama a la conexion
include "config.php";

//Verificar que llego el id
if(!isset($_GET['id'])){
    die("ID no valido");
}
// se guarda el id en una variable de tipo int
$id = (int) $_GET['id'];

//se hace una consulta preparada con el id
$stmt = $conexion->prepare("SELECT id, user FROM login WHERE id = ?");
$stmt->bind_param("i", $id);//i de int
$stmt->execute();
$result = $stmt->get_result();//se obtiene y se guarda el resultado
$usuario = $result->fetch_assoc();//guardamos el usuario

//SI no existe avisar
if(!$usuario){
    die("El usuario no existe");
}
//cerramos las conexiones
$stmt->close();
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario</title>
</head>
<body>
    <h1>Editar usuario</h1>
    <!-- formulario para enviar los datos al archivo con metodo post -->
    <form action="update_user.php" method="post">
        <!-- se envia el id con un input oculto -->
        <input type="hidden" name="id" value="<?php echo ($usuario['id']); ?>">

        <label for="user">Usuario</label>
        <!-- se envia el usuario -->
        <input type="text" name="user" id="user" required value="<?php echo htmlspecialchars($usuario['user']); ?>"><br>

        <label for="password">Nueva Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Dejar vacio para no cambiarla"><br>
        <!-- boton para enviar -->
        <button type="submit">Guardar Cambios</button>
        <!-- boton para cancelar y volver a la pagina principal -->
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>