<template>
  <div class="container" :class="{ 'svg-preloader' : loader  }">
    <div v-if="!ordered">
      <div class="mb-5">
        <h1 class="text-center">Ödəmə hissəsi</h1>
      </div>
      <!-- Accordion -->
      <!-- End Accordion -->

      <form @submit.prevent="placeOrder()" novalidate="novalidate">
        <div class="row">
          <div class="col-lg-7 order-lg-1">
            <div class="pb-7">
              <!-- Title -->
              <div class="border-bottom border-color-1 mb-5">
                <h3 class="section-title mb-0 pb-2 font-size-25">Sifariş qeydiyyatı</h3>
              </div>
              <!-- End Title -->

              <!-- Billing Form -->
              <div class="row">
                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6" :class="{
                    'u-has-success': !$v.name.$invalid && $v.name.$dirty,
                    'u-has-error': $v.name.$invalid && $v.name.$dirty,
                  }">
                    <label for="orderName" class="form-label">
                      Ad
                      <span class="text-danger">*</span>
                    </label>
                    <input type="text" v-model.trim="$v.name.$model" class="form-control" id="orderName" placeholder="Elvir" aria-label="Elvir">
                    <div
                      id="orderName-error"
                      v-if="!$v.name.required && $v.name.$dirty"
                      :style="{ display: 'block' }"
                      class="invalid-feedback"
                    >
                      Ad boş ola bilməz.
                    </div>
                    <div
                      id="orderName-error"
                      v-if="!$v.name.minLength && $v.name.$dirty"
                      :style="{ display: 'block' }"
                      class="invalid-feedback"
                    >
                      Ad ən azı {{ $v.name.$params.minLength.min }} simvol olmalıdır.
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6" :class="{
                    'u-has-success': !$v.surname.$invalid && $v.surname.$dirty,
                    'u-has-error': $v.surname.$invalid && $v.surname.$dirty,
                  }">
                    <label for="orderSurname" class="form-label">
                      Soyad
                      <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="orderSurname" v-model.trim="$v.surname.$model"
                           placeholder="İbrahimli" aria-label="İbrahimli">
                    <div
                      id="orderSurname-error"
                      v-if="!$v.surname.required && $v.surname.$dirty"
                      :style="{ display: 'block' }"
                      class="invalid-feedback"
                    >
                      Soyad boş ola bilməz.
                    </div>
                    <div
                      id="orderSurname-error"
                      v-if="!$v.surname.minLength && $v.surname.$dirty"
                      :style="{ display: 'block' }"
                      class="invalid-feedback"
                    >
                      Soyad ən azı {{ $v.surname.$params.minLength.min }} simvol olmalıdır.
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="w-100"></div>
                <div class="col-md-12">
                  <!-- Input -->
                  <div class="js-form-message mb-6" :class="{
                    'u-has-success': !$v.adress.$invalid && $v.adress.$dirty,
                    'u-has-error': $v.adress.$invalid && $v.adress.$dirty,
                  }">
                    <label for="orderAdress" class="form-label">
                      Adres
                      <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="orderAdress" class="form-control" v-model.trim="$v.adress.$model" placeholder="Aşıq Molla Cümə, 22" aria-label="Aşıq Molla Cümə, 22">
                    <div
                      id="orderAdress-error"
                      v-if="!$v.adress.required && $v.adress.$dirty"
                      :style="{ display: 'block' }"
                      class="invalid-feedback"
                    >
                      Təslimat adresi boş ola bilməz.
                    </div>
                    <div
                      id="orderAdress-error"
                      v-if="!$v.adress.minLength && $v.adress.$dirty"
                      :style="{ display: 'block' }"
                      class="invalid-feedback"
                    >
                      Təslimat adresi ən azı {{ $v.adress.$params.minLength.min }} simvol olmalıdır.
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="col-md-12">
                  <!-- Input -->
                  <div class="js-form-message mb-6" :class="{
                    'u-has-success': !$v.city.$invalid && $v.city.$dirty,
                    'u-has-error': $v.city.$invalid && $v.city.$dirty,
                  }">
                    <label for="orderCity" class="form-label">
                      Şəhər
                      <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="orderCity" v-model.trim="$v.city.$model" placeholder="Bakı" aria-label="Bakı" autocomplete="off">
                    <div
                      id="orderCity-error"
                      v-if="!$v.city.required && $v.city.$dirty"
                      :style="{ display: 'block' }"
                      class="invalid-feedback"
                    >
                      Şəhər adı boş ola bilməz.
                    </div>
                    <div
                      id="orderCity-error"
                      v-if="!$v.city.minLength && $v.city.$dirty"
                      :style="{ display: 'block' }"
                      class="invalid-feedback"
                    >
                      Şəhər ən azı {{ $v.city.$params.minLength.min }} simvol olmalıdır.
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="w-100"></div>

                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6" :class="{
                    'u-has-success': !$v.email.$invalid && $v.email.$dirty,
                    'u-has-error': $v.email.$invalid && $v.email.$dirty,
                  }">
                    <label class="form-label" for="orderEmail">
                      Email adres
                      <span class="text-danger">*</span>
                    </label>
                    <input type="text" v-model.trim="$v.email.$model" id="orderEmail" class="form-control" placeholder="jackwayley@gmail.com" aria-label="jackwayley@gmail.com">
                    <div
                      id="orderEmail-error"
                      v-if="!$v.email.required && $v.email.$dirty"
                      :style="{ display: 'block' }"
                      class="invalid-feedback"
                    >
                      Email adresi boş ola bilməz.
                    </div>
                    <div
                      id="orderEmail-error"
                      v-if="!$v.email.email && $v.email.$dirty"
                      :style="{ display: 'block' }"
                      class="invalid-feedback"
                    >
                      Email adresini doğru şəkildə deyil..
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6" :class="{
                    'u-has-success': !$v.number.$invalid && $v.number.$dirty,
                    'u-has-error': $v.number.$invalid && $v.number.$dirty,
                  }">
                    <label class="form-label">
                      Nömrə
                    </label>
                    <input type="text" v-model="$v.number.$model" class="form-control" placeholder="051-000-00-00" aria-label="051-000-00-00">
                    <div
                      id="orderEmail-error"
                      v-if="!$v.number.required && $v.number.$dirty"
                      :style="{ display: 'block' }"
                      class="invalid-feedback"
                    >
                      Nömrə boş ola bilməz.
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="w-100"></div>
              </div>
              <!-- End Billing Form -->

              <!-- Accordion -->
              <div v-if="is_logged == 2" id="shopCartAccordion2" class="accordion rounded mb-6">
                <!-- Card -->
                <div class="card border-0">
                  <div id="shopCartHeadingThree" class="custom-control custom-checkbox d-flex align-items-center">
                    <input type="checkbox" @change="login = !login" class="custom-control-input" id="createAnaccount" name="createAnaccount" >
                    <label v-if="!login" class="custom-control-label form-label" for="createAnaccount" data-toggle="collapse" data-target="#shopCartThree" aria-expanded="false" aria-controls="shopCartThree">
                      Qeyd olmaq İstəyirsən?
                    </label>
                    <label v-else class="custom-control-label form-label" for="createAnaccount" data-toggle="collapse" data-target="#shopCartThree" aria-expanded="false" aria-controls="shopCartThree">
                      Xeyr qeyd olmaq İstəmirəm
                    </label>
                  </div>
                  <div id="shopCartThree" v-show="login" class="collapse" aria-labelledby="shopCartHeadingThree" data-parent="#shopCartAccordion2" style="">
                    <!-- Form Group -->
                    <div class="js-form-message form-group py-5" :class="{
                      'u-has-success': !$v.password.$invalid && $v.password.$dirty,
                      'u-has-error': $v.password.$invalid && $v.password.$dirty,
                    }">
                      <label class="form-label" for="orderPassword">
                        Şifrə
                        <span class="text-danger">*</span>
                      </label>
                      <input type="password" class="form-control" v-model.trim="$v.password.$model" id="orderPassword" placeholder="********" aria-label="********">
                      <div
                        id="orderPassword-error"
                        v-if="!$v.password.required && $v.password.$dirty"
                        :style="{ display: 'block' }"
                        class="invalid-feedback"
                      >
                        Şifrə boş ola bilməz.
                      </div>
                      <div
                        id="orderPassword-error"
                        v-if="!$v.password.minLength && $v.password.$dirty"
                        :style="{ display: 'block' }"
                        class="invalid-feedback"
                      >
                        Şifrə ən azı {{ $v.password.$params.minLength.min }} simvol olmalıdır.
                      </div>
                    </div>
                    <!-- End Form Group -->
                  </div>
                </div>
                <!-- End Card -->
              </div>
              <!-- End Accordion -->
              <!-- Input -->
              <div class="js-form-message mb-6">
                <label class="form-label">
                  Sifariş qeydi (Doldurulması şərt deyildir...)
                </label>

                <div class="input-group">
                  <textarea v-model.trim="note" class="form-control p-5" rows="4" name="text" placeholder="Sifariş qeydinizi daxil edin."></textarea>
                </div>
              </div>
              <!-- End Input -->
            </div>
          </div>
          <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
            <div class="pl-lg-3 ">
              <div class="bg-gray-1 rounded-lg">
                <!-- Order Summary -->
                <div class="p-4 mb-4 checkout-table">
                  <!-- Title -->
                  <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title mb-0 pb-2 font-size-25">Sizin Sifarişiniz</h3>
                  </div>
                  <!-- End Title -->

                  <!-- Product Content -->
                  <table class="table">
                    <thead>
                    <tr>
                      <th class="product-name">Məhsul</th>
                      <th class="product-total">Ümumi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(cart,index) in carts" :key="index" class="cart_item">
                      <td>{{ cart.name }}&nbsp;<strong class="product-quantity">× {{ cart.qty }}</strong></td>
                      <td>₼ {{ cart.subtotal }}</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>Toplam</th>
                      <td>₼ {{ totalPrice.toFixed(2) }}</td>
                    </tr>
                    <tr>
                      <th>Ümumi məbləğ</th>
                      <td><strong>₼ {{ totalPrice.toFixed(2) }}</strong></td>
                    </tr>
                    </tfoot>
                  </table>
                  <!-- End Product Content -->
                  <div class="form-group d-flex align-items-center justify-content-between mb-5">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" v-model="$v.accept.$model" id="orderAccept">
                      <label class="form-check-label form-label" for="orderAccept">
                        Mən alıcı razılaşmasını təsdiq edirəm || <a href="#" class="text-blue">Alıcı razılaşması </a>
                        <span class="text-danger">*</span>
                      </label>
                      <div
                        id="orderAccept-error"
                        v-if="!$v.accept.$model && $v.accept.$dirty"
                        :style="{ display: 'block' }"
                        class="invalid-feedback"
                      >
                        Alıcı razılaşmasını təsdiq etməlisiniz.
                      </div>
                    </div>

                  </div>
                  <button type="submit" :disabled="disabled" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">
                  <span
                    class="spinner-border spinner-border-sm mb-1"
                    v-if="loading"
                    role="status"
                    aria-hidden="true"
                  ></span>
                    Tamamla
                  </button>
                </div>
                <!-- End Order Summary -->
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div v-else>
      <div class="row">
        <div class="col-md-6 mx-auto mt-5">
          <div class="payment mb-7">
            <div class="payment_header">
              <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
            </div>
            <div class="content">
              <h1>Uğurlu əməliyyat !</h1>
              <p>{{ msg }}. </p>
              <a href="javascript:void()" onclick="window.location.href = Laravel.base_url">Anasəhifə</a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import { required, minLength, email ,requiredIf} from "vuelidate/lib/validators";

export default {
  name: "Checkout",

  props: ['lost_password_url','is_logged','user_id','single_user_url','payment_url'],

  data() {
    return {
      user: {},
      carts: {},
      email: '',
      password: '',
      surname: '',
      name: '',
      adress: '',
      city: '',
      number: '',
      login: false,
      note: '',
      accept: false,
      disabled: false,
      ordered: false,
      loading: false,
      loader: false,
      totalPrice: 0.00,
      msg: '',
    }
  },
  methods: {

    placeOrder() {
      this.$v.$touch()

      if(!this.$v.$invalid) {
        this.loader = true
        this.loading = true;
        this.disabled = true;

        let data = {
          email: this.email,
          login: this.login,
          is_loged: this.is_logged,
          name: this.name,
          surname: this.surname,
          adress: this.adress,
          city: this.city,
          number: this.number,
          note: this.note,
          accept: this.accept
        }

        this.login ? data.password = this.password : null
        this.is_logged === '1' ? data.user_id = this.user_id : null

        axios
          .post(this.payment_url, data)
          .then((res) => {
            this.ordered = true
            this.loader = false
            this.msg = res.data.mes
          })
          .catch(error => {
            this.loading = false;
            this.disabled = false;
            Swal.fire({
              title: error.response.data.mes,
              icon: 'error'
            })
          });
      }
    }
  },

  validations: {
    number: { required },
    city: { required, minLength: minLength(2) },
    adress: { required, minLength: minLength(5) },
    name: { required, minLength: minLength(2) },
    surname: { required, minLength: minLength(3) },
    accept: { required },
    email: { required,email },
    password: { required: requiredIf(function () {
        return this.login;
      }), minLength: minLength(8) },
  },
  async mounted() {
    if(this.is_logged == '1') {
      this.user = await axios.get(this.single_user_url)
      this.user = this.user.data.user
      this.email = this.user.email
      this.name = this.user.name
      this.surname = this.user.surname
      this.city = this.user.city
      this.adress = this.user.adress
      this.number = this.user.number
    }
    this.carts = await axios.get(Laravel.cart_url)
    this.carts = this.carts.data.cart
    Object.values(this.carts).map(item => {
      this.totalPrice += parseFloat(item.subtotal)
    } )
  },


}
</script>

<style scoped>
.payment
{
  border:1px solid #f2f2f2;
  height:280px;
  border-radius:20px;
  background:#fff;
}
.payment_header
{
  background:#fed700;
  padding:20px;
  border-radius:20px 20px 0px 0px;

}

.check
{
  margin:0px auto;
  width:50px;
  height:50px;
  border-radius:100%;
  background:#fff;
  text-align:center;
}

.check i
{
  vertical-align:middle;
  line-height:50px;
  font-size:30px;
}

.content
{
  text-align:center;
}

.content  h1
{
  font-size:25px;
  padding-top:25px;
}

.content a
{
  width:200px;
  height:35px;
  color:#fff;
  border-radius:30px;
  padding:5px 10px;
  background:#fed700;
  transition:all ease-in-out 0.3s;
}

.content a:hover
{
  text-decoration:none;
  background:#000;
}


</style>