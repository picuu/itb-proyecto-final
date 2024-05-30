<script>
import UpdateUserProfileForm from './UpdateUserProfileForm.vue';
import { convertCoinsToTime, formatTimestamp } from '@/helpers';

export default {
  name: "UserProfile",
  components: {
    UpdateUserProfileForm
  },
  data() {
    return {
      user: {
        name: '',
        surname: '',
        email: '',
        phone: '',
        image: ''
      },
      adverts: [],
      bookings: [],
      showUpdateUserProfileForm: false
    };
  },
  created() {
    const authInfo = JSON.parse(localStorage.getItem("authInfo"));
    if (authInfo && authInfo.id) {
      this.fetchUserData(authInfo.id);
      this.fetchUserAdverts(authInfo.id);
      this.fetchUserBookings(authInfo.id);
    }
  },
  methods: {
    convertCoinsToTime,
    formatTimestamp,
    editProfile() {
      this.showUpdateUserProfileForm = true;
    },
    async fetchUserData(userId) {
      try {
        const response = await fetch(`http://localhost/itb-proyecto-final/api/index.php/user/${userId}`);
        const userData = await response.json();
        const image = await import(`../assets/profileAvatarCollection/${userData.image}`);

        this.user.name = userData.name;
        this.user.surname = userData.surname;
        this.user.email = userData.email;
        this.user.phone = userData.phone;
        this.user.image = image.default;
      } catch (error) {
        console.error("Error fetching user data:", error);
      }
    },
    async fetchUserAdverts(userId) {
      try {
        const response = await fetch(`http://localhost/itb-proyecto-final/api/index.php/advert/user/${userId}`);
        const advertsData = await response.json();
        this.adverts = advertsData;
      } catch (error) {
        console.error("Error fetching user adverts:", error);
      }
    },
    async fetchUserBookings(userId) {
      try {
        const response = await fetch(`http://localhost/itb-proyecto-final/api/index.php/booking/user/${userId}`);
        const bookingsData = await response.json();
        this.bookings = bookingsData;
      } catch (error) {
        console.error("Error fetching user bookings:", error);
      }
    }
  },
  computed: {
    getAdvertImagePath() {
      if (this.user.image == "default-profile.webp") return "/" + this.user.image
      return this.user.image
    }
  }
};
</script>

<template>
  <div class="content">
    <div v-if="!showUpdateUserProfileForm" class="user-profile">
      <section class="left-section">
        <header>
          <h3>Personal information</h3>
        </header>
        <img :src="user.image" :alt="`${user.name} ${user.surname}`" />

        <dl class="properties">
          <div class="property">
            <dt>Name</dt>
            <dd>{{ user.name }} {{ user.surname }}</dd>
          </div>

          <div class="property">
            <dt>Email</dt>
            <dd>{{ user.email }}</dd>
          </div>

          <div class="property">
            <dt>Phone</dt>
            <dd>{{ user.phone }}</dd>
          </div>

          <div class="buttons">
            <button type="button" @click="editProfile">Edit profile</button>
            <button type="button" @click="deleteAccount">Delete account</button>
          </div>
        </dl>
      </section>

      <section class="right-section">
        <div class="adverts">
          <header>
            <h3>Your currently published adverts</h3>
          </header>
          <table class="underheader-lines">
            <thead>
              <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Publish Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="advert in adverts" :key="advert.id">
                <td>{{ advert.title }}</td>
                <td>{{ advert.isRequest === "1" ? 'Request' : 'Offer' }}</td>
                <td>{{ advert.price }}</td>
                <td>{{ convertCoinsToTime(advert.price) }}</td>
                <td>{{ formatTimestamp(advert.publish_date) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <br>
        <div class="bookings">
          <header>
            <h3 id="bookings">Your bookings</h3>
          </header>
          <table class="underheader-lines">
            <thead>
              <tr>
                <th>Advert Title</th>
                <th>Date</th>
                <th>TCs</th>
                <th>Duration</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="booking in bookings" :key="booking.id">
                <td>{{ booking.title }}</td>
                <td>{{ formatTimestamp(booking.booking_date) }}</td>
                <td>{{ booking.price }}</td>
                <td>{{ convertCoinsToTime(booking.price) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
    </div>
    <section v-else class="update-profile-form">
      <UpdateUserProfileForm />
    </section>
  </div>
</template>

<style scoped>
.user-profile {
  display: flex;
  gap: 2rem;
  margin-top: 2rem;
}

.left-section {
  flex: 1;
}

.right-section {
  flex: 2;
}

img {
  width: 100%;
  max-width: 200px;
  height: auto;
  aspect-ratio: 1 / 1;
  object-fit: cover;
  border-radius: 50%;
}

.properties {
  margin-top: 1rem;
}

.property {
  margin-bottom: 0.5rem;
}

.property dt {
  font-weight: bold;
}

.property dd {
  margin-left: 0;
}

table.underheader-lines {
  width: 100%;
  border-collapse: collapse;
}

table.underheader-lines th,
table.underheader-lines td {
  border-bottom: 1px;
  padding: 8px;
  text-align: left;
}

table.underheader-lines th {
  font-weight: bold;
}

.adverts.bookings {
  gap: 2rem;
  padding: 1.5rem;
  background-image: linear-gradient(322deg, #ffffff05, #ffffff08);
  border: 1px solid var(--color-border);
  border-radius: 6px;
  backdrop-filter: blur(12px);
}

.buttons {
  display: flex;
  gap: 2rem;
  margin-top: 2rem;
}

.adverts,
.bookings {
  display: flex;
  flex-direction: column;
  gap: .5rem;
  padding: 1rem;
  background-image: linear-gradient(322deg, #ffffff05, #ffffff08);
  border: 1px solid var(--color-border);
  border-radius: 6px;
  backdrop-filter: blur(12px);
}

h3 {
  color: var(--color-heading)
}
</style>