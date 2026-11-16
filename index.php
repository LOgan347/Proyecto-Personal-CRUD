<?php
//Se llama a la conexion con la base de datos
include 'config.php';

//se llaman los registros en la base de datos
$sql = "SELECT id, user, password, registration_date FROM login";

//se guardan los registros en una variable
$result = $conexion->query($sql);

//se verifica que se hallan obtenido los datos
if ($result === false) {
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
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Fecha de registro</th>
            <th>Acciones</th>
        </tr>
        <?php $contador = 1; ?>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $contador++; ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['user']); ?></td>
            <td><?php echo $row['password'] ?></td>
            <td><?php echo $row['registration_date']; ?></td>
            <td>
                <a href="edit_user.php?id=<?php echo $row['id']; ?>">
                    <button>Editar</button>
                </a>
                <a href="delete_user.php?id=<?php echo $row['id']; ?>"
                onclick="return confirm('Estas seguro de eliminar este usuario?')">
                    <button>Eliminar</button>
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="insert_user.php">
        <button>Insertar</button>
    </a>
</body>
</html>
<?php
$conexion->close();
?>