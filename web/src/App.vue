<script>
import { RouterView } from 'vue-router'
import HeaderComponent from '@/components/HeaderComponent.vue'
import FooterComponent from '@/components/FooterComponent.vue'
import BackgroundComponent from '@/components/BackgroundComponent.vue'

export default {
  name: 'App',
  components: {
    RouterView,
    HeaderComponent,
    FooterComponent,
    BackgroundComponent
  }
}
</script>

<template>
  <HeaderComponent />

  <main class="content-grid">
    <RouterView />
  </main>

  <FooterComponent />

  <BackgroundComponent />
</template>

<style scoped>
main {
  padding-top: calc((1.5rem * 2) + (15px * 1.4));
}
</style>
