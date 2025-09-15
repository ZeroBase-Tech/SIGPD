<?php
session_start();
require_once __DIR__ . '/../model/Database.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $pdo = Database::getInstancia()->getConexion();
    $stmt = $pdo->prepare("SELECT * FROM Jugador WHERE usuario = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado && $password === $resultado['contraseña']) {
    //if ($resultado && password_verify($password, $resultado['contraseña'])) {
        $_SESSION['ultimo_jugador'] = $resultado['usuario'];
        header("Location: Cantidad.php"); 
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Draftotux</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="../../public/css/estilos.css">
</head>

<body class="bg-dark">

  <div id="background-blur" style="background-image: url('../../public/assets/img/Fondo.png');"></div>

  <div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center ">
    <a href="../../public/index.php" class="text-decoration-none">
      <h1 class="blinker-semibold">DraftoTux</h1>
    </a>

    <div class="card p-4 rounded-5 w-100 " style="max-width: 28rem;">
      <div class="card-header">
        <p class="fs-3 mb-0">Iniciar Sesión</p>
      </div>

      <form method="POST" action="inicio_sesion.php">

        <?php if (!empty($error)) : ?>
          <div class="alert alert-danger mt-3"><?= $error ?></div>
        <?php endif; ?>
        <div class="mb-3 mt-3 text-start">
          <label>Usuario</label>
          <input type="text" class="form-control" name="usuario" required>
        </div>

        <div class="mb-4 text-start">
          <label>Contraseña</label>
          <input type="password" class="form-control" name="password" required>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-success fs-5">Iniciar Sesión</button>
        </div>
      </form>

      <div class="row mt-4">
        <a href="Cantidad.php" class="col-6 text-start text-decoration-none">Atras</a>

        <a href="registro.php" class=" col-6 text-end text-decoration-none">Registrar</a>
      </div>
    </div>

  </div>

</body>

</html>