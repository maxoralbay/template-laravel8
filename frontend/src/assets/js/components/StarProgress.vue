<template>
    <div class="progress-block">
        <div class="progress-mid">
            <div class="progress-bar">
                <div class="progress-fill" :style="{width: percent + '%'}"></div>
                <div class="progress-star">
                    <img src="../../images/icons/star.svg" alt="">
                    <span>{{ count }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'StarProgress',
    props: {
        percent: {
            type: Number,
            default: 10
        },
        count: {
            type: Number,
            default: 10
        }
    },
    data() {
        return {
            
        }
    },
    mounted() {
        
    },
    methods: {
        
    }
}

</script>

<style>


</style>