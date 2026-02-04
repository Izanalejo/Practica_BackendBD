<?php
class Streamer{
    public function __construct(private PDO $db) {}

     public function listar(): array {
        return $this->db->query("SELECT * FROM streamers ORDER BY id ASC")->fetchAll();
    }
    public function destacado(): array {
        return $this->db->query("SELECT * FROM streamers WHERE destacado =1 ORDER BY id ASC")->fetchAll();
    }


    
}

?>