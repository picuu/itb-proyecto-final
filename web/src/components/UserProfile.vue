<script>
import UpdateUserProfileForm from '@/components/UpdateUserProfileForm.vue';
import { convertCoinsToTime, formatTimestamp, validateSession } from '@/helpers';

export default {
  name: "UserProfile",
  components: {
    UpdateUserProfileForm
  },
  props: {
    userId: { type: String, default: "0" }
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
      services: [],
      showUpdateUserProfileForm: false,
      isLogged: false
    };
  },
  created() {
    this.fetchData()
  },
  methods: {
    convertCoinsToTime,
    formatTimestamp,
    fetchData() {
      this.isLogged = validateSession()
      this.fetchUserData(this.userId);
      this.fetchUserAdverts(this.userId);

      if (this.isLogged && this.isLogged.id == this.userId) {
        this.fetchUserBookings(this.userId);
        this.fetchServices(this.userId)
      }
    },
    userUpdateSuccess() {
      this.fetchData()
      this.toggleEditProfile()
    },
    toggleEditProfile() {
      this.showUpdateUserProfileForm = !this.showUpdateUserProfileForm;
    },
    async fetchUserData(userId) {
      try {
        const response = await fetch(`http://localhost/itb-proyecto-final/api/index.php/user/${userId}`);
        const userData = await response.json();

        if (userData.image == "default-profile.webp") this.user.image = "/" + userData.image
        else {
          this.user.image = await import(`../assets/profileAvatarCollection/${userData.image}`);
          this.user.image = this.user.image.default
        }

        this.user.name = userData.name;
        this.user.surname = userData.surname;
        this.user.email = userData.email;
        this.user.phone = userData.phone;
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
    },
    deleteAccount() {
      if (confirm("Are you sure you want to delete your account?")) {
        const authInfo = JSON.parse(localStorage.getItem("authInfo"));
        if (authInfo && authInfo.id) {
          const userId = authInfo.id;
          fetch(`http://localhost/itb-proyecto-final/api/index.php/user/${userId}`, {
            method: "DELETE",
            headers: {
              "Accept": "application/json",
              "Content-Type": "application/json"
            }
          })
            .then(response => response.json())
            .then(data => {
              if (data.status === 'success') {
                console.log("User account deleted successfully");
                this.$router.push('/');
              } else {
                console.error("Error deleting user account");
              }
            })
            .catch(error => {
              console.error("Error deleting user account:", error);
            });
        }
      }
    },
    redirectToUpdateAdvertForm(advertId) {
      console.log("advertId:", advertId);
      this.$router.push({ name: 'update-advert', params: { advertId: advertId } });
    },
    deleteAdvert(advertId) {
      if (confirm("Are you sure you want to delete this advert?")) {
        const authInfo = JSON.parse(localStorage.getItem("authInfo"));
        if (authInfo && authInfo.id) {
          fetch(`http://localhost/itb-proyecto-final/api/index.php/advert/${advertId}`, {
            method: "DELETE",
            headers: {
              "Accept": "application/json",
              "Content-Type": "application/json"
            }
          })
            .then(response => response.json())
            .then(data => {
              if (data.status === 'success') {
                console.log("Advert deleted successfully");
                this.adverts = this.adverts.filter(advert => advert.id !== advertId);
              } else {
                console.error("Error deleting advert");
              }
            })
            .catch(error => {
              console.error("Error deleting advert:", error);
            });
        }
      }
    },
    deleteBooking(bookingId, advert_id, price, isRequest) {
      if (confirm("Are you sure you want to delete this booking?")) {
        const authInfo = JSON.parse(localStorage.getItem("authInfo"));
        if (authInfo && authInfo.id) {
          const data = {
            user_id: this.userId,
            advert_id,
            price,
            isRequest
          }

          fetch(`http://localhost/itb-proyecto-final/api/index.php/booking/${bookingId}`, {
            method: "DELETE",
            headers: {
              "Accept": "application/json",
              "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
          })
            .then(response => response.json())
            .then(data => {
              if (data.status === 'success') {
                console.log("Booking deleted successfully");
                this.bookings = this.bookings.filter(booking => booking.id !== bookingId);
                location.reload()
              } else {
                console.error("Error deleting booking");
              }
            })
            .catch(error => {
              console.error("Error deleting booking:", error);
            });
        }
      }
    },
    async fetchServices(userId) {
      try {
        const response = await fetch(`http://localhost/itb-proyecto-final/api/index.php/user/${userId}/services`);
        const data = await response.json();
        this.services = data;
      } catch (error) {
        console.error("Error fetching pending services:", error);
      }
    }
  },
  computed: {
    getAdvertImagePath() {
      if (this.user.image == "default-profile.webp") return "/" + this.user.image
      return this.user.image
    },

    isOwnProfile() {
      // console.log(this.isLogged.id)
      // console.log(this.userId)
      if (this.isLogged) return this.isLogged.id == this.userId
      return false
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

          <div v-if="isOwnProfile" class="buttons">
            <button type="button" @click="toggleEditProfile" class="edit-btn">Edit profile</button>
            <button type="button" @click="deleteAccount" class="delete-btn">Delete account</button>
          </div>
        </dl>
      </section>

      <section class="right-section">
        <section v-if="isOwnProfile" class="adverts">
          <header>
            <h3 id="adverts">Your currently published adverts</h3>
          </header>
          <table v-if="adverts.length > 0" class="underheader-lines">
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
                <td><RouterLink :to="'/advert/' + advert.id">{{ advert.title }}</RouterLink></td>
                <td>{{ advert.isRequest === "1" ? 'Request' : 'Offer' }}</td>
                <td>{{ advert.price }}</td>
                <td>{{ convertCoinsToTime(advert.price) }}</td>
                <td>{{ formatTimestamp(advert.publish_date) }}</td>
                <td>
                  <button @click="redirectToUpdateAdvertForm(advert.id)">Update</button>
                  <button @click="deleteAdvert(advert.id)">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
          <p v-else>You haven't published any advert yet</p>
        </section>
        <section v-else class="adverts">
          <header>
            <h3 id="adverts">Published adverts</h3>
          </header>
          <table v-if="adverts.length > 0" class="underheader-lines">
            <thead>
              <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Publish Date</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="advert in adverts" :key="advert.id">
                <td><RouterLink :to="'/advert/' + advert.id">{{ advert.title }}</RouterLink></td>
                <td>{{ advert.isRequest === "1" ? 'Request' : 'Offer' }}</td>
                <td>{{ advert.price }}</td>
                <td>{{ convertCoinsToTime(advert.price) }}</td>
                <td>{{ formatTimestamp(advert.publish_date) }}</td>
              </tr>
            </tbody>
          </table>
          <p v-else>{{ user.name }} hasn't published any advert yet</p>
        </section>
        
        <section v-if="isOwnProfile" class="bookings">
          <header>
            <h3 id="bookings">Your bookings</h3>
          </header>
          <table v-if="bookings.length > 0" class="underheader-lines">
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
                <td><RouterLink :to="'/advert/' + booking.advert_id">{{ booking.title }}</RouterLink></td>
                <td>{{ formatTimestamp(booking.booking_date) }}</td>
                <td>{{ booking.price }}</td>
                <td>{{ convertCoinsToTime(booking.price) }}</td>
                <td>
                  <button @click="deleteBooking(booking.id, booking.advert_id, booking.price, booking.isRequest)">Cancel</button>
                </td>
              </tr>
            </tbody>
          </table>
          <p v-else>You dont have any booking yet</p>
        </section>

        <section v-if="isOwnProfile" class="services">
          <header>
            <h3 id="services">Pending services</h3>
          </header>
          <table v-if="services.length > 0" class="underheader-lines">
            <thead>
              <tr>
                <th>Advert title</th>
                <th>Subscribed User</th>
                <th>Date</th>
                <th>TCs</th>
                <th>Duration</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="service in services" :key="service.id">
                <td><RouterLink :to="'/advert/' + service.advert_id">{{ service.title }}</RouterLink></td>
                <td>{{ service.user_name }}</td>
                <td>{{ formatTimestamp(service.booking_date) }}</td>
                <td>{{ service.price }}</td>
                <td>{{ convertCoinsToTime(service.price) }}</td>
              </tr>
            </tbody>
          </table>
          <p v-else>Nobody has booked any of your adverts :_(</p>
        </section>
      </section>
    </div>
    <section v-else class="update-profile-form">
      <UpdateUserProfileForm @user-update-success="userUpdateSuccess" />
      <button type="button" class="cancel-btn" @click="toggleEditProfile">Cancel</button>
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
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
  margin-left: auto;
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

.buttons {
  display: flex;
  gap: 2rem;
  margin-top: 2rem;
}

.adverts,
.bookings,
.services {
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

button {
  padding: .5rem 1.25rem;
  width: fit-content;
  background-color: rgba(255 255 255 / .1);
  border: 1px solid var(--color-border-hover);
  border-radius: 6px;
  transition: filter .2s ease-in-out;
}

button:hover {
  cursor: pointer;
}

button.edit-btn {
  background-color: rgba(50 110 210 / 0.1);
  border: 1px solid rgb(50, 110, 210);
  color: rgb(50, 110, 210);
}

button.edit-btn:hover {
  filter: brightness(1.25) drop-shadow(0 0 15px rgba(55, 130, 255, .25));
}

button.delete-btn {
  background-color: rgba(210 50 50 / 0.1);
  border: 1px solid rgb(210, 50, 50);
  color: rgb(210, 50, 50);
}

button.delete-btn:hover,
button.cancel-btn:hover {
  filter: brightness(1.25) drop-shadow(0 0 15px rgba(255, 50, 50, 0.3));
}

button.cancel-btn {
  margin-top: 1.25rem;
  background-color: rgba(210 50 50 / 0.05);
  border: 1px solid rgb(210 50 50 / .5);
}
</style>