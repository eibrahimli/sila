<template>
  <div class="col-md-10 ml-xl-auto mr-md-auto mr-xl-0 mb-8 mb-md-0">
    <!-- Title -->
    <div class="border-bottom border-color-1 mb-6">
      <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Şifrəni unutmusan?</h3>
    </div>
    <p class="text-gray-90 mb-4">
      Əgər şifrənizi unutmusunuzsa aşağıdakı formdan istifadə edərək sıfırlaya bilərsiniz.
    </p>
    <!-- Alert zone -->
    <div
      v-if="Object.entries(errors).length"
      class="alert alert-danger alert-dismissible fade show"
      role="alert"
    >
      <strong>Xəta!</strong>
      <ul class="list-group">
        <li v-for="(error, index) in errors" :key="index">
          {{ error[0] }}
        </li>
      </ul>
    </div>
    <div
      v-if="msg"
      class="alert alert-danger alert-dismissible fade show"
      role="alert"
    >
      <strong>Xəta!</strong> {{ msg }}
    </div>

    <!-- End Alert zone -->

    <!-- End Title -->
    <form novalidate="novalidate" @submit.prevent="submit()">
      <!-- Form Group -->
      <div
        class="js-form-message form-group"
        :class="{
          'u-has-success': !$v.email.$invalid,
          'u-has-error': $v.email.$error,
        }"
      >
        <label class="form-label" for="signinSrEmailExample3"
          >Email adres
          <span class="text-danger">*</span>
        </label>
        <input
          type="email"
          class="form-control"
          v-model.trim="$v.email.$model"
          id="signinSrEmailExample3"
          placeholder="Email adres"
          aria-label="Email adres"
          data-error-class="u-has-error"
          data-success-class="u-has-success"
        />
        <div
          id="signinSrEmailExample3-error"
          v-if="!$v.email.required && $v.email.$dirty"
          :style="{ display: 'block' }"
          class="invalid-feedback"
        >
          Email boş ola bilməz.
        </div>
        <div
          id="signinSrEmailExample3-error"
          v-if="!$v.email.email && $v.email.$dirty"
          :style="{ display: 'block' }"
          class="invalid-feedback"
        >
          Email adresi doğru deil.
        </div>
      </div>
      <!-- Form Group -->
      <div
        class="js-form-message form-group"
        :class="{
          'u-has-success': !$v.password.$invalid,
          'u-has-error': $v.password.$error,
        }"
      >
        <label class="form-label" for="signinSrPasswordExample2"
          >Şifrə <span class="text-danger">*</span></label
        >
        <input
          type="password"
          class="form-control"
          v-model.trim="$v.password.$model"
          id="signinSrPasswordExample2"
          placeholder="Şifrə"
          aria-label="Şifrə"
          data-error-class="u-has-error"
          data-success-class="u-has-success"
        />
        <div
          id="signupPassword-error"
          v-if="!$v.password.required && $v.password.$dirty"
          :style="{ display: 'block' }"
          class="invalid-feedback"
        >
          Şifrə boş ola bilməz.
        </div>
        <div
          id="signupPassword-error"
          v-if="!$v.password.minLength && $v.password.$dirty"
          :style="{ display: 'block' }"
          class="invalid-feedback"
        >
          Şifrə ən azı {{ $v.password.$params.min }} simvol olmalıdır.
        </div>
      </div>
      <!-- End Form Group -->

      <!-- Form Group -->
      <div
        class="js-form-message form-group"
        :class="{
          'u-has-success':
            !$v.password.$invalid && $v.password_confirmation.sameAsPassword,
          'u-has-error': !$v.password_confirmation.sameAsPassword,
        }"
      >
        <label class="form-label" for="signinSrPasswordAgainExample2"
          >Şifrə Yenidən <span class="text-danger">*</span></label
        >
        <input
          type="password"
          class="form-control"
          v-model.trim="$v.password_confirmation.$model"
          id="signinSrPasswordAgainExample2"
          placeholder="Şifrə"
          aria-label="Şifrə"
          data-error-class="u-has-error"
          data-success-class="u-has-success"
        />
        <div
          id="signupConfirmPassword-error"
          v-if="
            !$v.password_confirmation.sameAsPassword &&
            $v.password_confirmation.$dirty
          "
          :style="{ display: 'block' }"
          class="invalid-feedback"
        >
          Şifrəniz bir-biri ilə uyuşmur.
        </div>
      </div>
      <!-- End Form Group -->

      <!-- End Form Group -->
      <!-- Button -->
      <div class="mb-1">
        <div class="mb-3">
          <button type="submit" class="btn btn-primary-dark-w px-5" :disabled="disabled">
            <span
              class="spinner-border spinner-border-sm mb-1"
              v-if="loading"
              role="status"
              aria-hidden="true"
            ></span>
            Şifrəni sıfırla
          </button>
        </div>
      </div>
      <!-- End Button -->
    </form>
  </div>
</template>

<script>
import { required, minLength, email , sameAs} from "vuelidate/lib/validators";

export default {
  name: "Reset",
  props: ['token','inputemail','url'],
  data() {
    return {
      email: this.inputemail,
      password: "",
      password_confirmation: "",
      errors: "",
      loading: false,
      msg: "",
      successMsg: "",
      disabled: false
    };
  },
  validations: {
    email: {
      required,
      email,
    },
    password: {
      required,
      minLength: minLength(8),
    },
    password_confirmation: {
      sameAsPassword: sameAs("password"),
    },
  },
  methods: {
    submit() {      
      this.$v.$touch();
      if (!this.$v.$invalid) {
        this.disabled = true
        this.loading = true;
        this.errors = "";
        this.msg = "";  
        this.successMsg = "";    
        axios
          .post(Laravel.base_url + "/user/reset-password", {
            email: this.email,      
            token: this.token,
            password: this.password,
            password_confirmation: this.password_confirmation  
          })
          .then((res) => this.showAlert(res))
          .catch((error) => {
            this.loading = false;
            this.msg = error.response.data.error;
            this.disabled = false
          });
      }
    },
    showAlert(res) {
      if (res.status == 200 && !res.data.error) {
        this.loading = false;        
        this.disabled = false;
        Swal.fire({
          position: "center",
          icon: "success",
          title: res.data.mes,
          showConfirmButton: false,
          timer: 1500,
        });

        setTimeout(() => {
          window.location.href = this.url;
        }, 1500);
      } 
    },
  },
};
</script>

<style>
</style>