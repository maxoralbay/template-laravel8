<template>
    <div class="layer-block">
        <div class="block-header">
            <div class="main-container">
                <p class="page-title-regular color-white">
                    <button class="btn-back">
                        <img src="../../images/icons/chevron-left.svg" alt="">
                    </button>
                    <span>Ajouter un appareil</span>
                </p>
            </div>
        </div>
        <div class="block-content main-bg">
            <div class="main-container devices-content">
                <h3 class="main-heading color-green">
                    Quels appareils <br>
                    voulez-vous ajouter ?
                </h3>
                <div class="devices-block">
                    <a @click.prevent="$router.push({name: 'add-device', params: {id: equipmentCategory.id}})" class="device" v-for="equipmentCategory in equipmentCategories" :key="equipmentCategory.id">
                        <div class="device-img">
                            <img :src="equipmentCategory.image" alt="">
                        </div>
                        <p class="device-title">{{ equipmentCategory.name }}</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import uiMixin from 'Mixins/uiMixin.js';
import apiData from 'Mixins/apiData.js';

export default {
    name: 'Devices',
    mixins: [uiMixin, apiData],
    data() {
        return {}
    },
    async mounted() {
        this.setDataLoadingStart();
        await this.setEquipmentCategories();
        this.setDataLoadingEnd();
    },
    methods: {
        async setEquipmentCategories() {
            if (this.equipmentCategories.length === 0) {
                await this.getEquipmentCategories().then(response => {
                    this.$store.dispatch('setEquipmentCategories', response);
                }).catch(error => {
                    this.parseHttpErrorMessage(error);
                });
            }
        }
    }
}

</script>

<style>


</style>