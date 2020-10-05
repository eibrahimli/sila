@extends('backend.layouts.app')

@section('content')
<div class="bg-dark bg-dots m-b-30">
  <div class="container">
    <div class="row p-b-60 p-t-60">
      <div class="col-lg-8 text-center mx-auto text-white p-b-30">
          <div class="m-b-10">
              <div class="avatar avatar-lg ">
                  <div class="avatar-title bg-info rounded-circle mdi mdi-settings "></div>
              </div>
          </div>
          <h3>Sayt Ayarları </h3>
      </div>
    </div>
  </div>
</div>
<section class="pull-up">
  <div class="container">
    <div class="row ">
      <div class="col-lg-8 mx-auto  mt-2">
          <div class="card py-3 m-b-30">
            <div class="card-body">
              <form method="POST" enctype="multipart/form-data" action="{{ route('admin.update') }}">
                @csrf
                  <h3 class="">Ümumi sayt ayarları</h3>
                  <p class="text-muted">
                      Bu formdan istifadə edərək saytın ümumi ayarlarını sürətli şəkildə dəyişə bilərsiniz...
                  </p>
                  <div class="">
                    <label class="avatar-input">
                      <span class="avatar avatar-xl">
                        <img src="{{ asset('storage'.$setting->logo) }}" alt="..." class="avatar-img rounded-circle">
                          <span class="avatar-input-icon rounded-circle">
                            <i class="mdi mdi-upload mdi-24px"></i>
                        </span>
                      </span>
                      <input type="file" name="logo" class="avatar-file-picker">
                    </label>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="inputEmail6">Başlıq</label>
                          <input type="text" value="{{ $setting->title }}" class="form-control" id="inputEmail6" placeholder="Başlıq">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Email</label>
                          <input type="email" class="form-control" id="inputEmail4" placeholder="Email" value="{{ $setting->email }}">
                      </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="number">Nömrə</label>
                        <input type="text" name="number" class="form-control" id="number" value="{{ $setting->number }}" data-mask="(00000)-000-00-00" data-mask-clearifnotmatch="true" placeholder="(00000)-000-00-00">
                    </div>
                    <div class="form-group col-md-6">
                      <label class="form-label" for="keyw">Açar sözlər (Seo)</label>
                      <input type="text" name="keyw" class="form-control" id="keyw" value="{{ $setting->keyw }}" placeholder="Açar sözlər">
                  </div>
                  
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label class="form-label" for="desc">Açıqlama</label>
                      <textarea name="desc" class="form-control" id="desc" placeholder="Sayt açıqlaması">{{ $setting->desc }}</textarea>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputFacebook" class="form-label">Facebook</label>
                      <input type="text" name="facebook" id="inputFacebook" value="{{ $setting->adress }}" class="form-control" placeholder="Saytın facebook adresi">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputInstagram" class="form-label">Instagram</label>
                      <input type="text" name="instagram" id="inputInstagram" value="{{ $setting->adress }}" class="form-control" placeholder="Saytın instagram adresi">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputTwitter" class="form-label">Twitter</label>
                      <input type="text" name="twitter" id="inputTwitter" value="{{ $setting->adress }}" class="form-control" placeholder="Saytın twitter adresi">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputGoogle" class="form-label">Google Plus</label>
                      <input type="text" name="google" id="inputGoogle" value="{{ $setting->adress }}" class="form-control" placeholder="Saytın google plus adresi">
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="inputAddress" class="form-label">Adress</label>
                      <input type="text" name="adress" value="{{ $setting->adress }}" class="form-control" id="inputAddress" placeholder="Saytın ofisinin adresi">
                  </div>
                  <button type="submit" class="btn btn-success btn-cta">Yadda Saxla</button>
              </form>
            </div>
          </div>
      </div>

    </div>
  </div>

</section>
@endsection

@section('js')
  <script defer src="{{ asset('backend/js/formadvence.js') }}"></script>
@endsection