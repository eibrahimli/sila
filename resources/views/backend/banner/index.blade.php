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
          <h3>Bannerlər.</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
              <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">AnaSəhifə</a></li>
              <li class="breadcrumb-item active" aria-current="page">Bütün Bannerlər</li>            
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <section class="pull-up">
    <div class="container">
      <div class="row ">
        <div class="col-lg-12 mx-auto  mt-2">
          <div class="card py-3 m-b-30">
            <div class="card-body">
              @if(session('status') == 'ok')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Uğurlu Əməliyyat!</strong> Banner əlavə edildi.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
              @elseif(session('status') == 'error')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Diqqət!</strong> Nəsə səhv oldu.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
                </div>

              @endif

              @if($middle)
                <div class="col-12 mb-2 mt-2">
                  <img src="{{ asset('storage/'.$middle->photo) }}" class="img-fluid" alt="...">
                  <button onclick="middle('{{ route('admin.banner.destroy', $middle->id) }}')" class="btn btn-danger btn-sm mt-2 deletemiddle" 
                    type="button">
                    <i class="mdi mdi-delete"></i>
                  </button>
                </div>
              @endif
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.banner.store') }}">
                    @csrf
                    <div class="form-group col-12">
                      <label for="inputName">Link</label>
                      <input type="text" name="link" value="{{ $middle ? $middle->link : '' }}" class="form-control @error('link') {{  'is-invalid' }} @enderror" id="inputName" placeholder="Link">
                      @error('link')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group col-12">
                        <label for="inputLanguage">Ortadakı banner</label>
                        <div class="mb-3">
                          <input class="form-control" type="file" name="middle">
                        </div>
                        @error('middle')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>     
                    
                    <button type="submit" class="btn btn-success btn-cta ml-3">Əlavə Et</button>
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

    const middle = (url) => {
      window.location.href = url
    }
  </script>
  
@endsection
