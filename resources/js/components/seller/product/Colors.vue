<template>
  <div>
    <h5 class="text-warning text-center mt-2 mb-2">Bütün xanaların doldurulması şərtdir!!</h5>
    <div v-if="error" class="alert alert-border-danger" role="alert">
      <div class="d-flex align-items-center">
        <div class="icon">
          <i class="icon mdi mdi-alert-octagram"></i>
        </div>
        <div class="content">
          <strong>Xəta!</strong>
          <div v-if="typeof validationErrors != 'string'">
              <div v-for="error in validationErrors" :key="error">{{ error }}</div>
          </div>
          <div v-else>{{ errors }}</div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="stock">Məhsulun ümumi stokda mövcudluluğu</label>
      <input type="number" v-model.number="stok" class="form-control" id="stock" aria-describedby="stockHelp">
      <small id="stockHelp" class="form-text text-warning">Ümümi məhsulun stokda neçə dənə olduğu qeyd edilməlidi...
      </small>
    </div>
    <div class="card m-b-30">
      <div class="card-header">
        <h5 class="m-b-0">
          Məhsul şəkilləri
        </h5>
        <p class="m-b-0 text-muted">
          Maksimum 5 şəkil yükləyə bilərsiniz...
        </p>
      </div>
      <div class="card-body">
        <vue-dropzone ref="myVueDropzone" id="dropzone" :duplicateCheck="true" :options="dropzoneOptions"
                      :useCustomSlot="true">
          <div class="dropzone-custom-content">
            <h3 class="dropzone-custom-title">Şəkilləri yükləmək üçün sürüşdürün və buraxın!</h3>
            <div class="subtitle">...və ya cihazınızdan şəkil seçmək üçün klikləyin.</div>
          </div>
        </vue-dropzone>
      </div>
    </div>

    <div class="card m-b-30">
      <div class="card-header">
        <h5 class="m-b-0">
          Məhsulun rəngləri və şəkilləri
        </h5>
        <p class="m-b-0 text-muted">
          Əgər məhsulun fərqli rəngləri mövcuddursa aşağıda (<span
            class="text-info">Məhsulun fərqli rəngləri mövcuddur</span>) kliklə məhsulun rəngini,ədədini yazıb və
          rənginə aid şəklini seçib yükləyə bilərsiniz...
        </p>
      </div>
      <div class="card-body">
        <div class="m-t-10 m-b-10">
          <label class="cstm-switch">
            <input type="checkbox" v-model="hasColor" class="cstm-switch-input">
            <span class="cstm-switch-indicator"></span>
            <span class="cstm-switch-description">Məhsulun fərqli rəngləri mövcuddur... </span>
          </label>
        </div>
        <div v-if="hasColor" class="table-responsive-sm">

          <table class="table">
            <thead>
            <tr>
              <th>Rəng</th>
              <th>Şəkİl</th>
              <th>Ədəd</th>
            </tr>
            </thead>
            <tbody class="colorTBody">
            <tr class="mt-1">
              <td>
                <select v-model="color_id" class=" mt-1" aria-placeholder="Rəng seçin...">
                  <option value="0" selected disabled>Rəng seçin...</option>
                  <option v-for="color in colors" :value="color.id">{{ color.label }}</option>
                </select>
              </td>
              <td>
                <input type="file" @change="onChangeColorPhoto($event)" class="mt-1">
              </td>
              <td>
                <input type="number" class="form-control mt-1" v-model.number.trim="quantity">
              </td>
            </tr>

            </tbody>
            <button class="ml-3 btn btn-dark btn-small color-white" @click.prevent="addStock">Əlavə et</button>
          </table>

        </div>
      </div>
    </div>

    <div class="card m-b-30">
      <div class="card-header">
        <h5 class="m-b-0">
          Məhsulun xüsusiyyəti və onun ana səhifə şəkli
        </h5>
        <p class="m-b-0 text-muted">
          Məhsulun xüsusiyyətini aşağıdakı nümunəyə əsasən doldurulmalıdır. Əgər xüsusiyyət 1 - dən çoxdursa əlavə et
          butonuna basaraq məhsulun xüsusiyyətini artıra bilərsiniz...
        </p>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">

          <table class="table">
            <thead>
            <tr>
              <th>Xüsusİyyət</th>
              <th>Dəyər</th>
            </tr>
            </thead>
            <tbody>
            <tr class="mt-1" v-for="(spec , index) in specs" :key="index">
              <td>
                <div class="form-group">
                  <input type="text" class="form-control" v-model.trim="spec.name" placeholder="Xüsusiyyət">
                </div>
              </td>
              <td>
                <div class="form-group">
                  <input type="text" class="form-control" v-model.trim="spec.value" placeholder="Dəyər">
                </div>
              </td>
            </tr>
            </tbody>
            <button class="ml-3 btn btn-dark btn-small color-white" @click.prevent="addSpec">Əlavə et</button>
          </table>

        </div>
      </div>
    </div>
    <div class="input-group m-b-30">

      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroupFileAddon01">Max 5Mb</span>
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" aria-describedby="photoHelp"
               @change="photo = $event.target.files[0]" id="inputGroupFile01">
        <label class="custom-file-label" for="inputGroupFile01">Məhsulun əsas şəklini seçin</label>
      </div>
    </div>
    <ul class="nav nav-pills justify-content-between wizard m-b-30">
      <li class="nav-item next">
        <a class="nav-link btn display-4 btn-success" @click.prevent="updateProduct">Məhsulu Yenilə</a>
      </li>
    </ul>

  </div>
</template>

<script>

import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
  name: "Colors.vue",
  props: ["id", "colors"],
  components: {
    vueDropzone: vue2Dropzone
  },
  data() {
    return {
      dropzoneOptions: {
        url: `${Laravel.base_url}/seller/product/${this.id}/photos`,
        thumbnailWidth: 150,
        maxFilesize: 5,
        headers: {"X-CSRF-Token": Laravel.csrfToken},
        addRemoveLinks: true,
        autoProcessQueue: false,
        dictRemoveFile: "Şəklİ sİl",
      },
      error: false,
      stok: 0,
      color_id: 0,
      photoColor: '',
      quantity: 1,
      photo: '',
      errors: [],
      hasColor: false,
      specs: [
        {
          name: 'Çəki',
          value: '1kq'
        }
      ],
    };
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
    onChangeColorPhoto: function (e) {
      this.photoColor = e.target.files[0]
    },
    addStock: function () {
      Swal.fire({
        title: "Stok yenilənir...",
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
      let data = new FormData()

      data.set('color_id', this.color_id)
      data.set('photo', this.photoColor)
      data.set('quantity', this.quantity)
      data.set('_method', 'PATCH')

      axios.post(Laravel.base_url + `/seller/product/${this.id}/update/stock`, data)
          .then(res => {
            Swal.fire({
              icon: 'success',
              title: res.data.mes,
            });
          })
    },
    addSpec: function () {

      this.specs.push({
        name: '',
        value: ''
      })

    },

    updateProduct: function () {
      let vm = this
      this.$refs.myVueDropzone.processQueue()
      this.specs = this.specs.filter(value => {
        if (value.name.length < 3 || value.value.length === 0) {
          return false
        }
        return value
      })

      let data = new FormData()

      let jsonData = JSON.stringify(this.specs)

      data.set('specs', jsonData)
      data.set('stock', this.stok)
      data.set('photo', this.photo)
      data.set('_method', 'PATCH')
      this.$refs.myVueDropzone.removeAllFiles()
      axios.post(Laravel.base_url + `/seller/product/${this.id}/`, data)
          .then(res => {

            Swal.fire({
              icon: 'success',
              title: res.data.mes,
            });
            vm.$parent.step++
          })
          .catch(error => { this.errors = error.response.data.error; this.error = true })

    },

  },
};
</script>

<style scoped>
</style>