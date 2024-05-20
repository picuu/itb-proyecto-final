<script>
import { RouterLink } from 'vue-router'

export default {
  name: "AdvertCard",
  props: {
    title: String,
    description: String,
    image: String,
    link: String
  },
  components: {
    RouterLink
  }
}
</script>

<template>
  <article>
    <RouterLink :to="link">
      <img :src="image" :alt="title">
      <div class="text">
        <h3>{{ title }}</h3>
        <p>{{ description }}</p>
      </div>
    </RouterLink>
  </article>
</template>

<style scoped>
article {
  position: relative;
}

a {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
  padding: 2rem;
  width: 100%;
  height: 100%;
  background: linear-gradient(322deg,#ffffff05,#ffffff08);
  border-radius: 8px;
  border: 1px solid rgb(255 255 255 / .05);
  text-decoration: none;
}

img {
  width: 100%;
  height: auto;
}

.text {
  display: flex;
  flex-direction: column;
  gap: .25rem;
}

h3, p {
  font-size: 1.5rem;
  text-wrap: balance;
}

h3 {
  color: rgba(255, 255, 255, .85);
}

p {
  color: rgba(255, 255, 255, .55);
}
</style>