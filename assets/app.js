import Vue from 'vue'
import vuetify from './plugins/vuetify.js' // path to vuetify export

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
            title: '',
            titles: [],
            titlesOffsets: [],
            darkMode: false,
            width: window.screen.width,
        }
    },
    mounted() {
        this.titles = document.querySelectorAll('[data-title]');
        let self = this;
            self.titles.forEach(el => {
                self.titlesOffsets.push(el.offsetTop);
            });
            this.titlesOffsets = self.titlesOffsets;
        window.addEventListener('scroll', this.onScroll);
    },
    methods: {
        onScroll: function (e) {
            let offsetIndex = 0;
            let scrollOffset = e.target.scrollingElement.scrollTop;
            console.log(scrollOffset);
            this.titlesOffsets.forEach(function (to,i) {
                if (scrollOffset < to) {
                    offsetIndex = i;
                    return;
                }
            });
            this.title = this.titles[offsetIndex].dataset.title;
        },
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