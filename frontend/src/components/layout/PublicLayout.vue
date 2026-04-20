<template>
  <div class="public-layout">
    <NavbarComponent />
    <main style="padding-top: 70px;">
      <slot />
    </main>
    <FooterComponent />
  </div>
</template>

<script setup>
import NavbarComponent from '@/components/layout/NavbarComponent.vue'
import FooterComponent from '@/components/layout/FooterComponent.vue'
</script>