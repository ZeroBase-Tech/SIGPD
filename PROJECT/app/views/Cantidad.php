<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Draftotux</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/Style.css">
</head>
<body class="bg-dark">
  <div id="background-blur" style="background-image: url('assets/img/Fondo.png');"></div>
  <div class="container d-flex flex-column justify-content-center align-items-center text-center py-3">
    <a href="index.php?ruta=Start" class="text-decoration-none">
      <h1 class="blinker-semibold">DraftoTux</h1>
    </a>
    <div class="card text-white rounded-4 shadow w-100 pt-4" style="max-width: 32rem;">
      <div class="row d-flex gap-3 justify-content-center mb-3">
        <?php
        for ($i = 0; $i < 5; $i++) {
          $nombre = $_SESSION['jugadores'][$i] ?? "Usuario " . ($i + 1);
        ?>
          <div class="jugador-card col-12 col-sm-6">
            <a href="index.php?ruta=Jugadores&eliminar=<?= $i ?>" class="close-btn">X</a>
            <a href="index.php?ruta=LogIn">
              <div class="jugador-card-divide">
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
          <a class="btn btn-outline-light disabled" href="index.php?ruta=Tableros">Modo Digital</a>
        </div>
	<div class="col-5">
          <a class="btn btn-outline-light" href="index.php?ruta=Tableros">Modo Seguimiento</a>
        </div>
      </div>
    </div>
    <div class="py-3">
      <a class="btn btn-success w-100 fs-5" href="index.php?ruta=Menu">Atrás</a>
    </div>
  </div>
</body>
</html>
