<template>
    <div class="login-section bg-full-gradient">
        <div class="main-container">
            <h3 class="main-heading login-title">Connexion</h3>
            <div class="form-block">
                <div class="form-group field-group">
                    <label for="codeInput" class="color-white">Code</label>
                    <input type="text" id="codeInput" class="form-control" v-model="resetData.code" required>
                </div>
                <div class="form-group field-group">
                    <label for="passwordInput" class="color-white">Nouveau mot de passe</label>
                    <input type="password" id="passwordInput" class="form-control" v-model="resetData.password" required>
                </div>
                <div class="form-group field-group">
                    <label for="passwordConfirm" class="color-white">Confirmation mot de passe</label>
                    <input type="password" id="passwordConfirm" class="form-control" v-model="resetData.password_confirmation" required>
                </div>
                <div class="login-as-block pb-5">
                    <button class="submit-btn" @click="resetPassword">Valider</button>
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
    name: 'ResetPassword',
    mixins: [uiMixin],
    data() {
        return {
            resetData: {
                code: null,
                password: null,
                password_confirmation: null,
            },
            validationHelper: validationHelper
        }
    },
    methods: {
        resetPassword() {
            this.setDataLoadingStart();

            let validationMessages = this.validate();

            if (validationMessages.length > 0) {
                this.setErrorMessages(validationMessages);
                this.setDataLoadingEnd();

                return false;
            }

            this.$http.post('/password/reset', this.resetData).then((response) => {
                if (response.data.data && response.data.data.status) {
                    this.setSuccessMessage('Mot de passe mis à jour avec succès.');
                    this.$router.push({name: 'login'});
                }

                this.setDataLoadingEnd();
            }).catch(error => {
                this.setDataLoadingEnd();
                this.parseHttpErrorMessage(error);
            })
        },
        validate() {
            let messages = [];

            if (!this.resetData.code) {
                messages.push(validationHelper.messages.emptyField('Code'))
            }

            if (!this.resetData.password) {
                messages.push(validationHelper.messages.emptyField('Nouveau mot de passe'))
            }

            if (this.resetData.password && !validationHelper.passwordConfirmed(this.resetData.password, this.resetData.password_confirmation)) {
                messages.push(validationHelper.messages.passwordIsNotConfirmed())
            }

            return messages;
        }
    }
}

</script>

<style>


</style>