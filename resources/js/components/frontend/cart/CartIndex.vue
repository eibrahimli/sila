<template>
  <div>
    <div class="mb-4">
      <h1 class="text-center">Səbət</h1>
    </div>
    <div v-if="cart.length === 0" class="alert alert-warning" role="alert">
      Səbət boşdur...
    </div>
    <div v-else>
      <div class="mb-10 cart-table">
        <form class="mb-4" action="#" method="post">
          <table class="table" cellspacing="0">
            <thead>
            <tr>
              <th class="product-remove">&nbsp;</th>
              <th class="product-thumbnail">&nbsp;</th>
              <th class="product-name">Məhsul</th>
              <th class="product-quantity w-lg-15">Miqdar</th>
              <th class="product-color">Rəng</th>
              <th class="product-price">Qiymət</th>
              <th class="product-subtotal">Ümumi</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(product,index) in cart" :key="index" class="">
              <td class="text-center">
                <a href="#" @click.prevent="deleteCartProduct(product.rowId)" class="text-gray-32 font-size-26">×</a>
              </td>
              <td class="d-none d-md-table-cell">
                <a :href="product.url">
                  <img class="img-fluid max-width-100 p-1 border border-color-1" :src="product.model.img" alt="Image Description">
                </a>
              </td>

              <td data-title="Product">
                <a :href="product.url" class="text-gray-90">{{ product.name }}</a>
              </td>

              <td data-title="Quantity">
                <div class="py-1 px-3">
                  <div class="js-quantity row align-items-center">
                    <vue-number-input controls :value="product.qty"
                                      v-on:change="onChange($event,product.rowId)"
                                      :min="1"
                                      :max="!product.options['color'] ? product.model.stock : setMaxStock(product.options['color'],product.model.colors)"></vue-number-input>
                  </div>
                </div>
              </td>

              <td data-title="Color">
                <span v-if="!product.options['color']" class="">Yoxdur</span>
                <span v-else class="">{{ product.options['name'] }}</span>
              </td>

              <td data-title="Price">
                <span class="">₼{{ product.price }}</span>
              </td>

              <td data-title="Total">
                <span class="">₼{{ product.subtotal }}</span>
              </td>
            </tr>
            <tr>
              <td colspan="6" class="border-top space-top-2 justify-content-center">
                <div class="pt-md-3">
                  <div class="d-block d-md-flex flex-center-between">
                    <div class="mb-3 mb-md-0 w-xl-40">
                      <!-- Apply coupon Form -->
                      <form style="display: none" class="js-focus-state">
                        <label class="sr-only" for="subscribeSrEmailExample1">Coupon code</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="text" id="subscribeSrEmailExample1" placeholder="Coupon code" aria-label="Coupon code" aria-describedby="subscribeButtonExample2" required>
                          <div class="input-group-append">
                            <button class="btn btn-block btn-dark px-4" type="button" id="subscribeButtonExample2"><i class="fas fa-tags d-md-none"></i><span class="d-none d-md-inline">Apply coupon</span></button>
                          </div>
                        </div>
                      </form>
                      <!-- End Apply coupon Form -->
                    </div>
                    <div class="d-md-flex">
                      <button onclick="window.location.href = Laravel.base_url+'/cart'" type="button" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5 w-100 w-md-auto">Səbəti Yenilə</button>
                      <a :href="checkout_url" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-none d-md-inline-block">Sifariş hissəsi</a>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            </tbody>
          </table>
        </form>
      </div>
      <div class="mb-8 cart-total">
        <div class="row">
          <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7 col-md-8 offset-md-4">
            <div class="border-bottom border-color-1 mb-3">
              <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Səbət Miqdarı</h3>
            </div>
            <table class="table mb-3 mb-md-0">
              <tbody>
              <tr class="cart-subtotal">
                <th>Məhsul Sayı</th>
                <td data-title="Subtotal"><span class="amount">{{ totalProducts }}</span></td>
              </tr>
              <!-- Shipping Calculate Gələcək Bura -->
              <tr class="order-total">
                <th>Ümumi Qiymət</th>
                <td data-title="Total"><strong><span class="amount">₼ {{ totalPrice.toFixed(2) }}</span></strong></td>
              </tr>
              </tbody>
            </table>
            <button onclick="window.location.href = Laravel.base_url+'/cart/checkout'" type="button" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-md-none">Sifariş Hissəsi</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import {Url} from "../../../tools/url.js";

const URL = new Url()

  export default {
    name: "CartIndex",
    props: ['get_cart','checkout_url'],

    data() {
      return {
        cart: {},
        totalPrice: 0.00,
      }
    },

    mounted() {

      this.loadCart()
    },

    methods: {
      onChange(event,rowId) {

        axios.patch(Laravel.base_url+'/cart/update/'+rowId, {
          quantity: event,
          '_method': 'PATCH'
        }).then(res => {
          this.cart = res.data.cart
          this.$root.changed = !this.$root.changed
          this.totalPrice = 0.00
          Object.values(this.cart).map(item => this.totalPrice += parseFloat(item.subtotal) )
          setTimeout(() => Swal.close(),1000)
        })
      },
      loadCart() {
        axios.get(this.get_cart).then(res => {
          this.cart = res.data.cart
          this.$root.changed = !this.$root.changed
          this.totalPrice = 0.00
          Object.values(this.cart).map(item => {
            this.totalPrice += parseFloat(item.subtotal)
          } )
        })
      },
      deleteCartProduct(rowId) {
        axios.delete(`${Laravel.base_url}/cart/${rowId}`).then(res => {
          this.cart = res.data.cart
          this.$root.changed = !this.$root.changed
          this.totalPrice = 0.00
          Object.values(this.cart).map(item => this.totalPrice += parseFloat(item.subtotal) )

          Vue.$toast.success(res.data.mes, {
            // override the global option
            duration: 3000,
            position: 'top-right'
          })
        }).catch(error => {
          Vue.$toast.error(error.response.data.mes, {
            // override the global option
            duration: 3000,
            position: 'top-right'
          })
        })
      },
      setMaxStock(color_id,stocks) {
        let quantity = 0

        quantity = stocks.filter(stock => {
          return stock.color_id == color_id
        })

        return quantity[0].quantity
      }
    },

    computed: {
      totalProducts() {
        let total = 0
        Object.values(this.cart).map(item => {
          total = parseInt(total + item.qty)
        })

        return total
      }
    }
  }
</script>

<style scoped>

</style>