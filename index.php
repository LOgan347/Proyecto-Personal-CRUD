<?php
//Se llama a la conexion con la base de datos
include __DIR__ . "/configuraciones/config.php";

//se llaman los objetos en la base de datos
$sql = "SELECT id, user, password, registration_date FROM login";

//se guardan los registros en una variable
$result = $conexion->query($sql);

//se verifica que se hallan obtenido los datos
if ($result === false) {
    //muestra el error
    die("Error al obtener datos: " . $conexion->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>
<body>
    <h1>Lista de usuarios</h1>
    <table border="1">
        <!--Encabezados de la tabla-->
        <tr> 
            <th>#</th>
            <th>ID</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Fecha de registro</th>
            <th>Acciones</th>
        </tr>
        <!--Contador para el contador o id visual-->
        <?php $contador = 1; ?>
        <!--Muestra una por una las filas con fetch_assoc-->
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <!-- muestra el contador o id visual -->
            <td><?php echo $contador++; ?></td>
            <!-- muestra la fila del id -->
            <td><?php echo $row['id']; ?></td>
            <!-- muestra el usuario, con caracteres especiales -->
            <td><?php echo htmlspecialchars($row['user']); ?></td>
            <!-- muestra la contraseña -->
            <td><?php echo $row['password'] ?></td> 
            <!-- muestra la fecha de registro -->
            <td><?php echo $row['registration_date']; ?></td>
            <!-- Zona de acciones e interacciones con la base de datos -->
            <td>
                <!-- redirije al archivo para editar y envia con metodo get el Id -->
                <a href="/proyecto-personal/edit-user/edit_user.php?id=<?php echo $row['id']; ?>">
                    <button>Editar</button>
                </a>
                <!-- redirije al archivo para eliminar y envia el id con metodo get
                 tambien muestra un mensaje de confirmacion -->
                <a href="/proyecto-personal/delete-user/delete_user.php?id=<?php echo $row['id']; ?>"
                onclick="return confirm('Estas seguro de eliminar este usuario?')">
                    <button>Eliminar</button>
                </a>
            </td>
        </tr>
        <!-- se cierra el codigo php para el muestreo de datos -->
        <?php } ?>
    </table>
    <br>
    <!-- se redirije al archivo para insertar un usuario -->
    <a href="/proyecto-personal/insert-user/insert_user.php">
        <button>Insertar</button>
    </a>
</body>
</html>
<!-- se cierra la conexion con la base de datos -->
<?php
$conexion->close();
?>