<script>
import { IconBackspace } from '@tabler/icons-vue'
import { convertTimeToCoins, formatTimestamp, validateSession } from '@/helpers';
import CalendarInput from '@/components/CalendarInput.vue'
import MapComp from '@/components/MapComp.vue'

export default {
  name: 'NewAdvertForm',
  components: {
    IconBackspace,
    CalendarInput,
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
        availability: '',
        loc_name: '',
        loc_latitude: 0,
        loc_longitude: 0,
        max_subscribers: 0,
        publish_date: '',
        tags: []
      },

      availability: new Set(),
      advertDuration: null,

      // Creo los arrays para almacenar las listas de categorías y tags
      categories: [],
      tags: []
    }
  },

  watch: {
      advertDuration(newData) {
        this.formData.price = convertTimeToCoins(newData)
      }
    },

  methods: {
    // Función para obtener categorías desde la API
    async getCategories() {
      try {
        const res = await fetch('http://itb-api.us-east-1.elasticbeanstalk.com/index.php/category')
        if (res.ok) {
          this.categories = await res.json()
          // console.log('Categories:', this.categories)
        } else {
          console.error('Failed to fetch categories.')
        }
      } catch (e) {
        console.error('Error fetching data:', e)
      }
    },

    // Función para obtener etiquetas desde la API
    async getTags() {
      try {
        const res = await fetch('http://itb-api.us-east-1.elasticbeanstalk.com/index.php/tag')
        if (res.ok) {
          this.tags = await res.json()
          // console.log('Tags:', this.tags)
        } else {
          console.error('Failed to fetch tags.')
        }
      } catch (e) {
        console.error('Error fetching data:', e)
      }
    },

    // Función para añadir los inputs de disponibilidad, provenientes del componente CalendarInput, creados por el usuario al array de 'availability'
    updateCalendarData(data) {
      this.availability.add(data)
    },

    removeAvailableDate(timestamp) {
      this.availability.delete(timestamp)
    },

    formatTimestamp,

    // Función que se ejecuta cuando el componente MapComp lanza el evento 'map-data-update'
    saveMapData(data) {
      this.formData.loc_name = data.name
      this.formData.loc_latitude = data.latitude
      this.formData.loc_longitude = data.longitude
    },

    // Función para enviar el formulario
    async submitForm() {
      const authInfo = validateSession()
      if (!authInfo) return console.error('authInfo not found in localStorage.')
      if (!authInfo.id) return console.error('User ID not found in localStorage.')

      this.formData.owner_id = authInfo.id

      this.formData.availability = Array.from(this.availability).toString()

      const now = new Date()
      this.formData.publish_date = now.valueOf()

      console.log(this.formData)

      try {
        const res = await fetch('http://itb-api.us-east-1.elasticbeanstalk.com/index.php/advert', {
          method: 'POST',
          header: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(this.formData)
        })

        const data = await res.json()

        if (data.status === 'success') {
          this.$router.push(`/advert/${data.advert_id}`)
        } else {
          alert('Error creating advert.')
        }
      } catch (error) {
        console.error('Error submitting form:', error)
        alert('Error creating advert.')
      }
    }
  },

  // Esta función se encarga de cargar los datos iniciales, como la creación de las listas de categorias y tags
  async mounted() {
    await this.getTags()
    await this.getCategories()
  }
}
</script>

<template>
  <form @submit.prevent="submitForm">
    <div class="input-group">
      <label for="title">
        <span>Title</span>
        <input type="text" v-model="formData.title" required />
      </label>

      <label for="image">
        <span>Image URL</span>
        <input type="text" v-model="formData.image" />
      </label>
    </div>

    <label for="description">
      <span>Description</span>
      <textarea v-model="formData.description" required></textarea>
    </label>

    <div class="input-group">
      <label for="isRequest">
        <span>Type of advert</span>
        <select v-model="formData.isRequest" required>
          <option :value="0">Offer</option>
          <option :value="1">Request</option>
        </select>
      </label>

      <label for="category">
        <span>Category</span>
        <select v-model="formData.category_id" required>
          <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
        </select>
      </label>
    </div>

    <div class="input-group">
      <label for="price">
        <span>Duration of the activity</span>
        <input type="time" v-model="advertDuration" required />
      </label>

      <label for="max_subscribers">
        <span>Maximum subscribers</span>
        <input type="number" v-model="formData.max_subscribers" min="1" required />
      </label>
    </div>

    <div class="input-group">
      <label>
        <span>Availability</span>
        <div class="calendar-content">
          <CalendarInput @availability-data-update="updateCalendarData" />
          <div>
            <span class="bold">Selected dates</span>
            <ol>
              <li v-for="(date, index) in availability" :key="index" class="selected-date">
                {{ formatTimestamp(date) }}
                <IconBackspace size="22" class="del-btn" @click="removeAvailableDate(date)" />
              </li>
            </ol>
          </div>
        </div>
      </label>

      <label for="tags">
        <span>Tags</span>
        <select v-model="formData.tags" multiple>
          <option v-for="tag in tags" :key="tag.id" :value="tag">{{ tag.name }}</option>
        </select>
      </label>
    </div>

    <div class="form-group">
      <label>
        <span>Location</span>
        <input hidden v-model="formData.loc_name" />
        <input hidden v-model="formData.loc_latitude" />
        <input hidden v-model="formData.loc_longitude" />
      </label>
      <MapComp @map-data-update="saveMapData" />
    </div>

    <button type="submit">Submit</button>
  </form>
</template>

<style scoped>
form,
form label {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  width: 100%;
}

form label {
  gap: .25rem;
}

form input,
textarea,
select {
  padding: .5rem .75rem;
  background-color: rgba(255 255 255 / .1);
  border: 1px solid var(--color-border-hover);
  border-radius: 6px;
}

option {
  padding: .25rem .5rem;
}

select:not([multiple]) option {
  background-color: rgba(50 50 50);
}

textarea {
  max-width: 1200px;
  max-height: 500px;
  height: 5rem;
}

form button {
  padding: .5rem 1.25rem;
  width: fit-content;
  background-color: rgba(255 255 255 / .1);
  border: 1px solid var(--color-border-hover);
  border-radius: 6px;
  transition: background-color .2s ease-in-out;
}

form button:hover {
  cursor: pointer;
  background-color: var(--color-border-hover);
}

.input-group {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 2.5rem;
}

.calendar-content {
  display: flex;
  gap: 2rem;
}

.calendar-content ol {
  display: flex;
  flex-direction: column;
  gap: .2rem;
  list-style: none;
}

.selected-date {
  display: flex;
  align-items: center;
  gap: .5rem;
}

.selected-date .del-btn:hover {
  cursor: pointer;
}

#map {
  width: 100%;
  height: 400px;
  margin-top: 1rem;
}

.bold {
  font-weight: 600;
  color: var(--color-text-bright);
}
</style>
