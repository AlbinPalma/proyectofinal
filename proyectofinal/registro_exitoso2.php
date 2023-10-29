<?php
// Recupera el mensaje de éxito de la URL
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : "Registro exitoso";

// Asegúrate de que la variable de sesión se inicie en cada página
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Registro Exitoso</title>
</head>
<body>
    <div class="modal-body modal-dialog">
        <div class="container col-lg-11">
            <div class="modal-content col-lg-9">
                <div class="alert alert-success">
                    <?php echo $mensaje; ?>
                </div>
                <?php
               
                header('refresh:2; url=planta.php');
                ?>
            </div>
        </div>
    </div>
</body>
</html>