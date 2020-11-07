require('./bootstrap');

window.Vue = require('vue');
window.Swal = require('sweetalert2')

import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import Vuelidate from 'vuelidate'

Vue.component('v-select', vSelect)


Vue.use(Vuelidate)

Vue.component('store-create-page', require('./components/seller/StoreCreate.vue').default)

const app = new Vue({
    el: '#app',
})
