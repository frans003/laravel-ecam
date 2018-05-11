/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from "vue-axios";
import axios from "axios";
axios.defaults.baseURL = "http://localhost:8000/api/notes";

Vue.use(VueRouter)
Vue.use(VueAxios, axios);

require('./bootstrap');

window.Vue = require('vue');




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('articles', require('./components/articles.vue'));
Vue.component('navbar', require('./components/navbar.vue'));


const app = new Vue({
    el: '#app'
});
