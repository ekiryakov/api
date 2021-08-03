import Vue from 'vue'
import vuetify from './plugins/vuetify.js' // path to vuetify export

import Login from "./templates/security/Login";

new Vue({
    vuetify,
    delimiters: ['${', '}$'],
    components: {
        Login
    }
}).$mount('#app')