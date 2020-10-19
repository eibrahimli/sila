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
      <h3 class="">Ümumi sayt ayarları</h3>
      <p class="text-muted">
        Bu formdan istifadə edərək saytın ümumi ayarlarını sürətli şəkildə
        dəyişə bilərsiniz...
      </p>
      <div class="col-12 fl justify-content-center">
        <label class="avatar-input">
          <span class="avatar avatar-xl">
            <img
              v-if="setting.logo"
              :src="base_url + `/storage/` + setting.logo"
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
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail6">Başlıq</label>
          <input
            type="text"
            v-model.trim="$v.setting.title.$model"
            class="form-control"
            :class="{
              'is-valid':
                $v.setting.title.required || $v.setting.title.minLength,
              'is-invalid':
                !$v.setting.title.required || !$v.setting.title.minLength,
            }"
            id="inputEmail6"
            placeholder="Başlıq"
          />
          <div v-if="!$v.setting.title.required" class="invalid-feedback">
            Başlıq boş ola bilməz...
          </div>
          <div v-if="!$v.setting.title.minLength" class="invalid-feedback">
            Başlıq ən azı {{ $v.setting.title.$params.minLength.min }} simvol
            olmalıdır...
          </div>
        </div>

        <div class="form-group col-md-6">
          <label for="inputEmail4">Email</label>
          <input
            type="email"
            class="form-control"
            :class="{
              'is-valid': $v.setting.email.required || $v.setting.email.email,
              'is-invalid':
                !$v.setting.email.required || !$v.setting.email.email,
            }"
            id="inputEmail4"
            placeholder="Email"
            v-model="$v.setting.email.$model"
          />
          <div v-if="!$v.setting.email.required" class="invalid-feedback">
            Email boş ola bilməz...
          </div>
          <div v-if="!$v.setting.email.email" class="invalid-feedback">
            Email doğru deil...
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
              'is-valid': $v.setting.number.required,
              'is-invalid': !$v.setting.number.required,
            }"
            id="number"
            v-model="$v.setting.number.$model"
            data-mask="(00000)-000-00-00"
            data-mask-clearifnotmatch="true"
            placeholder="(00000)-000-00-00"
          />
          <div v-if="!$v.setting.number.required" class="invalid-feedback">
            Nömrə boş ola bilməz...
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="form-label" for="keyw">Açar sözlər (Seo)</label>
          <input
            type="text"
            name="keyw"
            class="form-control"
            :class="{
              'is-valid': $v.setting.keyw.required || $v.setting.keyw.minLength,
              'is-invalid':
                !$v.setting.keyw.required || !$v.setting.keyw.minLength,
            }"
            id="keyw"
            v-model="$v.setting.keyw.$model"
            placeholder="Açar sözlər"
          />
          <div v-if="!$v.setting.keyw.required" class="invalid-feedback">
            Açar sözlər boş ola bilməz...
          </div>
          <div v-if="!$v.setting.keyw.minLength" class="invalid-feedback">
            Açar sözlər ən azı
            {{ $v.setting.keyw.$params.minLength.min }} simvol olmalıdır...
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label class="form-label" for="desc">Açıqlama</label>
          <textarea
            name="desc"
            class="form-control"
            :class="{
              'is-valid': $v.setting.desc.required || $v.setting.desc.minLength,
              'is-invalid':
                !$v.setting.desc.required || !$v.setting.desc.minLength,
            }"
            id="desc"
            v-model="$v.setting.desc.$model"
            placeholder="Sayt açıqlaması"
          ></textarea>
          <div v-if="!$v.setting.desc.required" class="invalid-feedback">
            Sayt açıqlaması boş ola bilməz...
          </div>
          <div v-if="!$v.setting.desc.minLength" class="invalid-feedback">
            Sayt açıqlaması ən azı
            {{ $v.setting.desc.$params.minLength.min }} simvol olmalıdır...
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputFacebook" class="form-label">Facebook</label>
          <input
            type="text"
            name="facebook"
            :class="{
              'is-valid':
                $v.social.facebook.required || $v.social.facebook.minLength,
              'is-invalid':
                !$v.social.facebook.required || !$v.social.facebook.minLength,
            }"
            id="inputFacebook"
            v-model="$v.social.facebook.$model"
            class="form-control"
            placeholder="Saytın facebook adresi"
          />
          <div v-if="!$v.social.facebook.required" class="invalid-feedback">
            Sayt facebook adresi boş ola bilməz...
          </div>
          <div v-if="!$v.social.facebook.minLength" class="invalid-feedback">
            Sayt facebook adresi ən azı
            {{ $v.social.facebook.$params.minLength.min }} simvol olmalıdır...
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="inputInstagram" class="form-label">Instagram</label>
          <input
            type="text"
            name="instagram"
            :class="{
              'is-valid':
                $v.social.instagram.required || $v.social.instagram.minLength,
              'is-invalid':
                !$v.social.instagram.required || !$v.social.instagram.minLength,
            }"
            id="inputInstagram"
            v-model="$v.social.instagram.$model"
            class="form-control"
            placeholder="Saytın instagram adresi"
          />
          <div v-if="!$v.social.instagram.required" class="invalid-feedback">
            Sayt instagram adresi boş ola bilməz...
          </div>
          <div v-if="!$v.social.instagram.minLength" class="invalid-feedback">
            Sayt instagram adresi ən azı
            {{ $v.social.instagram.$params.minLength.min }} simvol olmalıdır...
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputTwitter" class="form-label">Twitter</label>
          <input
            type="text"
            name="twitter"
            id="inputTwitter"
            v-model="$v.social.twitter.$model"
            class="form-control"
            :class="{
              'is-valid':
                $v.social.twitter.required || $v.social.twitter.minLength,
              'is-invalid':
                !$v.social.twitter.required || !$v.social.twitter.minLength,
            }"
            placeholder="Saytın twitter adresi"
          />
          <div v-if="!$v.social.twitter.required" class="invalid-feedback">
            Sayt twitter adresi boş ola bilməz...
          </div>
          <div v-if="!$v.social.twitter.minLength" class="invalid-feedback">
            Sayt twitter adresi ən azı
            {{ $v.social.twitter.$params.minLength.min }} simvol olmalıdır...
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="inputGoogle" class="form-label">Google Plus</label>
          <input
            type="text"
            name="google"
            id="inputGoogle"
            v-model="$v.social.google.$model"
            class="form-control"
            :class="{
              'is-valid':
                $v.social.google.required || $v.social.google.minLength,
              'is-invalid':
                !$v.social.google.required || !$v.social.google.minLength,
            }"
            placeholder="Saytın google plus adresi"
          />
          <div v-if="!$v.social.google.required" class="invalid-feedback">
            Sayt google+ adresi boş ola bilməz...
          </div>
          <div v-if="!$v.social.google.minLength" class="invalid-feedback">
            Sayt google+ adresi ən azı
            {{ $v.social.google.$params.minLength.min }} simvol olmalıdır...
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="inputAddress" class="form-label">Adress</label>
        <input
          type="text"
          name="adress"
          v-model="$v.setting.adress.$model"
          class="form-control"
          :class="{
            'is-valid':
              $v.setting.adress.required || $v.setting.adress.minLength,
            'is-invalid':
              !$v.setting.adress.required || !$v.setting.adress.minLength,
          }"
          id="inputAddress"
          placeholder="Saytın ofisinin adresi"
        />
        <div v-if="!$v.setting.adress.required" class="invalid-feedback">
          Sayt adresi boş ola bilməz...
        </div>
        <div v-if="!$v.setting.adress.minLength" class="invalid-feedback">
          Sayt adresi ən azı
          {{ $v.setting.adress.$params.minLength.min }} simvol olmalıdır...
        </div>
      </div>
      <button type="submit" class="btn btn-success btn-cta">Yadda Saxla</button>
    </form>
  </div>
</template>

<script>
import { required, minLength, email } from "vuelidate/lib/validators";

export default {
  data() {
    return {
      loading: true,
      base_url: "",
      social: {},
      setting: {},
    };
  },
  validations: {
    setting: {
      title: {
        required,
        minLength: minLength(4),
      },
      email: {
        required,
        email,
      },
      number: {
        required,
      },
      keyw: {
        required,
        minLength: minLength(2),
      },
      desc: {
        required,
        minLength: minLength(4),
      },
      adress: {
        required,
        minLength: minLength(5),
      },
    },
    social: {
      facebook: {
        required,
        minLength: minLength(17),
      },
      twitter: {
        required,
        minLength: minLength(17),
      },
      instagram: {
        required,
        minLength: minLength(17),
      },
      google: {
        required,
        minLength: minLength(17),
      },
    },
  },
  mounted() {
    this.getSettings();
    this.base_url = Laravel.base_url;
  },

  methods: {
    getSettings: function () {
      axios.get(this.base_url + "/admin/settings").then((res) => {
        this.setting = res.data;
        this.setSocial();
      });
      window.onload = () => {
        setTimeout(() => {
          this.loading = false
        },1000)
      }
    },

    setSocial() {
      if (this.setting != null) {
        let socialData = this.setting.social.split("|||");

        this.social = {
          facebook: socialData[0],
          instagram: socialData[1],
          twitter: socialData[2],
          google: socialData[3],
        };
      }
    },

    submit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.submitStatus = "ERROR";
      } else {
        const vm = this;
        Swal.fire({
          title: "Ayarlar yenilənir.",
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
          if (this.setting.logo.type != "file") {
            delete this.setting.logo;
          } else {
            this.setting.logo = this.setting.logo.files[0];
          }

          let formdata = new FormData();
          this.setting.social = Object.values(this.social)
            .map((value, key) => value)
            .join("|||");

          for (var [key, value] of Object.entries(this.setting)) {
            formdata.set(key, value);
          }

          axios
            .post(this.base_url + "/admin/settings", formdata)
            .then((res) => showAlert(res))
            .catch((error) => showAlert(error));
        }, 1000);
        function showAlert(res) {
          if (res.status == 200) {
            Swal.fire({
              position: "top-end",
              icon: "success",
              title: res.data.mes,
              showConfirmButton: false,
              timer: 1500,
            });
            vm.setting = res.data.setting;
            vm.setSocial();
          } else {
            Swal.fire({
              position: "top-end",
              icon: "success",
              title: res.data.mes,
              showConfirmButton: false,
              timer: 1500,
            });
          }
        }
      }
    },

    getLogo(e) {
      this.setting.logo = event.target;
    },
  },
};
</script>