<template>
    <div class="layer-block">
        <div class="block-header">
            <p class="page-title-regular color-white text-center">Inscription</p>
        </div>
        <div class="block-content main-bg">
            <div class="main-container">
                <div class="form-block register-form">
                    <div class="form-group field-group">
                        <label for="lastName" class="color-green">Nom</label>
                        <input type="text" id="lastName" class="form-control" v-model="userData.last_name" required>
                    </div>
                    <div class="form-group field-group">
                        <label for="firstName" class="color-green">Prénom</label>
                        <input type="text" id="firstName" class="form-control" v-model="userData.first_name" required>
                    </div>
                    <div class="form-group field-group">
                        <label for="email" class="color-green">Email</label>
                        <input type="email" id="email" class="form-control" v-model="userData.email" required>
                    </div>
                    <div class="form-group field-group">
                        <label for="password" class="color-green">Mot de passe</label>
                        <input type="password" id="password" class="form-control" v-model="userData.password" required>
                    </div>
                    <div class="form-group field-group">
                        <label for="passwordConfirm" class="color-green">Confirmation mot de passe</label>
                        <input type="password" id="passwordConfirm" class="form-control" v-model="userData.password_confirmation" required>
                    </div>
                    <div class="form-group field-group">
                        <label for="postCode" class="color-green">Code postal</label>
                        <input type="text" id="postCode" class="form-control" v-model="userData.zipcode" required>
                    </div>
                    <div class="form-group field-group">
                        <label for="garanty" class="color-green">Assurance</label>
                        <input type="text" id="garanty" class="form-control" v-model="userData.garanty" required>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button class="submit-btn" @click="submit">Valider</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import uiMixin from 'Mixins/uiMixin.js';
import validationHelper from 'Helpers/validationHelper.js';

export default {
    name: 'Registration',
    mixins: [uiMixin],
    data() {
        return {
            userData: {
                first_name: null,
                last_name: null,
                email: null,
                password: null,
                password_confirmation: null,
                zipcode: null,
                garanty: null,
            },
            validationHelper: validationHelper
        }
    },
    methods: {
        submit() {
            this.setDataLoadingStart();
            let validationMessages = this.validate();

            if (validationMessages.length > 0) {
                this.setErrorMessages(validationMessages);
                this.setDataLoadingEnd();

                return false;
            }

            this.$http.post('/register', this.userData).then((response) => {
                if (response.data.data.status) {
                    this.setSuccessMessage('Vous vous êtes inscrit avec succès')
                    this.setDataLoadingEnd();

                    this.$router.push({name: 'login'})
                }
            }).catch(error => {
                this.setDataLoadingEnd();
                this.parseHttpErrorMessage(error)
            })
        },
        validate() {
            let messages = [];
            let validation = this.validationHelper;

            if (!this.userData.first_name) {
                messages.push(validation.messages.emptyField('Prénom'))
            }

            if (!this.userData.last_name) {
                messages.push(validation.messages.emptyField('Nom'))
            }

            if (!this.userData.email) {
                messages.push(validation.messages.emptyField('Email'))
            }

            if (!this.userData.password) {
                messages.push(validation.messages.emptyField('Mot de passe'))
            }

            if (!this.userData.zipcode) {
                messages.push(validation.messages.emptyField('Code postal'))
            }

            if (this.userData.email && !validation.email(this.userData.email)) {
                messages.push(validation.messages.incorrectEmail())
            }

            if (this.userData.password && !validation.passwordConfirmed(this.userData.password, this.userData.password_confirmation)) {
                messages.push(validation.messages.passwordIsNotConfirmed())
            }

            return messages;
        }
    }
}

</script>

<style>


</style>