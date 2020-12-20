
window.Vue = require('vue');
window.Swal = require('sweetalert2')

require('./bootstrap');

import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import Vuelidate from 'vuelidate'
import Treeselect from '@riophae/vue-treeselect'
import '@riophae/vue-treeselect/dist/vue-treeselect.css'
import DisableAutocomplete from 'vue-disable-autocomplete';
import CKEditor from 'ckeditor4-vue'

Vue.use( CKEditor );
Vue.component('v-select', vSelect)
Vue.component('treeselect', Treeselect)


Vue.use(Vuelidate)
Vue.use(DisableAutocomplete);

// Seller Components
Vue.component('seller-edit-page', require('./components/seller/SellerEdit').default)

//Store Components
Vue.component('store-create-page', require('./components/seller/StoreCreate.vue').default)
Vue.component('store-edit-page', require('./components/seller/StoreEdit.vue').default)

//End Store Components

//Store Product Components
Vue.component('product-create-page', require('./components/seller/product/ProductCreate.vue').default)
Vue.component('product-edit-page', require('./components/seller/product/ProductEdit.vue').default)

//End Store Product Components

const app = new Vue({
    el: '#app',
})
