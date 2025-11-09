<?php
require_once __DIR__ . '/../model/Database.php';
class TableroController
{

    public function mostrarTableros()
    {

        // Inicializamos array de jugadores si no existe
        if (!isset($_SESSION['jugadores'])) {
            $_SESSION['jugadores'] = [];
        }

        // Agregamos último jugador si viene del login
        if (isset($_SESSION['ultimo_jugador'])) {
            $nombre = $_SESSION['ultimo_jugador'];
            if (!in_array($nombre, $_SESSION['jugadores'])) {
                $_SESSION['jugadores'][] = $nombre;
            }
            unset($_SESSION['ultimo_jugador']);
        }

        // Si se finaliza partida
        if (isset($_POST['finalizar_partida'])) {
            $_SESSION['jugadores'] = [];
            header("Location: index.php?ruta=Ranking");
            exit;
        }

        $jugadores = $_SESSION['jugadores'];
        include __DIR__ . '/../views/tableros.php';
    }

    public function mostrarTablero()
    {
        $jugadores = $_SESSION['jugadores'] ?? [];
        $jugador_index = $_GET['jugador'] ?? 0;

        if (isset($jugadores[$jugador_index])) {
            $nombre_jugador = $jugadores[$jugador_index];

            // Obtener id_tablero desde la sesión
            $id_tablero = $_SESSION['tableros'][$nombre_jugador] ?? null;
        }

        include __DIR__ . '/../views/tablero-personal.php';
    }

    public function finalizarPartida()
    {
        if (isset($_POST['finalizar_partida'])) {
            $id_tablero = $_POST['id_tablero'] ?? null;
            $puntos = $_POST['puntos'] ?? 0;

            if ($id_tablero) {
                $conn = Database::getInstancia()->getConexion();

                // Actualizar puntos del tablero
                $stmt = $conn->prepare("UPDATE Tablero SET puntos = ? WHERE id_tablero = ?");
                $stmt->execute([$puntos, $id_tablero]);

                // Cambiar estado de la partida a 'finalizada'
                $stmtPartida = $conn->prepare("
                    UPDATE Partida 
                    SET estado = 'finalizada'
                    WHERE id_partida = (SELECT id_partida FROM Tablero WHERE id_tablero = ?)
                ");
                $stmtPartida->execute([$id_tablero]);
            }

            unset($_SESSION['jugadores'], $_SESSION['tableros'], $_SESSION['id_partida']);

            // Redirigir a ranking o home
            header("Location: index.php?ruta=Ranking");
            exit;
        }
    }

    public function mostrarRanking()
    {
        $conn = Database::getInstancia()->getConexion();

        // Traer el top 5 de jugadores con sus máximos puntos y cantidad de partidas jugadas
        $stmt = $conn->prepare("
        SELECT 
            j.usuario AS usuario,
            MAX(t.puntos) AS max_puntos,
            COUNT(t.id_tablero) AS partidas_jugadas,
            (
                SELECT t2.puntos
                FROM Tablero t2
                JOIN Partida p2 ON t2.id_partida = p2.id_partida
                WHERE t2.id_jugador = j.id_jugador
                ORDER BY p2.fecha_inicio DESC
                LIMIT 1
            ) AS ultima_partida
        FROM Jugador j
        JOIN Tablero t ON j.id_jugador = t.id_jugador
        JOIN Partida p ON t.id_partida = p.id_partida
        WHERE p.estado = 'finalizada'
        GROUP BY j.id_jugador
        ORDER BY max_puntos DESC
        LIMIT 5
    ");
        $stmt->execute();
        $ranking = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../views/resultados.php';
    }
}

