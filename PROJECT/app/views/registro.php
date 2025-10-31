<?php
$error = $error ?? '';
$success = $success ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DraftoTux - Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="bg-dark">

<div id="background-blur" style="background-image: url('assets/img/Fondo.png');"></div>

<div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center">

    <a href="index.php?ruta=Start" class="text-decoration-none">
      <h1 class="blinker-semibold">DraftoTux</h1>
    </a>

    <div class="card p-4 rounded-5 w-100" style="max-width: 28rem;">
        <div class="card-header">
            <p class="fs-3 mb-0">Registro</p>
        </div>

        <?php if ($error) : ?>
            <div class="alert alert-danger mt-3"><?= $error ?></div>
        <?php elseif ($success) : ?>
            <div class="alert alert-success mt-3"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?ruta=SignIn">
            <div class="text-start mb-3">
                <label>Usuario</label>
                <input type="text" class="form-control" name="usuario" required>
            </div>

            <div class="text-start mb-3">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>

            <div class="text-start mb-3">
                <label>Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="text-start mb-3">
                <label>Confirmar Contraseña</label>
                <input type="password" class="form-control" name="confirmar_password" required>
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-success fs-4">Registrar</button>
            </div>
        </form>

        <div class="mt-4 text-start">
            <a href="index.php?ruta=LogIn" class="col-6 text-decoration-none">Atras</a>
        </div>
    </div>
</div>

</body>
</html>
