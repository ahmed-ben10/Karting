import axios from "axios";

const state = {
    user: null
};

const getters = {
    getUser(state) {
        return state.user;
    },
};

const actions = {
    getUser({commit}){
        return axios.get('/api/user').then((res) => {
            const user = res.data.user;
            commit('setUser', user)
            return user;
        });
    },
    login({commit}, data) {
        return axios.post('api/login', data).then((res) => {
            commit('setUser', res.data.user)
        });
    },
    logout({commit}){
        return axios.post('/api/logout').then((res) => {
            commit('setUser', null)
        });
    }
};

const mutations = {
    setUser(state, user) {
        state.user = user;
    }
};

export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters
};