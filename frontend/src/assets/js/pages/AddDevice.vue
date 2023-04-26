<template>
    <div class="layer-block">
        <div class="block-header">
            <div class="main-container">
                <p class="page-title-regular d-flex align-items-center color-white">
                    <button class="btn-back" @click="$router.push({name: 'devices'})">
                        <img src="../../images/icons/chevron-left.svg" alt="">
                    </button>
                    <span class="d-block mar-r-20">{{ equipmentData.name ?? 'Appareil' }}</span>
                    <img src="../../images/icons/pencil.svg" alt="">
                </p>
            </div>
        </div>
        <div class="block-content main-bg">
            <div class="main-container equipmentCategories-content">
                <h3 class="main-heading color-green">
                    Complète les infos de <br> ton équipement !
                </h3>

                <div class="form-block add-device">
                    <div class="form-group field-group">
                        <label for="deviceCategory" class="color-green">Catégorie produit</label>
                        <template v-if="equipmentCategories.length > 0">
                            <FormSelect :options="equipmentCategories" @select="setSelectedEquipmentCategory" :default="currentEquipmentCategory" />
                        </template>
                    </div>
                    <div class="form-group field-group">
                        <label for="name" class="color-green">Nom de l’appareil</label>
                        <input type="text" id="name" class="form-control" v-model="equipmentData.name" required>
                    </div>
                    <div class="form-group field-group">
                        <label for="buyDate" class="color-green">Date d’achat</label>
                        <Calendar inputId="buyDate" v-model="equipmentData.buyDate" class="form-date" :manualInput="false" autocomplete="off" dateFormat="dd/mm/yy" required />
                    </div>
                    <div class="form-group field-group">
                        <label for="model" class="color-green">Marque</label>
                        <input type="text" id="model" class="form-control" v-model="equipmentData.brand" required>
                    </div>
                    <div class="form-group field-group">
                        <label for="serialNumber" class="color-green">Numéro de série</label>
                        <input type="number" id="serialNumber" class="form-control" v-model="equipmentData.serial_number" required>
                    </div>
                    <div class="form-group field-group">
                        <span class="color-green form-label">Documents</span>
                        <div class="files-block">
                            <template v-if="equipmentData.documents.length > 0">
                                <div class="document" v-for="(document, index) in equipmentData.documents" :key="index">
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
                </div>
                
                <div class="d-flex justify-content-center align-items-center">
                    <button class="submit-btn" @click="submit">Valider</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import FormSelect from 'Components/FormSelect.vue';
import validationHelper from 'Helpers/validationHelper.js';
import uiMixin from 'Mixins/uiMixin.js';
import apiData from 'Mixins/apiData.js';

export default {
    name: 'AddDevice',
    components: {FormSelect},
    mixins: [uiMixin, apiData],
    data() {
        return {
            equipmentData: {
                name: null,
                buyDate: null,
                equipment_category_id: null,
                serial_number: null,
                brand: null,
                documents: []
            },
            validationHelper: validationHelper
        }
    },
    methods: {
        submit() {
            this.setDataLoadingStart();

            this.equipmentData.user_id = this.currentUser.id;
            this.equipmentData.buy_date = this.$moment(this.equipmentData.buyDate).format('YYYY-MM-DD hh:mm:ss');

            let validationMessages = this.validate();

            if (validationMessages.length > 0) {
                this.setErrorMessages(validationMessages);
                this.setDataLoadingEnd();

                return false;
            }

            this.$http.post('equipments/create', this.equipmentData, {headers: {'Content-Type': 'multipart/form-data'}})
            .then(response => {
                if (response.status === 200) {
                    this.setSuccessMessage('Entrée créée avec succès');
                }

                this.getUserEquipments().then(response => {
                    this.$store.dispatch('setUserEquipments', response);
                    this.setDataLoadingEnd();
                    this.$router.push('/');
                }).catch(error => {
                    this.parseHttpErrorMessage(error);
                    this.setDataLoadingEnd();
                    this.$router.push('/');
                });

                
            }).catch(error => {
                this.setDataLoadingEnd();
                this.parseHttpErrorMessage(error);
            })

            
        },
        setSelectedEquipmentCategory(value) {
            this.equipmentData.equipment_category_id = value.id;
            this.setDevaiceDefaultName(
                this.equipmentCategories.filter(equipmentCategory => equipmentCategory.id == value.id)[0].name ?? null
            );
        },
        uploadFile(e) {
            let file = e.target.files && e.target.files.length ? e.target.files[0] : false;

            if (file) {
                this.equipmentData.documents.push(file);
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
        async setEquipmentCategories() {
            if (this.equipmentCategories.length === 0) {
                await this.getEquipmentCategories().then(response => {
                    this.$store.dispatch('setEquipmentCategories', response);
                }).catch(error => {
                    this.parseHttpErrorMessage(error);
                });
            }
        },
        setDevaiceDefaultName(name) {
            this.equipmentData.name = name
        },
        validate() {
            let messages = [];
            let validation = this.validationHelper;

            if (!this.equipmentData.equipment_category_id) {
                messages.push(validation.messages.emptyField('Catégorie produit'))
            }

            if (!this.equipmentData.name) {
                messages.push(validation.messages.emptyField('Nom de l’appareil'))
            }

            if (!this.equipmentData.buyDate) {
                messages.push(validation.messages.emptyField('Date d’achat'))
            }

            if (!this.equipmentData.brand) {
                messages.push(validation.messages.emptyField('Marque'))
            }

            if (!this.equipmentData.serial_number) {
                messages.push(validation.messages.emptyField('Numéro de série'))
            }

            if (!this.equipmentData.documents || this.equipmentData.documents.length === 0) {
                messages.push(validation.messages.emptyField('Documents'))
            }

            return messages;
        }
    },
    async mounted() {
        this.setDataLoadingStart();
        await this.setEquipmentCategories();
        this.setDevaiceDefaultName(this.currentEquipmentCategory.name);
        this.setDataLoadingEnd();
    },
    computed: {
        currentEquipmentCategory() {
            return this.equipmentCategories.filter(equipmentCategory => equipmentCategory.id == this.$route.params.id)[0] ?? null;
        },
    }
}

</script>

<style>

.btn-back {
    z-index: 9;
}

.main-heading {
    padding-top: 28px;
    margin-bottom: 26px;
}

</style>