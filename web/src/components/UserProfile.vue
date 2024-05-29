<script>
export default {
  name: "UserProfile",
  data() {
    return {
      user: {
        name: '',
        surname: '',
        email: '',
        phone: '',
        image: ''

      }
    };
  },
  created() {
    const authInfo = JSON.parse(localStorage.getItem("authInfo"));
    if (authInfo && authInfo.id) {
      this.fetchUserData(authInfo.id);
    }
  },
  methods: {
    async fetchUserData(userId) {
      try {
        const response = await fetch(`http://localhost/itb-proyecto-final/api/index.php/user/${userId}`);
        const userData = await response.json();
        const image = await import(`../assets/profileAvatarCollection/${userData.image}`);
        
        this.user.name = userData.name;
        this.user.surname = userData.surname;
        this.user.email = userData.email;
        this.user.phone = userData.phone;
        this.user.image = image.default;
      } catch (error) {
        console.error("Error fetching user data:", error);
      }
    }
  }
};
</script>

<template>
  <div class="user-profile">
    <section class="left-section">
      <img :src="user.image" :alt="`${user.name} ${user.surname}`" />


      <dl class="properties">
        <div class="property">
          <dt>Name</dt>
          <dd>{{ user.name }} {{ user.surname }}</dd>
        </div>

        <div class="property">
          <dt>Email</dt>
          <dd>{{ user.email }}</dd>
        </div>

        <div class="property">
          <dt>Phone</dt>
          <dd>{{ user.phone }}</dd>
        </div>
      </dl>
    </section>

    <section class="right-section">
      <header>
        <h3>Bookings</h3>
      </header>

      <div class="user-info">
        <main>

        </main>
      </div>
    </section>
  </div>
</template>

<style scoped>
.user-profile {
  display: flex;
  gap: 2rem;
}

.left-section {
  flex: 1;
}

.right-section {
  flex: 2;
}

img {
  width: 100%;
  max-width: 200px;
  height: auto;
  aspect-ratio: 1 / 1;
  object-fit: cover;
  border-radius: 50%;
}

.properties {
  margin-top: 1rem;
}

.property {
  margin-bottom: 0.5rem;
}

.property dt {
  font-weight: bold;
}

.property dd {
  margin-left: 0;
}

.user-info {
  padding: 1rem 0;
}
</style>