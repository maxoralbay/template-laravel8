<template>
    <div class="login-section bg-full-gradient">
        <div class="main-container">
            <h3 class="main-heading login-title">Réinitialiser le mot de passe</h3>
            <div class="form-block">
                <div class="form-group field-group">
                    <label for="emailInput" class="color-white">Email</label>
                    <input type="email" id="emailInput" class="form-control" v-model="email" required>
                </div>
                <div class="login-as-block pb-5">
                    <button class="submit-btn" @click="toReset">Valider</button>
                    <button @click="$router.push({name: 'login'})" class="text-white static-link">Connexion</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import uiMixin from 'Mixins/uiMixin.js';
import validationHelper from 'Helpers/validationHelper.js';

export default {
    name: 'ForgotPassword',
    mixins: [uiMixin],
    data() {
        return {
            email: null,
            validationHelper: validationHelper
        }
    },
    methods: {
        toReset() {
            this.setDataLoadingStart();

            let validationMessages = this.validate();

            if (validationMessages.length > 0) {
                this.setErrorMessages(validationMessages);
                this.setDataLoadingEnd();

                return false;
            }

            this.$http.post('/password/reset-link/' + this.email).then((response) => {
                if (response.data.data && response.data.data.status) {
                    
                    this.setSuccessMessage('Un code de récupération de mot de passe a été envoyé à votre adresse e-mail.');
                    this.$router.push({name: 'password-reset'});
                }

                this.setDataLoadingEnd();
            }).catch(error => {
                this.setDataLoadingEnd();
                this.parseHttpErrorMessage(error);
            })
        },
        validate() {
            let messages = [];

            if (!this.email) {
                messages.push(this.validationHelper.messages.emptyField('email'));
            }
        

            if (this.email && !this.validationHelper.email(this.email)) {
                messages.push(this.validationHelper.messages.incorrectEmail());
            }

            return messages;
        }
    }
}

</script>

<style>


</style>