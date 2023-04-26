<template>
    <div class="progress-block">
        <div class="progress-top">
            <p class="percentage">{{ percent }}%</p>
        </div>
        <div class="progress-mid">
            <div class="progress-bar">
                <div class="progress-fill" :style="{width: percent + '%'}"></div>
            </div>
        </div>
        <div class="progress-bottom">
            <div class="years">
                <span>2 ans</span>
            </div>
            <div class="years-desc">
                <span class="text">
                    obsolescence <br>
                    observée (8 ans)
                </span>
                <span class="divider"></span>
                <div class="years-label">
                    Objectif <br>
                    10 ans
                </div>
            </div>
        </div>
        <div class="progress-labels">
            <div class="label">8 €</div>
            <div class="label">3 kgCO2 eq</div>
            <div class="label">5 kg dechet</div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'ProgressBar',
    props: {
        percent: {
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