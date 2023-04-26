export default {
    email(value) {
        return value.match(
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    },
    passwordConfirmed(password, confirmation) {
        return password === confirmation;
    },
    messages: {
        incorrectEmail() {
            return 'Adresse Email incorrecte';
        },
        emptyField(fieldName) {
            return `Le champ ${fieldName} ne doit pas être vide`
        },
        passwordIsNotConfirmed() {
            return 'Les mots de passe ne correspondent pas';
        }
    }
}