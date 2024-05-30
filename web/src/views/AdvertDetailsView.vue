<script>
import { validateSession } from '@/helpers'
import HeaderComponent from '@/components/HeaderComponent.vue'
import LayoutSection from '@/sections/LayoutSection.vue'
import AdvertDetails from '@/components/AdvertDetails.vue'

export default {
  name: 'AdvertDetailsView',
  props: {
    advertId: {
      type: String,
      default: '0'
    }
  },
  components: {
    HeaderComponent,
    LayoutSection,
    AdvertDetails
  },
  data() {
    return {
      isLogged: false,
    }
  },
  methods: {
    checkLogin() {
      const authInfo = validateSession();
      if (authInfo) {
        this.isLogged = true;
      } else {
        this.isLogged = false;
      }
    },
  },
  created() {
    this.checkLogin();
  }
}
</script>

<template>
  <div>
    <HeaderComponent />

    <main class="content-grid">
      <LayoutSection>
        <h2>Advert Details</h2>

        <AdvertDetails :advertId="advertId" />
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
