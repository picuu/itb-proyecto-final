<script>
export default {
  name: 'OfferCard',
  props: {
    title: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: true
    },
    image: {
      type: String,
      required: true
    }
  },
  components: {}
}
</script>

<template>
  <article>
    <img :src="image" :alt="title" />
    <div class="offer-info">
      <h3>{{ title }}</h3>
      <p>{{ description }}</p>
      <div class="pills">
        <slot />
      </div>
    </div>
  </article>
</template>

<style scoped>
article {
  display: flex;
  gap: 2rem;
  padding: 1.5rem;
  background-image: linear-gradient(322deg, #ffffff05, #ffffff08);
  border: 1px solid var(--color-border);
  border-radius: 6px;
  backdrop-filter: blur(12px);
}

img {
  width: 125px;
  height: 125px;
  aspect-ratio: 1 / 1;
  object-fit: cover;
}

.offer-info {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

h3 {
  color: var(--color-heading);
}

.pills {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-top: auto;
}
</style>
