<?php
require_once __DIR__ . '/../model/Database.php';

class PartidaController
{

    public function crearPartida()
    {
        $conn = Database::getInstancia()->getConexion();

        $modo = $_GET['modo'] ?? 'seguimiento';
        $fecha_inicio = date('Y-m-d H:i:s');
        $estado = 'en curso';

        $stmt = $conn->prepare("INSERT INTO partida (fecha_inicio, estado, modo) VALUES (?, ?, ?)");
        $stmt->execute([$fecha_inicio, $estado, $modo]);

        $_SESSION['id_partida'] = $conn->lastInsertId();

        if (!empty($_SESSION['jugadores'])) {
            foreach ($_SESSION['jugadores'] as $usuarioJugador) {
                // Buscar el id_jugador en la base de datos
                $stmtJugador = $conn->prepare("SELECT id_jugador FROM jugador WHERE usuario = ?");
                $stmtJugador->execute([$usuarioJugador]);
                $id_jugador = $stmtJugador->fetchColumn();

                if ($id_jugador) {
                    $stmtJuega = $conn->prepare("INSERT INTO juega (id_partida, id_jugador) VALUES (?, ?)");
                    $stmtJuega->execute([$_SESSION['id_partida'], $id_jugador]);

                    $stmtTablero = $conn->prepare("INSERT INTO Tablero (id_jugador, id_partida, puntos) VALUES (?, ?, 0)");
                    $stmtTablero->execute([$id_jugador, $_SESSION['id_partida']]);

                    $id_tablero = $conn->lastInsertId();

                    // Guardar el id_tablero en la sesión relacionado al jugador
                    $_SESSION['tableros'][$usuarioJugador] = $id_tablero;
                }
            }
        }

        header("Location: index.php?ruta=Boards");
        exit;
    }
}