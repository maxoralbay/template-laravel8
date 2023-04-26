export default {
    methods: {
        setSuccessMessage(message, title = 'Succès!') {
            this.$toast.add({severity:'success', summary: title, detail: message, life: 4000});
        },
        setErrorMessage(message, title = 'Erreur!') {
            this.$toast.add({severity:'error', summary: title, detail: message, life: 4000});
        },
        setSuccessMessages(messages) {
            for (let message of messages) {
                setTimeout(() => this.setSuccessMessage(message), 300)
            }
        },
        setErrorMessages(messages) {
            for (let message of messages) {
                setTimeout(() => this.setErrorMessage(message), 300)
            }
        },
        parseHttpErrorMessage(errorObject) {
            if (errorObject.response && errorObject.response.status && errorObject.response.status === 401) {
                this.$store.dispatch('logoutUser');
                this.$router.push({name: 'login'})
                
                return false;
            }

            if (errorObject.response && errorObject.response.data) {
                if (errorObject.response.data.errors) {
                    this.setErrorMessages(
                        this.parseHttpValidationMessages(errorObject.response.data.errors)
                    );

                    return true;
                }   

                if (errorObject.response.data.data && errorObject.response.data.data.message) {
                    this.setErrorMessage(errorObject.response.data.data.message);

                    return true;
                }

                if (errorObject.response.data.message) {
                    console.log(errorObject.response.data.message)
                }
            }

            if (errorObject.message) {
                this.setErrorMessage(errorObject.message);

                return true;
            }

            this.setErrorMessage('Veuillez réessayer plus tard.')
        },
        parseHttpValidationMessages(messagesObject) {
            let messages = [];

            for (let messageKey in messagesObject) {
                messagesObject[messageKey].forEach(message => {
                    messages.push(message)
                })
            }

            return messages;
        },
        setDataLoadingStart() {
            this.$store.dispatch('setDataLoading', true)
        },
        setDataLoadingEnd() {
            this.$store.dispatch('setDataLoading', false)
        }
    }
}