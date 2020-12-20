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
      <h3 class="">Mağaza ayarları</h3>
      <p class="text-muted">
        Bu formdan istifadə edərək yeni mağaza sürətli şəkildə
        əlavə edə bilərsiniz...
      </p>
      <div v-if="Object.entries(errors).length" class="alert alert-danger" role="alert">
        <strong>Xəta!</strong>
        <div>{{ errors }}</div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label for="name">Mağaza Adı</label>
          <input
            type="text"
            v-model.trim="$v.store.name.$model"
            class="form-control"
            :class="{
              'is-valid':
                !$v.store.name.$invalid && $v.store.name.$dirty,
              'is-invalid':
                $v.store.name.$invalid && $v.store.name.$dirty,
            }"
            id="name"
            placeholder="Ad"
          />
          <div v-if="!$v.store.name.required && $v.store.name.$dirty" class="invalid-feedback">
            Ad boş ola bilməz...
          </div>
          <div v-if="!$v.store.name.minLength && $v.store.name.$dirty" class="invalid-feedback">
            Ad ən azı {{ $v.store.name.$params.minLength.min }} simvol
            olmalıdır...
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="keyw">Nömrə</label>
          <input
            type="text"
            name="number"
            class="form-control"
            :class="{
              'is-valid': !$v.store.number.$invalid && $v.store.number.$dirty,
              'is-invalid': $v.store.number.$invalid && $v.store.number.$dirty,
            }"
            id="number"
            v-model="$v.store.number.$model"
            data-mask="(00000)-000-00-00"
            data-mask-clearifnotmatch="true"
            placeholder="(99400)-000-00-00"
          />
          <div v-if="!$v.store.keyw.required && $v.store.keyw.$dirty" class="invalid-feedback">
            Nömrə boş ola bilməz...
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="keyw">Mağaza açar sözlər</label>
          <input
            type="text"
            v-model.trim="$v.store.keyw.$model"
            class="form-control"
            :class="{
              'is-valid':
                !$v.store.keyw.$invalid && $v.store.keyw.$dirty,
              'is-invalid':
                $v.store.keyw.$invalid && $v.store.keyw.$dirty,
            }"
            id="keyw"
            placeholder="Açar sözlər"
          />
          <div v-if="!$v.store.keyw.required && $v.store.keyw.$dirty" class="invalid-feedback">
            Soyad boş ola bilməz...
          </div>
          <div v-if="!$v.store.keyw.minLength && $v.store.keyw.$dirty" class="invalid-feedback">
            Soyad ən azı {{ $v.store.keyw.$params.minLength.min }} simvol
            olmalıdır...
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label class="form-label" for="desc">Açıqlama</label>
          <textarea
            type="text"
            class="form-control"
            :class="{
              'is-valid': !$v.store.desc.$invalid && $v.store.desc.$dirty,
              'is-invalid': $v.store.desc.$invalid && $v.store.desc.$dirty,
            }"
            id="desc"
            v-model="$v.store.desc.$model"
            placeholder="Açıqlama"
          ></textarea>
          <div v-if="!$v.store.desc.required && $v.store.desc.$dirty" class="invalid-feedback">
            Açıqlama boş ola bilməz...
          </div>
          <div v-if="!$v.store.desc.minLength && $v.store.desc.$dirty" class="invalid-feedback">
            Açıqlama ən azı {{ $v.store.desc.$params.minLength.min }} simvol
            olmalıdır...
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="form-label" for="address">Adres</label>
          <textarea
            type="text"
            class="form-control"
            :class="{
              'is-valid': !$v.store.address.$invalid && $v.store.address.$dirty,
              'is-invalid': $v.store.address.$invalid && $v.store.address.$dirty,
            }"
            id="address"
            v-model="$v.store.address.$model"
            placeholder="Adres"
          ></textarea>
          <div v-if="!$v.store.address.required && $v.store.address.$dirty" class="invalid-feedback">
            Adres boş ola bilməz...
          </div>
          <div v-if="!$v.store.address.minLength && $v.store.address.$dirty" class="invalid-feedback">
            Adres ən azı {{ $v.store.address.$params.minLength.min }} simvol
            olmalıdır...
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-success btn-cta">Yadda Saxla</button>
    </form>
  </div>
</template>

<script>
import { required, minLength } from "vuelidate/lib/validators";

export default {
  props: ['url'],
  data() {
    return {
      loading: true,
      base_url: "",
      options: [],
      store: {
        name: '',
        number: '',
        address: '',
        keyw: '',
        desc: '',
      },
      errors: []
    };
  },
  validations: {
    store: {
      name: {
        required,
        minLength: minLength(2),
      },
      keyw: {
        required,
        minLength: minLength(3),
      },
      number: {
        required,
      },
      desc: {
        required,
        minLength: minLength(5)
      },
      address: {
        required,
        minLength: minLength(5)
      }
    },
  },
  mounted() {
    window.onload = () => {
      this.loading = false
    }
  },
  methods: {

    submit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        console.log('error')
      } else {
        const vm = this;
        Swal.fire({
          title: "Mağaza əlavə edilir.",
          html:
              `
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
          for (let [key, value] of Object.entries(this.store)) {
            if(value != null) formdata.append(key, value);
          }

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
