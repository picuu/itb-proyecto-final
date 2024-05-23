<script>
import { IconHeartHandshake } from '@tabler/icons-vue'
import LayoutSection from '@/sections/LayoutSection.vue'
import AdvertList from '@/components/AdvertList.vue'


export default {
  name: 'OffersView',
  components: {
    LayoutSection,
    IconHeartHandshake,
    AdvertList
  }
}
</script>

<template>
  <LayoutSection>
    <h2>
      <IconHeartHandshake size="36" />
      Offers
    </h2>

    <AdvertList endpoint="/offer/" />
    <router-link to="/advert-form">Add New Advert</router-link>
  </LayoutSection>
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
