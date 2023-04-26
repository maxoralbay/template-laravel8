<template>
    <div class="task-card" :class="{closed: isCardClosed, checked: isCardChecked}">
        <div class="task-card-header" @click="toggleClosed">
            <div class="task-head-info">
                <p class="task-title">{{ taskData.title }}</p>
                <p class="task-subtitle">{{ taskData.subtitle ?? '' }}</p>
            </div>
            <div class="task-head-action">
                <div class="task-category-icon">
                    <img v-if="!isCardChecked" :src="taskData.category.image ?? ''" alt="">
                    <img v-else :src="taskData.category.image_checked ?? ''" alt="">
                </div>
                <div class="chevron">
                    <img v-if="!isCardChecked" src="../../images/icons/chevron-up.svg" alt="">
                    <img v-else src="../../images/icons/chevron-up-white.svg" alt="">
                </div>
            </div>
        </div>
        <div class="task-card-content" v-if="!isCardClosed">
            <div class="task-card-body">
                <div class="info" v-html="taskData.content ?? ''"></div>
            </div>
            <div class="task-card-footer">
                <button class="task-check" @click="toggleChecked">
                    <img v-if="!isCardChecked" src="../../images/icons/checked-big.png" alt="">
                    <img v-else src="../../images/icons/checked-big-blue.png" alt="">
                </button>
                <span class="task-footer-title">Fait</span>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'TaskCard',
    props: {
        isClosed: {
            type: Boolean,
            default: false,
        },
        isChecked: {
            // type: Boolean,
            default: false,
        },
        showImage: {
            type: Boolean,
            default: false,
        },
        task: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            isCardChecked: this.isChecked,
            isCardClosed: this.isClosed,
            taskData: this.task,
        }
    },
    methods: {
        toggleChecked() {
            this.isCardChecked = !this.isCardChecked;
            this.$emit('toggleCheck');
        },
        toggleClosed() {
            this.isCardClosed = !this.isCardClosed;
        }
    }
}

</script>

<style scoped lang="scss">



</style>