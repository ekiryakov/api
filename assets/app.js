import Vue from 'vue'
import vuetify from './plugins/vuetify.js' // path to vuetify export

import './styles/app.scss';

import UserTabs from "./templates/landing/UserTabs";
import Partners from "./templates/landing/Partners";
import Login from "./templates/security/Login";
import CustomerLogin from "./templates/security/CustomerLogin";
import SetList from "./templates/set/List";
import OfferList from "./templates/offer/List";
import Categories from "./templates/offer/Categories";

new Vue({
    vuetify,
    delimiters: ['${', '}$'],
    components: {
        UserTabs,
        Partners,
        Login,
        CustomerLogin,
        SetList,
        OfferList,
        Categories,
    },
    data: () => {
        return {
            title: '',
            darkMode: null,
            bottomMenu: null,
            width: window.screen.width,
        }
    },
    beforeMount() {
        this.darkMode = localStorage.getItem('darkMode') || true;
        document.querySelector('body').style.backgroundColor = this.darkMode ? '#121212' : '#fff';
        this.$vuetify.theme.dark = this.darkMode;
    },
    mounted() {
        let titles = document.querySelectorAll('[data-title]');
        if (titles.length > 0) window.addEventListener('scroll', this.onScroll);
    },
    watch: {
        darkMode: (v) => {
            localStorage.setItem('darkMode', v);
        }
    },
    methods: {
        onScroll: function (e) {
            let offsetIndex = 0;
            let scrollOffset = e.target.scrollingElement.scrollTop;
            let titles = document.querySelectorAll('[data-title]');
            titles.forEach(function (el,i) {
                let offsetBottom = el.offsetTop + el.offsetHeight;
                if (scrollOffset > el.offsetTop && scrollOffset < offsetBottom) offsetIndex = i;
            });
            this.title = titles[offsetIndex].dataset.title;
        },
        toggleDarkMode: function () {
            this.darkMode = !this.darkMode;
            this.$vuetify.theme.dark = this.darkMode;
        }
    },
    computed: {
        height: function () {
            return this.width * 0.5625
        }
    }
}).$mount('#app');