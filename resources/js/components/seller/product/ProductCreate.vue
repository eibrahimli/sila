<template>
  <div>
    <div class="row justify-content-center">
      <div class="spinner-grow text-dark" v-show="loading" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <div class="p-all-25" v-show="!loading">
      <form id="commentForm" class="form-horizontal">
        <div id="rootwizard">
          <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
              <a class="nav-link" :class="{ 'disabled' : step != 1,'active show' : step == 1 }" href="#tab1"
                 data-toggle="tab"
              >Ümumi</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" :class="{'disabled' : step == 1 || step == 3, 'active show' : step==2}"
                 aria-disabled="true" href="#tab2" data-toggle="tab"
              >Stok</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" :class="{'disabled' : step != 3,'active show' : step==3}" href="#tab3"
                 data-toggle="tab">Son</a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane p-t-20 p-b-20" :class="{'active show' : step == 1}" v-if="step == 1" id="tab1">

              <div class="row">
                <div class="form-group col-12">
                  <label for="exampleInputTitle1">Başlıq</label>
                  <input
                      type="text"
                      :class="{
                        'is-valid' : !$v.product.title.$invalid && $v.product.title.$dirty,
                        'is-invalid' : $v.product.title.$invalid && $v.product.title.$dirty
                      }"
                      v-model="$v.product.title.$model"
                      class="form-control"
                      id="exampleInputTitle1"
                      aria-describedby="titleHelp"
                      placeholder="Başlıq..."
                  />
                  <div v-if="!$v.product.title.required && $v.product.title.$dirty" class="invalid-feedback">
                    Açar sözlər boş ola bilməz...
                  </div>
                  <div v-if="!$v.product.title.minLength && $v.product.title.$dirty" class="invalid-feedback">
                    Açar sözlər ən azı {{ $v.product.title.$params.minLength.min }} simvol
                    olmalıdır...
                  </div>
                </div>
                <div class="form-group col-12 col-sm-12">
                  <label for="desc">Açıqlama</label>
                  <ckeditor v-model="$v.product.desc.$model" id="desc" :config="editorConfig"></ckeditor>

                  <div v-if="!$v.product.desc.required && $v.product.desc.$dirty" style="display: block" class="invalid-feedback">
                    Açar sözlər boş ola bilməz...
                  </div>
                  <div v-if="!$v.product.desc.minLength && $v.product.desc.$dirty" style="display: block" class="invalid-feedback">
                    Açar sözlər ən azı {{ $v.product.desc.$params.minLength.min }} simvol
                    olmalıdır...
                  </div>
                </div>

                <div class="form-group col-md-12 col-sm-12">
                  <label for="category_id">Kateqoriya</label>
                  <treeselect
                      :options="options"
                      placeholder="Kateqoriya seçin..."
                      v-model="$v.product.category_id.$model"
                      id="category_id"
                      search-nested
                  />
                  <div v-if="!$v.product.category_id.required && $v.product.category_id.$dirty"
                       class="invalid-feedback" style="display: block">
                    Məhsul kateqoriyası seçilməlidi...
                  </div>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                  <label for="keyw">Açar Sözlər</label>
                  <input :class="{
                  'is-valid' : !$v.product.keyw.$invalid && $v.product.keyw.$dirty,
                  'is-invalid' : $v.product.keyw.$invalid && $v.product.keyw.$dirty}" type="text" id="keyw"
                         v-model="$v.product.keyw.$model" class="form-control" placeholder="Açar sözlər...">
                  <div v-if="!$v.product.keyw.required && $v.product.keyw.$dirty" class="invalid-feedback">
                    Açar sözlər boş ola bilməz...
                  </div>
                  <div v-if="!$v.product.keyw.minLength && $v.product.keyw.$dirty" class="invalid-feedback">
                    Açar sözlər ən azı {{ $v.product.keyw.$params.minLength.min }} simvol
                    olmalıdır...
                  </div>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                  <label for="lang">Dil</label>
                  <treeselect :options="langs" v-model="$v.product.lang.$model" placeholder="Dil seçin"
                              id="lang"></treeselect>
                  <div v-if="!$v.product.lang.required && $v.product.lang.$dirty" style="display: block"
                       class="invalid-feedback">
                    Məhsul dili seçilməlidi...
                  </div>
                </div>

                <div class="form-group col-md-6 col-sm-12">
                  <label for="brand_id">Brend</label>
                  <treeselect :options="brands" v-model="$v.product.brand_id.$model" class="is-invalid"
                              placeholder="Brend seçin" id="brand_id"></treeselect>
                  <div v-if="!$v.product.brand_id.required && $v.product.brand_id.$dirty" style="display: block"
                       class="invalid-feedback">
                    Məhsul brendi seçilməlidi...
                  </div>
                </div>

                <div class="form-group col-md-6 col-sm-12">
                  <label for="brand_id">Vahid</label>
                  <treeselect :options="units" v-model="$v.product.unit_id.$model" class="is-invalid"
                              placeholder="Vahid seçin" id="brand_id"></treeselect>
                  <div v-if="!$v.product.unit_id.required && $v.product.unit_id.$dirty" style="display: block"
                       class="invalid-feedback">
                    Məhsul vahidi seçilməlidi...
                  </div>
                </div>

                <div class="input-group col-md-12 col-sm-12">
                  <div class="input-group-prepend">
                    <span class="input-group-text">₼</span>
                  </div>
                  <input
                      :class="{
                      'is-valid' : !$v.product.price.$invalid && $v.product.price.$dirty,
                      'is-invalid' : $v.product.price.$invalid && $v.product.price.$dirty}"
                      type="text" class="form-control" aria-label="Qiymət" v-model="$v.product.price.$model">
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
                  <div v-if="!$v.product.price.required && $v.product.price.$dirty" style="display: block"
                       class="invalid-feedback">
                    Məhsul qiyməti doldurulmalıdır...
                  </div>
                  <div v-if="!$v.product.price.decimal && $v.product.price.$dirty" style="display: block"
                       class="invalid-feedback">
                    Məhsul qiyməti rəqəm olmalıdır...
                  </div>
                </div>

              </div>
            </div>
            <div class="tab-pane p-t-20 p-b-20" :class="{'active show' : step == 2}" v-if="step == 2" id="tab2">
             <colors :colors="colors" :id="id"></colors>
            </div>
            <div class="tab-pane p-t-20 p-b-20" :class="{'active show' : step == 3}" v-if="step == 3" id="tab3">
              <div class="row">
                <div class="alert alert-success" role="alert">
                  <h4 class="alert-heading">Təbriklər!</h4>
                  <p>Məhsulunuz bazamıza əlavə edilmişdir təsdiq edildikdən sonra sizə mail vasitəsi ilə və yuxarıdakı bildirimlər bölümündə bildiriləcək.</p>
                  <hr>
                  <p class="mb-0">Əgər məhsulunuzun təsdiq edilməsi gecikərsə bizimlə əlaqə saxlayın...</p>
                </div>
              </div>
            </div>
            <ul v-if="step == 1" class="nav nav-pills justify-content-between wizard m-b-30">
              <li class="nav-item next">
                <a class="nav-link btn-success" style="cursor: pointer" @click.prevent="submit()">Növbəti</a>
              </li>
            </ul>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import {required, minLength, integer, decimal} from "vuelidate/lib/validators";
import Colors from './Colors';

export default {
  components: {Colors},
  props: ["url", "categoryurl", "brandsurl",'unitsurl',"colorsurl"],

  data() {
    return {
      loading: true,
      id: 0,
      base_url: "",
      options: [],
      brands: [],
      colors: [],
      units: [],
      editorConfig: {
        language: 'az'
      },
      stocks: [],
      specs: [],
      photo: '',
      step: 1,
      langs: [
        {
          id: 'az',
          label: 'Az'
        },
        {
          id: 'en',
          label: 'En'
        },
        {
          id: 'ru',
          label: 'Ru'
        },
        {
          id: 'tr',
          label: 'Tr'
        },
      ],
      product: {
        category_id: null,
        brand_id: null,
        unit_id: null,
        title: '',
        desc: '',
        price: '',
        keyw: '',
        lang: null
      },
      errors: [],

    };
  },
  validations: {
    product: {
      brand_id: {
        required, integer
      },
      unit_id: {
        required, integer
      },
      category_id: {
        required, integer
      },
      title: {
        required, minLength: minLength(5),
      },
      desc: {
        required, minLength: minLength(5)
      },
      keyw: {
        required, minLength: minLength(3)
      },
      lang: {
        required,
      },
      price: {
        required, decimal
      },
    },

  },
  mounted() {
    setTimeout(() => {
      this.loading = false;
    }, 1000);

    // Get Categories and brands
    axios.get(this.categoryurl).then(res => this.options = Object.values(res.data))
    axios.get(this.brandsurl).then(res => this.brands = Object.values(res.data))
    axios.get(this.unitsurl).then(res => this.units = Object.values(res.data))
    axios.get(this.colorsurl).then(res => this.colors = Object.values(res.data))
  },

  computed: {
    validationErrors() {
      if (typeof this.errors != "string") {
        return (this.errors = Object.values(this.errors).flat());
      }

      return this.errors;
    },

  },

  methods: {

    submit() {
      if(this.step === 1) {
        this.$v.$touch();
        if (this.$v.$invalid) {
          console.log("error");
        } else {
          let vm = this;
          Swal.fire({
            title: "Məhsul əlavə edilir.",
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
            for (let [key, value] of Object.entries(this.product)) {
              if (value != null) formdata.append(key, value);
            }

            axios
                .post(this.url, formdata)
                .then((res) => showAlert(res))
                .catch((error) => {
                  this.errors = error.response.data.error;
                  Swal.close();
                });
          }, 1000);

          function showAlert(res) {
            if (res.status === 200) {
              Swal.fire({
                position: "center",
                icon: "success",
                title: res.data.mes,
                showConfirmButton: false,
                timer: 1500,
              });
              vm.id = res.data.id
              vm.step = 2
            }
          }
        }
      }

    },
  },
};
</script>
