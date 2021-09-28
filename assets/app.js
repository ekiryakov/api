import Vue from 'vue'
import vuetify from './plugins/vuetify.js' // path to vuetify export

import './styles/app.scss';

import UserTabs from "./templates/landing/UserTabs";
import Partners from "./templates/landing/Partners";
import FAQ from "./templates/landing/FAQ";
import Login from "./templates/security/Login";
import CustomerLogin from "./templates/security/CustomerLogin";
import List from "./templates/offer/List";
import Categories from "./templates/offer/Categories";

new Vue({
    vuetify,
    delimiters: ['${', '}$'],
    components: {
        UserTabs,
        Partners,
        FAQ,
        Login,
        CustomerLogin,
        List,
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