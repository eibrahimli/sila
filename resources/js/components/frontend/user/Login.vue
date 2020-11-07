<template>
  <div class="col-md-5 ml-xl-auto mr-md-auto mr-xl-0 mb-8 mb-md-0">
    <!-- Title -->
    <div class="border-bottom border-color-1 mb-6">
      <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Giriş</h3>
    </div>
    <p class="text-gray-90 mb-4">
      Yenidən salam! Hesabınızı idarə etmək üçün giriş edin.
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
      <!-- End Form Group -->

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
          id="signinSrPasswordExample2-error"
          v-if="!$v.password.required && $v.password.$dirty"
          :style="{ display: 'block' }"
          class="invalid-feedback"
        >
          Şifrə boş ola bilməz.
        </div>
        <div
          id="signinSrPasswordExample2-error"
          v-if="!$v.password.minLength && $v.password.$dirty"
          :style="{ display: 'block' }"
          class="invalid-feedback"
        >
          Şifrə ən azı {{ $v.password.$params.min }} simvol olmalıdır.
        </div>
      </div>
      <!-- End Form Group -->

      <!-- Checkbox -->
      <div class="js-form-message mb-3">
        <div class="custom-control custom-checkbox d-flex align-items-center">
          <input
            type="checkbox"
            class="custom-control-input"
            id="rememberCheckbox"
            v-model="rememberCheckbox"
            data-error-class="u-has-error"
            data-success-class="u-has-success"
          />
          <label class="custom-control-label form-label" for="rememberCheckbox">
            Məni Xatırla
          </label>
        </div>
      </div>
      <!-- End Checkbox -->

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
            Giriş Et
          </button>
        </div>
        <div class="mb-2">
          <a class="text-blue" :href="resetpath">Şifrəni unutmusan?</a>
        </div>
      </div>
      <!-- End Button -->
    </form>
  </div>
</template>

<script>
import { required, minLength, email } from "vuelidate/lib/validators";

export default {
  name: "Login",
  props: ['resetpath'],
  data() {
    return {
      email: "",
      password: "",
      rememberCheckbox: false,
      errors: "",
      loading: false,
      msg: "",
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
  },
  methods: {
    submit() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        this.loading = true;
        this.errors = "";
        this.msg = "";
        this.disabled = true;
        axios
          .post(Laravel.base_url + "/user/giris", {
            email: this.email,
            password: this.password,
            rememberCheckbox: this.rememberCheckbox
          })
          .then((res) => this.showAlert(res))
          .catch((error) => {
            this.loading = false;
            this.msg = error.response.data.mes;
            this.disabled = false;
          });
      }
    },
    showAlert(res) {
      if (res.status == 200 && !res.data.error) {
        this.disabled = false;
        this.loading = false;
        Swal.fire({
          position: "center",
          icon: "success",
          title: res.data.mes,
          showConfirmButton: false,
          timer: 1500,
        });

        setTimeout(() => {
          window.location.href = Laravel.base_url;
        }, 1500);
      } else if (res.data.error) {
        this.disabled = false
        this.loading = false;
        this.errors = res.data.error;
      }
    },
  },
};
</script>

<style>
</style>