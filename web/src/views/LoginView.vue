<script>
export default {
    setup() {
        const activeTab = ref('login');
        const loginEmail = ref('');
        const loginPassword = ref('');
        const loginCheck = ref(true);
        const registerName = ref('');
        const registerUsername = ref('');
        const registerEmail = ref('');
        const registerPassword = ref('');
        const registerPasswordRepeat = ref('');
        const registerTermsCheck = ref(true);

        const handleLogin = () => {
            console.log('Login:', loginEmail.value, loginPassword.value, loginCheck.value);
        };

        const handleRegister = () => {
            console.log('Register:', registerName.value, registerUsername.value, registerEmail.value, registerPassword.value,
                registerPasswordRepeat.value, registerTermsCheck.value);
        };

        return {
            activeTab,
            loginEmail,
            loginPassword,
            loginCheck,
            registerName,
            registerUsername,
            registerEmail,
            registerPassword,
            registerPasswordRepeat,
            registerTermsCheck,
            handleLogin,
            handleRegister,
        };
    },
};
</script>


<template>
    <div>
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
    </div>
</template>