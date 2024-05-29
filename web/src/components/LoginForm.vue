<template>
  <div class="wrapper">
    <div class="container">
      <div class="tabs">
        <button :class="{ active: activeTab === 'login' }" @click="activeTab = 'login'">Login</button>
        <button :class="{ active: activeTab === 'register' }" @click="activeTab = 'register'">Register</button>
      </div>

      <template v-if="activeTab == 'login'">
        <form @submit.prevent="handleLogin">
          <div class="input-group">
            <label for="loginEmail">
              <span>Email address</span>
              <input type="email" name="loginEmail" id="loginEmail" placeholder="username@example.com"
                v-model="loginEmail" required>
            </label>

            <label for="loginPassword">
              <span>Password</span>
              <input type="password" name="loginPassword" id="loginPassword" v-model="loginPassword" required>
            </label>
          </div>

          <button type="submit">Sign in</button>
        </form>

        <p class="register-reminder">Not a member? <a @click.prevent="activeTab = 'register'">Register</a></p>
      </template>

      <template v-if="activeTab == 'register'">
        <form @submit.prevent="handleRegister">
          <div class="input-group">
            <label for="registerName">
              <span>Name</span>
              <input type="text" name="registerName" id="registerName" placeholder="John" v-model="registerName"
                required>
            </label>

            <label for="registerSurname">
              <span>Surname</span>
              <input type="text" name="registerSurname" id="registerSurname" placeholder="Doe Sins"
                v-model="registerSurname" required>
            </label>
          </div>

          <div class="input-group">
            <label for="registerEmail">
              <span>Email address</span>
              <input type="email" name="registerEmail" id="registerEmail" placeholder="username@example.com"
                v-model="registerEmail" required>
            </label>

            <label for="registerPhone">
              <span>Phone</span>
              <input type="text" name="registerPhone" id="registerPhone" placeholder="600102030" v-model="registerPhone"
                required>
            </label>
          </div>

          <div class="input-group">
            <label for="registerPassword">
              <span>Password</span>
              <input type="password" name="registerPassword" id="registerPassword" v-model="registerPassword" required>
            </label>

            <label for="registerPasswordRepeat">
              <span>Repeat password</span>
              <input type="password" name="registerPasswordRepeat" id="registerPasswordRepeat"
                v-model="registerPasswordRepeat" required>
            </label>
          </div>

          <label for="registerProfileImage">
            <span>Choose your avatar</span>
            <AvatarCarousel v-model="registerProfileImage" @avatar-selected="handleAvatarSelected" />
          </label>

          <label for="registerTermsCheck" class="checkbox-group">
            <input type="checkbox" name="registerTermsCheck" id="registerTermsCheck" v-model="registerTermsCheck"
              required>
            <span>I have read and agree to the terms</span>
          </label>

          <button type="submit">Sign in</button>
        </form>

        <p class="register-reminder">Already have an account? <a @click.prevent="activeTab = 'login'">Login</a></p>
      </template>
    </div>
  </div>
</template>

<script>
import AvatarCarousel from "@/components/AvatarCarousel.vue";

export default {
  name: "LoginForm",
  components: {
    AvatarCarousel
  },
  props: {
    activeTabProp: {
      type: String,
      default: 'login'
    }
  },
  data() {
    return {
      activeTab: this.activeTabProp,
      loginEmail: '',
      loginPassword: '',
      loginCheck: true,
      registerName: '',
      registerSurname: '',
      registerProfileImage: '',
      registerEmail: '',
      registerPhone: '',
      registerPassword: '',
      registerPasswordRepeat: '',
      registerBalance: 0,
      registerIsAdmin: 0,
      registerTermsCheck: false,
      registrationError: null,
    };
  },
  methods: {
    // Función para actualizar 'registerProfileImage' con el valor transmitido por el evento 'avatar-selected'
    handleAvatarSelected(avatar) {
      this.registerProfileImage = avatar;
      console.log(this.registerProfileImage);
    },
    // Función que permite al usuario logearse
    async handleLogin() {
      const data = {
        user_email: this.loginEmail,
        user_password: this.loginPassword
      };

      console.log(data);

      const res = await fetch("http://localhost/itb-proyecto-final/api/index.php/auth/login", {
        method: "POST",
        headers: {
          "Accept": "application/json",
          "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
      });

      const json_res = await res.json();

      console.log(json_res);

      if (json_res && typeof json_res == "object" && json_res.token) {
        localStorage.setItem("authInfo", JSON.stringify(json_res));
        console.info("sesión iniciada");
        this.$router.push(`/user/${json_res.id}`)
      } else {
        console.warn("credenciales incorrectas");
      }
    },
    // Función que permite al usuario registrarse
    async handleRegister() {
      if (this.registerPassword !== this.registerPasswordRepeat) {
        this.registrationError = "Passwords do not match.";
        return;
      }

      const data = {
        name: this.registerName,
        surname: this.registerSurname,
        image: this.registerProfileImage,
        email: this.registerEmail,
        phone: this.registerPhone,
        password: this.registerPassword,
        password_repeat: this.registerPasswordRepeat,
        balance: this.registerBalance,
        isAdmin: this.registerIsAdmin
      };

      console.log('Register:', data);

      const res = await fetch("http://localhost/itb-proyecto-final/api/index.php/user", {
        method: "POST",
        headers: {
          "Accept": "application/json",
          "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
      });

      const json_res = await res.json();

      console.log(json_res);

      if (json_res.status === 'success') {
        console.info("Successfully registered user");
        localStorage.setItem("authInfo", JSON.stringify(json_res));
        this.$router.push(`/user/${json_res.id}`);
      } else {
        console.warn("Registration error:", json_res.message);
      }
    }
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
  margin-inline: auto;
  display: flex;
  flex-direction: column;
  gap: 3rem;
}

.tabs {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 2px;
}

.tabs button {
  padding-block: 1rem .25rem;
  padding-inline: 4rem;
  background: none;
  border: none;
  border-bottom: 1px solid var(--color-border-hover);
  color: var(--color-text);
}

.tabs button:hover {
  cursor: pointer;
}

.tabs button.active {
  border-bottom: 1px solid var(--color-text-bright);
  color: var(--color-text-bright);
}

form,
form label {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  width: 100%;
}

form label {
  gap: .25rem;
}

form input {
  padding: .5rem .75rem;
  background-color: rgba(255 255 255 / .1);
  border: 1px solid var(--color-border-hover);
  border-radius: 6px;
}

form button {
  padding: .5rem 1.25rem;
  width: fit-content;
  background-color: rgba(255 255 255 / .1);
  border: 1px solid var(--color-border-hover);
  border-radius: 6px;
  transition: background-color .2s ease-in-out;
}

form button:hover {
  cursor: pointer;
  background-color: var(--color-border-hover);
}

.register-reminder {
  opacity: .5;
}

.register-reminder a {
  text-decoration: underline;
  color: var(--color-text-bright)
}

.register-reminder a:hover {
  cursor: pointer;
}

.input-group {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 2.5rem;
}

.checkbox-group {
  width: fit-content;
  flex-direction: row;
  gap: .5rem;
}

.checkbox-group:hover,
.checkbox-group input:hover {
  cursor: pointer;
}

@media screen and (width < 481px) {
  .input-group {
    flex-direction: column;
  }
}

@media screen and (width < 401px) {
  .tabs button {
    padding-block: 1rem .25rem;
    padding-inline: calc(1.1rem + 5vw);
    background: none;
    border: none;
    border-bottom: 1px solid var(--color-border-hover);
    color: var(--color-text);
  }
}
</style>
