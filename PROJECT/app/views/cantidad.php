<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DraftoTux</title>
  <link rel="icon" href="assets/img/tux.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@100;200;300;400;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"crossorigin="anonymous">
  <link rel="stylesheet" href="css/estilos.css">
</head>

<body class="bg-dark">

  <div id="background-blur" style="background-image: url('assets/img/Fondo.png');"></div>
  <div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center px-3">
    <a href="index.php?ruta=Start" class="text-decoration-none">
      <h1 class="blinker-semibold">DraftoTux</h1>
    </a>

    <div class="card text-white rounded-4 shadow w-100 pt-4" style="max-width: 32rem;">
      <div class="row d-flex gap-3 justify-content-center mb-3">
        <?php
        for ($i = 0; $i < 5; $i++) {
          $nombre = $_SESSION['jugadores'][$i] ?? "Usuario " . ($i + 1);
          ?>
          <div class="jugador-card col-12 col-sm-6 position-relative">
            <a href="index.php?ruta=Jugadores&eliminar=<?= $i ?>" class="close-btn">X</a>
            <a href="index.php?ruta=LogIn">
              <div class="jugador-card2">
                <img src="assets/img/tux.png">
                <div class="add-usuario">+</div>
              </div>
            </a>
            <label><?= htmlspecialchars($nombre) ?></label>
          </div>
        <?php } ?>
      </div>

      <div class="row d-flex justify-content-center mb-3">
        <div class="col-5">
          <button class="btn btn-outline-light disabled">Modo Digital</button>
        </div>
        <div class="col-5">
          <a class="btn btn-outline-light" href="index.php?ruta=CrearPartida&modo=seguimiento">Modo Seguimiento</a>
        </div>
      </div>
    </div>
    <div class="py-3">
      <a class="btn btn-success shadow fs-5" href="index.php?ruta=Home">Atrás</a>
    </div>
  </div>
</body>

</html>