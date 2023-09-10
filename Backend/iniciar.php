<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Conexion Fallida: " . $conn->connect_error);
}

if (empty($_POST)) {
    die("No se enviaron datos desde el formulario.");
}

// Formulario de registro
$correo = $_POST['IEmail'];
$contraseña = $_POST['IPass'];

inicioSesion($correo, $contraseña);

function inicioSesion($correo, $contraseña){
    global $conn;
    $sql = "SELECT * FROM usuarios WHERE USUARIO = '$correo' AND CONTRASEÑA = '$contraseña'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Si el usuario existe, redirigir al usuario a la página deseada
        header("Location: /ServiciosWebCUN/pages/hud.html");
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        echo "Error al iniciar sesión: " . $conn->error;
    }
    
    $conn->close();
}

?>