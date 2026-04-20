<template>
  <PublicLayout>

    <!-- HERO -->
    <section id="wahana-hero">
      <div class="container">
        <div class="wahana-hero-content">
          <span class="section-label">Eksplorasi</span>
          <h1 class="wahana-hero-title">Wahana Seru<br>Untuk Semua</h1>
          <p class="wahana-hero-desc">Temukan berbagai wahana air yang dirancang untuk kesenangan seluruh keluarga</p>
        </div>
      </div>
      <div class="wahana-hero-wave">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0,0 C480,120 960,0 1440,80 L1440,120 L0,120 Z" fill="#ffffff"/>
        </svg>
      </div>
    </section>

    <!-- FILTER -->
    <section id="wahana-filter">
      <div class="container">
        <div class="filter-wrap">
          <button
            v-for="f in filterList" :key="f.value"
            class="filter-btn"
            :class="{ active: wahanaStore.filterAktif === f.value }"
            @click="wahanaStore.setFilter(f.value)"
          >
            <i class="bi me-1" :class="f.icon"></i>{{ f.label }}
          </button>
        </div>
      </div>
    </section>

    <!-- LIST -->
    <section id="wahana-list">
      <div class="container">

        <LoadingSpinner v-if="wahanaStore.loading" text="Memuat wahana..." />

        <div v-else-if="wahanaStore.wahanaFiltered.length === 0" class="wahana-empty">
          <i class="bi bi-water"></i>
          <p>Belum ada wahana untuk kategori ini.</p>
        </div>

        <div v-else class="row g-4">
          <div
            class="col-lg-4 col-md-6"
            v-for="wahana in wahanaStore.wahanaFiltered"
            :key="wahana.id"
          >
            <div class="wahana-card-page">
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
                <div class="wahana-card-info">
                  <div class="wahana-info-item">
                    <i class="bi bi-people-fill"></i>
                    <span>{{ wahana.kapasitas || '-' }} orang/sesi</span>
                  </div>
                  <div class="wahana-info-item">
                    <i class="bi bi-rulers"></i>
                    <span>Min. tinggi {{ wahana.min_tinggi || '-' }} cm</span>
                  </div>
                  <div class="wahana-info-item">
                    <i class="bi bi-clock-fill"></i>
                    <span>Durasi ± {{ wahana.durasi || '-' }} menit</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- CTA -->
    <section id="cta-wahana">
      <div class="container text-center">
        <h2 class="section-title">Tertarik Mencoba?</h2>
        <p class="section-desc mb-4">Dapatkan tiket masuk dan nikmati semua wahana seru ini</p>
        <RouterLink to="/harga-tiket" class="btn-cta-wahana">
          <i class="bi bi-ticket-perforated-fill me-2"></i>Lihat Harga Tiket
        </RouterLink>
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

const filterList = [
  { value: 'semua',   label: 'Semua Wahana', icon: 'bi-grid-fill' },
  { value: 'dewasa',  label: 'Dewasa',       icon: 'bi-person-fill' },
  { value: 'anak',    label: 'Anak-Anak',    icon: 'bi-emoji-smile-fill' },
  { value: 'keluarga',label: 'Keluarga',     icon: 'bi-house-heart-fill' },
]
</script>

<style scoped>
/* HERO */
#wahana-hero {
  background: linear-gradient(135deg, #0a3d5c 0%, #1ea8d4 55%, #7dd8f0 100%);
  min-height: 60vh; display: flex; align-items: center;
  position: relative; overflow: hidden; padding: 0;
}
.wahana-hero-content { padding-top: 120px; padding-bottom: 120px; text-align: center; width: 100%; }
.wahana-hero-title {
  font-family: 'Montserrat', sans-serif;
  font-size: clamp(32px, 5vw, 56px); font-weight: 800;
  color: #ffffff; line-height: 1.15; margin-bottom: 16px;
}
.wahana-hero-desc { font-family: 'Open Sans', sans-serif; font-size: 18px; color: rgba(255,255,255,0.85); margin: 0 auto; max-width: 560px; }
.wahana-hero-wave { position: absolute; bottom: 0; left: 0; width: 100%; line-height: 0; }
.wahana-hero-wave svg { width: 100%; height: 100px; display: block; }

/* FILTER */
#wahana-filter { background-color: #ffffff; padding: 40px 0 20px; }
.filter-wrap { display: flex; gap: 12px; flex-wrap: wrap; justify-content: center; }
.filter-btn {
  font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 500;
  color: #1D3461; background: transparent;
  border: 1.5px solid #d0d0d0; border-radius: 50px;
  padding: 8px 22px; cursor: pointer; transition: all 0.25s ease;
  display: inline-flex; align-items: center;
}
.filter-btn:hover { border-color: #1ea8d4; color: #1ea8d4; }
.filter-btn.active { background-color: #1D3461; border-color: #1D3461; color: #ffffff; }

/* LIST */
#wahana-list { background-color: #ffffff; padding: 40px 0 80px; }

.wahana-empty { text-align: center; padding: 60px 0; color: #aaa; }
.wahana-empty i { font-size: 48px; display: block; margin-bottom: 12px; }
.wahana-empty p { font-family: 'Open Sans', sans-serif; font-size: 16px; }

.wahana-card-page { background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: transform 0.25s ease, box-shadow 0.25s ease; height: 100%; }
.wahana-card-page:hover { transform: translateY(-6px); box-shadow: 0 12px 32px rgba(0,0,0,0.14); }
.wahana-card-img-wrap { position: relative; overflow: hidden; }
.wahana-card-img { width: 100%; height: 220px; object-fit: cover; display: block; transition: transform 0.35s ease; }
.wahana-card-page:hover .wahana-card-img { transform: scale(1.05); }
.wahana-card-badge { position: absolute; top: 14px; right: 14px; font-family: 'Inter', sans-serif; font-size: 12px; font-weight: 500; background-color: #1ea8d4; color: #ffffff; padding: 4px 14px; border-radius: 20px; text-transform: capitalize; }
.badge-dewasa  { background-color: #1D3461 !important; }
.badge-anak    { background-color: #28a745 !important; }
.badge-keluarga{ background-color: #f5a623 !important; }
.wahana-card-body  { padding: 24px; }
.wahana-card-title { font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: 700; color: #1D3461; margin-bottom: 10px; }
.wahana-card-desc  { font-family: 'Open Sans', sans-serif; font-size: 14px; color: #666; line-height: 1.7; margin-bottom: 16px; }
.wahana-card-info  { display: flex; flex-direction: column; gap: 8px; border-top: 1px solid #f0f0f0; padding-top: 16px; }
.wahana-info-item  { display: flex; align-items: center; gap: 10px; font-family: 'Open Sans', sans-serif; font-size: 13px; color: #555; }
.wahana-info-item i{ color: #1ea8d4; font-size: 15px; width: 18px; flex-shrink: 0; }

/* CTA */
#cta-wahana { background-color: #f8fbfd; padding: 80px 0; }
.btn-cta-wahana {
  font-family: 'Inter', sans-serif; font-weight: 600; font-size: 15px;
  background-color: #1D3461; color: #ffffff;
  border-radius: 50px; padding: 14px 36px; text-decoration: none;
  display: inline-flex; align-items: center; transition: all 0.25s ease;
}
.btn-cta-wahana:hover { background-color: #0a3d5c; color: #ffffff; transform: translateY(-2px); }
</style>