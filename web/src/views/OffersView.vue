<script>
import { RouterLink } from 'vue-router'
import { IconHeartHandshake } from '@tabler/icons-vue'
import LayoutSection from '@/sections/LayoutSection.vue'
import AdvertList from '@/components/AdvertList.vue'
import HeaderComponent from '../components/HeaderComponent.vue'


export default {
  name: 'OffersView',
  components: {
    RouterLink,
    LayoutSection,
    IconHeartHandshake,
    AdvertList,
    HeaderComponent
  }
}
</script>

<template>
  <div>
    <HeaderComponent />

    <main class="content-grid">
      <LayoutSection>
        <h2>
          <IconHeartHandshake size="36" />
          Offers
        </h2>
    
        <AdvertList endpoint="/offer/" />
        <RouterLink to="/new-advert-form">Add New Advert</RouterLink>
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
