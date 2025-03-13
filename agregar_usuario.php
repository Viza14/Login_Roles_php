<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: index.html");
    exit();
}

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$rol = $_POST['rol'];

$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "proyecto";

// Crear conexión
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertar el nuevo usuario en la base de datos
$sql = "INSERT INTO usuario (nombre, apellido, correo, password, rol) VALUES ('$nombre', '$apellido', '$correo', '$password', $rol)";

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
                      text: 'Usuario agregado correctamente.'
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
                      text: 'Error al agregar el usuario.'
                  }).then(() => {
                      window.location.href = 'perfil.php';
                  });
              </script>
          </body>
          </html>";
}

$conn->close();
?>