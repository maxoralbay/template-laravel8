<template>
    <div class="task-mini-card" :style="{backgroundColor: mainColor}">
        <div class="task-btns">
            <div class="task-points">
                <span class="point" :style="{borderColor: secondaryColor}"></span>
                <span class="point" :style="{borderColor: secondaryColor}"></span>
                <span class="point" :style="{borderColor: secondaryColor}"></span>
            </div>
            <button class="task-check" @click="toggleTaskCheck" :style="{backgroundColor: mainColor, borderColor: secondaryColor}">
                <i class="pi pi-check icon" :style="{color: secondaryColor}"></i>
            </button>
        </div>
        <div class="task-content">
            <p class="task-title" :style="{color: secondaryColor}">{{ challengeData.title }}</p>
            <span class="task-subtitle" :style="{color: isTaskChecked ? '#fff' : '#0F1828'}">{{ challengeData.subtitle }}</span>
            <p class="task-text" :style="{color: isTaskChecked ? '#fff' : '#0F1828'}" v-html="challengeData.content"></p>
        </div>
        <div class="task-icons">
            <img v-if="!isTaskChecked" :src="challengeData.category.image" class="category-icon" alt="">
            <img v-else :src="challengeData.category.image_checked" class="category-icon" alt="">
        </div>
    </div>
</template>

<script>

export default {
    name: 'TaskMiniCard',
    props: {
        challenge: {
            type: Object,
            required: true
        },
        isChecked: {
            // type: Boolean,
            default: false
        }
    },
    data() {
        return {
            isTaskChecked: this.isChecked,
            mainColor: null,
            secondaryColor: null,
            challengeData: this.challenge
        }
    },
    created() {
        this.setTaskColors()
        console.log(this.challengeData)
    },
    methods: {
        toggleTaskCheck() {
            this.isTaskChecked = !this.isTaskChecked;
            this.setTaskColors()
            this.$emit('toggleCheck')
        },
        setTaskColors() {
            this.mainColor = this.isTaskChecked ? this.challengeData.category.color : '#fff';
            this.secondaryColor = this.isTaskChecked ? '#fff' : this.challengeData.category.color;
        }
    }
}

</script>

<style scoped>



</style>