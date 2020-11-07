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
      <h3 class="">Kateqoriya ayarları</h3>
      <p class="text-muted">
        Bu formdan istifadə edərək kateqoriya ayarlarını sürətli şəkildə
        dəyişə bilərsiniz...
      </p>
      <div v-if="Object.entries(errors).length" class="alert alert-danger" role="alert">
        <strong>Xəta!</strong> 
        <div>{{ errors }}</div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="name">Ad</label>
          <input
            type="text"
            v-model.trim="$v.category.name.$model"
            class="form-control"
            :class="{
              'is-valid':
                $v.category.name.required || $v.category.name.minLength,
              'is-invalid':
                !$v.category.name.required || !$v.category.name.minLength,
            }"
            id="name"
            placeholder="Ad"
          />
          <div v-if="!$v.category.name.required" class="invalid-feedback">
            Ad boş ola bilməz...
          </div>
          <div v-if="!$v.category.name.minLength" class="invalid-feedback">
            Ad ən azı {{ $v.category.name.$params.minLength.min }} simvol
            olmalıdır...
          </div>
        </div>

        <div class="form-group col-md-6">
          <label for="keyw">Kateqoriya açar sözlər</label>
          <input
            type="text"
            v-model.trim="$v.category.keyw.$model"
            class="form-control"
            :class="{
              'is-valid':
                $v.category.keyw.required || $v.category.keyw.minLength,
              'is-invalid':
                !$v.category.keyw.required || !$v.category.keyw.minLength,
            }"
            id="keyw"
            placeholder="Açar sözlər"
          />
          <div v-if="!$v.category.keyw.required" class="invalid-feedback">
            Açar sözlər boş ola bilməz...
          </div>
          <div v-if="!$v.category.keyw.minLength" class="invalid-feedback">
            Açar sözlər ən azı {{ $v.category.keyw.$params.minLength.min }} simvol
            olmalıdır...
          </div>
        </div>
      </div>     
      <div class="form-row">
        <div class="form-group col-md-12">
          <label class="form-label" for="desc">Açıqlama</label>
          <textarea
            type="text"
            class="form-control"
            :class="{
              'is-valid': $v.category.desc.required || $v.category.desc.minLength,
              'is-invalid': !$v.category.desc.required || !$v.category.desc.minLength,
            }"
            id="desc"
            v-model="$v.category.desc.$model"
            placeholder="Açıqlama"
          ></textarea>
          <div v-if="!$v.category.desc.required" class="invalid-feedback">
            Açıqlama boş ola bilməz...
          </div>
          <div v-if="!$v.category.desc.minLength" class="invalid-feedback">
            Açıqlama ən azı {{ $v.category.desc.$params.minLength.min }} simvol
            olmalıdır...
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 form-group">
          <label class="form-label" for="lang">Dil</label>
          <v-select :options="['Az','En','Ru','Tr']" :reduce="option => option.charAt(0).toUpperCase() + option.slice(1)" placeholder="Dil seçin" id="lang" v-model.trim="$v.category.lang.$model" :class="{
              'is-valid': $v.category.lang.required,
              'is-invalid': !$v.category.lang.required,
            }" />          
          <div v-if="!$v.category.lang.required" style="display:block" class="invalid-feedback">
            Boş Saxlama...
          </div>
        </div>

        <div class="col-md-6 form-group">
          <label class="form-label" for="category_id">Kateqoriya</label>
          <v-select label="name" :placeholder="category.category_id == 0 ? 'Əsas Kateqoriya' : ''" :options="options" :reduce="category => category.id" v-model.trim="$v.category.category_id.$model">                        
            
          </v-select>     
          <div v-if="!$v.category.category_id.required" style="display:block" class="invalid-feedback">
            Kateqoriya boş ola bilməz...
          </div>
          <div v-if="!$v.category.category_id.numeric" style="display:block" class="invalid-feedback">
            Rəqəm olmalıdır...
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-success btn-cta">Yadda Saxla</button>
    </form>
  </div>
</template>

<script>
import { required, minLength, numeric } from "vuelidate/lib/validators";

export default {
  props: ['url','getcategoryurl','_method'],
  data() {
    return {
      loading: true,
      base_url: "",
      options: [],
      category: {
        name: '',
        keyw: '',
        desc: '',
        lang: '',
        category_id: '',
        photo: ''
      },      
      errors: []
    };
  },
  validations: {
    category: {
      name: {
        required,
        minLength: minLength(2),
      },
      keyw: {
        required,
        minLength: minLength(2),
      },
      lang: {
        required,
      },
      desc: {
        required,
        minLength: minLength(5)
      },
      category_id: {
        required : false,
        numeric
      },
    },
  },
  mounted() {
    this.getCategory();
    this.getCategories();
    this.base_url = Laravel.base_url;
  },

  methods: {
    getCategory() {
      axios.get(this.getcategoryurl).then(res => {
        this.category = res.data.category;
        this.category.lang = this.category.lang.charAt(0).toUpperCase() + this.category.lang.slice(1)
      }).catch(err => console.log(err.response.data.error))
    },
    getCategories() {
      axios.get(`${this.base_url}/admin/category/categories`).then(res => this.options = res.data.categories).catch(err => this.categories = "")
      this.loading = false;
    },

    submit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        console.log('error')
      } else {
        const vm = this;
        Swal.fire({
          title: "Kateqoriya redakə edilir.",
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
          if (typeof this.category.photo == 'string' || this.category.photo == null) {
            delete this.category.photo;
          } else {
            this.category.photo = this.category.photo.files[0];
          } 

          if(this.category.category_id == '') {
            delete this.category.category_id
          }

          this.category.lang = this.category.lang.toLowerCase()

          let formdata = new FormData();
          for (var [key, value] of Object.entries(this.category)) {
            if(value != null) formdata.append(key, value);
          }

          formdata.set('_method' , 'PATCH')

          this.category.photo = ''

          axios
            .post(this.url, formdata)
            .then((res) => showAlert(res))
            .catch((error) => {              
              this.errors = error.response.data.error                
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
            vm.category.photo = res.data.photo;
          }
        }
      }
    },

    getPhoto(e) {
      this.category.photo = e.target;
    },
  },
};
</script>