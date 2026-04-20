<template>
  <PublicLayout>

    <!-- HERO -->
    <section id="tiket-hero">
      <div class="container">
        <div class="tiket-hero-content">
          <span class="section-label">Harga Tiket</span>
          <h1 class="tiket-hero-title">Pilih Tiket<br>Sesuai Kebutuhan</h1>
          <p class="tiket-hero-desc">Harga terjangkau untuk pengalaman bermain air yang tak terlupakan bersama keluarga</p>
        </div>
      </div>
      <div class="tiket-hero-wave">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0,0 C480,120 960,0 1440,80 L1440,120 L0,120 Z" fill="#ffffff"/>
        </svg>
      </div>
    </section>

    <!-- TIKET LIST -->
    <section id="tiket-list">
      <div class="container">
        <div class="row g-4 justify-content-center align-items-stretch">
          <div class="col-lg-4 col-md-6" v-for="tiket in tiketList" :key="tiket.name">
            <div class="tiket-card-page" :class="{ 'tiket-featured': tiket.featured }">
              <span v-if="tiket.featured" class="tiket-featured-badge">⭐ Paling Populer</span>
              <div class="tiket-page-body">
                <p class="tiket-page-label">{{ tiket.label }}</p>
                <h3 class="tiket-page-name">{{ tiket.name }}</h3>
                <p class="tiket-page-sub">{{ tiket.sub }}</p>
                <div class="tiket-page-harga">
                  <span class="tiket-page-rp">Rp</span>
                  <span class="tiket-page-nominal">{{ tiket.harga }}</span>
                </div>
                <p class="tiket-page-per">per orang</p>
              </div>
              <hr class="tiket-page-divider">
              <ul class="tiket-page-benefit">
                <li v-for="b in tiket.benefit" :key="b">
                  <i class="bi bi-check-circle-fill text-success"></i>
                  <span>{{ b }}</span>
                </li>
              </ul>
              <a :href="tiket.wa" target="_blank" class="btn-tiket-page" :class="{ 'btn-tiket-featured': tiket.featured }">
                <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- INFO -->
    <section id="tiket-info">
      <div class="container">
        <h3 class="tiket-info-title text-center mb-5">Informasi Penting</h3>
        <div class="row g-4">
          <div class="col-lg-3 col-md-6" v-for="info in infoList" :key="info.title">
            <div class="info-card">
              <div class="info-icon"><i class="bi" :class="info.icon"></i></div>
              <div class="info-content">
                <p class="info-title">{{ info.title }}</p>
                <p class="info-desc">{{ info.desc }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section id="kontak-faq">
      <div class="container">
        <h3 class="text-center mb-5" style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1D3461;">Pertanyaan Umum</h3>
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div v-for="(faq, i) in faqList" :key="i" class="faq-item">
              <button class="faq-btn" :aria-expanded="faqOpen === i" @click="faqOpen = faqOpen === i ? null : i">
                {{ faq.q }}
                <i class="bi bi-chevron-down faq-icon"></i>
              </button>
              <Transition name="faq">
                <div v-if="faqOpen === i" class="faq-body">{{ faq.a }}</div>
              </Transition>
            </div>
          </div>
        </div>
      </div>
    </section>

  </PublicLayout>
</template>

<script setup>
import { ref } from 'vue'
import PublicLayout from '@/components/layout/PublicLayout.vue'

const faqOpen = ref(null)

const tiketList = [
  {
    label: 'TIKET', name: 'Anak', sub: 'Usia di bawah 12 tahun', harga: '35.000', featured: false,
    wa: 'https://wa.me/6285241234567?text=Halo, saya ingin pesan tiket anak',
    benefit: ['Akses semua wahana anak', 'Gratis 1 loker kecil', 'Berlaku 1 hari kunjungan', 'Pendampingan orang tua wajib'],
  },
  {
    label: 'TIKET', name: 'Dewasa', sub: 'Usia 12 tahun ke atas', harga: '55.000', featured: true,
    wa: 'https://wa.me/6285241234567?text=Halo, saya ingin pesan tiket dewasa',
    benefit: ['Akses semua wahana', 'Gratis 1 loker standar', 'Berlaku 1 hari kunjungan', 'Diskon 10% di kantin', 'Akses area VIP'],
  },
  {
    label: 'PAKET', name: 'Keluarga', sub: 'Maks. 2 dewasa + 2 anak', harga: '150.000', featured: false,
    wa: 'https://wa.me/6285241234567?text=Halo, saya ingin pesan paket keluarga',
    benefit: ['Akses semua wahana', '2 loker gratis', 'Berlaku 1 hari kunjungan', 'Foto kenangan gratis', 'Welcome drink'],
  },
]

const infoList = [
  { icon: 'bi-clock-fill',        title: 'Jam Operasional',    desc: 'Senin–Jumat: 08.00–17.00 WITA\nSabtu–Minggu: 07.00–18.00 WITA' },
  { icon: 'bi-calendar-check',    title: 'Reservasi',          desc: 'Reservasi dapat dilakukan melalui WhatsApp atau langsung di loket.' },
  { icon: 'bi-bag-check-fill',    title: 'Yang Boleh Dibawa',  desc: 'Baju ganti, handuk, sunscreen, makanan ringan, dan minuman pribadi.' },
  { icon: 'bi-x-circle-fill',     title: 'Yang Tidak Boleh',   desc: 'Makanan berat, minuman beralkohol, kamera profesional, dan hewan peliharaan.' },
]

const faqList = [
  { q: 'Apakah tiket bisa dibeli secara online?',       a: 'Saat ini pembelian tiket dapat dilakukan via WhatsApp atau langsung di loket pada hari kunjungan.' },
  { q: 'Apakah ada diskon untuk rombongan?',            a: 'Ya, kami menyediakan harga khusus untuk rombongan minimal 20 orang. Hubungi kami via WhatsApp untuk informasi lebih lanjut.' },
  { q: 'Apakah tiket bisa di-refund atau di-reschedule?', a: 'Tiket yang sudah dibeli tidak dapat di-refund, namun dapat di-reschedule maksimal H-1 kunjungan.' },
  { q: 'Apakah tersedia fasilitas loker dan ganti pakaian?', a: 'Ya, tersedia loker dan ruang ganti yang bersih dan aman. Loker gratis sudah termasuk dalam harga tiket.' },
  { q: 'Bagaimana jika cuaca hujan saat kunjungan?',    a: 'Operasional tetap berjalan saat hujan ringan. Jika hujan deras atau petir, wahana akan ditutup sementara demi keselamatan.' },
]
</script>

<style scoped>
#tiket-hero {
  background: linear-gradient(135deg, #0a3d5c 0%, #1ea8d4 55%, #7dd8f0 100%);
  min-height: 60vh; display: flex; align-items: center;
  position: relative; overflow: hidden; padding: 0;
}
.tiket-hero-content { padding-top: 120px; padding-bottom: 120px; text-align: center; }
.tiket-hero-title { font-family: 'Montserrat', sans-serif; font-size: clamp(32px, 5vw, 56px); font-weight: 800; color: #ffffff; line-height: 1.15; margin-bottom: 16px; }
.tiket-hero-desc  { font-family: 'Open Sans', sans-serif; font-size: 18px; color: rgba(255,255,255,0.85); margin: 0 auto; max-width: 560px; }
.tiket-hero-wave  { position: absolute; bottom: 0; left: 0; width: 100%; line-height: 0; }
.tiket-hero-wave svg { width: 100%; height: 100px; display: block; }

#tiket-list { background-color: #ffffff; padding: 60px 0; }

.tiket-card-page {
  background: #1D3461; border-radius: 20px;
  padding: 36px 32px; height: 100%;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  position: relative; display: flex; flex-direction: column;
}
.tiket-card-page:hover { transform: translateY(-6px); box-shadow: 0 12px 32px rgba(0,0,0,0.15); }
.tiket-featured { background: #0a3d5c; border: 2.5px solid #1ea8d4; transform: scale(1.03); }
.tiket-featured:hover { transform: scale(1.03) translateY(-6px); }
.tiket-featured-badge { position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background: #f5a623; color: #fff; font-family: 'Inter', sans-serif; font-size: 12px; font-weight: 600; padding: 5px 20px; border-radius: 20px; white-space: nowrap; }
.tiket-page-body { flex: 1; }
.tiket-page-label   { font-family: 'Montserrat', sans-serif; font-size: 13px; font-weight: 700; color: rgba(255,255,255,0.6); letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 4px; }
.tiket-page-name    { font-family: 'Montserrat', sans-serif; font-size: 36px; font-weight: 700; color: #ffffff; margin-bottom: 0; }
.tiket-page-sub     { font-family: 'Open Sans', sans-serif; font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 20px; }
.tiket-page-harga   { display: flex; align-items: flex-end; gap: 4px; line-height: 1; }
.tiket-page-rp      { font-family: 'Montserrat', sans-serif; font-size: 22px; font-weight: 800; color: #f5a623; }
.tiket-page-nominal { font-family: 'Montserrat', sans-serif; font-size: 48px; font-weight: 800; color: #f5a623; }
.tiket-page-per     { font-family: 'Open Sans', sans-serif; font-size: 13px; color: rgba(255,255,255,0.6); }
.tiket-page-divider { border-top: 1px solid rgba(255,255,255,0.15); margin: 20px 0; }
.tiket-page-benefit { list-style: none; padding: 0; margin: 0 0 24px; display: flex; flex-direction: column; gap: 10px; }
.tiket-page-benefit li { display: flex; align-items: center; gap: 10px; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #ffffff; }
.btn-tiket-page {
  display: flex; align-items: center; justify-content: center; gap: 6px;
  font-family: 'Inter', sans-serif; font-weight: 500; font-size: 14px;
  color: #29ABE2; border: 1.5px solid #29ABE2; border-radius: 10px;
  padding: 12px; text-decoration: none; transition: all 0.25s ease;
}
.btn-tiket-page:hover { background-color: #25D366; border-color: #25D366; color: #ffffff; }
.btn-tiket-featured   { color: #f5a623; border-color: #f5a623; }

#tiket-info { background-color: #f8fbfd; padding: 60px 0 80px; }
.tiket-info-title { font-family: 'Montserrat', sans-serif; font-size: 28px; font-weight: 700; color: #1D3461; }
.info-card { background: #ffffff; border-radius: 14px; padding: 24px; display: flex; align-items: flex-start; gap: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); height: 100%; transition: transform 0.25s ease; }
.info-card:hover { transform: translateY(-4px); }
.info-icon { width: 44px; height: 44px; background-color: #EAF6FF; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; color: #1ea8d4; flex-shrink: 0; }
.info-title { font-family: 'Montserrat', sans-serif; font-size: 15px; font-weight: 600; color: #1D3461; margin-bottom: 6px; }
.info-desc  { font-family: 'Open Sans', sans-serif; font-size: 13px; color: #666; line-height: 1.6; margin: 0; white-space: pre-line; }

#kontak-faq { background-color: #ffffff; padding: 80px 0; }
.faq-item { border-bottom: 1px solid #e8e8e8; }
.faq-item:first-child { border-top: 1px solid #e8e8e8; }
.faq-btn { width: 100%; font-family: 'Montserrat', sans-serif; font-size: 16px; font-weight: 600; color: #1D3461; background: transparent; border: none; padding: 20px 0; display: flex; align-items: center; justify-content: space-between; gap: 16px; cursor: pointer; text-align: left; transition: color 0.2s; }
.faq-btn:hover { color: #1ea8d4; }
.faq-icon { font-size: 16px; flex-shrink: 0; transition: transform 0.25s ease; }
.faq-btn[aria-expanded="true"] .faq-icon { transform: rotate(180deg); }
.faq-body { font-family: 'Open Sans', sans-serif; font-size: 15px; color: #555; line-height: 1.8; padding: 0 0 20px; }
.faq-enter-active, .faq-leave-active { transition: all 0.25s ease; overflow: hidden; }
.faq-enter-from, .faq-leave-to { opacity: 0; max-height: 0; }
.faq-enter-to, .faq-leave-from { opacity: 1; max-height: 200px; }
</style>