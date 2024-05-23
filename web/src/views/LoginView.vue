<script>
import LayoutSection from '@/sections/LayoutSection.vue'

export default {
  name: 'LoginView',
  components: {
    LayoutSection
  },
  data() {
    return {
      activeTab: 'login',
      loginEmail: String,
      loginPassowrd: String,
      loginCheck: true,
      registerName: String,
      registerUsername: String,
      registerEmail: String,
      registerPassword: String,
      registerPasswordRepeat: String,
      registerTermsCheck: true
    }
  },
  methods: {
    handleLogin() {
      console.log('Login:', this.loginEmail.value, this.loginPassword.value, this.loginCheck.value)
    },
    handleRegister() {
      console.log(
        'Register:',
        this.registerName.value,
        this.registerUsername.value,
        this.registerEmail.value,
        this.registerPassword.value,
        this.registerPasswordRepeat.value,
        this.registerTermsCheck.value
      )
    }
  }
}
</script>

<template>
  <LayoutSection>
    <div class="tabs">
      <button :class="{ active: activeTab === 'login' }" @click="activeTab = 'login'">Login</button>
      <button :class="{ active: activeTab === 'register' }" @click="activeTab = 'register'">Register</button>
    </div>
    <div v-if="activeTab === 'login'" class="form">
      <form @submit.prevent="handleLogin">
        <h3>Login</h3>
        <div class="social-buttons">
          <button type="button" class="btn-social fb">Facebook</button>
          <button type="button" class="btn-social google">Google</button>
          <button type="button" class="btn-social twitter">Twitter</button>
          <button type="button" class="btn-social github">GitHub</button>
        </div>
        <p>or:</p>
        <div class="input-group">
          <label for="loginEmail">Email address</label>
          <input type="email" id="loginEmail" v-model="loginEmail" />
        </div>
        <div class="input-group">
          <label for="loginPassword">Password</label>
          <input type="password" id="loginPassword" v-model="loginPassword" />
        </div>
        <div class="checkbox-group">
          <input type="checkbox" id="loginCheck" v-model="loginCheck" />
          <label for="loginCheck">Remember me</label>
        </div>
        <button type="submit" class="btn-submit">Sign in</button>
        <p>Not a member? <a href="#" @click.prevent="activeTab = 'register'">Register</a></p>
      </form>
    </div>
    <div v-if="activeTab === 'register'" class="form">
      <form @submit.prevent="handleRegister">
        <h3>Register</h3>
        <div class="social-buttons">
          <button type="button" class="btn-social fb">Facebook</button>
          <button type="button" class="btn-social google">Google</button>
          <button type="button" class="btn-social twitter">Twitter</button>
          <button type="button" class="btn-social github">GitHub</button>
        </div>
        <p>or:</p>
        <div class="input-group">
          <label for="registerName">Name</label>
          <input type="text" id="registerName" v-model="registerName" />
        </div>
        <div class="input-group">
          <label for="registerUsername">Username</label>
          <input type="text" id="registerUsername" v-model="registerUsername" />
        </div>
        <div class="input-group">
          <label for="registerEmail">Email</label>
          <input type="email" id="registerEmail" v-model="registerEmail" />
        </div>
        <div class="input-group">
          <label for="registerPassword">Password</label>
          <input type="password" id="registerPassword" v-model="registerPassword" />
        </div>
        <div class="input-group">
          <label for="registerPasswordRepeat">Repeat password</label>
          <input type="password" id="registerPasswordRepeat" v-model="registerPasswordRepeat" />
        </div>
        <div class="checkbox-group">
          <input type="checkbox" id="registerTermsCheck" v-model="registerTermsCheck" />
          <label for="registerTermsCheck">I have read and agree to the terms</label>
        </div>
        <button type="submit" class="btn-submit">Register</button>
      </form>
    </div>
  </LayoutSection>
</template>
