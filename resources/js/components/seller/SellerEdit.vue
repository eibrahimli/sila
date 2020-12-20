<template>
  <div>
    <div class="row justify-content-center">
      <div class="spinner-grow text-dark" v-show="loading" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <form
      method="POST"
      v-show="!loading"
      enctype="multipart/form-data"
      @submit.prevent="submit()"
      autocomplete="off"
    >
      <h3 class="">Profil ayarlarınız...</h3>
      <p class="text-muted">
        Bu formdan istifadə edərək ayarlarınızı sürətli şəkildə
        dəyişə bilərsiniz...
      </p>

      <div v-if="validationErrors.length" class="alert alert-danger" role="alert">
        <strong>Xəta!</strong>
        <div v-if="typeof validationErrors != 'string'">
          <ul>
            <li v-for="error in validationErrors">{{ error }}</li>
          </ul>
        </div>
        <div v-else>
          {{ validationErrors }}
        </div>
      </div>
      <input autocomplete="false" name="hidden" type="hidden" class="hidden">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="name">Ad</label>
          <input
            type="text"
            v-model.trim="$v.user.name.$model"
            class="form-control"
            :class="{
              'is-valid':
                $v.user.name.required && $v.user.name.$dirty,
              'is-invalid':
                !$v.user.name.required && $v.user.name.$dirty,
            }"
            id="name"
            placeholder="Ad"
          />
          <div v-if="!$v.user.name.required && $v.user.name.$dirty" class="invalid-feedback">
            Ad boş ola bilməz...
          </div>
          <div v-if="!$v.user.name.minLength && $v.user.name.$dirty" class="invalid-feedback">
            Ad ən azı {{ $v.user.name.$params.minLength.min }} simvol
            olmalıdır...
          </div>
        </div>

        <div class="form-group col-md-6">
          <label for="surname">Soyad</label>
          <input
            type="text"
            v-model.trim="$v.user.surname.$model"
            class="form-control"
            :class="{
              'is-valid':
                $v.user.surname.required && $v.user.surname.$dirty,
              'is-invalid':
                !$v.user.surname.required && $v.user.surname.$dirty,
            }"
            id="surname"
            placeholder="Soyad"
          />
          <div v-if="!$v.user.surname.required && $v.user.surname.$dirty" class="invalid-feedback">
            Soyad boş ola bilməz...
          </div>
          <div v-if="!$v.user.surname.minLength && $v.user.surname.$dirty" class="invalid-feedback">
            Soyad ən azı {{ $v.user.surname.$params.minLength.min }} simvol
            olmalıdır...
          </div>
        </div>
      </div>
      <div class="form-row">

        <div class="form-group col-md-6">
          <label for="inputEmail4">Email</label>
          <input
            type="email"
            class="form-control"
            :class="{
              'is-valid': $v.user.email.required && $v.user.email.$dirty,
              'is-invalid':
                !$v.user.email.required && $v.user.email.$dirty,
            }"
            id="inputEmail4"
            placeholder="Email"
            v-model="$v.user.email.$model"
          />
          <div v-if="!$v.user.email.required && $v.user.email.$dirty" class="invalid-feedback">
            Email boş ola bilməz...
          </div>
          <div v-if="!$v.user.email.email && $v.user.email.$dirty" class="invalid-feedback">
            Email doğru deyil...
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="form-label" for="password">Şifrə</label>
          <input
            type="password"
            class="form-control"
            :class="{
              'is-valid': $v.user.password.required && $v.user.password.$dirty,
              'is-invalid': !$v.user.password.required && $v.user.password.$dirty,
            }"
            id="password"
            v-model="$v.user.password.$model"
            placeholder="Şifrə"
            autocomplete="off"
          />
          <div v-if="!$v.user.password.minLength && $v.user.password.$dirty" class="invalid-feedback">
            Şifrə ən azı {{ $v.user.password.$params.minLength.min }} simvol
            olmalıdır...
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label class="form-label" for="number">Nömrə</label>
          <input
            type="text"
            name="number"
            class="form-control"
            :class="{
              'is-valid': $v.user.number.required && $v.user.number.$dirty,
              'is-invalid': !$v.user.number.required && $v.user.number.$dirty,
            }"
            id="number"
            v-model="$v.user.number.$model"
            data-mask="(00000)-000-00-00"
            data-mask-clearifnotmatch="true"
            placeholder="(00000)-000-00-00"
          />
          <div v-if="!$v.user.number.required" class="invalid-feedback">
            Nömrə boş ola bilməz...
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="form-label" for="bankAccount">Bank hesabı</label>
          <input
            type="text"
            class="form-control"
            :class="{
              'is-valid': $v.user.bank_account.required && $v.user.bank_account.$dirty,
              'is-invalid': !$v.user.bank_account.minLength && $v.user.bank_account.$dirty,
            }"
            id="bankAccount"
            v-model="$v.user.bank_account.$model"
            placeholder="Bank hesabı"
          />
          <div v-if="!$v.user.bank_account.required" class="invalid-feedback">
            Bank hesabı boş ola bilməz...
          </div>
          <div v-if="!$v.user.bank_account.minLength && $v.user.bank_account.$dirty" class="invalid-feedback">
            Bank hesab nömrəniz ən azı
            {{ $v.user.bank_account.$params.minLength.min }} rəqəm olmalıdır...
          </div>
          <div v-if="!$v.user.bank_account.integer && $v.user.bank_account.$dirty" class="invalid-feedback">
            Bank hesab nömrəniz yalnız rəqəmlərdən ibarət olmalıdır...
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-12">
          <label class="form-label" for="city">Şəhər</label>
          <input
            type="text"
            class="form-control"
            :class="{
              'is-valid': $v.user.city.required && $v.user.city.$dirty,
              'is-invalid': !$v.user.city.required && $v.user.city.$dirty,
            }"
            id="city"
            v-model="$v.user.city.$model"
            placeholder="Şəhər"
          />
          <div v-if="!$v.user.city.required && $v.user.city.$dirty" class="invalid-feedback">
            Şəhər boş ola bilməz...
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="adress" class="form-label">Adress</label>
        <textarea
          type="text"
          name="adress"
          v-model="$v.user.adress.$model"
          class="form-control"
          :class="{
            'is-valid':
              $v.user.adress.required && $v.user.adress.$dirty,
            'is-invalid':
              !$v.user.adress.required && $v.user.adress.$dirty,
          }"
          id="adress"
          placeholder="Satıcı adresi"
        />
        <div v-if="!$v.user.adress.required && $v.user.adress.$dirty" class="invalid-feedback">
          Satıcı adresi boş ola bilməz...
        </div>
        <div v-if="!$v.user.adress.minLength && $v.user.adress.$dirty" class="invalid-feedback">
          Satıcı adresi ən azı
          {{ $v.user.adress.$params.minLength.min }} simvol olmalıdır...
        </div>
      </div>
      <button type="submit" class="btn btn-success btn-cta">Yadda Saxla</button>
    </form>
  </div>
</template>

<script>
import { required, integer , minLength, email } from "vuelidate/lib/validators";

export default {
  name: "SellerEdit",
  props: ['get_user','_method','url'],
  data() {
    return {
      loading: true,
      base_url: "",
      user: {
        name: '',
        surname: '',
        number: '',
        password: '',
        city: '',
        adress: '',
        bank_account: '',
        email: '',
      },
      errors: []
    };
  },

  validations: {
    user: {
      name: {
        required,
        minLength: minLength(2),
      },
      surname: {
        required,
        minLength: minLength(2),
      },
      email: {
        required,
        email,
      },
      password: {
        required: false,
        minLength: minLength(8)
      },
      number: {
        required,
      },
      adress: {
        required,
        minLength: minLength(5),
      },
      city: {
        required,
        minLength: minLength(4),
      },
      bank_account: {
        integer,
        required,
        minLength: minLength(16),
      },
    },
  },

  mounted() {
    this.getUser();
    this.base_url = Laravel.base_url;
  },

  computed: {
    validationErrors() {
      if(typeof this.errors != 'string') {
        this.errors = Object.values(this.errors).flat()

        return this.errors
      }

      return this.errors
    }
  },

  methods: {
    getUser: function () {
      axios.get(this.get_user).then((res) => {
        if(Object.entries(res.data).length > 0) {
          this.user = res.data.user
        }
      });
      window.onload = () => {
        setTimeout(() => {
          this.loading = false
        },1000)
      }
    },

    submit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        console.log('error')
      } else {
        const vm = this;
        Swal.fire({
          title: "Satıcı redaktə edilir.",
          html: `
							<div class="d-flex justify-content-center">
									<div class="spinner-border" role="status">
											<span class="sr-only">Loading...</span>
									</div>
							</div>
							`,
          showConfirmButton: false,
        });

        setTimeout(() => {

          let formdata = new FormData();
          for (var [key, value] of Object.entries(this.user)) {
            if(value != null) formdata.append(key, value);
          }
          formdata.set('_method',this._method)

          axios
            .post(this.url, formdata)
            .then((res) => showAlert(res))
            .catch((error) => {
              this.errors = error.response.data.error
              Swal.close()
            });
        }, 1000);
        function showAlert(res) {
          if (res.status == 200) {
            Swal.fire({
              position: "center",
              icon: "success",
              title: res.data.mes,
              showConfirmButton: false,
              timer: 1500,
            });
          }
        }
      }
    },

  },
};
</script>

<style scoped>

</style>