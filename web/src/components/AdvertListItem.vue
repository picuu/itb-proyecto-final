<script>
import { RouterLink } from 'vue-router'

export default {
  name: 'OfferCard',
  props: {
    title: { type: String, required: true },
    description: { type: String, required: true },
    image: { type: String, required: true },
    id: { type: String, required: true },
    isRequest: { type: String, required: true }
  },
  components: {
    RouterLink
  },
  computed: {
    getAdvertImagePath() {
      if (this.image == "default.webp") return "/" + this.image
      return this.image
    }
  }
}
</script>

<template>
  <article>
    <img :src="getAdvertImagePath" :alt="title" />
    <div class="offer-info">
      <h3><RouterLink :to="(isRequest == 1 ? '/requests/' : '/offers/') + id">{{ title }}</RouterLink></h3>
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

h3 a {
  color: var(--color-heading);
  text-decoration-color: transparent;
  transition: text-decoration-color .2s ease-in-out;
}

h3 a:hover {
  text-decoration-color: var(--color-text-bright);
}

.pills {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-top: auto;
}

@media screen and (width < 769px) {
  img {
    display: none;
  }

  .pills {
    flex-wrap: wrap;
  }
}
</style>
