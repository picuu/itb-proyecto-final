<script>
import HeaderComponent from '@/components/HeaderComponent.vue'
import SectionHero from '@/sections/SectionHero.vue'
import SectionHomeCards from '@/sections/SectionHomeCards.vue'

export default {
  name: 'HomeView',
  components: {
    HeaderComponent,
    SectionHero,
    SectionHomeCards
  }
}
</script>

<template>
  <div>
    <HeaderComponent />

    <main class="content-grid">
      <SectionHero />
      <SectionHomeCards />
    </main>
  </div>
</template>
