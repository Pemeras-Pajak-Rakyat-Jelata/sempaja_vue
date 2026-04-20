<template>
  <div class="dashboard-wrapper">

    <NavbarComponent />

    <!-- HERO -->
    <section id="admin-hero">
      <div class="container">
        <div class="py-4">
          <span class="hero-label">Panel Admin</span>
          <h1 class="hero-title">Dashboard Admin<br>Bumi Sempaja Waterpark</h1>
        </div>
      </div>
      <div class="hero-wave">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0,120 L0,60 C200,20 400,90 600,50 C800,10 1000,70 1200,40 C1320,24 1400,50 1440,60 L1440,120 Z" fill="rgba(125,216,240,0.3)"/>
          <path d="M0,120 L0,85 C360,50 720,110 1080,80 C1260,65 1380,85 1440,80 L1440,120 Z" fill="#f8fbfd"/>
        </svg>
      </div>
    </section>

    <!-- MAIN -->
    <section id="admin-main">
      <div class="container">

        <!-- STAT CARDS -->
        <div class="row g-3 mb-4">
          <div class="col-6 col-lg-3" v-for="stat in statCards" :key="stat.label">
            <div class="stat-card">
              <div class="stat-icon" :style="{ background: stat.bg, color: stat.color }">
                <i class="bi" :class="stat.icon"></i>
              </div>
              <div class="stat-info">
                <span class="stat-number">{{ adminStore.dashboard?.[stat.key] ?? '—' }}</span>
                <span class="stat-label">{{ stat.label }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- TABS -->
        <ul class="nav admin-tabs mb-4">
          <li class="nav-item" v-for="tab in tabs" :key="tab.key">
            <button
              class="nav-link"
              :class="{ active: activeTab === tab.key }"
              @click="switchTab(tab.key)"
            >
              <i class="bi me-1" :class="tab.icon"></i>{{ tab.label }}
            </button>
          </li>
        </ul>

        <!-- ===================== TAB: USERS ===================== -->
        <div v-if="activeTab === 'users'" class="admin-card">
          <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h5 class="card-title-custom">Daftar Pengguna</h5>
            <button class="btn-refresh-custom" @click="adminStore.fetchUsers()">
              <i class="bi bi-arrow-clockwise"></i> Refresh
            </button>
          </div>
          <LoadingSpinner v-if="adminStore.loading" />
          <div v-else class="table-responsive">
            <table class="table table-custom">
              <thead>
                <tr>
                  <th>No</th><th>Nama</th><th>Username</th>
                  <th>Email</th><th>Telepon</th><th>Role</th><th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="adminStore.users.length === 0">
                  <td colspan="7" class="text-center py-4 text-muted">Tidak ada data</td>
                </tr>
                <tr v-for="(u, i) in adminStore.users" :key="u.id">
                  <td>{{ i + 1 }}</td>
                  <td class="fw-bold">{{ u.nama_depan }} {{ u.nama_belakang }}</td>
                  <td>@{{ u.username }}</td>
                  <td>{{ u.email }}</td>
                  <td>{{ u.telepon || '-' }}</td>
                  <td>
                    <span class="badge-custom" :class="u.role === 'admin' ? 'badge-keluhan' : ''">
                      {{ u.role }}
                    </span>
                  </td>
                  <td>
                    <button class="btn-action delete" title="Hapus" @click="confirmDelete('user', u.id, u.nama_depan)">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- ===================== TAB: WAHANA ===================== -->
        <div v-if="activeTab === 'wahana'" class="admin-card">
          <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h5 class="card-title-custom">Manajemen Wahana</h5>
            <button class="btn-primary-custom" @click="openWahanaModal()">
              <i class="bi bi-plus-lg"></i> Tambah Wahana
            </button>
          </div>
          <LoadingSpinner v-if="adminStore.loading" />
          <div v-else class="table-responsive">
            <table class="table table-custom">
              <thead>
                <tr><th>No</th><th>Nama</th><th>Kategori</th><th>Kapasitas</th><th>Min. Tinggi</th><th>Status</th><th>Aksi</th></tr>
              </thead>
              <tbody>
                <tr v-if="adminStore.wahanaList.length === 0">
                  <td colspan="7" class="text-center py-4 text-muted">Tidak ada data</td>
                </tr>
                <tr v-for="(w, i) in adminStore.wahanaList" :key="w.id">
                  <td>{{ i + 1 }}</td>
                  <td class="fw-bold">{{ w.nama }}</td>
                  <td><span class="badge-custom">{{ w.kategori }}</span></td>
                  <td>{{ w.kapasitas || '-' }} orang</td>
                  <td>{{ w.min_tinggi || '-' }} cm</td>
                  <td>
                    <span class="badge-custom" :class="w.status === 'aktif' ? '' : 'badge-keluhan'">
                      {{ w.status }}
                    </span>
                  </td>
                  <td>
                    <button class="btn-action edit" title="Edit" @click="openWahanaModal(w)">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn-action delete" title="Hapus" @click="confirmDelete('wahana', w.id, w.nama)">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- ===================== TAB: TIKET ===================== -->
        <div v-if="activeTab === 'tiket'" class="admin-card">
          <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h5 class="card-title-custom">Data Tiket & Reservasi</h5>
            <button class="btn-refresh-custom" @click="adminStore.fetchTiket()">
              <i class="bi bi-arrow-clockwise"></i> Refresh
            </button>
          </div>
          <LoadingSpinner v-if="adminStore.loading" />
          <div v-else class="table-responsive">
            <table class="table table-custom">
              <thead>
                <tr><th>No</th><th>Pengunjung</th><th>Jenis Tiket</th><th>Jumlah</th><th>Total</th><th>Status</th><th>Aksi</th></tr>
              </thead>
              <tbody>
                <tr v-if="adminStore.tiketList.length === 0">
                  <td colspan="7" class="text-center py-4 text-muted">Tidak ada data</td>
                </tr>
                <tr v-for="(t, i) in adminStore.tiketList" :key="t.id">
                  <td>{{ i + 1 }}</td>
                  <td class="fw-bold">{{ t.nama_pengunjung }}</td>
                  <td>{{ t.jenis_tiket }}</td>
                  <td>{{ t.jumlah }}</td>
                  <td>Rp {{ Number(t.total).toLocaleString('id-ID') }}</td>
                  <td>
                    <span class="badge-custom" :class="tiketStatusClass(t.status)">{{ t.status }}</span>
                  </td>
                  <td>
                    <select class="select-status" :value="t.status" @change="updateStatus(t.id, $event.target.value)">
                      <option value="pending">pending</option>
                      <option value="confirmed">confirmed</option>
                      <option value="cancelled">cancelled</option>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- ===================== TAB: REVIEW ===================== -->
        <div v-if="activeTab === 'review'" class="admin-card">
          <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h5 class="card-title-custom">Manajemen Review</h5>
            <button class="btn-refresh-custom" @click="adminStore.fetchReview()">
              <i class="bi bi-arrow-clockwise"></i> Refresh
            </button>
          </div>
          <LoadingSpinner v-if="adminStore.loading" />
          <div v-else class="table-responsive">
            <table class="table table-custom">
              <thead>
                <tr><th>No</th><th>Pengunjung</th><th>Rating</th><th>Komentar</th><th>Tgl Kunjungan</th><th>Aksi</th></tr>
              </thead>
              <tbody>
                <tr v-if="adminStore.reviewList.length === 0">
                  <td colspan="6" class="text-center py-4 text-muted">Tidak ada data</td>
                </tr>
                <tr v-for="(r, i) in adminStore.reviewList" :key="r.id">
                  <td>{{ i + 1 }}</td>
                  <td class="fw-bold">{{ r.nama_user }}</td>
                  <td>
                    <span class="text-warning">
                      <i class="bi bi-star-fill" v-for="s in r.rating" :key="s"></i>
                    </span>
                  </td>
                  <td style="max-width:240px;">
                    <span class="review-komentar">{{ r.komentar }}</span>
                  </td>
                  <td>{{ formatDate(r.tanggal_kunjungan) }}</td>
                  <td>
                    <button class="btn-action delete" title="Hapus" @click="confirmDelete('review', r.id, 'review ini')">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </section>

    <!-- MODAL WAHANA -->
    <Teleport to="body">
      <div v-if="showWahanaModal" class="modal-overlay" @click.self="showWahanaModal = false">
        <div class="modal-box modal-box-lg">
          <div class="modal-box-header">
            <h5 class="modal-box-title">{{ wahanaForm.id ? 'Edit Wahana' : 'Tambah Wahana' }}</h5>
            <button class="modal-box-close" @click="showWahanaModal = false">
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
          <div class="modal-box-body">
            <AlertMessage :show="!!wahanaError" type="error" :message="wahanaError" @close="wahanaError = ''" />
            <div class="row g-3">
              <div class="col-12">
                <label class="edit-label">Nama Wahana</label>
                <input v-model="wahanaForm.nama" type="text" class="edit-input" placeholder="Nama wahana">
              </div>
              <div class="col-md-6">
                <label class="edit-label">Kategori</label>
                <select v-model="wahanaForm.kategori" class="edit-input">
                  <option value="">Pilih kategori</option>
                  <option value="dewasa">Dewasa</option>
                  <option value="anak">Anak</option>
                  <option value="keluarga">Keluarga</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="edit-label">Status</label>
                <select v-model="wahanaForm.status" class="edit-input">
                  <option value="aktif">Aktif</option>
                  <option value="nonaktif">Nonaktif</option>
                  <option value="maintenance">Maintenance</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="edit-label">Kapasitas (orang)</label>
                <input v-model="wahanaForm.kapasitas" type="number" class="edit-input" placeholder="0">
              </div>
              <div class="col-md-4">
                <label class="edit-label">Min. Tinggi (cm)</label>
                <input v-model="wahanaForm.min_tinggi" type="number" class="edit-input" placeholder="0">
              </div>
              <div class="col-md-4">
                <label class="edit-label">Durasi (menit)</label>
                <input v-model="wahanaForm.durasi" type="number" class="edit-input" placeholder="0">
              </div>
              <div class="col-12">
                <label class="edit-label">Deskripsi</label>
                <textarea v-model="wahanaForm.deskripsi" class="edit-input" rows="3" placeholder="Deskripsi wahana..."></textarea>
              </div>
            </div>
          </div>
          <div class="modal-box-footer">
            <button class="btn-edit-cancel" @click="showWahanaModal = false">Batal</button>
            <button class="btn-edit-save" :disabled="wahanaLoading" @click="saveWahana">
              <span v-if="wahanaLoading" class="spinner-border spinner-border-sm me-1"></span>
              {{ wahanaForm.id ? 'Simpan Perubahan' : 'Tambah Wahana' }}
            </button>
          </div>
        </div>
      </div>
    </Teleport>

    <!-- MODAL KONFIRMASI DELETE -->
    <Teleport to="body">
      <div v-if="showDeleteModal" class="modal-overlay" @click.self="showDeleteModal = false">
        <div class="modal-box modal-box-sm">
          <div class="modal-box-header">
            <h5 class="modal-box-title text-danger"><i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus</h5>
            <button class="modal-box-close" @click="showDeleteModal = false"><i class="bi bi-x-lg"></i></button>
          </div>
          <div class="modal-box-body">
            <p style="font-family:'Open Sans',sans-serif;font-size:15px;color:#444;">
              Apakah Anda yakin ingin menghapus <strong>{{ deleteTarget.name }}</strong>? Tindakan ini tidak dapat dibatalkan.
            </p>
          </div>
          <div class="modal-box-footer">
            <button class="btn-edit-cancel" @click="showDeleteModal = false">Batal</button>
            <button class="btn-delete-confirm" :disabled="deleteLoading" @click="doDelete">
              <span v-if="deleteLoading" class="spinner-border spinner-border-sm me-1"></span>
              Ya, Hapus
            </button>
          </div>
        </div>
      </div>
    </Teleport>

    <FooterComponent />
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import NavbarComponent from '@/components/layout/NavbarComponent.vue'
import FooterComponent from '@/components/layout/FooterComponent.vue'
import LoadingSpinner  from '@/components/common/LoadingSpinner.vue'
import AlertMessage    from '@/components/common/AlertMessage.vue'
import { useAdminStore } from '@/stores/admin.js'

const adminStore = useAdminStore()

// =====================
// TABS
// =====================
const tabs = [
  { key: 'users',  label: 'Pengguna', icon: 'bi-people-fill' },
  { key: 'wahana', label: 'Wahana',   icon: 'bi-water' },
  { key: 'tiket',  label: 'Tiket',    icon: 'bi-ticket-perforated-fill' },
  { key: 'review', label: 'Review',   icon: 'bi-chat-square-text-fill' },
]
const activeTab = ref('users')

function switchTab(key) {
  activeTab.value = key
  if (key === 'users'  && !adminStore.users.length)      adminStore.fetchUsers()
  if (key === 'wahana' && !adminStore.wahanaList.length)  adminStore.fetchWahana()
  if (key === 'tiket'  && !adminStore.tiketList.length)   adminStore.fetchTiket()
  if (key === 'review' && !adminStore.reviewList.length)  adminStore.fetchReview()
}

// =====================
// STAT CARDS
// =====================
const statCards = [
  { key: 'total_users',  label: 'Total Pengguna', icon: 'bi-people-fill',              bg: '#EAF6FF', color: '#1ea8d4' },
  { key: 'total_wahana', label: 'Total Wahana',   icon: 'bi-water',                    bg: '#e8f5e9', color: '#28a745' },
  { key: 'total_tiket',  label: 'Total Tiket',    icon: 'bi-ticket-perforated-fill',   bg: '#fff3e0', color: '#f5a623' },
  { key: 'total_review', label: 'Total Review',   icon: 'bi-chat-square-text-fill',    bg: '#fdecea', color: '#dc3545' },
]

// =====================
// WAHANA MODAL
// =====================
const showWahanaModal = ref(false)
const wahanaLoading   = ref(false)
const wahanaError     = ref('')

const wahanaForm = reactive({
  id: null, nama: '', kategori: '', status: 'aktif',
  kapasitas: '', min_tinggi: '', durasi: '', deskripsi: '',
})

function openWahanaModal(wahana = null) {
  wahanaError.value = ''
  if (wahana) {
    Object.assign(wahanaForm, { ...wahana })
  } else {
    Object.assign(wahanaForm, { id: null, nama: '', kategori: '', status: 'aktif', kapasitas: '', min_tinggi: '', durasi: '', deskripsi: '' })
  }
  showWahanaModal.value = true
}

async function saveWahana() {
  if (!wahanaForm.nama || !wahanaForm.kategori) {
    wahanaError.value = 'Nama dan kategori wajib diisi'
    return
  }
  wahanaLoading.value = true
  wahanaError.value   = ''
  try {
    if (wahanaForm.id) {
      await adminStore.updateWahana(wahanaForm.id, { ...wahanaForm })
    } else {
      await adminStore.createWahana({ ...wahanaForm })
    }
    showWahanaModal.value = false
  } catch (err) {
    wahanaError.value = err.response?.data?.message || 'Gagal menyimpan wahana'
  } finally {
    wahanaLoading.value = false
  }
}

// =====================
// TIKET STATUS
// =====================
function tiketStatusClass(status) {
  if (status === 'confirmed') return ''
  if (status === 'pending')   return 'badge-reservasi'
  return 'badge-keluhan'
}

async function updateStatus(id, status) {
  await adminStore.updateTiket(id, { status })
}

// =====================
// DELETE
// =====================
const showDeleteModal = ref(false)
const deleteLoading   = ref(false)
const deleteTarget    = reactive({ type: '', id: null, name: '' })

function confirmDelete(type, id, name) {
  deleteTarget.type = type
  deleteTarget.id   = id
  deleteTarget.name = name
  showDeleteModal.value = true
}

async function doDelete() {
  deleteLoading.value = true
  try {
    if (deleteTarget.type === 'user')   await adminStore.deleteUser(deleteTarget.id)
    if (deleteTarget.type === 'wahana') await adminStore.deleteWahana(deleteTarget.id)
    if (deleteTarget.type === 'review') await adminStore.deleteReview(deleteTarget.id)
    showDeleteModal.value = false
  } catch (err) {
    console.error(err)
  } finally {
    deleteLoading.value = false
  }
}

// =====================
// HELPER
// =====================
function formatDate(date) {
  if (!date) return '-'
  return new Date(date).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })
}

onMounted(() => {
  adminStore.fetchDashboard()
  adminStore.fetchUsers()
})
</script>

<style scoped>
.dashboard-wrapper { min-height: 100vh; background: #f8fbfd; }

/* HERO */
#admin-hero {
  background: linear-gradient(135deg, #0a3d5c 0%, #1ea8d4 55%, #7dd8f0 100%);
  padding-top: 70px; position: relative; overflow: hidden;
  min-height: 45vh; display: flex; align-items: center;
}

.hero-label { font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 13px; color: #f5a623; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 12px; display: block; }
.hero-title { font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: clamp(24px, 4vw, 38px); color: #ffffff; line-height: 1.15; margin: 0; }
.hero-wave  { position: absolute; bottom: 0; left: 0; width: 100%; line-height: 0; }
.hero-wave svg { width: 100%; height: 120px; display: block; }

/* MAIN */
#admin-main { margin-top: -40px; position: relative; z-index: 10; padding-bottom: 80px; }

/* STAT CARDS */
.stat-card {
  background: #ffffff; border-radius: 16px;
  padding: 20px; display: flex; align-items: center; gap: 16px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.06);
  transition: transform 0.25s ease;
}
.stat-card:hover { transform: translateY(-4px); }
.stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; }
.stat-info { display: flex; flex-direction: column; }
.stat-number { font-family: 'Montserrat', sans-serif; font-size: 26px; font-weight: 800; color: #1D3461; line-height: 1; }
.stat-label  { font-family: 'Open Sans', sans-serif; font-size: 12px; color: #888; margin-top: 4px; }

/* TABS */
.admin-tabs { gap: 8px; flex-wrap: wrap; }
.admin-tabs .nav-link {
  background: #ffffff; color: #1D3461;
  border-radius: 50px; padding: 10px 20px;
  font-family: 'Inter', sans-serif; font-weight: 600; font-size: 14px;
  border: 1.5px solid #e0e0e0; transition: all 0.25s ease;
  display: flex; align-items: center; gap: 6px; cursor: pointer;
}
.admin-tabs .nav-link:hover { border-color: #1ea8d4; color: #1ea8d4; }
.admin-tabs .nav-link.active { background: #1D3461; color: #ffffff; border-color: #1D3461; box-shadow: 0 4px 15px rgba(29,52,97,0.2); }

/* CARD */
.admin-card { background: #ffffff; border-radius: 20px; padding: 32px; box-shadow: 0 4px 24px rgba(0,0,0,0.06); }
.card-title-custom { font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 20px; color: #1D3461; margin: 0; }

/* TABLE */
.table-custom { border-collapse: separate; border-spacing: 0 8px; margin-bottom: 0; }
.table-custom thead th { border: none; color: #94a3b8; font-family: 'Montserrat', sans-serif; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 8px 16px; background: transparent; }
.table-custom tbody tr { transition: transform 0.2s ease, box-shadow 0.2s ease; }
.table-custom tbody tr:hover { transform: translateY(-2px); box-shadow: 0 4px 16px rgba(0,0,0,0.06); }
.table-custom tbody td { background: #f8fbfd; border-top: 1px solid #eef2f7; border-bottom: 1px solid #eef2f7; padding: 14px 16px; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #444; vertical-align: middle; }
.table-custom tbody tr td:first-child { border-left: 1px solid #eef2f7; border-radius: 12px 0 0 12px; }
.table-custom tbody tr td:last-child  { border-right: 1px solid #eef2f7; border-radius: 0 12px 12px 0; }
.table-custom .fw-bold { font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 14px; color: #1D3461; }

/* BUTTONS */
.btn-primary-custom { background: #1ea8d4; color: #ffffff; border: none; border-radius: 50px; padding: 9px 22px; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 14px; transition: all 0.25s ease; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
.btn-primary-custom:hover { background: #1D3461; transform: translateY(-2px); color: #ffffff; }
.btn-refresh-custom { background: #EAF6FF; color: #1ea8d4; border: none; border-radius: 50px; padding: 9px 22px; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.25s ease; display: inline-flex; align-items: center; gap: 6px; }
.btn-refresh-custom:hover { background: #1ea8d4; color: #ffffff; }

.btn-action { width: 36px; height: 36px; border: none; border-radius: 10px; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center; font-size: 15px; }
.btn-action + .btn-action { margin-left: 6px; }
.edit   { background: #fff4e0; color: #f5a623; }
.delete { background: #ffeaea; color: #ef4444; }
.btn-action:hover { background: #1D3461 !important; color: #ffffff !important; }

/* BADGES */
.badge-custom { background: #EAF6FF; color: #1ea8d4; padding: 5px 14px; border-radius: 50px; font-family: 'Inter', sans-serif; font-weight: 700; font-size: 11px; display: inline-block; text-transform: capitalize; }
.badge-keluhan  { background: #ffeaea; color: #ef4444; }
.badge-reservasi{ background: #fff4e0; color: #f5a623; }

/* SELECT STATUS */
.select-status { font-family: 'Inter', sans-serif; font-size: 12px; font-weight: 600; border: 1.5px solid #e0e0e0; border-radius: 8px; padding: 5px 10px; color: #1D3461; background: #f8fbfd; cursor: pointer; outline: none; }
.select-status:focus { border-color: #1ea8d4; }

/* REVIEW KOMENTAR */
.review-komentar { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-size: 13px; }

/* MODAL */
.modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.45); display: flex; align-items: center; justify-content: center; z-index: 9999; padding: 20px; }
.modal-box { background: #ffffff; border-radius: 20px; width: 100%; max-width: 480px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); overflow: hidden; }
.modal-box-lg { max-width: 640px; }
.modal-box-sm { max-width: 400px; }
.modal-box-header { display: flex; align-items: center; justify-content: space-between; padding: 20px 24px 0; }
.modal-box-title  { font-family: 'Montserrat', sans-serif; font-size: 18px; font-weight: 700; color: #1D3461; margin: 0; }
.modal-box-close  { background: transparent; border: none; font-size: 18px; color: #aaa; cursor: pointer; }
.modal-box-close:hover { color: #1D3461; }
.modal-box-body   { padding: 20px 24px; display: flex; flex-direction: column; gap: 12px; max-height: 70vh; overflow-y: auto; }
.modal-box-footer { padding: 0 24px 24px; display: flex; gap: 10px; }

.edit-label { font-family: 'Inter', sans-serif; font-size: 13px; font-weight: 600; color: #1D3461; display: block; margin-bottom: 6px; }
.edit-input { width: 100%; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #333; background: #f8fbfd; border: 1.5px solid #e0e0e0; border-radius: 10px; padding: 10px 14px; outline: none; resize: vertical; transition: border-color 0.25s, box-shadow 0.25s; appearance: none; }
.edit-input:focus { border-color: #1ea8d4; box-shadow: 0 0 0 3px rgba(30,168,212,0.12); background: #ffffff; }

.btn-edit-cancel { flex: 1; padding: 10px; background: transparent; color: #555; border: 1.5px solid #e0e0e0; border-radius: 10px; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.2s; }
.btn-edit-cancel:hover { background: #f8fbfd; }
.btn-edit-save { flex: 1; padding: 10px; background: #1ea8d4; color: #ffffff; border: none; border-radius: 10px; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.25s; display: flex; align-items: center; justify-content: center; }
.btn-edit-save:hover:not(:disabled) { background: #1D3461; }
.btn-edit-save:disabled { opacity: 0.7; cursor: not-allowed; }
.btn-delete-confirm { flex: 1; padding: 10px; background: #dc3545; color: #ffffff; border: none; border-radius: 10px; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.25s; display: flex; align-items: center; justify-content: center; }
.btn-delete-confirm:hover:not(:disabled) { background: #b02a37; }
.btn-delete-confirm:disabled { opacity: 0.7; cursor: not-allowed; }

@media (max-width: 991.98px) {
  #admin-main { margin-top: -40px; }
  .admin-card { padding: 20px; }
  .stat-number { font-size: 22px; }
}
@media (max-width: 767.98px) {
  .admin-tabs .nav-link { padding: 8px 14px; font-size: 13px; }
  .table-custom thead { display: none; }
  .table-custom tbody td { display: block; border: none !important; background: #f8fbfd; padding: 6px 16px; }
  .table-custom tbody tr td:first-child { border-radius: 12px 12px 0 0 !important; padding-top: 14px; border: 1px solid #eef2f7 !important; border-bottom: none !important; }
  .table-custom tbody tr td:last-child  { border-radius: 0 0 12px 12px !important; padding-bottom: 14px; border: 1px solid #eef2f7 !important; border-top: none !important; }
}
</style>