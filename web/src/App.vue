<script>
import { RouterView } from 'vue-router'
import FooterComponent from '@/components/FooterComponent.vue'
import BackgroundComponent from '@/components/BackgroundComponent.vue'

export default {
  name: 'App',
  components: {
    RouterView,
    FooterComponent,
    BackgroundComponent
  }
}
</script>

<template>
  <RouterView />

  <FooterComponent />

  <BackgroundComponent />
</template>

<style>
main {
  padding-top: calc((1.5rem * 2) + (15px * 1.4));
}
</style>
