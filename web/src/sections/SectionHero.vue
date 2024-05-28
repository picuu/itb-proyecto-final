<script>
import LayoutSection from '@/sections/LayoutSection.vue'

export default {
  name: 'SectionHero',
  components: {
    LayoutSection
  }
}
</script>

<template>
  <LayoutSection>
    <h1>
      Trade <span class="title-accent">Time</span>, Build <span class="title-accent">Community</span><br />Every Hour Counts!
    </h1>
    <h2>Join the biggest time bank community</h2>
  </LayoutSection>
</template>

<style scoped>
section {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 4rem 0 2rem 0;
  /* background-color: rgb(255 255 255 / 0.05); */
  text-align: center;
  margin-bottom: calc(var(--section-gap) / 2);
}

h1,
span {
  margin-bottom: 3rem;
  font-size: 3rem;
  font-weight: 800;
  color: var(--color-heading);
  text-wrap: balance;
}

.title-accent {
  color: rgb(50, 110, 210);
}
</style>
