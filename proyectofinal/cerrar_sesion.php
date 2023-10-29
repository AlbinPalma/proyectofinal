<?php
// Iniciar la sesión (si no está iniciada)
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión o a la página principal
header('Location: index.html');
exit;
?>
