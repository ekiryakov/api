import Vue from 'vue'
import vuetify from './plugins/vuetify.js' // path to vuetify export

new Vue({
    vuetify,
    template: '<v-app>' +
            '<v-main>' +
                '<v-container>Hello world</v-container>' +
            '</v-main>' +
        '</v-app>'
}).$mount('#app')