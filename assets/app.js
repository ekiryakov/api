import Vue from 'vue'
import vuetify from './plugins/vuetify.js' // path to vuetify export

import './styles/app.scss';

import Login from "./templates/security/Login";
import CustomerLogin from "./templates/security/CustomerLogin";
import Offer from "./templates/offer/Offer";
import Categories from "./templates/offer/Categories";

new Vue({
    vuetify,
    delimiters: ['${', '}$'],
    components: {
        Login,
        CustomerLogin,
        Offer,
        Categories,
    },
    data: () => {
        return {
            show: false,
            width: window.screen.width,
        }
    },
    computed: {
        height: function () {
            return this.width * 0.5625
        }
    }
}).$mount('#app');