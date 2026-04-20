<?php

namespace App\Models;

class ReviewModel extends BaseModel
{
    protected string $table = 'reviews';

    public function getAllWithUser(): array
    {
        $stmt = $this->db->query(
            "SELECT r.*,
                    CONCAT(u.nama_depan, ' ', u.nama_belakang) AS nama_user,
                    u.username
             FROM {$this->table} r
             LEFT JOIN users u ON r.user_id = u.id
             ORDER BY r.created_at DESC"
        );
        return $stmt->fetchAll();
    }

    public function getByUserId(int $userId): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table}
             WHERE user_id = ?
             ORDER BY created_at DESC"
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getLatest(int $limit = 6): array
    {
        $stmt = $this->db->prepare(
            "SELECT r.*,
                    CONCAT(u.nama_depan, ' ', u.nama_belakang) AS nama_user
             FROM {$this->table} r
             LEFT JOIN users u ON r.user_id = u.id
             ORDER BY r.created_at DESC
             LIMIT ?"
        );
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }
}