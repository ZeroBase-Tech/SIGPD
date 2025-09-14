<?php
session_start();

// Obtener el jugador que está viendo este tablero
$jugador_index = $_GET['jugador'] ?? 0;
$jugadores = $_SESSION['jugadores'] ?? [];
$nombre_jugador = $jugadores[$jugador_index] ?? "Jugador " . ($jugador_index + 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DraftoTux - Tablero de <?= htmlspecialchars($nombre_jugador) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>

<body class="bg-dark">

    <div id="background-blur" style="background-image: url('../../public/assets/img/Fondo.png');"></div>

    <div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center px-3">
       <a href="../../public/index.php" class="text-decoration-none">
      <h1 class="blinker-semibold">DraftoTux</h1>
    </a>

        <div class="tablero" style="background-image: url('../../public/assets/img/Tablero.png');">
            <div class="usuario"><?= htmlspecialchars($nombre_jugador) ?></div>
            <div id="cas1" class="casilla casilla_compuesta" style="top:40px; left:30px;"></div>
            <div id="cas2" class="casilla casilla_simple" style="top:65px; left:330px;"></div>
            <div id="cas3" class="casilla casilla_compuesta" style="top:210px; left:30px;"></div>
            <div id="cas4" class="casilla casilla_compuesta" style="top:210px; left:310px;"></div>
            <div id="cas5" class="casilla casilla_compuesta" style="top:370px; left:35px;"></div>
            <div id="cas6" class="casilla casilla_simple" style="top:375px; left:330px;"></div>
            <div id="cas7" class="casilla casilla_rio" style="top:30px; left:220px;"></div>
        </div>

        <div class="barra_inferior mt-3">
            <img src="../../public/assets/img/ficha-arch.png" class="ficha" id="ficha-arch" draggable="true">
            <img src="../../public/assets/img/ficha-debian.png" class="ficha" id="ficha-debian" draggable="true">
            <img src="../../public/assets/img/ficha-fedora.png" class="ficha" id="ficha-fedora" draggable="true">
            <img src="../../public/assets/img/ficha-mint.png" class="ficha" id="ficha-mint" draggable="true">
            <img src="../../public/assets/img/ficha-ubuntu.png" class="ficha" id="ficha-ubuntu" draggable="true">
            <img src="../../public/assets/img/ficha-suse.png" class="ficha" id="ficha-suse" draggable="true">
        </div>

        <div class="mt-4">
            <a class="btn btn-success w-100 fs-5" href="tableros.php">Atras</a>
        </div>
    </div>

    <script>
        // Drag & drop de fichas
        const limites = {
            cas1: 6,
            cas2: 1,
            cas3: 3,
            cas4: 6,
            cas6: 1
        };

        const fichas = document.querySelectorAll('.ficha');
        fichas.forEach(ficha => {
            ficha.addEventListener('dragstart', e => {
                e.dataTransfer.setData('id', e.target.id);
            });
        });

        const casillas = document.querySelectorAll('.casilla');
        casillas.forEach(casilla => {
            casilla.addEventListener('dragover', e => e.preventDefault());
            casilla.addEventListener('drop', e => {
                e.preventDefault();
                const id = e.dataTransfer.getData('id');
                const ficha = document.getElementById(id);

                const limite = limites[casilla.id];
                const fichasEnCasilla = casilla.querySelectorAll('.ficha').length;
                if (limite && fichasEnCasilla >= limite) {
                    alert(`Esta casilla ya alcanzó su límite de ${limite} fichas!`);
                    return;
                }

                if (ficha.parentElement.classList.contains('barra_inferior')) {
                    const copia = ficha.cloneNode(true);
                    copia.id = id + '-' + Date.now();
                    copia.addEventListener('dragstart', e => {
                        e.dataTransfer.setData('id', e.target.id);
                    });
                    casilla.appendChild(copia);
                } else {
                    casilla.appendChild(ficha);
                }
            });
        });
    </script>

</body>

</html>