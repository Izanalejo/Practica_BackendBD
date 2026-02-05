<?php
class User{
    public function __construct(private PDO $db) {}

     public function listar(): array {
        return $this->db->query("SELECT * FROM usuarios ORDER BY id ASC")->fetchAll();
    }

    public function añadir(string $username, string
     $ultima_visita, int $total_visitas){
        $stmt = $this->db->prepare("INSERT INTO usuarios (username, ultima_visita, total_visitas) VALUES (?, ?, ?)");
        $stmt->execute([$username,$ultima_visita,$total_visitas]);
    }

    public function obtenerPorUsername(string $username): ?array {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch() ?: null;
    }
public function actualizar(string $username, string $ultima_visita){
    $stmt = $this->db->prepare("UPDATE usuarios SET total_visitas = total_visitas + 1, ultima_visita = ? WHERE username = ?");
    $stmt->execute([$ultima_visita, $username]);
}


}

?>