import Vue from 'vue'
import vuetify from './plugins/vuetify.js' // path to vuetify export

import logo from './images/logo.png';
import './styles/app.scss';

import UserTabs from "./templates/landing/UserTabs";
import Partners from "./templates/landing/Partners";
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
        Login,
        CustomerLogin,
        List,
        Categories,
    },
    data: () => {
        return {
            title:'',
            darkMode: false,
            width: window.screen.width,
        }
    },
    methods: {
        toggleDarkMode: function () {
            this.$vuetify.theme.dark = !this.$vuetify.theme.dark;
            this.darkMode = !this.darkMode;
        }
    },
    computed: {
        height: function () {
            return this.width * 0.5625
        }
    }
}).$mount('#app');