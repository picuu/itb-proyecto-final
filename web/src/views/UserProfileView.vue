<script>
import HeaderComponent from '../components/HeaderComponent.vue';
import UserProfile from '../components/UserProfile.vue';
import LayoutSection from '../sections/LayoutSection.vue';
export default {
  name: "UserProfileView",
  props: {
    userId: {
      type: String,
      required: true
    }  
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
h2 {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-block: 2rem;
  color: var(--color-heading);
  font-size: 2rem;
  font-weight: 500;
}
</style>
