/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import './bootstrap';
import "bootstrap";
import App from './App.vue';
import router from './routes.js';
import {Bootstrap5Pagination} from 'laravel-vue-pagination';
import { createApp } from 'vue';

const app = createApp(App);
app.use(router);
app.component('pagination',Bootstrap5Pagination);
app.mount('#app');

