<template>
    <div>
        <div class="card m-b-30" v-if="banners.length > 0">
            <div class="card-header">
                <h5 class="m-b-0">
                Yüklədiyiniz bannerlər
                </h5>
                <p class="m-b-0 text-muted">
                Bannerləri seçib silə bilərsiniz !!
                </p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row gutters-sm">
                        <div
                        v-for="(img, index) in banners"
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
                                width="470"
                                height="193"
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
                Bannerlər
                </h5>
                <p class="m-b-0 text-muted">
                Bannerlərin ölçüsü 1410x660 olmalıdır yükləyə bilərsiniz...
                </p>
            </div>
            <div class="card-body">
                <vue-dropzone
                    ref="myVueDropzone"
                    id="dropzone"
                    :duplicateCheck="true"
                    :options="dropzoneOptions"
                    :useCustomSlot="true"
                    @vdropzone-success="bannerAdded"
                    >
                    <div class="dropzone-custom-content">
                        <h3 class="dropzone-custom-title">
                        Bannerləri yükləmək üçün sürüşdürün və buraxın!
                        </h3>
                        <div class="subtitle">
                        ...və ya cihazınızdan banner seçmək üçün
                        klikləyin..
                        </div>
                    </div>
                </vue-dropzone>
            </div>
        </div>
    <ul class="nav nav-pills justify-content-between wizard m-b-30">
        <li class="nav-item next">
            <a
                class="nav-link btn display-4 btn-success"
                @click.prevent="addBanner"
            >Əlavə Et</a
            >
        </li>
    </ul>
</div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

    export default {
        props: ['add_banner','all_banners_url','deletephotos'],
        name: 'banner',
        components: {
            vueDropzone: vue2Dropzone,
        },
        data() {
            return {
                banners: {},
                checkedNames: [],
                dropzoneOptions: {
                    url: this.add_banner,
                    thumbnailWidth: 150,
                    maxFilesize: 5,
                    headers: {"X-CSRF-Token": Laravel.csrfToken},
                    addRemoveLinks: true,
                    autoProcessQueue: false,
                    dictRemoveFile: "Şəklİ sİl"
                },
                base_url: Laravel.base_url
            }            
        }, 
        
        mounted() {
            axios.get(this.all_banners_url).then(res => this.banners = Object.values(res.data.banners))        
        },
        
        methods: {
            addBanner() {
                this.$refs.myVueDropzone.processQueue();                
            },

            bannerAdded(file,response) {
                let vm = this
                axios.get(vm.all_banners_url).then(res => (vm.banners = res.data.banners));
            },

            deletePhotos: function (event) {
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
                axios.get(vm.all_banners_url).then(res => (vm.banners = res.data.banners));
                event.target.classList.remove("disabled");
                vm.checkedNames = [];
                })
                .catch(error => {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: error.response.data.error,
                    showConfirmButton: false,
                    timer: 1500,
                });
                event.target.classList.remove("disabled");
                });
            },
        }
    }
</script>