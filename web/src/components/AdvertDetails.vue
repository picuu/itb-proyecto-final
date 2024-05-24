<script>
export default {
  name: 'AdvertDetails',
  props: {
    advertId: {
      type: String,
      default: '0'
    }
  },
  data() {
    return {
      advert: {
        id: '',
        owner_id: '',
        category_id: '0',
        title: '',
        image: '',
        description: '',
        isRequest: '',
        price: '',
        availability: '',
        loc_name: '',
        loc_latitude: '',
        loc_longitude: '',
        max_subscribers: '',
        publish_date: '',
        tags: [
          {
            id: '0',
            name: ''
          }
        ],
        category: {
          id: '',
          name: ''
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
  <div class="content">
    <div class="offer-detail">
      <div class="offer-detail-header">
        <div class="offer-image">
          <img :src="advert.image" :alt="advert.title" />
        </div>
        <div class="offer-info">
          <h1>{{ advert.title }}</h1>
          <div class="offer-meta">
            <span>Added by {{ advert.owner_id }}</span>
            <span>{{ advert.publish_date }}</span>
          </div>
          <div class="offer-actions">
            <button @click="takeOffer">Take up this offer</button>
          </div>
          <div class="offer-location">
            <strong>Location: </strong><a :href="advert.locationLink">{{ advert.loc_name }}</a>
          </div>
          <div class="offer-tags">
            <div v-for="tag in advert.tags" :key="tag" class="tag">{{ tag.name }}</div>
          </div>
        </div>
      </div>
      <div class="offer-description">
        <p>{{ advert.description }}</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.offer-detail {
  display: flex;
  flex-direction: column;
  background-color: #1e1e1e;
  color: #ffffff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.offer-detail-header {
  display: flex;
  gap: 20px;
}

.offer-image img {
  max-width: 200px;
  border-radius: 10px;
}

.offer-info {
  flex: 1;
}

.offer-info h1 {
  font-size: 1.75rem;
  margin-bottom: 10px;
}

.offer-meta {
  font-size: 0.875rem;
  color: #aaaaaa;
  margin-bottom: 20px;
}

.offer-meta span {
  display: block;
}

.offer-actions button {
  background-color: #007bff;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  margin-bottom: 20px;
}

.offer-actions button:hover {
  background-color: #0056b3;
}

.offer-location a {
  color: #007bff;
  text-decoration: none;
}

.offer-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 10px;
}

.tag {
  background-color: #333333;
  color: #ffffff;
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 0.875rem;
}

.offer-description {
  margin-top: 20px;
  font-size: 1rem;
  line-height: 1.5;
}
</style>