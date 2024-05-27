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
      <LayoutSection>
        <div class="img">
          <img alt="Time Bank logo" src="@/assets/img/about.png" />
        </div>

        <div class="aboutUs">
        <h2>
          About us
        </h2>
        <p>We are Jacomar, Thalia, and Carlos, junior developers who have decided to embark on creating a functional web application for a time bank</p>
        </div>

        <div class="who">
        <h2>Who we are</h2>
        <p>Our goal is to develop a comprehensive web application called "Banco del Tiempo" (Time Bank), where people can share knowledge and exchange their time. This time bank allows users to offer and receive services without the need for money, promoting a more equitable and collaborative approach.
          On our platform, users can post offers and services, sign up for others' offers, and view and leave reviews. There will also be administrator users with special permissions to manage the community.
          Unlike other time banks, which are often simple web portals, we aim to create a complete and attractive application that truly fulfills its functions and promotes a different way of helping and learning.</p>
        </div> 
        </LayoutSection>
    </main>
  </div>
  
</template>

<style scoped>
img {
  width: 50%;
}

.img {
  width: 50%;
}

.content-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 2rem;
}



p {
  margin: 0.5rem;
  line-height: 200%;
}

h2 {
  text-align: center;
  margin-block: 1rem;
  color: var(--color-heading);
  font-size: 2rem;
  font-weight: 500;
}
</style>
