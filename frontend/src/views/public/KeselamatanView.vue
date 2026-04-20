<template>
  <PublicLayout>

    <!-- HERO -->
    <section id="keselamatan-hero">
      <div class="container">
        <div class="keselamatan-hero-content">
          <span class="section-label">Keselamatan</span>
          <h1 class="keselamatan-hero-title">Keselamatan Anda<br>Prioritas Kami</h1>
          <p class="keselamatan-hero-desc">Kami berkomitmen memberikan lingkungan bermain yang aman dan nyaman untuk semua pengunjung</p>
        </div>
      </div>
      <div class="keselamatan-hero-wave">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0,0 C480,120 960,0 1440,80 L1440,120 L0,120 Z" fill="#ffffff"/>
        </svg>
      </div>
    </section>

    <!-- STANDAR -->
    <section id="standar">
      <div class="container">
        <div class="text-center mb-5">
          <span class="section-label">Standar Kami</span>
          <h2 class="section-title">Standar Keselamatan</h2>
          <p class="section-desc">Prosedur keselamatan ketat diterapkan di setiap wahana</p>
        </div>
        <div class="row g-4">
          <div class="col-lg-4 col-md-6" v-for="s in standarList" :key="s.title">
            <div class="standar-card">
              <div class="standar-icon" :class="s.iconClass"><i class="bi" :class="s.icon"></i></div>
              <h5 class="standar-title">{{ s.title }}</h5>
              <p class="standar-desc">{{ s.desc }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ATURAN -->
    <section id="aturan">
      <div class="container">
        <div class="text-center mb-5">
          <span class="section-label">Peraturan</span>
          <h2 class="section-title">Aturan Pengunjung</h2>
        </div>
        <div class="row g-4 mb-4">
          <div class="col-md-6">
            <div class="aturan-group">
              <div class="aturan-group-header aturan-wajib">
                <i class="bi bi-check-circle-fill"></i>
                <h5 class="aturan-group-title">Wajib Dilakukan</h5>
              </div>
              <ul class="aturan-list">
                <li v-for="a in aturanWajib" :key="a">
                  <span class="aturan-icon aturan-icon-green"><i class="bi bi-check"></i></span>
                  <span>{{ a }}</span>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-6">
            <div class="aturan-group">
              <div class="aturan-group-header aturan-larangan">
                <i class="bi bi-x-circle-fill"></i>
                <h5 class="aturan-group-title">Dilarang Keras</h5>
              </div>
              <ul class="aturan-list">
                <li v-for="a in aturanLarangan" :key="a">
                  <span class="aturan-icon aturan-icon-red"><i class="bi bi-x"></i></span>
                  <span>{{ a }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Ketentuan -->
        <div class="ketentuan-wrap">
          <h5 class="ketentuan-title mb-4"><i class="bi bi-info-circle-fill me-2"></i>Ketentuan Khusus Wahana</h5>
          <div class="row g-3">
            <div class="col-md-3 col-6" v-for="k in ketentuanList" :key="k.label">
              <div class="ketentuan-item">
                <span class="ketentuan-label">{{ k.label }}</span>
                <span class="ketentuan-val">{{ k.val }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- DARURAT -->
    <section id="darurat">
      <div class="container">
        <div class="text-center mb-5">
          <span class="section-label" style="color:#f5a623;">Prosedur Darurat</span>
          <h2 class="section-title" style="color:#ffffff;">Apa Yang Harus Dilakukan</h2>
        </div>
        <div class="row g-4 mb-4">
          <div class="col-lg-4 col-md-6" v-for="(d, i) in daruratList" :key="d.title">
            <div class="darurat-card">
              <div class="darurat-number">0{{ i + 1 }}</div>
              <h5 class="darurat-title">{{ d.title }}</h5>
              <p class="darurat-desc">{{ d.desc }}</p>
              <ul class="darurat-list">
                <li v-for="item in d.items" :key="item">
                  <i class="bi bi-chevron-right"></i><span>{{ item }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="darurat-banner">
          <i class="bi bi-telephone-fill darurat-banner-icon"></i>
          <div>
            <h5 class="darurat-banner-title">Hubungi Petugas Segera</h5>
            <p class="darurat-banner-text">Dalam keadaan darurat, segera hubungi petugas lifeguard atau security kami. Pos keamanan tersedia di setiap area wahana. Nomor darurat: <strong>+62 541 123 456</strong></p>
          </div>
        </div>
      </div>
    </section>

  </PublicLayout>
</template>

<script setup>
import PublicLayout from '@/components/layout/PublicLayout.vue'

const standarList = [
  { icon: 'bi-shield-fill-check', iconClass: 'standar-icon-blue',   title: 'Lifeguard Bersertifikat', desc: 'Setiap wahana dijaga oleh lifeguard bersertifikat nasional yang siap membantu 24 jam selama operasional.' },
  { icon: 'bi-wrench-adjustable', iconClass: 'standar-icon-green',  title: 'Perawatan Rutin',         desc: 'Seluruh wahana dan fasilitas diperiksa dan dirawat secara berkala oleh tim teknis berpengalaman.' },
  { icon: 'bi-droplet-fill',      iconClass: 'standar-icon-orange', title: 'Kualitas Air Terjaga',    desc: 'Air kolam diuji secara rutin untuk memastikan kebersihan dan keamanan bagi semua pengunjung.' },
]

const aturanWajib = [
  'Wajib mandi sebelum masuk kolam',
  'Gunakan pakaian renang yang sesuai',
  'Ikuti arahan petugas di setiap wahana',
  'Anak di bawah 12 tahun wajib didampingi orang tua',
  'Gunakan pelampung jika tidak bisa berenang',
  'Simpan barang berharga di loker yang tersedia',
]

const aturanLarangan = [
  'Dilarang berlari di area kolam',
  'Dilarang membawa makanan ke dalam kolam',
  'Dilarang melompat di area yang tidak ditentukan',
  'Dilarang menggunakan wahana saat sakit atau kondisi tidak fit',
  'Dilarang membawa minuman beralkohol',
  'Dilarang merokok di area bermain',
]

const ketentuanList = [
  { label: 'Tinggi Minimum',   val: '120 cm untuk wahana dewasa' },
  { label: 'Usia Minimum',     val: '3 tahun untuk area anak' },
  { label: 'Ibu Hamil',        val: 'Tidak diperbolehkan menggunakan wahana' },
  { label: 'Kondisi Kesehatan',val: 'Jantung & epilepsi tidak diperbolehkan' },
]

const daruratList = [
  {
    title: 'Jika Terjadi Kecelakaan', desc: 'Tetap tenang dan segera laporkan ke petugas.',
    items: ['Jangan memindahkan korban', 'Hubungi lifeguard terdekat', 'Tunggu pertolongan pertama dari petugas'],
  },
  {
    title: 'Jika Cuaca Buruk', desc: 'Kami akan menginformasikan penutupan wahana.',
    items: ['Ikuti arahan evakuasi petugas', 'Menuju area shelter yang telah disediakan', 'Tunggu informasi resmi dari manajemen'],
  },
  {
    title: 'Jika Kehilangan Barang', desc: 'Segera laporkan ke pos keamanan kami.',
    items: ['Datangi pos security terdekat', 'Isi formulir kehilangan', 'Tim kami akan membantu pencarian'],
  },
]
</script>

<style scoped>
#keselamatan-hero {
  background: linear-gradient(135deg, #0a3d5c 0%, #1ea8d4 55%, #7dd8f0 100%);
  min-height: 60vh; display: flex; align-items: center;
  position: relative; overflow: hidden; padding: 0;
}
.keselamatan-hero-content { padding-top: 120px; padding-bottom: 120px; text-align: center; }
.keselamatan-hero-title { font-family: 'Montserrat', sans-serif; font-size: clamp(32px, 5vw, 56px); font-weight: 800; color: #ffffff; line-height: 1.15; margin-bottom: 16px; }
.keselamatan-hero-desc  { font-family: 'Open Sans', sans-serif; font-size: 18px; color: rgba(255,255,255,0.85); margin: 0 auto; max-width: 560px; }
.keselamatan-hero-wave  { position: absolute; bottom: 0; left: 0; width: 100%; line-height: 0; }
.keselamatan-hero-wave svg { width: 100%; height: 100px; display: block; }

#standar { background-color: #ffffff; padding: 80px 0; }
.standar-card { background: #ffffff; border-radius: 16px; padding: 32px 28px; height: 100%; box-shadow: 0 4px 20px rgba(0,0,0,0.07); border: 1.5px solid #f0f0f0; transition: transform 0.25s ease, box-shadow 0.25s ease; }
.standar-card:hover { transform: translateY(-6px); box-shadow: 0 12px 32px rgba(0,0,0,0.12); }
.standar-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 26px; margin-bottom: 20px; }
.standar-icon-blue   { background-color: #EAF6FF; color: #1ea8d4; }
.standar-icon-green  { background-color: #e8f5e9; color: #28a745; }
.standar-icon-orange { background-color: #fff3e0; color: #f5a623; }
.standar-title { font-family: 'Montserrat', sans-serif; font-size: 18px; font-weight: 700; color: #1D3461; margin-bottom: 12px; }
.standar-desc  { font-family: 'Open Sans', sans-serif; font-size: 14px; color: #555; line-height: 1.7; margin: 0; }

#aturan { background-color: #f8fbfd; padding: 80px 0; }
.aturan-group { background: #ffffff; border-radius: 20px; overflow: hidden; height: 100%; box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
.aturan-group-header { display: flex; align-items: center; gap: 12px; padding: 20px 28px; font-size: 20px; }
.aturan-wajib    { background-color: #e8f5e9; color: #28a745; }
.aturan-larangan { background-color: #fdecea; color: #dc3545; }
.aturan-group-title { font-family: 'Montserrat', sans-serif; font-size: 18px; font-weight: 700; margin: 0; }
.aturan-wajib    .aturan-group-title { color: #1a5c28; }
.aturan-larangan .aturan-group-title { color: #8b1a1a; }
.aturan-list { list-style: none; padding: 20px 28px; margin: 0; display: flex; flex-direction: column; gap: 16px; }
.aturan-list li { display: flex; align-items: flex-start; gap: 12px; }
.aturan-icon { width: 26px; height: 26px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0; margin-top: 1px; }
.aturan-icon-green { background-color: #28a745; color: #ffffff; }
.aturan-icon-red   { background-color: #dc3545; color: #ffffff; }
.aturan-list li span:last-child { font-family: 'Open Sans', sans-serif; font-size: 14px; color: #444; line-height: 1.6; }

.ketentuan-wrap  { background: #1D3461; border-radius: 16px; padding: 28px 32px; }
.ketentuan-title { font-family: 'Montserrat', sans-serif; font-size: 18px; font-weight: 700; color: #ffffff; margin-bottom: 0; display: flex; align-items: center; }
.ketentuan-item  { background: rgba(255,255,255,0.08); border-radius: 12px; padding: 16px 20px; display: flex; flex-direction: column; gap: 6px; height: 100%; }
.ketentuan-label { font-family: 'Montserrat', sans-serif; font-size: 13px; font-weight: 700; color: #1ea8d4; }
.ketentuan-val   { font-family: 'Open Sans', sans-serif; font-size: 13px; color: rgba(255,255,255,0.8); line-height: 1.5; }

#darurat { background-color: #1D3461; padding: 80px 0; }
.darurat-card { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); border-radius: 16px; padding: 32px 28px; height: 100%; transition: background 0.25s ease, transform 0.25s ease; }
.darurat-card:hover { background: rgba(255,255,255,0.12); transform: translateY(-4px); }
.darurat-number { font-family: 'Montserrat', sans-serif; font-size: 48px; font-weight: 800; color: #f5a623; opacity: 0.5; line-height: 1; margin-bottom: 16px; }
.darurat-title  { font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: 700; color: #ffffff; margin-bottom: 12px; }
.darurat-desc   { font-family: 'Open Sans', sans-serif; font-size: 14px; color: rgba(255,255,255,0.75); line-height: 1.7; margin-bottom: 12px; }
.darurat-list   { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px; }
.darurat-list li{ font-family: 'Open Sans', sans-serif; font-size: 14px; color: rgba(255,255,255,0.85); display: flex; align-items: center; gap: 10px; }
.darurat-list li i { color: #1ea8d4; font-size: 14px; }
.darurat-banner { background: #dc3545; border-radius: 16px; padding: 28px 32px; display: flex; align-items: flex-start; gap: 20px; }
.darurat-banner-icon { font-size: 36px; color: #ffffff; flex-shrink: 0; margin-top: 2px; }
.darurat-banner-title { font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: 700; color: #ffffff; margin-bottom: 8px; }
.darurat-banner-text  { font-family: 'Open Sans', sans-serif; font-size: 15px; color: rgba(255,255,255,0.9); line-height: 1.7; margin: 0; }
</style>