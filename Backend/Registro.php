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
$nombre = $_POST['RNombre'];
$apellido = $_POST['RApellido'];
$correo = $_POST['RCorreo'];
$contraseña = $_POST['RPass'];

registrar($nombre, $apellido, $correo, $contraseña);

//funcion registrar usuario
function registrar($nombre, $apellido, $correo, $contraseña){
    global $conn;
    $sql = "INSERT INTO usuarios (NOMBRE, APELLIDO, USUARIO, CONTRASEÑA) VALUES ('$nombre', '$apellido', '$correo', '$contraseña')";
    
    if ($conn->query($sql) === TRUE) {
        // Si la inserción fue exitosa, redirigir al usuario a la página deseada
        header("Location: /ServiciosWebCUN/index.html");
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }
    
    $conn->close();
}

?>