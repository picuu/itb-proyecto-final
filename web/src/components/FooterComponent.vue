<script>
import { RouterLink } from 'vue-router'
import { IconBrandGithub, IconBrandInstagram, IconBrandX } from '@tabler/icons-vue'

export default {
  name: 'FooterComponent',
  components: {
    RouterLink,
    IconBrandGithub,
    IconBrandInstagram,
    IconBrandX
  }
}
</script>

<template>
  <footer class="content-grid">
    <section class="grid-section">
      <div class="left-side">
        <img alt="Time Bank logo" src="@/assets/img/logo.svg" />
        <p class="slogan">Trade <span class="bold">time</span>, build <span class="bold">community</span>.</p>
        <ul>
          <li>
            <a href="http://github.com/picuu/itb-proyecto-final" target="_blank" rel="noopener noreferrer">
              <IconBrandGithub size="18" />
            </a>
          </li>
          <li>
            <a href="#" target="_blank" rel="noopener noreferrer">
              <IconBrandInstagram size="18" />
            </a>
          </li>
          <li>
            <a href="#" target="_blank" rel="noopener noreferrer">
              <IconBrandX size="18" />
            </a>
          </li>
        </ul>
      </div>

      <div class="right-side">
        <nav>
          <span>Organization</span>
          <RouterLink to="/">Home</RouterLink>
          <RouterLink to="/about">About</RouterLink>
        </nav>

        <nav>
          <span>Product</span>
          <RouterLink to="/requests">Requests</RouterLink>
          <RouterLink to="/offers">Offers</RouterLink>
        </nav>

        <nav>
          <span>Authentication</span>
          <RouterLink to="/sign-up">Sign Up</RouterLink>
          <RouterLink to="/login">Login</RouterLink>
        </nav>
      </div>
    </section>

    <section class="second-section">
      <p>
        Developed by
        <a href="https://github.com/JacomarGS" class="owner" target="_blank" rel="noreferrer noopener">JacomarGS</a>,
        <a href="https://github.com/DevThalia" class="owner" target="_blank" rel="noreferrer noopener">Thalia Bravo</a> and
        <a href="https://carloscapo.com" class="owner" target="_blank" rel="noreferrer noopener">Carlos Capó</a>
      </p>
    </section>
  </footer>
</template>

<style scoped>
footer {
  padding-block: 4rem 3rem;
}

.grid-section {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  padding-bottom: 2rem;
  border-bottom: 1px solid var(--color-border);
}

a {
  width: fit-content;
  color: var(--color-text);
  text-decoration: none;
}

a:hover {
  cursor: pointer;
}

.bold {
  font-weight: 600;
}

.left-side {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.left-side ul {
  display: flex;
  gap: 0.5rem;
  list-style: none;
}

img {
  display: block;
  width: 70px;
}

.right-side {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  justify-items: end;
  gap: 2rem;
}

.right-side nav {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.right-side nav span {
  color: var(--color-text-bright);
  font-weight: 500;
}

.second-section {
  padding-top: 2rem;
}

.owner {
  color: rgba(60, 120, 220);
}

@media screen and (width < 769px) {
  .grid-section {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 2.5rem;
  }

  .left-side {
    flex-direction: row;
    align-items: center;
  }

  img {
    width: 40px;
  }

  .right-side {
    width: 100%;
    justify-items: center;
  }
  
  .second-section {
    text-align: center;
  }
}

@media screen and (width < 401px) {
  .right-side nav span {
    display: none;
  }
}

@media screen and (width < 301px) {
  .slogan,
  .right-side {
    display: none;
  }

  .left-side {
    align-items: flex-end;
  }
}
</style>
