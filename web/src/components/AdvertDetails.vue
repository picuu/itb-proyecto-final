<script>
import { RouterLink } from 'vue-router';
import { validateSession, formatTime } from '@/helpers'
import CalendarOutput from './CalendarOutput.vue';

export default {
  name: 'AdvertDetails',
  props: {
    advertId: { type: String, default: '0' }
  },
  components: {
    RouterLink,
    CalendarOutput
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
        },
        owner: {
          id: '',
          name: '',
          surname: '',
          image: '',
          email: '',
          phone: '',
          password: '',
          balance: '',
          isAdmin: ''
        },
      },
      availability: Array,
      timePrice: ''
    }
  },
  methods: {
    async getAdvert() {
      const res = await fetch(`http://localhost/itb-proyecto-final/api/index.php/advert/${this.advertId}`)
      const data = await res.json()
      return data
    },

    convertCoinsToTime(coins) {
      const hours = parseInt(coins / 60)
      const minutes = coins % 60

      return formatTime(`${hours}:${minutes}`)
    }
  },
  async created() {
    this.advert = await this.getAdvert()
    this.availability = JSON.parse(this.advert.availability)
    this.timePrice = this.convertCoinsToTime(this.advert.price)
  },
  computed: {
    validateSession
  }
}
</script>

<template>
  <span>
    <div class="content">
      <section class="left-section">
        <img :src="advert.image" :alt="advert.title" />

        <dl class="properties">
          <div class="property">
            <dt>Location</dt>
            <dd>{{ advert.loc_name }}</dd>
          </div>

          <div class="property">
            <dt>Category</dt>
            <dd>{{ advert.category.name }}</dd>
          </div>

          <div class="property">
            <dt>Tags</dt>
            <dd class="tags">
              <RouterLink :to="'/tag/' + tag.id" v-for="tag in advert.tags" class="tag" :key="tag.id">
                {{ tag.name }}
              </RouterLink>
            </dd>
          </div>

          <div class="property">
            <dt>Duration</dt>
            <dd class="duration-property">
              <span>{{ timePrice }}</span>
              <span>=</span>
              <span>{{ advert.price }} TC's</span>
            </dd>
          </div>
        </dl>

        
      </section>
      <section class="right-section">
        <header>
          <h3>{{ advert.title }}</h3>
          <div class="owner">
            <p>
              Added by
              <RouterLink :to="'/users/' + advert.owner_id" :title="advert.owner.name + ' ' + advert.owner.surname">
                {{ advert.owner.name }}
              </RouterLink>
              on {{ advert.publish_date }}
            </p>
          </div>
        </header>
        
        <div class="advert-info">
          <main>
            <div class="enroll">
              <template v-if="validateSession">
                <button>Take up this offer</button>
              </template>
              <template v-else>
                <button disabled>Take up this offer</button>
                <span class="login-reminder">Please, <RouterLink to="/login">sign in</RouterLink> or <RouterLink to="/sign-up">register</RouterLink> to take up this offer.</span>
              </template>
            </div>
  
            <p class="description">{{ advert.description }}</p>
  
            <article class="location">
              <h4>Location</h4>
              <a href="#">{{ advert.loc_name }}</a>
            </article>
          </main>

          <div class="calendar-container">
            <article class="calendar">
                <!-- {{ advert.availability }} -->
                <CalendarOutput :availability="availability" />
              </article>
          </div>
        </div>


      </section>
    </div>
    <p>
      <RouterLink :to="'/update-advert/' + advert.id">Update Advert  </RouterLink>
    </p>
  </span>
</template>

<style scoped>
.content {
  display: grid;
  grid-template-columns: 300px 1fr;
  gap: 3rem;
}

.left-section,
.right-section,
.properties,
header,
main,
.enroll {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.left-section {
  gap: 1.5rem;
}

img {
  width: 100%;
  height: auto;
  aspect-ratio: 1 / 1;
  object-fit: cover;
  background: rgba(200 200 200 / .05);
}

.properties {
  gap: .75rem;
}

.property, .tags {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.property dt {
  width: 100px;
  font-weight: 600;
}

.tags {
  gap: .25rem;
}

.tag {
  padding: .25rem .6rem;
  background-color: var(--color-background-soft);
  border-radius: 6px;
  font-size: 0.875rem;
  color: var(--color-text-bright);
  text-decoration: none;
}

.duration-property {
  display: flex;
  gap: .25rem;
}

.advert-info {
  display: grid;
  grid-template-columns: 6fr 4fr;
  gap: 2rem;
}

header {
  gap: .25rem;
}

h3 {
  font-size: 1.75rem;
  color: var(--color-heading);
}

main {
  padding: 0;
}

.enroll {
  gap: .5rem;
}

button {
  width: fit-content;
  background-color: #007bff;
  border: none;
  padding: .65rem 1.25rem;
  border-radius: 6px;
}

button[disabled] {
  background-color: rgba(0 123 255 / .5);
}

button:hover {
  cursor: pointer;
}

a {
  color: rgb(35, 130, 240);
}

.description {
  max-width: 70ch;
  margin-block: 1rem;
}

.location {
  max-width: 70ch;
  width: 100%;
  padding: 1rem .6rem;
  background-color: rgba(50 50 220 / .1);
  border-left: 4px solid rgba(25 25 200);
  border-radius: 4px;
}

.calendar-container {
  margin-left: auto;
}

@media screen and (width < 1025px) {
  .advert-info {
    grid-template-columns: 1fr;
  }

  .calendar-container {
    margin: 0;
    max-width: 80%;
  }
}

@media screen and (width < 689px) {
  .content {
    grid-template-columns: 1fr;
  }

  .left-section {
    flex-direction: row;
  }

  img {
    width: 50%;
  }

  .property dt {
    width: 80px;
  }

  .calendar-container {
    margin-inline: auto;
  }
}

@media screen and (width < 560px) and (width >= 360px) {
  .property {
    flex-direction: column;
    align-items: flex-start;
    gap: 0;
  }

  .property dt {
    width: fit-content;
  }
}

@media screen and (width < 360px) {
  img {
    display: none;
  }

  .left-section {
    grid-row: 2;
  }
}

@media screen and (width < 481px) {
  .calendar-container {
    margin-inline: 0;
  }
}
</style>