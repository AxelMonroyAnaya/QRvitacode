<link rel="stylesheet" href="../PQR_CSS/consul.css">

<?php
session_start(); // Inicia la sesión
include('../libs/phpqrcode/qrlib.php');
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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['qr'])) {
        $qr = $conn->real_escape_string($_POST['qr']); // Asegurarse de que $mes sea seguro

        // Construir la consulta sin el CALL
        $sql = "	SELECT 
                    datospersonales.nombre, 
                    datospersonales.NumeroSS, 
                    datospersonales.tipoSangre,
                    antecedentes.alergias, 
                    padecimiento.nombrePadecimiento,
                    padecimiento.observaciones AS estadoCronico, 
                    familiares.nombre AS nombrefamiliar, 
                    familiares.telefono, 
                    familiares.parentesco
                FROM 
                    datospersonales 
                INNER JOIN 
                    antecedentes 
                    ON antecedentes.curp = datospersonales.curp
                INNER JOIN 
                    padecimiento  
                    ON antecedentes.numPade = padecimiento.numPade
                INNER JOIN 
                    familiares 
                    ON familiares.curp_usuario = datospersonales.curp
                WHERE 
                    datospersonales.curp = '$qr'";

        $result = $conn->query($sql);
        $qrData = "";
        if ($result) {
            // Mostrar los resultados de la consulta
            echo '<div class="container">';
            echo '<table>';
            echo '<tr><th>nombre Usurario</th><th>seguro social</th><th>tipo de sangre</th><th>alergias </th><th>padecimiento</th><th>transtornos cronicos</th><th>familiar</th><th>telefono del familiar</th><th>parentesco</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row["nombre"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["NumeroSS"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["tipoSangre"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["alergias"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["nombrePadecimiento"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["estadoCronico"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["nombrefamiliar"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["telefono"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["parentesco"]) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '<br><a href="../PQR_HTML/consultas.html">Ir a consultas</a>';
            echo '<br><a href="../PQR_HTML/body.html">Salir</a>';
            echo '</div>';
        } else {
            echo "Error en la consulta: " . $conn->error;
        }
    }
} else {
    echo "La conexión no está disponible en la sesión.";
}


?>
