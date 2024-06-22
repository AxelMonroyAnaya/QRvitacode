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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pesos'])) {
        $pesos = $conn->real_escape_string($_POST['pesos']); // Asegurarse de que $mes sea seguro

        // Construir la consulta sin el CALL
        $sql = "SELECT datospersonales.nombre, datospersonales.peso, datospersonales.nacionalidad, 
        datospersonales.tipoSangre, COUNT(antecedentes.numPade)
         AS cantidadPadecimientos, COUNT(familiares.nombre) AS cantidadFamiliares 
         FROM datospersonales INNER JOIN antecedentes ON datospersonales.curp = antecedentes.curp 
         INNER JOIN familiares ON familiares.curp_usuario = datospersonales.curp 
         WHERE datospersonales.curp = 'CQPM900712HMNFRN09' 
         GROUP BY datospersonales.nombre, datospersonales.peso, 
         datospersonales.nacionalidad, datospersonales.tipoSangre;";

        $result = $conn->query($sql);

        if ($result) {
            echo '<div class="container">';
                echo '<table>';
                echo '<tr><th>nombre</th><th>peso</th><th>nacionalidad</th><th>tipo de sangre</th><th>cantidad de padecimientos</th><th>cantidad de familiares</th></tr>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row["nombre"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["peso"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["nacionalidad"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["tipoSangre"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["cantidadPadecimientos"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["cantidadFamiliares"]) . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
            echo '<br><a href="../PQR_HTML/consultas.html">Ir a consultas</a>';
            echo '<br><a href="../PQR_HTML/body.html">salir</a>';
        } else {
            echo "Error en la consulta: " . $conn->error;
        }
    }
 else {
    echo "La conexión no está disponible en la sesión.";
}


?>
