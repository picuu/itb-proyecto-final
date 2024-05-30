<script>
import { user } from '@/types'

export default {
    name: 'UserList',
    components: {},
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
            <h2>Users</h2>
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
            // componente del formulario de actualizar usuario (jaco)
            <button @click="toggleUpdateForm">Cancel</button>
        </template>
    </div>
</template>