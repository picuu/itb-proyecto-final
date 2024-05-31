<script>
import { RouterLink } from 'vue-router';
import { validateSession, formatTime, formatTimestamp, convertCoinsToTime } from '@/helpers'
import { advert, user, booking } from '@/types';
import CalendarOutput from '@/components/CalendarOutput.vue';
import MapComp from '@/components/MapComp.vue';

export default {
  name: 'AdvertDetails',
  props: {
    advertId: { type: String, default: '0' }
  },
  components: {
    RouterLink,
    CalendarOutput,
    MapComp
  },

  data() {
    return {
      advert,
      user,
      bookings: Array(booking),
      availability: Array,
      timePrice: '',
      selectedDate: '',
      errorMessage: null,
      isLogged: false,
      isMapAvailable: false,
      map: { lat: "", lng: "" }
    }
  },

  methods: {
    async getAdvert() {
      const res = await fetch(`http://itb-api.us-east-1.elasticbeanstalk.com/index.php/advert/${this.advertId}`)
      const data = await res.json()
      this.loading = false
      return data
    },

    updateSelectedDate(data) {
      this.errorMessage = null
      this.selectedDate = data
    },

    async subscribeToOffer() {
      this.errorMessage = null
      if (!this.selectedDate || this.selectedDate == "") return this.errorMessage = "You must select a day first"

      if (!this.proceedConfirmation()) return
      
      const authInfo = validateSession()
      if (!authInfo) return console.error("Auth info not found")

      this.getUser()
      if (parseInt(this.user.balance) < parseInt(this.advert.price)) return alert("You cannot subscribe to this offer, you dont have enough TC's")

      const bookingData = {
        advert_id: this.advertId,
        user_id: authInfo.id,
        booking_date: this.selectedDate,
        advert_owner_id: this.advert.owner_id,
        advert_price: this.advert.price,
        isRequest: this.advert.isRequest
      }

      console.log(bookingData)

      try {
        const res = await fetch(`http://itb-api.us-east-1.elasticbeanstalk.com/index.php/booking`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
          },
          body: JSON.stringify(bookingData)
        })

        const data = await res.json()
        
        if (data && data.status && data.status == "success") {
          console.info("Booking created successfully")
          this.$router.push(`/user/${authInfo.id}#bookings`)
        } else {
          console.error("Error sending booking data to the server")
        }
      } catch (e) {
        console.error("Error fetching booking:", e)
      }
    },

    proceedConfirmation() {
      const dateTime = formatTimestamp(this.selectedDate)
      const proceed = confirm(`Are you shure? You are going to subscribe to this offer the ${dateTime}h`)
      return proceed
    },

    async getUser() {
      try {
        const res = await fetch(`http://itb-api.us-east-1.elasticbeanstalk.com/index.php/user/${this.userId}`)
        const data = await res.json()
        this.user = data
      } catch (e) {
        console.error("Error fetching user:", e)
      }
    },

    async getAdvertBookings() {
      try {
        const res = await fetch(`http://itb-api.us-east-1.elasticbeanstalk.com/index.php/advert/${this.advertId}/booking`)
        const data = await res.json()
        this.bookings = data
      } catch (e) {
        console.error("Error fetching advert bookings:", e)
      }
    },

    showMap() {
      this.map.lat = this.advert.loc_latitude
      this.map.lng = this.advert.loc_longitude
      this.isMapAvailable = true
    },

    formatTimestamp
  },

  computed: {
    validateSession,

    getAdvertImagePath() {
      if (this.advert.image == "default.webp") return "/" + this.advert.image
      return this.advert.image
    },

    isAdvertOwner() {
      if (!this.isLogged) return false
      if (this.advert.owner_id == this.isLogged.id) return true
      return false
    },

    isDateAvailable() {
      console.log(this.selectedDate)
      if (!this.selectedDate || this.selectedDate == "") return true

      const notReserved = !this.bookings.some(booking => booking.booking_date == this.selectedDate)
      const timeAvailable = this.selectedDate >= new Date().valueOf()

      return notReserved && timeAvailable

    }
  },

  async created() {
    this.isLogged = validateSession()
    this.advert = await this.getAdvert()
    this.availability = this.advert.availability.split(",")
    this.timePrice = formatTime(convertCoinsToTime(this.advert.price)) + 'h'
    if (this.isLogged) this.getAdvertBookings()
    if (this.isLogged) this.showMap()
  }
}
</script>

<template>
  <span>
    <div class="content">
      <section class="left-section">
        <img :src="getAdvertImagePath" :alt="advert.title" />

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
              <RouterLink :to="(advert.isRequest == 1 ? '/requests/tag/' : '/offers/tag/') + tag.id" v-for="tag in advert.tags" class="tag" :key="tag.id">
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

        <RouterLink v-if="isAdvertOwner" :to="'/update-advert/' + advertId" class="update-advert-btn">Update Advert</RouterLink>
      </section>

      <section class="right-section">
        <header>
          <h3>{{ advert.title }}</h3>
          <div class="owner">
            <p>
              Added by
              <RouterLink :to="'/user/' + advert.owner_id" :title="advert.owner.name + ' ' + advert.owner.surname">
                {{ advert.owner.name }}
              </RouterLink>
              on {{ formatTimestamp(advert.publish_date) }}
            </p>
          </div>
        </header>
        
        <div class="advert-info">
          <main>
            <div class="enroll">
              <template v-if="validateSession">
                <button v-if="isAdvertOwner" title="You own this advert" disabled>Take up this offer</button>
                <template v-else>
                  <template v-if="!isDateAvailable">
                    <button title="Date unavailable" disabled>Take up this offer</button>
                    <article class="error">The selected date is unavailable</article>
                  </template>
                  <template v-else>
                    <button @click="subscribeToOffer()">Take up this offer</button>
                  </template>
                </template>
              </template>
              <template v-else>
                <button disabled>Take up this offer</button>
                <span class="login-reminder">Please, <RouterLink to="/login">sign in</RouterLink> or <RouterLink to="/sign-up">register</RouterLink> to take up this offer.</span>
              </template>

              <article v-if="errorMessage" class="error">{{ errorMessage }}</article>
            </div>
  
            <p class="description">{{ advert.description }}</p>
  
            <article class="location">
              <h4>Location</h4>
              <template v-if="isMapAvailable">
                <MapComp class="map" :lat="advert.loc_latitude" :lng="advert.loc_longitude" />
              </template>
              <template v-else>
                <p>You must be registered to see the location</p>
              </template>
            </article>
          </main>

          <div class="calendar-container">
            <article class="calendar">
                <!-- {{ advert.availability }} -->
                <CalendarOutput @availability-data-update="updateSelectedDate" :availability="availability" />
              </article>
          </div>
        </div>


      </section>
    </div>
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
  border-radius: 8px;
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

.update-advert-btn {
  display: block;
  width: fit-content;
  padding: .65rem 1.25rem;
  margin-top: 2rem;
  background-color: #007bff;
  border: none;
  border-radius: 6px;
  color: var(--color-heading);
  text-decoration: none;
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
  display: flex;
  flex-direction: column;
  gap: .25rem;
  max-width: 70ch;
  width: 100%;
  padding: 1rem .6rem;
  background-color: rgba(50 50 220 / .1);
  border-left: 4px solid rgba(25 25 200);
  border-radius: 4px;
}

.location h4 {
  font-weight: 600;
}

.map {
  height: 200px;
  border-radius: 4px;
}

.calendar-container {
  margin-left: auto;
}

.error {
  padding: .5rem 1rem;
  background-color: rgba(200 50 50 / .1);
  border: 1px solid rgba(200 50 50 / .15);
  border-radius: 6px;
  text-align: center;
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