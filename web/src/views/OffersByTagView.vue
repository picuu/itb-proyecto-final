<script>
import { IconHeartHandshake } from '@tabler/icons-vue'
import LayoutSection from '@/sections/LayoutSection.vue'
import AdvertList from '@/components/AdvertList.vue'
import HeaderComponent from '../components/HeaderComponent.vue'

export default {
  name: 'OffersByTagView',
  props: {
    tagId: {
      type: String,
      default: "0"
    }
  },
  components: {
    LayoutSection,
    IconHeartHandshake,
    AdvertList,
    HeaderComponent
  },
  data() {
    return {
      endpoint: ""
    }
  },
  created() {
    if (this.tagId && this.tagId != "") {
      this.endpoint = "/offer/tag/" + this.tagId
    } else {
      this.endpoint = "/offer/"
    }
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
          Offers by tag
        </h2>
    
        <AdvertList :endpoint="endpoint" />
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
