<?php
class Partida {
 private $pdo;

 public function create() {
  $this->pdo = Database::getInstancia()->getConexion();

  $sql = "INSERT INTO Partida (estado) VALUES (DEFAULT)";
  $stmt = $this->pdo->prepare($sql);

  $stmt->execute();
  return (int)$this->pdo->lastInsertId();
 }

 public function getById($id) {
  $sql = "SELECT * FROM Partida WHERE id = :id";

  $stmt = $this->pdo->prepare($sql);
  $stmt->bindValue(":id", $id);

  $stmt->execute();
  $Partida = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($Partida !== false) {
   return $Partida;
  }else{
   return;
  }
 }

 public function endMatch($id) {
  $this->pdo = Database::getInstancia()->getConexion();

  $sql = "UPDATE Partida SET estado = 'finalizada' WHERE id_partida=:id";

  $stmt = $this->pdo->prepare($sql);
  $stmt->bindValue(":id", $id);

  $stmt->execute();
  return;
 }
}
?>
