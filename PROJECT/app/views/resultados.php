<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DraftoTux</title>
  <link rel="icon" href="assets/img/tux.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/ranking.css">
</head>

<body class="bg-dark text-white">

  <div id="background-blur" style="background-image: url('assets/img/Fondo.png');"></div>

  <div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center px-3">

    <h1 class="blinker-semibold">Resultados</h1>

    <div class="card text-white  p-4 rounded-4 shadow" style="max-width: 32rem;">

      <table class="table table-dark table-hover align-middle text-center  fs-5">
        <thead class="table-dark">
          <tr>
            <th scope="col-1">Puesto</th>
            <th scope="col-2">Usuario</th>
            <th scope="col-2">Max. Puntos</th>
            <th scope="col-2">Partidas jugadas</th>
            <th scope="col-2">Ultima Partida</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $ranking = $ranking ?? [];

          for ($i = 0; $i < 5; $i++):
            $puesto = $i + 1;
            $fila = $ranking[$i] ?? ['usuario' => '--', 'max_puntos' => '--', 'partidas_jugadas' => '--'];

            switch ($puesto) {
              case 1:
                $colorClase = 'oro';
                break;
              case 2:
                $colorClase = 'plata';
                break;
              case 3:
                $colorClase = 'bronce';
                break;
              default:
                $colorClase = '';
                break;
            }
            ?>
            <tr>
              <th class="<?= $colorClase ?>" scope="row"><?= $puesto ?></th>
              <td><?= htmlspecialchars($fila['usuario']) ?></td>
              <td><?= htmlspecialchars($fila['max_puntos']) ?></td>
              <td><?= htmlspecialchars($fila['partidas_jugadas']) ?></td>
              <td><?= htmlspecialchars($fila['ultima_partida'] ?? '--') ?></td>
            </tr>
          <?php endfor; ?>
        </tbody>
      </table>

      <div class="d-grid mt-2">
        <a href="index.php?ruta=Opciones" class="btn btn-success fs-5">Atrás</a>
      </div>
    </div>

  </div>

</body>

</html>