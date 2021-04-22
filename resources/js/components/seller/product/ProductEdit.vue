<template>
    <div>
        <div class="row justify-content-center" v-show="loading">
            <div class="spinner-grow text-dark" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-show="!loading">
            <div class="row m-b-30">
                <div class="form-group col-12">
                    <label for="exampleInputTitle1">Başlıq</label>
                    <input
                        type="text"
                        :class="{
                            'is-valid':
                                !$v.product.title.$invalid &&
                                $v.product.title.$dirty,
                            'is-invalid':
                                $v.product.title.$invalid &&
                                $v.product.title.$dirty
                        }"
                        v-model="$v.product.title.$model"
                        class="form-control"
                        id="exampleInputTitle1"
                        aria-describedby="titleHelp"
                        placeholder="Başlıq..."
                    />
                    <div
                        v-if="
                            !$v.product.title.required &&
                                $v.product.title.$dirty
                        "
                        class="invalid-feedback"
                    >
                        Başlıq boş ola bilməz...
                    </div>
                    <div
                        v-if="
                            !$v.product.title.minLength &&
                                $v.product.title.$dirty
                        "
                        class="invalid-feedback"
                    >
                        Başlıq ən azı
                        {{ $v.product.title.$params.minLength.min }} simvol
                        olmalıdır...
                    </div>
                </div>
                <div class="form-group col-12 col-sm-12">
                    <label for="desc">Açıqlama</label>
                    <ckeditor
                        v-model="$v.product.desc.$model"
                        id="desc"
                        :config="editorConfig"
                    ></ckeditor>

                    <div
                        v-if="
                            !$v.product.desc.required && $v.product.desc.$dirty
                        "
                        style="display: block"
                        class="invalid-feedback"
                    >
                        Açıqlama boş ola bilməz...
                    </div>
                    <div
                        v-if="
                            !$v.product.desc.minLength && $v.product.desc.$dirty
                        "
                        style="display: block"
                        class="invalid-feedback"
                    >
                        Açıqlama ən azı
                        {{ $v.product.desc.$params.minLength.min }} simvol
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
                    <div
                        v-if="
                            !$v.product.category_id.required &&
                                $v.product.category_id.$dirty
                        "
                        class="invalid-feedback"
                        style="display: block"
                    >
                        Məhsul kateqoriyası seçilməlidi...
                    </div>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <label for="keyw">Açar Sözlər</label>
                    <input
                        :class="{
                            'is-valid':
                                !$v.product.keyw.$invalid &&
                                $v.product.keyw.$dirty,
                            'is-invalid':
                                $v.product.keyw.$invalid &&
                                $v.product.keyw.$dirty
                        }"
                        type="text"
                        id="keyw"
                        v-model="$v.product.keyw.$model"
                        class="form-control"
                        placeholder="Açar sözlər..."
                    />
                    <div
                        v-if="
                            !$v.product.keyw.required && $v.product.keyw.$dirty
                        "
                        class="invalid-feedback"
                    >
                        Açar sözlər boş ola bilməz...
                    </div>
                    <div
                        v-if="
                            !$v.product.keyw.minLength && $v.product.keyw.$dirty
                        "
                        class="invalid-feedback"
                    >
                        Açar sözlər ən azı
                        {{ $v.product.keyw.$params.minLength.min }} simvol
                        olmalıdır...
                    </div>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <label for="lang">Dil</label>
                    <treeselect
                        :options="langs"
                        v-model="$v.product.lang.$model"
                        placeholder="Dil seçin"
                        id="lang"
                    ></treeselect>
                    <div
                        v-if="
                            !$v.product.lang.required && $v.product.lang.$dirty
                        "
                        style="display: block"
                        class="invalid-feedback"
                    >
                        Məhsul dili seçilməlidi...
                    </div>
                </div>

                <div class="form-group col-md-12 col-sm-12">
                    <label for="brand_id">Brend</label>
                    <treeselect
                        :options="brands"
                        v-model="$v.product.brand_id.$model"
                        class="is-invalid"
                        placeholder="Brend seçin"
                        id="brand_id"
                    ></treeselect>
                    <div
                        v-if="
                            !$v.product.brand_id.required &&
                                $v.product.brand_id.$dirty
                        "
                        style="display: block"
                        class="invalid-feedback"
                    >
                        Məhsul brendi seçilməlidi...
                    </div>
                </div>
                <div class="form-group col-12">
                    <label for="stock"
                        >Məhsulun ümumi stokda mövcudluluğu</label
                    >
                    <input
                        type="number"
                        v-model.number="product.stock"
                        class="form-control"
                        id="stock"
                        aria-describedby="stockHelp"
                    />
                    <small id="stockHelp" class="form-text text-warning"
                        >Ümümi məhsulun stokda neçə dənə olduğu qeyd
                        edilməlidi...
                    </small>
                    <div
                        v-if="
                            !$v.product.stock.required &&
                                $v.product.stock.$dirty
                        "
                        style="display: block"
                        class="invalid-feedback"
                    >
                        Məhsul stok daxil edilməlidi...
                    </div>
                    <div
                        v-if="
                            !$v.product.stock.integer && $v.product.stock.$dirty
                        "
                        style="display: block"
                        class="invalid-feedback"
                    >
                        Məhsul stok ədədi doğru şəkildə daxil edilməlidir...
                    </div>
                </div>
                <div class="input-group col-md-12 col-sm-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text">₼</span>
                    </div>
                    <input
                        :class="{
                            'is-valid':
                                !$v.product.price.$invalid &&
                                $v.product.price.$dirty,
                            'is-invalid':
                                $v.product.price.$invalid &&
                                $v.product.price.$dirty
                        }"
                        type="text"
                        class="form-control"
                        aria-label="Qiymət"
                        v-model="$v.product.price.$model"
                    />
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                    <div
                        v-if="
                            !$v.product.price.required &&
                                $v.product.price.$dirty
                        "
                        style="display: block"
                        class="invalid-feedback"
                    >
                        Məhsul qiyməti doldurulmalıdır...
                    </div>
                    <div
                        v-if="
                            !$v.product.price.decimal && $v.product.price.$dirty
                        "
                        style="display: block"
                        class="invalid-feedback"
                    >
                        Məhsul qiyməti rəqəm olmalıdır...
                    </div>
                </div>
                <div class="input-group col-12 m-t-20">
                    <div class="input-group-prepend">
                        <span
                            class="input-group-text"
                            id="inputGroupFileAddon01"
                            >Max 5Mb</span
                        >
                    </div>
                    <div class="custom-file">
                        <input
                            type="file"
                            class="custom-file-input"
                            aria-describedby="photoHelp"
                            @change="photo = $event.target.files[0]"
                            id="inputGroupFile01"
                        />
                        <label class="custom-file-label" for="inputGroupFile01"
                            >Məhsulun əsas şəklini seçin</label
                        >
                    </div>
                </div>
            </div>

            <ul class="nav nav-pills justify-content-between wizard m-b-30">
                <li class="nav-item next">
                    <a
                        class="nav-link btn display-4 btn-success"
                        @click.prevent="submit"
                        >Yenilə</a
                    >
                </li>
            </ul>

            <!-- İkinci hissə -->

            <div v-if="error2" class="alert alert-border-danger" role="alert">
                <div class="d-flex align-items-center">
                    <div class="icon">
                        <i class="icon mdi mdi-alert-octagram"></i>
                    </div>
                    <div class="content">
                        <strong>Xəta!</strong>
                        <div v-if="typeof validationErrors2 != 'string'">
                            <div v-for="err in validationErrors2" :key="err">
                                {{ err }}
                            </div>
                        </div>
                        <div v-else>{{ errors2 }}</div>
                    </div>
                </div>
            </div>

            <div class="card m-b-30" v-if="photos.length > 0">
                <div class="card-header">
                    <h5 class="m-b-0">
                        Yüklədiyiniz şəkillər
                    </h5>
                    <p class="m-b-0 text-muted">
                        Şəkilləri seçib silə bilərsiniz
                    </p>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row gutters-sm">
                            <div
                                v-for="(img, index) in photos"
                                :key="index"
                                class="col-md-4 col-sm-6"
                            >
                                <label class="image-box mb-4">
                                    <input
                                        type="checkbox"
                                        v-model="checkedNames"
                                        :value="img.id"
                                    />
                                    <span class="image-box-content">
                                        <img
                                            width="212"
                                            height="220"
                                            :src="
                                                base_url +
                                                    `/storage/${img.photo}`
                                            "
                                            alt=""
                                        />
                                    </span>
                                </label>
                            </div>
                            <button
                                @click="deletePhotos($event)"
                                :class="{ disabled: checkedNames.length == 0 }"
                                class="btn btn-danger col-md-12 col-sm-12"
                            >
                                Sil
                            </button>
                        </div>
                    </div>
                </div>
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
                    <vue-dropzone
                        ref="myVueDropzone"
                        id="dropzone"
                        :duplicateCheck="true"
                        :options="dropzoneOptions"
                        :useCustomSlot="true"
                    >
                        <div class="dropzone-custom-content">
                            <h3 class="dropzone-custom-title">
                                Şəkilləri yükləmək üçün sürüşdürün və buraxın!
                            </h3>
                            <div class="subtitle">
                                ...və ya cihazınızdan şəkil seçmək üçün
                                klikləyin.
                            </div>
                        </div>
                    </vue-dropzone>
                </div>
            </div>

            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="m-b-0">
                        Məhsulun rəngləri və ona uyğun şəkilləri
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <!-- Table 1 -->
                        <table v-if="hasColor" class="table">
                            <thead>
                                <tr>
                                    <th>Rəng</th>
                                    <th>Şəkİl</th>
                                    <th>Ədəd</th>
                                    <th>Ayarlar</th>
                                </tr>
                            </thead>
                            <tbody class="colorTBody">
                                <tr
                                    v-for="(productColor,
                                    index) in productColors"
                                    :key="index"
                                    class="mt-1"
                                >
                                    <td>
                                        <select
                                            v-model="productColor.color_id"
                                            class=" mt-1"
                                            aria-placeholder="Rəng seçin..."
                                        >
                                            <option value="0" selected disabled
                                                >Rəng seçin...</option
                                            >
                                            <option
                                                v-for="(color,num) in colors"
                                                :value="color.id"
                                                :key="num"
                                                >{{ color.label }}</option
                                            >
                                        </select>
                                    </td>
                                    <td>
                                        <img
                                            :src="productColor.path"
                                            :alt="
                                                colors.find(
                                                    color =>
                                                        color.id ==
                                                        productColor.color_id
                                                ).label
                                            "
                                            width="60"
                                            height="60"
                                        />
                                        <input
                                            type="file"
                                            @change="
                                                productColor.photo =
                                                    $event.target.files[0]
                                            "
                                            class="mt-1"
                                        />
                                    </td>
                                    <td>
                                        <input
                                            type="number"
                                            class="form-control mt-1"
                                            v-model.number.trim="
                                                productColor.quantity
                                            "
                                        />
                                    </td>
                                    <td>
                                        <button
                                            class="btn btn-small btn-primary col-12 mb-1"
                                            @click="
                                                updateColorStock(
                                                    productColor.id,
                                                    productColor.color_id,
                                                    productColor.photo,
                                                    productColor.quantity,
                                                    index
                                                )
                                            "
                                        >
                                            Yenilə
                                        </button>
                                        <button
                                            @click.prevent="
                                                deleteColorStock(
                                                    productColor.id,
                                                    index
                                                )
                                            "
                                            class="btn btn-small btn-danger col-12 mb-1"
                                        >
                                            Sil
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Table 2 -->
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
                                        <select
                                            v-model="color_id"
                                            class=" mt-1"
                                            aria-placeholder="Rəng seçin..."
                                        >
                                            <option value="0" selected disabled
                                                >Rəng seçin...</option
                                            >
                                            <option
                                                v-if="
                                                    !productColors.find(
                                                        productColor => {
                                                            return (
                                                                productColor.color_id ==
                                                                color.id
                                                            );
                                                        }
                                                    )
                                                "
                                                v-for="(color,key) in colors"
                                                :value="color.id"
                                                :key="key"
                                                >{{ color.label }}
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <input
                                            type="file"
                                            @change="onChangeColorPhoto($event)"
                                            class="mt-1"
                                        />
                                    </td>
                                    <td>
                                        <input
                                            type="number"
                                            class="form-control mt-1"
                                            v-model.number.trim="quantity"
                                        />
                                    </td>
                                </tr>
                            </tbody>
                            <button
                                class="ml-3 btn btn-dark btn-small color-white"
                                @click.prevent="addStock"
                            >
                                Əlavə et
                            </button>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="m-b-0">
                        Məhsulun xüsusiyyətləri
                    </h5>
                    <p class="m-b-0 text-muted">
                        Məhsulun xüsusiyyətini aşağıdakı nümunəyə əsasən
                        doldurulmalıdır. Əgər xüsusiyyət 1 - dən çoxdursa əlavə
                        et butonuna basaraq məhsulun xüsusiyyətini artıra
                        bilərsiniz...
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
                                <tr
                                    class="mt-1"
                                    v-for="(spec, index) in specs"
                                    :key="index"
                                >
                                    <td>
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model.trim="spec.name"
                                                placeholder="Xüsusiyyət"
                                            />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model.trim="spec.value"
                                                placeholder="Dəyər"
                                            />
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <button
                                class="ml-3 btn btn-dark btn-small color-white"
                                @click.prevent="addSpec"
                            >
                                Əlavə et
                            </button>
                        </table>
                    </div>
                </div>
            </div>
            <ul class="nav nav-pills justify-content-between wizard m-b-30">
                <li class="nav-item next">
                    <a
                        class="nav-link btn display-4 btn-success"
                        @click.prevent="updateProduct"
                        >Yenilə</a
                    >
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import {
    required,
    minLength,
    integer,
    decimal
} from "vuelidate/lib/validators";
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
    name: "ProductEdit",
    components: {
        vueDropzone: vue2Dropzone
    },
    props: [
        "url",
        "update_specs",
        "deletesingleproductcolor",
        "deleteproductcolor",
        "getproducturl",
        "categoryurl",
        "brandsurl",
        "colorsurl",
        "getspecs",
        "getphotos",
        "id",
        "deletephotos",
        "getcolorsrelatedtoproduct"
    ],
    data() {
        return {
            checkedNames: [],
            color_id: 0,
            photoColor: "",
            quantity: 1,
            loading: true,
            base_url: "",
            options: [],
            brands: [],
            colors: [],
            productColors: [],
            photos: [],
            photo: "",
            editorConfig: {
                language: "az"
            },
            stocks: [],
            error: false,
            error2: false,
            langs: [
                {
                    id: "az",
                    label: "Az"
                },
                {
                    id: "en",
                    label: "En"
                },
                {
                    id: "ru",
                    label: "Ru"
                },
                {
                    id: "tr",
                    label: "Tr"
                }
            ],
            product: {
                id: 0,
                stock: 0,
                category_id: null,
                brand_id: null,
                title: "",
                desc: "",
                price: "",
                keyw: "",
                lang: null
            },
            errors: [],
            errors2: [],
            dropzoneOptions: {
                url: `${Laravel.base_url}/seller/product/${this.id}/photos`,
                thumbnailWidth: 150,
                maxFilesize: 5,
                headers: { "X-CSRF-Token": Laravel.csrfToken },
                addRemoveLinks: true,
                autoProcessQueue: false,
                dictRemoveFile: "Şəklİ sİl"
            },
            hasColor: false,
            addColor: false,
            specs: [
                {
                    name: "Çəki",
                    value: "1kq"
                }
            ]
        };
    },
    validations: {
        product: {
            brand_id: {
                required,
                integer
            },
            stock: {
                required,
                integer
            },
            category_id: {
                required,
                integer
            },
            title: {
                required,
                minLength: minLength(5)
            },
            desc: {
                required,
                minLength: minLength(5)
            },
            keyw: {
                required,
                minLength: minLength(3)
            },
            lang: {
                required
            },
            price: {
                required,
                decimal
            }
        }
    },

    computed: {
        validationErrors() {
            if (typeof this.errors != "string") {
                return (this.errors = Object.values(this.errors).flat());
            }

            return this.errors;
        },
        validationErrors2() {
            if (typeof this.errors2 != "string") {
                return (this.errors2 = Object.values(this.errors2).flat());
            }

            return this.errors2;
        },
    },

    mounted() {
        axios
            .get(this.categoryurl)
            .then(res => (this.options = Object.values(res.data)));
        axios
            .get(this.brandsurl)
            .then(res => (this.brands = Object.values(res.data)));
        axios
            .get(this.colorsurl)
            .then(res => (this.colors = Object.values(res.data)));
        axios
            .get(this.getproducturl)
            .then(res => (this.product = res.data.product));
        axios.get(this.getspecs).then(res => (this.specs = res.data));
        axios.get(this.getphotos).then(res => (this.photos = res.data));
        axios.get(this.getcolorsrelatedtoproduct).then(res => {
            this.productColors = res.data.colors;
            if (this.productColors.length > 0) {
                this.hasColor = true;
            }
        });
        this.loading = false;
        this.base_url = Laravel.base_url;
    },

    methods: {
        addSpec: function() {
          if(this.specs == false) {
            this.specs = []
          }
            this.specs.push({
                name: "",
                value: ""
            });
        },

        addStock: function() {
            let vm = this;
            Swal.fire({
                title: "Stok yenilənir...",
                html: `
              <div class="d-flex justify-content-center">
                  <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
              </div>
            `,
                showConfirmButton: false
            });
            let data = new FormData();

            data.set("color_id", this.color_id);
            data.set("photo", this.photoColor);
            data.set("quantity", this.quantity);
            data.set("_method", "PATCH");

            axios
                .post(
                    Laravel.base_url +
                        `/seller/product/${this.id}/update/stock`,
                    data
                )
                .then(res => {
                    axios.get(this.getcolorsrelatedtoproduct).then(res => {
                        vm.productColors = res.data.colors;
                    });
                    Swal.fire({
                        icon: "success",
                        title: res.data.mes
                    });
                    vm.hasColor = true
                });
        },

        updateProduct: function() {
            let vm = this;
            this.$refs.myVueDropzone.processQueue();
            this.specs = this.specs.filter(value => {
                if (value.name.length < 3 || value.value.length === 0) {
                    return false;
                }
                return value;
            });

            let data = new FormData();

            let jsonData = JSON.stringify(this.specs);
            Swal.fire({
                title: "Məhsul redaktə edilir.",
                html: `
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                </div>
              `,
                showConfirmButton: false
            });

            data.set("specs", jsonData);
            data.set("_method", "PATCH");
            axios
                .post(this.update_specs, data)
                .then(res => {
                    Swal.fire({
                        icon: "success",
                        title: res.data.mes
                    });
                    vm.$parent.step++;
                })
                .catch(error => {
                    this.errors = error.response.data.error;
                    this.error = true;
                });
        },

        submit: function() {
            this.$v.$touch();
            if (this.$v.$invalid) {
                console.log("error");
            } else {
                let vm = this;
                Swal.fire({
                    title: "Məhsul redaktə edilir.",
                    html: `
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                </div>
              `,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    let formdata = new FormData();
                    formdata.set("_method", "PATCH");
                    for (let [key, value] of Object.entries(vm.product)) {
                        if (value != null) formdata.append(key, value);
                    }

                    if (typeof vm.photo != "string" || vm.photo != "") {
                        vm.product.photo = vm.photo;
                        formdata.set("photo", vm.photo);
                    } else {
                        formdata.delete("photo");
                    }

                    axios
                        .post(this.url, formdata)
                        .then(res => showAlert(res))
                        .catch(error => {
                            vm.errors = error.response.data.error;
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
                            timer: 1500
                        });

                        vm.product = res.data.product;
                        vm.photo = "";
                    }
                }
            }
        },

        onChangeColorPhoto: function(e) {
            this.photoColor = e.target.files[0];
        },

        deletePhotos: function(event) {
            let vm = this;
            event.target.classList.add("disabled");

            axios
                .post(this.deletephotos, {
                    checkedNames: vm.checkedNames
                })
                .then(res => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: res.data.mes,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    axios.get(vm.getphotos).then(res => (vm.photos = res.data));
                    event.target.classList.remove("disabled");
                    vm.checkedNames = [];
                })
                .catch(error => {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: error.response.data.error,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    event.target.classList.remove("disabled");
                });
        },

        updateColorStock: function(id, color, photo, quantity, index) {
            let vm = this;
            let colors_index = index;
            let formData = new FormData();
            if (typeof photo != "string") {
                formData.set("photo", photo);
            }

            formData.set("color_id", color);
            formData.set("id", id);
            formData.set("quantity", quantity);
            formData.set("_method", "PATCH");

            axios
                .post(this.deleteproductcolor, formData)
                .then(res => {
                    axios.get(this.getcolorsrelatedtoproduct).then(res => {
                        vm.productColors = res.data.colors;
                        vm.productColors[colors_index].photo =
                            res.data.colors[colors_index].photo;
                        if (vm.productColors.length > 0) {
                            vm.hasColor = true;
                        }
                    });
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: res.data.mes,
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
                .catch(error => {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: error.response.data.error,
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
        },

        deleteColorStock: function(id, index) {
            let vm = this;
            let array_index = index;
            axios
                .post(this.deletesingleproductcolor, { stock: id })
                .then(res => {
                    axios.get(vm.getcolorsrelatedtoproduct).then(res => {
                        vm.productColors = res.data.colors;
                        if (vm.productColors.length > 0) {
                            vm.hasColor = true;
                        }
                    });
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: res.data.mes,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    if(vm.productColors.length == 1) {
                      vm.hasColor = false
                    }
                })
                .catch(error => {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: error.response.data.error,
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
        }
    }
};
</script>

<style scoped></style>
