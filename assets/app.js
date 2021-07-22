import Vue from 'vue'
import vuetify from './plugins/vuetify.js' // path to vuetify export

new Vue({
    vuetify,
    el: '#app',
    template: '<v-app>' +
            '<v-main>' +
                '<v-container>Hello world</v-container>' +
            '</v-main>' +
        '</v-app>'
});