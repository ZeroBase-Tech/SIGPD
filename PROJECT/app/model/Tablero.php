<?php



class Tablero {
 private $pdo;

 public function create($JugadorId, $Partida) {
  $this->pdo = Database::getInstancia()->getConexion();

  $sql = "INSERT INTO Tablero (Puntos, id_jugador, id_partida) VALUES (0, :Jugador, :Partida)";
  $stmt = $this->pdo->prepare($sql);

  $stmt->bindParam(':Jugador', $JugadorId);
  $stmt->bindParam(':Partida', $Partida);

  return $stmt->execute();
 }

 public function GetByPartida($Partida){
  $this->pdo = Database::getInstancia()->getConexion();

  $sql = "SELECT * FROM Tablero WHERE id_partida = :idPartida";

  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam(':idPartida', $Partida);

  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
 }

 public function GetByUser($Jugador){
  $this->pdo = Database::getInstancia()->getConexion();

  $sql = "SELECT * FROM Tablero WHERE id_jugador = :idJugador";

  $stmt = $this->pdo->prepare($sql);
  $stmt->bindParam(':idJugador', $Jugador);

  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
 }
}
?>
