<script>
import AdvertCard from '@/components/AdvertCard.vue'
import LayoutSection from '@/sections/LayoutSection.vue'
import { IconHeartHandshake, IconMessageQuestion } from '@tabler/icons-vue'

export default {
  name: 'CardsRow',
  components: {
    AdvertCard,
    LayoutSection,
    IconHeartHandshake,
    IconMessageQuestion
  }
}
</script>

<template>
  <LayoutSection>
    <div>
      <AdvertCard title="Offers" link="/offers" description="See what others have to offer you">
        <IconHeartHandshake class="icon" size="92" stroke="1" />
      </AdvertCard>

      <AdvertCard title="Requests" link="/demands" description="Ask others for a specific service">
        <IconMessageQuestion class="icon" size="92" stroke="1" />
      </AdvertCard>
    </div>
  </LayoutSection>
</template>

<style scoped>
div {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  justify-items: center;
  width: calc(100% - 300px);
  margin-inline: auto;
}
</style>
