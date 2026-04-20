<?php

namespace App\Controllers;

use App\Core\Response;
use App\Core\Middleware;
use App\Models\ReviewModel;

class ReviewController
{
    private ReviewModel $reviewModel;

    public function __construct()
    {
        $this->reviewModel = new ReviewModel();
    }

    // =====================
    // GET /api/review
    // =====================
    public function index(): void
    {
        $review = $this->reviewModel->getAllWithUser();
        Response::success($review, 'Data review berhasil diambil');
    }

    // =====================
    // POST /api/review
    // =====================
    public function store(): void
    {
        $payload = Middleware::auth();
        $body    = json_decode(file_get_contents('php://input'), true);

        $rating           = (int)($body['rating']            ?? 0);
        $komentar         = trim($body['komentar']           ?? '');
        $tanggalKunjungan = trim($body['tanggal_kunjungan']  ?? '');

        // Validasi
        if ($rating < 1 || $rating > 5) {
            Response::error('Rating harus antara 1 sampai 5', 422);
        }

        if (!$komentar) {
            Response::error('Komentar wajib diisi', 422);
        }

        $id = $this->reviewModel->create([
            'user_id'          => $payload->id,
            'rating'           => $rating,
            'komentar'         => $komentar,
            'tanggal_kunjungan'=> $tanggalKunjungan ?: date('Y-m-d'),
        ]);

        if (!$id) {
            Response::error('Gagal mengirim review', 500);
        }

        $review = $this->reviewModel->findById($id);

        Response::success($review, 'Review berhasil dikirim', 201);
    }

    // =====================
    // DELETE /api/review/{id}
    // =====================
    public function destroy(string $id): void
    {
        $payload = Middleware::auth();
        $review  = $this->reviewModel->findById((int)$id);

        if (!$review) {
            Response::notFound('Review tidak ditemukan');
        }

        // Hanya pemilik review atau admin yang bisa hapus
        if ($review['user_id'] !== $payload->id && $payload->role !== 'admin') {
            Response::forbidden('Anda tidak memiliki akses untuk menghapus review ini');
        }

        $this->reviewModel->delete((int)$id);

        Response::success(null, 'Review berhasil dihapus');
    }
}