<script>
import LayoutSection from '@/sections/LayoutSection.vue'
import HeaderComponent from '@/components/HeaderComponent.vue'
import NewAdvertForm from '@/components/NewAdvertForm.vue'

export default {
  name: 'NewAdvertView',
  components: {
    LayoutSection,
    HeaderComponent,
    NewAdvertForm
  }
};
</script>

<template>
  <div>
    <HeaderComponent />

    <main class="content-grid">
      <LayoutSection>
        <h2>Post a new advert</h2>

        <NewAdvertForm />
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
