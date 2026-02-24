<?php
class Streamer{
    public function __construct(private PDO $db) {}

     public function listar(): array {
        return $this->db->query("SELECT * FROM streamers ORDER BY id ASC")->fetchAll();
    }
    public function destacado(): array {
        return $this->db->query("SELECT * FROM streamers WHERE destacado =1 ORDER BY id ASC")->fetchAll();
    }
    public function destacar(int $id){
    $stmt = $this->db->prepare("UPDATE streamers SET destacado = 0");
    $stmt->execute();
    $stmt = $this->db ->prepare("UPDATE streamers SET destacado = 1 WHERE id = ?");
    $stmt->execute([$id]);
}


    
}

?>