<script>
import HomeCard from '@/components/HomeCard.vue'
import LayoutSection from '@/sections/LayoutSection.vue'
import { IconHeartHandshake, IconMessageQuestion } from '@tabler/icons-vue'

export default {
  name: 'HomeView',
  components: {
    HomeCard,
    LayoutSection,
    IconHeartHandshake,
    IconMessageQuestion
  }
}
</script>

<template>
  <LayoutSection>
    <div>
      <HomeCard title="Offers" link="/offers" description="See what others have to offer you">
        <IconHeartHandshake class="icon" size="92" stroke="1" />
      </HomeCard>

      <HomeCard title="Requests" link="/requests" description="Ask others for a specific service">
        <IconMessageQuestion class="icon" size="92" stroke="1" />
      </HomeCard>
    </div>
  </LayoutSection>
</template>

<style scoped>
div {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  justify-items: center;
  margin-inline: auto;
  padding-bottom: 2rem;
}

@media screen and (width < 481px) {
  div {
    grid-template-columns: 1fr;
  }

  div > * {
    width: fit-content;
    padding: 0 2.5rem;
  }
}
</style>