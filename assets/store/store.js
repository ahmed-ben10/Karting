import Vue from 'vue'
import Vuex from 'vuex'

import user from './modules/user';
import activiteiten from './modules/activiteiten';

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        user,
        activiteiten
    }
});