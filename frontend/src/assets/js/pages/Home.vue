<template>
    <div class="layer-block4">
        <div class="block-header">
            <div class="main-container">
                <p class="page-title-regular d-flex align-items-center justify-content-center color-white">
                    <span class="d-block">Ma progression</span>
                </p>
                <div class="header-progress">
                    <StartProgress :percent="totalCompletedChallengesPercent" :count="currentUser.completed_challenges.length" />
                </div>
            </div>
            <div class="challenges-block">
                <p class="page-title-bold d-flex align-items-center justify-content-center color-white">
                    <span class="d-block">Mes challenges ({{ currentChallengesCount }})</span>
                </p>
                <div class="challenges">
                    <a class="challenge" :href="'/tasks/' + challengeCategory.id" v-for="challengeCategory in challengeCategories" :key="challengeCategory.id">
                        <div class="challenge-img">
                            <img :src="challengeCategory.image" alt="">
                        </div>
                        <p class="challenge-title">{{ challengeCategory.name }}</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="block-content main-bg">
            <div class="main-container devices-content">
                <div class="divider-line"></div>
                <div class="d-flex align-items-center">
                    <p class="info-title-bold mb-0">Mes appareils ({{ userEquipments.length }})</p>
                    <button class="add-device-btn" @click="$router.push({name: 'devices'})">
                        <span>+</span>
                    </button>
                    <button class="btn-down">
                        <img src="../../images/icons/chevron-down.svg" alt="">
                    </button>
                </div>
                <div class="devices-block">
                    <a :href="'/devices/show/' + userEquipment.id" class="device" v-for="userEquipment in userEquipments" :key="userEquipment.id">
                        <div class="device-img">
                            <img :src="userEquipment.category.image" alt="">
                        </div>
                        <p class="device-title">{{ userEquipment.name ?? userEquipment.category.name }}</p>
                    </a>
                </div>
            </div>
            <Footer />
        </div>
    </div>
</template>

<script>

import StartProgress from 'Components/StarProgress.vue'
import Footer from 'Components/Footer.vue'
import uiMixin from 'Mixins/uiMixin.js';
import apiData from 'Mixins/apiData.js';

export default {
    name: 'Home',
    components: {StartProgress, Footer},
    mixins: [uiMixin, apiData],
    data() {
        return {}
    },
    async mounted() {
        this.setDataLoadingStart();
        await this.setUserEquipments();
        await this.setChallengeCategories();
        this.setDataLoadingEnd();
    },
    methods: {
        async setUserEquipments() {
            if (this.userEquipments.length === 0) {
                await this.getUserEquipments().then(response => {
                    this.$store.dispatch('setUserEquipments', response);
                }).catch(error => {
                    this.parseHttpErrorMessage(error);
                });
            }
        },
        async setChallengeCategories() {
            if (this.challengeCategories.length === 0) {
                await this.getChallengeCategories().then(response => {
                    this.$store.dispatch('setChallengeCategories', response);
                }).catch(error => {
                    this.parseHttpErrorMessage(error);
                });
            }
        },
    },
    computed: {
        currentChallengesCount() {
            let currentChallengesCount = this.totalChallengesCount - this.currentUser.completed_challenges.length;
            return currentChallengesCount >= 0 ? currentChallengesCount : 0;
        }
    }
}

</script>


<style scoped lang="scss">

.page-title-regular {
    margin: 7px;
}

.info-title-bold {
    margin-right: 16px;
}

.header-progress {
    margin-bottom: 43px;
}

.challenges-block {
    padding: 0 10px;
}

.divider-line {
    width: 100%;
    height: 1px;
    background-color: #777980;
    opacity: 0.28;
    margin-bottom: 16px;
}

.devices-content {
    padding-top: 0;
    padding-bottom: 50px;
}

.devices-content .devices-block {
    padding-top: 39px;
}

.add-device-btn {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 33px;
    height: 33px;
    background-color: #fff;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 36px;
    color: #003459;
    margin-right: 50px;
}

.btn-down {
    background-color: transparent;
    border: none;
}

</style>