<?php
session_start(); // Iniciar la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $pass = $_POST['password'];
    
    // Establecer la conexión a la base de datos (reemplaza con tus propios datos de conexión)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbproyectoumg";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Consulta preparada para evitar la inyección SQL
    $sql = "SELECT rol_usuario, nombre_finca FROM tbl_usuario WHERE correo_usuario = ? AND pass_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $correo, $pass);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($rol, $nombre_finca);
        $stmt->fetch();
        
        // Establecer las variables de sesión
        $_SESSION['correo'] = $correo;
        $_SESSION['rol'] = $rol;
        $_SESSION['nombre_finca'] = $nombre_finca;
        
        if ($rol == '1') {
            header('Location: digitador.php');
        } elseif ($rol == '2') {
            header('Location: planta.php');
        } elseif ($rol == '3') {
            header('Location: proveedor.php');
        } else {
            header('Location: index.html');
        }
    } else {
        header('Location: index.html');
    }
    
    $stmt->close();
    $conn->close();
}
?>
