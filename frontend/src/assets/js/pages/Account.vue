<template>
    <div class="layer-block3">
        <div class="block-header">
            <div class="main-container">
                <p class="page-title-regular d-flex align-items-center color-white">
                    <button class="btn-back" @click="$router.push({name: 'home'})">
                        <img src="../../images/icons/chevron-left.svg" alt="">
                    </button>
                    <span class="d-block">Ma progression</span>
                </p>
                <StartProgress :percent="totalCompletedChallengesPercent" :count="currentUser.completed_challenges.length" />
            </div>
        </div>
        <div class="block-header-label">
            <div class="block-header-main-img">
                <img :src="currentUser.image" alt="">
            </div>
        </div>
        <div class="block-content main-bg relative-block">
            <div class="main-container">
                <div class="d-flex justify-content-center account-title">
                    <p class="info-title-bold">Impact des défis</p>
                </div>
                <div class="device-progress-block mb-2">
                    <p class="info-title-bold">Défis lv</p>
                    <ProgressBar :percent="totalCompletedChallengesPercent" />
                </div>
                <div class="stat-block">
                    <p class="info-title-bold">Nouvelles habitudes</p>
                    <div class="statistics" v-if="challengeCategories.length > 0">
                        <div class="stat-row" v-for="challengeCategory in challengeCategories" :key="challengeCategory.id">
                            <div class="stat-img">
                                <div class="img-block">
                                    <img :src="challengeCategory.image" alt="">
                                </div>
                            </div>
                            <div class="stat-title">{{ challengeCategory.name }}</div>
                            <div class="stat-rating"> {{ countUserChallengesByCategory(challengeCategory) }}/{{ challengeCategory.challenges_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <Footer />
        </div>
    </div>
</template>

<script>

import StartProgress from 'Components/StarProgress.vue'
import ProgressBar from 'Components/ProgressBar.vue'
import Footer from 'Components/Footer.vue'
import uiMixin from 'Mixins/uiMixin.js';
import apiData from 'Mixins/apiData.js';

export default {
    name: 'Account',
    components: {StartProgress, ProgressBar, Footer},
    mixins: [uiMixin, apiData],
    data() {
        return {
            hasEnviroServer: false,
            isAuthorized: false,
        }
    },
    mounted() {
        this.setDataLoadingStart();

        if (this.challengeCategories.length === 0) {
            this.getChallengeCategories().then(response => {
                this.$store.dispatch('setChallengeCategories', response);
                this.setDataLoadingEnd();
            }).catch(error => {
                this.parseHttpErrorMessage(error);
                this.setDataLoadingEnd();
            });
        } else {
            this.setDataLoadingEnd();
        }
    },
    methods: {
        countUserChallengesByCategory(challengeCategory) {
            return this.currentUser.completed_challenges.filter(completedChallenge => completedChallenge.category.id === challengeCategory.id).length
        },
        
    },
    computed: {
        currentUser() {
            return this.$store.getters.user;
        },
    }
}

</script>


<style scoped lang="scss">

.page-title-regular {
    margin: 7px;

    .btn-back {
        margin-right: 30px;
    }
}

.account-title {
    padding-top: 34px;
    padding-left: 89px;
    margin-bottom: 27px;
}

.stat-block {
    .info-title-block {
        margin-bottom: 28px;
    }
}

</style>