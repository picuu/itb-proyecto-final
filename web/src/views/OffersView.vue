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
      offers: Array({
        id: "",
        owner_id: "",
        category_id: "",
        title: "",
        image: "",
        description: "",
        isRequest: "",
        price: "",
        availability: "",
        loc_name: "",
        loc_latitude: "",
        loc_longitude: "",
        max_subscribers: "",
        publish_date: "",
        tags: [
          {
            id: "",
            name: ""
          }
        ],
        category: {
          id: "",
          name: ""
        }
      })
    }
  },
  methods: {
    async getOffers() {
      const res = await fetch('http://localhost/itb-proyecto-final/api/index.php/offer')
      const data = await res.json()
      return data
    }
  },
  async created() {
    this.offers = await this.getOffers()
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
      <OfferCard v-for="offer in offers" :title="offer.title" :description="offer.description" :image="offer.image" :key="offer.id">
        <PillComponent :text="offer.category.name" type="primary" :id="offer.category_id" />
        <PillComponent v-for="tag in offer.tags" :text="tag.name" type="secondary" :id="tag.id" :key="tag.id" />
      </OfferCard>
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
