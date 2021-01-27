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
          <h3>Məhsulu redaktə edin.</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
              <li class="breadcrumb-item"><a href="{{ route('seller.index') }}">AnaSəhifə</a></li>
              <li class="breadcrumb-item"><a href="{{ $product->status == '0' ? route('seller.product.notActiveIndex') : route('seller.product.index') }}">Bütün @if($product->status == '0') Aktiv Olmayan @else Aktiv @endif Məhsullar</a></li>
              <li class="breadcrumb-item active" aria-current="page">Məhsul redaktə
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
              <product-edit-page
                getproducturl = "{{ route('seller.product.getProductUrl',$product->id) }}"
                colorsurl="{{ route('seller.colors.all') }}"
                brandsurl="{{ route('seller.brand.all') }}"
                categoryurl="{{ route('seller.getCat') }}"
                getspecs="{{ route('seller.product.getSpecs',$product->id) }}"
                getphotos="{{ route('seller.product.getPhotos',$product->id) }}"
                deletephotos="{{ route('seller.product.deletePhotos',$product->id) }}"
                getcolorsrelatedtoproduct="{{ route('seller.product.getColorsRelatedToProduct',$product->id) }}"
                deleteproductcolor="{{ route('seller.product.deletColorStock',$product->id) }}"
                deletesingleproductcolor="{{ route('seller.product.deleteSingleColorStock',$product->id) }}"
                update_specs="{{ route('seller.product.updateProductSpecs',$product->id) }}"
                url="{{ route('seller.product.updateProduct',$product->id) }}"
                id="{{ $product->id }}"
              ></product-edit-page>
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
