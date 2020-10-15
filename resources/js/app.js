require('./bootstrap');

window.Vue = require('vue');
window.Swal = require('sweetalert2')

import Vuelidate from 'vuelidate'

Vue.use(Vuelidate)

Vue.component('form-page', require('./components/Form.vue').default)

const app = new Vue({
    el: '#app',
    
})
