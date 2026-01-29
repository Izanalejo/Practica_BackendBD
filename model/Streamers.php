<?php
class Streamer{
    public function __construct(private PDO $db) {}

     public function listar(): array {
        return $this->db->query("SELECT * FROM streamers ORDER BY id ASC")->fetchAll();
    }


    
}

?>