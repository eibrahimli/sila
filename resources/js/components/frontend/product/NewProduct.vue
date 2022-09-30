<template>
    <div>
        <ul class="row list-unstyled products-group no-gutters">
            <li v-for="(product, key) in all_items" :key="key" class="col-6 col-wd-2 col-md-3 product-item">
                <div class="product-item__outer h-100">
                    <div class="product-item__inner px-xl-4 p-3">
                        <div class="product-item__body pb-xl-2">
                            <div class="mb-2">
                                <!-- <a :href="product.category.url" class="font-size-12 text-gray-5">{{ product.category.name }}</a> -->
                            </div>
                            <h5 class="mb-1 product-item__title">
                                <a :href="product.url" class="text-blue font-weight-bold">{{ product.title }}</a>
                            </h5>
                            <div class="mb-2">
                                <a :href="product.url" class="d-block text-center"><img class="img-fluid" :src="product.photo ? `${base_url}/storage/${product.photo}` : null" :alt="product.title"></a>
                            </div>
                            <div class="flex-center-between mb-1">
                                <div class="prodcut-price">
                                    <!-- <div class="text-gray-100">₼{{ product.price }}</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <div v-if="isLoad" class="container text-center">
            <button type="button" @click.prevent="loadMore" class="btn btn-primary">Daha Çox</button>
        </div>
    </div>
    
</template>

<script>
import Axios from 'axios';

export default {
    data() {
        return {
            items: [],
            items_data: [],
            isLoad: true,
            current_page: 1,
            last_page: 0,
            base_url: ''
        }
    },
    
    computed: {
        all_items() {
            return this.items_data
        }
    },

    mounted() {
        this.getSet()
    },

    methods: {
        getSet() {
            this.base_url = window.Laravel.base_url
            let vm = this
            axios.get(`${this.base_url}/api/new-products`).then(res => {
                vm.items = res.data
                vm.items_data = vm.items.data
                vm.current_page = res.data.current_page;
                vm.isLoad = res.data.current_page < res.data.last_page ? true : false

                console.log('burdayam')
            })
            
        },

        loadMore() {
            let vm = this
            axios.get(vm.items.next_page_url).then(res => {
                vm.items = res.data
                vm.items_data = [...vm.items_data, ...vm.items.data]
                vm.current_page = res.data.current_page;
                vm.isLoad = res.data.current_page < res.data.last_page ? true : false
            })

            console.log(this.items)
        }
    }
}
</script>