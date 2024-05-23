<script>
import { IconHeartHandshake } from '@tabler/icons-vue'
import LayoutSection from '@/sections/LayoutSection.vue'
import PillComponent from '@/components/PillComponent.vue'
import OfferCard from '@/components/OfferCard.vue'

export default {
  name: 'HomeView',
  components: {
    LayoutSection,
    OfferCard,
    PillComponent,
    IconHeartHandshake
  },
  data() {
    return {
      offers: Object,
      desc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti, quia facilis neque explicabo suscipit quasi doloremque ratione provident a doloribus veritatis officiis eos distinctio necessitatibus repellendus illum ex, vero molestias.'
    }
  },
  methods: {
    async getOffers() {
      const res = await fetch('http://localhost/itb-proyecto-final/api/index.php/offer')
      const data = await res.json()

      return data
    }
  },
  computed: {
    getOfferTags(offer) {
      const res = fetch(`https://localhost/itb-proyecto-final/api/index.php/offer/${offer.id}`)
      const data = res.json()
      return data
    }
  },
  created() {
    this.offers = this.getOffers()
  }
}
</script>

<template>
  <LayoutSection>
    <h2>
      <IconHeartHandshake size="36" />
      Offers
    </h2>

    <div class="offer-list">
      <template v-for="offer in offers" :key="offer.id">
        <OfferCard :title="offer.title" :description="offer.description" :image="offer.image">
          <PillComponent :text="'Category Name'" type="primary" :id="offer.category_id" />
          <template v-for="tag in tags" :key="tag.id">
            <PillComponent :text="tag.name" type="secondary" :id="tag.id" />
          </template>
        </OfferCard>
      </template>
    </div>
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

.offer-list {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}
</style>
