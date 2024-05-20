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
    <img :src="image" :alt="title">
    <h3>{{ title }}</h3>
    <p>{{ description }}</p>
    <RouterLink :to="link">See more</RouterLink>
  </article>
</template>

<style scoped>
article {
  padding: 1rem;
  background-color: rgb(100 100 100 / .15);
  border: 1px solid rgb(100 100 100 / .25);
  border-radius: .5rem;
}
</style>