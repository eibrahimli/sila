<template>
  <div id="login" data-target-group="idForm">
    <!-- Title -->
    <header class="text-center mb-7">
      <h2 class="h4 mb-0">Yenidən Salam!</h2>
      <p>Profilinizi idarə etmək üçün saytımıza giriş edin.</p>
    </header>
    <!-- End Title -->

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
    <div v-if="msg"
      class="alert alert-danger alert-dismissible fade show"
      role="alert"
    >
      <strong>Xəta!</strong> {{ msg }}
    </div>
    
    <!-- End Alert zone -->

    <form @submit.prevent="submit">
      <!-- Form Group -->
      <div class="form-group">
        <div
          class="js-form-message js-focus-state"
          :class="{
            'u-has-success': !$v.email.$invalid,
            'u-has-error': $v.email.$error,
          }"
        >
          <label class="sr-only" for="signinEmail">Email</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="signinEmailLabel">
                <span class="fas fa-user"></span>
              </span>
            </div>
            <input
              type="email"
              class="form-control"
              v-model.trim="$v.email.$model"
              id="signinEmail"
              placeholder="Email"
              aria-label="Email"
              aria-describedby="signinEmailLabel"            
              data-msg="Doğru email adresi daxil edin."
              data-error-class="u-has-error"
              data-success-class="u-has-success"
            />
          </div>
          <div
            id="signupEmail-error"
            v-if="!$v.email.required && $v.email.$dirty"
            :style="{ display: 'block' }"
            class="invalid-feedback"
          >
            Email boş ola bilməz.
          </div>
          <div
            id="signupEmail-error"
            v-if="!$v.email.email && $v.email.$dirty"
            :style="{ display: 'block' }"
            class="invalid-feedback"
          >
            Email adresi doğru deyil.
          </div>
        </div>
      </div>
      <!-- End Form Group -->

      <!-- Form Group -->
      <div class="form-group">
        <div
          class="js-form-message js-focus-state"
          :class="{
            'u-has-success': !$v.password.$invalid,
            'u-has-error': $v.password.$error,
          }"
        >
          <label class="sr-only" for="signinPassword">Şifrə</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="signinPasswordLabel">
                <span class="fas fa-lock"></span>
              </span>
            </div>
            <input
              type="password"
              class="form-control"
              v-model.trim="$v.password.$model"
              id="signinPassword"
              placeholder="Şifrə"
              aria-label="Password"
              aria-describedby="signinPasswordLabel"              
              data-msg="Şifrəniz yanlışdır. Lütfən yenidən yoxlayın."
              data-error-class="u-has-error"
              data-success-class="u-has-success"
            />
          </div>
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
            Şifrə ən azı {{ $v.password.$params.minLength.min }} simvol olmalıdır.
          </div>
        </div>
      </div>
      <!-- End Form Group -->

      <div class="d-flex justify-content-end mb-4">
        <a
          class="js-animation-link small link-muted"
          href="javascript:;"
          data-target="#forgotPassword"
          data-link-group="idForm"
          data-animation-in="slideInUp"
          >Şifrənizi Unutdunuz?</a
        >
      </div>

      <div class="mb-2">
        <button
          type="submit"
          class="btn btn-block btn-sm btn-primary transition-3d-hover"
          :disabled="disabled"
        >
          <span
            class="spinner-border spinner-border-sm mb-1"
            v-if="loading"
            role="status"
            aria-hidden="true"
          ></span>
          Giriş Et
        </button>
      </div>
    </form>

    <div class="text-center mb-4">
      <span class="small text-muted">Hesabınız yoxdur?</span>
      <a
        class="js-animation-link small text-dark"
        href="javascript:;"
        data-target="#signup"
        data-link-group="idForm"
        data-animation-in="slideInUp"
        >Qeydiyyat
      </a>
    </div>

    <div class="text-center">
      <span class="u-divider u-divider--xs u-divider--text mb-4">Və ya</span>
    </div>

    <!-- Login Buttons -->
    <div class="d-flex">
      <a
        class="btn btn-block btn-sm btn-soft-facebook transition-3d-hover mr-1"
        href="#"
      >
        <span class="fab fa-facebook-square mr-1"></span>
        Facebook
      </a>
      <a
        class="btn btn-block btn-sm btn-soft-google transition-3d-hover ml-1 mt-0"
        href="#"
      >
        <span class="fab fa-google mr-1"></span>
        Google
      </a>
    </div>
    <!-- End Login Buttons -->
  </div>
</template>

<script>
import { required, minLength, email } from "vuelidate/lib/validators";

export default {
  name: "SignIn",
  data() {
    return {
      email: "",
      password: "",
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
        this.disabled = true;
        this.errors = "";
        this.msg = "";
        axios
          .post(Laravel.base_url + "/user/giris", {
            email: this.email,
            password: this.password,
          })
          .then((res) => this.showAlert(res))
          .catch(error => {
            this.loading = false;
            this.disabled = false;
            this.msg = error.response.data.mes;
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
          window.location.href = Laravel.base_url;
        }, 1500);
      } else if (res.data.error) {
        this.disabled = false;
        this.loading = false;
        this.errors = res.data.error;
      }
    },
  },
};
</script>

<style>
</style>