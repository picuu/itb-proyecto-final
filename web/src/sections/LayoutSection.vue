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

main > section:last-of-type {
  margin-bottom: calc(var(--section-gap) / 2.5);
}
</style>
