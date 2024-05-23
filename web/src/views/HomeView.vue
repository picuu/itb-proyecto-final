<script>
import SectionHero from '../sections/SectionHero.vue'
import CardsRow from '../components/CardsRow.vue'

export default {
  name: 'HomeView',
  components: {
    SectionHero,
    CardsRow
  }
}
</script>

<template>
  <main class="content-grid">
    <SectionHero class="full-width" />
    <CardsRow />
  </main>
</template>
