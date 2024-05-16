<script>
import { RouterLink, RouterView } from 'vue-router'
import IconMenu from './icons/IconMenu.vue'

export default {
  name: 'App',
  components: {
    RouterLink,
    RouterView,
    IconMenu
  }
}
</script>

<template>
  <header>
    <img alt="Time Bank logo" src="@/assets/img/logo.svg" />

    <div class="wrapper">
      <span>
        <IconMenu size="32" />
      </span>

      <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
      </nav>
    </div>
  </header>

  <RouterView />
</template>

<style scoped></style>
