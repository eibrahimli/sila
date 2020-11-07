<template>
  <div class="col-md-5 ml-md-auto ml-xl-0 mr-xl-auto">
    <!-- Title -->
    <div class="border-bottom border-color-1 mb-6">
      <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">
        Qeydiyyat
      </h3>
    </div>
    <p class="text-gray-90 mb-4">
      Fərdiləşdirilmiş alış-veriş təcrübəsindən faydalanmaq üçün bu gün yeni bir
      hesab yaradın.
    </p>
    <!-- End Title -->

    <!-- Alert zone -->
    <div
      v-show="Object.entries(errors).length"
      class="alert alert-danger fade show"
      role="alert"
    >
      <strong>Xəta!</strong>
      <ul class="list-group">
        <li v-for="(error, index) in errors" :key="index">
          {{ error[0] }}
        </li>
      </ul>
    </div>
    <!-- End Alert zone -->

    <!-- Form Group -->
    <form novalidate="novalidate" @submit.prevent="submit">
      <div
        class="js-form-message form-group"
        :class="{
          'u-has-success': !$v.email.$invalid,
          'u-has-error': $v.email.$error,
        }"
      >
        <label class="form-label" for="RegisterSrEmailExample3"
          >Email adres
          <span class="text-danger">*</span>
        </label>
        <input
          type="email"
          class="form-control"
          v-model.trim="$v.email.$model"
          id="RegisterSrEmailExample3"
          placeholder="Email adres"
          aria-label="Email address"
          data-error-class="u-has-error"
          data-success-class="u-has-success"
        />
        <div
          id="RegisterSrEmailExample3"
          v-if="!$v.email.required && $v.email.$dirty"
          :style="{ display: 'block' }"
          class="invalid-feedback"
        >
          Email boş ola bilməz.
        </div>
        <div
          id="RegisterSrEmailExample3"
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

      <p class="text-gray-90 mb-4">
        Şəxsi məlumatlarınız bu veb saytdakı təcrübənizi dəstəkləmək, hesabınızı
        idarə etmək və
        <a href="#" class="text-blue">Məxfilik Siyasətimizdə</a> təsvir olunan
        digər məqsədlər üçün istifadə ediləcəkdir.
      </p>
      <!-- Button -->
      <div class="mb-6">
        <div class="mb-3">
          <button type="submit" class="btn btn-primary-dark-w px-5" :disabled="disabled">
            <span
              class="spinner-border spinner-border-sm mb-1"
              v-if="loading"
              role="status"
              aria-hidden="true"
            ></span>
            Qeyd Ol
          </button>
        </div>
      </div>
      <!-- End Button -->
    </form>
    <h3 class="font-size-18 mb-3">Bu gün qeydiyyatdan keçin :</h3>
    <ul class="list-group list-group-borderless">
      <li class="list-group-item px-0">
        <i class="fas fa-check mr-2 text-green font-size-16"></i> Ödeme
        işləmlərinizi sürətləndirin
      </li>
      <li class="list-group-item px-0">
        <i class="fas fa-check mr-2 text-green font-size-16"></i>
        Sifarişlərinizi asanlıqla izləyin
      </li>
      <li class="list-group-item px-0">
        <i class="fas fa-check mr-2 text-green font-size-16"></i> Bütün satın
        alma işləmlərinizin qeydini tutun
      </li>
    </ul>
  </div>
</template>

<script>
import { required, minLength, sameAs, email } from "vuelidate/lib/validators";

export default {
  name: "Register",
  data: () => {
    return {
      email: "",
      password: "",
      password_confirmation: "",
      loading: false,
      errors: [],
      msg: "",
      loading: false,
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
      this.loading = true;
      this.$v.$touch();
      this.msg = '';
      this.errors = [];
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
      } else {
        this.disabled = false;
        this.loading = false;
        this.msg = res.data.mes;
      }
    },
  },
};
</script>

<style>
</style>