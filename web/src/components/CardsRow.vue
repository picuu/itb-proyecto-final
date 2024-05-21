<script>
import AdvertCard from "@/components/AdvertCard.vue"
import { IconHeartHandshake, IconMessageQuestion, IconFriends } from '@tabler/icons-vue';

export default {
  name: "CardsRow",
  components: {
    AdvertCard,
    IconHeartHandshake,
    IconMessageQuestion,
    IconFriends
  }
}
</script>

<template>
  <div>
    <AdvertCard title="Offers" link="/offers" description="See what others have to offer you">
      <IconHeartHandshake class="icon" size="92" stroke="1" />
    </AdvertCard>

    <AdvertCard title="Requests" link="/demands" description="Ask others for a specific service">
      <IconMessageQuestion class="icon" size="92" stroke="1" />
    </AdvertCard>

    <AdvertCard title="Workshops" link="/events" description="Learn and teach together, without limits">
      <IconFriends class="icon" size="92" stroke="1" />
    </AdvertCard>
  </div>
</template>

<style scoped>
div {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  justify-items: center;
}
</style>

