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

// Función para registrar un usuario
function registrar($nombre, $apellido, $correo, $contraseña)
{
    global $conn;
    $fechaRegistro = date('Y-m-d H:i:s'); // Obtén la fecha y hora actual
    $rol = 'Usuario'; // Asigna un rol por defecto
    $activo = 1; // Indica que el usuario está activo
    $ultimoInicioSesion = $fechaRegistro; // Establece el último inicio de sesión como la fecha de registro

    // Hasheo de la contraseña
    $contraseñaCifrada = password_hash($contraseña, PASSWORD_BCRYPT);

    $sql = "INSERT INTO Usuarios (Nombre, Apellido, CorreoElectronico, Contrasena, FechaRegistro, Rol, Activo, UltimoInicioSesion)
            VALUES ('$nombre', '$apellido', '$correo', '$contraseñaCifrada', '$fechaRegistro', '$rol', $activo, '$ultimoInicioSesion')";

    if ($conn->query($sql) === TRUE) {
        // Si la inserción fue exitosa, redirigir al usuario a la página deseada
        session_start();
        $_SESSION['usuario_id'] = $row['ID'];
        //$_SESSION['nombre'] = $row['Nombre'];
        //$_SESSION['apellido'] = $row['Apellido'];

        // Redirige al usuario a la página deseada después del inicio de sesión
        header("Location: /ServiciosWebCUN/pages/hud.html?idPersona=" . urlencode($_SESSION['usuario_id']));
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }

    $conn->close();
}

?>