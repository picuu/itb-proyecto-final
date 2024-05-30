<script>
import HeaderComponent from '@/components/HeaderComponent.vue'
import LayoutSection from '@/sections/LayoutSection.vue'
import UserList from '@/components/UserList.vue'

export default {
    name: 'UserManagementView',
    props: {
        advertId: {
            type: String,
            default: '0'
        }
    },
    components: {
        HeaderComponent,
        LayoutSection,
        UserList
    }
}
</script>

<template>
    <div>
        <HeaderComponent />

        <main class="content-grid">
            <LayoutSection>
                <h2>Users</h2>
                    <AdminUserList />
            </LayoutSection>

            <LayoutSection>
                <h2>Adverts</h2>
                    <AdminAdvertList />
            </LayoutSection>
        </main>
    </div>
</template>

<style scoped>
h2 {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-block: 2rem;
    color: var(--color-heading);
    font-size: 2rem;
    font-weight: 500;
}
</style>
