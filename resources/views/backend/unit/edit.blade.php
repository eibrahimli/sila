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
          <h3>Vahidi redaktə edin.</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
              <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">AnaSəhifə</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.unit.index') }}">Bütün Vahidlər</a></li>
              <li class="breadcrumb-item active" aria-current="page">Vahidi redaktə edin
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
                    <strong>Uğurlu Əməliyyat!</strong> Vahid əlavə edildi.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
              @elseif(session('status') == 'error')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Diqqət!</strong> Belə bir vahid bazada mövcuddur.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
                </div>
              @endif
                <form method="post" action="{{ route('admin.unit.update',$unit->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group col-12">
                      <label for="inputName">Ad</label>
                      <input type="text" name="name" value="{{ old('name') ?? $unit->name }}" class="form-control @error('name') {{  'is-invalid' }} @enderror" id="inputName" placeholder="Vahid adı">
                      @error('name')
                        <div class="invalid-feedback">
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