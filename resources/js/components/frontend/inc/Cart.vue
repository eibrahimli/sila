<template>
  <li class="col pr-0">
    <a :href="cart" class="text-gray-90 position-relative d-flex" data-toggle="tooltip" data-placement="top" title="Səbət">
      <i class="font-size-22 ec ec-shopping-bag"></i>
      <span class="width-22 height-22 bg-dark position-absolute flex-content-center text-white rounded-circle left-12 top-8 font-weight-bold font-size-12">{{ totalProducts }}</span>
      <span v-if="totalPrice !== 0.00" class="font-weight-bold font-size-16 text-gray-90 ml-3">₼ {{ totalPrice.toFixed(2) }}</span>
    </a>
  </li>
</template>

<script>
  export default {
    name: "Cart",
    props: ['cart'],
    data() {
      return{
        carts: {},
        totalPrice: 0.00,
        changed : false,
      }
    },
    async mounted() {
      this.carts = await axios.get(Laravel.cart_url)
      this.carts = this.carts.data.cart
      this.totalPrice = 0.00
      Object.values(this.carts).map(item => {
        this.totalPrice += parseFloat(item.subtotal)
      } )
    },
    computed: {
      totalProducts() {
        let total = 0
        Object.values(this.carts).map(item => {
          total = parseInt(total + item.qty)
        })

        return total
      }
    },
    watch: {
      async changed() {
        this.carts = await axios.get(Laravel.cart_url)
        this.carts = this.carts.data.cart
        this.totalPrice = 0.00
        Object.values(this.carts).map(item => {
          this.totalPrice += parseFloat(item.subtotal)
        } )
      }
    }
  }
</script>

<style scoped>

</style>