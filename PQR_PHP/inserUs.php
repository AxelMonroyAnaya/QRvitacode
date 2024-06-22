<?php
session_start();
if (isset($_SESSION['db_servername'], $_SESSION['db_username'], $_SESSION['db_password'], $_SESSION['db_databaseName'])) {
    $servername = $_SESSION['db_servername'];
    $username = $_SESSION['db_username'];
    $password = $_SESSION['db_password'];
    $databaseName = $_SESSION['db_databaseName'];

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $databaseName);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener datos del formulario
    $curp = $_POST['curp'];
    $nombre = $_POST['nombre'];
    $apellido_p = $_POST['apellido_p'];
    $apellido_m = $_POST['apellido_m'];
    $NumeroSS = $_POST['NumeroSS'];
    $nacionalidad = $_POST['nacionalidad'];
    $peso = $_POST['peso'];
    $tipoSangre = $_POST['tipoSangre'];
    $sexo = $_POST['sexo'];
    $numero = $_POST['numero'];

    $nombrePadecimiento = $_POST['nombrePadecimiento'];
    $cuagulopatia = $_POST['cuagulopatia'];
    $alergiasGenerales = $_POST['alergiasGenerales'];
    $anafilaxia = $_POST['anafilaxia'];
    $estadoCronico = $_POST['estadoCronico'];

    $curp_familiar = $_POST['curp_familiar'];
    $nombre_familiar = $_POST['nombre_familiar'];
    $apellido_p_familiar = $_POST['apellido_p_familiar'];
    $apellido_m_familiar = $_POST['apellido_m_familiar'];
    $telefono = $_POST['telefono'];
    $parentesco = $_POST['parentesco'];

    // Insertar en antecedentes
    $sql_antecedentes = "INSERT INTO antecedentes (nombrePadecimiento, cuagolupatia, alergiasGenerales, anafilaxia, estadoCronico) VALUES (?, ?, ?, ?, ?)";
    $stmt_antecedentes = $conn->prepare($sql_antecedentes);
    if ($stmt_antecedentes) {
        $stmt_antecedentes->bind_param("sssss", $nombrePadecimiento, $cuagulopatia, $alergiasGenerales, $anafilaxia, $estadoCronico);

        if ($stmt_antecedentes->execute()) {
            $numeroAntecedente = $stmt_antecedentes->insert_id;

            // Insertar en datospersonales
            $sql_datospersonales = "INSERT INTO datospersonales (curp, nombre, apellido_p, apellido_m, NumeroSS, nacionalidad, peso, tipoSangre, sexo, numero, numeroAntecedente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_datospersonales = $conn->prepare($sql_datospersonales);
            if ($stmt_datospersonales) {
                $stmt_datospersonales->bind_param("ssssisdssss", $curp, $nombre, $apellido_p, $apellido_m, $NumeroSS, $nacionalidad, $peso, $tipoSangre, $sexo, $numero, $numeroAntecedente);

                if ($stmt_datospersonales->execute()) {
                    // Insertar en familiares
                    $sql_familiares = "INSERT INTO familiares (curp, nombre, apellido_p, apellido_m, telefono, parentesco, curp_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt_familiares = $conn->prepare($sql_familiares);
                    if ($stmt_familiares) {
                        $stmt_familiares->bind_param("sssssss", $curp_familiar, $nombre_familiar, $apellido_p_familiar, $apellido_m_familiar, $telefono, $parentesco, $curp);

                        if ($stmt_familiares->execute()) {
                            echo "Datos insertados correctamente.";
                        } else {
                            echo "Error al insertar datos en familiares: " . $stmt_familiares->error;
                        }
                    } else {
                        echo "Error al preparar la consulta de familiares: " . $conn->error;
                    }
                } else {
                    echo "Error al insertar datos en datospersonales: " . $stmt_datospersonales->error;
                }
            } else {
                echo "Error al preparar la consulta de datospersonales: " . $conn->error;
            }
        } else {
            echo "Error al insertar datos en antecedentes: " . $stmt_antecedentes->error;
        }
    } else {
        echo "Error al preparar la consulta de antecedentes: " . $conn->error;
    }

    $conn->close();
} else {
    echo "No se ha establecido la conexión a la base de datos.";
}
?>
