import axios from "axios";

const state = {
    all: []
};

const getters = {
    getActiviteiten(state) {
        return state.all;
    },
    getActiviteitenCount(state) {
        return state.all.length;
    }
};

const actions = {
    loadData({commit}) {
        return axios.get('/api/admin/activiteiten').then((res) => {
            const activiteiten = res.data.activiteiten;
            commit('setData', activiteiten)
            return activiteiten;
        })
    },
    add({commit}, data) {
        return axios.post('/api/admin/activiteiten/add', data).then((res) => {
            return res.data;
        })
    },
    edit({commit}, data) {
        return axios.post('/api/admin/activiteiten/' + data.id + '/edit', data.data).then((res) => {
            return res.data;
        })
    },
    delete({commit}, id) {
        return axios.post('/api/admin/activiteiten/' + id + '/delete').then((res) => {
            commit('removeActiviteit', id)
            return res.data;
        });
    }
};

const mutations = {
    setData(state, data) {
        state.all = data;
    },
    removeActiviteit(state, id) {
        let index = state.all.findIndex(x => x.id === id);
        state.all.splice(index, 1);
    }
};

export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters
};