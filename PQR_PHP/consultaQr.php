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
        $sql = "SELECT 
                dp.nombre,
                dp.NumeroSS,
                dp.tipoSangre,
                GROUP_CONCAT(DISTINCT a.alergias SEPARATOR ', ') AS alergias,
                GROUP_CONCAT(DISTINCT p.nombrePadecimiento SEPARATOR ', ') AS nombrePadecimiento,
                GROUP_CONCAT(DISTINCT p.observaciones SEPARATOR ', ') AS estadoCronico,
                GROUP_CONCAT(DISTINCT f.nombre SEPARATOR ', ') AS nombrefamiliar,
                GROUP_CONCAT(DISTINCT f.telefono SEPARATOR ', ') AS telefono,
                GROUP_CONCAT(DISTINCT f.parentesco SEPARATOR ', ') AS parentesco
            FROM
                datospersonales dp
            INNER JOIN
                antecedentes a ON a.curp = dp.curp
            INNER JOIN
                padecimiento p ON a.numPade = p.numPade
            INNER JOIN
                familiares f ON f.curp_usuario = dp.curp
            WHERE 
                dp.curp = '$qr'
            GROUP BY
                dp.nombre, dp.NumeroSS, dp.tipoSangre;
            ";

        $result = $conn->query($sql);
        $qrData = "";
        if ($result) {
            // Mostrar los resultados de la consulta
            echo '<div class="container">';
            echo '<table>';
            echo '<tr><th>nombre Usurario</th><th>seguro social</th><th>tipo de sangre</th><th>alergias </th><th>padecimiento</th><th>observaciones</th><th>familiar</th><th>telefono del familiar</th><th>parentesco</th></tr>';
            while ($row = $result->fetch_assoc()) {

                        // Concatenar la información a qrData
                $qrData .= "Nombre: " . $row["nombre"] . "\n";
                $qrData .= "Seguro Social: " . $row["NumeroSS"] . "\n";
                $qrData .= "Tipo de Sangre: " . $row["tipoSangre"] . "\n";
                $qrData .= "Alergias: " . $row["alergias"] . "\n";
                $qrData .= "Padecimiento: " . $row["nombrePadecimiento"] . "\n";
                $qrData .= "observaciones: " . $row["estadoCronico"] . "\n";
                $qrData .= "Familiar: " . $row["nombrefamiliar"] . "\n";
                $qrData .= "Telefono del Familiar: " . $row["telefono"] . "\n";
                $qrData .= "Parentesco: " . $row["parentesco"] . "\n";
                $qrData .= "------------------------\n"; 

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
            $filename = 'qr_code.png';
            QRcode::png($qrData, $filename);
        
            // Mostrar el código QR
            echo '<br><img class="image-container" src="' . $filename . '" alt="QR Code">';

            echo '<br><a href="../PQR_HTML/consultaQr.html">Ir a consultas</a>';
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
