<script>
import HeaderComponent from '@/components/HeaderComponent.vue'
import LayoutSection from '@/sections/LayoutSection.vue'
import AdvertAdminList from '@/components/AdvertAdminList.vue'
import AdminUserList from '@/components/AdminUserList.vue'

export default {
    name: 'AdminView',
    props: {
        advertId: {
            type: String,
            default: '0'
        }
    },
    components: {
        HeaderComponent,
        LayoutSection,
        AdminUserList,
        AdvertAdminList
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
                    <AdvertAdminList />
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


section{
    margin-bottom: 1rem
}
</style>
