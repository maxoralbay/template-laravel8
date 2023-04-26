<template>
    <div class="preloader-wrap" v-if="isDataLoading">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Preloader',
    computed: {
            isDataLoading() {
                return this.$store.getters.isDataLoading;
            }
    },
}

</script>

<style scoped>
.preloader-wrap {
    position: fixed;
    width: 100%;
    height: 115vh;
    display: flex;
    justify-content: center;
    align-items: center;
    /* background-color: #23A492; */
    /* background-color: rgba(0, 0, 0, 0.8); */
    background-color: rgba(35,164,146, 0.8);
    z-index: 999;
    left: 0;
    top: -60px;
}
.btn-container {
position: relative;
}
.lds-ripple {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ripple div {
  position: absolute;
  border: 4px solid #fff;
  opacity: 1;
  border-radius: 50%;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.lds-ripple div:nth-child(2) {
  animation-delay: -0.5s;
}
@keyframes lds-ripple {
  0% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 0;
  }
  4.9% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 0;
  }
  5% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 1;
  }
  100% {
    top: 0px;
    left: 0px;
    width: 72px;
    height: 72px;
    opacity: 0;
  }
}

</style>