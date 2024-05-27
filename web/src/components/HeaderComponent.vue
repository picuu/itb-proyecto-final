<script>
import { RouterLink } from 'vue-router'

export default {
  name: 'FooterComponent',
  components: {
    RouterLink
  },
  data() {
    return {
      isLogged: false
    }
  },
  methods: {
    checkLogin() {
      if (localStorage.getItem("authInfo")) this.isLogged = true
      else this.isLogged = false
    },
    logout() {
      localStorage.removeItem("authInfo")
      this.$router.push('/')
    }
  },
  created() {
    this.checkLogin()
  },
  updated() {
    this.checkLogin()
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
          <RouterLink to="/requests">Requests</RouterLink>
        </div>
        <div>
          <template v-if="isLogged">
            <a @click="logout">Log out</a>
          </template>
          <template v-else>
            <RouterLink to="/login">Login</RouterLink>
            <RouterLink to="/sign-up">Sign Up</RouterLink>
          </template>
        </div>
      </nav>
    </div>
  </header>
</template>

<style scoped>
header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  padding: 1.5rem 0;
  background-color: rgb(0 0 0 / 0.15);
  backdrop-filter: blur(12px);
  z-index: 999;
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

a:hover {
  cursor: pointer;
}
</style>
