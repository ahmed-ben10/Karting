import axios from "axios";

const state = {
    all: []
};

const getters = {
    getActiviteiten(state) {
        return state.all;
    }
};

const actions = {
    loadData({commit}) {
        return axios.get('/api/admin/soort_activiteiten').then((res) => {
            const activiteiten = res.data.activiteiten;
            commit('setData', activiteiten)
            return activiteiten;
        })
    },
    add({commit}, data) {
        return axios.post('/api/admin/soort_activiteiten/add', data).then((res) => {
            return res.data;
        })
    },
    edit({commit}, id, data) {
        return axios.post('/api/admin/soort_activiteiten/' + id + '/edit', data).then((res) => {
            return res.data;
        })
    },
    delete({commit}, id) {
        return axios.post('/api/admin/soort_activiteiten/' + id + '/delete').then((res) => {
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