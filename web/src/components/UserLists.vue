<script>
import { RouterLink } from 'vue-router'
import { user } from '@/types'

export default {
    name: 'UserList',
    components: {
        RouterLink
    },
    data() {
        return {
            user,
            userId: null
        }
    },

    methods: {
        async getUsers() {
            try {
                const res = await fetch('http://localhost/itb-proyecto-final/api/index.php/user')
                const data = await res.json()
                this.user = data
            } catch (e) {
                console.error("Error fetching users:", e)
            }
        }

            async getUser() {
            try {
                const res = await fetch(`http://localhost/itb-proyecto-final/api/index.php/user/${this.userId}`)
                const data = await res.json()
                this.user = data
            } catch (e) {
                console.error("Error fetching user:", e)
            }
        }
    },
}
</script>

<template>
    <div>
        <h2>Users</h2>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.username }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.role }}</td>
                        <td>
                            <template >
                                <RouterLink :to = "{ name: 'UpdateUser', params: { id: user.id } }">Update</RouterLink> 
                                <RouterLink :to = "{ name: 'DeleteUser', params: { id: user.id } }">Delete</RouterLink>
                            </template>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>