export default {
    methods: {
        getEquipmentCategories() {
            return new Promise((resolve, reject) => {
                this.$http.get('/equipment-categories').then((response) => {
                    if (response.data.data) {
                        resolve(response.data.data)
                    } else {
                        reject('No content')
                    }
                }).catch(error => {
                    reject(error);
                })
            });
        },
        getUserEquipments() {
            return new Promise((resolve, reject) => {
                this.$http.get('/equipments').then((response) => {
                    if (response.data.data) {
                        resolve(response.data.data)
                    } else {
                        reject('No content')
                    }
                }).catch(error => {
                    reject(error);
                })
            });
        },
        getChallengeCategories() {
            return new Promise((resolve, reject) => {
                this.$http.get('/challenge-categories').then((response) => {
                    if (response.data.data) {
                        resolve(response.data.data)
                    } else {
                        reject('No content')
                    }
                }).catch(error => {
                    reject(error);
                })
            });
        },
        getEquipmentCategoryChallenges(equipmentCategoryId) {
            return new Promise((resolve, reject) => {
                this.$http.get('/challenges?equipment_category_id=' + equipmentCategoryId).then((response) => {
                    if (response.data.data) {
                        resolve(response.data.data)
                    } else {
                        reject('No content')
                    }
                }).catch(error => {
                    reject(error);
                })
            });
        },
        getChallengesByCategory(categoryId) {
            return new Promise((resolve, reject) => {
                this.$http.get('/challenges?challenge_category_id=' + categoryId).then((response) => {
                    if (response.data.data) {
                        resolve(response.data.data)
                    } else {
                        reject('No content')
                    }
                }).catch(error => {
                    reject(error);
                })
            });
        },
        getGlobalChallenges() {
            return new Promise((resolve, reject) => {
                this.$http.get('/challenges?global=1').then((response) => {
                    if (response.data.data) {
                        resolve(response.data.data)
                    } else {
                        reject('No content')
                    }
                }).catch(error => {
                    reject(error);
                })
            });
        },
        getCurrentUser() {
            return new Promise((resolve, reject) => {
                this.$http.get('/authenticated').then((response) => {
                    if (response.data.data) {
                        resolve(response.data.data)
                    } else {
                        reject('No content')
                    }
                }).catch(error => {
                    reject(error);
                })
            });
        },
        toggleChallengeCompleted(challengeId) {
            return new Promise((resolve, reject) => {
                this.$http.get('/challenges/toggle-completed/' + challengeId).then((response) => {
                    if (response.data.data) {
                        resolve(response.data.data)
                    } else {
                        reject('No content')
                    }
                }).catch(error => {
                    reject(error);
                })
            });
        },
        isChallengeCompletedByUser(challenge) {
            return this.currentUser ? this.currentUser.completed_challenges.filter(completedChallenge => completedChallenge.id === challenge.id)[0] ?? null : null;
        },
        toggleChallengeCheck(challenge) {
            this.setDataLoadingStart();
            this.toggleChallengeCompleted(challenge.id).then(response => {
                if (response) {
                    this.getCurrentUser().then(response => {
                        this.$store.dispatch('setUser', response);
                        this.setDataLoadingEnd();
                    }).catch(error => {
                        this.parseHttpErrorMessage(error);
                        this.setDataLoadingEnd();
                    })
                }
            }).catch(error => {
                this.parseHttpErrorMessage(error);
                this.setDataLoadingEnd();
            })
        }
    },
    computed: {
        equipmentCategories() {
            return this.$store.getters.equipmentCategories;
        },
        userEquipments() {
            return this.$store.getters.userEquipments;
        },
        challengeCategories() {
            return this.$store.getters.challengeCategories;
        },
        currentUser() {
            return this.$store.getters.user;
        },
        totalChallengesCount() {
            let totalCategoryChallengesCount = 0;

            this.challengeCategories.forEach(challengeCategory => {
                totalCategoryChallengesCount += challengeCategory.challenges_count;
            })

            return totalCategoryChallengesCount;
        },
        totalCompletedChallengesPercent() {
            let result = this.currentUser ? (this.currentUser.completed_challenges.length * 100) / this.totalChallengesCount : 0;
            
            return isNaN(result) ? 0 : result;
        }
    }
}