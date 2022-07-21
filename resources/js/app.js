require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue' 

// Vue.component('welcome', require('./components/Welcome.vue'));
// Vue.component('users', require('./components/userInputPage.vue'));
// Vue.component('welcome', require('./components/Welcome.vue').default);
Vue.component('inputUserPage',require('./components/UserInputPage.vue').default);
// Vue.component('users',require('./components/userInputPage.vue').default);
Vue.component('views',require('./components/ViewInputPage.vue').default);

const app = new Vue({
    el: '#app',
});