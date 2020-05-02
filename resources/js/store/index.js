import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import seats from './modules/seats.js';

export default new Vuex.Store({
    // strict: false,
    modules: {    
        seats
    },
   
});