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
$contrasena = $_POST['RPass'];

registrar($nombre, $apellido, $correo, $contrasena, $conn);

function registrar($nombre, $apellido, $correo, $contrasena, $conn)
{
    $fechaRegistro = date('Y-m-d H:i:s');
    $rol = 'Usuario';
    $activo = 1;

    // Hash the password using the default algorithm
    $contrasenaCifrada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Use prepared statements to prevent SQL injection attacks
    $stmt = $conn->prepare("INSERT INTO Usuarios VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssis", $nombre, $apellido, $correo, $contrasenaCifrada, $fechaRegistro, $rol, $activo, $fechaRegistro);
    //$stmt->bind_param("ssssssi", $nombre, $apellido, $correo, $contrasenaCifrada, $fechaRegistro, $rol, $activo, $fechaRegistro);

    if ($stmt->execute()) {
        $idUsuario = ConsultarIdUsuario($correo, $conn);

        session_start();
        $_SESSION['usuario_id'] = $idUsuario;

        header("Location: /ServiciosWebCUN/pages/hud.html?idPersona=" . urlencode($_SESSION['usuario_id']));
        exit();
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $stmt->close();
}

function ConsultarIdUsuario($correo, $conn)
{
    $selectQuery = "SELECT ID FROM Usuarios WHERE CorreoElectronico = ?";
    $selectStmt = $conn->prepare($selectQuery);
    $selectStmt->bind_param("s", $correo);

    if ($selectStmt->execute()) {
        $selectResult = $selectStmt->get_result();
        $usuario = $selectResult->fetch_assoc();
        $usuario_id = $usuario['ID'];
    }

    $selectStmt->close();

    return $usuario_id;
}

$conn->close();
?>