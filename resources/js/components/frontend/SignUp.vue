<template>
  <form @submit.prevent="submit()">
    <div
      id="signup"
      style="display: none; opacity: 0"
      data-target-group="idForm"
    >
      <!-- Title -->
      <header class="text-center mb-7">
        <h2 class="h4 mb-0">Sila Express - ə xoş gəlmisiniz.</h2>
        <p>Aşağıdakı formu dolduraraq saytımızdan pulsuz qeydiyyat edin.</p>
      </header>
      <!-- End Title -->

      <!-- Alert zone -->
        <div v-show="Object.entries(errors).length" class="alert alert-danger fade show" role="alert">
          <strong>Xəta!</strong> 
          <ul class="list-group">
            <li v-for="(error,index) in errors" :key="index">
              {{ error[0] }}
            </li>
          </ul>
        </div>
      <!-- End Alert zone -->

      <!-- Form Group -->
      <div class="form-group">
        <div
          class="js-form-message js-focus-state"
          :class="{
            'u-has-success': !$v.email.$invalid,
            'u-has-error': $v.email.$error,
          }"
        >
          <label class="sr-only" for="signupEmail">Email</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="signupEmailLabel">
                <span class="fas fa-user"></span>
              </span>
            </div>
            <input
              type="email"
              class="form-control"
              v-model.trim="$v.email.$model"
              id="signupEmail"
              placeholder="Email"
              aria-label="Email"
              aria-describedby="signupEmailLabel"
              data-error-class="u-has-error"
              data-success-class="u-has-success"
            />
          </div>
          <div
            id="signupEmail"
            v-if="!$v.email.required && $v.email.$dirty"
            :style="{ display: 'block' }"
            class="invalid-feedback"
          >
            Email boş ola bilməz.
          </div>
          <div
            id="signupEmail"
            v-if="!$v.email.email && $v.email.$dirty"
            :style="{ display: 'block' }"
            class="invalid-feedback"
          >
            Email adresi doğru deyil.
          </div>
        </div>
      </div>
      <!-- End Input -->

      <!-- Form Group -->
      <div class="form-group">
        <div
          class="js-form-message js-focus-state"
          :class="{
            'u-has-success': !$v.password.$invalid,
            'u-has-error': $v.password.$error,
          }"
        >
          <label class="sr-only" for="signupPassword">Şifrə</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="signupPasswordLabel">
                <span class="fas fa-lock"></span>
              </span>
            </div>
            <input
              type="password"
              class="form-control"
              v-model.trim="$v.password.$model"
              id="signupPassword"
              placeholder="Şifrə"
              aria-label="Password"
              aria-describedby="signupPasswordLabel"
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
      <!-- End Input -->

      <!-- Form Group -->
      <div class="form-group">
        <div
          class="js-form-message js-focus-state"
          :class="{
            'u-has-success':
              !$v.password.$invalid && $v.password_confirmation.sameAsPassword,
            'u-has-error': !$v.password_confirmation.sameAsPassword,
          }"
        >
          <label class="sr-only" for="signupConfirmPassword"
            >Yenidən Şifrə</label
          >
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="signupConfirmPasswordLabel">
                <span class="fas fa-key"></span>
              </span>
            </div>
            <input
              type="password"
              class="form-control"
              v-model.trim="$v.password_confirmation.$model"
              id="signupConfirmPassword"
              placeholder="Confirm Password"
              aria-label="Confirm Password"
              aria-describedby="signupConfirmPasswordLabel"
              data-error-class="u-has-error"
              data-success-class="u-has-success"
            />
          </div>
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
      </div>
      <!-- End Input -->

      <div class="mb-2">
        <button
          type="submit"
          class="btn btn-block btn-sm btn-primary transition-3d-hover"
          :disabled="disabled"
        >
        <span class="spinner-border spinner-border-sm" v-if="loading" role="status" aria-hidden="true"></span>
          Qeyd Ol
        </button>
      </div>

      <div class="text-center mb-4">
        <span class="small text-muted">Saytımızda hesabınız varmı?</span>
        <a
          class="js-animation-link small text-dark"
          href="javascript:;"
          data-target="#login"
          data-link-group="idForm"
          data-animation-in="slideInUp"
          >Giriş Et
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
  </form>
</template>

<script>
import { required, minLength, sameAs, email } from "vuelidate/lib/validators";

export default {
  name: "SingUp",
  data: () => {
    return {
      email: "",
      password: "",
      password_confirmation: "",
      loading: false,
      errors: [],
      msg: '',
      disabled: false,
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
      this.loading = true
      this.$v.$touch();
      if (!this.$v.$invalid) {
        this.disabled = true;
        axios
          .post(Laravel.base_url + "/user/qeydiyyat", {
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation,
          })
          .then((res) => this.showAlert(res));
      }
    },
    showAlert(res) {
      if (res.status == 200 && !res.data.error) {
        this.loading = false
        this.disabled = false
        Swal.fire({
          position: "center",
          icon: "success",
          title: res.data.mes,
          showConfirmButton: false,
          timer: 1500,
        });

        setTimeout(() => {
          window.location.href = Laravel.base_url
        },1500)

      } else if (res.data.error) {
        this.disabled = false
        this.loading = false
        this.errors = res.data.error
      } else {
        this.loading = false
        this.disabled = false
        this.msg = res.data.mes
      }
    },
  },
};
</script>

<style scoped></style>
