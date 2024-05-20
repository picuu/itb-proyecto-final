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
    <AdvertCard title="Offers" link="/offers" description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lobortis efficitur mauris et laoreet. Nulla consequat sed mauris non ornare. Morbi molestie dui non laoreet varius." />
    <AdvertCard title="Demands" link="/demands" description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lobortis efficitur mauris et laoreet. Nulla consequat sed mauris non ornare. Morbi molestie dui non laoreet varius." />
    <AdvertCard title="Events" link="/events" description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lobortis efficitur mauris et laoreet. Nulla consequat sed mauris non ornare. Morbi molestie dui non laoreet varius." />
  </div>
</template>

<style scoped>
div {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
}
</style>