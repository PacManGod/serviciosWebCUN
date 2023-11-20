<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweb";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Realizar la consulta para obtener los datos de la tabla
$sql = "SELECT Nombre, Apellido, CorreoElectronico, Rol FROM usuarios;";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    $data = array();

    // Guardar los resultados en un array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Devolver los datos en formato JSON
    echo json_encode($data);

} else {
    echo "0 results";
}
$conn->close();
?>