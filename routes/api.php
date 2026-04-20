<?php

use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\WahanaController;
use App\Controllers\TiketController;
use App\Controllers\ReviewController;
use App\Controllers\AdminController;

// =====================
// AUTH ROUTES
// =====================
$router->post('/api/auth/login',    [AuthController::class, 'login']);
$router->post('/api/auth/register', [AuthController::class, 'register']);
$router->post('/api/auth/logout',   [AuthController::class, 'logout']);
$router->get('/api/auth/me',        [AuthController::class, 'me']);

// =====================
// USER ROUTES
// =====================
$router->get('/api/user/profile',        [UserController::class, 'profile']);
$router->put('/api/user/profile',        [UserController::class, 'updateProfile']);
$router->put('/api/user/change-password',[UserController::class, 'changePassword']);

// =====================
// WAHANA ROUTES
// =====================
$router->get('/api/wahana',          [WahanaController::class, 'index']);
$router->get('/api/wahana/{id}',     [WahanaController::class, 'show']);

// =====================
// TIKET ROUTES
// =====================
$router->get('/api/tiket',           [TiketController::class, 'index']);
$router->post('/api/tiket/pesan',    [TiketController::class, 'pesan']);
$router->get('/api/tiket/riwayat',   [TiketController::class, 'riwayat']);

// =====================
// REVIEW ROUTES
// =====================
$router->get('/api/review',          [ReviewController::class, 'index']);
$router->post('/api/review',         [ReviewController::class, 'store']);
$router->delete('/api/review/{id}',  [ReviewController::class, 'destroy']);

// =====================
// ADMIN ROUTES
// =====================
$router->get('/api/admin/dashboard', [AdminController::class, 'dashboard']);
$router->get('/api/admin/users',     [AdminController::class, 'users']);
$router->delete('/api/admin/users/{id}', [AdminController::class, 'deleteUser']);
$router->get('/api/admin/tiket',     [AdminController::class, 'tiket']);
$router->put('/api/admin/tiket/{id}',[AdminController::class, 'updateTiket']);
$router->get('/api/admin/wahana',    [AdminController::class, 'wahana']);
$router->post('/api/admin/wahana',   [AdminController::class, 'createWahana']);
$router->put('/api/admin/wahana/{id}',   [AdminController::class, 'updateWahana']);
$router->delete('/api/admin/wahana/{id}',[AdminController::class, 'deleteWahana']);
$router->get('/api/admin/review',    [AdminController::class, 'review']);
$router->delete('/api/admin/review/{id}', [AdminController::class, 'deleteReview']);