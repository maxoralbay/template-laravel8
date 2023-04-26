<template>
    <div class="tasks-section main-bg" v-if="currentCategory">
        <div class="section-header" :style="{backgroundColor: currentCategory.color}">
            <div class="main-container relative-block">
                <p class="page-title-regular d-flex justify-content-center color-white">
                    <span class="d-block">{{ currentCategory.name }}</span>
                </p>
                <button class="btn-back" @click="$router.push({name: 'home'})">
                    <img src="../../images/icons/chevron-left-white.svg" alt="">
                </button>
                <div class="d-flex justify-content-center">
                    <div class="task-category-main-img">
                        <img :src="currentCategory.image" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="main-container">
                <p class="info-title-bold text-center" :style="{color: currentCategory.color}">Challenge de réparation</p>
                <div class="category-progress-block">
                    <div class="progress-bar" :style="{backgroundColor: currentCategory.color}">
                        <div class="progress-fill" :style="{width: categoryCompletedChallengesPercent(currentCategory) + '%'}"></div>
                        <div class="progress-star">
                            <img src="../../images/icons/star.svg" alt="">
                            <span>{{ countUserChallengesByCategory(currentCategory) }} /{{ currentCategory.challenges_count ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                <div class="category-tasks-block" v-if="challenges.length > 0">
                    <TaskMiniCard 
                        v-for="challenge in challenges" 
                        :key="challenge.id" 
                        :challenge="challenge" 
                        :isChecked="isChallengeCompletedByUser(challenge)"
                        @toggleCheck="toggleChallengeCheck(challenge)"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import TaskMiniCard from 'Components/TaskMiniCard.vue'
import uiMixin from 'Mixins/uiMixin.js';
import apiData from 'Mixins/apiData.js';

export default {
    name: 'Tasks',
    components: {TaskMiniCard},
    mixins: [uiMixin, apiData],
    data() {
        return {
            challenges: []
        }
    },
    methods: {
        countUserChallengesByCategory(challengeCategory) {
            return this.currentUser.completed_challenges.filter(completedChallenge => completedChallenge.category.id === challengeCategory.id).length
        },
        categoryCompletedChallengesPercent(challengeCategory) {
            return (this.countUserChallengesByCategory(challengeCategory) * 100) / challengeCategory.challenges_count
        }
    },
    mounted() {
        this.setDataLoadingStart();
        this.getChallengesByCategory(this.$route.params.category_id).then(response => {
            this.challenges = response;
            this.setDataLoadingEnd();
        }).catch(error => {
            this.parseHttpErrorMessage(error);
            this.setDataLoadingEnd();
        })
    },
    computed: {
        currentCategory() {
            if (this.challenges.length > 0) {
                return this.challenges.filter(challenge => challenge.category.id == this.$route.params.category_id)[0].category ?? null;
            }
            
            return null;
        },
    }
}

</script>

<style scoped lang="scss">

.page-title-regular {
    margin-bottom: 23px;
}

.btn-back {
    position: absolute;
    top: 0;
    right: 0;
}

.section-content {
    padding-top: 22px;
}

.info-title-bold {
    margin-bottom: 16px;
}

</style>