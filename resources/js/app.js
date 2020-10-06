require('./bootstrap');

window.Vue = require('vue');

Vue.component('form-page', require('./components/Form').default);

const app = new Vue({
    el: '#app',
})
