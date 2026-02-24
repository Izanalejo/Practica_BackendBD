<?php
class Streamer
{
    public function __construct(private PDO $db) {}

    public function listar(): array
    {
        return $this->db->query("
            SELECT s.*, GROUP_CONCAT(c.nombre SEPARATOR ', ') AS categoria
            FROM streamers s
            LEFT JOIN streamer_categorias sc ON s.id = sc.streamer_id
            LEFT JOIN categorias c ON sc.categoria_id = c.id
            GROUP BY s.id
            ORDER BY s.id ASC
        ")->fetchAll();
    }

    public function destacado(): array
    {
        return $this->db->query("
            SELECT s.*, GROUP_CONCAT(c.nombre SEPARATOR ', ') AS categoria
            FROM streamers s
            LEFT JOIN streamer_categorias sc ON s.id = sc.streamer_id
            LEFT JOIN categorias c ON sc.categoria_id = c.id
            WHERE s.destacado = 1
            GROUP BY s.id
            ORDER BY s.id ASC
        ")->fetchAll();
    }

    public function destacar(int $id)
    {
        $stmt = $this->db->prepare("UPDATE streamers SET destacado = 0");
        $stmt->execute();
        $stmt = $this->db->prepare("UPDATE streamers SET destacado = 1 WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function asignarCategorias(int $streamerId, array $categoriaIds): void
    {
        // Borrar las categorías actuales del streamer
        $stmt = $this->db->prepare("DELETE FROM streamer_categorias WHERE streamer_id = ?");
        $stmt->execute([$streamerId]);

        // Insertar las nuevas
        $stmt = $this->db->prepare("INSERT INTO streamer_categorias (streamer_id, categoria_id) VALUES (?, ?)");
        foreach ($categoriaIds as $categoriaId) {
            $stmt->execute([$streamerId, (int)$categoriaId]);
        }
    }

    public function obtenerCategorias(int $streamerId): array
    {
        $stmt = $this->db->prepare("SELECT categoria_id FROM streamer_categorias WHERE streamer_id = ?");
        $stmt->execute([$streamerId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }




    public function obtenerPorId(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM streamers WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function listarCategorias(): array
    {
        return $this->db->query("SELECT * FROM categorias ORDER BY id ASC")->fetchAll();
    }
}
