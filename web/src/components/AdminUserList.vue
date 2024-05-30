<script>
import { user } from '@/types'
import UpdateUserProfileForm from './UpdateUserProfileForm.vue';

export default {
    name: 'AdminUserList',
    components: {UpdateUserProfileForm},
    data() {
        return {
            users: Array(user),
            userId: null,
            showUpdateForm: false
        }
    },

    methods: {
        async getUsers() {
            try {
                const res = await fetch('http://localhost/itb-proyecto-final/api/index.php/user')
                const data = await res.json()
                this.users = data
            } catch (e) {
                console.error("Error fetching users:", e)
            }
        },

        async getUser() {
            try {
                const res = await fetch(`http://localhost/itb-proyecto-final/api/index.php/user/${this.userId}`)
                const data = await res.json()
                this.user = data
            } catch (e) {
                console.error("Error fetching user:", e)
            }
        },

        async deleteUser(userId) {
            // fetch con method delete
            try {
                const res = await fetch(`http://localhost/itb-proyecto-final/api/index.php/user/${userId}`, {
                    method: 'DELETE'
                })
                const data = await res.json()
                this.users = this.users.filter(user => user.id !== userId)
            } catch (e) {
                console.error("Error deleting user:", e)
            }
        },

        getUserRole(isAdmin) {
            if (isAdmin == 1) return "admin"
            return "user"
        },

        toggleUpdateForm() {
            this.showUpdateForm = !this.showUpdateForm
        }
    },
    created() {
        this.getUsers()
    }
}
</script>

<template>
    <div>
        <template v-if="!showUpdateForm">
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ getUserRole(user.isAdmin) }}</td>
                            <td>
                                <button @click="toggleUpdateForm">Update</button>
                                <button @click="deleteUser(user.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
        <template v-else>
            <UpdateUserProfileForm />
            <button @click="toggleUpdateForm">Cancel</button>
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
    margin-top: 0.5rem;
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

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }

    table,
    thead,
    tbody,
    th,
    td,
    tr {
        display: block;
    }

    th,
    td {
        padding: 0.5rem;
    }

    tr {
        margin-bottom: 1rem;
    }

    th {
        background-color: #333;
        text-align: center;
    }

    td {
        color: #333;
        text-align: right;
        position: relative;
        padding-left: 50%;
    }

    td:before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 1rem;
        font-weight: 600;
        color: #666;
    }
}
</style>
