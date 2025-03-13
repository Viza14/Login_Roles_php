<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$correo = $_POST['correo'];

// Buscar el usuario en la base de datos
$sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar mensaje de éxito y redirigir
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
                      text: 'Correo encontrado. Redirigiendo...'
                  }).then(() => {
                      window.location.href = 'nueva_contrasena.php?correo=" . urlencode($correo) . "';
                  });
              </script>
          </body>
          </html>";
    exit();
} else {
    // Mostrar mensaje de error
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
                      text: 'No se encontró una cuenta con ese correo electrónico.'
                  }).then(() => {
                      window.location.href = 'recuperar_clave.html';
                  });
              </script>
          </body>
          </html>";
}

$conn->close();
?>