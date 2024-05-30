<script>
import { RouterLink } from 'vue-router'
import { user } from '@/types'
import { validateSession } from '@/helpers'
import { IconMenu2, IconUser } from '@tabler/icons-vue'

export default {
  name: 'HeaderComponent',
  components: {
    RouterLink,
    IconMenu2,
    IconUser
  },

  data() {
    return {
      isLogged: false,
      isMenuOpen: false,
      userId: null,
      user
    }
  },

  methods: {
    checkLogin() {
      const authInfo = validateSession()
      console.log(authInfo);
      if (authInfo) {
        this.isLogged = true;
        this.userId = authInfo.id;
      } else {
        this.isLogged = false;
        this.userId = null;
      }
    },

    logout() {
      this.isLogged = false;
      this.userId = null;
      localStorage.removeItem("authInfo");
      this.$router.push('/');
    },

    toggleMenu() {
      this.isMenuOpen = !this.isMenuOpen
    },

    async getUser() {
      try {
        const res = await fetch(`http://localhost/itb-proyecto-final/api/index.php/user/${this.userId}`)
        const data = await res.json()
        this.user = data
      } catch (e) {
        console.error("Error fetching user:", e)
      }
    }
  },

  created() {
    this.checkLogin()
    if (this.isLogged) this.getUser()
  },
}
</script>

<template>
  <header>
    <div class="wrapper">
      <img alt="Time Bank logo" src="@/assets/img/logo.svg" />

      <nav>
        <div class="menu">
          <span class="dropdown" @click="toggleMenu">
            <IconMenu2 size="32" stroke="1.5" />
          </span>

          <div :class="['nav', { 'hidden': !isMenuOpen }]">
            <div class="navigation">
              <RouterLink to="/">Home</RouterLink>
              <RouterLink to="/about">About</RouterLink>
              <RouterLink to="/offers">Offers</RouterLink>
              <RouterLink to="/requests">Requests</RouterLink>
              <template v-if="user.isAdmin === '1'">
                <RouterLink to="/admin">Users managment</RouterLink>
              </template>
            </div>

            <div class="auth-nav">
              <template v-if="isLogged">
                <a @click="logout">Log out</a>
                <span class="balance">{{ user.balance }} TC's</span>
                <RouterLink :to="`/user/${userId}`">
                  <IconUser size="20" />
                  Profile
                </RouterLink>
              </template>
              <template v-else>
                <RouterLink to="/login">Login</RouterLink>
                <RouterLink to="/sign-up">Sign Up</RouterLink>
              </template>
            </div>
          </div>
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
  height: 24px;
}

.dropdown {
  display: none;
}

.menu {
  position: relative;
}

nav,
.menu,
.nav,
.navigation,
.auth-nav {
  width: 100%;
  display: flex;
  align-items: center;
  gap: 2rem;
}

.auth-nav {
  margin-left: auto;
  justify-content: flex-end;
}

a,
.balance {
  display: flex;
  align-items: center;
  gap: .25rem;
  color: var(--color-text-bright);
  text-decoration: none;
}

a:hover {
  cursor: pointer;
}

@media screen and (width < 601px) {
  .wrapper {
    flex-direction: row-reverse;
  }

  .dropdown {
    display: block;
    height: 32px;
  }

  .menu {
    width: fit-content
  }

  .hidden {
    display: none;
  }

  .nav {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100vw;
    padding: .75rem 1.25rem;
    margin-top: 3.25rem;
    background-color: rgba(25 25 35);
    border-radius: 6px;
  }

  a,
  .balance {
    width: 100%;
    padding: .5rem 1rem;
    text-align: center;
  }

  .nav,
  .navigation,
  .auth-nav {
    flex-direction: column;
    gap: 1rem;
  }

  .navigation a,
  .auth-nav a:not(:last-of-type),
  .auth-nav .balance {
    border-bottom: 1px solid var(--color-border-hover);
  }
}
</style>
