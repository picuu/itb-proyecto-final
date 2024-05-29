<template>
    <div class="content">
        <select v-model="selectedField" @change="loadForm">
            <option disabled value="">Which field do you want to modify?</option>
            <option value="title">Title</option>
            <option value="description">Description</option>
            <option value="image">Image</option>
            <option value="category">Category</option>
            <option value="tags">Tags</option>
            <option value="duration">Duration</option>
            <option value="max_subscribers">Max Subscriptions</option>
            <option value="loc_name">Location</option>
            <option value="avaliability">Avaliability</option>
        </select>

        <template v-if="selectedField">
            <form @submit.prevent="updateAdvert">
                <div class="input-group" v-if="selectedField === 'title'">
                    <label for="title">New title:</label>
                    <input type="text" v-model="advert.title" />
                </div>

                <div class="input-group" v-if="selectedField === 'description'">
                    <label for="description">New description:</label>
                    <textarea v-model="advert.description" />
                </div>

                <div class="input-group" v-if="selectedField === 'image'">
                    <label for="image">New image:</label>
                    <input type="text" v-model="advert.image" />
                    <div v-if="advert.image && advert.image != '' && advert.image != 'null'">
                        <h4>Image Preview:</h4>
                        <img :src="getAdvertImagePath" alt="Image Preview"
                            style="max-width: 300px; max-height: 300px" />
                    </div>
                </div>

                <div class="input-group" v-if="selectedField === 'category'">
                    <label for="categories">Categories:</label>
                    <select v-model="advert.category">
                        <option v-for="category in categoryList" :key="category.id" :value="category">{{ category.name
                            }}</option>
                    </select>
                </div>

                <div class="input-group" v-if="selectedField === 'tags'">
                    <label for="tags">Tags:</label>
                    <select v-model="advert.tags" multiple>
                        <option v-for="tag in tagList" :key="tag.id" :value="tag">{{ tag.name }}</option>
                    </select>
                </div>

                <div class="input-group" v-if="selectedField === 'duration'">
                    <label for="duration">Duration of the activity:</label>
                    <input type="time" v-model="advertDurationTime" />
                </div>

                <div class="input-group" v-if="selectedField === 'max_subscribers'">
                    <label for="max_subscribers">New number of subscribers:</label>
                    <input type="number" v-model="advert.max_subscribers" min="1" />
                </div>

                <div class="input-group" v-if="selectedField === 'loc_name'">
                    <label for="loc_name">New location:</label>
                    <MapComp :lat="advert.loc_latitude" :lng="advert.loc_longitude" @mapDataUpdate="saveMapData" />
                </div>

                <div class="input-group" v-if="selectedField === 'avaliability'">
                    <label>Availability</label>
                    <div class="calendar">
                        <CalendarInput @availability-data-update="updateCalendarData" />
                        <div>
                            <span class="bold">Selected dates</span>
                            <ol>
                                <li v-for="(date, index) in availabilitySet" :key="index" class="selected-date">
                                    {{ formatTimestamp(date) }}
                                    <IconBackspace size="22" class="del-btn" @click="removeAvailableDate(date)" />
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <button type="submit">Guardar</button>
            </form>
        </template>
    </div>
</template>

<script>
import { advert } from '@/types'
import { convertTimeToCoins, convertCoinsToTime, formatTime, formatTimestamp } from '@/helpers';
import { IconBackspace } from '@tabler/icons-vue'
import MapComp from '@/components/MapComp.vue'
import CalendarInput from './CalendarInput.vue'

export default {
    name: 'UpdateAdvert',
    props: {
        advertId: { type: String, default: '0' }
    },
    components: {
        IconBackspace,
        MapComp,
        CalendarInput
    },

    data() {
        return {
            advert,
            selectedField: '',
            tagList: [],
            categoryList: [],
            advertDurationTime: '00:00',
            availabilitySet: new Set()
        }
    },

    watch: {
        advertDurationTime(newData) {
            this.advert.price = convertTimeToCoins(newData)
        }
    },

    methods: {
        formatTimestamp,

        async getAdvert() {
            try {
                const res = await fetch(`http://localhost/itb-proyecto-final/api/index.php/advert/${this.advertId}`)
                const data = await res.json()
                this.advert = data
                this.advertDurationTime = formatTime(convertCoinsToTime(data.price))
                this.availabilitySet = new Set(data.availability.split(","))
                if (Array.from(this.availabilitySet.keys())[0].length == 0) this.availabilitySet.clear()
            } catch (error) {
                console.error('Error fetching the advert:', error)
            }
        },

        async getTags() {
            try {
                const res = await fetch(`http://localhost/itb-proyecto-final/api/index.php/tag`)
                const data = await res.json()
                this.tagList = data
            } catch (error) {
                console.error('Error fetching the tag list:', error)
            }
        },

        async getCategories() {
            try {
                const res = await fetch('http://localhost/itb-proyecto-final/api/index.php/category')
                const data = await res.json()
                this.categoryList = data
            } catch (e) {
                console.error('Error fetching categories:', e)
            }
        },

        saveMapData(data) {
            this.advert.loc_name = data.name
            this.advert.loc_latitude = data.latitude
            this.advert.loc_longitude = data.longitude
        },

        updateCalendarData(data) {
            this.availabilitySet.add(data)
        },

        removeAvailableDate(timestamp) {
            this.availabilitySet.delete(timestamp)
        },

        async updateAdvert() {
            this.advert.availability = Array.from(this.availabilitySet).toString()

            // console.log(this.advert)

            try {
                const res = await fetch(`http://localhost/itb-proyecto-final/api/index.php/advert/${this.advertId}`, {
                    method: 'PUT',
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(this.advert)
                })

                const data = await res.json()

                if (data && data.status && data.status == 'success') {
                    this.$router.push(`/advert/${this.advertId}`)
                } else {
                    alert('Error al actualizar el anuncio')
                }
            } catch (error) {
                console.error('Error fetching data:', error)
            }
        }
    },

    computed: {
        getAdvertImagePath() {
            if (this.advert.image == "default.webp") return "/" + this.advert.image
            return this.advert.image
        }
    },

    mounted() {
        this.getAdvert()
        this.getCategories()
        this.getTags()
    }
}
</script>

<style scoped>
.content,
form,
.input-group {
    display: flex;
    flex-direction: column;
}

.content {
    gap: 2rem;
}

form {
    gap: 1rem;
}

div {
    gap: .25rem;
}

label {
    font-weight: bold;
    color: var(--color-heading);
}

input,
select,
textarea {
    width: min(100%, 500px);
    padding: .5rem .75rem;
    background-color: rgba(255 255 255 / .1);
    border: 1px solid var(--color-border-hover);
    border-radius: 6px;
}

option {
    background-color: #121212;
}

textarea {
    max-width: 800px;
    max-height: 300px;
    height: 150px;
}

button {
    width: fit-content;
    padding: 0.65rem 1.25rem;
    background-color: #007bff;
    border: none;
    border-radius: 6px;
    font-size: 1rem;
    transition: opacity .2s ease-in-out;
}

button:hover {
    cursor: pointer;
    opacity: .8;
}

.calendar {
    display: flex;
    gap: 2rem;
}

.calendar ol {
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

.bold {
    font-weight: 600;
    color: var(--color-text-bright);
}
</style>
