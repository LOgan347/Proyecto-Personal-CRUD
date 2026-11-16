<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo usuario</title>
</head>
<body>
    <form action="save_new_user.php" method="Post">
        <label for="user">Usuario</label>
        <input type="text" name="user" required><br>

        <label for="password">Contraseña</label>
        <input type="text" name="password" required><br>

        <button type="submit">Guardar Usuario</button>
    </form>
</body>
</html>