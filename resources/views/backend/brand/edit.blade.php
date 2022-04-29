@extends('backend.layouts.app')

@section('content')
  <div class="bg-dark bg-dots m-b-30">
    <div class="container">
      <div class="row p-b-60 p-t-60">
        <div class="col-lg-8 text-center mx-auto text-white p-b-30">
          <div class="m-b-10">
            <div class="avatar avatar-lg ">
              <div class="avatar-title bg-info rounded-circle mdi mdi-format-list-bulleted"></div>
            </div>
          </div>
          <h3>Brendi redaktə edin.</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
              <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">AnaSəhifə</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.brand.index') }}">Bütün Brendlər</a></li>
              <li class="breadcrumb-item active" aria-current="page">Brend redaktə edin
              </li>
            </ol>
          </nav>
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
              @if(session('status') == 'ok')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Uğurlu Əməliyyat!</strong> Brend redaktə edildi.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
              @elseif(session('status') == 'error')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Diqqət!</strong> Belə bir brend bazada mövcuddur.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
                </div>
              @endif
                <form method="post" action="{{ route('admin.brand.update',$brand->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group col-12">
                      <label for="inputName">Ad</label>
                      <input type="text" name="name" value="{{ old('name') ?? $brand->name }}" class="form-control @error('name') {{  'is-invalid' }} @enderror" id="inputName" placeholder="Brend adı">
                      @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                  </div>
                    <div class="form-group col-12">
                        <label for="inputLanguage">Dil</label>
                        <select name="lang" id="inputLanguage" class="form-control">
                          <option value="az" {{  $brand->lang == 'az' ? 'selected' : null }}>Az</option>
                          <option value="en" {{  $brand->lang == 'en' ? 'selected' : null }}>En</option>
                          <option value="tr" {{  $brand->lang == 'tr' ? 'selected' : null }}>Tr</option>
                          <option value="ru" {{  $brand->lang == 'ru' ? 'selected' : null }}>Ru</option>
                        </select>
                        @error('lang')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror 
                    </div>
                    <div class="form-group col-12">
                        <label for="inputPhoto">Şəkil* (166x59 tövsiyyə edilir...)</label>
                        <input type="file" class="form-control" name="photo" id="inputPhoto">
                        @error('photo')
                            <div style="display: block !important" class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>                              
                    <button type="submit" class="btn btn-success btn-cta ml-3">Yenİlə</button> 
                </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@section('js')
  <script src="{{ asset('backend/js/formadvence.js') }}"></script>
  <script>
    $('.js-select2').select2()
  </script>
@endsection