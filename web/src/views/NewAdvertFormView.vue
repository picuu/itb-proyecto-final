<script>
import LayoutSection from '@/sections/LayoutSection.vue'
import HeaderComponent from '../components/HeaderComponent.vue'
import { IconCalendar } from '@tabler/icons-vue';
import MapComp from '@/components/MapComp.vue';

export default {
  name: 'new-advert-form',
  components: {
    LayoutSection,
    HeaderComponent,
    IconCalendar,
    MapComp
  },

  data() {
    // En esta función defino los datos que ha de recoger el formulario
    return {
      formData: {
        owner_id: null,
        category_id: '',
        title: '',
        image: '',
        description: '',
        isRequest: 0,
        price: 0,
        availability: [''],
        loc_name: '',
        loc_latitude: 0,
        loc_longitude: 0,
        max_subscribers: 0,
        publish_date: '',
        tags: []
      },

      // Creo los arrays para almacenar las listas de categorías y tags
      categories: [],
      tags: []
    }
  },

  methods: {
    // Función para obtener categorías y etiquetas desde la API
    async fetchData() {
      try {
        const categoriesResponse = await fetch('http://localhost/itb-proyecto-final/api/index.php/category');
        if (categoriesResponse.ok) {
          this.categories = await categoriesResponse.json();
          console.log('Categories:', this.categories);
        } else {
          console.error('Failed to fetch categories.');
        }
        const tagsResponse = await fetch('http://localhost/itb-proyecto-final/api/index.php/tag');
        if (tagsResponse.ok) {
          this.tags = await tagsResponse.json();
          console.log('Tags:', this.tags);
        } else {
          console.error('Failed to fetch tags.');
        }
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    },

    // Función que se ejecuta cuando el componente MapComp lanza el evento 'map-data-update'
    saveMapData(data) {
      this.formData.loc_name = data.name
      this.formData.loc_latitude = data.latitude
      this.formData.loc_longitude = data.longitude
    },

    // Función para añadir los inputs de disponibilidad creados por el usuario al array de 'availability'
    addAvailability() {
      this.formData.availability.push('');
    },
    // Función para enviar el formulario
    async submitForm() {
      const authInfo_json = localStorage.getItem('authInfo');
      if (!authInfo_json) {
        console.error('authInfo not found in localStorage.');
        return;
      }
      const authInfo = JSON.parse(authInfo_json);
      if (!authInfo.id) {
        console.error('User ID not found in localStorage.');
        return;
      }
      this.formData.owner_id = authInfo.id;

      const now = new Date();
      this.formData.publish_date = now.toISOString();

      const data = new FormData();
      for (const key in this.formData) {
        if (Array.isArray(this.formData[key])) {
          this.formData[key].forEach((item, index) => {
            data.append(`${key}[${index}]`, item);
          });
        } else {
          data.append(key, this.formData[key]);
        }
      }

      try {
        const response = await fetch('http://localhost/itb-proyecto-final/api/index.php/advert', {
          method: 'POST',
          body: data
        });
        const result = await response.json();
        if (result.status === 'success') {
          alert('Advert created successfully!');
        } else {
          alert('Error creating advert.');
        }
      } catch (error) {
        console.error('Error submitting form:', error);
        alert('Error creating advert.');
      }
    }
  },

  // Esta función se encarga de cargar los datos iniciales, como la creación de las listas de categorias y tags
  async mounted() {
    await this.fetchData();
  }
};
</script>

<template>
  <div>
    <HeaderComponent />
    <main class="content-grid">
      <LayoutSection>
        <h1>Post a new advert</h1>
        <form @submit.prevent="submitForm">
          <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" v-model="formData.title" required />
          </div>

          <div class="form-group">
            <label for="image">Image URL:</label>
            <input type="text" v-model="formData.image" />
          </div>


          <div class="form-group">
            <label for="description">Description:</label>
            <textarea v-model="formData.description" required></textarea>
          </div>

          <div class="form-group">
            <label for="isRequest">Type of advert:</label>
            <select v-model="formData.isRequest" required>
              <option :value="0">Offer</option>
              <option :value="1">Request</option>
            </select>
          </div>

          <div class="form-group">
            <label for="category">Category:</label>
            <select v-model="formData.category_id" required>
              <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}
              </option>
            </select>
          </div>

          <div class="form-group">
            <label>Tags:</label>
            <div v-for="tag in tags" :key="tag.id">
              <input type="checkbox" :value="tag.id" v-model="formData.tags">
              <label>{{ tag.name }}</label>
            </div>
          </div>

          <div class="form-group">
            <label for="price">Cost in TCs:</label>
            <input type="number" v-model="formData.price" required />
          </div>

          <div class="form-group">
            <label>Your availability:</label>
            <div v-for="(avail, index) in formData.availability" :key="index" class="mb-2">
              <VDatePicker v-model="formData.availability[index]" mode="dateTime" is24hr :popover="false">
                <template #default="{ togglePopover, inputValue, inputEvents }">
                  <div class="flex rounded-lg border border-gray-300 dark:border-gray-600 overflow-hidden">
                    <button
                      class="flex justify-center items-center px-2 bg-accent-100 hover:bg-accent-200 text-accent-700 border-r border-gray-300 dark:bg-gray-700 dark:text-accent-300 dark:border-gray-600 dark:hover:bg-gray-600"
                      @click="togglePopover">
                      <IconCalendar size="36" />
                    </button>
                    <input :value="inputValue" v-on="inputEvents"
                      class="flex-grow px-2 py-1 bg-white dark:bg-gray-700" />
                  </div>
                </template>
              </VDatePicker>
            </div>
            <button type="button" @click="addAvailability">Add Availability</button>
          </div>

          <div class="form-group">
            <label>Location:</label>
            <input v-model="formData.loc_name" />
            <input v-model="formData.loc_latitude" />
            <input v-model="formData.loc_longitude" />
            <MapComp @map-data-update="saveMapData" />
          </div>

          <div class="form-group">
            <label for="max_subscribers">Maximum subscribers:</label>
            <input type="number" v-model="formData.max_subscribers" required />
          </div>
          <button type="submit">Submit</button>
        </form>
      </LayoutSection>
    </main>
  </div>
</template>

<style scoped>
h1 {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-block: 2rem;
  color: var(--color-heading);
  font-size: 2rem;
  font-weight: 500;
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
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  background-color: var(--color-accent);
  color: #fff;
  border: none;
  padding: 0.75rem 1.5rem;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: var(--color-accent-dark);
}

#map {
  width: 100%;
  height: 400px;
  margin-top: 1rem;
}
</style>
