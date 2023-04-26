export default {
    state: {
        userToken: null,
        isAuthenticated: false,
        user: null
    },
    getters: {
        userToken(state) {
            return state.userToken ?? localStorage.getItem('user_token');
        },
        isAuthenticated(state) {
            return state.isAuthenticated;
        },
        user(state) {
            return state.user ?? JSON.parse(localStorage.getItem('user'));
        }
    },
    mutations: {
        SET_USER_TOKEN(state, token) {
            state.userToken = token;
            localStorage.setItem('user_token', token);
        },
        SET_AUTHENTICATED(state, status) {
            state.isAuthenticated = status;
        },
        SET_USER(state, user) {
            state.user = user;
            localStorage.setItem('user', JSON.stringify(user));
        },
        LOGOUT_USER(state) {
            state.userToken = null;
            state.isAuthenticated = false;
            state.user = null;
            localStorage.clear();
        }
    },
    actions: {
        setUserToken({commit}, token) {
            commit('SET_USER_TOKEN', token);
        },
        setAuthenticated({commit}, status) {
            commit('SET_AUTHENTICATED', status);
        },
        setUser({commit}, user) {
            commit('SET_USER', user);
        },
        authenticateUser({commit, dispatch}, user) {
            dispatch('setAuthenticated', true);
            dispatch('setUser', user);

            if (user.access_token) {
                dispatch('setUserToken', user.access_token);
            }
        },
        logoutUser({commit}) {
            commit('LOGOUT_USER');
        }
    }
}