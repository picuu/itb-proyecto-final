<script>
import { RouterLink } from 'vue-router'
import { IconSchool, IconTag } from '@tabler/icons-vue'

export default {
  name: 'PillComponent',
  props: {
    text: {
      type: String,
      required: true
    },
    type: {
      type: String,
      required: true
    },
    id: {
      type: String,
      required: true
    }
  },
  components: {
    RouterLink,
    IconSchool,
    IconTag
  }
}
</script>

<template>
  <template v-if="type == 'primary'">
    <RouterLink :href="'/offers/category/' + id" :class="'pill pill-' + type">
      <IconSchool size="20" stroke="1" />
      {{ text }}
    </RouterLink>
  </template>

  <template v-else>
    <RouterLink :href="'/offers/tag/' + id" :class="'pill pill-' + type">
      <IconTag size="18" stroke="1" />
      {{ text }}
    </RouterLink>
  </template>
</template>

<style scoped>
a {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.4rem 0.9rem;
  width: fit-content;
  color: var(--color-text-bright);
  text-decoration: none;
  transition: background-color 0.2s ease-in-out;
}

a.pill-primary {
  /* padding-inline: 0; */
  background-color: rgba(50 110 210 / 0.1);
  border: 1px solid rgb(50, 110, 210);
  border-radius: 100vw;
  color: rgb(50, 110, 210);
}

a.pill-secondary {
  padding: 0.3rem 0.8rem;
  border: 1px solid var(--color-border-hover);
  border-radius: 100vw;
  color: var(--color-text);
  font-size: 0.85rem;
}
</style>
