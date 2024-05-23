<template>
  <div class="advert-form">
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" id="title" v-model="formData.title" required>
      </div>

      <div class="form-group">
        <label for="image">Image URL:</label>
        <input type="text" id="image" v-model="formData.image" required>
      </div>

      <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" v-model="formData.description" required></textarea>
      </div>

      <div class="form-group">
        <label for="type">Type of advert:</label>
        <select id="type" v-model="formData.isRequest">
          <option :value="0">Offer</option>
          <option :value="1">Request</option>
        </select>
      </div>

      <div class="form-group">
        <label for="category">Category:</label>
        <select id="category" v-model="formData.category_id" required>
          <option value="">Select category</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
        </select>
      </div>

      <div class="form-group">
        <label for="price">Cost in TC's:</label>
        <input type="number" id="price" v-model="formData.price" required>
      </div>

      <div class="form-group">
        <label>Your availability:</label>
        <v-date-picker v-model="selectedDate" @input="updateAvailability" range scrollable show-current></v-date-picker>
        <v-time-picker v-model="selectedTime" @input="updateAvailability" format="24hr" min="00:00"
          max="23:59"></v-time-picker>
      </div>

      <div class="form-group">
        <label for="location">Location:</label>
        <input type="text" id="location" v-model="formData.loc_name">
        <div id="map" class="map-container"></div>
      </div>

      <div class="form-group">
        <label for="max_subscribers">Maximum subscribers:</label>
        <input type="number" id="max_subscribers" v-model="formData.max_subscribers">
      </div>

      <button type="submit">Submit</button>
    </form>
  </div>
</template>

<script>
import L from 'leaflet';

export default {
  data() {
    return {
      formData: {
        owner_id: null,
        title: '',
        image: '',
        description: '',
        category_id: '',
        isRequest: 0,
        price: 0,
        selectedDate: new Date(),
        selectedTime: null,
        availability: {},
        loc_name: '',
        loc_latitude: 0,
        loc_longitude: 0,
        max_subscribers: 0,
        publish_date: null
      },
      categories: [],
      selectedCategory: '',
      map: null,
      marker: null
    };
  },
  mounted() {
    this.initMap();
  },
  methods: {
    initMap() {
      this.map = L.map('map').setView([40.73061, -73.935242], 8);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(this.map);
      this.map.on('click', (event) => {
        this.handleMapClick(event.latlng);
      });
    },
    handleMapClick(latLng) {
      if (!this.marker) {
        this.marker = L.marker(latLng, { draggable: true }).addTo(this.map);
      } else {
        this.marker.setLatLng(latLng);
      }
      this.formData.loc_name = '';
      this.formData.loc_latitude = latLng.lat;
      this.formData.loc_longitude = latLng.lng;
      alert(`Selected location: Lat ${this.formData.loc_latitude}, Lng ${this.formData.loc_longitude}`);
    },
    async fetchCategories() {
      try {
        const response = await fetch('http://localhost/itb-proyecto-final/api/index.php/category');
        if (response.ok) {
          this.categories = await response.json();
        } else {
          console.error('Failed to fetch categories.');
        }
      } catch (error) {
        console.error('Error:', error);
      }
    },
    async submitForm() {
      try {
        const userId = localStorage.getItem('id');
        if (!userId) {
          console.error('User ID not found in localStorage.');
          return;
        }
        this.formData.owner_id = userId;

        const currentDate = new Date();
        const formattedDate = currentDate.toISOString();
        this.formData.publish_date = formattedDate;

        const response = await fetch('http://localhost/itb-proyecto-final/api/index.php/advert', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.formData)
        });

        if (response.ok) {
          console.log('Advert created successfully!');
        } else {
          console.error('Failed to create advert.');
        }
      } catch (error) {
        console.error('Error:', error);
      }
    },
    updateAvailability() {
      if (!this.selectedDate || !this.selectedTime) return;
      const day = this.selectedDate.toDateString();
      const time = this.selectedTime;
      if (!this.formData.availability[day]) {
        this.$set(this.formData.availability, day, []);
      }
      if (!this.formData.availability[day].includes(time)) {
        this.formData.availability[day].push(time);
      }
    }
  },
  created() {
    this.fetchCategories();
  }
};
</script>

<style>
.advert-form {
  max-width: 800px;
  margin: 0 auto;
}

.form-group {
  margin-bottom: 1.5rem;
}

label {
  display: block;
  margin-bottom: 0.5rem;
}

input[type="text"],
input[type="number"],
textarea,
select {
  width: 100%;
  padding: 0.75rem;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.map-container {
  height: 300px;
  width: auto;
}

button {
  padding: 0.75rem 1.5rem;
  font-size: 1rem;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
</style>