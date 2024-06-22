<?php
session_start(); // Inicia la sesión

require_once('conexion.php');

$servername = "localhost:3308"; // Cambia el puerto si es necesario
$username = $_POST['username'];
$password = $_POST['password'];
$databaseName = "qrmotors";

// Guardar los detalles de la conexión en la sesión
$_SESSION['db_servername'] = $servername;
$_SESSION['db_username'] = $username;
$_SESSION['db_password'] = $password;
$_SESSION['db_databaseName'] = $databaseName;

// Crear la conexión
$database = new Database($servername, $username, $password, $databaseName);
$conn = $database->getConnection();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de Conexión</title>
    <link rel="stylesheet" href="../PQR_CSS/conexionRES.css">
</head>
<body>
    <div class="container">
        <h2>Detalles de la Conexión</h2>
        <p><strong>Usuario:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p><strong>Contraseña:</strong> <?php echo htmlspecialchars($password); ?></p>
        <p><strong>Base de datos:</strong> <?php echo htmlspecialchars($databaseName); ?></p>

        <?php if ($conn): ?>
            <p style="color: green;">Conexión exitosa a la base de datos <?php echo htmlspecialchars($databaseName); ?></p>
        <?php else: ?>
            <p style="color: red;">Error al conectar a la base de datos</p>
        <?php endif; ?>

        <a href="../PQR_HTML/insertarUs.html" target="contenido">Ir a Consultas</a>
        <a href="../PQR_HTML/body.html" target="contenido">Regresar</a>
    </div>
</body>
</html>
