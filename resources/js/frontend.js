require('./bootstrap');

window.Vue = require('vue');
window.Swal = require('sweetalert2')

import Vuelidate from 'vuelidate'

Vue.use(Vuelidate)

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('sign-up', require('./components/frontend/SignUp.vue').default)
Vue.component('sign-in', require('./components/frontend/SignIn.vue').default)
Vue.component('email', require('./components/frontend/Email.vue').default)
Vue.component('category-products', require('./components/frontend/category/CategoryProducts').default)

// Login and register vue componenet

Vue.component('login', require('./components/frontend/user/Login.vue').default)
Vue.component('register', require('./components/frontend/user/Register.vue').default)
Vue.component('reset', require('./components/frontend/user/Reset.vue').default)
Vue.component('reset-mail', require('./components/frontend/user/ResetMail.vue').default)

// End login and Register vue component

const app = new Vue({
    el: '#app'
})
