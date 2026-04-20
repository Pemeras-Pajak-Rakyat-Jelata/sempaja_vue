<?php

namespace App\Controllers;

use App\Core\Response;
use App\Core\Middleware;
use App\Models\UserModel;
use App\Models\WahanaModel;
use App\Models\TiketModel;
use App\Models\ReviewModel;

class AdminController
{
    private UserModel   $userModel;
    private WahanaModel $wahanaModel;
    private TiketModel  $tiketModel;
    private ReviewModel $reviewModel;

    public function __construct()
    {
        $this->userModel   = new UserModel();
        $this->wahanaModel = new WahanaModel();
        $this->tiketModel  = new TiketModel();
        $this->reviewModel = new ReviewModel();
    }

    // =====================
    // GET /api/admin/dashboard
    // =====================
    public function dashboard(): void
    {
        Middleware::admin();

        Response::success([
            'total_users'  => $this->userModel->count(),
            'total_wahana' => $this->wahanaModel->count(),
            'total_tiket'  => $this->tiketModel->count(),
            'total_review' => $this->reviewModel->count(),
        ], 'Data dashboard berhasil diambil');
    }

    // =====================
    // GET /api/admin/users
    // =====================
    public function users(): void
    {
        Middleware::admin();
        $users = $this->userModel->getAllUsers();
        Response::success($users, 'Data users berhasil diambil');
    }

    // ============================
    // DELETE /api/admin/users/{id}
    // ============================
    public function deleteUser(string $id): void
    {
        $payload = Middleware::admin();

        if ((int)$id === $payload->id) {
            Response::error('Tidak dapat menghapus akun sendiri', 400);
        }

        $user = $this->userModel->findById((int)$id);
        if (!$user) {
            Response::notFound('User tidak ditemukan');
        }

        $this->userModel->delete((int)$id);
        Response::success(null, 'User berhasil dihapus');
    }

    // =====================
    // GET /api/admin/tiket
    // =====================
    public function tiket(): void
    {
        Middleware::admin();
        $tiket = $this->tiketModel->getAllWithUser();
        Response::success($tiket, 'Data tiket berhasil diambil');
    }

    // ============================
    // PUT /api/admin/tiket/{id}
    // ============================
    public function updateTiket(string $id): void
    {
        Middleware::admin();

        $body   = json_decode(file_get_contents('php://input'), true);
        $status = trim($body['status'] ?? '');

        $allowed = ['pending', 'confirmed', 'cancelled'];
        if (!in_array($status, $allowed)) {
            Response::error('Status tidak valid', 422);
        }

        $tiket = $this->tiketModel->findById((int)$id);
        if (!$tiket) {
            Response::notFound('Tiket tidak ditemukan');
        }

        $this->tiketModel->update((int)$id, ['status' => $status]);
        Response::success(null, 'Status tiket berhasil diperbarui');
    }

    // =====================
    // GET /api/admin/wahana
    // =====================
    public function wahana(): void
    {
        Middleware::admin();
        $wahana = $this->wahanaModel->getAllAdmin();
        Response::success($wahana, 'Data wahana berhasil diambil');
    }

    // ========================
    // POST /api/admin/wahana
    // ========================
    public function createWahana(): void
    {
        Middleware::admin();

        $body = json_decode(file_get_contents('php://input'), true);

        $nama      = trim($body['nama']      ?? '');
        $kategori  = trim($body['kategori']  ?? '');
        $deskripsi = trim($body['deskripsi'] ?? '');
        $status    = trim($body['status']    ?? 'aktif');

        if (!$nama || !$kategori) {
            Response::error('Nama dan kategori wahana wajib diisi', 422);
        }

        $id = $this->wahanaModel->create([
            'nama'       => $nama,
            'kategori'   => $kategori,
            'deskripsi'  => $deskripsi,
            'kapasitas'  => (int)($body['kapasitas']  ?? 0),
            'min_tinggi' => (int)($body['min_tinggi'] ?? 0),
            'durasi'     => (int)($body['durasi']     ?? 0),
            'status'     => $status,
        ]);

        if (!$id) {
            Response::error('Gagal menambah wahana', 500);
        }

        $wahana = $this->wahanaModel->findById($id);
        Response::success($wahana, 'Wahana berhasil ditambahkan', 201);
    }

    // ==============================
    // PUT /api/admin/wahana/{id}
    // ==============================
    public function updateWahana(string $id): void
    {
        Middleware::admin();

        $body  = json_decode(file_get_contents('php://input'), true);
        $wahana = $this->wahanaModel->findById((int)$id);

        if (!$wahana) {
            Response::notFound('Wahana tidak ditemukan');
        }

        $this->wahanaModel->update((int)$id, [
            'nama'       => trim($body['nama']      ?? $wahana['nama']),
            'kategori'   => trim($body['kategori']  ?? $wahana['kategori']),
            'deskripsi'  => trim($body['deskripsi'] ?? $wahana['deskripsi']),
            'kapasitas'  => (int)($body['kapasitas']  ?? $wahana['kapasitas']),
            'min_tinggi' => (int)($body['min_tinggi'] ?? $wahana['min_tinggi']),
            'durasi'     => (int)($body['durasi']     ?? $wahana['durasi']),
            'status'     => trim($body['status']    ?? $wahana['status']),
        ]);

        $updated = $this->wahanaModel->findById((int)$id);
        Response::success($updated, 'Wahana berhasil diperbarui');
    }

    // ================================
    // DELETE /api/admin/wahana/{id}
    // ================================
    public function deleteWahana(string $id): void
    {
        Middleware::admin();

        $wahana = $this->wahanaModel->findById((int)$id);
        if (!$wahana) {
            Response::notFound('Wahana tidak ditemukan');
        }

        $this->wahanaModel->delete((int)$id);
        Response::success(null, 'Wahana berhasil dihapus');
    }

    // =====================
    // GET /api/admin/review
    // =====================
    public function review(): void
    {
        Middleware::admin();
        $review = $this->reviewModel->getAllWithUser();
        Response::success($review, 'Data review berhasil diambil');
    }

    // ================================
    // DELETE /api/admin/review/{id}
    // ================================
    public function deleteReview(string $id): void
    {
        Middleware::admin();

        $review = $this->reviewModel->findById((int)$id);
        if (!$review) {
            Response::notFound('Review tidak ditemukan');
        }

        $this->reviewModel->delete((int)$id);
        Response::success(null, 'Review berhasil dihapus');
    }
}