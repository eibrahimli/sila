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
    >
      <h3 class="">İstifadəçi ayarları</h3>
      <p class="text-muted">
        Bu formdan istifadə edərək istifadəçi ayarlarını sürətli şəkildə
        dəyişə bilərsiniz...
      </p>
      <div class="col-12 fl justify-content-center">
        <label class="avatar-input">
          <span class="avatar avatar-xl">
            <img
              v-if="user.photo"
              :src="base_url + `/storage/` + user.photo"
              alt="..."
              class="avatar-img rounded-circle"
            />
            <span class="avatar-input-icon rounded-circle">
              <i class="mdi mdi-upload mdi-24px"></i>
            </span>
          </span>
          <input
            type="file"
            @change="getLogo($event)"
            class="avatar-file-picker"
          />
        </label>
      </div>
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
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="name">Ad</label>
          <input
            type="text"
            v-model.trim="$v.user.name.$model"
            class="form-control"
            :class="{
              'is-valid':
                $v.user.name.required || $v.user.name.minLength,
              'is-invalid':
                !$v.user.name.required || !$v.user.name.minLength,
            }"
            id="name"
            placeholder="Ad"
          />
          <div v-if="!$v.user.name.required" class="invalid-feedback">
            Ad boş ola bilməz...
          </div>
          <div v-if="!$v.user.name.minLength" class="invalid-feedback">
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
                $v.user.surname.required || $v.user.surname.minLength,
              'is-invalid':
                !$v.user.surname.required || !$v.user.surname.minLength,
            }"
            id="surname"
            placeholder="Soyad"
          />
          <div v-if="!$v.user.surname.required" class="invalid-feedback">
            Soyad boş ola bilməz...
          </div>
          <div v-if="!$v.user.surname.minLength" class="invalid-feedback">
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
              'is-valid': $v.user.email.required || $v.user.email.email,
              'is-invalid':
                !$v.user.email.required || !$v.user.email.email,
            }"
            id="inputEmail4"
            placeholder="Email"
            v-model="$v.user.email.$model"
          />
          <div v-if="!$v.user.email.required" class="invalid-feedback">
            Email boş ola bilməz...
          </div>
          <div v-if="!$v.user.email.email" class="invalid-feedback">
            Email doğru deyil...
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="form-label" for="password">Şifrə</label>
          <input
            type="password"
            class="form-control"
            :class="{
              'is-valid': $v.user.password.required,
              'is-invalid': !$v.user.password.required,
            }"
            id="password"
            v-model="$v.user.password.$model"
            placeholder="Şifrə"
          />
          <div v-if="!$v.user.password.minLength" class="invalid-feedback">
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
              'is-valid': $v.user.number.required,
              'is-invalid': !$v.user.number.required,
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
              'is-valid': $v.user.bank_account.required,
              'is-invalid': !$v.user.bank_account.required,
            }"
            id="bankAccount"
            v-model="$v.user.bank_account.$model"
            placeholder="Bank hesabı"
          />
          <div v-if="!$v.user.bank_account.required" class="invalid-feedback">
            Bank hesabı boş ola bilməz...
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label class="form-label" for="city">Şəhər</label>
          <input
            type="text"
            class="form-control"
            :class="{
              'is-valid': $v.user.city.required,
              'is-invalid': !$v.user.city.required,
            }"
            id="city"
            v-model="$v.user.city.$model"
            placeholder="Şəhər"
          />
          <div v-if="!$v.user.city.required" class="invalid-feedback">
            Şəhər boş ola bilməz...
          </div>
        </div>
        <div class="col-md-6 form-group">
          <label class="form-label" for="role">Vəzifə</label>
          <select id="role" v-model.trim="$v.user.role.$model" class="form-control is-valid">
              <option value="admin" :selected="user.role == 'admin'">Admin</option>
              <option value="seller" :selected="user.role == 'seller'">Satıcı</option>
              <option value="user" :selected="user.role == 'user'">İstifadəçi</option>
              <option value="company" :selected="user.role == 'company'">Şirkət</option>
              <option value="moderator" :selected="user.role == 'moderator'">Moderator</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="inputAddress" class="form-label">Adress</label>
        <input
          type="text"
          name="adress"
          v-model="$v.user.adress.$model"
          class="form-control"
          :class="{
            'is-valid':
              $v.user.adress.required || $v.user.adress.minLength,
            'is-invalid':
              !$v.user.adress.required || !$v.user.adress.minLength,
          }"
          id="inputAddress"
          placeholder="İstifadəçi adresi"
        />
        <div v-if="!$v.user.adress.required" class="invalid-feedback">
          İstifadəçi adresi boş ola bilməz...
        </div>
        <div v-if="!$v.user.adress.minLength" class="invalid-feedback">
          İstifadəçi adresi ən azı
          {{ $v.user.adress.$params.minLength.min }} simvol olmalıdır...
        </div>
      </div>
      <button type="submit" class="btn btn-success btn-cta">Yadda Saxla</button>
    </form>
  </div>
</template>

<script>
import { required, minLength, email } from "vuelidate/lib/validators";

export default {
  props: ['id','_method','url'],
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
        role: '',
        email: '',
        photo: ''
      },
      errors: []
    };
  },

  validations: {
    user: {
      name: {
        required: false,
        minLength: minLength(2),
      },
      surname: {
        required:false,
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
        required: false,
      },
      adress: {
        required:false,
        minLength: minLength(5),
      },
      city: {
        required:false,
        minLength: minLength(4),
      },
      bank_account: {
        required: false,
        minLength: minLength(5),
      },
      role: {
        required: false
      }
    },
  },

  mounted() {
    this.getUser(this.id);
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
    getUser: function (id) {
      axios.get(`${this.base_url}/admin/user/${id}`).then((res) => {
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
          title: "İstifadəçi redaktə edilir.",
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
          if (typeof this.user.photo == 'string' || this.user.photo == null) {
            delete this.user.photo;
          } else {
            this.user.photo = this.user.photo.files[0];
          } 

          let formdata = new FormData();
          for (var [key, value] of Object.entries(this.user)) {
            if(value != null) formdata.append(key, value);
          }
          formdata.set('_method',this._method)

          this.user.photo = ''

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
            vm.user.photo = res.data.photo;
          }
        }
      }
    },

    getLogo(e) {
      this.user.photo = e.target;
    },
  },
};
</script>