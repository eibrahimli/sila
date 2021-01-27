<template>
  <div class="row mb-8">
    <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
      <div class="mb-6">
        <div class="border-bottom border-color-1 mb-5">
          <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Filtr</h3>
        </div>
        <div class="border-bottom pb-4 mb-4">
          <h4 class="font-size-14 mb-3 font-weight-bold">Brendlər</h4>

          <!-- Checkboxes -->
          <div v-for="(brand,index) in brands" :key="index" class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" :value="brand.id" v-model="selected.brands" class="custom-control-input" :id="brand.id">
              <label class="custom-control-label" :for="brand.id">{{ brand.name }}
                <!-- <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span> -->
              </label>
            </div>
          </div>
          <!-- End Checkboxes -->

        </div>
        <div class="border-bottom pb-4 mb-4">
          <h4 class="font-size-14 mb-3 font-weight-bold">Rəng</h4>

          <!-- Checkboxes -->
          <div v-for="(color,index) in colors" :key="index" class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" :value="color.id" v-model="selected.colors" class="custom-control-input" :id="`color${color.id}`">
              <label class="custom-control-label" :for="`color${color.id}`">{{ color.name }}
                <!-- <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span> -->
              </label>
            </div>
          </div>
          <!-- End Checkboxes -->

        </div>
        <div class="range-slider">
          <h4 class="font-size-14 mb-3 font-weight-bold">Qiymət</h4>
          <!-- Range Slider -->
          <input onchange="$.HSCore.components.HSRangeSlider._baseConfig" ref="minMax" class="js-range-slider"
                 type="text"
                 data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                 data-type="double"
                 data-grid="false"
                 data-hide-from-to="true"
                 data-prefix="₼"
                 data-min="0"
                 data-max="4000"
                 data-from="0"
                 data-to="4000"
                 data-result-min="#rangeSliderExample3MinResult"
                 data-result-max="#rangeSliderExample3MaxResult"
          >
          <!-- End Range Slider -->
          <div class="mt-1 text-gray-111 d-flex mb-4">
            <span class="mr-0dot5">Qiymət: </span>
            <span>₼ </span>
            <span id="rangeSliderExample3MinResult" class=""></span>
            <span class="mx-0dot5"> — </span>
            <span>₼ </span>
            <span id="rangeSliderExample3MaxResult" class=""></span>
          </div>
        </div>
      </div>
      <div class="mb-8">
        <div class="border-bottom border-color-1 mb-5">
          <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Ən Yeni Məhsullar</h3>
        </div>
        <ul class="list-unstyled">
          <li v-for="recent_product in recent_products" class="mb-4">
            <div class="row">
              <div class="col-auto">
                <a :href="recent_product.url" class="d-block width-75">
                  <img class="img-fluid" :src="recent_product.img" alt="Image Description">
                </a>
              </div>
              <div class="col">
                <h3 class="text-lh-1dot2 font-size-14 mb-0">
                  <a :href="recent_product.url">{{ recent_product.title }}</a>
                </h3>
                <div class="text-warning text-ls-n2 font-size-16 mb-1" style="width: 80px;">
                  <small class="fas fa-star"></small>
                  <small class="fas fa-star"></small>
                  <small class="fas fa-star"></small>
                  <small class="fas fa-star"></small>
                  <small class="far fa-star text-muted"></small>
                </div>
                <div class="font-weight-bold font-size-15">
                  ₼{{ recent_product.price }}
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-xl-9 col-wd-9gdot5">
      <!-- Shop-control-bar Title -->
      <div class="d-block d-md-flex flex-center-between mb-3">
        <h3 class="font-size-25 mb-2 mb-md-0">{{ category.name }}</h3>
      </div>
      <!-- End shop-control-bar Title -->
      <!-- Shop-control-bar -->
      <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
        <div class="d-xl-none">
          <!-- Account Sidebar Toggle Button -->
          <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;" role="button"
             aria-controls="sidebarContent1"
             aria-haspopup="true"
             aria-expanded="false"
             data-unfold-event="click"
             data-unfold-hide-on-scroll="false"
             data-unfold-target="#sidebarContent1"
             data-unfold-type="css-animation"
             data-unfold-animation-in="fadeInLeft"
             data-unfold-animation-out="fadeOutLeft"
             data-unfold-duration="500">
            <i class="fas fa-sliders-h"></i>
            <span class="ml-1">Filtr</span>
          </a>
          <!-- End Account Sidebar Toggle Button -->
        </div>

        <div class="d-flex px-1">
          <form method="get">
            <!-- Select -->
            <select class="js-select selectpicker dropdown-select max-width-200 max-width-160-sm right-dropdown-0 px-2 px-xl-0"
                    data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
              <option value="one" selected>Bütün Məhsullar</option>
              <option value="two">Yeni</option>
              <option value="four">Ən Son</option>
              <option value="five">Ucuzdan-Bahaya</option>
              <option value="six">Bahadan-Ucuza</option>
            </select>
            <!-- End Select -->
          </form>
        </div>
      </div>
      <!-- End Shop-control-bar -->
      <!-- Shop Body -->
      <!-- Tab Content -->
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
          <ul class="row list-unstyled products-group no-gutters">
            <div v-if="noproducts">Nəticə tapılmadı...</div>
            <li v-else v-for="product in products.data" :key="product.id" class="col-6 col-md-3 col-wd-2gdot4 product-item">
              <div class="product-item__outer h-100">
                <div class="product-item__inner px-xl-4 p-3">
                  <div class="product-item__body pb-xl-2">
                    <div class="mb-2">
                      <a :href="category.url" class="font-size-12 text-gray-5">{{ category.name }}</a>
                    </div>
                    <h5 class="mb-1 product-item__title">
                      <a :href="product.url" class="text-blue font-weight-bold">{{ product.title }}</a>
                    </h5>
                    <div class="mb-2">
                      <a :href="product.url" class="d-block text-center">
                        <img class="img-fluid" :src="product.img" alt="Image Description"></a>
                    </div>
                    <div class="flex-center-between mb-1">
                      <div class="prodcut-price">
                        <div class="text-gray-100">₼{{ product.price }}</div>
                      </div>
                      <div class="d-none d-xl-block prodcut-add-cart">
                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover">
                          <i class="ec ec-add-to-cart"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="product-item__footer">
                    <div class="border-top pt-2 flex-center-between flex-wrap">
                      <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Qarşılaşdır</a>
                      <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> İstək siyahısı</a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <!-- End Tab Content -->
      <!-- End Shop Body -->
      <!-- Shop Pagination -->
      <nav v-if="!noproducts" class="d-md-flex justify-content-end align-items-center border-top pt-3" aria-label="Page navigation example">
        <pagination :data="products" @pagination-change-page="getResults"></pagination>
      </nav>

      <!-- End Shop Pagination -->
    </div>
  </div>
</template>

<script>


export default {
  name: "CategoryProducts",
  props: ['id', 'get_category_url', 'get_all_brands', 'get_all_colors','sorting_category_product'],

  data() {
    return {
      colors: {},
      brands: {},
      category: {},
      products: {},
      recent_products: {},
      selected: {
        brands: [],
        colors: [],
        min: 0,
        max: 4000,
      },
      noproducts: false,
    }
  },

  mounted() {
    this.getCategory()
    this.getResults()
    this.getColors()
    this.getBrands()
  },

  methods: {
    getCategory() {
      axios.get(this.get_category_url).then(data => {this.category = data.data.category; this.recent_products = data.data.recent_products}).catch(error => console.log(error))
    },
    getResults(page = 1) {
      axios.get(Laravel.base_url+'/category/get/'+this.id+'?page=' + page)
        .then(response => {
          this.products = response.data.products;
        });
    },

    getColors() {
      axios.get(this.get_all_colors).then(res => this.colors = res.data.colors)
    },

    getBrands() {
      axios.get(this.get_all_brands).then(res => this.brands = res.data.brands)
    },

    loadBrandsProducts() {
      axios.get(this.sorting_category_product, {
        params: _.omit(this.selected,'brands')
      }).then(res => this.products = res.data.products)
    },
    loadColorsProducts() {
      axios.get(this.sorting_category_product, {
        params: _.omit(this.selected,'colors')
      }).then(res => this.products = res.data.products)
    },
    loadMinMaxProducts() {
      axios.get(this.sorting_category_product, {
        params: _.omit(this.selected,['min','max'])
      }).then(res => this.products = res.data.products)
    },

  },
  watch: {
    selected: {
      handler: function () {
        this.loadBrandsProducts()
        this.loadColorsProducts()
        this.loadMinMaxProducts()
      },
      deep: true
    }
  }
}
</script>

<style scoped>

</style>