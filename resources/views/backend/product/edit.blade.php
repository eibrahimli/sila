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
          <h3>Məhsulu redaktə edin.</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
              <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">AnaSəhifə</a></li>
              <li class="breadcrumb-item"><a href="{{ $product->status == '0' ? route('admin.product.NotActiveIndex') : route('admin.product.activeIndex') }}">Bütün @if($product->status == '0') Aktiv Olmayan @else Aktiv @endif Məhsullar</a></li>
              <li class="breadcrumb-item active" aria-current="page">Məhsul görüntülə
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <section class="pull-up">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mx-auto  mt-2">
          <div class="card py-3 m-b-30">
            <div class="card-body">
              <admin-product-edit-page
                getproducturl ="{{ route('admin.product.getProductUrl',$product->id) }}"
                categoryurl="{{ route('admin.product.getCat') }}"
                updateproducturl="{{ route('admin.product.update',$product->id) }}"
                update_specs="{{ route('admin.product.updateSpecs', $product->id) }}"
                deletephotos="{{ route('admin.product.deletePhotos',$product->id) }}"
                update_product_color="{{ route('admin.product.updateColorStock',$product->id) }}"
                add_product_color="{{ route('admin.product.addColor',$product->id) }}"
                deletesingleproductcolor="{{ route('admin.product.deleteSingleColorStock') }}"
                id="{{ $product->id }}"
                update_photos="{{ route("admin.product.updatePhotos",$product->id) }}"
              ></admin-product-edit-page>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset('backend/css/formadvence.min.css') }}">
@endsection

@section('js')
  <script src="{{ asset('backend/js/formadvence.js') }}"></script>

@endsection
