<script>
import HeaderComponent from '../components/HeaderComponent.vue';
import UserProfile from '../components/UserProfile.vue';
import LayoutSection from '../sections/LayoutSection.vue';
export default {
  name: "LoginView",
  props: {
    userId: String
  },
  components: { HeaderComponent, LayoutSection, UserProfile }
};
</script>

<template>
  <div>
    <HeaderComponent />

    <main class="content-grid">
      <LayoutSection>
        <h2>User profile</h2>

        <UserProfile :userId="userId" />
      </LayoutSection>
    </main>
  </div>
</template>

<style scoped>

</style>
