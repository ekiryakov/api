import Vue from 'vue'
import vuetify from './plugins/vuetify.js' // path to vuetify export

import './styles/app.scss';

import Login from "./templates/security/Login";
import Offer from "./templates/offer/Offer";

new Vue({
    vuetify,
    delimiters: ['${', '}$'],
    components: {
        Login,
        Offer,
    },
    computed: {
        categoryId: () => {
            let usp = new URLSearchParams(location.search);
            return usp.get('category');
        }
    }
}).$mount('#app')