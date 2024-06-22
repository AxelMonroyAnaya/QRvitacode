<?php
class Database {
    private $conn;
    private $databaseName; // Propiedad para almacenar el nombre de la base de datos

    // Constructor para establecer la conexión y el nombre de la base de datos
    public function __construct($servername, $username, $password, $databaseName) {
        $this->conn = new mysqli($servername, $username, $password, $databaseName);
        $this->databaseName = $databaseName; // Almacena el nombre de la base de datos en la propiedad
        if ($this->conn->connect_error) {
            die("Error al conectar: " . $this->conn->connect_error);
        }
    }

    // Método para obtener la conexión
    public function getConnection() {
        return $this->conn;
    }

    // Método para cerrar la conexión
    public function closeConnection() {
        $this->conn->close();
    }
    
    // Método para cambiar a la base de datos especificada
    public function useDatabase() {
        $sql = "USE " . $this->databaseName; // Usa la propiedad $databaseName
        if ($this->conn->query($sql) === TRUE) {
            return  "<p>base de datos seleccionada :</p>". $this->databaseName;
        } else {
            return "<p>Error al ejecutar la sentencia SQL 'USE': </p>" . $this->conn->error;
        }
    }

}
?>
