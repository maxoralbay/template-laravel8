<template>
    <div class="layer-block">
        <div class="block-header">
            <div class="main-container">
                <p class="page-title-regular color-white">
                    <button class="btn-back" @click="$router.push({name: 'home'})">
                        <img src="../../images/icons/chevron-left.svg" alt="">
                    </button>
                    <span>Challenges</span>
                </p>
            </div>
        </div>
        <div class="block-content main-bg">
            <div class="main-container devices-content">
                <h3 class="main-heading color-green">
                    Défis de réduction <br>
                    d’impact
                </h3>
                <div class="challenges-block" v-if="challenges.length > 0">
                    <TaskCard 
                        v-for="challenge in challenges" 
                        :key="challenge.id" 
                        :task="challenge" 
                        :isChecked="isChallengeCompletedByUser(challenge)"
                        @toggleCheck="toggleChallengeCheck(challenge)"
                    />
                </div>
            </div>
            <Footer />
        </div>
    </div>
</template>

<script>

import TaskCard from 'Components/TaskCard.vue'
import Footer from 'Components/Footer.vue'
import apiData from 'Mixins/apiData.js';
import uiMixin from 'Mixins/uiMixin.js';

export default {
    name: 'Challenges',
    components: {TaskCard, Footer},
    mixins: [uiMixin, apiData],
    data() {
        return {
            challenges: []
        }
    },
    mounted() {
        this.setDataLoadingStart();

        this.getGlobalChallenges().then(response => {
            this.challenges = response;
            this.setDataLoadingEnd();
        }).catch(error => {
            this.setDataLoadingEnd();
            this.parseHttpErrorMessage(error);
        });
    },

}

</script>

<style scoped lang="scss">

.block-content {
    padding-bottom: 100px !important;
}

</style>