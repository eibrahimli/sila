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
          <h3>Səhifəni redaktə edin.</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
              <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">AnaSəhifə</a></li>              
              <li class="breadcrumb-item active" aria-current="page">Səhifəni redaktə edin
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
        <div class="col-lg-12 mx-auto  mt-2">
          <div class="card py-3 m-b-30">
            <div class="card-body">
              @if(session('status') == 'ok')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Uğurlu Əməliyyat!</strong> Səhifə redaktə edildi.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
              @elseif(session('status') == 'error')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Diqqət!</strong> Belə bir səhifə bazada mövcuddur.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
                </div>
              @endif
                <form method="post" action="{{ route('admin.page.update',$page->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group col-12">
                      <label for="inputTitle">Başlıq</label>
                      <input type="text" name="title" value="{{ old('title') ?? $page->title }}" class="form-control @error('title') {{  'is-invalid' }} @enderror" id="inputTitle" placeholder="Səhifə başlığı">
                      @error('title')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                  </div>
                    <div class="form-group col-12">
                        <label for="inputLanguage">Dil</label>
                        <select name="lang" id="inputLanguage" class="form-control">
                          <option value="az" {{  $page->lang == 'az' ? 'selected' : null }}>Az</option>
                          <option value="en" {{  $page->lang == 'en' ? 'selected' : null }}>En</option>
                          <option value="tr" {{  $page->lang == 'tr' ? 'selected' : null }}>Tr</option>
                          <option value="ru" {{  $page->lang == 'ru' ? 'selected' : null }}>Ru</option>
                        </select>
                        @error('lang')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror 
                    </div>    
                    
                    <div class="form-group col-12">
                        <label for="summernote">Məzmun</label>
                        <textarea name="content" id="summernote">{!! $page->content !!}</textarea>
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
  <script src="{{ asset('backend/js/summernote.js') }}"></script>
  <script>
    $('.js-select2').select2()
  </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/fonts/summernote/summernote.css') }}">
@endsection