<template>
  <PublicLayout>

    <!-- HERO -->
    <section id="hero">
      <div class="container">
        <div class="hero-content">
          <span class="hero-label">Selamat Datang di</span>
          <h1 class="hero-title">Bumi Sempaja<br><span class="hero-title-accent">Waterpark</span></h1>
          <p class="hero-desc">Nikmati wahana air terbaik bersama keluarga tercinta di jantung Kota Samarinda</p>
          <div class="hero-buttons">
            <RouterLink to="/harga-tiket" class="btn-hero-primary">
              <i class="bi bi-ticket-perforated-fill me-2"></i>Beli Tiket Sekarang
            </RouterLink>
            <RouterLink to="/wahana" class="btn-hero-secondary">
              <i class="bi bi-water me-2"></i>Lihat Wahana
            </RouterLink>
          </div>
          <div class="hero-stats">
            <div class="hero-stat">
              <span class="hero-stat-number">15+</span>
              <span class="hero-stat-label">Wahana Seru</span>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
              <span class="hero-stat-number">50K+</span>
              <span class="hero-stat-label">Pengunjung/Tahun</span>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
              <span class="hero-stat-number">4.8★</span>
              <span class="hero-stat-label">Rating Pengunjung</span>
            </div>
          </div>
        </div>
      </div>
      <div class="hero-wave">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0,120 L0,60 C200,20 400,90 600,50 C800,10 1000,70 1200,40 C1320,24 1400,50 1440,60 L1440,120 Z" fill="rgba(125,216,240,0.3)"/>
          <path d="M0,120 L0,85 C360,50 720,110 1080,80 C1260,65 1380,85 1440,80 L1440,120 Z" fill="#f8fbfd"/>
        </svg>
      </div>
    </section>

    <!-- FITUR -->
    <section id="fitur">
      <div class="container">
        <div class="row g-4 justify-content-center">
          <div class="col-lg-3 col-md-6" v-for="item in fiturList" :key="item.icon">
            <div class="fitur-card">
              <div class="fitur-icon" :style="{ backgroundColor: item.bg, color: item.color }">
                <i class="bi" :class="item.icon"></i>
              </div>
              <h5 class="fitur-title">{{ item.title }}</h5>
              <p class="fitur-desc">{{ item.desc }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- WAHANA UNGGULAN -->
    <section id="wahana-home">
      <div class="container">
        <div class="text-center mb-5">
          <span class="section-label">Wahana Kami</span>
          <h2 class="section-title">Wahana Unggulan</h2>
          <p class="section-desc">Pilihan wahana seru untuk semua usia</p>
        </div>

        <LoadingSpinner v-if="wahanaStore.loading" text="Memuat wahana..." />

        <div v-else class="row g-4">
          <div class="col-lg-4 col-md-6"
            v-for="wahana in wahanaStore.wahanaList.slice(0, 3)"
            :key="wahana.id">
            <div class="wahana-card-home">
              <div class="wahana-card-img-wrap">
                <img
                  :src="wahana.gambar || '/img/wahana-placeholder.jpg'"
                  :alt="wahana.nama"
                  class="wahana-card-img"
                >
                <span class="wahana-card-badge" :class="`badge-${wahana.kategori}`">
                  {{ wahana.kategori }}
                </span>
              </div>
              <div class="wahana-card-body">
                <h5 class="wahana-card-title">{{ wahana.nama }}</h5>
                <p class="wahana-card-desc">{{ wahana.deskripsi }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-5">
          <RouterLink to="/wahana" class="btn-lihat-semua">
            Lihat Semua Wahana <i class="bi bi-arrow-right ms-2"></i>
          </RouterLink>
        </div>
      </div>
    </section>

    <!-- HARGA TIKET -->
    <section id="tiket-home">
      <div class="container">
        <div class="text-center mb-5">
          <span class="section-label">Harga Tiket</span>
          <h2 class="section-title">Pilih Paket Terbaik</h2>
          <p class="section-desc">Harga terjangkau untuk pengalaman tak terlupakan</p>
        </div>

        <div class="row g-4 justify-content-center">
          <div class="col-lg-4 col-md-6" v-for="tiket in tiketHome" :key="tiket.label">
            <div class="tiket-home-card" :class="{ 'tiket-home-featured': tiket.featured }">
              <span v-if="tiket.featured" class="tiket-featured-badge">⭐ Paling Populer</span>
              <p class="tiket-home-label">{{ tiket.label }}</p>
              <h3 class="tiket-home-name">{{ tiket.name }}</h3>
              <p class="tiket-home-sub">{{ tiket.sub }}</p>
              <div class="tiket-home-harga">
                <span class="tiket-home-rp">Rp</span>
                <span class="tiket-home-nominal">{{ tiket.harga }}</span>
              </div>
              <p class="tiket-home-per">per orang</p>
              <hr class="tiket-home-divider">
              <ul class="tiket-home-benefit">
                <li v-for="b in tiket.benefit" :key="b">
                  <i class="bi bi-check-circle-fill text-success me-2"></i>{{ b }}
                </li>
              </ul>
              <RouterLink to="/harga-tiket" class="btn-tiket-home" :class="{ 'btn-tiket-featured': tiket.featured }">
                <i class="bi bi-whatsapp me-2"></i>Pesan via WhatsApp
              </RouterLink>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- REVIEW -->
    <section id="review-home">
      <div class="container">
        <div class="text-center mb-5">
          <span class="section-label">Testimoni</span>
          <h2 class="section-title">Kata Pengunjung Kami</h2>
        </div>
        <div class="row g-4">
          <div class="col-lg-4 col-md-6" v-for="r in reviewHome" :key="r.name">
            <div class="review-home-card">
              <div class="review-home-stars">
                <i class="bi bi-star-fill" v-for="s in r.rating" :key="s"></i>
              </div>
              <p class="review-home-text">"{{ r.text }}"</p>
              <div class="review-home-user">
                <div class="review-home-avatar">{{ r.name[0] }}</div>
                <div>
                  <span class="review-home-name">{{ r.name }}</span>
                  <span class="review-home-date">{{ r.date }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section id="cta-home">
      <div class="container text-center">
        <h2 class="cta-home-title">Siap Merasakan Keseruan?</h2>
        <p class="cta-home-desc">Dapatkan pengalaman bermain air terbaik bersama keluarga</p>
        <div class="cta-home-buttons">
          <RouterLink to="/harga-tiket" class="btn-cta-primary">
            <i class="bi bi-ticket-perforated-fill me-2"></i>Beli Tiket Sekarang
          </RouterLink>
          <RouterLink to="/kontak" class="btn-cta-secondary">
            <i class="bi bi-telephone-fill me-2"></i>Hubungi Kami
          </RouterLink>
        </div>
      </div>
    </section>

  </PublicLayout>
</template>

<script setup>
import { onMounted } from 'vue'
import { RouterLink } from 'vue-router'
import PublicLayout from '@/components/layout/PublicLayout.vue'
import LoadingSpinner from '@/components/common/LoadingSpinner.vue'
import { useWahanaStore } from '@/stores/wahana.js'

const wahanaStore = useWahanaStore()

onMounted(() => wahanaStore.fetchWahana())

const fiturList = [
  { icon: 'bi-water',            bg: '#EAF6FF', color: '#1ea8d4', title: 'Wahana Lengkap',     desc: 'Lebih dari 15 wahana air yang aman dan menyenangkan untuk semua usia' },
  { icon: 'bi-shield-check',     bg: '#e8f5e9', color: '#28a745', title: 'Keamanan Terjamin',  desc: 'Tim lifeguard berpengalaman siaga di setiap wahana selama operasional' },
  { icon: 'bi-geo-alt-fill',     bg: '#fff3e0', color: '#f5a623', title: 'Lokasi Strategis',   desc: 'Berada di jantung Kota Samarinda, mudah dijangkau dari berbagai penjuru' },
  { icon: 'bi-people-fill',      bg: '#fdecea', color: '#dc3545', title: 'Ramah Keluarga',     desc: 'Dirancang khusus untuk memberikan pengalaman terbaik bagi seluruh keluarga' },
]

const tiketHome = [
  {
    label: 'TIKET', name: 'Anak', sub: 'Usia di bawah 12 tahun', harga: '35.000', featured: false,
    benefit: ['Akses semua wahana anak', 'Gratis 1 loker kecil', 'Berlaku 1 hari kunjungan'],
  },
  {
    label: 'TIKET', name: 'Dewasa', sub: 'Usia 12 tahun ke atas', harga: '55.000', featured: true,
    benefit: ['Akses semua wahana', 'Gratis 1 loker standar', 'Berlaku 1 hari kunjungan', 'Diskon 10% di kantin'],
  },
  {
    label: 'PAKET', name: 'Keluarga', sub: 'Maks. 2 dewasa + 2 anak', harga: '150.000', featured: false,
    benefit: ['Akses semua wahana', '2 loker gratis', 'Berlaku 1 hari kunjungan', 'Foto kenangan gratis'],
  },
]

const reviewHome = [
  { name: 'Andi Pratama',  rating: 5, text: 'Kolam renang bersih, wahana lengkap. Anak-anak senang banget! Pasti balik lagi.',         date: '12 Apr 2025' },
  { name: 'Siti Rahma',    rating: 5, text: 'Tempat yang bagus untuk liburan keluarga. Petugasnya ramah dan responsif.',               date: '28 Mar 2025' },
  { name: 'Budi Santoso',  rating: 4, text: 'Seru banget! Hanya antrian agak panjang di hari libur tapi overall sangat memuaskan.',   date: '15 Mar 2025' },
]
</script>

<style scoped>
/* HERO */
#hero {
  background: linear-gradient(135deg, #0a3d5c 0%, #1ea8d4 55%, #7dd8f0 100%);
  min-height: 92vh;
  display: flex; align-items: center;
  position: relative; overflow: hidden;
  padding: 120px 0 0;
}

.hero-content { padding-bottom: 140px; }

.hero-label {
  font-family: 'Montserrat', sans-serif;
  font-size: 14px; font-weight: 700;
  color: rgba(255,255,255,0.8);
  letter-spacing: 2px; text-transform: uppercase;
  display: block; margin-bottom: 16px;
}

.hero-title {
  font-family: 'Montserrat', sans-serif;
  font-size: clamp(36px, 6vw, 72px);
  font-weight: 800; color: #ffffff;
  line-height: 1.1; margin-bottom: 20px;
}

.hero-title-accent { color: #f5a623; }

.hero-desc {
  font-family: 'Open Sans', sans-serif;
  font-size: 18px; color: rgba(255,255,255,0.85);
  max-width: 520px; line-height: 1.7; margin-bottom: 36px;
}

.hero-buttons { display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 48px; }

.btn-hero-primary {
  font-family: 'Inter', sans-serif; font-weight: 600; font-size: 15px;
  background-color: #f5a623; color: #ffffff;
  border-radius: 50px; padding: 14px 32px;
  text-decoration: none; display: flex; align-items: center;
  transition: all 0.25s ease;
}
.btn-hero-primary:hover { background-color: #d4891a; color: #ffffff; transform: translateY(-2px); }

.btn-hero-secondary {
  font-family: 'Inter', sans-serif; font-weight: 600; font-size: 15px;
  background-color: rgba(255,255,255,0.15); color: #ffffff;
  border: 1.5px solid rgba(255,255,255,0.4);
  border-radius: 50px; padding: 14px 32px;
  text-decoration: none; display: flex; align-items: center;
  transition: all 0.25s ease;
}
.btn-hero-secondary:hover { background-color: rgba(255,255,255,0.25); color: #ffffff; transform: translateY(-2px); }

.hero-stats { display: flex; align-items: center; gap: 32px; flex-wrap: wrap; }
.hero-stat  { display: flex; flex-direction: column; }
.hero-stat-number { font-family: 'Montserrat', sans-serif; font-size: 28px; font-weight: 800; color: #ffffff; line-height: 1; }
.hero-stat-label  { font-family: 'Open Sans', sans-serif; font-size: 13px; color: rgba(255,255,255,0.7); margin-top: 4px; }
.hero-stat-divider { width: 1px; height: 40px; background: rgba(255,255,255,0.3); }

.hero-wave { position: absolute; bottom: 0; left: 0; width: 100%; line-height: 0; }
.hero-wave svg { width: 100%; height: 120px; display: block; }

/* FITUR */
#fitur { background-color: #f8fbfd; padding: 80px 0; }
.fitur-card {
  background: #ffffff; border-radius: 20px;
  padding: 32px 24px; text-align: center; height: 100%;
  box-shadow: 0 4px 20px rgba(0,0,0,0.06);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.fitur-card:hover { transform: translateY(-6px); box-shadow: 0 12px 32px rgba(0,0,0,0.12); }
.fitur-icon { width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 26px; margin: 0 auto 20px; }
.fitur-title { font-family: 'Montserrat', sans-serif; font-size: 18px; font-weight: 700; color: #1D3461; margin-bottom: 10px; }
.fitur-desc  { font-family: 'Open Sans', sans-serif; font-size: 14px; color: #666; line-height: 1.7; margin: 0; }

/* WAHANA HOME */
#wahana-home { background-color: #ffffff; padding: 80px 0; }
.wahana-card-home { background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: transform 0.25s ease; height: 100%; }
.wahana-card-home:hover { transform: translateY(-6px); }
.wahana-card-img-wrap { position: relative; overflow: hidden; }
.wahana-card-img { width: 100%; height: 220px; object-fit: cover; display: block; transition: transform 0.35s ease; }
.wahana-card-home:hover .wahana-card-img { transform: scale(1.05); }
.wahana-card-badge { position: absolute; top: 14px; right: 14px; font-family: 'Inter', sans-serif; font-size: 12px; font-weight: 500; background-color: #1ea8d4; color: #ffffff; padding: 4px 14px; border-radius: 20px; text-transform: capitalize; }
.badge-dewasa  { background-color: #1D3461 !important; }
.badge-anak    { background-color: #28a745 !important; }
.badge-keluarga{ background-color: #f5a623 !important; }
.wahana-card-body  { padding: 24px; }
.wahana-card-title { font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: 700; color: #1D3461; margin-bottom: 10px; }
.wahana-card-desc  { font-family: 'Open Sans', sans-serif; font-size: 14px; color: #666; line-height: 1.7; margin: 0; }

.btn-lihat-semua {
  font-family: 'Inter', sans-serif; font-weight: 600; font-size: 15px;
  color: #1D3461; border: 2px solid #1D3461; border-radius: 50px;
  padding: 12px 32px; text-decoration: none;
  display: inline-flex; align-items: center;
  transition: all 0.25s ease;
}
.btn-lihat-semua:hover { background-color: #1D3461; color: #ffffff; }

/* TIKET HOME */
#tiket-home { background-color: #f8fbfd; padding: 80px 0; }

.tiket-home-card {
  background: #1D3461; border-radius: 20px;
  padding: 36px 32px; height: 100%;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  position: relative;
}
.tiket-home-card:hover { transform: translateY(-6px); box-shadow: 0 12px 32px rgba(0,0,0,0.15); }
.tiket-home-featured { background: #0a3d5c; border: 2.5px solid #1ea8d4; transform: scale(1.03); }
.tiket-home-featured:hover { transform: scale(1.03) translateY(-6px); }
.tiket-featured-badge { position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background: #f5a623; color: #fff; font-size: 12px; font-weight: 600; padding: 5px 20px; border-radius: 20px; white-space: nowrap; font-family: 'Inter', sans-serif; }
.tiket-home-label  { font-family: 'Montserrat', sans-serif; font-size: 13px; font-weight: 700; color: rgba(255,255,255,0.6); letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 4px; }
.tiket-home-name   { font-family: 'Montserrat', sans-serif; font-size: 32px; font-weight: 700; color: #ffffff; margin-bottom: 0; }
.tiket-home-sub    { font-family: 'Open Sans', sans-serif; font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 20px; }
.tiket-home-harga  { display: flex; align-items: flex-end; gap: 4px; line-height: 1; }
.tiket-home-rp     { font-family: 'Montserrat', sans-serif; font-size: 22px; font-weight: 800; color: #f5a623; }
.tiket-home-nominal{ font-family: 'Montserrat', sans-serif; font-size: 48px; font-weight: 800; color: #f5a623; }
.tiket-home-per    { font-family: 'Open Sans', sans-serif; font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 0; }
.tiket-home-divider{ border-top: 1px solid rgba(255,255,255,0.15); margin: 20px 0; }
.tiket-home-benefit{ list-style: none; padding: 0; margin: 0 0 24px; display: flex; flex-direction: column; gap: 10px; }
.tiket-home-benefit li { font-family: 'Open Sans', sans-serif; font-size: 14px; color: #ffffff; display: flex; align-items: center; }
.btn-tiket-home {
  display: flex; align-items: center; justify-content: center;
  font-family: 'Inter', sans-serif; font-weight: 500; font-size: 14px;
  color: #29ABE2; border: 1.5px solid #29ABE2; border-radius: 10px;
  padding: 12px; text-decoration: none; transition: all 0.25s ease;
}
.btn-tiket-home:hover { background-color: #25D366; border-color: #25D366; color: #ffffff; }
.btn-tiket-featured { color: #f5a623; border-color: #f5a623; }

/* REVIEW HOME */
#review-home { background-color: #ffffff; padding: 80px 0; }
.review-home-card { background: #f8fbfd; border-radius: 16px; border: 1.5px solid #eef2f7; padding: 28px; height: 100%; transition: border-color 0.25s; }
.review-home-card:hover { border-color: #1ea8d4; }
.review-home-stars { color: #f5a623; font-size: 16px; margin-bottom: 16px; }
.review-home-text  { font-family: 'Open Sans', sans-serif; font-size: 15px; color: #444; line-height: 1.8; font-style: italic; margin-bottom: 20px; }
.review-home-user  { display: flex; align-items: center; gap: 12px; }
.review-home-avatar{ width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #1ea8d4, #0a3d5c); color: #fff; font-family: 'Montserrat', sans-serif; font-size: 14px; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.review-home-name  { font-family: 'Montserrat', sans-serif; font-size: 14px; font-weight: 700; color: #1D3461; display: block; }
.review-home-date  { font-family: 'DM Sans', sans-serif; font-size: 12px; color: #aaa; display: block; }

/* CTA */
#cta-home { background: linear-gradient(135deg, #0a3d5c 0%, #1ea8d4 100%); padding: 80px 0; }
.cta-home-title { font-family: 'Montserrat', sans-serif; font-size: clamp(28px, 4vw, 48px); font-weight: 800; color: #ffffff; margin-bottom: 16px; }
.cta-home-desc  { font-family: 'Open Sans', sans-serif; font-size: 18px; color: rgba(255,255,255,0.8); margin-bottom: 40px; }
.cta-home-buttons { display: flex; justify-content: center; gap: 16px; flex-wrap: wrap; }
.btn-cta-primary {
  font-family: 'Inter', sans-serif; font-weight: 600; font-size: 15px;
  background-color: #f5a623; color: #ffffff;
  border-radius: 50px; padding: 14px 32px; text-decoration: none;
  display: inline-flex; align-items: center; transition: all 0.25s ease;
}
.btn-cta-primary:hover { background-color: #d4891a; color: #ffffff; transform: translateY(-2px); }
.btn-cta-secondary {
  font-family: 'Inter', sans-serif; font-weight: 600; font-size: 15px;
  background-color: rgba(255,255,255,0.15); color: #ffffff;
  border: 1.5px solid rgba(255,255,255,0.4);
  border-radius: 50px; padding: 14px 32px; text-decoration: none;
  display: inline-flex; align-items: center; transition: all 0.25s ease;
}
.btn-cta-secondary:hover { background-color: rgba(255,255,255,0.25); color: #ffffff; transform: translateY(-2px); }

@media (max-width: 991.98px) {
  #hero { min-height: 70vh; padding: 100px 0 0; }
  .hero-content { padding-bottom: 100px; }
  .hero-stats { gap: 20px; }
}
@media (max-width: 767.98px) {
  .hero-buttons { flex-direction: column; }
  .btn-hero-primary, .btn-hero-secondary { justify-content: center; }
  .tiket-home-featured { transform: scale(1); }
}
</style>