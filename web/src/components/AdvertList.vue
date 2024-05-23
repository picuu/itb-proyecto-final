<script>
import AdvertListItem from '@/components/AdvertListItem.vue'
import PillComponent from '@/components/PillComponent.vue'

export default {
  name: "AdvertList",
  props: {
    endpoint: String
  },
  components: {
    AdvertListItem,
    PillComponent
  },
  data() {
    return {
      offers: Array({
        id: "",
        owner_id: "",
        category_id: "0",
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
            id: "0",
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
      const res = await fetch(`http://localhost/itb-proyecto-final/api/index.php${this.endpoint}`)
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
      <div class="advert-list">
      <AdvertListItem v-for="offer in offers" :title="offer.title" :description="offer.description" :image="offer.image" :key="offer.id">
        <PillComponent :text="offer.category.name" type="primary" :id="offer.category_id" />
        <PillComponent v-for="tag in offer.tags" :text="tag.name" type="secondary" :id="tag.id" :key="tag.id" />
      </AdvertListItem>
    </div>
</template>

<style scoped>
.advert-list {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}
</style>