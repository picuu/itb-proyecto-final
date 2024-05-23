<script>
import { RouterLink } from 'vue-router'

export default {
  name: "AdvertCard",
  props: {
    title: String,
    description: String,
    link: String
  },
  components: {
    RouterLink,
  }
}
</script>

<template>
  <article>
    <RouterLink :to="link">
      <slot />
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
  width: 400px;
}

a {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1.25rem;
  padding: 2rem;
  width: 100%;
  height: 100%;
  border: none;
  border-radius: 8px;
  color: rgba(255, 255, 255, .85);
  text-decoration: none;
  -webkit-transition: background-image 0.2s ease-in-out;
  transition: background-image 0.2s ease-in-out;
}

article:hover a {
  background-image: linear-gradient(322deg,#ffffff05,#ffffff08);
}

.text {
  display: flex;
  flex-direction: column;
  gap: .25rem;
  text-align: center;
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