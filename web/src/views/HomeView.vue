<script>
import SectionHero from '@/sections/SectionHero.vue'
import SectionHomeCards from '@/sections/SectionHomeCards.vue'

export default {
  name: 'HomeView',
  components: {
    SectionHero,
    SectionHomeCards
  }
}
</script>

<template>
  <SectionHero class="full-width" />
  <SectionHomeCards />
</template>
