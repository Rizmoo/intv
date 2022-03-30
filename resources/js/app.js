import Vue from "vue";

require('./bootstrap');
window.Vue = require('vue');
import App from './components/Main';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import axios from 'axios';
import { routes } from './routes';
import VeeValidate from 'vee-validate';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);



const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
