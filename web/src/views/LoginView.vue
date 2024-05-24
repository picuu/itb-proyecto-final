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
        <h2>Login</h2>

        <LoginForm :activeTabProp="activeTabProp" />
      </LayoutSection>
    </main>
  </div>
</template>

<style scoped></style>
