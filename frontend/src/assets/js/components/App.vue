<template>
    <main>
        <router-view></router-view>
        <Waiting v-if="isWaiting" />
        <Toast class="main-toast" />
        <Preloader />
    </main>
</template>

<script>

import Waiting from 'Components/Waiting.vue';
import Preloader from 'Components/Preloader.vue';
import uiMixin from 'Mixins/uiMixin.js';
import apiData from 'Mixins/apiData.js';

export default {
    name: 'App',
    components: {Waiting, Preloader},
    mixins: [uiMixin, apiData],
    data() {
        return {
            isWaiting: true
        }
    },
    created() {
        this.setWaitingWrapper()

        if (this.$store.getters.userToken) {
            this.getCurrentUser().then(response => {
                this.$store.dispatch('setUser', response)
            }).catch(error => {
                this.parseHttpErrorMessage(error);
            })
        }
    },
    methods: {
        setWaitingWrapper() {
            setTimeout(() => {
                this.isWaiting = false;
            }, 2000)
        }
    }
}

</script>

<style scoped>



</style>