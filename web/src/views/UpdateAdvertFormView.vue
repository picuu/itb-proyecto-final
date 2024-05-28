<script>
import HeaderComponent from '@/components/HeaderComponent.vue'
import LayoutSection from '@/sections/LayoutSection.vue'
import AdvertDetails from '@/components/AdvertDetails.vue'
import updateAdvert from '@/components/UpdateAdvert.vue'

export default {
    name: 'UpdateAdvertFormView',
    components: {
        HeaderComponent,
        LayoutSection,
        AdvertDetails,
        updateAdvert
    },
    props: {
        advertId: {
            type: String,
            default: '0'
        }
    },
}
</script>


<template>
    <div>
        <HeaderComponent />
        <main class="content-grid">
            <LayoutSection>
                <h2>Update Advert</h2>
                <updateAdvert :advertId="advertId" />
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