<template>
  <div id="forgotPassword" style="display: none; opacity: 0;" data-target-group="idForm">
    <!-- Title -->
    <header class="text-center mb-7">
      <h2 class="h4 mb-0">Şifrəni bərpa edin.</h2>
      <p>Email adresinizi daxil edin.Şifrə sıfırlama linki email hesabınıza göndəriləcək</p>
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
    <div
        v-if="msg"
        class="alert alert-danger alert-dismissible fade show"
        role="alert"
    >
      <strong>Xəta!</strong> {{ msg }}
    </div>
    <div
        v-if="successMsg"
        class="alert alert-success alert-dismissible fade show"
        role="alert"
    >
      <strong>Uğurlu!</strong> {{ successMsg }}
    </div>
    <!-- End Alert zone -->
    <form @submit.prevent="submit">
      <!-- Form Group -->
      <div class="form-group">
        <div class="js-form-message js-focus-state">
          <label class="sr-only" for="recoverEmail">Emailiniz</label>
          <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text" id="recoverEmailLabel">
              <span class="fas fa-user"></span>
            </span>
            </div>
            <input type="email" class="form-control" id="recoverEmail" placeholder="Email"
                   aria-label="Email" aria-describedby="recoverEmailLabel" v-model.trim="$v.email.$model"
                   data-error-class="u-has-error"
                   data-success-class="u-has-success">
            <div
                id="recoverEmail-error"
                v-if="!$v.email.required && $v.email.$dirty"
                :style="{ display: 'block' }"
                class="invalid-feedback"
            >
              Email boş ola bilməz.
            </div>
            <div
                id="recoverEmail-error"
                v-if="!$v.email.email && $v.email.$dirty"
                :style="{ display: 'block' }"
                class="invalid-feedback"
            >
              Email adresi doğru deyil.
            </div>
          </div>
        </div>
      </div>
      <!-- End Form Group -->

      <div class="mb-2">
        <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover" :disabled="disabled">
        <span
            class="spinner-border spinner-border-sm mb-1"
            v-if="loading"
            role="status"
            aria-hidden="true"
        ></span>
          Şifrəni bərpa et
        </button>
      </div>
    </form>
    <div class="text-center mb-4">
      <span class="small text-muted">Şifrənizi xatırladınız?</span>
      <a class="js-animation-link small" href="javascript:;" data-target="#login" data-link-group="idForm"
         data-animation-in="slideInUp">Giriş Et
      </a>
    </div>
  </div>
</template>

<script>
import {email, minLength, required} from "vuelidate/lib/validators";

export default {
  name: "Email",
  data() {
    return {
      email: "",
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
            .post(Laravel.base_url + "/user/forgot-password", {
              email: this.email,
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
        this.successMsg = res.data.mes
        this.disabled = false
      }
    },
  },
}
</script>

<style scoped>

</style>