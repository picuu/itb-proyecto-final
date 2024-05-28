<template>
    <div>
        <h2>Modificar Anuncio</h2>
        <select v-model="selectedField" @change="loadForm">
            <option disabled value="">Choose an option to modify:</option>
            <option value="title">Title</option>
            <option value="description">Description</option>
            <option value="image">Image</option>
            <option value="loc_name">Location</option>
            <option value="max_subscription">Max. Subscriptions</option>
            <option value="tags">Tags</option>
        </select>

        <div v-if="selectedField">
            <h3>Modificar {{ fieldName }}</h3>
            <form @submit.prevent="updateAdvert">
                <div v-if="selectedField === 'title'">
                    <label for="title">Título:</label>
                    <input type="text" v-model="formData.title" />
                </div>

                <div v-if="selectedField === 'description'">
                    <label for="description">Description:</label>
                    <input type="text" v-model="formData.description" />
                </div>

                <div v-if="selectedField === 'loc_name'">
                    <label for="loc_name">Location:</label>
                    <input type="text" v-model="formData.loc_name" />
                </div>

                <div v-if="selectedField === 'image'">
                    <label for="image">Image:</label>
                    <input type="text" v-model="formData.image" />
                </div>

                <div v-if="selectedField === 'max_subscription'">
                    <label for="max_subscription">Max subscribers</label>
                    <input type="number" v-model="formData.max_subscribers" />
                </div>

                <div v-if="selectedField === 'tags'">
                    <!-- Desplegable con los tags que hay en la bd -->
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
export default {
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
                tags: []
            }
        };
    },
    methods: {
        loadForm() {
            this.fieldName = this.selectedField.charAt(0).toUpperCase() + this.selectedField.slice(1);
        },
        async updateAdvert() {
            try {
                const response = await fetch(`http://localhost/itb-proyecto-final/api/index.php/advert${this.advertId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(this.formData)
                });
                const result = await response.json();
                if (result.status === 'success') {
                    alert('Anuncio actualizado con éxito');
                } else {
                    alert('Error al actualizar el anuncio');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error al actualizar el anuncio');
            }
        }
    },
    async created() {
        try {
            const response = await fetch(`http://localhost/itb-proyecto-final/api/index.php/advert${this.advertId}`);
            const advert = await response.json();
            this.formData.title = advert.title;
            this.formData.description = advert.description;
            this.formData.loc_name = advert.loc_name;
            this.formData.image = advert.image;
            this.formData.max_subscribers = advert.max_subscribers;
            this.formData.tags = advert.tags;
            } catch (error) {
            console.error('Error:', error);
            alert('Error al cargar el anuncio');
        }
    }
};
</script>