<script>
import LayoutSection from '@/sections/LayoutSection.vue'

export default {
  name: 'AdvertDetailsView',
  props: {
    advertId: {
      type: String,
      default: "0"
    }
  },
  components: {
    LayoutSection,
  },
  data() {
    return {
      advert: {
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
      }
    }
  },
  methods: {
    async getAdvert() {
      const res = await fetch(`http://localhost/itb-proyecto-final/api/index.php/offer/${this.advertId}`)
      const data = await res.json()
      return data
    }
  },
  async created() {
    this.advert = await this.getAdvert()
  }
}
</script>

<template>
  <LayoutSection>
    <h2>Advert Details</h2>

    <div class="content">
      <div class="image-section">
        <img :src="advert.image" :alt="advert.title">
      </div>
      <div class="info-section">
        <h3>{{ advert.title }}</h3>
      </div>
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
</style>
