import Vue from 'vue'
import vuetify from './plugins/vuetify.js' // path to vuetify export

import './styles/app.scss';

import Login from "./templates/security/Login";
import Offer from "./templates/offer/Offer";
import Categories from "./templates/offer/Categories";

new Vue({
    vuetify,
    delimiters: ['${', '}$'],
    components: {
        Login,
        Offer,
        Categories,
    },
}).$mount('#app');