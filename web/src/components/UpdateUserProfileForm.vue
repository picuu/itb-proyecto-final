<script>
import { validateSession } from '@/helpers';

export default {
    name: "UpdateUserProfileForm",
    props: {
        userId: {
            type: String,
            default: '0'
        }
    },
    data() {
        return {
            updateName: '',
            updateSurname: '',
            updateProfileImage: null,
            updateEmail: '',
            updatePhone: '',
            updatePassword: '',
            updatePasswordRepeat: '',
            updateBalance: 0,
            updateIsAdmin: 0,
            updateTermsCheck: false,
            updatingError: null,
        };
    },
    methods: {
        validateSession,
        // Función que permite almacenar un archivo subido por el usuario en el data
        handleFileChange(event) {
            this.updateProfileImage = event.target.files[0];
        },
        // Función que permite al usuario registrarse
        async handleUpdate() {
            if (this.updatePassword !== this.updatePasswordRepeat) {
                this.updatingError = "Passwords do not match.";
                return;
            }

            const data = {
                name: this.updateName,
                surname: this.updateSurname,
                image: this.updateProfileImage.name,
                email: this.updateEmail,
                phone: this.updatePhone,
                password: this.updatePassword,
                password_repeat: this.updatePasswordRepeat,
                balance: this.updateBalance,
                isAdmin: this.updateIsAdmin
            };

            console.log('Update:', data);
            
            const authInfo = this.validateSession();
            
            const res = await fetch(`http://localhost/itb-proyecto-final/api/index.php/user/${authInfo.id}`, {
                method: "PUT",
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            });

            const json_res = await res.json();

            console.log(json_res);

            if (json_res.status === 'success') {
                console.info("Successfully updateed user profile");
                localStorage.setItem("authInfo", JSON.stringify(json_res));
                this.$router.push(`/user/${json_res.id}`);
            } else {
                console.warn("Updating error:", json_res.message);
            }
        }
    },
    created(){
        if (!this.validateSession()) {
            this.$router.push('/login')
        }
    }
};
</script>

<template>
    <form @submit.prevent="handleUpdate">
        <div class="input-group">
            <label for="updateName">
                <span>Name</span>
                <input type="text" name="updateName" id="updateName" placeholder="John" v-model="updateName" required>
            </label>

            <label for="updateSurname">
                <span>Surname</span>
                <input type="text" name="updateSurname" id="updateSurname" placeholder="Doe Sins"
                    v-model="updateSurname" required>
            </label>
        </div>

        <div class="input-group">
            <label for="updateEmail">
                <span>Email address</span>
                <input type="email" name="updateEmail" id="updateEmail" placeholder="username@example.com"
                    v-model="updateEmail" required>
            </label>

            <label for="updatePhone">
                <span>Phone</span>
                <input type="text" name="updatePhone" id="updatePhone" placeholder="600102030" v-model="updatePhone"
                    required>
            </label>
        </div>

        <div class="input-group">
            <label for="updatePassword">
                <span>Password</span>
                <input type="password" name="updatePassword" id="updatePassword" v-model="updatePassword" required>
            </label>

            <label for="updatePasswordRepeat">
                <span>Repeat password</span>
                <input type="password" name="updatePasswordRepeat" id="updatePasswordRepeat"
                    v-model="updatePasswordRepeat" required>
            </label>
        </div>

        <label for="updateProfileImage">
            <span>Profile image</span>
            <input type="file" name="updateProfileImage" id="updateProfileImage" @change="handleFileChange">
        </label>

        <label for="updateTermsCheck" class="checkbox-group">
            <input type="checkbox" name="updateTermsCheck" id="updateTermsCheck" v-model="updateTermsCheck" required>
            <span>I have read and agree to the terms</span>
        </label>

        <button type="submit">Save changes</button>
    </form>
</template>

<style scoped>
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
</style>