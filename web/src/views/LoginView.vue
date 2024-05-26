<script>
import HeaderComponent from '../components/HeaderComponent.vue';
import LoginForm from '../components/LoginForm.vue';
import LayoutSection from '../sections/LayoutSection.vue';

export default {
  name: "LoginView",
  props: {
    activeTabProp: {
      type: String,
      default: 'login'
    }
  },
  components: {
    LayoutSection,
    LoginForm,
    HeaderComponent
  }
};
</script>

<template>
  <div>
    <HeaderComponent />

    <main class="content-grid">
      <LayoutSection>
        <h2>Authentication</h2>

        <LoginForm :activeTabProp="activeTabProp" />
      </LayoutSection>
    </main>
  </div>
</template>

<style scoped>
h2 {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.5rem;
  margin-block: 2rem;
  color: var(--color-heading);
  font-size: 2rem;
  font-weight: 500;
}
</style>
