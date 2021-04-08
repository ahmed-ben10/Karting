import Vue from 'vue'
import Vuex from 'vuex'

import user from './modules/user';
import activiteiten from './modules/activiteiten';
import soort_activiteiten from './modules/soort_activiteiten';

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        user,
        activiteiten,
        soort_activiteiten
    }
});