<template>
    <div class="form-container">
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
                    <input type="email" id="loginEmail" v-model="loginEmail" required />
                </div>
                <div class="input-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" id="loginPassword" v-model="loginPassword" required />
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
                    <label for="registerSurname">Surname</label>
                    <input type="text" id="registerSurname" v-model="registerSurname" />
                </div>
                <div class="input-group">
                    <label for="registerEmail">Email</label>
                    <input type="email" id="registerEmail" v-model="registerEmail" />
                </div>
                <div class="input-group">
                    <label for="registerPhone">Phone</label>
                    <input type="text" id="registerPhone" v-model="registerPhone" />
                </div>
                <div class="input-group">
                    <label for="registerPassword">Password</label>
                    <input type="password" id="registerPassword" v-model="registerPassword" />
                </div>
                <div class="input-group">
                    <label for="registerPasswordRepeat">Repeat password</label>
                    <input type="password" id="registerPasswordRepeat" v-model="registerPasswordRepeat" />
                </div>
                <div class="input-group">
                    <label for="registerBalance">Balance</label>
                    <input type="number" id="registerBalance" v-model="registerBalance" />
                </div>
                <div class="input-group">
                    <label for="registerIsAdmin">Is Admin</label>
                    <input type="checkbox" id="registerIsAdmin" v-model="registerIsAdmin" />
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

<script>
export default {
    name: "LoginView",
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
            registerEmail: '',
            registerPhone: '',
            registerPassword: '',
            registerPasswordRepeat: '',
            registerBalance: 0,
            registerIsAdmin: false,
            registerTermsCheck: true,
        };
    },
    methods: {
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

            if (json_res && json_res.length > 1) {
                localStorage.setItem("token", json_res.token);
                localStorage.setItem("isAdmin", json_res.isAdmin);
                localStorage.setItem("id", json_res.id);
                console.info("sesión iniciada");
            } else {
                console.warn("credenciales incorrectas");
            }
        },
        async handleRegister() {
            const data = {
                name: this.registerName,
                surname: this.registerSurname,
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
                console.info("Usuario registrado exitosamente");
            } else {
                console.warn("Error en el registro:", json_res.message);
            }
        }
    },
};
</script>

<style scoped>
.form-container {
    background-color: #121212;
    color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    margin: 40px auto;
}

.tabs {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.tabs button {
    padding: 10px 20px;
    cursor: pointer;
    border: none;
    background: #333;
    color: #fff;
    margin: 0 5px;
    border-radius: 5px;
}

.tabs button.active {
    background: #007bff;
}

.form {
    text-align: left;
}

.input-group,
.checkbox-group {
    margin-bottom: 15px;
}

.input-group label,
.checkbox-group label {
    display: block;
    margin-bottom: 5px;
}

.input-group input,
.checkbox-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #333;
    color: #fff;
}

.checkbox-group {
    display: flex;
    align-items: center;
}

.checkbox-group input {
    width: auto;
    margin-right: 10px;
}

.btn-submit {
    width: 100%;
    padding: 10px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-submit:hover {
    background: #0056b3;
}

.social-buttons {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.btn-social {
    width: 30%;
    margin: 1%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: white;
}

.btn-social.fb {
    background: #3b5998;
}

.btn-social.google {
    background: #db4437;
}

.btn-social.twitter {
    background: #1da1f2;
}

.btn-social.github {
    background: #333;
}
</style>
