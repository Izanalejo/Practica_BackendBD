<?php

class Categoria
{
    public function __construct(private PDO $db) {}


    public function listar(): array
    {
        $result = $this->db->query("SELECT * FROM categorias ORDER BY id ASC")->fetchAll();
        return $result;
    }
    public function obtenerPorId(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categorias WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function añadir(string $nombre, string $descripcion)
    {
        $stmt = $this->db->prepare("INSERT INTO categorias(nombre, descripcion) VALUES (?, ?)");
        $stmt->execute([$nombre, $descripcion]);
    }

    public function actualizar(int $id, string $nombre, string $descripcion)
    {
        $stmt = $this->db->prepare("UPDATE categorias SET nombre = ?, descripcion = ? WHERE id = ?");
        $stmt->execute([$nombre, $descripcion, $id]);
    }

    public function eliminar(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM categorias WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function tieneStreamers(int $id): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM streamer_categorias WHERE categoria_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn() > 0;
    }

    public function existeNombre(string $nombre, ?int $excludeId = null): bool
    {
        if ($excludeId !== null) {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM categorias WHERE nombre = ? AND id != ?");
            $stmt->execute([$nombre, $excludeId]);
        } else {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM categorias WHERE nombre = ?");
            $stmt->execute([$nombre]);
        }
        return $stmt->fetchColumn() > 0;
    }
}
