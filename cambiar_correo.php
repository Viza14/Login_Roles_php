<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

$codigo_usuario = $_SESSION['codigo_usuario'];
$nuevo_correo = $_POST['nuevo_correo'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Actualizar el correo en la base de datos
$sql = "UPDATE usuario SET correo = '$nuevo_correo' WHERE codigo_usuario = $codigo_usuario";

if ($conn->query($sql)) {
    echo "<!DOCTYPE html>
          <html lang='es'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <title>Redirección</title>
              <!-- SweetAlert2 CSS -->
              <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
              <!-- SweetAlert2 JS -->
              <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          </head>
          <body>
              <script>
                  Swal.fire({
                      icon: 'success',
                      title: 'Éxito',
                      text: 'Correo electrónico actualizado correctamente.'
                  }).then(() => {
                      window.location.href = 'perfil.php';
                  });
              </script>
          </body>
          </html>";
} else {
    echo "<!DOCTYPE html>
          <html lang='es'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <title>Redirección</title>
              <!-- SweetAlert2 CSS -->
              <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
              <!-- SweetAlert2 JS -->
              <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          </head>
          <body>
              <script>
                  Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: 'Error al actualizar el correo electrónico.'
                  }).then(() => {
                      window.location.href = 'perfil.php';
                  });
              </script>
          </body>
          </html>";
}

$conn->close();
?>