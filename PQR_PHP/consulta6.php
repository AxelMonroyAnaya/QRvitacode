<link rel="stylesheet" href="../PQR_CSS/consul.css">

<?php
session_start(); // Inicia la sesión

require_once('conexion.php');

// Verifica si los detalles de la conexión están almacenados en la sesión
if (isset($_SESSION['db_servername'], $_SESSION['db_username'], $_SESSION['db_password'], $_SESSION['db_databaseName'])) {
    $servername = $_SESSION['db_servername'];
    $username = $_SESSION['db_username'];
    $password = $_SESSION['db_password'];
    $databaseName = $_SESSION['db_databaseName'];

    // Crear la conexión usando los detalles almacenados en la sesión
    $database = new Database($servername, $username, $password, $databaseName);
    $conn = $database->getConnection();

        $sql = "SELECT * FROM qrmotors.viewbien;";
        $result = $conn->query($sql);

        if ($result) {
            echo '<div class="container">';
                echo '<table>';
                echo '<tr><th>nombre</th><th>apellido paterno</th><th>padecimiento</th><th>coagulopatia</th><th>estado de salud</th>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';

                    echo '<td>' . htmlspecialchars($row["nombre"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["apellido_p"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["nombrePadecimiento"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["coagulopatia"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["categoriaCondicion"]) . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
            echo '<br><a href="../PQR_HTML/consultas.html">Ir a consultas</a>';
            echo '<br><a href="../PQR_HTML/body.html">salir</a>';
    }
 else {
    echo "La conexión no está disponible en la sesión.";
}


?>
