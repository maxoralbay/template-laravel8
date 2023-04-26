<template>
    <div class="login-section bg-full-gradient">
        <div class="main-container">
            <h3 class="main-heading login-title">Connexion</h3>
            <div class="form-block">
                <div class="form-group field-group">
                    <label for="emailInput" class="color-white">Email</label>
                    <input type="email" id="emailInput" class="form-control" v-model="loginData.email" required>
                </div>
                <div class="form-group field-group">
                    <label for="passwordInput" class="color-white">Mot de passe</label>
                    <input type="password" id="passwordInput" class="form-control" v-model="loginData.password" required>
                </div>
                <a href="/password/forgot" class="mb-5 d-block text-white static-link">Mot de passe oublié ?</a>
                <div class="login-as-block pb-5">
                    <!-- <p>Se connecter avec</p>
                    <ul class="socials">
                        <li>
                            <button>
                                <img src="../../images/icons/google_plus.png" alt="">
                            </button>
                        </li>
                        <li>
                            <button>
                                <img src="../../images/icons/facebook.png" alt="">
                            </button>
                        </li>
                    </ul> -->
                    <button class="submit-btn" @click="login">Valider</button>
                    <button @click="$router.push({name: 'registration'})" class="text-white static-link">S'inscrire</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import uiMixin from 'Mixins/uiMixin.js';
import validationHelper from 'Helpers/validationHelper.js';

export default {
    name: 'Login',
    mixins: [uiMixin],
    data() {
        return {
            loginData: {
                email: null,
                password: null
            },
            validationHelper: validationHelper
        }
    },
    methods: {
        login() {
            this.setDataLoadingStart();

            let validationMessages = this.validate();

            if (validationMessages.length > 0) {
                this.setErrorMessages(validationMessages);
                this.setDataLoadingEnd();

                return false;
            }

            this.$http.post('/login', this.loginData).then((response) => {
                if (response.data.data) {
                    this.$store.dispatch('authenticateUser', response.data.data);
                    this.setDataLoadingEnd();
                    
                    this.$router.push({name: 'home'});
                }
            }).catch(error => {
                this.setDataLoadingEnd();
                this.parseHttpErrorMessage(error);
            })
        },
        validate() {
            let messages = [];

            if (!this.loginData.email) {
                messages.push(this.validationHelper.messages.emptyField('email'));
            }
            
            if (!this.loginData.password) {
                messages.push(this.validationHelper.messages.emptyField('Mot de passe'));
            }

            if (this.loginData.email && !this.validationHelper.email(this.loginData.email)) {
                messages.push(this.validationHelper.messages.incorrectEmail());
            }

            return messages;
        }
    }
}

</script>

<style>


</style>