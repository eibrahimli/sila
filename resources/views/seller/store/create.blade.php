@extends('seller.layouts.app')

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
          <h3>Yeni mağaza əlavə edin.</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
              <li class="breadcrumb-item"><a href="{{ route('seller.index') }}">AnaSəhifə</a></li>
              <li class="breadcrumb-item"><a href="{{ route('seller.store.index') }}">Bütün Mağazalar</a></li>
              <li class="breadcrumb-item active" aria-current="page">Yeni Mağaza
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
              <store-create-page url="{{ route('seller.store.store') }}"></store-create-page>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@section('js')
  <script src="{{ asset('backend/js/formadvence.js') }}"></script>  
@endsection