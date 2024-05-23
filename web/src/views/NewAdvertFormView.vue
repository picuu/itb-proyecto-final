<template>
    <div>
        <form @submit.prevent="submitForm">
            <label>Title:</label>
            <input type="text" v-model="formData.title" required>

            <label>Image URL:</label>
            <input type="text" v-model="formData.image" required>

            <label>Description:</label>
            <textarea v-model="formData.description" required></textarea>

            <label>Type of advert:</label>
            <select v-model="formData.isRequest">
                <option :value="0">Offer</option>
                <option :value="1">Request</option>
            </select>

            <label>Category:</label>
            <select v-model="formData.category_id" required>
                <option value="">Select category</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}
                </option>
            </select>

            <label>Cost in TC's:</label>
            <input type="number" v-model="formData.price" required>

            <label>Your availability:</label>
            <v-date-picker v-model="selectedDate" @input="updateAvailability" range scrollable
                show-current></v-date-picker>
            <v-time-picker v-model="selectedTime" @input="updateAvailability" format="24hr" min="00:00"
                max="23:59"></v-time-picker>

            <label for="location">Location:</label>
            <input type="text" id="location" v-model="loc_name">
            <div id="map"></div>

            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                title: '',
                image: '',
                description: '',
                category_id: '',
                isRequest: 0,
                price: 0,
                selectedDate: null,
                selectedTime: null,
                availability: {},
                loc_name: '',
                loc_latitude: 0,
                loc_longitude: 0,
                map: null,
                marker: null
            },
            // Propiedad con un array para almacenar la lista de categorías obtenidas de la API que se ha de mostrar en el desplegable.
            categories: [],
            // Propiedad para almacenar la categoría seleccionada por el usuario
            selectedCategory: ''
        };
    },
    mounted() {
        // Inicializar el mapa
        this.initMap();
    },
    methods: {
        initMap() {
            // Crear mapa
            this.map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 40.73061, lng: -73.935242 },
                zoom: 8
            });

            // Escuchar eventos de clic en el mapa
            this.map.addListener('click', (event) => {
                this.handleMapClick(event.latLng);
            });
        },
        handleMapClick(latLng) {
            // Actualizar la posición del marcador
            if (!this.marker) {
                this.marker = new google.maps.Marker({
                    position: latLng,
                    map: this.map,
                    draggable: true
                });
            } else {
                this.marker.setPosition(latLng);
            }

            // Actualizar las coordenadas
            this.loc_latitude = latLng.lat();
            this.loc_longitude = latLng.lng();

            // Obtener el nombre de la ubicación (podrías utilizar la API de geocodificación inversa aquí)
            // En este ejemplo, simplemente se muestra una alerta con las coordenadas
            alert(`Selected location: Lat ${this.loc_latitude}, Lng ${this.loc_longitude}`);
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
                const response = await fetch('http://localhost/itb-proyecto-final/api/index.php/advert', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(this.formData)
                });

                if (response.ok) {
                    console.log('Advert created successfully!');
                    this.resetForm();
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
            if (!this.availability[day]) {
                this.$set(this.availability, day, []);
            }
            if (!this.availability[day].includes(time)) {
                this.availability[day].push(time);
            }
        },
        resetForm() {
            // Reiniciar los valores del formulario después de enviarlos
            this.formData.title = '';
            this.formData.description = '';
            this.formData.image = '';
            // Reiniciar más campos si es necesario
        },
        created() {
            this.fetchCategories();
        }
    }
};
</script>

<style scoped>
#map {
    height: 400px;
}
</style>