<template>
    <div>
        <select v-model="selectedField" @change="loadForm">
            <option disabled value="">Which field do you want to modify?</option>
            <option value="title">Title</option>
            <option value="description">Description</option>
            <option value="image">Image</option>
            <option value="loc_name">Location</option>
            <option value="max_subscribers">Max Subscriptions</option>
            <option value="tags">Tags</option>
        </select>

        <div v-if="selectedField">
            <form @submit.prevent="updateAdvert">
                <div v-if="selectedField === 'title'">
                    <label for="title">New title:</label>
                    <input type="text" v-model="formData.title" />
                </div>

                <div v-if="selectedField === 'description'">
                    <label for="description">New description:</label>
                    <input type="text" v-model="formData.description" />
                </div>

                <div v-if="selectedField === 'loc_name'">
                    <label for="loc_name">New location:</label>
                    <MapComp @mapDataUpdate="saveMapData" />
                </div>

                <div v-if="selectedField === 'image'">
                    <label for="image">New image:</label>
                    <input type="file" @change="handleImageUpload" />
                    <div v-if="imagePreview">
                        <h4>Image Preview:</h4>
                        <img :src="imagePreview" alt="Image Preview" style="max-width: 300px; max-height: 300px;" />
                    </div>
                </div>

                <div v-if="selectedField === 'max_subscribers'">
                    <label for="max_subscribers">New number of subscribers:</label>
                    <input type="number" v-model="formData.max_subscribers" />
                </div>

                <div v-if="selectedField === 'tags'">
                    <label for="tags">Tags:</label>
                    <select v-model="formData.tags" multiple>
                        <option v-for="tag in tags" :key="tag.id" :value="tag.id">{{ tag.name }}</option>
                    </select>
                </div>

                <button type="submit">Guardar</button>
            </form>
        </div>
    </div>
</template>

<script>
import { RouterLink } from 'vue-router';
import MapComp from '@/components/MapComp.vue';

export default {
    name: 'UpdateAdvert',
    props: {
        advertId: {
            type: String,
            default: '0'
        }
    },
    components: {
        RouterLink,
        MapComp
    },
    data() {
        return {
            selectedField: '',
            fieldName: '',
            formData: {
                title: '',
                description: '',
                loc_name: '',
                image: '',
                max_subscribers: 0,
                tags: [],
                loc_latitude: null,
                loc_longitude: null
            },
            tags: [],
            imageFile: null,
            imagePreview: ''
        };
    },
    methods: {
        loadForm() {
            this.fieldName = this.selectedField.charAt(0).toUpperCase() + this.selectedField.slice(1);
        },
        handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.imageFile = file;
                this.imagePreview = URL.createObjectURL(file);
            }
        },
        async updateAdvert() {
            const formData = new FormData();
            formData.append('title', this.formData.title);
            formData.append('description', this.formData.description);
            formData.append('loc_name', this.formData.loc_name);
            formData.append('loc_latitude', this.formData.loc_latitude);
            formData.append('loc_longitude', this.formData.loc_longitude);
            formData.append('max_subscribers', this.formData.max_subscribers);
            formData.append('tags', JSON.stringify(this.formData.tags));

            if (this.imageFile) {
                formData.append('image', this.imageFile);
            }

            try {
                const response = await fetch(`http://localhost/itb-proyecto-final/api/index.php/advert/${this.advertId}`, {
                    method: 'PUT',
                    body: formData
                });
                const result = await response.json();
                if (result.status === 'success') {
                    alert('Anuncio actualizado con éxito');
                } else {
                    alert('Error al actualizar el anuncio');
                }
            } catch (error) {
                alert('Error al actualizar el anuncio');
            }
        },
        async getTags() {
            try {
                const response = await fetch('http://localhost/itb-proyecto-final/api/index.php/tag');
                const result = await response.json();
                this.tags = result.data;
            } catch (error) {
                console.error('Error:', error);
            }
        },
        saveMapData(data) {
            this.formData.loc_name = data.name;
            this.formData.loc_latitude = data.latitude;
            this.formData.loc_longitude = data.longitude;
        }
    },
    mounted() {
        this.getTags();
    }
}
</script>

<style scoped>
h2 {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-block: 1rem;
    color: var(--color-heading);
    font-size: 2rem;
    font-weight: 500;
}

form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

label {
    font-weight: bold;
    color: var(--color-heading);
}

input[type="text"],
input[type="number"],
select {
    padding: 0.5rem;
    border: 1px solid var(--color-border);
    border-radius: 4px;
    width: 50%;
}

button {
    padding: 0.75rem 1.5rem;
    background-color: var(--color-primary);
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
}

button {
    width: fit-content;
    background-color: #007bff;
    border: none;
    padding: .65rem 1.25rem;
    border-radius: 6px;
}

div {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
</style>
