<template>
  <PublicLayout>

    <!-- HERO -->
    <section id="tentang-hero">
      <div class="container">
        <div class="tentang-hero-content">
          <span class="section-label">Tentang Kami</span>
          <h1 class="tentang-hero-title">Mengenal Lebih Dekat<br>Bumi Sempaja</h1>
          <p class="tentang-hero-desc">Waterpark terbaik di Samarinda yang hadir untuk memberikan kesenangan bagi seluruh keluarga</p>
        </div>
      </div>
      <div class="tentang-hero-wave">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0,0 C480,120 960,0 1440,80 L1440,120 L0,120 Z" fill="#ffffff"/>
        </svg>
      </div>
    </section>

    <!-- BRAND PURPOSE -->
    <section id="brand-purpose">
      <div class="container">
        <div class="row align-items-center g-5">
          <div class="col-lg-7">
            <span class="section-label">Tentang Kami</span>
            <h2 class="section-title">Kami Hadir untuk Kebahagiaan Keluarga</h2>
            <p class="tentang-body">
              Bumi Sempaja Waterpark adalah destinasi wisata air terkemuka di Kota Samarinda, Kalimantan Timur.
              Berdiri sejak 2010, kami telah melayani ratusan ribu pengunjung dari berbagai penjuru Kalimantan
              dengan menyediakan wahana air berkualitas, fasilitas lengkap, dan layanan prima.
            </p>
            <p class="tentang-body">
              Berlokasi strategis di kawasan Sempaja, kami hadir dengan misi tunggal: menciptakan kenangan
              indah bagi setiap keluarga yang mengunjungi kami. Dengan lahan seluas 5 hektar dan lebih dari
              15 wahana unggulan, Bumi Sempaja Waterpark siap menjadi tujuan liburan utama Anda.
            </p>
            <div class="purpose-statement">
              <i class="bi bi-quote purpose-icon"></i>
              <p class="purpose-text">
                "Kami percaya bahwa setiap keluarga berhak mendapatkan momen kebahagiaan yang tak terlupakan,
                dan kami hadir untuk mewujudkan itu setiap harinya."
              </p>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="row g-3">
              <div class="col-6" v-for="stat in statList" :key="stat.number">
                <div class="stat-box">
                  <div class="stat-box-number">
                    {{ stat.number }}<span class="stat-box-plus">{{ stat.plus }}</span>
                  </div>
                  <p class="stat-box-label">{{ stat.label }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- VISI MISI -->
    <section id="visi-misi">
      <div class="container">
        <div class="text-center mb-5">
          <span class="section-label">Arah Kami</span>
          <h2 class="section-title">Visi & Misi</h2>
        </div>
        <div class="row g-4">
          <div class="col-md-6">
            <div class="vm-card vm-visi">
              <div class="vm-icon"><i class="bi bi-eye-fill"></i></div>
              <h3 class="vm-title">Visi</h3>
              <p class="vm-desc">Menjadi destinasi wisata air terdepan di Kalimantan Timur yang mengutamakan keselamatan, kenyamanan, dan kebahagiaan pengunjung.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="vm-card vm-misi">
              <div class="vm-icon"><i class="bi bi-bullseye"></i></div>
              <h3 class="vm-title">Misi</h3>
              <ul class="vm-list">
                <li>Menyediakan wahana berkualitas tinggi yang aman untuk semua usia</li>
                <li>Memberikan pelayanan prima dengan senyum dan ketulusan hati</li>
                <li>Menjaga kebersihan dan kelestarian lingkungan sekitar</li>
                <li>Terus berinovasi dalam menghadirkan wahana dan fasilitas baru</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CORE VALUES -->
    <section id="core-values">
      <div class="container">
        <div class="text-center mb-5">
          <span class="section-label" style="color:#1D3461;">Nilai Kami</span>
          <h2 class="section-title" style="color:#1D3461;">Nilai-Nilai Inti</h2>
        </div>
        <div class="row g-4 justify-content-center">
          <div class="col-lg-3 col-md-6" v-for="nilai in nilaiList" :key="nilai.title">
            <div class="nilai-card">
              <div class="nilai-icon">{{ nilai.emoji }}</div>
              <h4 class="nilai-title">{{ nilai.title }}</h4>
              <p class="nilai-desc">{{ nilai.desc }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

  </PublicLayout>
</template>

<script setup>
import PublicLayout from '@/components/layout/PublicLayout.vue'

const statList = [
  { number: '14',  plus: '+', label: 'Tahun Pengalaman' },
  { number: '50K', plus: '+', label: 'Pengunjung / Tahun' },
  { number: '15',  plus: '+', label: 'Wahana Unggulan' },
  { number: '4.8', plus: '★', label: 'Rating Kepuasan' },
]

const nilaiList = [
  { emoji: '🛡️', title: 'AMAN',    desc: 'Keselamatan pengunjung adalah yang utama dalam setiap aspek operasional kami.' },
  { emoji: '✨', title: 'BERSIH',  desc: 'Kami menjaga kebersihan area dan kualitas air agar selalu memenuhi standar kesehatan.' },
  { emoji: '😊', title: 'RAMAH',   desc: 'Setiap pengunjung diperlakukan seperti keluarga dengan pelayanan yang hangat dan tulus.' },
  { emoji: '🚀', title: 'INOVATIF',desc: 'Kami terus berinovasi menghadirkan wahana dan pengalaman baru yang menyenangkan.' },
]
</script>

<style scoped>
#tentang-hero {
  background: linear-gradient(135deg, #0a3d5c 0%, #1ea8d4 55%, #7dd8f0 100%);
  min-height: 60vh; display: flex; align-items: center;
  position: relative; overflow: hidden; padding: 0;
}
.tentang-hero-content { padding-top: 120px; padding-bottom: 120px; text-align: center; }
.tentang-hero-title { font-family: 'Montserrat', sans-serif; font-size: clamp(32px, 5vw, 56px); font-weight: 800; color: #ffffff; line-height: 1.15; margin-bottom: 16px; }
.tentang-hero-desc  { font-family: 'Open Sans', sans-serif; font-size: 18px; color: rgba(255,255,255,0.85); margin: 0 auto; max-width: 560px; }
.tentang-hero-wave  { position: absolute; bottom: 0; left: 0; width: 100%; line-height: 0; }
.tentang-hero-wave svg { width: 100%; height: 100px; display: block; }

#brand-purpose { background-color: #ffffff; padding: 80px 0; }
.tentang-body { font-family: 'Open Sans', sans-serif; font-size: 16px; color: #444; line-height: 1.8; margin-bottom: 24px; }
.purpose-statement { background-color: #EAF6FF; border-left: 4px solid #1ea8d4; border-radius: 0 12px 12px 0; padding: 20px 24px; display: flex; gap: 16px; align-items: flex-start; }
.purpose-icon { font-size: 22px; color: #1ea8d4; flex-shrink: 0; margin-top: 2px; }
.purpose-text { font-family: 'Open Sans', sans-serif; font-size: 15px; font-style: italic; color: #1D3461; line-height: 1.7; margin: 0; }
.stat-box { background: #ffffff; border: 1.5px solid #e0e0e0; border-radius: 16px; padding: 24px 20px; display: flex; flex-direction: column; align-items: center; text-align: center; transition: transform 0.25s ease, box-shadow 0.25s ease; }
.stat-box:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
.stat-box-number { font-family: 'Montserrat', sans-serif; font-size: 36px; font-weight: 800; color: #1D3461; line-height: 1; }
.stat-box-plus   { color: #f5a623; font-size: 28px; }
.stat-box-label  { font-family: 'Open Sans', sans-serif; font-size: 13px; color: #888; margin-top: 8px; margin-bottom: 0; }

#visi-misi { background-color: #f8fbfd; padding: 80px 0; }
.vm-card { background: #ffffff; border-radius: 20px; padding: 40px 36px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.25s ease; height: 100%; }
.vm-card:hover { transform: translateY(-6px); box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
.vm-icon { width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 28px; margin-bottom: 24px; }
.vm-visi .vm-icon { background-color: #EAF6FF; color: #1ea8d4; }
.vm-misi .vm-icon { background-color: #fff3e0; color: #f5a623; }
.vm-title { font-family: 'Montserrat', sans-serif; font-size: 26px; font-weight: 700; color: #1D3461; margin-bottom: 20px; }
.vm-desc  { font-family: 'Open Sans', sans-serif; font-size: 16px; font-style: italic; color: #444; line-height: 1.8; margin: 0; }
.vm-list  { font-family: 'Open Sans', sans-serif; font-size: 15px; color: #444; line-height: 1.8; padding-left: 20px; margin: 0; }
.vm-list li { margin-bottom: 12px; }

#core-values { background-color: #f5a623; padding: 80px 0; }
.nilai-card { background: #ffffff; border-radius: 16px; padding: 32px 24px; text-align: center; height: 100%; box-shadow: 0 4px 20px rgba(0,0,0,0.07); transition: transform 0.25s ease, box-shadow 0.25s ease; }
.nilai-card:hover { transform: translateY(-6px); box-shadow: 0 12px 32px rgba(0,0,0,0.12); }
.nilai-icon  { font-size: 48px; margin-bottom: 16px; line-height: 1; }
.nilai-title { font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: 700; color: #1D3461; margin-bottom: 12px; letter-spacing: 1px; }
.nilai-desc  { font-family: 'Open Sans', sans-serif; font-size: 14px; color: #555; line-height: 1.7; margin: 0; }
</style>