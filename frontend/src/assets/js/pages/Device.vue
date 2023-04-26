<template>
    <div class="layer-block2">
        <div class="block-header">
            <div class="main-container">
                <p class="page-title-regular d-flex align-items-center color-white">
                    <button class="btn-back" @click="$router.push({name: 'home'})">
                        <img src="../../images/icons/chevron-left.svg" alt="">
                    </button>
                    <span class="d-block mar-r-20">{{ currentEquipment.name ?? 'Appareil' }}</span>
                </p>
            </div>
        </div>
        <div class="block-header-label">
            <div class="block-header-main-img">
                <img v-if="currentEquipment.category" :src="currentEquipment.category.image" alt="">
            </div>
        </div>
        <div class="block-content main-bg relative-block">
            <div class="main-container devices-content">
                <h3 class="device-model" v-if="currentEquipment.category">{{ currentEquipment.name ?? currentEquipment.category.name }}</h3>
                <p class="device-subtitle">{{ currentEquipment.brand }}</p>

                <div class="device-documents-block">
                    <p class="info-title-bold">Documents</p>
                    <div class="files-block mb-3">
                        <template v-if="currentEquipment.documents && currentEquipment.documents.length > 0">
                            <div class="document" v-for="(document, index) in currentEquipment.documents" :key="index">
                                <div class="document-img" :class="{active: index === 0}">
                                    <img src="../../images/icons/document.svg" alt="">
                                </div>
                                <span class="name text-center">{{ extractFileName(document) }}</span>
                            </div>
                        </template>
                        <div class="file-input-btn-container">
                            <label for="documents" class="file-input-btn">
                                <img src="../../images/icons/plus.svg" alt="">
                            </label>
                        </div>
                        <input type="file" @change="uploadFile" id="documents" class="file-input" required>
                    </div>
                </div>
                <div class="device-progress-block">
                    <p class="info-title-bold">Défis lv</p>
                    <ProgressBar :percent="deviceChallengesProgressPercent" />
                </div>
                <div class="tasks-block" v-if="challenges.length > 0">
                    <TaskCard 
                        v-for="challenge in challenges" 
                        :key="challenge.id" 
                        :task="challenge" 
                        :isChecked="isChallengeCompletedByUser(challenge)"
                        @toggleCheck="toggleChallengeCheck(challenge)"
                    />
                </div>
                <div class="d-flex justify-content-center">
                    <button class="device-edit-btn" @click="$router.push({name: 'edit-device', params: {id: $route.params.id}})">
                        <div class="edit-img">
                            <img src="../../images/icons/pencil.svg" alt="">
                        </div>
                        <span>Editer l’appareil</span>
                    </button>
                </div>
            </div>
            <Footer />
        </div>
    </div>
</template>

<script>

import FormSelect from 'Components/FormSelect.vue';
import ProgressBar from 'Components/ProgressBar.vue';
import TaskCard from 'Components/TaskCard.vue';
import Footer from 'Components/Footer.vue';
import apiData from 'Mixins/apiData.js';
import uiMixin from 'Mixins/uiMixin.js';

export default {
    name: 'Device',
    components: {FormSelect, ProgressBar, TaskCard, Footer},
    mixins: [uiMixin, apiData],
    data() {
        return {
            currentEquipment: {},
            challenges: []
        }
    },
    methods: {
        uploadFile(e) {
            this.setDataLoadingStart();

            let file = e.target.files && e.target.files.length ? e.target.files[0] : false;
            let docs = {documents: []};

            if (file) {
                this.currentEquipment.documents.push(file);
                docs.documents.push(file);

                this.$http.post('/equipments/add-document/' + this.$route.params.id, docs, {headers: {'Content-Type': 'multipart/form-data'}})
                .then((response) => {
                    this.setDataLoadingEnd();
                }).catch(error => {
                    this.setDataLoadingEnd();
                    this.parseHttpErrorMessage(error);
                })
            }
        },
        extractFileName(file) {
            if (file.name) {
                let fileName = file.name.split('.')[0];

                if (fileName.length > 9) {
                    return fileName.slice(0, 9) + '...';
                }

                return fileName;
            }

            return 'No name';
        },
    },
    mounted() {
        this.setDataLoadingStart();

        this.$http.get('/equipments/show/' + this.$route.params.id).then((response) => {
            if (response.data.data) {
                this.currentEquipment = response.data.data
            }

            this.getEquipmentCategoryChallenges(this.currentEquipment.category.id).then(response => {
                this.challenges = response;
                this.setDataLoadingEnd();
            }).catch(error => {
                this.parseHttpErrorMessage(error);
                this.setDataLoadingEnd();
            })
        }).catch(error => {
            this.setDataLoadingEnd();
            this.parseHttpErrorMessage(error);
        })
    },
    computed: {
        deviceChallengesProgressPercent() {
            let result = (this.completedChallengesCountByCurrentDevice * 100) / this.challenges.length;

            return isNaN(result) || result < 0 ? 0 : result;
        },
        completedChallengesCountByCurrentDevice() {
            let result = this.currentEquipment.category ? this.completedChallengesWithEquipmentCategory.filter(completedChallenge => {
                return completedChallenge.equipment_category.id === this.currentEquipment.category.id
            }).length : 0;
            
            return isNaN(result) || result < 0 ? 0 : result;
        },
        completedChallengesWithEquipmentCategory() {
            return this.currentUser.completed_challenges.filter(completedChallenge => completedChallenge.equipment_category)
        }
    }
}

</script>

<style scoped>
    .device-progress-block {
        margin-bottom: 57px;
    }

    .tasks-block {
        margin-bottom: 12px;
    }

    .layer-block2 .block-content {
        padding-bottom: 150px;
    }

</style>