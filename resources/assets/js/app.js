window.Vue = require('vue');
window.axios = require('axios');

Vue.component('shorten-form', require('../components/ShortenForm.vue').default);

const form = new Vue({
    el: '#initForm'
});