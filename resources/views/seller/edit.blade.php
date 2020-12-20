@extends('seller.layouts.app')

@section('content')
  <div class="bg-dark bg-dots m-b-30">
    <div class="container">
      <div class="row p-b-60 p-t-60">
        <div class="col-lg-8 text-center mx-auto text-white p-b-30">
          <div class="m-b-10">
            <div class="avatar avatar-lg ">
              <div class="avatar-title bg-info rounded-circle mdi mdi-settings"></div>
            </div>
          </div>
          <h3>Satıcı Ayarları </h3>
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
              <seller-edit-page _method="PATCH" get_user="{{ route('seller.getUser',auth()->id()) }}" url="{{ route('seller.update',auth()->id()) }}"></seller-edit-page>
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
