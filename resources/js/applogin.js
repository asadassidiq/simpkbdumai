/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import Vuetify from 'vuetify';
import MainLogin from './components/Login.vue';
import MainUji from './components/MainAppUji.vue';
import VueRouter from 'vue-router';
import {routes} from './routes';
import { Form, HasError, AlertError } from 'vform'
import store from './store';
import {initialize} from './helpers/general';
import Swal from 'sweetalert2';


window.Form =Form
window.Vue = require('vue');


// CommonJS
window.Swal = require('sweetalert2')

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.use(Vuetify);
Vue.use(VueRouter);

const router = new VueRouter({
    routes,
    mode : 'history'
})
var level = JSON.parse(localStorage.getItem("names"));

initialize(store,router);
window.Fire = new Vue()
const app = new Vue({
    el: '#login',
    router,
    store,
    vuetify : new Vuetify(),
    components : {
        MainLogin
    },
});

