<template>
	
	<form method="POST" enctype="multipart/form-data" @submit.prevent="submit()">
	      <h3 class="">Ümumi sayt ayarları</h3>
	      <p class="text-muted">
	          Bu formdan istifadə edərək saytın ümumi ayarlarını sürətli şəkildə dəyişə bilərsiniz... 
	      </p>
	      <div class="col-12 fl justify-content-center">
	        <label class="avatar-input">
	          <span class="avatar avatar-xl">
	            <img v-if='setting.logo' :src="base_url+`/storage/`+setting.logo" alt="..." class="avatar-img rounded-circle">
	              <span class="avatar-input-icon rounded-circle">
	                <i class="mdi mdi-upload mdi-24px"></i>
	            </span>
	          </span>
	          <input type="file" @change="getLogo($event)" class="avatar-file-picker">
	        </label>
	      </div>
	      <div class="form-row">
	          <div class="form-group col-md-6">
	              <label for="inputEmail6">Başlıq</label>
	              <input type="text" v-model="setting.title" class="form-control" id="inputEmail6" placeholder="Başlıq">
	          </div>
	          <div class="form-group col-md-6">
	              <label for="inputEmail4">Email</label>
	              <input type="email" class="form-control" id="inputEmail4" placeholder="Email" v-model="setting.email">
	          </div>
	      </div>
	      <div class="form-row">
	        <div class="form-group col-md-6">
	            <label class="form-label" for="number">Nömrə</label>
	            <input type="text" name="number" class="form-control" id="number" v-model="setting.number" data-mask="(00000)-000-00-00" data-mask-clearifnotmatch="true" placeholder="(00000)-000-00-00">
	        </div>
	        <div class="form-group col-md-6">
	          <label class="form-label" for="keyw">Açar sözlər (Seo)</label>
	          <input type="text" name="keyw" class="form-control" id="keyw" v-model="setting.keyw" placeholder="Açar sözlər">
	      </div>

	      </div>
	      <div class="form-row">
	        <div class="form-group col-md-12">
	          <label class="form-label" for="desc">Açıqlama</label>
	          <textarea name="desc" class="form-control" id="desc" v-model="setting.desc" placeholder="Sayt açıqlaması"></textarea>
	        </div>
	      </div>
	      <div class="form-row">
	        <div class="form-group col-md-6">
	          <label for="inputFacebook" class="form-label">Facebook</label>
	          <input type="text" name="facebook" id="inputFacebook" v-model="social.facebook" class="form-control" placeholder="Saytın facebook adresi">
	        </div>
	        <div class="form-group col-md-6">
	          <label for="inputInstagram" class="form-label">Instagram</label>
	          <input type="text" name="instagram" id="inputInstagram" v-model="social.instagram" class="form-control" placeholder="Saytın instagram adresi">
	        </div>
	      </div>
	      <div class="form-row">
	        <div class="form-group col-md-6">
	          <label for="inputTwitter" class="form-label">Twitter</label>
	          <input type="text" name="twitter" id="inputTwitter" v-model="social.twitter" class="form-control" placeholder="Saytın twitter adresi">
	        </div>
	        <div class="form-group col-md-6">
	          <label for="inputGoogle" class="form-label">Google Plus</label>
	          <input type="text" name="google" id="inputGoogle" v-model="social.google" class="form-control" placeholder="Saytın google plus adresi">
	        </div>
	      </div>
	      <div class="form-group">
	          <label for="inputAddress" class="form-label">Adress</label>
	          <input type="text" name="adress" v-model="setting.adress" class="form-control" id="inputAddress" placeholder="Saytın ofisinin adresi">
	      </div>
	      <button type="submit" class="btn btn-success btn-cta">Yadda Saxla</button>
	  </form>
	
</template>

<script>
	
	export default {
		data() {
			return {
				base_url: '',
				social: {},
				setting: {},
				logo: ''
			}
		},
		mounted() {
			this.getSettings()
			this.base_url = Laravel.base_url
		},

		methods: {
			getSettings: function() {
				axios.get(this.base_url+'/admin/settings').then(res => {
					this.setting = res.data
					this.setSocial()
				})
			},

			setSocial() {
				if(this.setting) {
					let socialData = this.setting.social.split('|||')

					this.social = {
						facebook: socialData[0],
						instagram: socialData[1],
						twitter: socialData[2],
						google: socialData[3],
					}
				}
					
			},

			submit() {
				const vm = this
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
				})

				setTimeout(() => {

					if(this.setting.logo.type != 'file') {
						delete this.setting.logo
					} else {
						this.setting.logo = this.setting.logo.files[0]
					}

					let formdata = new FormData()
					this.setting.social = Object.values(this.social).map((value,key) => value).join('|||')
					
					for (var [key,value] of Object.entries(this.setting)) {
						formdata.set(key, value)
					}

					axios.post(this.base_url+'/admin/settings',formdata).then(res => showAlert(res))
						.catch(error => showAlert(error))
				},1000)
				function showAlert(res) {
					if(res.status == 200) {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: res.data.mes,
							showConfirmButton: false,
							timer: 1500
						})
						vm.setting = res.data.setting
						vm.setSocial()
					} else {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: res.data.mes,
							showConfirmButton: false,
							timer: 1500
						})
					}
				}
				
			},

			getLogo(e) {
				this.setting.logo = event.target
			}
				
		},
	
	}

</script>