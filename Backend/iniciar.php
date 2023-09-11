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
        // El usuario existe, obtener su nombre
        $row = $result->fetch_assoc();
        $nombreUsuario = $row['NOMBRE'];
        // Redirigir al usuario a la página deseada y pasar el nombre como parámetro
        header("Location: /ServiciosWebCUN/pages/hud.html?nombre=$nombreUsuario");
        exit();
    } else {
        echo "Error al iniciar sesión: " . $conn->error;
    }
    
    $conn->close();
}


?>