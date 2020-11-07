require('./bootstrap');

window.Vue = require('vue');
window.Swal = require('sweetalert2')
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import Vuelidate from 'vuelidate'

Vue.component('v-select', vSelect)


Vue.use(Vuelidate)

Vue.component('form-page', require('./components/Form.vue').default)
Vue.component('user-edit-page', require('./components/UserEdit.vue').default)
Vue.component('category-create-page', require('./components/CategoryCreate.vue').default)
Vue.component('category-edit-page', require('./components/CategoryEdit.vue').default)

const app = new Vue({
    el: '#app',
})
