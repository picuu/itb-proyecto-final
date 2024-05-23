<script>
export default {
  name: 'LayoutSection'
}
</script>

<template>
  <section>
    <slot />
  </section>
</template>

<style scoped>
section {
  margin-bottom: var(--section-gap);
}
</style>
