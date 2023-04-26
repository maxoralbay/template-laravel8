<template>
    <div class="footer" :class="{opened: isOpened}">
        <div class="footer-top">
            <button class="global-tasks-btn" @click="toChallenges">
                <img src="../../images/icons/earth.png" alt="">
            </button>
            <button class="frame-btn" @click="toggle">
                <img src="../../images/icons/lv.png" alt="">
                <span>Besoin d’aide</span>
            </button>
            <button class="account-btn" @click="toAccount">
                <img src="../../images/icons/user.png" alt="">
            </button>
        </div>
        <div class="footer-bottom">
            <!-- <iframe src="https://www.e-reparation.eco/annuaire-reparateurs-qualirepar"></iframe> -->
            <iframe src="https://www.spareka.fr/comment-reparer"></iframe>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Footer',
    data() {
        return {
            isOpened: false
        }
    },
    methods: {
        toggle() {
            this.isOpened = !this.isOpened;
        },
        toAccount() {
            this.$router.push({name: 'account'})
        },
        toChallenges() {
            this.$router.push({name: 'challenges'})
        }
    }
}

</script>

<style scoped>


</style>