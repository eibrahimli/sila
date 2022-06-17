window.Vue = require('vue');
window.Swal = require('sweetalert2')

require('./bootstrap');

import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import Treeselect from '@riophae/vue-treeselect'
import '@riophae/vue-treeselect/dist/vue-treeselect.css'
import DisableAutocomplete from 'vue-disable-autocomplete';
import CKEditor from 'ckeditor4-vue'

Vue.use( CKEditor );
Vue.component('treeselect', Treeselect)

Vue.use(DisableAutocomplete);
import Vuelidate from 'vuelidate'

Vue.component('v-select', vSelect)


Vue.use(Vuelidate)

Vue.component('form-page', require('./components/Form.vue').default)
Vue.component('user-edit-page', require('./components/UserEdit.vue').default)
Vue.component('category-create-page', require('./components/CategoryCreate.vue').default)
Vue.component('category-edit-page', require('./components/CategoryEdit.vue').default)
Vue.component('admin-product-edit-page', require('./components/backend/AdminProductEdit.vue').default)
Vue.component('not-active-orders', require('./components/backend/order/NotActive.vue').default)
Vue.component('active-orders', require('./components/backend/order/Active.vue').default)
Vue.component('banner', require('./components/backend/AdminBanners').default)

const app = new Vue({
    el: '#app',
})
