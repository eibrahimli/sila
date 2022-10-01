<template>
  <div>
    <!-- Single Product Body -->
    <div class="mb-xl-14 mb-6">
      <div class="row">
        <div class="col-md-5 mb-4 mb-md-0">
          <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2"
               data-infinite="true"
               data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
               data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
               data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
               data-nav-for="#sliderSyncingThumb">
            <div v-for="(stock,index) in stocks" :key="index" class="js-slide">
              <img class="img-fluid" :src="stock.path" :alt="product.title">
            </div>
          </div>

          <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"
               data-infinite="true"
               data-slides-show="5"
               data-is-thumbs="true"
               data-nav-for="#sliderSyncingNav">
            <div v-for="(stock, index) in stocks" class="js-slide" style="cursor: pointer;">
              <img class="img-fluid" :src="stock.path" :alt="product.title">
            </div>
          </div>
        </div>
        <div class="col-md-7 mb-md-6 mb-lg-0">
          <div class="mb-2">
            <div class="border-bottom mb-3 pb-md-1 pb-3">
              <a :href="category_url" class="font-size-12 text-gray-5 mb-2 d-inline-block">{{ category }}</a>
              <h2 class="font-size-25 text-lh-1dot2">{{ product.title }}</h2>
              <div class="mb-2">
                <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">
                  <div class="text-warning mr-2">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="far fa-star text-muted"></small>
                  </div>
                  <span class="text-secondary font-size-13">(3 müştərinin dəyərləndirməsi)</span>
                </a>
              </div>
              <div class="d-md-flex align-items-center">
                <div class="text-gray-9 font-size-14">Mağaza: <span class="text-green font-weight-bold"><a :href="`${base_url}/store/${product.store.id}`">{{ product.sn }}</a></span></div>
                <div class="ml-md-3 text-gray-9 font-size-14">
                  Stok: <span class="text-green font-weight-bold">{{ `{ ${product.stock} }` }} {{ product.unit ? product.unit.name.toLowerCase() : 'ədəd' }} stokda</span>
                  </div>
              </div>
            </div>
            <!--
            Kiçik açıqlama Gələcəkdə
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
            -->
            <div class="mb-4">
              <div class="d-flex align-items-baseline">
                <ins class="font-size-36 text-decoration-none">₼{{ parseFloat(quantity * product.price).toFixed(2) }}</ins>
              </div>
            </div>
            <div class="border-top border-bottom py-3 mb-4" v-if="productColor.length > 0">
              <div class="d-flex align-items-center">
                <h6 class="font-size-14 mb-0">Rənglər</h6>
                <!-- Select -->
                <select v-on:change="setMaxStock" v-model="color" class="ml-3 js-select selectpicker dropdown-select"
                        data-style="btn-sm bg-white font-weight-normal py-2 border">
                  <option value="0" selected>Rəng seçin...</option>
                  <option v-for="(col,index) in productColor" :key="index" :value="col.id">{{ col.name }}</option>
                </select>
                <!-- End Select -->
              </div>
            </div>
            <div class="d-md-flex align-items-end mb-3">
              <div class="max-width-150 mb-4 mb-md-0">
                <h6 class="font-size-14">{{ product.unit ? product.unit.name : 'Ədəd' }}</h6>
                <!-- Quantity -->
                <div class="py-1 px-3">
                  <div class="js-quantity row align-items-center">
                    <vue-number-input controls :disabled="color == 0 && productColor.length > 0" v-model="quantity" :min="1" :max="maxstock"></vue-number-input>
                  </div>
                </div>
                <!-- End Quantity -->
              </div>
              <div class="ml-md-3">
                <a href="#" @click.prevent="addToCart" :class="{'disabled': this.color == 0 && productColor.length > 0}" class="btn px-5 btn-primary-dark transition-3d-hover"><i class="ec ec-add-to-cart mr-2 font-size-20"></i> Səbətə At</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Single Product Body -->
    <!-- Single Product Tab -->
    <div class="mb-8">
      <div class="position-relative position-md-static px-md-6">
        <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
          <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
            <a class="nav-link active" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1" aria-selected="true">Açıqlama</a>
          </li>
          <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
            <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">Xüsusiyyətlər</a>
          </li>
        </ul>
      </div>
      <!-- Tab Content -->
      <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
        <div class="tab-content" id="Jpills-tabContent">
          <div v-html="product.desc" class="tab-pane fade active show" id="Jpills-two-example1" role="tabpanel" aria-labelledby="Jpills-two-example1-tab">

          </div>
          <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
            <div class="mx-md-5 pt-1">
              <div class="table-responsive mb-4">
                <table class="table table-hover">
                  <tbody>

                    <tr v-for="(spec,index) in product.spec" :key="index">
                      <th class="px-4 px-xl-5" :class="{'border-top-0' : index === 0}">{{ spec.name }}</th>
                      <td :class="{'border-top-0': index === 0}">{{ spec.value }}</td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Tab Content -->
    </div>
    <!-- End Single Product Tab -->
  </div>
</template>
<script>
  import {Url} from "../../../tools/url.js";

  const URL = new Url()

  export default {
    name: "ProductShow",
    props: ['get_product','add_to_cart'],

    data() {
      return {
        maxstock: 3,
        color: 0,
        quantity: 1,
        product: {},
        colors: {},
        related_products: {},
        stocks: {},
        category_url: '',
        category: '',
        base_url: ''
      }
    },
    mounted() {
      this.loadProduct()
      this.base_url = window.Laravel.base_url
      
    },

    computed: {
      // How much stock product has
      productColor() {
        let clrs =[]
        Array.from(this.colors).map(color => {
          Array.from(this.stocks).map(stock => {
            if(color.id === stock.color_id) {
               clrs.push(color)
            }
          })
        })

        return clrs
      }
    },

    methods: {

      // Load current product
      loadProduct() {
        axios.get(this.get_product)
          .then(res => {
            this.product = res.data.product
            this.stocks = res.data.stocks
            this.category_url = res.data.category_url
            this.category = res.data.category
            this.related_products = res.data.related_products
            this.colors = res.data.colors
            this.maxstock = res.data.product.stock
          })
      },

      //Add Product to Cart
      addToCart() {
        if(this.quantity > 0) {
          axios.post(this.add_to_cart, {
            quantity: this.quantity,
            color: this.productColor.length > 0 ? this.color : 0,
          }).then((res) => {
            this.$root.changed = !this.$root.changed
            Vue.$toast.success(res.data.mes, {
              // override the global option
              duration: 3000,
              position: 'top-right'
            })
          }).catch((error) => {
            Vue.$toast.warning(error.response.data.mes, {
              // override the global option
              duration: 3000,
              position: 'top-right'
            })
          })
        } else {
          Vue.$toast.error('', {
            // override the global option
            duration: 3000,
            position: 'top-right'
          })
          return false;
        }
      },

      // Slug url
      slug(id,str) {
        return id+'-'+URL.slugify(str)
      },
      // Photo path
      path(photo) {
        return `${Laravel.base_url}/storage/${photo}`;
      },
      // Set maksimum stock
      setMaxStock() {
        if(this.color == 0) { this.maxstock = this.product.stock; this.quantity = 1; return true }
        let data
        data = this.stocks.filter((stock) => {
          if(stock.color_id === this.color) {
            return stock.quantity
          }
        })
        this.quantity = 1
        this.maxstock = data[0].quantity
      }
    }
  }
</script>

<style scoped>

</style>