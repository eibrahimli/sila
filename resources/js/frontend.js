require('./bootstrap');

window.Vue = require('vue');
window.Swal = require('sweetalert2')

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

import VueToast from 'vue-toast-notification';
// Import one of the available themes
import 'vue-toast-notification/dist/theme-sugar.css';

Vue.use(VueToast);

import VueNumberInput from '@chenfengyuan/vue-number-input';
Vue.component('vue-number-input',VueNumberInput)

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('sign-up', require('./components/frontend/SignUp.vue').default)
Vue.component('sign-in', require('./components/frontend/SignIn.vue').default)
Vue.component('email', require('./components/frontend/Email.vue').default)

// Categories Components
Vue.component('category-products', require('./components/frontend/category/CategoryProducts').default)

// Product Components
Vue.component('product-show', require('./components/frontend/product/ProductShow').default)

// Cart Components

Vue.component('cart-index', require('./components/frontend/cart/CartIndex').default)
Vue.component('cart', require('./components/frontend/inc/Cart').default)
Vue.component('checkout', require('./components/frontend/cart/Checkout').default)

// Login and register vue componenet

Vue.component('login', require('./components/frontend/user/Login.vue').default)
Vue.component('register', require('./components/frontend/user/Register.vue').default)
Vue.component('reset', require('./components/frontend/user/Reset.vue').default)
Vue.component('reset-mail', require('./components/frontend/user/ResetMail.vue').default)


// End login and Register vue component
const app = new Vue({
    el: '#app',
    data: {
        changed: false,
    },
    watch: {
        changed() {

            this.$refs.cart.changed = this.changed
        }
    }
})

