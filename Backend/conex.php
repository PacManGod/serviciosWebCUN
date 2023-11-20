<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweb";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión Fallida: " . $conn->connect_error);
}

$idPersona = $_GET['idPersona']; // Obtén el ID de persona desde la URL

// Realiza la consulta SQL para obtener los datos del usuario (ajusta esto a tu base de datos)
$sql = "SELECT Nombre FROM usuarios WHERE ID = $idPersona";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $datosUsuario = $resultado->fetch_assoc();
    // Agregar un mensaje de depuración
    echo json_encode($datosUsuario);
} else {
    echo "Usuario no encontrado.";
}
// Cerrar la conexión
$conn->close();
?>