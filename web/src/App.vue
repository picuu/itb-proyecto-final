<script>
import { RouterLink, RouterView } from 'vue-router'
import FooterComponent from '@/components/FooterComponent.vue'
import BackgroundComponent from '@/components/BackgroundComponent.vue'

export default {
  name: 'App',
  components: {
    RouterLink,
    RouterView,
    FooterComponent,
    BackgroundComponent,
    LoginView
  }
}
</script>

<template>
  <header>
    <div class="wrapper">
      <img alt="Time Bank logo" src="@/assets/img/logo.svg" />

      <nav>
        <div>
          <RouterLink to="/">Home</RouterLink>
          <RouterLink to="/about">About</RouterLink>
          <RouterLink to="/offers">Offers</RouterLink>
          <RouterLink to="/demands">Demands</RouterLink>
          <RouterLink to="/events">Events</RouterLink>
        </div>
        <div>
          <RouterLink to="/login">Login</RouterLink>
          <RouterLink to="/sign-up">Sign Up</RouterLink>
        </div>
      </nav>
    </div>
  </header>

  <RouterView />

  <FooterComponent />

  <BackgroundComponent />
</template>

<style scoped>
main {
  padding-top: calc((1.5rem * 2) + (15px * 1.4));
}

header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  padding: 1.5rem 0;
  background-color: rgb(0 0 0 / 0.15);
  backdrop-filter: blur(12px);
}

.wrapper {
  display: flex;
  align-items: center;
  gap: 2rem;
  width: min(1280px, 100% - 4rem);
  margin-inline: auto;
}

img {
  display: block;
  height: 16px;
}

.menu-icon {
  display: none;
}

nav,
nav > div {
  display: flex;
  align-items: center;
  gap: 2rem;
}

nav {
  justify-content: space-between;
  width: 100%;
}

a {
  color: var(--color-text-bright);
  text-decoration: none;
}
</style>
