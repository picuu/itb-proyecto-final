<script>
import { advert } from '@/types'

export default {
    name: 'AdvertAdminList',
    components: {},
    data() {
        return {
            adverts: Array(advert),
            userId: null,
            showUpdateForm: false,
            selectedAdvert: advert
        }
    },

    methods: {
        async getAdverts() {
            try {
                const res = await fetch('http://localhost/itb-proyecto-final/api/index.php/advert')
                const data = await res.json()
                this.adverts = data
            } catch (e) {
                console.error("Error fetching adverts:", e)
            }
        },

        async deleteAdvert(){
            try {
                const res = await fetch(`http://localhost/itb-proyecto-final/api/index.php/advert/${this.advertId}`, {
                    method: 'DELETE'
                })
                const data = await res.json()

                if (data && data.status && data.status == "success") {
                    this.adverts = this.adverts.filter(advert => advert.id !== this.advertId)
                }
            } catch (e) {
                console.error("Error deleting advert:", e)
            }
        },
        

        getAdvertType(type) {
            if (type == 1) return "Request"
            return "Offer"
        },

        toggleUpdateForm(id) {
            this.showUpdateForm = !this.showUpdateForm
            this.selectedAdvert = this.getAdvert(id)
        }
    },
    created() {
        this.getAdverts()
    }
}
</script>

<template>
    <div>
        <template v-if="!showUpdateForm">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="advert in adverts" :key="advert.id">
                        <td data-label="Id">{{ advert.id }}</td>
                        <td data-label="Title">{{ advert.title }}</td>
                        <td data-label="Type">{{ getAdvertType(advert.type) }}</td>
                        <td data-label="Price">{{ advert.price }}</td>
                        <td data-label="Category">{{ advert.category.name }}</td>
                        <td data-label="Actions">
                            <button @click="deleteAdvert(advert.id)">Delete</button>
                            <button @click="toggleUpdateForm(id)">Update</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
        <template v-else>
            // UpdateAdvertForm (pasar la id del advert)
        </template>
    </div>
</template>

<style scoped>
/* General Layout */
.container {
    width: 90%;
    max-width: 1200px;
    margin: auto;
    font-family: 'Roboto', sans-serif;
    color: #ffffff;
    padding: 2rem;
}

h2 {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    margin-block: 1rem;
    color: var(--color-heading);
    font-size: 2rem;
    font-weight: 500;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

th,
td {
    padding: 1rem;
    text-align: left;
    color: #ffffff;

}

th {
    color: #ffffff;
    font-size: 1.2rem;
    font-weight: 600;
}

td {
    color: #ffffff;
    font-size: 1rem;
}



/* Button Styles */
button {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

button:hover {
    transform: translateY(-2px);
}

button:focus {
    outline: none;
}

button:first-child {
    background-color: #007bff;
    margin-right: 0.5rem;
}

button:first-child:hover {
    background-color: #0056b3;
}

button:last-child {
    background-color: #dc3545;
}

button:last-child:hover {
    background-color: #c82333;
}

</style>
