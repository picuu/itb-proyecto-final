<script>
import { RouterLink } from 'vue-router'
import { IconMessageQuestion } from '@tabler/icons-vue'
import LayoutSection from '@/sections/LayoutSection.vue'
import AdvertList from '@/components/AdvertList.vue'
import HeaderComponent from '../components/HeaderComponent.vue'
import { validateSession } from '@/helpers'

export default {
  name: 'RequestsView',
  components: {
    RouterLink,
    LayoutSection,
    IconMessageQuestion,
    AdvertList,
    HeaderComponent,
  },
  data() {
    return {
      isLogged: false,
      isMenuOpen: false,
      userId: null,
      requests: [], 
    }
  },
  created() {
    this.checkLogin();
    this.getRequests(); 
  },
  methods: {
    checkLogin() {
      const authInfo = validateSession();
      console.log(authInfo);
      if (authInfo) {
        this.isLogged = true;
        this.userId = authInfo.id;
      } else {
        this.isLogged = false;
        this.userId = null;
      }
    },
    getRequests() {
      fetch('http://localhost/itb-proyecto-final/api/index.php/request/')
        .then((res) => res.json())
        .then((data) => {
          this.requests = data;
        })
        .catch((e) => console.error('Error fetching requests:', e));
    },
    deleteRequest(id) {
      fetch(`http://localhost/itb-proyecto-final/api/index.php/request/${id}`, {
        method: 'DELETE',
      })
        .then((res) => res.json())
        .then((data) => {
          console.log(data);
          this.getRequests();
        })
        .catch((e) => console.error('Error deleting request:', e));
    },
  },
}
</script>

<template>
  <div>
    <HeaderComponent />

    <main class="content-grid">
      <LayoutSection>
        <h2>
          <IconMessageQuestion size="36" />
          Requests
        </h2>
    
        <AdvertList endpoint="/request/" />
        <template v-if="isLogged">
          <RouterLink to="/new-advert-form">Add New Request</RouterLink>
        </template>
        <div v-for="request in requests" :key="request.id">
          <template v-if="isLogged && userId == request.owner_id">
            <button @click="deleteRequest(request.id)">Delete</button>
          </template>
        </div>
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

a {
  display: block;
  width: fit-content;
  padding: .65rem 1.25rem;
  margin-top: 2rem;
  background-color: #007bff;
  border: none;
  border-radius: 6px;
  color: var(--color-heading);
  text-decoration: none;
}
</style>
