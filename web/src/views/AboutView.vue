<script>
import HeaderComponent from '@/components/HeaderComponent.vue'
import SectionHero from '@/sections/SectionHero.vue'
export default {
  name: 'AboutView',
  components: {
    HeaderComponent,
    SectionHero,
  }
}
</script>

<template>
  <div>
    <HeaderComponent />

    <main class="content-grid">
      <div class="layout-section">
        <div class="top-section">
          <div class="img">
            <img alt="Time Bank logo" src="@/assets/img/logo.svg" />
          </div>
          <section class="content">
            <div class="aboutUs">
              <h2>About us</h2>
              <p>We are Jacomar, Thalia, and Carlos, junior developers who have decided to embark on creating a functional web application for a time bank</p>
            </div>
          </section>
        </div>
        <div class="bottom-section">
          <section class="content">
            <div class="who">
              <h2>What we do</h2>
              <p>Our goal is to develop a comprehensive web application called "Banco del Tiempo" (Time Bank), where people can share knowledge and exchange their time. This time bank allows users to offer and receive services without the need for money, promoting a more equitable and collaborative approach.
                On our platform, users can post offers and services, sign up for others' offers, and view and leave reviews.</p>
              <p>There will also be administrator users with special permissions to manage the community.
                Unlike other time banks, which are often simple web portals, we aim to create a complete and attractive application that truly fulfills its functions and promotes a different way of helping and learning.</p>
            </div>
          </section>
        </div>
        <section class="our">
          <div class="team-member">
            <a href="https://github.com/JacomarGS">
              <img alt="Team member" src="@/assets/img/about.png" />
            </a>
            <h3>Jaco González</h3>
            <p>Backend dev</p>
          </div>
          <div class="team-member">
            <a href="https://github.com/devThalia">
              <img alt="Team member" src="@/assets/img/about.png" />
            </a>
            <h3>Thalia Bravo</h3>
            <p>SQL dev</p>
          </div>
          <div class="team-member">
            <a href="https://carloscapo.com">
              <img alt="Team member" src="@/assets/img/carlosCapo.png" />
            </a>
            <h3>Carlos Capó</h3>
            <p>Frontend dev</p>
          </div>
        </section>
      </div>
    </main>
  </div>
</template>

<style scoped>
/* General Layout */
.layout-section {
  width: 90%;
  max-width: 1200px;
  margin: auto;
}

.top-section {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  margin-top: 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.bottom-section {
  width: 100%;
  margin-top: 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.img {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
}

.img img {
  width: 80%;
  max-width: 200px;
  border-radius: 50%;
  border: 4px solid #333;
}

.content {
  flex: 2;
}

/* Typography */
p {
  display: block;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    unicode-bidi: isolate;
}

h2 {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.5rem;
  margin-block: 1rem;
  color: var(--color-heading);
  font-size: 2rem;
  font-weight: 500;
}

/* Team Section */
.our {
  display: flex;
  justify-content: space-around;
  align-items: center;
  flex-wrap: wrap;
  margin: 2rem 0;
}

.team-member {
  text-align: center;
  margin: 1rem;
  flex-basis: 20%;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.team-member:hover {
  transform: translateY(-10px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.team-member img {
  width: 100%;
  max-width: 150px;
  border-radius: 50%;
  border: 3px solid #333;
}

.team-member h3 {
  margin: 0.5rem 0 0.2rem;
  font-size: 1.4rem;
  font-weight: 600;
  color: #333;
}

.team-member p {
  font-size: 1rem;
  margin: 0.2rem 0 0.5rem;
  color: #777;
}

/* Social Links */
.social-links {
  display: flex;
  justify-content: center;
  gap: 0.5rem;
}

.social-links a {
  text-decoration: none;
  color: #333;
  transition: color 0.3s ease;
}

.social-links a:hover {
  color: #007BFF;
}
</style>
