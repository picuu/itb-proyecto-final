<script>
import AdvertCard from "@/components/AdvertCard.vue"

export default {
  name: "CardsRow",
  components: {
    AdvertCard
  }
}
</script>

<template>
  <div>
    <AdvertCard title="Offers" link="/offers" image="heart-handshake.png" description="See what others have to offer you" />
    <AdvertCard title="Demands" link="/demands" image="MdiOffer.png" description="Ask for a specific service" />
    <AdvertCard title="Events" link="/events" image="GrommetIconsWorkshop.png" description="Learn and teach together, without limits" />
  </div>
</template>

<style scoped>
div {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
}
</style>

