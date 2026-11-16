<?php
include "config.php";

//Verificar que llego el id
if(!isset($_GET['id'])){
    die("ID no valido");
}
$id = (int) $_GET['id'];

//Buscar el usuario con ese id
$stmt = $conexion->prepare("SELECT id, user FROM login WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

//SI no existe avisar
if(!$usuario){
    die("El usuario no existe");
}

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
    <form action="update_user.php" method="post">
        <input type="hidden" name="id" value="<?php echo ($usuario['id']); ?>">

        <label for="user">Usuario</label>
        <input type="text" name="user" id="user" required value="<?php echo htmlspecialchars($usuario['user']); ?>"><br>

        <label for="password">Nueva Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Dejar vacio para no cambiarla"><br>

        <button type="submit">Guardar Cambios</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>