export default {
    state: {
        isDataLoading: false,
        equipmentCategories: [],
        challengeCategories: [],
        userEquipments: [],
    },
    getters: {
        isDataLoading: state => state.isDataLoading,
        equipmentCategories: state => state.equipmentCategories,
        challengeCategories: state => state.challengeCategories,
        userEquipments: state => state.userEquipments,
    },
    mutations: {
        SET_DATA_LOADING(state, status) {
            state.isDataLoading = status;
        },
        SET_EQUIPMENT_CATEGORIES(state, payload) {
            state.equipmentCategories = payload;
        },
        SET_CHALLENGE_CATEGORIES(state, payload) {
            state.challengeCategories = payload;
        },
        SET_USER_EQUIPMENTS(state, payload) {
            state.userEquipments = payload;
        },
    },
    actions: {
        setDataLoading({commit}, status) {
            commit('SET_DATA_LOADING', status);
        },
        setEquipmentCategories({commit}, payload) {
            commit('SET_EQUIPMENT_CATEGORIES', payload);
        },
        setChallengeCategories({commit}, payload) {
            commit('SET_CHALLENGE_CATEGORIES', payload);
        },
        setUserEquipments({commit}, payload) {
            commit('SET_USER_EQUIPMENTS', payload);
        },
    }
}